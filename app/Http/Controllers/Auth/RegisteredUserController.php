<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $referralCode = '2024' . sprintf('%05d', User::max('id') + 1);
        $referralCodeFromURL = $request->query('ref');
        $byReferal = !empty($referralCodeFromURL) ? $referralCodeFromURL : null;

        $byReferalCount = User::where('by_referal', $byReferal)->count();

        $referalChain = [$byReferal];

        // Function to fetch referal chain based on given referal
        $fetchReferalChain = function ($byReferal) use (&$referalChain, &$fetchReferalChain) {
            if ($byReferal) {
                $referralUser = User::where('referal', $byReferal)->first();

                if ($referralUser) {
                    $referalChain[] = $referralUser->by_referal;
                    $fetchReferalChain($referralUser->by_referal);
                }
            }
        };

        // Fetch referal chain for the initial by_referal
        $fetchReferalChain($byReferal);

        // Check if the current by_referal code has reached the limit (5 users)
        $byReferalCount = User::where('by_referal', $byReferal)->count();

        $referralRules = User::select('by_referal', 'referal')
            ->whereNotNull('referal')
            ->whereNotNull('by_referal')
            ->get()
            ->pluck('by_referal', 'referal')
            ->toArray();
        // dd($referralRules);

        $childReferals = collect($referralRules)->filter(function ($byReferalValue, $referalKey) use ($byReferal) {
            return $byReferalValue === $byReferal;
        })->keys()->toArray();

        if ($byReferalCount >= 5 && !empty($childReferals)) {
            foreach ($childReferals as $childReferal) {
                // Check if the current child referal has not reached the limit
                $childReferalCount = User::where('by_referal', $childReferal)->count();
                if ($childReferalCount < 5) {
                    // Set the new by_referal
                    $byReferal = $childReferal;
                    // dd($byReferal);

                    // Reset referal chain and fetch it again
                    $referalChain = [$byReferal];
                    $fetchReferalChain($byReferal);

                    // Exit the loop
                    break;
                }
            }
        }

        $user = User::create([
            'name' => $request->name,
            'referal' => $referralCode,
            'no_hp' => $request->no_hp,
            'role' => 'member',
            'level' => '1',
            'by_referal' => $byReferal,
            'referal_1' => $referalChain[1],
            'referal_2' => $referalChain[2],
            'referal_3' => $referalChain[3],
            'referal_4' => $referalChain[4],
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_akun' => 'Calon Member',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/dashboard?ref=' . auth()->user()->referal);
    }
}

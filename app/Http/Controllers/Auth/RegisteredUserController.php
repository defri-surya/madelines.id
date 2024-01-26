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

        $referalChain = [$byReferal];

        $fetchReferalChain = function ($byReferal) use (&$referalChain, &$fetchReferalChain) {
            if ($byReferal) {
                $referralUser = User::where('referal', $byReferal)->first();

                if ($referralUser) {
                    $referalChain[] = $referralUser->by_referal;
                    $fetchReferalChain($referralUser->by_referal);
                }
            }
        };

        $fetchReferalChain($byReferal);

        $referralRules = User::select('by_referal', 'referal')
            ->whereNotNull('referal')
            ->whereNotNull('by_referal')
            ->get()
            ->pluck('by_referal', 'referal')
            ->toArray();

        $childReferals = collect($referralRules)->filter(function ($byReferalValue, $referalKey) use ($byReferal) {
            return $byReferalValue === $byReferal;
        })->keys()->toArray();

        shuffle($childReferals);

        foreach ($childReferals as $childReferal) {
            $childReferalCount = User::where('by_referal', $childReferal)->count();
            if ($childReferalCount < 5) {
                $byReferal = $childReferal;

                $referalChain = [$byReferal];
                $fetchReferalChain($byReferal);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'referal' => $referralCode,
            'no_hp' => $request->no_hp,
            'role' => 'member',
            'level' => '1',
            'by_referal' => $byReferal,
            'referal_1' => !empty($referalChain[1]) ? $referalChain[1] : null,
            'referal_2' => !empty($referalChain[2]) ? $referalChain[2] : null,
            'referal_3' => !empty($referalChain[3]) ? $referalChain[3] : null,
            'referal_4' => !empty($referalChain[4]) ? $referalChain[4] : null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_akun' => 'Calon Member',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/dashboard?ref=' . auth()->user()->referal);
    }
}

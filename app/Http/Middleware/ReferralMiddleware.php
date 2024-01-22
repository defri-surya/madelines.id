<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $referralCode = $request->query('ref');

        // Tambahkan logika verifikasi referal di sini
        if (!$this->isValidReferralCode($referralCode)) {
            abort(404); // Jika referal tidak valid, arahkan ke halaman 404
        }
        return $next($request);
    }

    private function isValidReferralCode($referralCode)
    {
        // Misalnya, kita memeriksa apakah kode referal ada di dalam database
        $user = DB::table('users')->where('referal', $referralCode)->first();

        // Jika ditemukan pengguna dengan kode referal yang sesuai, kita anggap itu valid
        return $user !== null;
    }
}

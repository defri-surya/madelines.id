<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use App\Models\Produk;
use App\Models\ShareProfit;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class configController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Check if the user has 5 children with status "Member"
        $childrenCount = User::where('by_referal', $user->referal)
            ->where('status_akun', 'Member')
            ->count();

        // Determine the new level based on the multiples of 5
        $newLevel = floor($childrenCount / 5) + 1;

        // Check if the new level is greater than the current level
        if ($newLevel > $user->level) {
            // Update the level
            $user->update(['level' => $newLevel]);
        }

        $saldo = User::find($user->id);
        $totalWD = Withdraw::where('user_id', auth()->user()->id)->where('status', 'Sukses')->sum('nominal');
        $saldoEnd = $saldo->saldo - $totalWD;
        $userCount = User::where(function ($query) {
            $query->where('by_referal', auth()->user()->referal)
                ->orWhere('referal_1', auth()->user()->referal)
                ->orWhere('referal_2', auth()->user()->referal)
                ->orWhere('referal_3', auth()->user()->referal)
                ->orWhere('referal_4', auth()->user()->referal);
        })
            ->where('status_akun', 'Member')
            ->count();

        $allUser = User::where('status_akun', 'Member')->count();
        $allCalonUser = User::where('status_akun', 'Calon Member')->count();
        $produk = Produk::all();

        // Setup Progress Bar
        // Count by_referal
        $countReferal = User::where('by_referal', auth()->user()->referal)
            ->where('status_akun', 'Member')
            ->count();

        $cektransaksi = Histori::where('user_id', auth()->user()->id)
            ->where('status', 'Sukses')
            ->where('keterangan', 'Beli Produk')
            ->exists();

        $transaksiCount = Histori::where('user_id', auth()->user()->id)
            ->where('status', 'Sukses')
            ->where('keterangan', 'Beli Produk')
            ->count();

        $cekRegis = Histori::where('user_id', auth()->user()->id)
            ->where('keterangan', 'Registrasi')
            ->where('status', 'Sukses')
            ->exists();

        $cekProfit = ShareProfit::where('user_id', auth()->user()->id)
            ->where('status', 'Sukses')
            ->exists();

        return view('dashboard.dashboard', compact('saldoEnd', 'userCount', 'saldo', 'allUser', 'allCalonUser', 'produk', 'countReferal', 'cektransaksi', 'transaksiCount', 'cekRegis', 'cekProfit'));
    }
}

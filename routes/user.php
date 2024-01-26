<?php

use App\Http\Controllers\User\anggotaController;
use App\Http\Controllers\User\infoPerusahaansController;
use App\Http\Controllers\User\marketingPlansController;
use App\Http\Controllers\User\saldoController;
use App\Http\Controllers\User\shareProfitController;
use App\Http\Controllers\User\TransaksiController;
use App\Http\Controllers\User\withdrawController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'Cekrole:member', 'referral'])->group(function () {
    Route::get('saldo', [saldoController::class, 'index']);

    // Deposit
    Route::get('deposit', [saldoController::class, 'create']);
    Route::post('deposit-store', [TransaksiController::class, 'store']);

    // Anggota
    Route::get('anggota', [anggotaController::class, 'index']);
    Route::get('anggota-detail/{ref}', [anggotaController::class, 'show']);

    // Withdraw
    Route::get('withdraw', [withdrawController::class, 'create']);
    Route::post('withdraw-store', [withdrawController::class, 'store']);

    // Marketing Plan
    Route::get('marketing-plan', [marketingPlansController::class, 'index']);

    // Info Perusahaan
    Route::get('info-perusahaan', [infoPerusahaansController::class, 'index']);

    // Beli Produk
    Route::post('beli-produk-store', [TransaksiController::class, 'beliProduk']);

    // Klaim Reward Share Profit
    Route::post('profit-klaim', [shareProfitController::class, 'store']);
});

<?php

use App\Http\Controllers\Admin\memberController;
use App\Http\Controllers\User\profilController;
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

Route::middleware(['auth', 'Cekrole:admin', 'referral'])->group(function () {
    // Anggota
    Route::get('member', [memberController::class, 'index']);
    Route::get('member-detail/{ref}', [memberController::class, 'show']);

    // Withdraw
    Route::get('withdraw-admin', [withdrawController::class, 'index']);
    Route::put('withdraw-konfirm/{ref}', [withdrawController::class, 'update']);

    // All Transaksi
    Route::get('transaksi', [TransaksiController::class, 'allTransaksi']);
});

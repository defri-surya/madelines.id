<?php

use App\Http\Controllers\Admin\infoPerusahaanController;
use App\Http\Controllers\Admin\marketingPlanController;
use App\Http\Controllers\Admin\memberController;
use App\Http\Controllers\Admin\produkController;
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

    // Transaksi Product
    Route::get('transaksi-produk', [TransaksiController::class, 'index']);

    // Product
    Route::get('produk', [produkController::class, 'index']);
    Route::get('produk-create', [produkController::class, 'create']);
    Route::post('produk-store', [produkController::class, 'store']);
    Route::get('produk-edit/{id}', [produkController::class, 'edit']);
    Route::put('produk-update/{id}', [produkController::class, 'update']);
    Route::delete('produk-delete/{id}', [produkController::class, 'destroy']);

    // Marketing Plan
    Route::get('marketplan', [marketingPlanController::class, 'index']);
    Route::get('marketplan-create', [marketingPlanController::class, 'create']);
    Route::post('marketplan-store', [marketingPlanController::class, 'store']);
    Route::get('marketplan-edit/{id}', [marketingPlanController::class, 'edit']);
    Route::put('marketplan-update/{id}', [marketingPlanController::class, 'update']);
    Route::delete('marketplan-delete/{id}', [marketingPlanController::class, 'destroy']);

    // Info Perusahaan
    Route::get('info', [infoPerusahaanController::class, 'index']);
    Route::put('info-update/{id}', [infoPerusahaanController::class, 'update']);
});

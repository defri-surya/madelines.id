<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\configController;
use App\Http\Controllers\User\profilController;
use App\Http\Controllers\User\TransaksiController;

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

Route::middleware('referral')->group(function () {
    Route::get('/home', function () {
        return view('home');
    });
});

Route::get('product', function () {
    return view('produk.index');
});

Route::middleware(['auth', 'referral'])->group(function () {
    Route::get('dashboard', [configController::class, 'dashboard'])->name('dashboard');
});

// Payment
Route::get('payment', [TransaksiController::class, 'payment'])->name('payment');
Route::get('finishpayment', [TransaksiController::class, 'index']);

// Setting Profil
Route::get('setting-profil/{ref}', [profilController::class, 'edit']);
Route::put('setting-update/{ref}', [profilController::class, 'update']);

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';

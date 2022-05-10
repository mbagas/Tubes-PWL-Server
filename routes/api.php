<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::post('login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('transaksi', TransaksiController::class);
    Route::get('grafik/transaksi', [TransaksiController::class, 'grafikTransaksi']);
    Route::resource('role', RoleController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('user', UserController::class);
    Route::post('/logout', [UserController::class, 'logout']);
});

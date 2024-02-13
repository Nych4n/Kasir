<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});
Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('produk', ProdukController::class);
Route::resource('pelanggan', PelangganController::class);

Route::get('penjualan', [PenjualanController::class, 'index'])->name('index');
// Route::get('/add', [PenjualanController::class, 'add'])->name('add');
Route::get('/penjualan/transaksi/{id}', [PenjualanController::class, 'transaksi'])->name('penjualan.transaksi');



Route::post('/penjualan/tambahkeranjang', [PenjualanController::class, 'tambahkeranjang'])->name('penjualan.tambahkeranjang');

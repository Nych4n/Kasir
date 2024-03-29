<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PenggunaController;
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


Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/pengguna',function(){
    //     return view('/pengguna/index');
    // });
    Route::get('pengguna',[PenggunaController::class,'index'])->name('index');
    Route::post('pengguna/addproses',[PenggunaController::class,'addproses'])->name('addproses');
    Route::delete('/delete/{id}',[PenggunaController::class,'delete'])->name('delete');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('produk', ProdukController::class);

    Route::resource('pelanggan', PelangganController::class);

    //penjualan atau transaksi
    Route::get('penjualan', [PenjualanController::class, 'index'])->name('index');
    Route::get('/penjualan/transaksi/{pelanggan_id}', [PenjualanController::class, 'transaksi'])->name('penjualan.transaksi');
    Route::post('/penjualan/tambahkeranjang/{pelanggan_id}', [PenjualanController::class, 'tambahkeranjang'])->name('penjualan.tambahkeranjang');
    Route::delete('/hapus/{detailID}/{produkID}', [PenjualanController::class, 'hapus'])->name('hapus');
    Route::post('/penjualan/bayar/{nota}', [PenjualanController::class, 'bayar'])->name('bayar');
    Route::get('/penjualan/invoice/{kode_penjualan}',[PenjualanController::class,'invoice'])->name('invoice');
    Route::get('/cetak/{kode_penjualan}',[PenjualanController::class,'cetak'])->name('cetak');
});
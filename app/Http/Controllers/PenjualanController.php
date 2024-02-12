<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        return view('penjualan.index', compact('produk','pelanggan'));
    }

    public function add()
    {
        $produk = Produk::all();
        return view('penjualan.add', compact('produk'));
    }

    public function transaksi($pelanggan_id)
    {
        $nota = date('ymd');
        $pelanggan = Pelanggan::with('pelanggan_id');
        return view('penjualan.transaksi', compact('pelanggan'));
    }

}


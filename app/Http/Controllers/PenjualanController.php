<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        return view('penjualan.index', compact('produk','pelanggan'));
    }

    // public function add()
    // {
    //     $produk = Produk::all();
    //     return view('penjualan.add', compact('produk'));
    // }

    public function transaksi($pelanggan_id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = now()->format('Y-m');
        $jumlah = DB::table('penjualan')->count();
        $nota = date('ymd') . ($jumlah + 1);
    
        $produk = DB::table('produk')
            ->where('stok', '>', 0)
            ->orderBy('Namaproduk', 'ASC') // Assuming 'Namaproduk' is the correct column name
            ->get()
            ->toArray();
    
        $namapelanggan = DB::table('pelanggan')
            ->where('pelanggan_id', $pelanggan_id)
            ->value('nama');
    
            $detail = DB::table('detail_penjualan as a')
            ->leftJoin('produk as b', 'a.produk_id', '=', 'b.produk_id')
            ->where('a.kode_penjualan', $nota)
            ->get()
            ->toArray();
    
        return view('penjualan.transaksi', compact('produk', 'namapelanggan', 'nota', 'detail'));
    }

    public function tambahkeranjang(Request $request )
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:1'],
        ]);
             
        $produk = Produk::where('produk_id', $request->produk_id)->first();
    
        $harga = $produk->Harga;
        $stok_lama = $produk->Stok;
        $stok_sekarang = $stok_lama - $request->input('jumlah');
        $sub_total = $request->input('jumlah') * $harga;
    
        $data = [
            'kode_penjualan' => $request->input('kode_penjualan'),
            'produk_id' => $request->input('produk_id'),
            'jumlah' => $request->input('jumlah'),
            'subtotal' => $sub_total,
        ];
    
        DB::table('detail_penjualan')->insert($data);
    
        $data2 = ['Stok' => $stok_sekarang];
        $where = ['produk_id' => $request->input('produk_id')];
        
        DB::table('produk')->where($where)->update($data2);
        return redirect()->back()->with('success','Produk berhasil ditambah dari keranjang');
        
    }


    public function hapus($detailID, $produkID)
    {
        $detailpenjualan = DetailPenjualan::find($detailID);
        $jumlah = $detailpenjualan->jumlah;

        $produk = Produk::find($produkID);
        $stok_lama = $produk->Stok;
        $stok_sekarang = $stok_lama + $jumlah;
        $produk->update(['Stok' => $stok_sekarang]);

        $detailpenjualan->delete();
        return redirect()->back()->with('success','Produk berhasil dihapus dari keranjang');
    }
}


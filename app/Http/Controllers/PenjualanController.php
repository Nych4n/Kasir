<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = Carbon::now()->format('y-m-d');

        $penjualan = DB::table('penjualan as a')
        ->select('a.*', 'b.*') 
        ->leftJoin('pelanggan as b', 'a.pelanggan_id', '=', 'b.pelanggan_id')
        ->where('a.tgl_penjualan', $tanggal)
        ->orderBy('a.tgl_penjualan', 'DESC')
        ->get();

        // $penjualan = Penjualan::with('pelanggan')
        // ->where('tgl_penjualan', $tanggal)
        // ->orderBy('tgl_penjualan', 'DESC')
        // ->get();

        $pelanggan = Pelanggan::orderBy('nama', 'ASC')
        ->get();

        $data = [
            'penjualan' => $penjualan,
            'pelanggan' => $pelanggan
        ];
        return view('penjualan.index', compact('penjualan','pelanggan', 'data'));
    }

    public function transaksi($pelanggan_id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = Carbon::now()->format('Y-m');
        $jumlah  = Penjualan::whereRaw("DATE_FORMAT(tgl_penjualan, '%Y-%m') = ?", [$tanggal])->count();
        $nota = date('ymd') . ($jumlah + 1);

        $produk = DB::table('produk')
            ->where('stok', '>', 0)
            ->orderBy('Namaproduk', 'ASC') 
            ->get();
    
        $namapelanggan = DB::table('pelanggan')
            ->where('pelanggan_id', $pelanggan_id)
            ->value('nama');
    
        $detail = DB::table('detail_penjualan as a')
            ->leftJoin('produk as b', 'a.produk_id', '=', 'b.produk_id')
            ->where('a.kode_penjualan', $nota)
            ->get();
    
        $data = [
            'nota'           => $nota,
            'produk'         => $produk,
            'pelanggan_id'   => $pelanggan_id,
            'namapelanggan'  => $namapelanggan,
            'detail'         => $detail,
        ];

        return view('penjualan.transaksi', $data)->with(compact('detail'));
    }

    public function tambahkeranjang(Request $request, $pelanggan_id)
    {      
        $produk = Produk::where('produk_id', $request->produk_id)->first();
        $harga = $produk->Harga;
        $stok_lama = $produk->Stok;
        $stok_sekarang = $stok_lama - $request->jumlah;
        $sub_total = $request->jumlah * $harga;
    
        $data = [
            'kode_penjualan' => $request->input('kode_penjualan'),
            'produk_id' => $request->input('produk_id'),
            'jumlah' => $request->input('jumlah'),
            'subtotal' => $sub_total,
            'pelanggan_id'   => $pelanggan_id
        ];
    
        if ( $stok_lama >= $request->jumlah) {
            DetailPenjualan::create($data);
            $data2 = [
                'Stok' => $stok_sekarang,
            ];
    
            $where = ['produk_id' => $request->produk_id];
            Produk::where($where)->update($data2);
            $penjualan = Penjualan::where('pelanggan_id', $pelanggan_id)->get();

            // $penjualan = Penjualan::with('detail_penjualan')->where('pelanggan_id', $pelanggan_id)->get();
            return redirect()->back()->with(compact('penjualan'))->with('success', 'Produk berhasil ditambah ke keranjang');
        }else{
            return redirect()->back()->with('error', 'Produk yang dipilih tidak mencukupi');
        }
        
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

    public function bayar(Request $request, $nota)
    {
        $data = [
            'kode_penjualan' => $request->kode_penjualan,
            'pelanggan_id' => $request->pelanggan_id,
            'TotalHarga' => $request->TotalHarga,
            'pembayaran' => $request->pembayaran,
            'tgl_penjualan' => Carbon::now()->format('Y-m-d'),
        ];

        Penjualan::create($data);

        session(['pembayaran' => $request->pembayaran]);
         
        return redirect()->route('invoice',['kode_penjualan' => $request->kode_penjualan])->with('succes','transaksi berhasil');
    }

    public function invoice($kode_penjualan)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = Carbon::now()->format('y-m-d');

        $penjualan = DB::table('penjualan as a')
            ->select('a.*', 'b.*') 
            ->leftJoin('pelanggan as b', 'a.pelanggan_id', '=', 'b.pelanggan_id')
            ->where('a.kode_penjualan', $kode_penjualan)
            ->orderBy('a.tgl_penjualan', 'DESC')
            ->get();

        $detail = DB::table('detail_penjualan as a')
            ->leftJoin('produk as b', 'a.produk_id', '=', 'b.produk_id')
            ->where('a.kode_penjualan', $kode_penjualan)
            ->get();

        $pembayaran = session('pembayaran');
        // dd(session('pembayaran'));

        
        $data = [
            'nota'      => $kode_penjualan,
            'penjualan' => $penjualan,
            'detail'    => $detail,
            'pembayaran' => $pembayaran

        ];
        return view('penjualan.invoice', $data);
    }

    public function cetak($kode_penjualan)
    {

    }
}













// public function transaksi($pelanggan_id)
// {
//     date_default_timezone_set("Asia/Jakarta");
//     $tanggal = now()->format('Y-m');
//     $jumlah = DB::table('penjualan')->count();
//     $nota = date('ymd') . ($jumlah + 1);

//     $produk = DB::table('produk')
//         ->where('stok', '>', 0)
//         ->orderBy('Namaproduk', 'ASC') 
//         ->get()
//         ->toArray();

//     $namapelanggan = DB::table('pelanggan')
//         ->where('pelanggan_id', $pelanggan_id)
//         ->value('nama');

//         $detail = DB::table('detail_penjualan as a')
//         ->leftJoin('produk as b', 'a.produk_id', '=', 'b.produk_id')
//         ->where('a.kode_penjualan', $nota)
//         ->get()
//         ->toArray();

//     return view('penjualan.transaksi', compact('produk', 'namapelanggan', 'nota', 'detail'));
// }

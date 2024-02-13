<?php

namespace App\Http\Controllers;

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

    public function add()
    {
        $produk = Produk::all();
        return view('penjualan.add', compact('produk'));
    }

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
    
    public function tambahkeranjang(Request $request)
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:1'],
            // Add other validation rules for your form fields
        ]);
    
        $produk = DB::table('produk')->where('produk_id', $request->input('produk_id'))->first();
    
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
        
        // Redirect or return a response
    }
    


    // public function tambahkeranjang()
    // {
    //     $this->db->from('produk')->where('produk_id', $this->input->post('produk_id'));
    //     $harga = $this->db->get()->row()->harga;
    //     $this->db->from('produk')->where('produk_id', $this->input->post('produk_id'));
    //     $stok_lama = $this->db->get()->row()->stok;
    //     $stok_sekarang = $stok_lama-$this->input->post('jumlah');
    //     $sub_total = $this->input->post('jumlah')*$harga;
    //     $data = array(
    //         'kode_penjualan' => $this->input->post('kode_penjualan'),
    //         'produk_id' => $this->input->post('produk_id'),
    //         'jumlah' => $this->input->post('jumlah'),
    //         'subtotal' => $sub_total,
    //     );
    //     $this->db->insert('penjualan',$data);
    //     $data2 = array('stok' => $stok_sekarang );
    //     $where = array( 'produk_id' => $this->input->post('produk_id'));
    //     $this->db->update('produk',$data2,$where);
    // }
    
    

    // public function transaksi($pelanggan_id)
    // {
    //     date_default_timezone_set("Asia/Jakarta");
    //     $tanggal = date('Y-m');
    //     $jumlah = $this->db->count_all_results();
    //     $nota = date('ymd').$jumlah+1;

    //     $this->db->from('produk')->where('stok >' ,0)->order_by('nama','ASC');
    //     $produk = $this->db->get()->result_array();
    //     $namapelanggan = $this->db->get()->row()->nama;
   
    //         $this->db->from('detail_penjualan a');
    //         $this->db->join('produk b',a.produk_id=b.produk_id','left');
    //         $this->db->where('a.kode_penjualan',$nota);
    //         $detail = $this->db->get()->result_array();
    //     return view('penjualan.transaksi', compact('produk','namapelanggan','nota'));
    // }

}


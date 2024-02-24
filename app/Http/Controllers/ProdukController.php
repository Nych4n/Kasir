<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }
    
    public function store(Request $request)
    {
        $produk = Produk::create([          
            'kode_produk' => Produk::generateKodeProduk(),
            'Namaproduk' => $request->Namaproduk,
            'Harga' => $request->Harga,
            'Stok' => $request->Stok
        ]);
        
        if ($produk) {
            //redirect dengan pesan sukses
            return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Di Simpan!!']);
        }else{
            //redirect dengan pesan eror
            return redirect()->route('produk.index')->with(['error' => 'Data Gagal Di Simpan !!']);
        }
    }
    
    public function show($id)
    {
        //
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    { 
        $this->validate($request, [
           'Namaproduk' => 'required',
           'Harga'      => 'required',
           'Stok'       => 'required'
        ]);
        
        $produk = Produk::findOrFail($produk->produk_id);
        
        $produk->update([
            'Namaproduk' => $request->Namaproduk,
            'Harga' => $request->Harga,
            'Stok' => $request->Stok
        ]);
         
        if ($produk) {
            //redirect dengan pesan sukses
            return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Di Update!!']);
        }else{
            //redirect dengan pesan eror
            return redirect()->route('produk.index')->with(['error' => 'Data Gagal Di Update !!']);
        }
        
    }
    
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        if ($produk) {
            //redirect dengan pesan sukses
            return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Di Hapus!!']);
        }else{
            //redirect dengan pesan eror
            return redirect()->route('produk.index')->with(['error' => 'Data Gagal Di Hapus !!']);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $pelanggan = Pelanggan::create([
           'nama' => $request->nama, 
           'Alamat' => $request->Alamat, 
           'NomorTelepon' => $request->NomorTelepon
        ]);

        if($pelanggan){
            return redirect()->route('pelanggan.index')->with(['Success', 'Pelanggan Berhasil Di Simpan']);
        }else{
            return redirect()->route('pelanggan.index')->with(['Error','Pelanggan Gagal Di Simpan']);
        }
    }

    public function show()
    {
        //
    }

    public function Edit()
    {
        
    }

    public function Update()
    {
        
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        if ($pelanggan) {
            //redirect dengan pesan sukses
            return redirect()->route('pelanggan.index')->with(['Success' => 'Data Berhasil Di Hapus!!']);
        }else{
            //redirect dengan pesan eror
            return redirect()->route('pelanggan.index')->with(['Error' => 'Data Gagal Di Hapus !!']);
        }
    }
}
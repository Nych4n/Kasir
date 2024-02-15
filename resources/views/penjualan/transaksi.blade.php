@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{-- Bagian pemilihan produk --}}
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pilih Produk</h5>
                    <small class="text-muted float-end">(Pilih Yang sesuai)</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('penjualan.tambahkeranjang') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Produk</label>
                                <input type="hidden" name="kode_penjualan" value="{{ $nota }}">
                                <select name="produk_id" class="form-control">
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->produk_id }}">{{ $item->Namaproduk }}</option>                                
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="basic-default-company" placeholder="Jumlah Barang" />
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                {{-- Bagian bayar --}}
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">#</h5>
                    <small class="text-muted float-end">(Pilih Yang sesuai)</small>
                    </div>
                    <div class="card-body">
                    <form action="">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default">Nota</label>
                            <input type="text" class="form-control" name="kode_penjualan"  value="{{ $nota }}" readonly />
                            <input type="hidden" class="form-control" name="pelanggan_id" value="{{ $namapelanggan }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama" value="{{ is_object($namapelanggan) ? $namapelanggan->nama : $namapelanggan }}" readonly />
                        </div>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                {{-- Bagian tabel detail penjualan --}}    
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Produk Yang di Pilih</h5>
                    <small class="text-muted float-end">(Pilih Yang sesuai)</small>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Produk</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-o">
                                <?php $no=1; ?>
                               @foreach ($detail as $item)
                                   <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->kode_produk }}</td>
                                        <td>{{ $item->Namaproduk }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ number_format($item->Harga)  }}</td>
                                        <td>{{ number_format($item->jumlah * $item->Harga )}}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" action="{{ route('hapus', ['detailID' => $item->detail_id, 'produkID' => $item->produk_id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>                                            
                                        </td>
                                   </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>

@endsection
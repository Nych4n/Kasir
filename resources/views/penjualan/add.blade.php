@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Form Penjualan</h6>
        <div class="dropdown no-arrow">
            <a class="btn btn-primary btn-sm" href="/penjualan" role="button">
               kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="" method="POST"> 
                @csrf
                <div class="mb-3 row">
                    <label  class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" name="Tanggalproduk" class="form-control  @error('tanggal') is-invalid @enderror" placeholder="Masukkan Tanggal" >
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label  class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <select name="Namaproduk" id="" class="form-control  @error('name') is-invalid @enderror" >
                            @foreach ($produk as $item)
                            <option value="">{{ $item->Namaproduk }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label  class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="number" name="JumlahProduk" class="form-control  @error('Jumlah') is-invalid @enderror" placeholder="Masukkan Jumlah" >
                        @error('Jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-end ">
                    <div class="col-auto d-flex">
                    <button type="submit" class="btn btn-primary mb-3 mx-1">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody> 
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pelanggan </h6>
        <div class="dropdown no-arrow">
            <a class="btn btn-primary btn-sm" href="{{ route('pelanggan.index') }}">
                < kembali </a>
        </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Input gagal.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control  @error('name') is-invalid @enderror"
                        placeholder="Masukkan Nama">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" name="Alamat" class="form-control  @error('Alamat') is-invalid @enderror"
                        placeholder="Masukkan Alamat">
                    @error('Alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">NomorTelepon</label>
                <div class="col-sm-10">
                    <input type="text" name="NomorTelepon"
                        class="form-control  @error('NomorTelepon') is-invalid @enderror" placeholder="+62">
                    @error('NomorTelepon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-end ">
                <div class="col-auto d-flex">
                    <button type="submit" class="btn btn-primary mb-3 mx-1">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
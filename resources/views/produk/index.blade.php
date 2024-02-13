@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Produk</h6>
        <div class="dropdown no-arrow">
            <a class="btn btn-primary btn-sm" href="{{ route('produk.create') }}" role="button" id="dropdownMenuLink">
               Tambah Produk
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php $no = 1; ?>
                    @foreach ($produk as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->Namaproduk }}</td>
                        <td>RP.{{ number_format($item->Harga ) }}</td>
                        <td>{{ $item->Stok }}</td>
                        <td>
                            <form action="{{ route('produk.destroy', $item->produk_id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin?');">
                                <a class="btn btn-success " href="{{ route('produk.edit', $item->produk_id) }}" 
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger " type="submit"
                                ><i class="bx bx-trash me-1"></i> Delete</button
                                >
                            </form>
                        </td>         
                    </tr>                   
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
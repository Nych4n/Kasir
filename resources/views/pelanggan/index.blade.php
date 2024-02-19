@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Pelanggan</h6>
        <div class="dropdown no-arrow">
            <a class="btn btn-primary btn-sm" href="{{ route('pelanggan.create') }}" role="button" id="dropdownMenuLink">
                Tambah Pelanggan
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
                        <th>Alamat</th>
                        <th>NomorTelepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($pelanggan as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->Alamat }}</td>
                        <td>{{ $item->NomorTelepon }}</td>
                        <td>
                            <form action="{{ route('pelanggan.destroy', $item->Pelanggan_id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin?');">
                                <a class="btn btn-warning " href="{{ route('pelanggan.edit', $item->Pelanggan_id) }}" 
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
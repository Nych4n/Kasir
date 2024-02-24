@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Penjualan</h6>
        <div class="dropdown no-arrow">
            <!-- Button  modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Penjualan
            </button>
                
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Nota</th>
                        <th>Nominal</th>
                        <th>Pelanggan</th>
                        <th>Aksi</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody> 
                    <?php $no=1; ?> 
                    @foreach ($data['penjualan'] as $item1)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item1->kode_penjualan }}</td>
                        <td>{{ $item1->TotalHarga }}</td>
                        <td>{{ $item1->nama }}</td>
                        <td>
                            <form action="{{ Route('invoice', $item1->kode_penjualan) }}">
                                <button class="btn btn-warning">Cek</button>
                            </form>
                        </td>
                    </tr>
                @endforeach 
            
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <a href="/pelanggan/create" class="btn btn-primary mb-3">+ pelanggan</a>
                <div class="table-responsive text-nowrap">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>NomorTelepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-o">
                        <?php $no=1; ?>
                        @foreach ($pelanggan as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->Alamat }}</td>
                            <td>{{ $item->NomorTelepon }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('penjualan.transaksi', ['pelanggan_id' => $item->Pelanggan_id]) }}" 
                                ><i class="bx bx-edit-alt me-1"></i> Pilih</a>
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
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Invoice
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <strong>From</strong><br>
                Rembulan Bintang<br>
                Jl.Selamet Riyadi No.02 Laweyan,Jakarta Timur<br>
                Phone: (0872) 776281<br>
                Email: Rembulan@gmail.com
            </div>
            <div class="col-sm-4 invoice-col">
                @foreach ($penjualan as $item)
                    <strong>To</strong><br>
                        {{ $item->nama }}<br>
                    {{ $item->Alamat }}<br>
                    Contact Person: {{ $item->NomorTelepon }}
                @endforeach
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Nomor Nota #{{ $nota }}</b><br>
            </div>
        </div>

        <!-- Invoice table -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total=0; $no=1; ?>
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->kode_produk }}</td>
                                <td>{{ $item->Namaproduk }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ number_format($item->Harga)  }}</td>
                                <td>{{ number_format($item->jumlah * $item->Harga )}}</td>
                            </tr>                            
                        @endforeach
                    </tbody>
                    <tfoot class="table-border-bottom-0">    
                        <?php $total += $item->jumlah * $item->Harga; ?>
                        <tr>
                            <th colspan="5"> Total Harga </th>
                            <th colspan=""> Rp. {{number_format($total) }}</th>
                        </tr>
                        <tr>
                            <th colspan="5"> Bayar </th>
                            <th colspan=""> Rp. {{ number_format($pembayaran) }}</th>
                        </tr>
                        <tr>
                            <th colspan="5"> Kembalian </th>
                            <?php  $kembalian= $pembayaran-$total; ?>
                            <th colspan=""> Rp. {{number_format($kembalian) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row justify-content-start">
            <a href="/penjualan" class="btn btn-primary mb-3 mr-2">< Back</a>
            <a href="/cetak/{ $nota }" class="btn btn-danger mb-3"> 
                <i class="fas fa-print fa-sm fa-fw mr-2 text-gray-400"></i>
                Print
            </a>
        </div>
    </div>
   
  
</div>
@endsection

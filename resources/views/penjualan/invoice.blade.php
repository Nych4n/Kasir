<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .from-address, .to-address, .invoice-number {
            width: 30%;
            padding-right: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <strong>From</strong><br>
                Rembulan Bintang<br>
                Jl.Selamet Riyadi No.02 Laweyan,Jakarta Timur<br>
                Phone: (0872) 776281<br>
                Email: Rembulan@gmail.com
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Nomor Nota #{{ $nota }}</b><br>
                @foreach ($penjualan as $item2)
                <b>Tanggal : {{ $item2->tgl_penjualan }}</b>                    
                @endforeach
            </div>
        </div>        

        <!-- Invoice table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; $no = 1; ?>
                @foreach ($detail as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->kode_produk }}</td>
                        <td>{{ $item->Namaproduk }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ 'Rp. ' . number_format($item->Harga) }}</td>
                        <td>{{ 'Rp. ' . number_format($item->jumlah * $item->Harga) }}</td>
                    </tr>                               
                    <?php $total += $item->jumlah * $item->Harga; ?>                         
                @endforeach
            </tbody>
        </table>

        <div class="invoice-total">
            <p><strong>Total Harga:</strong> Rp. {{ number_format($total) }}</p>
            @foreach ($penjualan as $item1)
            <p><strong>Bayar:</strong> Rp. {{ number_format($item1->pembayaran) }}</p>   
            <?php  $kembalian= $item1->pembayaran-$total; ?>
            <p><strong>Kembalian:</strong> Rp. {{ number_format($kembalian) }}</p>             
            @endforeach
        </div>
        
        {{-- <div class="col-sm-4 invoice-col">
            @foreach ($penjualan as $item)
                <strong>To</strong><br>
                Nama            :{{ $item->nama }}<br>
                Alamat          :{{ $item->Alamat }}<br>
                Contact Person  : {{ $item->NomorTelepon }}
            @endforeach
        </div> --}}
    </div>
</body>
</html>

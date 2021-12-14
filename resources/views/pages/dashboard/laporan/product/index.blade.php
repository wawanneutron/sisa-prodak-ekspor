<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ public_path('/stisla-master/assets/css/bootstrap.min.css') }}" >

    <title>Laporan Product</title>
</head>
<body>
    <div class="text-center mb-5">Data Laporan Product PT. Mayora Tbk.</div>
    <div class="table-responsive" style="font-size: 13px">
        <table class="table table-hover table-bordered table-md">
            <tr class=" table-active">
                <th>No</th>
                <th>No PO</th>
                <th>Nama Barang</th>
                <th>Export Country</th>
                <th>Tgl Export</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
            @forelse ($data as $index => $product)
            <tr>
                <td>{{ $index +1 }}</td>
                <td>{{ $product->no_po }}</td>
                <td>{{ $product->nama_barang }}</td>
                <td>{{ $product->export_country }}</td>
                <td>{{ $product->tgl_export }}</td>
                <td>{{ $product->qty }}</td>
                <td>
                    <div class="badge badge-success">{{ $product->status }}</div>
                </td>
            </tr>
            @empty
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Data belum tersedia
                    </div>
                </div>
            @endforelse
        </table>
        <div class="footer mt-5 text-right">
            <div class="text-header">Mengetahui</div>
                <img src="{{ public_path('/storage/ttd1.png') }}" width="90" alt="">
            <div class="text-header">{{ auth()->user()->role }}</div>
        </div>
        <div class="">
            <span style=" font-size: 12px;">
            dicetak tanggal
            {{ Carbon\Carbon::now()->toDateTimeString() }}
        </span>
        </div>
    </div>
</body>
</html>
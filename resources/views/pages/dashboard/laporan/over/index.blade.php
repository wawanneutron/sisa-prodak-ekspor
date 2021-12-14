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
    <div class="text-center mb-5">Data Laporan Barang Lebih Sisa Ekspor PT. Mayora Tbk.</div>
    <div class="table-responsive" style="font-size: 13px">
        <table class="table table-hover table-bordered table-md">
            <tr class=" table-active">
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Quantity</th>
                <th>Kondisi Barang</th>
            </tr>
            @forelse ($data as $index => $product)
            <tr>
                <td>{{ $index +1 }}</td>
                <td>{{ $product->over_product_id }}</td>
                <td>
                    <ul>
                        @foreach ($product->products as $item)
                            <li> {{ $item->nama_barang }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $product->qty_over }}</td>
                <td>
                    @if ($product->kondisi == 'bagus')
                        <div class="badge badge-success">{{ $product->kondisi }}</div>
                    @elseif($product->kondisi == 'rusak')
                        <div class="badge badge-danger">{{ $product->kondisi }}</div>
                    @else
                        <div class="badge badge-primary">{{ $product->kondisi }}</div>
                    @endif
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
            <br> <br> <br>
            <div class="text-header mt-4">{{ auth()->user()->role }}</div>
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
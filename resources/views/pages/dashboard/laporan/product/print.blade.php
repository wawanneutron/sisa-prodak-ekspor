<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ public_path('/stisla-master/assets/css/bootstrap.min.css') }}" >

    <title>Print detail product</title>
  </head>
  <body>
    <div class="table-detail-customer mb-5">
        <!-- Page Heading -->
        <h1 class="h5 mb-2 text-gray-800"><strong>{{ $product->no_po }}</strong> </h1>

        <body style=" font-size: 18px;">
            <table class="table table-bordered">
                <tr>
                    <td width="25%">
                        Nama Produk
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $product->nama_barang }}</td>
                </tr>
                <tr>
                    <td width="25%">
                        Satuan
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $product->satuan }}</td>
                </tr>
                <tr>
                    <td width="25%">
                        Quantity
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $product->qty }}</td>
                </tr>
                <tr>
                    <td width="25%">
                        Status
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $product->status }}</td>
                </tr>
                <tr>
                    <td>Tanggal Produksi</td>
                    <td>:</td>
                    <td>{{ $product->tgl_produksi }}</td>
                </tr>
                <tr>
                    <td>Tanggal Export</td>
                    <td>:</td>
                    <td>{{ $product->tgl_export }}</td>
                    </td>
                </tr>
                <tr>
                    <td>Export Country</td>
                    <td>:</td>
                    <td>{{ $product->export_country }}</td>
                </tr>
                <tr>
                    <td>Expired</td>
                    <td>:</td>
                    <td>
                       {{ $product->expired }}
                    </td>
                </tr>
            </table>
            <div class="footer mt-5 text-right">
                <div class="text-header">Mengetahui</div>
                    <img src="{{ public_path('/storage/ttd1.png') }}" width="90" alt="">
                <div class="text-header">Admin Gudang</div>
                <span style=" font-size: 12px;">dicetak tanggal
                    {{ Carbon\Carbon::now()->toDateTimeString() }}</span>
            </div>
        </body>
    </div>
  </body>
</html>


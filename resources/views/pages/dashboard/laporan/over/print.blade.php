<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ public_path('/stisla-master/assets/css/bootstrap.min.css') }}" >

    <title>Print detail barang lebih</title>
  </head>
  <body>
    <div class="table-detail mb-5">
        <!-- Page Heading -->
        <h1 class="h5 mb-2 text-gray-800"><strong>Detail Barang Lebih</strong> </h1>

        <body>
            <table class="table table-bordered">
                <tr>
                    <td width="25%">
                        Kode Barang Lebih
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $product->over_product_id }}</td>
                </tr>
                <tr>
                    <td width="25%">
                        Qty Barang Lebih
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $product->qty_over }}</td>
                </tr>
                <tr>
                    <td width="25%">
                        Catatan Barang Lebih
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $product->note }}</td>
                </tr>
                <tr>
                    <td>Tanggal Input</td>
                    <td>:</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
                <tr>
                    <td>Kondisi Barang</td>
                    <td>:</td>
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
            </table>
            <table class="table table-hover table-bordered table-md">
                <tr class=" table-active">
                    <th>No</th>
                    <th>No PO</th>
                    <th>Nama Barang</th>
                    <th>Export Country</th>
                    <th>Tgl Export</th>
                </tr>
                @forelse ($product->products as $index => $item)
                <tr>
                    <td>{{ $index +1 }}</td>
                    <td>{{ $item->no_po }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->export_country }}</td>
                    <td>{{ $item->tgl_export }}</td>
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
            <div class="mt-5">
                <div class="float-right">
                    <div class="text-header">Mengetahui</div>
                    <br> <br> <br>
                    <div class="text-header ">{{ auth()->user()->role }}</div>
                </div>
                <div>
                    <span style=" font-size: 12px;">dicetak tanggal
                        {{ Carbon\Carbon::now()->toDateTimeString() }}</span>
                </div>
            </div>
        </body>
    </div>
  </body>
</html>


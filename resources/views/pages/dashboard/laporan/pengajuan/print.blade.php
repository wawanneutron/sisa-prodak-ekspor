<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ public_path('/stisla-master/assets/css/bootstrap.min.css') }}" >
   
    <title>Detail Pengajuan</title>
  </head>
  <body>
    <div style=" font-size: 12px; float: right;">
        <span>dicetak tanggal
            {{ Carbon\Carbon::now()->toDateTimeString() }}</span>
    </div>
    <div class="table-detail mb-5">
        <!-- Page Heading -->
        <h1 class="h5 mb-2 text-gray-800"><strong>Detail Pengajuan {{ $data->kd_pengajuan }}</strong> </h1>
        <body>
            <table class="table table-bordered">
                <tr>
                    <td width="25%">
                        Catatan Pengajuan
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $data->catatan }}</td>
                </tr>
                <tr>
                    <td width="25%">
                        Qty Barang Lebih
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $data->overProduct->qty_over }}</td>
                </tr>
                <tr>
                    <td width="25%">
                        Status Pengajuan
                    </td>
                    <td width="1%">:</td>
                    <td>
                        @if ($data->kondisi == 'approved')
                            <div class="badge badge-success mt-2">Disetujui Oleh Kepala Gudang</div>
                        @elseif($data->kondisi == 'not checked')
                            <div class="badge badge-warning mt-2">Belum Disetujui</div>
                        @elseif($data->kondisi == 'pending')
                            <div class="badge badge-primary mt-2">Disetujui Oleh SPV</div>
                        @else
                            <div class="badge badge-danger mt-2">Tidak Disetujui</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="25%">
                        Kode Barang Lebih
                    </td>
                    <td width="1%">:</td>
                    <td>{{ $data->overProduct->over_product_id }}</td>
                </tr>
                <tr>
                    <td>Catatan Barang Lebih</td>
                    <td>:</td>
                    <td>{{ $data->overProduct->note }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan</td>
                    <td>:</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td>Kondisi Barang</td>
                    <td>:</td>
                    <td>
                        @if ($data->overProduct->kondisi == 'bagus')
                            <div class="badge badge-success">{{ $data->overProduct->kondisi }}</div>
                        @elseif($data->overProduct->kondisi == 'rusak')
                            <div class="badge badge-danger">{{ $data->overProduct->kondisi }}</div>
                        @else
                            <div class="badge badge-primary">{{ $data->overProduct->kondisi }}</div>
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
                @forelse ($data->overProduct->products as $index => $item)
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
            <table class="float-right">
                <tr class="text-center table-active">
                    @if ($data->kondisi == 'approved')
                        <td class="mr-5">
                            <div class="text-header">Mengetahui</div>
                                <img src="{{ public_path('/storage/ttd1.png') }}" width="90" alt="">
                            <div class="text-header ">Admin Gudang</div>
                        </td>
                        <td>
                            <div class="text-header">Mengetahui</div>
                                <img src="{{ public_path('/storage/ttd3.png') }}" width="75" alt="">
                            <div class="text-header ">Supervisor</div>
                        </td>
                        <td class="ml-5">
                            <div class="text-header">Mengetahui</div>
                                <img src="{{ public_path('/storage/ttd2.png') }}" width="90" alt="">
                            <div class="text-header ">Kepala Gudang</div>
                        </td>
                    @elseif($data->kondisi == 'not checked')
                        <td class="mr-5">
                            <div class="text-header">Mengetahui</div>
                                <img src="{{ public_path('/storage/ttd1.png') }}" width="90" alt="">
                            <div class="text-header ">Admin Gudang</div>
                        </td>
                        <td>
                            <div class="text-header">Mengetahui</div>
                                <br><br><br>
                            <div class="text-header ">Supervisor</div>
                        </td>
                        <td class="ml-5">
                            <div class="text-header">Mengetahui</div>
                                <br><br><br>
                            <div class="text-header ">Kepala Gudang</div>
                        </td>
                    @elseif($data->kondisi == 'pending')
                        <td class="mr-5">
                            <div class="text-header">Mengetahui</div>
                                <img src="{{ public_path('/storage/ttd1.png') }}" width="90" alt="">
                            <div class="text-header ">Admin Gudang</div>
                        </td>
                        <td>
                            <div class="text-header">Mengetahui</div>
                                <img src="{{ public_path('/storage/ttd3.png') }}" width="75" alt="">
                            <div class="text-header ">Supervisor</div>
                        </td>
                        <td class="ml-5">
                            <div class="text-header">Mengetahui</div>
                                <br><br><br>
                            <div class="text-header ">Kepala Gudang</div>
                        </td>
                    @else
                        <td class="mr-5">
                            <div class="text-header">Mengetahui</div>
                                <br><br><br>
                            <div class="text-header ">Admin Gudang</div>
                        </td>
                        <td>
                            <div class="text-header">Mengetahui</div>
                                <br><br><br>
                            <div class="text-header ">Supervisor</div>
                        </td>
                        <td class="ml-5">
                            <div class="text-header">Mengetahui</div>
                                <br><br><br>
                            <div class="text-header ">Kepala Gudang</div>
                        </td>
                    @endif
                </tr>
            </table>
            <div class="note" style="margin-top: 150px;">
                <div class="">Note:</div>
                @if ($data->kondisi == 'pending')
                    <div class="">Pengajuan ini belum mendapatkan persetujuan oleh kepala gudang</div>
                @elseif($data->kondisi == 'not checked')
                    <div class="">Pengajuan ini belum mendapatkan persetujuan oleh supervisor dan kepala gudang</div>
                @elseif($data->kondisi == 'approved')
                    <div class="">Pengajuan ini sudah disetujui, dan sudah mendapatkan persetujuan dari ybs.</div>
                @else
                    <div class="">Pengajuan ini tidak mendapatkan persetujuan</div>
                @endif
            </div>
        </body>
    </div>
  </body>
</html>


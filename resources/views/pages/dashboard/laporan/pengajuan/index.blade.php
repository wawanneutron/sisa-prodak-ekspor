<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ public_path('/stisla-master/assets/css/bootstrap.min.css') }}" >

    <title>Laporan Pengajuan Barang Lebih</title>
</head>
<body>
    <div class="text-center mb-5">Data Laporan Pengajuan Barang Lebih Sisa Ekspor <br> PT. Mayora Tbk.</div>
    <div class="table-responsive" style="font-size: 13px">
        <table class="table table-hover table-bordered table-md">
            <tr class=" table-active">
                <th>No</th>
                <th>Kode Pengajuan</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
            @forelse ($data as $index => $item)
            <tr>
                <td>{{ $index +1 }}</td>
                <td>{{ $item->kd_pengajuan }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                        @if ($item->kondisi == 'approved')
                            <div class="badge badge-success">Disetujui Oleh Kepala Gudang</div>
                        @elseif($item->kondisi == 'not checked')
                            <div class="badge badge-warning">Belum Disetujui</div>
                        @elseif($item->kondisi == 'pending')
                            <div class="badge badge-primary">Disetujui Oleh SPV</div>
                        @else
                            <div class="badge badge-danger">Tidak Disetujui</div>
                        @endif
                </td>
                <td>
                    {{ $item->catatan }}
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
@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pengajuan Barang Lebih</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="
                            @switch(auth()->user()->role)                                                                                                                                             
                                @case('Admin Gudang')
                                    {{ route('statistik-admin') }}
                                @break
                                @case('SPV')
                                    {{ route('statistik-spv') }}
                                @break
                                @case('Kepala Gudang')
                                    {{ route('statistik-kepala') }}
                                @break

                                @default
                                    {{ route('login') }}
                            @endswitch
                            ">Dashboard
                        </a>
                    </div>
                    <div class="breadcrumb-item">Products</div>
                </div>
            </div>
            <div class="section-body">
                <div class=" float-right d-md-block d-none">
                    <a href="#" class=" btn btn-info btn-sm">
                        <i class="fas fa-file-download mr-2"></i>Download Laporan
                    </a>
                </div>
                <div class=" d-md-none d-sm-block">
                    <a href="#" class=" btn btn-info btn-sm"><i class="fas fa-file-download mr-2">
                        </i>Download Laporan
                    </a>
                </div>
                <h2 class="section-title">Data Pengajuan</h2>
                    <p class="section-lead">Ini adalah data-data pengajuan</p>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @switch(auth()->user()->role)
                                    @case('Admin Gudang')
                                        <a href="#" class=" btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                            <i class="fa fa-plus mr-2"></i>Tambah Pengajuan
                                        </a>
                                    @break
                                    @case('SPV')
                                    @break
                                    @case('Kepala Gudang')
                                    @break

                                @endswitch
                            </div>
                            <div class="card-header" style="margin-top: -30px;">
                                <h4></h4>
                                <div class="card-header-form">
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="cari berdasarkan kode">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-md">
                                        <tr class=" table-active">
                                            <th>No</th>
                                            <th class=" col-2">Kode Pengajuan</th>
                                            <th class="col-2">Tanggal Pengajuan</th>
                                            <th>Status</th>
                                            <th class="col-3">Catatan</th>
                                            <th class="col-2">Action</th>
                                        </tr>
                                        @forelse ($aprovalProducts as $index => $product)
                                        <tr>
                                            <td>{{ ++$index + ($aprovalProducts->currentPage() - 1) * $aprovalProducts->perPage() }}</td>
                                            <td>{{ $product->kd_pengajuan }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>
                                                @if ($product->kondisi == 'approved')
                                                    <div class="badge badge-success">Disetujui Oleh Kepala Gudang</div>
                                                @elseif($product->kondisi == 'not checked')
                                                    <div class="badge badge-warning">Belum Disetujui</div>
                                                @elseif($product->kondisi == 'pending')
                                                    <div class="badge badge-primary">Disetujui Oleh SPV</div>
                                                @else
                                                    <div class="badge badge-danger">Tidak Disetujui</div>
                                                @endif
                                            </td>
                                            <td>{{ $product->catatan }}</td>
                                            @switch(auth()->user()->role)
                                                @case('Admin Gudang')
                                                    <td>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalView{{ $product->id }}">
                                                            <i class=" fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditPengajuan{{ $product->id }}">
                                                            <i class=" fa fa-pencil-alt"></i>
                                                        </a>
                                                        <button onclick="Delete(this.id)" id="{{ $product->id }}" class="btn btn-sm btn-danger">
                                                            <i class=" fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                @break
                                                @case('SPV')
                                                    <td>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalView{{ $product->id }}">
                                                            <i class=" fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalNonAdmin{{ $product->id }}">
                                                            <i class=" fa fa-pencil-alt"></i>
                                                        </a>
                                                    </td>
                                                @break
                                                @case('Kepala Gudang')
                                                    <td>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalView{{ $product->id }}">
                                                            <i class=" fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalNonAdmin{{ $product->id }}">
                                                            <i class=" fa fa-pencil-alt"></i>
                                                        </a>
                                                    </td>
                                                @break
                                                @default
                                                    
                                            @endswitch
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
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    {{-- pagination-costom --}}
                                    @if ($aprovalProducts->hasPages())
                                        <ul class="pagination" role="navigation">
                                            {{-- Previous Page Link --}}
                                            @if ($aprovalProducts->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true"
                                                    aria-label="@lang('pagination.previous')">
                                                    <span class="page-link" aria-hidden="true"><i
                                                        class="fas fa-chevron-left"></i></span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $aprovalProducts->previousPageUrl() }}"
                                                    rel="prev"
                                                    aria-label="@lang('pagination.previous')"><i
                                                        class="fas fa-chevron-left"></i></a>
                                                </li>
                                            @endif
        
                                            <?php
                                            $start = $aprovalProducts->currentPage() - 1; // show 3 pagination links before current
                                            $end = $aprovalProducts->currentPage() + 1; // show 3 pagination links after current
                                            if ($start < 1) {
                                                $start = 1; // reset start to 1
                                                $end += 1;
                                            }
                                            if ($end >= $aprovalProducts->lastPage()) {
                                                $end = $aprovalProducts->lastPage();
                                            } // reset end to last page
                                            ?>
        
                                            @if ($start > 1)
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $aprovalProducts->url(1) }}">{{ 1 }}</a>
                                                </li>
                                                @if ($aprovalProducts->currentPage() != 4)
                                                    {{-- "Three Dots" Separator --}}
                                                    <li class="page-item disabled" aria-disabled="true">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                            @endif
                                            @for ($i = $start; $i <= $end; $i++)
                                                <li
                                                    class="page-item {{ $aprovalProducts->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link"
                                                    href="{{ $aprovalProducts->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            @if ($end < $aprovalProducts->lastPage())
                                                @if ($aprovalProducts->currentPage() + 3 != $aprovalProducts->lastPage())
                                                    {{-- "Three Dots" Separator --}}
                                                    <li class="page-item disabled" aria-disabled="true">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $aprovalProducts->url($aprovalProducts->lastPage()) }}">{{ $aprovalProducts->lastPage() }}</a>
                                                </li>
                                            @endif
        
                                            {{-- Next Page Link --}}
                                            @if ($aprovalProducts->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $aprovalProducts->nextPageUrl() }}" rel="next"
                                                    aria-label="@lang('pagination.next')"><i
                                                        class="fas fa-chevron-right"></i></a>
                                                </li>
                                            @else
                                                <li class="page-item disabled" aria-disabled="true"
                                                    aria-label="@lang('pagination.next')">
                                                    <span class="page-link" aria-hidden="true"><i
                                                        class="fas fa-chevron-right"></i></span>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- modal tambah --}}
    <div class="modal fade"  role="dialog" id="modalTambah" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('dashboard.pengajuan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Pengajuan Barang Lebih</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pilih Barang Lebih</label>
                                            <select name="approvals" class="form-control select2  @error('approvals') is-invalid @enderror" id="approvals">
                                        </select>
                                        @error('approvals')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tambahkan Catatan</label>
                                        <textarea name="catatan" id="note" class="form-control @error('note') is-invalid @enderror" placeholder="note:" style="height: 150px !important;"></textarea>
                                        @error('catatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Batal</button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fa fa-redo mr-1"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-paper-plane mr-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit admin gudang--}}
    @foreach ($aprovalProducts as $pengajuan)
        <div class="modal fade" role="dialog" id="modalEditPengajuan{{ $pengajuan->id }}" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('dashboard.pengajuan.update', $pengajuan->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Form Pengajuan Barang Lebih <br>
                                {{ $pengajuan->kd_pengajuan }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pilih Barang Lebih</label>
                                                <select name="editAproval" class="form-control select2  @error('editAproval') is-invalid @enderror" id="editAproval{{ $pengajuan->id }}">
                                            </select>
                                            @error('editAproval')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tambahkan Catatan</label>
                                            <textarea name="catatan" id="note" class="form-control @error('note') is-invalid @enderror" placeholder="note:" style="height: 150px !important;">{{ $pengajuan->catatan }}</textarea>
                                            @error('catatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Batal</button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-redo mr-1"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane mr-1"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @push('select-edit-script')
            <script type="text/javascript">
                $('#editAproval{!! $pengajuan->id !!}').select2({
                    ajax: {
                        url: 'http://127.0.0.1:8000/admin-gudang/ajax/over-products/search',
                        processResults: function(data) {
                            return {
                                results: data.map(function(item) {
                                    return {
                                        id: item.id,
                                        text: item.over_product_id + ' - ' + item.kondisi
                                    }
                                })
                            }
                        }
                    }
                });
                /* single selected data */
                var data = {!! $pengajuan->overProduct !!}

                var option = new Option(data.over_product_id + ' - ' + data.kondisi, true, true);
                $('#editAproval{!! $pengajuan->id !!}').append(option).trigger('change');
               
            </script>
        @endpush
    @endforeach

    {{-- modal edit spv & kepala--}}
    @foreach ($aprovalProducts as $pengajuan)
        <div class="modal fade" role="dialog" id="modalNonAdmin{{ $pengajuan->id }}" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="
                            @switch(auth()->user()->role)
                                @case('SPV')
                                        {{ route('spv-pengajuan-update', $pengajuan->id) }}
                                    @break
                                @case('Kepala Gudang')
                                        {{ route('kepala-pengajuan-update', $pengajuan->id) }}
                                    @break
                                @default
                            @endswitch
                        " method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Status Pengajuan Barang Lebih <br>
                                {{ $pengajuan->kd_pengajuan }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- 'not checked','pending','approved','not approved' --}}
                                        @switch(auth()->user()->role)
                                            @case('SPV')
                                                <select name="kondisi" id="kondisi" class=" form-control @error('kondisi') is-invalid @enderror">
                                                    <option selected disabled>--Update Status Persetujuan--</option>
                                                    <option value="pending">Disetujui Oleh Supervisor</option>
                                                    <option value="not approved">Tidak Disetujui</option>
                                                </select>
                                                @error('kondisi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                @break
                                            @case('Kepala Gudang')
                                                <select name="kondisi" id="kondisi" class=" form-control @error('kondisi') is-invalid @enderror">
                                                    <option selected disabled>--Update Status Persetujuan--</option>
                                                    <option value="approved">Disetujui Oleh Kepala Gudang</option>
                                                    <option value="not approved">Tidak Disetujui</option>
                                                </select>
                                                @error('kondisi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                @break
                                            @default
                                                
                                        @endswitch
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-redo mr-1"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane mr-1"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    
     {{-- modal view --}}
    @foreach ($aprovalProducts as $data)
        <div class="modal fade" id="modalView{{ $data->id }}" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="z-index: 99;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- view detail pengajuian --}}
                        <section class="section">
                            <div class="section-body">
                                <div class="invoice" style="margin-bottom: 0px !important; padding-bottom: 10px !important;">
                                <div class="invoice-print">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="invoice-title">
                                                <h2>Detail Pengajuan</h2>
                                                <div class=" text-black-50 h5">Barang Sisa Ekspor</div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-md-3">
                                                    <img src="{{ $data->getImage() }}" class="img-fluid" width="200" alt="photo barang lebih not found" title="photo barang lebih sisa ekspor" style=" border-radius: 8px;">
                                                </div>
                                                <div class="col-md-3">
                                                    <address>
                                                        <strong>Kode Pengajuan</strong><br>
                                                            {{ $data->kd_pengajuan }}<br><br>
                                                    </address>
                                                    <address>
                                                        <strong>Qty Barang Lebih</strong><br>
                                                            {{ !empty($data->overProduct->qty_over) ? $data->overProduct->qty_over . ' Karton'  : '' }} <br><br>
                                                    </address>
                                                    <address>
                                                        <strong>Status Pengajuan</strong> <br>
                                                        @if ($data->kondisi == 'approved')
                                                            <div class="badge badge-success mt-2">Disetujui Oleh Kepala Gudang</div>
                                                        @elseif($data->kondisi == 'not checked')
                                                            <div class="badge badge-warning mt-2">Belum Disetujui</div>
                                                        @elseif($data->kondisi == 'pending')
                                                            <div class="badge badge-primary mt-2">Disetujui Oleh SPV</div>
                                                        @else
                                                            <div class="badge badge-danger mt-2">Tidak Disetujui</div>
                                                        @endif
                                                        <br><br>
                                                    </address>
                                                </div>
                                                <div class="col-md-3 text-md-left">
                                                    <address>
                                                        <strong>Kode Barang Lebih</strong><br>
                                                            {{ !empty($data->overProduct->over_product_id) ? $data->overProduct->over_product_id : '' }}<br><br>
                                                    </address>
                                                    <address>
                                                        <strong>Catatan Barang Lebih</strong><br>
                                                            {{ !empty($data->overProduct->note) ? $data->overProduct->note : '' }}<br><br>
                                                    </address>
                                                    <address>
                                                        <strong>Tanggal Pengajuan</strong><br>
                                                            {{ $data->created_at }}<br><br>
                                                    </address>
                                                </div>
                                                <div class="col-md-3 text-md-left">
                                                    <address>
                                                        <strong>Kondisi Barang</strong><br>
                                                        <span class="d-none">{{ $dataItem = !empty($data->overProduct->kondisi) ? $data->overProduct->kondisi : '' }}</span>
                                                            @switch($dataItem)
                                                                @case('bagus')
                                                                        <div class="badge badge-success mt-2">{{ $dataItem }}</div>
                                                                    @break
                                                                @case('rusak')
                                                                        <div class="badge badge-danger mt-2">{{ $dataItem }}</div>
                                                                    @break
                                                                @case('expired')
                                                                        <div class="badge badge-primary mt-2">{{ $dataItem }}</div>
                                                                    @break
                                                                @default
                                                            @endswitch
                                                    </address>
                                                    <address>
                                                        <strong>Catatan Pengajuan</strong><br>
                                                            {{ $data->catatan }}<br><br>
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- print --}}
                            </div>
                        </section>
                        {{-- tabel product barang lebih --}}
                        <div class=" text-body text-bold mb-2" style="font-size: 18px">Tabel Detail Barang Lebih</div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-md">
                                <tr class=" table-active">
                                    <th>No</th>
                                    <th>No PO</th>
                                    <th>Nama Barang</th>
                                    <th>Negara Ekspor</th>
                                    <th>Satuan</th>
                                    <th>Tanggal Ekspor</th>
                                </tr>
                                @if (!empty($data->overProduct->products))
                                    
                                    @forelse ($data->overProduct->products as $index => $productOver)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $productOver->no_po }}</td>
                                            <td>{{ $productOver->nama_barang }}</td>
                                            <td>{{ $productOver->export_country }}</td>
                                            <td>{{ $productOver->satuan }}</td>
                                            <td>{{ $productOver->tgl_export }}</td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-warning alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                Tidak ada barang sisa exspor!, karena barang di <b>menu prodak</b> telah dihapus!
                                            </div>
                                        </div>
                                    @endforelse
                                @else
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                                <span>&times;</span>
                                            </button>
                                            Tidak ada barang sisa exspor!, karena <b>data barang lebih</b> telah dihapus!
                                        </div>
                                    </div>
                                @endif
                            </table>
                                {{-- <span><b>jumlah barang lebih {{ $item->overProducts->sum('qty_over') }} Karton</b></span> --}}
                        </div>
                        <div class="text-md-right mt-4">
                            <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach

    
    
@endsection



@push('addon-script')
    <script>
        //ajax delete switalert
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "YAKIN INGIN HAPUS?",
                text: "Menghapus data ini akan menghapus data yang saling terhubung!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route('dashboard.pengajuan.index') }}/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                } else {
                    return true;
                }
            })
        }

    </script>
@endpush

@push('select-script')
    {{-- script slect2 --}}
    <script type="text/javascript">
        $('#approvals').select2({
            // dropdownParent: "#modalTambah",
            ajax: {
                url: 'http://127.0.0.1:8000/admin-gudang/ajax/over-products/search',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.over_product_id + ' - ' + item.kondisi
                            }
                        })
                    }
                }
            }
        });
    </script>
@endpush


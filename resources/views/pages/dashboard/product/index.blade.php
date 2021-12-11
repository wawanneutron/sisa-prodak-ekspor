@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Products</h1>
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
                <h2 class="section-title">Data Produk</h2>
                    <p class="section-lead">Ini adalah data product hasil produksi, yang masuk ke gudang</p>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @switch(auth()->user()->role)
                                    @case('Admin Gudang')
                                        <a href="#" class=" btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                            <i class="fa fa-plus mr-2"></i>Tambah Product
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
                                            <input type="text" class="form-control" placeholder="cari berdasarkan no PO">
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
                                            <th>No PO</th>
                                            <th>Nama Barang</th>
                                            <th>Export Country</th>
                                            <th>Tgl Export</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($products as $index => $product)
                                        <tr>
                                            <td>{{ ++$index + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                            <td>{{ $product->no_po }}</td>
                                            <td>{{ $product->nama_barang }}</td>
                                            <td>{{ $product->export_country }}</td>
                                            <td>{{ $product->tgl_export }}</td>
                                            <td>{{ $product->qty }}</td>
                                            <td>
                                                <div class="badge badge-success">{{ $product->status }}</div>
                                            </td>
                                            @switch(auth()->user()->role)
                                                @case('Admin Gudang')
                                                    <td>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalView{{ $product->id }}">
                                                            <i class=" fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit{{ $product->id }}">
                                                            <i class=" fa fa-pencil-alt"></i>
                                                        </a>
                                                        <button onclick="Delete(this.id)" id="{{ $product->id }}" class="btn btn-sm btn-danger">
                                                            <i class=" fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                @break
                                                @case('SPV')
                                                    <td>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalView{{ $product->id }}">
                                                            <i class=" fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                @break
                                                @case('Kepala Gudang')
                                                    <td>
                                                        <a href="{{ $product->id }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalView{{ $product->id }}">
                                                            <i class=" fa fa-eye"></i>
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
                                    @if ($products->hasPages())
                                        <ul class="pagination" role="navigation">
                                            {{-- Previous Page Link --}}
                                            @if ($products->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true"
                                                    aria-label="@lang('pagination.previous')">
                                                    <span class="page-link" aria-hidden="true"><i
                                                        class="fas fa-chevron-left"></i></span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $products->previousPageUrl() }}"
                                                    rel="prev"
                                                    aria-label="@lang('pagination.previous')"><i
                                                        class="fas fa-chevron-left"></i></a>
                                                </li>
                                            @endif
        
                                            <?php
                                            $start = $products->currentPage() - 1; // show 3 pagination links before current
                                            $end = $products->currentPage() + 1; // show 3 pagination links after current
                                            if ($start < 1) {
                                                $start = 1; // reset start to 1
                                                $end += 1;
                                            }
                                            if ($end >= $products->lastPage()) {
                                                $end = $products->lastPage();
                                            } // reset end to last page
                                            ?>
        
                                            @if ($start > 1)
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $products->url(1) }}">{{ 1 }}</a>
                                                </li>
                                                @if ($products->currentPage() != 4)
                                                    {{-- "Three Dots" Separator --}}
                                                    <li class="page-item disabled" aria-disabled="true">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                            @endif
                                            @for ($i = $start; $i <= $end; $i++)
                                                <li
                                                    class="page-item {{ $products->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link"
                                                    href="{{ $products->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            @if ($end < $products->lastPage())
                                                @if ($products->currentPage() + 3 != $products->lastPage())
                                                    {{-- "Three Dots" Separator --}}
                                                    <li class="page-item disabled" aria-disabled="true">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
                                                </li>
                                            @endif
        
                                            {{-- Next Page Link --}}
                                            @if ($products->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $products->nextPageUrl() }}" rel="next"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTambah" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('dashboard.data-products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama_barang"
                                            class="form-control @error('nama_barang') is-invalid @enderror"
                                            value="{{ old('nama_barang') }}"
                                            placeholder="nama barang">
                                        @error('nama_barang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="number" name="qty"
                                            class="form-control @error('qty') is-invalid @enderror"
                                            value="{{ old('qty') }}" placeholder="qty product">
                                        @error('qty')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Satuan</label>
                                            <input type="text" disabled class="form-control" value="karton">
                                            <span style="font-size: 12px;" class="text-primary">
                                                <b>* ini adalah satuan default </b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Produksi</label>
                                        <input type="date" name="tgl_produksi" value="{{ old('tgl_produksi') }}"
                                            class="form-control @error('tgl_produksi') is-invalid @enderror">
                                        @error('tgl_produksi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Expired</label>
                                        <input type="date" name="expired" value="{{ old('expired') }}"
                                            class="form-control @error('expired') is-invalid @enderror">
                                        @error('expired')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Export</label>
                                        <input type="date" name="tgl_export" value="{{ old('tgl_export') }}"
                                            class="form-control @error('tgl_export') is-invalid @enderror">
                                        @error('tgl_export')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Export Country</label>
                                        <input type="text" name="export_country" value="{{ old('export_country') }}"
                                            class="form-control @error('export_country') is-invalid @enderror">
                                        @error('export_country')
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

    {{-- modal edit --}}
    @foreach ($products as $product)
        <div class="modal fade" id="modalEdit{{ $product->id }}" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('dashboard.data-products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data <br>
                                <span class=" text-black-50">{{ $product->no_po }}</span>
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
                                            <label>Nama Barang</label>
                                            <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror"
                                                value="{{ old('nama_barang') ?? $product->nama_barang }}"
                                                placeholder="nama barang">
                                            @error('nama_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="number" name="qty" class="form-control @error('qty') is-i nvalid @enderror"
                                                value="{{ old('qty') ?? $product->qty }}"
                                                placeholder="qty product">
                                            @error('qty')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <input type="text" disabled class="form-control" value="{{ $product->satuan }}">
                                                <span style="font-size: 12px;" class="text-primary">
                                                    <b>* ini adalah satuan default </b>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Produksi</label>
                                            <input type="date" name="tgl_produksi"
                                                value="{{ old('tgl_produksi') ?? $product->tgl_produksi }}"
                                                class="form-control @error('tgl_produksi') is-invalid @enderror">
                                            @error('tgl_produksi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Expired</label>
                                            <input type="date" name="expired" value="{{ old('expired') ?? $product->expired }}"
                                                class="form-control @error('expired') is-invalid @enderror">
                                            @error('expired')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Export</label>
                                            <input type="date" name="tgl_export" value="{{ old('tgl_export') ?? $product->tgl_export }}"
                                                class="form-control @error('tgl_export') is-invalid @enderror">
                                            @error('tgl_export')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Export Country</label>
                                            <input type="text" name="export_country" value="{{ old('export_country') ?? $product->export_country }}"
                                                class="form-control @error('export_country') is-invalid @enderror">
                                            @error('export_country')
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
                                <i class="fa fa-paper-plane mr-1"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal view --}}
    @foreach ($products as $product)
        <div class="modal fade" id="modalView{{ $product->id }}" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="z-index: 99;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="section">
                            <div class="section-body">
                                <div class="invoice">
                                <div class="invoice-print">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="invoice-title">
                                                <h2>Purchase Order</h2>
                                                <div class=" text-right h6">{{ $product->no_po }}</div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <address>
                                                        <strong>Nama Produk</strong><br>
                                                            {{ $product->nama_barang }}<br>
                                                    </address>
                                                    <address>
                                                        <strong>Satuan</strong><br>
                                                            {{ $product->satuan }}<br>
                                                    </address>
                                                    <address>
                                                        <strong>Quantity</strong><br>
                                                            {{ $product->qty }}<br>
                                                    </address>
                                                    <address>
                                                        <strong>Status</strong><br>
                                                            {{ $product->status }}<br>
                                                    </address>
                                                </div>
                                                <div class="col-md-6 text-md-left">
                                                    <address>
                                                        <strong>Tanggal Produksi</strong><br>
                                                            {{ $product->tgl_produksi }}<br>
                                                    </address>
                                                    <address>
                                                        <strong>Tanggal Export</strong><br>
                                                            {{ $product->tgl_export }}<br>
                                                    </address>
                                                    <address>
                                                        <strong>Export Country</strong><br>
                                                            {{ $product->export_country }}<br>
                                                    </address>
                                                    <address>
                                                        <strong>Expired</strong><br>
                                                            {{ $product->expired }}<br>
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-md-right">
                                    <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </div>
                        </section>
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
                        url: "{{ route('dashboard.data-products.index') }}/" + id,
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

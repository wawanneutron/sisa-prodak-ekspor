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
                                                    <div class="badge badge-success">{{ $product->kondisi }}</div>
                                                @elseif($product->kondisi == 'not checked')
                                                    <div class="badge badge-danger">{{ $product->kondisi }}</div>
                                                @elseif($product->kondisi == 'pending')
                                                    <div class="badge badge-primary">{{ $product->kondisi }}</div>
                                                @else
                                                    <div class="badge badge-secondary">{{ $product->kondisi }}</div>
                                                @endif
                                            </td>
                                            <td>{{ $product->catatan }}</td>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTambah" data-backdrop="static" data-keyboard="false" aria-hidden="true">
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
                                            <select name="approvals[]" class="select2 form-control  @error('approvals') is-invalid @enderror" multiple id="approvals">
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

    {{-- modal edit --}}
    @foreach ($aprovalProducts as $product)
        <div class="modal fade" id="modalEdit{{ $product->id }}"  data-backdrop="static" data-keyboard="false" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{ route('dashboard.over-products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Barang Lebih</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah Barang Lebih</label>
                                            <input type="number" name="qty_over"
                                                class="form-control @error('qty_over') is-invalid @enderror"
                                                value="{{ old('qty_over') ?? $product->qty_over }}">
                                            @error('qty_over')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="kondisi" class=" form-control @error('kondisi') is-invalid @enderror">
                                                    <option disabled selected>--Pilih kondisi prodak--</option>
                                                    <option value="bagus" {{ $product->kondisi == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                                    <option value="rusak" {{ $product->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                                    <option value="expired" {{ $product->kondisi == 'expired' ? 'selected' : '' }}>Expired</option>
                                                </select>
                                                @error('kondisi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pilih Product</label>
                                                <select name="listEditPengajuan[]" class="select2 form-control  @error('listEditPengajuan') is-invalid @enderror" multiple id="listEditPengajuan{{ $product->id }}">
                                            </select>
                                            @error('listEditPengajuan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror"  style="height: 100px !important;">{{ $product->note }}</textarea>
                                            @error('note')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                 <div class="table-responsive">
                                    <div class="alert alert-info alert-dismissible show fade mt-4">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                                <span>&times;</span>
                                            </button>
                                            Detail barang lebih
                                        </div>
                                    </div>
                                    <table class="table table-hover table-bordered table-md">
                                        <tr class=" table-active">
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>No PO</th>
                                            <th>Nama Barang</th>
                                            <th>Quantity</th>
                                            <th>Kondisi Barang</th>
                                        </tr>
                                        @foreach ($product->overProducts as $index => $data)
                                            <tr>
                                                <td>{{ $index +1 }}</td>
                                                <td>{{ $data->pivot->id }}</td>
                                                <td>{{ $data->no_po }}</td>
                                                <td>{{ $data->nama_barang }}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <label>Jumlah Barang Lebih</label>
                                                        <input type="number" name="qty_over[]"
                                                            class="form-control @error('qty_over') is-invalid @enderror"
                                                            value="{{ old('qty_over') }}">
                                                        @error('qty_over')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select name="kondisi[]" class=" form-control @error('kondisi') is-invalid @enderror">
                                                                <option disabled selected>--Pilih kondisi prodak--</option>
                                                                <option value="bagus" {{ $product->kondisi == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                                                <option value="rusak" {{ $product->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                                                <option value="expired" {{ $product->kondisi == 'expired' ? 'selected' : '' }}>Expired</option>
                                                            </select>
                                                            @error('kondisi')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                       
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
            @push('select-edit-script')
                <script type="text/javascript">
                    $('#listEditPengajuan{!! $product->id !!}').select2({
                        ajax: {
                            url: 'http://127.0.0.1:8000/admin-gudang/ajax/over-products/search',
                            processResults: function(data) {
                                return {
                                    results: data.map(function(item) {
                                        return {
                                            id: item.id,
                                            text: item.over_product_id
                                        }
                                    })
                                }
                            }
                        }
                    });
                    var products = {!! $product->overProducts !!}

                    products.forEach(function(item) {

                        var option = new Option(item.over_product_id, item.id, true, true);
                        $('#listEditPengajuan{!! $product->id !!}').append(option).trigger('change');

                    });
                </script>
            @endpush
        </div>
    @endforeach
    

     {{-- modal view --}}
    @foreach ($aprovalProducts as $item)
        <div class="modal fade" id="modalView{{ $item->id }}" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="h5">Kode Pengajuan <b>{{ $item->kd_pengajuan }}</b></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="z-index: 99;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <div class="alert alert-info alert-dismissible show fade mt-4">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    Detail barang lebih
                                </div>
                            </div>
                            <table class="table table-hover table-bordered table-md">
                                <tr class=" table-active">
                                    <th>No</th>
                                    <th>Kode Barang Lebih</th>
                                    <th>Qty Barang Lebih</th>
                                    <th>Kondisi Barang</th>
                                    <th>Note</th>
                                    <th>Detail</th>
                                </tr>
                                @foreach ($item->overProducts as $index => $data)
                                    <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $data->over_product_id }}</td>
                                        <td>{{ $data->qty_over }}</td>
                                        <td>
                                            @if ($data->kondisi == 'bagus')
                                                <div class="badge badge-success">{{ $data->kondisi }}</div>
                                            @elseif($data->kondisi == 'rusak')
                                                <div class="badge badge-danger">{{ $data->kondisi }}</div>
                                            @else
                                                <div class="badge badge-primary">{{ $data->kondisi }}</div>
                                            @endif
                                            {{-- <select name="kondisi[]" class=" form-control @error('kondisi') is-invalid @enderror">
                                                <option disabled selected>--Pilih kondisi prodak--</option>
                                                <option value="bagus" {{ $data->pivot->kondisi == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                                <option value="rusak" {{ $data->pivot->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                                <option value="expired" {{ $data->pivot->kondisi == 'expired' ? 'selected' : '' }}>Expired</option>
                                            </select> --}}
                                        </td>
                                        <td>
                                            {{ $data->note }}
                                        </td>
                                        <td>
                                            <a href="{{ $data->pivot->id }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#subView{{ $data->pivot->id }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <span><b>jumlah barang lebih {{ $item->overProducts->sum('qty_over') }} Karton</b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal sub view --}}
        @foreach ($item->overProducts as $index => $data)
            <div class="modal fade" id="subView{{ $data->pivot->id }}" tabindex="-1"  aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                             <div class="h5 text-light">List Barang Lebih <b>{{ $data->over_product_id }}</b></div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="z-index: 99;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-md">
                                    <tr class=" table-active">
                                        <th>No</th>
                                        <th>No PO</th>
                                        <th>Nama Barang</th>
                                        <th>Expired</th>
                                        <th>Tgl Produksi</th>
                                        <th>Export Country</th>
                                        <th>Tgl Export</th>
                                    </tr>
                                    @foreach ($data->products as $index => $product)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $product->no_po }}</td>
                                            <td>{{ $product->nama_barang }}</td>
                                            <td>{{ $product->expired }}</td>
                                            <td>{{ $product->tgl_produksi }}</td>
                                            <td>{{ $product->export_country }}</td>
                                            <td>{{ $product->tgl_export }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{-- <td><span><b>jumlah barang lebih {{ $item->qty_over }} Karton</b></span></td> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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

@push('select-script')
    {{-- script slect2 --}}
    <script type="text/javascript">
        $('#approvals').select2({
            ajax: {
                url: 'http://127.0.0.1:8000/admin-gudang/ajax/over-products/search',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.over_product_id
                            }
                        })
                    }
                }
            }
        });
    </script>
@endpush


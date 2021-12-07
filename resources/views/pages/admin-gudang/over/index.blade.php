@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Barang Lebih Sisa Ekspor</h1>
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
                <h2 class="section-title">Barang Lebih</h2>
                    <p class="section-lead">Ini adalah barang lebih sisa ekspor</p>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @switch(auth()->user()->role)
                                    @case('Admin Gudang')
                                        <a href="#" class=" btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                            <i class="fa fa-plus mr-2"></i>Tambah Barang Lebih
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
                                            <th>Kode</th>
                                            <th>Nama Barang</th>
                                            <th>Quantity</th>
                                            <th>Kondisi Barang</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($overProducts as $index => $product)
                                        <tr>
                                            <td>{{ ++$index + ($overProducts->currentPage() - 1) * $overProducts->perPage() }}</td>
                                            <td>{{ $product->over_product_id }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($product->products as $item)
                                                        <li> {{ $item->nama_barang }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                 {{ $product->qty_over }}
                                            </td>
                                            <td>
                                                @if ($product->kondisi == 'bagus')
                                                    <div class="badge badge-success">{{ $product->kondisi }}</div>
                                                @elseif($product->kondisi == 'rusak')
                                                    <div class="badge badge-danger">{{ $product->kondisi }}</div>
                                                @else
                                                    <div class="badge badge-primary">{{ $product->kondisi }}</div>
                                                @endif
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
                                    @if ($overProducts->hasPages())
                                        <ul class="pagination" role="navigation">
                                            {{-- Previous Page Link --}}
                                            @if ($overProducts->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true"
                                                    aria-label="@lang('pagination.previous')">
                                                    <span class="page-link" aria-hidden="true"><i
                                                        class="fas fa-chevron-left"></i></span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $overProducts->previousPageUrl() }}"
                                                    rel="prev"
                                                    aria-label="@lang('pagination.previous')"><i
                                                        class="fas fa-chevron-left"></i></a>
                                                </li>
                                            @endif
        
                                            <?php
                                            $start = $overProducts->currentPage() - 1; // show 3 pagination links before current
                                            $end = $overProducts->currentPage() + 1; // show 3 pagination links after current
                                            if ($start < 1) {
                                                $start = 1; // reset start to 1
                                                $end += 1;
                                            }
                                            if ($end >= $overProducts->lastPage()) {
                                                $end = $overProducts->lastPage();
                                            } // reset end to last page
                                            ?>
        
                                            @if ($start > 1)
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $overProducts->url(1) }}">{{ 1 }}</a>
                                                </li>
                                                @if ($overProducts->currentPage() != 4)
                                                    {{-- "Three Dots" Separator --}}
                                                    <li class="page-item disabled" aria-disabled="true">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                            @endif
                                            @for ($i = $start; $i <= $end; $i++)
                                                <li
                                                    class="page-item {{ $overProducts->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link"
                                                    href="{{ $overProducts->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            @if ($end < $overProducts->lastPage())
                                                @if ($overProducts->currentPage() + 3 != $overProducts->lastPage())
                                                    {{-- "Three Dots" Separator --}}
                                                    <li class="page-item disabled" aria-disabled="true">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $overProducts->url($overProducts->lastPage()) }}">{{ $overProducts->lastPage() }}</a>
                                                </li>
                                            @endif
        
                                            {{-- Next Page Link --}}
                                            @if ($overProducts->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link"
                                                    href="{{ $overProducts->nextPageUrl() }}" rel="next"
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
                <form action="{{ route('dashboard.over-products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Input Barang Lebih</h5>
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
                                            value="{{ old('qty_over') }}">
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
                                                <option value="bagus">Bagus</option>
                                                <option value="rusak">Rusak</option>
                                                <option value="expired">Expired</option>
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
                                            <select name="listProducts[]" class="select2 form-control  @error('listProducts') is-invalid @enderror" multiple id="listProducts">
                                        </select>
                                        @error('listProducts')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Photo Barang Lebih</label>
                                            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">
                                        </input>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" placeholder="note:" style="height: 100px !important;"></textarea>
                                        @error('note')
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
    @foreach ($overProducts as $product)
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
                                                <select name="listEditProducts[]" class="select2 form-control  @error('listEditProducts') is-invalid @enderror" multiple id="listEditProducts{{ $product->id }}">
                                            </select>
                                            @error('listEditProducts')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Photo Barang Lebih</label><br>
                                                <img src="{{ Storage::url('over-products/' . $product->image) }}" width="70" alt="photo barang lebih" title="photo barang lebih">
                                                <input type="file" name="image" class="mt-2 form-control  @error('image') is-invalid @enderror">
                                            </input>
                                            @error('image')
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
                                        @foreach ($product->products as $index => $data)
                                            <tr>
                                                <td>{{ $index +1 }}</td>
                                                <td>{{ $data->pivot->id }}</td>
                                                <td>{{ $data->no_po }}</td>
                                                <td>{{ $data->nama_barang }}</td>
                                                <td>
                                                    {{-- <div class="form-group">
                                                        <label>Jumlah Barang Lebih</label>
                                                        <input type="hidden" name="pivot_over[]" value="{{ $data->pivot->id }}">
                                                        <input type="number" name="qty_over[]"
                                                            class="form-control @error('qty_over') is-invalid @enderror"
                                                            value="{{ old('qty_over') }}">
                                                        @error('qty_over')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div> --}}
                                                </td>
                                                <td>
                                                    {{-- <div class="form-group">
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
                                                    </div> --}}
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
                    $('#listEditProducts{!! $product->id !!}').select2({
                        ajax: {
                            url: 'http://127.0.0.1:8000/admin-gudang/ajax/products/search',
                            processResults: function(data) {
                                return {
                                    results: data.map(function(item) {
                                        return {
                                            id: item.id,
                                            text: item.no_po + ' - ' + item.nama_barang
                                        }
                                    })
                                }
                            }
                        }
                    });
                    var products = {!! $product->products !!}

                    products.forEach(function(item) {

                        var option = new Option(item.no_po + ' - ' + item.nama_barang, item.id, true, true);
                        $('#listEditProducts{!! $product->id !!}').append(option).trigger('change');

                    });
                </script>
            @endpush
        </div>
    @endforeach
    

    {{-- modal view --}}
    @foreach ($overProducts as $item)
        <div class="modal fade" id="modalView{{ $item->id }}" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="z-index: 99;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info alert-dismissible show fade mt-4">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                Detail barang lebih
                            </div>
                        </div>
                        <div class="barang-lebih">
                            <img src="{{ $item->getImage() }}" width="150" alt="photo barang lebih" title="photo barang lebih">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-md">
                                <tr class=" table-active">
                                    <th>No</th>
                                    <th>No PO</th>
                                    <th>Nama Barang</th>
                                    <th>Kondisi Barang</th>
                                    <th>Export Country</th>
                                    <th>Tgl Export</th>
                                </tr>
                                @foreach ($item->products as $index => $data)
                                    <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $data->no_po }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>
                                            @if ($item->kondisi == 'bagus')
                                                <div class="badge badge-success">{{ $item->kondisi }}</div>
                                            @elseif($item->kondisi == 'rusak')
                                                <div class="badge badge-danger">{{ $item->kondisi }}</div>
                                            @else
                                                <div class="badge badge-primary">{{ $item->kondisi }}</div>
                                            @endif
                                            {{-- <select name="kondisi[]" class=" form-control @error('kondisi') is-invalid @enderror">
                                                <option disabled selected>--Pilih kondisi prodak--</option>
                                                <option value="bagus" {{ $data->pivot->kondisi == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                                <option value="rusak" {{ $data->pivot->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                                <option value="expired" {{ $data->pivot->kondisi == 'expired' ? 'selected' : '' }}>Expired</option>
                                            </select> --}}
                                        </td>
                                        <td>
                                            {{ $data->export_country }}
                                        </td>
                                        <td>
                                            {{ $data->tgl_export }}
                                        </td>
                                        
                                        {{-- <td>
                                            <a href="{{ $data->pivot->id }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#subModal{{ $data->pivot->id }}">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </table>
                                <tr>
                                    <td><span><b>jumlah barang lebih {{ $item->qty_over }} Karton</b></span></td>
                                </tr>
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
                        url: "{{ route('dashboard.over-products.index') }}/" + id,
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
        $('#listProducts').select2({
            ajax: {
                url: 'http://127.0.0.1:8000/admin-gudang/ajax/products/search',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.no_po + ' - ' + item.nama_barang
                            }
                        })
                    }
                }
            }
        });
    </script>
@endpush


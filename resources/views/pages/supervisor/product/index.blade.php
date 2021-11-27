@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Products (Supervisor)</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="
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
                    <a href="#" class=" btn btn-info btn-sm"><i class="fas fa-file-download mr-2"></i>Download Laporan</a>
                </div>
                <div class=" d-md-none d-sm-block">
                    <a href="#" class=" btn btn-info btn-sm"><i class="fas fa-file-download mr-2"></i>Download Laporan</a>
                </div>
                <h2 class="section-title">Data Produk</h2>
                <p class="section-lead">Ini adalah data product hasil produksi, yang masuk ke gudang</p>

                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="#" class=" btn btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus mr-2"></i>Tambah Product</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>No</th>
                                            <th>No PO</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Tgl Produksi</th>
                                            <th>Status</th>
                                            <th>Expired</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>PO/23/DES/2021/553</td>
                                            <td>Kopi Torabika</td>
                                            <td>Karton</td>
                                            <td>2021-01-09</td>
                                            <td>
                                                <div class="badge badge-success">Export</div>
                                            </td>
                                            <td>2023-01-09</td>
                                            <td>
                                                {{-- <a href="#" class="btn btn-sm btn-secondary"><i class=" fa fa-eye"></i></a> --}}
                                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit"><i class=" fa fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger"><i class=" fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PO/25/DES/2021/555</td>
                                            <td>Kopi Arabika Robusta</td>
                                            <td>Karton</td>
                                            <td>2021-06-24</td>
                                            <td>
                                                <div class="badge badge-danger">Sisa Export</div>
                                            </td>
                                            <td>2023-05-07</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary"><i class=" fa fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger"><i class=" fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>PO/26/DES/2021/556</td>
                                            <td>Kopi Starling</td>
                                            <td>Karton</td>
                                            <td>2021-03-08</td>
                                            <td>
                                                <div class="badge badge-success">Export</div>
                                            </td>
                                            <td>2023-08-18</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary"><i class=" fa fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger"><i class=" fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control" placeholder="nama barang">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Satuan</label>
                                            <input type="text" disabled class="form-control" value="karton">
                                            <span style="font-size: 12px;" class="text-primary"><b>* ini adalah satuan default </b></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Produksi</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Expired</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-redo mr-1"></i>Reset</button>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-paper-plane mr-1"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
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
                                    <input type="text" class="form-control" value="Torabika Arabika">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" disabled class="form-control" value="karton">
                                        <span style="font-size: 12px;" class="text-primary"><b>* ini adalah satuan default </b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Produksi</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Expired</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option disabled selected>--pilih status barang--</option>
                                        <option value="Export">Export</option>
                                        <option value="Sisa Export">Sisa Export</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

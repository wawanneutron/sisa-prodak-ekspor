<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Cari berdasarkan kode pengajuan" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ auth()->user()->getAvatar() }}" class="rounded-circle shadow mr-1" alt="avatar not vound" style="width: 45px; height: 45px;">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->first_name }} ({{ auth()->user()->role }})</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="
                    @switch(auth()->user()->role)
                        @case('Admin Gudang')
                                {{ route('profile-admin') }}
                            @break
                            @case('SPV')
                                {{ route('profile-spv') }}
                            @break
                            @case('Kepala Gudang')
                                {{ route('profile-kepala') }}
                            @break

                            @default
                                {{ route('login') }}
                    @endswitch
                " class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item has-icon text-danger" data-toggle="modal" data-target="#modalLogout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
{{-- modal lgout --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modalLogout">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin ingin keluar?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-2">
                <p>Silahkan pilih "Logout" di bawah untuk mengakhiri sesi saat ini.</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

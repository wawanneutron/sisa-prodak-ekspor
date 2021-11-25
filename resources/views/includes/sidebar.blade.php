<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mb-5">
            <img src="{{ url('/stisla-master/assets/img/mayora-img.png') }}" class="mt-2" width="60" style="opacity: 70%" alt="Mayora" title="Mayora Torabika Tbk">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu Utama</li>
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('home-dashboard') }}" class="nav-link"><i class="fas fa-rocket"></i><span>Dashboard Statistik</span></a>
            </li>
            <li class="nav-item {{ Request::is('products-admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('products-admin') }}"><i class="fas fa-th-large"></i><span>Produk</span></a>
            </li>
            <li class="menu-header">Produk Lebih</li>
            <li>
                <a href="#" class="nav-link"><i class="fas fa-truck-loading"></i> <span>Barang Lebih</span></a>
            </li>
            <li>
                <a href="#" class="nav-link"><i class="far fa-file-alt"></i> <span>Pengajuan</span></a>
            </li>
            <li class="menu-header">Account</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>My Account</span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Setting Account</a></li>
                    <li><a href="#">Setting Profile</a></li>
                </ul>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </div>
    </aside>
</div>

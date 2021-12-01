<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mb-5">
            <img src="{{ url('/stisla-master/assets/img/mayora-img.png') }}" class="mt-2" width="60" style="opacity: 70%" alt="Mayora" title="Mayora Torabika Tbk">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu Utama</li>
            <li class="nav-item {{ Request::is(['admin-gudang', 'supervisor', 'kepala-gudang']) ? 'active' : '' }}">
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
                    " class="nav-link"><i class="fas fa-rocket"></i><span>Dashboard Statistik</span>
                </a>
            </li>
            <li
                class="nav-item 
                    {{ Request::is('admin-gudang/data-products') ? 'active' : '' }}
                    {{ Request::is('supervisor/data-products') ? 'active' : '' }}
                    {{ Request::is('kepala-gudang/data-products') ? 'active' : '' }}
            ">
                <a class="nav-link" href="
                @switch(auth()->user()->role)
                         @case('Admin Gudang')
                        {{ route('dashboard.data-products.index') }}
                        @break
                        @case('SPV')
                            {{ route('products-spv') }}
                        @break
                        @case('Kepala Gudang')
                            {{ route('products-kepala') }}
                        @break

                        @default
                            {{ route('login') }}
                    @endswitch
                    ">
                    <i class="fas fa-th-large"></i><span>Produk</span>
                </a>
            </li>
            <li class="menu-header">Produk Lebih</li>
            <li 
                class="nav-item 
                        {{ Request::is('admin-gudang/over-products') ? 'active' : '' }}
                ">
                <a href="
                     @switch(auth()->user()->role)
                        @case('Admin Gudang')
                                {{ route('dashboard.over-products.index') }}
                            @break
                            @case('SPV')
                            @break
                            @case('Kepala Gudang')
                            @break

                            @default
                                {{ route('login') }}
                     @endswitch
                " class="nav-link"><i class="fas fa-truck-loading"></i> <span>Barang Lebih</span></a>
            </li>
            <li
                class="nav-item 
                    {{ Request::is('admin-gudang/pengajuan') ? 'active' : '' }}
                    {{ Request::is('supervisor/pengajuan') ? 'active' : '' }}
                    {{ Request::is('kepala-gudang/pengajuan') ? 'active' : '' }}
            ">
                <a class="nav-link" href="
                    @switch(auth()->user()->role)
                        @case('Admin Gudang')
                            {{ route('dashboard.pengajuan.index') }}
                            @break
                            @case('SPV')
                                {{ route('spv-pengajuan') }}
                            @break
                            @case('Kepala Gudang')
                                {{ route('kepala-pengajuan') }}
                            @break

                            @default
                                {{ route('login') }}
                    @endswitch
                    ">
                    <i class="far fa-file-alt"></i><span>Pengajuan</span>
                </a>
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
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split" data-toggle="modal" data-target="#modalLogout">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </div>
    </aside>
</div>

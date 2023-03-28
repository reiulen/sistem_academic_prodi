<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link d-flex justify-content-center align-items-center">
        <div class="brand-text text-center h5 align-middle">
            <img src="{{ asset('assets/images/logo.png') }}"
                style="height: 40px"
                class="object-fit-cover mt-3"/>
        </div>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-host os-theme-light os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pt-4 pb-3 mb-3 d-flex align-items-start" style="gap: 5px;">
            <div class="image">
                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2"
                    style="width: 40px; height: 40px; object-fit: cover;" alt="User Image" />
            </div>
            <div class="dropdown">
                <a class="user-nama" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <p>
                        {{ Str::substr(Auth::user()->name, 0, 18) }}
                    </p>
                    <p class="level text-muted">
                        {{ nameRole(Auth::user()->role) }}
                    </p>
                </a>
                <div class="dropdown-menu bg-dark border-0 shadow-lg" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ url('/user/profile') }}"><i
                            class="fa fa-user text-primary pr-1"></i> Profil</a>
                    @can('ubahpassword')
                        <a class="dropdown-item" href="#"><i class="fa fa-lock text-success pr-1"></i> Ubah
                            Password</a>
                    @endcan
                    <div class="dropdown-divider"></div>
                    <a role="button" class="dropdown-item logout" data-nama=""><i
                            class="fa fa-sign-out-alt text-danger pr-1"></i> Keluar</a>

                    <form id="logoutForm" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search..."
                    aria-label="Search" />
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-header">Database</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ set_active(['dashboard']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <li
                    class="nav-item nav-item {{ set_menu_open(['dosen.index', 'mahasiswa.index', 'tahun-akademik.index']) }}">
                    <a href="#" class="nav-link {{ set_active(['dosen.index', 'mahasiswa.index', 'tahun-akademik.index']) }}">
                        <i class="fas fa-save nav-icon"></i>
                        <p>
                            {{ __('Master') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->role == 1)
                        <li class="nav-item">
                            <a href="{{ route('tahun-akademik.index') }}" class="nav-link {{ set_active_sub(['tahun-akademik.index']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Tahun Akademik') }}</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->role == 2 || Auth::user()->role == 1)
                        <li class="nav-item">
                            <a href="{{ route('dosen.index') }}" class="nav-link {{ set_active_sub(['dosen.index']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Dosen') }}</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->role == 3 || Auth::user()->role == 1)
                        <li class="nav-item">
                            <a href="{{ route('mahasiswa.index') }}" class="nav-link {{ set_active_sub(['mahasiswa.index']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Mahasiswa') }}</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li
                    class="nav-item nav-item {{ set_menu_open(['seminar-skripsi.index', 'skripsi.index', 'bimbingan.index']) }}">
                    <a href="#" class="nav-link {{ set_active(['seminar-skripsi.index', 'skripsi.index', 'bimbingan.index']) }}">
                        <i class="fas fa-bookmark nav-icon"></i>
                        <p>
                            {{ __('Akademik') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->role != 2)
                        <li class="nav-item">
                            <a href="{{ route('seminar-skripsi.index') }}" class="nav-link {{ set_active_sub(['seminar-skripsi.index']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Seminar Skripsi') }}</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('skripsi.index') }}" class="nav-link {{ set_active_sub(['skripsi.index']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Skripsi') }}</p>
                            </a>
                        </li>
                        @if (Auth::user()->role != 3)
                        <li class="nav-item">
                            <a href="{{ route('bimbingan.index') }}" class="nav-link {{ set_active_sub(['bimbingan.index']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Bimbingan') }}</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if(Auth::user()->role == 1)
                <li
                    class="nav-item nav-item {{ set_menu_open(['data-skripsi', 'admin.index']) }}">
                    <a href="#" class="nav-link {{ set_active(['data-skripsi', 'admin.index']) }}">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>
                            {{ __('Pengaturan') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('data-skripsi') }}" class="nav-link {{ set_active_sub(['data-skripsi']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Data Skripsi') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link {{ set_active_sub(['admin.index']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Admin') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

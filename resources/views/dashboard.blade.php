<x-app-layout title="Dashboard">
    <x-content_header>
        <div class="col-sm-6">
            <h1>Dashboard</h1>
        </div>

        {{-- <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item item">{{ __('Data Siswa') }}</li>
        </x-breadcrumb> --}}
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box" style="background: yellow">
                        <div class="inner">
                            <h3>25</h3>
                            <p>Dosen</p>
                        </div>
                        <div class="icon float-right">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>550</h3>
                            <p>Mahasiswa</p>
                        </div>
                        <div class="icon float-right">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</x-app-layout>

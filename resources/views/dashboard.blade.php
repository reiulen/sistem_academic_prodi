<x-app-layout title="Dashboard">
    <x-content_header>
        <div class="col-sm-8">
            <h1>Selamat Datang di Sistem Informasi Prodi</h1>
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
                <div class="col-lg-3 col-md-6">
                    <div class="small-box" style="background: #F7CE46">
                        <div class="inner text-white pl-5">
                            <h1 style="font-size: 50px"><b>{{ $dosen }}</b></h1>
                        </div>
                        <div class="icon" style="
                        position: absolute;
                        top: 0;
                        right: 115px;">
                            <i class="fas fa-book-reader" style="color: rgba(255, 255, 255, 0.193)"></i>
                        </div>
                        <a href="#" class="small-box-footer text-right px-4">Dosen</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box" style="background: #E0882D">
                        <div class="inner text-white pl-5">
                            <h1 style="font-size: 50px"><b>{{ $mahasiswa }}</b></h1>
                        </div>
                        <div class="icon" style="
                        position: absolute;
                        top: 0;
                        right: 135px;">
                            <i class="fas fa-users" style="color: rgba(255, 255, 255, 0.193)"></i>
                        </div>
                        <a href="#" class="small-box-footer text-right px-4">Mahasiswa</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</x-app-layout>

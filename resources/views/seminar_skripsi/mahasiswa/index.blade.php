<x-app-layout title="Seminar Skripsi">
    <x-content_header>
        <div class="col-sm-6">
            <h4 class="text-primary">Seminar Skripsi</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">{{ __('Seminar Skripsi') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h5 class="text-primary">Pengajuan Seminar Proposal Skripsi TA {{ Session('tahun_akademik') }}</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <h5>Seminar Proposal</h5>
                                    <a href="{{ $data->count() > 2 ?  '#' : route('seminar-skripsi.create') }}"
                                        class="btn btn-primary px-5 py-2 mt-2"
                                        {{ $data->count() > 2 ? 'disablad' : ''}}>
                                        Daftar Seminar
                                    </a>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h5>Dosen Pembimbing</h5>
                                    <a href="{{ route('seminar-skripsi.detailDosen') }}" class="btn btn-warning px-5 py-2 mt-2">
                                        Detail Dosen
                                    </a>
                                </div>
                            </div>
                            <p class="mt-4">Pengajuan Seminar Proposal maksimal tangal 10 Desember 2022</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-primary">Jadwal Seminar Proposal</h5>
                            <ol class="mt-3">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ol>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</x-app-layout>

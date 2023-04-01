<x-app-layout title="Detail Dosen Tersedia">
    <x-content_header>
        <div class="col-sm-6">
            <h4 class="text-primary">Detail Dosen Tersedia</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">{{ __('Detail Dosen Tersedia') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-body">
                            <div class="row align-items-center">
                               @foreach ($dosen as $item)
                                <div class="col-md-6">
                                        <div class="card shadow-none border border-dark">
                                            <div class="card-body px-4 py-2 d-flex align-items-center">
                                                <div>
                                                    <h4>{{ $item->gelar_depan }} {{ $item->nama }}, {{ $item->gelar_belakang }}</h4>
                                                    <p style="font-size: 20px">{{ $item->rumpun }}</p>
                                                </div>
                                                <div style="padding-left: 25px">
                                                    <p style="font-size: 18px" class="text-nowrap">Ketersediaan : {{ $item->SeminarSkripsi->where('status', 1)->count() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               @endforeach
                            </div>
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

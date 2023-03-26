<x-app-layout title="Kartu Bimbingan Skripsi">
    <x-content_header>
        <div class="col-sm-6">
            <a href="{{ route('skripsi.index') }}" class="btn btn-primary" style="border-radius: 8px">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">{{ __('Kartu Bimbingan Skripsi') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card card-outline">
                    <div class="card-header">
                        <h4 class="text-primary mb-3">Kartu Bimbingan Skripsi</h4>
                        {{-- @if (Auth::user()->role == 2) --}}
                        <div class="mb-4">
                            <h6>Nama : {{ $data->mahasiswa->nama ?? '-' }}</h6>
                            <h6>NIM : {{ $data->mahasiswa->nim ?? '-' }}</h6>
                            <h6>Dosen Pembimbing : {{ $data->dosen->nama ?? '-' }}</h6>
                            <h6>Judul Skripsi : {{ $data->judul ?? '-' }}</h6>
                        </div>
                        {{-- @endif --}}
                        <div class="d-flex" style="gap: 10px">
                           @if (Auth::user()->role == 2)
                            <div class="">
                                <div role="button" class="btn btn-primary border-0 btnAdd">
                                    <i class="fa fa-plus px-1"></i>
                                    Tambah
                                </div>
                            </div>
                           @endif
                            <div class="">
                                <a href="{{ route('kartu-bimbingan.export', $data->id) }}" class="btn btn-success border-0">
                                    <i class="fa fa-file px-1"></i>
                                    Export Data
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Tanggal</th>
                                    <th>Bab</th>
                                    <th  @if (Auth::user()->role != 2) colspan="2" @endif>Evaluasi</th>
                                    @if (Auth::user()->role == 2)
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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

    @push('modals')
    <div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Bimbingan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="submitInput">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="bab">
                            Bab
                        </label>
                        @php
                            $bab = [
                                'Bab I',
                                'Bab II',
                                'Bab III',
                                'Bab IV',
                                'Bab V',
                            ];
                        @endphp
                        <select class="form-control @error('bab') is-invalid @enderror" name="bab" id="bab">
                            <option value="">Pilih Bab</option>
                            @foreach ($bab as $st)
                                <option value="{{ $st }}">{{ $st }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="evaluasi">Evaluasi</label>
                       <textarea class="form-control" rows="4" name="evaluasi" id="evaluasi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button id="submitBtn" disabled="true" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endpush


    @include('lib.datatable')
    @push('script')
    <script>
        const id_detail = "{{ $data->id }}";
        const role = "{{ Auth::user()->role }}";
    </script>
    <script src="{{ asset('assets/dist/js/pages/kartu_bimbingan/index.js') }}"></script>
    @endpush
</x-app-layout>

<x-app-layout title="Mahasiswa">
    <x-content_header>
        <div class="col-sm-6">
            <h4>{{ isset($data) ? 'Edit' : 'Tambah' }} Mahasiswa</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item item">
                <a href="{{ route('mahasiswa.index') }}">{{ __('Mahasiswa') }}</a>
            </li>
            <li class="breadcrumb-item item active">{{ __( (isset($data) ? 'Edit' : 'Tambah') . ' Mahasiswa') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{ isset($data) ? route('mahasiswa.update', $data->id) : route('mahasiswa.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif
                <div class="card card-outline">
                    <div class="card-body">
                        <x-jet-validation-errors/>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="nim">
                                    NIM Mahasiswa
                                </label>
                                <input type="text"
                                    name="nim"
                                    value="{{ old('nim', ($data->nim ?? '')) }}"
                                    class="form-control @error('nim') is-invalid @enderror" id="nim">
                            </div>
                            <div class="col-md-6">
                                <label for="nama">
                                   Nama Mahasiswa
                                </label>
                                <input type="text"
                                    name="nama"
                                    value="{{ old('nama', ($data->nama ?? '')) }}"
                                    class="form-control @error('nama') is-invalid @enderror" id="nama">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="password">
                                   Password
                                </label>
                                <input type="password"
                                    name="password"
                                    value="{{ old('password', ($data->password ?? '')) }}"
                                    class="form-control @error('password') is-invalid @enderror" id="password">
                            </div>
                            <div class="col-md-6">
                                <label for="status">
                                   Status
                                </label>
                                @php
                                    $status = [
                                        'Seminar Proposal',
                                        'Skripsi',
                                        'Yudisium',
                                        'Lulus'
                                    ];
                                @endphp
                                <select class="form-control" name="status">
                                    <option value="">Pilih Rumpun</option>
                                    @foreach ($status as $rmp)
                                        <option value="{{ $rmp }}" {{ old('status', ($data->status ?? '')) == $rmp ? 'selected' : '' }}>{{ $rmp }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-danger">
                                <i class="fa fa-times"></i>
                                Batal
                            </a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</x-app-layout>

<x-app-layout title="Dosen">
    <x-content_header>
        <div class="col-sm-6">
            <h4>{{ isset($data) ? 'Edit' : 'Tambah' }} Dosen</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item item">
                <a href="{{ route('dosen.index') }}">{{ __('Dosen') }}</a>
            </li>
            <li class="breadcrumb-item item active">{{ __( (isset($data) ? 'Edit' : 'Tambah') . ' Dosen') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{ isset($data) ? route('dosen.update', $data->id) : route('dosen.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif
                <div class="card card-outline">
                    <div class="card-body">
                        <x-jet-validation-errors/>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="nip_niy">
                                    NIP/NIY
                                </label>
                                <input type="text"
                                    name="nip_niy"
                                    value="{{ old('nip_niy', ($data->nip_niy ?? '')) }}"
                                    class="form-control @error('nip_niy') is-invalid @enderror" id="nip_niy">
                            </div>
                            <div class="col-md-6 row">
                                <div class="col-md-6">
                                    <label for="gelar_depan">
                                        Gelar Depan
                                    </label>
                                    <input type="text"
                                        name="gelar_depan"
                                        value="{{ old('gelar_depan', ($data->gelar_depan ?? '')) }}"
                                        class="form-control @error('gelar_depan') is-invalid @enderror" id="gelar_depan">
                                </div>
                                <div class="col-md-6">
                                    <label for="gelar_belakang">
                                        Gelar Belakang
                                    </label>
                                    <input type="text"
                                        name="gelar_belakang"
                                        value="{{ old('gelar_belakang', ($data->gelar_belakang ?? '')) }}"
                                        class="form-control @error('gelar_belakang') is-invalid @enderror" id="gelar_belakang">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="nama">
                                   Nama Dosen
                                </label>
                                <input type="text"
                                    name="nama"
                                    value="{{ old('nama', ($data->nama ?? '')) }}"
                                    class="form-control @error('nama') is-invalid @enderror" id="nama">
                            </div>
                            <div class="col-md-6">
                                <label for="password">
                                   Password
                                </label>
                                <input type="password"
                                    name="password"
                                    value="{{ old('password', ($data->password ?? '')) }}"
                                    class="form-control @error('password') is-invalid @enderror" id="password">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="rumpun">
                                   Rumpun
                                </label>
                                @php
                                    $rumpun = [
                                        'Pendidikan',
                                        'Bahasa',
                                        'Sastra'
                                    ];
                                @endphp
                                <select class="form-control" name="rumpun">
                                    <option value="">Pilih Rumpun</option>
                                    @foreach ($rumpun as $rmp)
                                        <option value="{{ $rmp }}" {{ old('rumpun', ($data->rumpun ?? '')) == $rmp ? 'selected' : '' }}>{{ $rmp }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="jabatan">
                                   Jabatan Fungsional
                                </label>
                                @php
                                    $jafung = [
                                        'Asisten Ahli',
                                        'Lector',
                                        'Lector Kepala',
                                        'Guru Besar'
                                    ];
                                @endphp
                                <select class="form-control" name="jabatan">
                                    <option value="">Pilih Jabatan Fungsional</option>
                                    @foreach ($jafung as $rmp)
                                        <option value="{{ $rmp }}" {{ old('jabatan', ($data->jabatan ?? '')) == $rmp ? 'selected' : '' }}>{{ $rmp }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="status_mengajar">
                                   Status Mengajar
                                </label>
                                <div class="d-flex align-items-center" style="gap: 8px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_mengajar" id="status_mengajar_aktif" value="1"  {{ ($data->status_mengajar ?? 0) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_mengajar_aktif">
                                          Aktif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_mengajar" id="status_mengajar_tidak" value="2" {{ ($data->status_mengajar ?? 0) == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_mengajar_tidak">
                                            Tidak Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{ route('dosen.index') }}" class="btn btn-danger">
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

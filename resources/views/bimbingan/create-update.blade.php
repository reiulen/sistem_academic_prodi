<x-app-layout title="Bimbingan Kelas">
    <x-content_header>
        <div class="col-sm-6">
            <h4>{{ isset($data) ? 'Edit' : 'Tambah' }} Bimbingan Kelas</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item item">
                <a href="{{ route('bimbingan.index') }}">{{ __('Bimbingan Kelas') }}</a>
            </li>
            <li class="breadcrumb-item item active">{{ __( (isset($data) ? 'Edit' : 'Tambah') . ' Bimbingan Kelas') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{ isset($data) ? route('bimbingan.update', $data->id) : route('bimbingan.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif
                <div class="card card-outline">
                    <div class="card-body">
                        <x-jet-validation-errors/>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="kelas">
                                    Kelas
                                </label>
                                <input type="text"
                                    name="kelas"
                                    value="{{ old('kelas', ($data->kelas ?? '')) }}"
                                    class="form-control @error('kelas') is-invalid @enderror" id="kelas">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="topik">
                                   Topik
                                </label>
                                <textarea
                                    class="form-control @error('topik') is-invalid @enderror"
                                    rows="4"
                                    name="topik"
                                    id="topik">{{ old('topik', ($data->topik ?? '')) }}</textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{ route('bimbingan.index') }}" class="btn btn-danger">
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

<x-app-layout title="Admin">
    <x-content_header>
        <div class="col-sm-6">
            <h4>{{ isset($data) ? 'Edit' : 'Tambah' }} Admin</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item item">
                <a href="{{ route('admin.index') }}">{{ __('Admin') }}</a>
            </li>
            <li class="breadcrumb-item item active">{{ __( (isset($data) ? 'Edit' : 'Tambah') . ' Admin') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{ isset($data) ? route('admin.update', $data->id) : route('admin.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif
                <div class="card card-outline">
                    <div class="card-body">
                        <x-jet-validation-errors/>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="nama">
                                   Nama
                                </label>
                                <input type="text"
                                    name="name"
                                    value="{{ old('name', ($data->name ?? '')) }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name">
                            </div>
                            <div class="col-md-6">
                                <label for="username">
                                    Username
                                </label>
                                <input type="text"
                                    name="username"
                                    value="{{ old('username', ($data->username ?? '')) }}"
                                    class="form-control @error('username') is-invalid @enderror" id="username">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="password">
                                   Password
                                </label>
                                <input type="password"
                                    name="password"
                                    value="{{ old('password') }}"
                                    class="form-control @error('password') is-invalid @enderror" id="password">
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation">
                                   Konfirmasi Password
                                </label>
                                <input type="password_confirmation"
                                    name="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                    class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{ route('admin.index') }}" class="btn btn-danger">
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

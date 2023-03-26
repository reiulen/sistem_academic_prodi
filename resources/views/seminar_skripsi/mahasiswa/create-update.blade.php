<x-app-layout title="Seminar Skripsi">
    <x-content_header>
        <div class="col-sm-6">
            <h4>{{ isset($data) ? 'Edit' : 'Daftar' }} Seminar Skripsi</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item item">
                <a href="{{ route('seminar-skripsi.index') }}">{{ __('Seminar Skeipsi') }}</a>
            </li>
            <li class="breadcrumb-item item active">{{ __( (isset($data) ? 'Edit' : 'Daftar') . ' Seminar Skripsi') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{ isset($data) ? route('seminar-skripsi.update', $data->id) : route('seminar-skripsi.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif
                <div class="card card-outline">
                    <div class="card-body">
                        <x-jet-validation-errors/>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="dosen_id">
                                   Nama Dosen
                                </label>
                               @if(isset($data))
                                <input value="{{ ($data->dosen->nip_niy ?? '') . ' - ' . ($data->dosen->nama ?? '') }}" class="form-control" disabled readonly />
                               @else
                               <select class="form-select select2 col-12 @error('dosen_id') is-invalid @enderror"
                                        name="dosen_id" id="dosen_id">
                                    <option value="">Pilih Dosen</option>
                                    @foreach ($dosen as $ds)
                                    <option value="{{ $ds->id }}" {{ $ds->id == old('dosen_id',  ($data->dosen_id ?? 0)) ? 'selected' : '' }}>{{ $ds->nip_niy . ' - ' . $ds->nama }}</option>
                                    @endforeach
                                </select>
                               @endif
                            </div>
                            <div class="col-md-6">
                                <label for="rumpun">
                                   Rumpun
                                </label>
                                @if(isset($data))
                                <input value="{{ $data->rumpun }}" class="form-control" disabled readonly />
                                @else
                                @php
                                    $rumpun = [
                                        'Pendidikan',
                                        'Bahasa',
                                        'Sastra',
                                    ];
                                @endphp
                                <select class="form-control @error('rumpun') is-invalid @enderror" name="rumpun">
                                    <option value="">Pilih Rumpun</option>
                                    @foreach ($rumpun as $rmp)
                                        <option value="{{ $rmp }}" {{ old('rumpun', ($data->rumpun ?? '')) == $rmp ? 'selected' : '' }}>{{ $rmp }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="judul">
                                   Judul
                                </label>
                                <textarea
                                    class="form-control @error('judul') is-invalid @enderror"
                                    rows="4"
                                    name="judul"
                                    id="judul">{{ old('judul', ($data->judul ?? '')) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                @if(isset($data))
                                <label for="status">
                                    Status
                                 </label>
                                 @php
                                     $status = [
                                         1 => 'Acc Skripsi',
                                         2 =>'Tidak Acc Skripsi'
                                     ]
                                 @endphp
                                <select class="form-control w-100" name="status">
                                     <option value="">Pilih Status</option>
                                     @foreach ($status as $key => $st)
                                     <option value="{{ $key }}" {{ $key == $data->status ? 'selected' : '' }}>{{ $st }}</option>
                                    @endforeach
                                </select>
                                @else
                                <label for="tipe_seminar">
                                    Tipe Seminar
                                </label>
                                @php
                                    $tipe_seminar = [
                                        1 => 'Seminar Proposal',
                                        2 => 'Seminar Payung',
                                    ];
                                @endphp
                                <select class="form-control @error('tipe_seminar') is-invalid @enderror" name="tipe_seminar">
                                    <option value="">Pilih Tipe Seminar</option>
                                    @foreach ($tipe_seminar as $key => $rmp)
                                        <option value="{{ $key }}" {{ old('tipe_seminar', ($data->tipe_seminar ?? '')) == $key ? 'selected' : '' }}>{{ $rmp }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="doc_proposal">
                                   Document Proposal
                                </label>
                                @if (Auth::user()->role == 1)
                                <div>
                                    <a href="{{ asset($data->doc_proposal) }}" class="inline-block" download>
                                        <img style="width: 65px"
                                            @if ($data->type_file == 'png' || $data->type_file == 'jpg' || $data->type_file == 'jpef')
                                            src="{{ asset($data->doc_proposal) }}"
                                            @else
                                            src="{{ asset('/assets/images/'.$data->type_file.'.png') }}"
                                            @endif />
                                        <div class="mt-2">
                                            @php
                                                $name_file = explode('/', $data->doc_proposal);
                                            @endphp
                                            {{ $name_file[3] ?? '-' }}
                                        </div>
                                    </a>
                                </div>
                                @else
                                <input
                                    type="file"
                                    class="form-control @error('doc_proposal') is-invalid @enderror"
                                    name="doc_proposal"
                                    id="doc_proposal">
                                @endif
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{ route('seminar-skripsi.index') }}" class="btn btn-danger">
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

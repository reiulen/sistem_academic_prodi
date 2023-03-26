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
                        <h5 class="text-primary">Daftar Mahasiswa</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul</th>
                                    <th>Tipe Seminar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->tipe_seminar == 1 ? 'Seminar Proposal' : 'Seminar Payung' }}</td>
                                    <td>
                                        <a href="{{ route('seminar-skripsi.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <div
                                            role="button"
                                            class="btn btn-danger btn-sm deleteData"
                                            data-name="{{ $item->nama }}"
                                            data-id="{{ $item->id }}"
                                            >
                                            <i class="fas fa-trash-alt text-white"></i>
                                        </div>
                                        <form method="post" id="form-hapus{{ $item->id }}" action="{{ route('seminar-skripsi.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
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


    @include('lib.datatable')
    @push('script')
    <script>
        $(function() {
            $("#example1").DataTable({});
        })
    </script>
    @endpush
</x-app-layout>

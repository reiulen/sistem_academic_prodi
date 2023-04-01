<x-app-layout title="Skripsi">
    <x-content_header>
        <div class="col-sm-6">
            <h4 class="text-primary">Skripsi</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">{{ __('Skripsi') }}</li>
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
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul</th>
                                    <th>Pembimbing</th>
                                    <th>Rumpun</th>
                                    @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                                    <td>{{ $item->judul ?? '-' }}</td>
                                    <td>{{ $item->dosen->nama_dosen ?? '-' }}</td>
                                    <td>{{ $item->dosen->rumpun ?? '-' }}</td>
                                    @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                    <td>
                                        <a href="{{ route('seminar-skripsi.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                    @endif
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

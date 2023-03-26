<x-app-layout title="Bimbingan Kelas">
    <x-content_header>
        <div class="col-sm-6">
            <h4 class="text-primary">Bimbingan Kelas</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">{{ __('Bimbingan Kelas') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="d-md-flex">
                                @if (Auth::user()->role == 2)
                                <div>
                                    <a class="btn btn-primary border-0" href="{{ route('bimbingan.create') }}"><i class="fa fa-plus px-1"></i> Tambah</a>
                                </div>
                                @else
                                <div class="">
                                    <a href="{{ route('bimbingan.export') }}" class="btn btn-success border-0">
                                        <i class="fa fa-file px-1"></i>
                                        Export Data
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Nama Dosen</th>
                                    <th>Kelas</th>
                                    <th>Topik</th>
                                    <th>Tanggal</th>
                                    @if (Auth::user()->role == 2)
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
                                    <td>{{ $item->dosen->nama ?? '-' }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->topik }}</td>
                                    <td>{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</td>
                                    @if (Auth::user()->role == 2)
                                    <td>
                                        <a href="{{ route('bimbingan.edit', $item->id) }}" class="btn btn-primary btn-sm">
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
                                        <form method="post" id="form-hapus{{ $item->id }}" action="{{ route('bimbingan.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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

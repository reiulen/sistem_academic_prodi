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
                        @if (Auth::user()->role == 2)
                        <div class="mb-4">
                            <h6>Nama : {{ Auth::user()->dosen->nama ?? '-' }}</h6>
                            <h6>Rumpun : {{ Auth::user()->dosen->rumpun ?? '-' }}</h6>
                        </div>
                        @endif
                        <h5 class="text-primary">Data Mahasiswa Bimbingan</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul</th>
                                    @if(Auth::user()->role == 2)
                                    <th>Pembimbing</th>
                                    @endif
                                    <th>Kartu Bimbingan</th>
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
                                    @if(Auth::user()->role == 2)
                                    <td>{{ $item->dosen->nama }}</td>
                                    @endif
                                    <td>
                                       <a href="{{ route('detailBimbingan', $item->id) }}" class="btn btn-success px-4">
                                            Lihat
                                       </a>
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

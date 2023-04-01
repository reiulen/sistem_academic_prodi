<x-app-layout title="Pengumuman">
    <x-content_header>
        <div class="col-sm-6">
            <h4 class="text-primary">Pengumuman</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">{{ __('Pengumuman') }}</li>
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
                                <div>
                                    <a class="btn btn-primary border-0" href="{{ route('pengumuman.create') }}"><i class="fa fa-plus px-1"></i> Tambah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Created At</th>
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
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center"
                                            style="gap: 20px">
                                           @if ($item->image)
                                           <img src="{{ asset($item->image) }}"
                                                class="img-thumbnail"
                                                style="width: 120px" />
                                           @endif
                                            <div>
                                                {{ $item->title }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $item->status == 1 ? 'Publish' : 'Draft' }}</td>
                                    <td class="align-middle">{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('pengumuman.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('pengumuman.show', $item->slug) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <div
                                            role="button"
                                            class="btn btn-danger btn-sm deleteData"
                                            data-name="{{ $item->nama }}"
                                            data-id="{{ $item->id }}"
                                            >
                                            <i class="fas fa-trash-alt text-white"></i>
                                        </div>
                                        <form method="post" id="form-hapus{{ $item->id }}" action="{{ route('pengumuman.destroy', $item->id) }}">
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

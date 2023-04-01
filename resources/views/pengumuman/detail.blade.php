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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h4>{{ $data->title }}</h4>
                        <p class="text-muted">{{ date('d F Y H:i:s', strtotime($data->created_at)) }}</p>
                        @if ($data->image)
                        <figure class="mt-2">
                            <img class="img-thumbnail"
                                style="width: 50%"
                                src="{{ asset($data->image) }}" />
                        </figure>
                        @endif
                        <article class="mt-2">
                            {!! $data->description !!}
                        </article>
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
</x-app-layout>

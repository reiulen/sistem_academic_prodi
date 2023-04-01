<x-app-layout title="Data SK">
   <x-content_header>
        <div class="col-sm-6">
            <h4 class="text-primary">Data SK</h4>
        </div>

        <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">{{ __('Data SK') }}</li>
        </x-breadcrumb>
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card card-outline">
                    <div class="card-header">
                        <h4>Data SK</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row justify-content-center" style="gap: 15px">
                            @foreach ($data as $item)
                            <a href="{{ $item['unduh'] }}" target="_blank" role="button" class="bg-secondary text-center w-100 col-8 py-2">
                                <h5>{{ $item['nama'] }}</h5>
                            </a>
                            @endforeach
                        </div>
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

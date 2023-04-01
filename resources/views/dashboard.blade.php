<x-app-layout title="Dashboard">
    <x-content_header>
        <div class="col-sm-8">
            <h1>Selamat Datang di Sistem Informasi Prodi</h1>
        </div>

        {{-- <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item item">{{ __('Data Siswa') }}</li>
        </x-breadcrumb> --}}
    </x-content_header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="small-box" style="background: #F7CE46">
                        <div class="inner text-white pl-5">
                            <h1 style="font-size: 50px"><b>{{ $dosen }}</b></h1>
                        </div>
                        <div class="icon" style="
                        position: absolute;
                        top: 0;
                        right: 115px;">
                            <i class="fas fa-book-reader" style="color: rgba(255, 255, 255, 0.193)"></i>
                        </div>
                        <a href="#" class="small-box-footer text-right px-4">Dosen</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box" style="background: #E0882D">
                        <div class="inner text-white pl-5">
                            <h1 style="font-size: 50px"><b>{{ $mahasiswa }}</b></h1>
                        </div>
                        <div class="icon" style="
                        position: absolute;
                        top: 0;
                        right: 135px;">
                            <i class="fas fa-users" style="color: rgba(255, 255, 255, 0.193)"></i>
                        </div>
                        <a href="#" class="small-box-footer text-right px-4">Mahasiswa</a>
                    </div>
                </div>
            </div>
            @if (count($pengumuman) > 0)
            <div class="mt-4">
                <h4>Pengumuman</h4>
                <div class="owl-carousel owl-theme mt-4">
                    @foreach ($pengumuman as $item)
                    <div class="item">
                        <div class="card p-0" style="box-shadow: 0 !important">
                            <a class="text-decoration-none" href="{{ route('pengumuman.show', $item->slug) }}">
                                @if ($item->image)
                                <img src="{{ asset($item->image) }}"
                                        style="object-fit: cover;
                                            object-positon: center;
                                    height: 180px">
                                @endif
                                <article class="card-body p-2">
                                    <p class="text-muted">{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</p>
                                    <h5 class="text-primary">{{ $item->title }}</h5>
                                </article>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @push('css')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <style>
            .owl-theme .owl-nav {
                position: absolute;
                top: 35%;
                bottom: 50%;
                width: 100%;
                display: flex;
                justify-content: space-between;
            }

            .owl-carousel .owl-nav button.owl-next,
            .owl-carousel .owl-nav button.owl-prev,
            .owl-carousel button.owl-dot {
                background: 0 0;
                color: inherit;
                border: none;
                padding: 0!important;
                font: inherit;
                background: #ffffff;
                height: 40px;
                width: 40px;
                border-radius: 100%;
                font-size: 25px;
                box-shadow: 0px 2px 2px rgb(0 0 0 / 16%);
            }
            </style>
            @endpush
            @push('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(function() {
                    $('.owl-carousel').owlCarousel({
                        loop:false,
                        margin:20,
                        nav:true,
                        dots: false,
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:2
                            },
                            1000:{
                                items:3
                            }
                        }
                    })
                })
            </script>
        @endpush
</x-app-layout>

<html>
    <head>
        <title>Email</title>
        <style>
            body {
                background: #F9F9F9;
                font-family: Poppins,
                sans-serif;
            }


            /* Component */
            .app {
                width: 100%;
                max-width: 600px;
                margin: 20px auto;
                background: white;
                border: 1px solid #EBEBEB;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table.list tr td {
                font-size: 14px;
                font-weight: 400;
            }

            table.list tr td{
                padding: 4px;
            }

            table.list-border tr.border-none th,
            table.list-border tr.border-none td{
                border: 0;
            }

            table.list-border tr th {
                font-weight: 600;
                font-size: 15px;
            }

            table.list-border tr td {
                font-weight: 400;
                font-size: 14px;
            }

            table.list-border tr th,
            table.list-border tr td {
                padding: 16px 8px;
                text-align: left;
            }

            table.list-border tr th,
            table.list-border tr td{
                border: 1px solid #EBEBEB;
            }

            table.list-border tr th:first-child,
            table.list-border tr td:first-child{
                border-left: none;
            }

            table.list-border tr th:last-child,
            table.list-border tr td:last-child {
                border-right: none;
            }

            .btn {
                display: inline-block;
                line-height: 1.5;
                text-align: center;
                text-decoration: none;
                vertical-align: middle;
                cursor: pointer;
                border: 0;
                padding: 0.375rem 0.75rem;
            }

            .btn.btn-blue {
                background-color:  #00A4D9;
            }

            /* Grid */
            .d-flex {
                display: flex;
            }

            .justify-content-center {
                justify-content: center;
            }

            .justify-content-between {
                justify-content: space-between;
            }

            .align-items-center {
                align-items: center;
            }

            .text-center {
                text-align: center;
            }

            /* Font Weight */
            .font-weight-700 {
                font-weight: 700;
            }

            .font-weight-600 {
                font-weight: 700;
            }

            .font-weight-500 {
                font-weight: 500;
            }

            /* Font Size */
            .font-size-14 {
                font-size: 14px;
            }

            .font-size-15 {
                font-size: 15px;
            }

            .font-size-16 {
                font-size: 16px;
            }

            .font-size-20 {
                font-size: 20px;
            }

            /* Color */
            .text-secondary {
                color: #828282;
            }

            .text-white {
                color: white;
            }

            .text-left {
                text-align: left;
            }
        </style>
    </head>
    <body>
        <section class="app">
            <div class="text-center" style="padding: 24px 30px;">
                <div class="text-center">
                    @php
                        $setting = \App\Models\Setting::select('logo')->first();
                    @endphp
                    <img src="{{ asset($setting->logo ?? '') }}"
                        style="height: 120px;
                        ">
                </div>
                <div style="padding-top: 24px">
                    <div class="font-size-20 font-weight-700" style="padding-bottom: 8px">
                        Terima Kasih {{ $data->name }}
                    </div>
                    <div class="font-size-15 font-weight-400 text-secondary" >
                        Permintaan brosur anda untuk product {{ $data->product->name ?? '' }} telah diterima oleh kami,
                        tunggu admin untuk mengirimkan brosur ke email ataupun no whatsapp
                    </div>
                </div>
            </div>
            <div style="padding: 24px 30px">
                <div class="font-size-17 font-weight-700" style="padding-bottom: 20px">
                    Detail Informasi
                </div>
                <table class="list">
                    <tr>
                        <td>Nama</td>
                        <td class="text-left">:</td>
                        <td class="text-left">{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="text-left">:</td>
                        <td class="text-left">{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <td>No Whatsapp</td>
                        <td class="text-left">:</td>
                        <td class="text-left">{{ $data->phone }}</td>
                    </tr>
                </table>
            </div>
            <div style="padding: 40px">
                <div class="font-weight-700 text-center" style="padding-bottom: 30px; font-size: 20px">
                    Lihat Product Lainnya
                </div>
                <div class="d-flex align-items-center justify-content-center" style="gap: 20px; flex-wrap: wrap">
                    @php
                        $product = \App\Models\Product::limit(4)->get();
                    @endphp
                    @foreach ($product as $item)
                    <div style="width: 250px;">
                        <a href="{{ env('FRONT_URL') . '/artikel/' .$item->slug }}" style="text-decoration: none; color: black">
                            <img src="{{ env('APP_URL').$item->foto }}" style="height: 160px; width: 100%; object-fit: cover" />
                            <div style="padding-top: 10px;">
                                {{ $item->name }}
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center" style="padding: 20px">
                <a  style="background-color: #19130b;
                            border-radius: 5px;
                            padding: 10px 20px;
                            color: white;
                            font-size: 14px;
                            text-decoration: none;"
                    href="https://www.cikaranglakeviewpremium.com">
                    Kunjungi Website Kami
                </a>
            </div>
            <div style="margin-top: 30px; border-top: 1px solid #EBEBEB;">
                <div class="text-center" style="padding: 40px;">
                    <div class="font-weight-600 font-size-16">
                        Terima kasih banyak
                    </div>
                    <div class="font-weight-400 font-size-14 text-secondary">
                        Kunjungi sosial media kami untuk mendapatkan informasi terbaru
                    </div>
                    <div class="d-flex align-items-center justify-content-center"
                        style="margin-top: 20px; gap: 25px;">
                       @php
                           $sosmed = \App\Models\Sosmed::select('id', 'name', 'link')->get();
                       @endphp
                        @foreach ($sosmed as $item)
                             <a href="{{ $item->link }}" target="_blank" class="text-dark">
                                @switch($item->name)
                                    @case('TikTok')
                                    <img height="22px" src="{{ asset('assets/icons/tiktok.svg') }}" />
                                    @break
                                    @case('Instagram')
                                    <img height="22px" src="{{ asset('assets/icons/instagram.svg') }}" />
                                    @break
                                    @case('Youtube')
                                    <img height="22px" src="{{ asset('assets/icons/youtube.svg') }}" />
                                    @break;
                                    @default
                                    {{ $item->name }}
                                @endswitch
                             </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/images/templates/border-bg-bottom.svg') }}" alt="">
        </section>
    </body>
</html>

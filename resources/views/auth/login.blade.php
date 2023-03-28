<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SISTEM INFORMASI AKADEMIK PRODI</title>
    <link rel="icon" type="image/png" href="/assets/gambar/logo.png" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/dist/css/custom.css">

</head>

<body>
    <div class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-5 min-vh-100">
                <div class="p-5" style="margin-top: 150px">
                    <x-jet-validation-errors class="mb-3 rounded-0" />
                    <h6 class="text-left">Silahkan Login</h6>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <div class="form-group mb-4">
                                <label><b>Username</b></label>
                                <input
                                    name="username"
                                    class="form-control p-4 border-blue"
                                    placeholder="Masukan NIY/NIP/NIM"
                                    required
                                    />
                            </div>
                            <div class="form-group mb-4">
                                <label><b>Password</b></label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control p-4 border-blue"
                                    placeholder="Masukan kata sandi..."
                                    required
                                    />
                            </div>
                            <div class="mt-5 text-center">
                                <button
                                    class="btn btn-blue text-center"
                                    style="
                                        border-radius: 10px;
                                        padding: 10px 35px">
                                    <i class="fas fa-paper-plane"></i>
                                    Masuk
                                </button>
                            </div>
                            <div class="mt-5 text-center">
                                Apabila anda tidak memilik akun silahkan menghubungi <br/>
                                <span class="text-red">staff laboratorium pbsi</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 d-md-block d-none">
                <div class="bg-login-page">
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/dist/js/adminlte.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="../landing/images/banner.png"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="/register" method="POST" autocomplete="off">
                        @csrf
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Registrasi</p>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="nik">NIK</label>
                            <input type="number" name="nik" id="nik" class="form-control form-control-lg"
                                placeholder="Masukkan NIK" maxlength="16" required>
                        </div>


                        <!-- Email input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-lg"
                                placeholder="Masukkan nama" maxlength="35" required>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="telp">Nomor Telepon</label>
                            <input type="number" name="telp" id="telp" class="form-control form-control-lg"
                                placeholder="Masukkan Nomor Telepon" maxlength="13" required>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" id="username"
                                class="form-control form-control-lg" placeholder="Masukkan Username" maxlength="25" required>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control form-control-lg" placeholder="Masukkan Password" maxlength="32" required>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya akun? <a href="/login"
                                    class="link-danger">Login</a></p>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

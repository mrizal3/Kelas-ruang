<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Form Login UNPER</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/css/style.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/backend/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('') }}assets/logo.png" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        Username atau Password Salah !
                                    </div>
                                </div>
                                @endif
                                <form method="POST" action="{{ url('login') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">No Identitas</label>
                                        <input id="no_identitas" type="text" class="form-control" name="no_identitas"
                                            tabindex="1" required autofocus autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password"
                                            tabindex="2" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Tidak punya akun? <a href="{{ url('register') }}">Buat Akun</a>
                          </div>
                        <div class="simple-footer">
                           &copy; 2020/2021 <div class="bullet text-"><i>Universitas Perjuangan</i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('') }}assets/backend/modules/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/popper.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/tooltip.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('') }}assets/backend/modules/moment.min.js"></script>
    <script src="{{ asset('') }}assets/backend/js/stisla.js"></script>
</body>

</html>
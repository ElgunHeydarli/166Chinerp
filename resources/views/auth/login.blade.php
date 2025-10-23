<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <title>Daxil Ol</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="{{ asset('auth/assets') }}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('auth/assets') }}/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('auth/assets') }}/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="{{ asset('auth/assets') }}/css/main.min.css" rel="stylesheet">
    <link href="{{ asset('auth/assets') }}/css/custom.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-4">
                <div class="card login-box-container">
                    <div class="card-body">
                        <div class="authent-logo">
                            <img src="{{ asset('auth/assets') }}/images/logo@2x.png" style="width: 200px"
                                alt="">
                        </div>


                        <form class="form-horizontal mt-3" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="floatingInput"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Email </label>
                                    @if ($errors->first('email'))
                                        <code>{{ $errors->first('email') }}</code>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" id="floatingPassword"
                                        placeholder="Şifrə">
                                    <label for="floatingPassword">Şifrə</label>
                                    @if ($errors->first('password'))
                                        <code>{{ $errors->first('password') }}</code>
                                    @endif
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs">Daxil Ol</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascripts -->
    <script src="{{ asset('auth/assets') }}/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('auth/assets') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="{{ asset('auth/assets') }}/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('auth/assets') }}/js/main.min.js"></script>
</body>

</html>

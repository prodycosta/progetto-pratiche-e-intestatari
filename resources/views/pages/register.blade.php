<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SB Admin 2 - Register</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .custom-card {
            max-width: 400px;
            margin: auto;
        }

        .custom-input {
            font-size: 0.875rem;
            padding: 0.5rem;
            margin-bottom: 10px;
        }

        .custom-title {
            font-size: 1.25rem;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5 custom-card">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-3">
                            <div class="text-center">
                                <h1 class="h5 text-gray-900 mb-3 custom-title">Crea un Account!</h1>
                            </div>
                            <form class="user" method="POST" id="registrationForm" action="{{ route('pages.register') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-2 mb-sm-0">
                                        <input type="text" class="form-control form-control-user custom-input" id="exampleFirstName" name="nome" placeholder="Nome" required maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-2 mb-sm-0">
                                        <input type="text" class="form-control form-control-user custom-input" id="exampleLastName" name="cognome" placeholder="Cognome" required maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user custom-input" id="exampleUsername" name="username" placeholder="Username" required maxlength="255">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user custom-input" id="exampleInputEmail" name="email" placeholder="Email" required maxlength="255">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-2 mb-sm-0">
                                        <input type="password" class="form-control form-control-user custom-input" id="exampleInputPassword" name="password" placeholder="Password" required minlength="8" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control form-control-user custom-input" id="exampleRepeatPassword" name="password_confirmation" placeholder="Conferma Password" required minlength="8" maxlength="255">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Registrati
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('pages.forgot-password') }}">Password dimenticata?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('pages.login') }}">Hai gia un Account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/register.js"></script>
</body>

</html>

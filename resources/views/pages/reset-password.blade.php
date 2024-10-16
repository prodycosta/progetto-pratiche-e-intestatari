<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 38vh;
            width: 130vh;
        }

        .form-container {
            width: 60%;
            border: 1px solid #dfe4ea;
            border-radius: 10px;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 10px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
            width: 40%;
            padding: 12px;
            font-weight: bold;
            color: #fff;
            margin: auto;
            display: block;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <hr class="sidebar-divider my-0">
            <hr class="sidebar-divider">
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                    </li>
                </ul>

                </nav>
                <div class="container mt-6">
                    <div class="form-container text-left">
                        <form class="user" method="POST" action="{{ route('pages.reset-password.post', ['token' => $token]) }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email">Indirizzo Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Inserisci l'indirizzo email..." required>
                            </div>
                            <div class="form-group">
                                <label for="password">Nuova Password:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci la nuova password" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Conferma Password:</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Conferma la password" required>
                                @error('password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Resetta Password
                            </button>
                        </form>
                    </div>
                </div>







            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->


        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>

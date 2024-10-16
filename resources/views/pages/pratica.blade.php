<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .short-input {
            width: 40%;
        }

        .warning-message {
            color: red;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('pages.index') }}">
                <div class="sidebar-brand-icon">
                    @if(auth()->check())
                    @if(auth()->user()->isAdmin())
                    <i class="fa-solid fa-user-tie"></i>
                    @else
                    <i class="fa-solid fa-user"></i>
                    @endif
                    @endif
                </div>
                <div class="sidebar-brand-text mx-3">
                    @if(auth()->check())
                    @if(auth()->user()->isAdmin())
                    Admin
                    @else
                    User
                    @endif
                    @endif
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('pages.index') }}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Interfaccia
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-file"></i>
                    <span>Pratiche</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('pages.pratica') }}">Aggiungi Pratiche</a>
                        <a class="collapse-item" href="{{ route('pages.pratica') }}">Carica Allegati</a>
                        <a class="collapse-item" href="{{ route('pages.intestatari') }}">Aggiungi Intestatari</a>
                    </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Admin</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('pages.tabella-pratiche') }}">Pratiche</a>
                        <a class="collapse-item" href="{{ route('pages.tabella-utenti') }}">Utenti</a>
                        <a class="collapse-item" href="{{ route('pages.tabella-intestatari') }}">Intestatari</a>
                        @if(auth()->user()->isAdmin())
                        @else
                        <div class="warning-message">
                            <p>Solo gli admin possono accedere</p>
                        </div>
                        @endif
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                                <img class="img-profile rounded-circle" src="images/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('pages.mostra-conferma-eliminazione') }}">
                                    <i class="fas fa-trash-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Elimina account
                                </a>
                                <a class="dropdown-item" href="{{ route('pages.logout') }}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8">
                            <div class="card shadow">
                                <div class="card-header bg-primary text-white">
                                    <h1 class="h3 mb-0">Aggiungi Pratica {{ Auth::user()->username }}</h1>
                                </div>
                                <div class="card-body">
                                    <form class="user" method="post" action="{{ route('pages.pratica') }}" id="uploadForm">
                                        @csrf
                                        @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputIndirizzo">Indirizzo</label>
                                                <input type="text" class="form-control rounded-pill" id="inputIndirizzo" name="indirizzo" placeholder="Indirizzo" pattern="[A-Za-z\s]+" title="Inserisci solo lettere e spazi" maxlength="255" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputNumeroCivico">Numero Civico</label>
                                                <input type="text" class="form-control rounded-pill" id="inputNumeroCivico" name="numero_civico" maxlength="255" placeholder="Numero Civico" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputProvincia">Provincia</label>
                                                <select class="form-control rounded-pill" id="inputProvincia" name="provincia" onchange="loadCommunes()" required>
                                                    <option value="" disabled selected>Seleziona Provincia</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputComune">Comune</label>
                                                <select class="form-control rounded-pill" id="inputComune" name="comune" onchange="loadCAPs()" disabled required>
                                                    <option value="" disabled selected>Seleziona Comune</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputCAP">CAP</label>
                                                <select class="form-control rounded-pill" id="inputCAP" name="cap" disabled required>
                                                    <option value="" disabled selected>Seleziona CAP</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAnniContratto">Anni Contratto</label>
                                            <input type="number" class="form-control rounded-pill short-input" id="inputAnniContratto" name="anni_contratto" placeholder="Anni Contratto" max="99" required>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="inputDescrizione">Intestatari:</label>
                                            <div class="checkbox-list">
                                                @forelse($intestatari ?? [] as $intestatario)
                                                <div class="custom-control custom-checkbox mb-2" style="display: inline-block;">
                                                    <input type="checkbox" class="custom-control-input" id="check{{ $intestatario->id }}" name="id_intestatari[]" value="{{ $intestatario->id }}">
                                                    <label class="custom-control-label" for="check{{ $intestatario->id }}">
                                                        {{ $intestatario->nome }} {{ $intestatario->cognome }}
                                                    </label>
                                                </div>
                                                @empty
                                                <p class="text-muted">Nessun intestatario disponibile.</p>
                                                @endforelse
                                            </div>
                                            <div class="form-group text-center">
                                                @if(count($intestatari) == 0)
                                                <a href="{{ route('pages.intestatari') }}" class="btn btn-primary rounded-pill" id="aggiungiIntestatariButton" disabled>Aggiungi Intestatari</a>
                                                @endif
                                                <button type="submit" class="btn btn-primary rounded-pill" id="aggiungiButton" disabled>Aggiungi</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a class="scroll-to-top rounded" href="#page-top">
                            <i class="fas fa-angle-up"></i>
                        </a>
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Seleziona "Logout" qui sotto se sei pronto a terminare la sessione.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancella</button>
                                        <a class="btn btn-primary" href="{{ route('pages.logout') }}">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="vendor/jquery/jquery.min.js"></script>
                        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                        <script src="js/sb-admin-2.min.js"></script>
                        <script src="vendor/chart.js/Chart.min.js"></script>
                        <script src="js/demo/chart-area-demo.js"></script>
                        <script src="js/demo/chart-pie-demo.js"></script>
                        <script src="js/demo/comuni.js"></script>
                        <script src="js/demo/pratiche.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var intestatariCheckbox = document.querySelectorAll('[name="id_intestatari[]"]');
                                var aggiungiButton = document.getElementById('aggiungiButton');
                                intestatariCheckbox.forEach(function(checkbox) {
                                    checkbox.addEventListener('click', function() {
                                        var almenoUnIntestatarioSelezionato = Array.from(intestatariCheckbox).some(function(checkbox) {
                                            return checkbox.checked;
                                        });
                                        aggiungiButton.disabled = !almenoUnIntestatarioSelezionato;
                                    });
                                });
                            });
                        </script>
                        <script src="https://kit.fontawesome.com/1f4c0029b5.js" crossorigin="anonymous"></script>
</body>

</html>

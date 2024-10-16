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
            background-color: #f4f4f4;

        }

        .custom-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .details-label {
            font-weight: bold;
            font-size: 18px;
            color: grey;
        }

        .list-group-item {
            background-color: #fff;
            border: none;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .intestatario-item,
        .allegati-item {

            padding: 15px;
            border-radius: 10px;
        }

        .intestatario-details {
            border-radius: 10px;
        }

        .intestatario-details {
            font-family: 'Georgia', sans-serif;
            font-size: 18px;
            color: #333;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .intestatario-details strong {
            font-weight: bold;
            color: #555;
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

            <hr class="sidebar-divider  d-none d-md-block">
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
                                <img class="img-profile rounded-circle" src="{{asset('images/undraw_profile.svg')}}">
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
                <div class="container mt-5">
                    <div class="card border-0 shadow-lg custom-card mx-auto" style="max-width: 75%;">
                        <div class="card-body p-5 text-center">
                            <h2 class="card-title mb-4" style="font-family: 'Times New Roman', serif;">Dettagli Pratica</h2>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong class="details-label">Indirizzo:</strong> {{ $pratica->indirizzo }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong class="details-label">Provincia:</strong> {{ $pratica->provincia }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong class="details-label">Comune:</strong> {{ $pratica->comune }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong class="details-label">Numero Civico:</strong> {{ $pratica->numero_civico }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong class="details-label">Anni Contratto:</strong> {{ $pratica->anni_contratto }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong class="details-label">CAP:</strong> {{ $pratica->cap }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong class="details-label">Stato:</strong> {{ $pratica->stato->nome ?? 'N/A' }}
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <div class="mt-4 text-center">
                                        <h4 class="mb-3 details-label">Dettagli Intestatari</h4>
                                        <ul class="list-group">
                                            @forelse (json_decode($pratica->id_intestatari) as $id_intestatario)
                                            @php
                                            $intestatario = App\Models\Intestatari::find($id_intestatario);
                                            @endphp
                                            @if($intestatario && ($intestatario->nome || $intestatario->cognome))
                                            <li class="list-group-item intestatario-item" data-intestatario-id="{{ $id_intestatario }}">
                                                <strong>Nome:</strong> {{ $intestatario->nome ?? 'N/A' }},
                                                <strong class="ml-2">Cognome:</strong> {{ $intestatario->cognome ?? 'N/A' }}
                                                <i class="fa-solid fa-eye" style="cursor: pointer; margin-left: 10px;"></i>
                                            </li>
                                            <div id="intestatario-details-{{ $id_intestatario }}" class="intestatario-details" style="display: none;">
                                                <strong>Nome:</strong> {{ $intestatario->nome ?? 'N/A' }}<br>
                                                <strong>Cognome:</strong> {{ $intestatario->cognome ?? 'N/A' }}<br>
                                                <strong>CAP:</strong> {{ $intestatario->cap ?? 'N/A' }}<br>
                                                <strong>Indirizzo:</strong> {{ $intestatario->indirizzo ?? 'N/A' }}<br>
                                                <strong>Numero Civico:</strong> {{ $intestatario->numero_civico ?? 'N/A' }}<br>
                                                <strong>Comune:</strong> {{ $intestatario->comune ?? 'N/A' }}<br>
                                                <strong>Provincia:</strong> {{ $intestatario->provincia ?? 'N/A' }}<br>
                                                <strong>Numero Documento:</strong> {{ $intestatario->numero_documento ?? 'N/A' }}<br>
                                                <strong>Scadenza Documento:</strong> {{ $intestatario->scadenza_documento ?? 'N/A' }}<br>
                                                <strong>Codice Fiscale:</strong> {{ $intestatario->codice_fiscale ?? 'N/A' }}<br>
                                                <strong>Data Nascita:</strong> {{ $intestatario->data_nascita ?? 'N/A' }}<br>
                                                <strong>Numero Telefono:</strong> {{ $intestatario->numero_telefono ?? 'N/A' }}<br>
                                            </div>
                                            @endif
                                            @empty
                                            <li class="list-group-item text-muted">Nessun intestatario associato a questa pratica.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <h4 class="mb-3">Allegati della Pratica</h4>

                                @if(count($allegati) > 0)
                                <ul class="list-group">
                                    @foreach($allegati as $allegato)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold">File:</span> {{ $allegato->NomeFile }}
                                        <a href="{{ route('pages.visualizza', ['id_allegato' => $allegato->id]) }}" class="btn btn-link" download>
                                            <i class="fa-solid fa-file-arrow-down" style="font-size: 20px;"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <p class="text-muted mt-3">Nessun allegato associato a questa pratica.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>







            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const intestatarioItems = document.querySelectorAll('.intestatario-item');

                intestatarioItems.forEach(item => {
                    item.addEventListener('click', function() {
                        mostraDivBianco();
                    });
                });
            });

            function mostraDivBianco() {
                const overlay = document.getElementById('overlay');
                overlay.style.display = 'flex';
            }

            function chiudiDiv() {
                const overlay = document.getElementById('overlay');
                overlay.style.display = 'none';
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const intestatarioItems = document.querySelectorAll('.intestatario-item');

                intestatarioItems.forEach(function(item) {
                    item.addEventListener('click', function() {
                        // Nascondi tutti i dettagli degli intestatari
                        document.querySelectorAll('.intestatario-details').forEach(function(detail) {
                            detail.style.display = 'none';
                        });

                        // Mostra o nascondi i dettagli dell'intestatario cliccato
                        const intestatarioId = item.getAttribute('data-intestatario-id');
                        const intestatarioDetails = document.getElementById(`intestatario-details-${intestatarioId}`);

                        if (intestatarioDetails) {
                            // Usa una classe per gestire la visibilità
                            const isVisible = intestatarioDetails.classList.contains('show-details');

                            if (isVisible) {
                                intestatarioDetails.style.display = 'none';
                                intestatarioDetails.classList.remove('show-details');
                            } else {
                                intestatarioDetails.style.display = 'block';
                                intestatarioDetails.classList.add('show-details');
                            }
                        } else {
                            // Carica i dettagli dell'intestatario tramite una chiamata AJAX o altra logica
                            // e aggiungi un div con id "intestatario-details-{id}" sotto la lista degli intestatari
                        }
                    });
                });
            });
        </script>
        <script src="https://kit.fontawesome.com/1f4c0029b5.js" crossorigin="anonymous"></script>

</body>

</html>

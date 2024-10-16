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
        .admin-content {
            background-color: #dff0d8;
            padding: 15px;
            border: 1px solid #3c763d;
            border-radius: 5px;
            margin-top: 10px;
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
                    <form id="searchForm" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" id="searchInput" placeholder="Inserisci Indirizzo" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" onclick="searchTable()">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tabella pratiche {{ Auth::user()->username }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(isset($datiTabella) && (is_array($datiTabella) || is_object($datiTabella)))
                            @if(count($datiTabella) > 0)
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Indirizzo</th>
                                        <th>Numero Civico</th>
                                        <th>Provincia</th>
                                        <th>Comune</th>
                                        <th>Anni Contratto</th>
                                        <th>Intestatari</th>
                                        <th>Stato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datiTabella as $index => $riga)
                                    @if($riga->id_utente == auth()->user()->id)
                                    <tr class="{{ $index >= 8 ? 'hidden-row' : '' }}">
                                        <td>{{ $riga->indirizzo ?? '' }}</td>
                                        <td>{{ $riga->numero_civico ?? '' }}</td>
                                        <td>{{ $riga->provincia ?? '' }}</td>
                                        <td>{{ $riga->comune ?? '' }}</td>
                                        <td>{{ $riga->anni_contratto ?? '' }}</td>
                                        <td>
                                            @if ($riga->id_intestatari)
                                            @forelse (json_decode($riga->id_intestatari) ?? [] as $id_intestatario)
                                            @php
                                            $intestatario = App\Models\Intestatari::find($id_intestatario);
                                            @endphp
                                            @if ($intestatario && ($intestatario->nome || $intestatario->cognome))
                                            {{ $intestatario->nome ?? 'N/A' }} {{ $intestatario->cognome ?? 'N/A' }}<br>
                                            @endif
                                            @empty
                                            <span class="text-muted">N/A</span>
                                            @endforelse
                                            @else
                                            <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $riga->stato->nome ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('pages.card', ['id_pratica' => $riga->id]) }}" class="btn btn-link p-0 m-0">
                                                <i class="fa-regular fa-eye fa-lg"></i>
                                            </a>
                                            <a href="#" class="elimina-riga ml-2 btn btn-link text-danger p-0 m-0" onclick="eliminariga({{ $riga->id }})">
                                                <i class="fa-solid fa-trash-can fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @if(count($datiTabella) > 8)
                            <button id="toggleRowsButton" class="btn btn-primary btn-sm">Mostra/Nascondi</button>
                            @endif
                            @else
                            <p>Nessun dato disponibile.</p>
                            @endif
                            @else
                            <p>Nessun dato disponibile.</p>
                            @endif
                        </div>
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
            <script>
                function searchTable() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("searchInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("dataTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[0];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().startsWith(filter)) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
            </script>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.hidden-row').hide();
                    $('#toggleRowsButton').on('click', function() {
                        $('.hidden-row').toggle();
                    });
                });
            </script>
            <script>
                function eliminariga(id) {
                    if (confirm('Sei sicuro di voler eliminare questa pratica?')) {
                        window.location.href = '/elimina-riga/' + id;
                    }
                }
            </script>
            <script src="https://kit.fontawesome.com/1f4c0029b5.js" crossorigin="anonymous"></script>
</body>

</html>

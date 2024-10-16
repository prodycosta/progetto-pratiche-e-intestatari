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
                    <form id="searchForm" class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" id="searchInput" placeholder="Inserisci Codice Fiscale" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" onclick="searchTable()">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="container-fluid">
                                <h2 class="mb-4">Tabella Intestatari</h2>
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form id="searchForm" class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" id="searchInput" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" onclick="searchTable()">
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
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="container-fluid">
                    <h2 class="mb-4">Tabella Intestatari</h2>
                    @if(count($intestatari) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-rounded">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Cap</th>
                                    <th>Indirizzo</th>
                                    <th>Num. Civico</th>
                                    <th>Comune</th>
                                    <th>Prov.</th>
                                    <th>Num. Doc.</th>
                                    <th>Scad. Doc.</th>
                                    <th>Cod. Fiscale</th>
                                    <th>Data Nascita</th>
                                    <th>Num. Tel.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($intestatari as $index => $intestatario)
                                <tr class="{{ $index >= 8 ? 'hidden-row' : '' }}">
                                    <td>{{ $intestatario->nome }}</td>
                                    <td>{{ $intestatario->cognome }}</td>
                                    <td>{{ $intestatario->cap }}</td>
                                    <td>{{ $intestatario->indirizzo }}</td>
                                    <td>{{ $intestatario->numero_civico }}</td>
                                    <td>{{ $intestatario->comune }}</td>
                                    <td>{{ $intestatario->provincia }}</td>
                                    <td>{{ $intestatario->numero_documento }}</td>
                                    <td>{{ $intestatario->scadenza_documento }}</td>
                                    <td>{{ $intestatario->codice_fiscale }}</td>
                                    <td>{{ $intestatario->data_nascita }}</td>
                                    <td>{{ $intestatario->numero_telefono }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a class="btn-sm modifica-intestatario p-0 m-1" onclick="mostraModificaForm({{ $intestatario->id }})" style="cursor: pointer;">
                                                <i class="fa-solid fa-pen fa-lg"></i>
                                            </a>
                                            <a class=" btn-sm elimina-intestatario text-danger" onclick="eliminaIntestatario({{ $intestatario->id }})" style="cursor: pointer;">
                                                <i class="fa-solid fa-trash-can fa-lg"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="modificaForm_{{ $intestatario->id }}" class="modificaForm" style="display: none;">
                                    <td colspan="12">
                                        <form method="POST" action="{{ route('pages.modifica-intestatari', $intestatario->id) }}">
                                            @csrf
                                            @method('PUT')
                                            @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                            @endif
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" id="nome" name="nome" class="form-control" style="width: 75%;" value="{{ $intestatario->nome }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cognome">Cognome</label>
                                                    <input type="text" id="cognome" name="cognome" class="form-control" style="width: 75%;" value="{{ $intestatario->cognome }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="cap">Cap</label>
                                                    <input type="text" id="cap" name="cap" class="form-control" style="width: 75%;" value="{{ $intestatario->cap }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="indirizzo">Indirizzo</label>
                                                    <input type="text" id="indirizzo" name="indirizzo" class="form-control" style="width: 75%;" value="{{ $intestatario->indirizzo }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="numero_civico">Numero Civico</label>
                                                    <input type="text" id="numero_civico" name="numero_civico" class="form-control" style="width: 75%;" value="{{ $intestatario->numero_civico }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="comune">Comune</label>
                                                    <input type="text" id="comune" name="comune" class="form-control" style="width: 75%;" value="{{ $intestatario->comune }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="provincia">Provincia</label>
                                                    <input type="text" id="provincia" name="provincia" class="form-control" style="width: 75%;" value="{{ $intestatario->provincia }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="numero_documento">Numero Documento</label>
                                                    <input type="text" id="numero_documento" name="numero_documento" class="form-control" style="width: 75%;" value="{{ $intestatario->numero_documento }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="scadenza_documento">Scadenza Documento</label>
                                                    <input type="date" id="scadenza_documento" name="scadenza_documento" class="form-control" style="width: 75%;" value="{{ $intestatario->scadenza_documento }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="codice_fiscale">Codice Fiscale</label>
                                                    <input type="text" id="codice_fiscale" name="codice_fiscale" class="form-control" style="width: 75%;" value="{{ $intestatario->codice_fiscale }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="data_nascita">Data Nascita</label>
                                                    <input type="date" id="data_nascita" name="data_nascita" class="form-control" style="width: 75%;" value="{{ $intestatario->data_nascita }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="numero_telefono">Numero Telefono</label>
                                                    <input type="text" id="numero_telefono" name="numero_telefono" class="form-control" style="width: 75%;" value="{{ $intestatario->numero_telefono }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(count($intestatari) > 8)
                <button id="toggleRowsButton" class="btn btn-primary btn-sm">Mostra/Nascondi</button>
                @endif
                @else
                <p class="text-muted">Nessun dato disponibile nella tabella.</p>
                @endif
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
            function modificaIntestatario(id) {
                window.location.href = '/modifica-intestatari/' + id;
            }

            function eliminaIntestatario(id) {
                if (confirm('Sei sicuro di voler eliminare questo intestatario?')) {
                    window.location.href = '/elimina-intestatari/' + id;
                }
            }
        </script>
        <script>
            function modificaIntestatario(id) {
                window.location.href = '/modifica-intestatari/' + id;
            }
        </script>
        <script>
            function mostraModificaForm(id) {
                $('#modificaForm').show();
            }
        </script>
        <script>
            function mostraModificaForm(id) {
                $('.modificaForm').hide();
                $('#modificaForm_' + id).show();
                $.ajax({
                    url: '/modifica-intestatari/' + id + '/get-data',
                    type: 'GET',
                    success: function(data) {
                        $('#nome').val(data.nome);
                        $('#cognome').val(data.cognome);
                        $('#cap').val(data.cap);
                        $('#indirizzo').val(data.indirizzo);
                        $('#numero_civico').val(data.numero_civico);
                        $('#comune').val(data.comune);
                        $('#provincia').val(data.provincia);
                        $('#numero_documento').val(data.numero_documento);
                        $('#scadenza_documento').val(data.scadenza_documento);
                        $('#codice_fiscale').val(data.codice_fiscale);
                        $('#data_nascita').val(data.data_nascita);
                        $('#numero_telefono').val(data.numero_telefono);
                        $('#modificaForm form').attr('action', '/modifica-intestatari/' + id);
                    },
                    error: function(error) {
                        console.error('Errore nel recupero dei dati dell\'intestatario:', error);
                    }
                });
            }
        </script>
        <script>
            function searchTable() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.querySelector(".table");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[9];
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
            document.addEventListener('DOMContentLoaded', function() {
                if (session('intestatario_creato'))
                    alert("{{ session('intestatario_creato') }}");
                endif
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                var alertType = new URLSearchParams(window.location.search).get('alert');
                if (alertType === 'success') {
                    alert('Intestatario creato con successo!');
                }
            });
        </script>
        <script src="https://kit.fontawesome.com/1f4c0029b5.js" crossorigin="anonymous"></script>
</body>

</html>

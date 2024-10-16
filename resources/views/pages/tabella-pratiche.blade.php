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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Inserisci Indirizzo" aria-label="Search" aria-describedby="basic-addon2">
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
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="container-fluid">
                    <h2 class="mb-4">Tabella Pratiche</h2>
                    @if(count($pratiche) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Indirizzo</th>
                                    <th>Numero Civico</th>
                                    <th>Provincia</th>
                                    <th>Comune</th>
                                    <th>CAP</th>
                                    <th>Anni Contratto</th>
                                    <th>Utente</th>
                                    <th>Intestatari</th>
                                    <th>Stato</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pratiche as $index => $pratica)
                                <tr class="{{ $index >= 8 ? 'hidden-row' : '' }}">
                                    <td>{{ $pratica->indirizzo }}</td>
                                    <td>{{ $pratica->numero_civico }}</td>
                                    <td>{{ $pratica->provincia }}</td>
                                    <td>{{ $pratica->comune }}</td>
                                    <td>{{ $pratica->cap }}</td>
                                    <td>{{ $pratica->anni_contratto }}</td>
                                    <td>{{ $pratica->utente->nome ?? '' }} {{ $pratica->utente->cognome ?? '' }}</td>
                                    <td>
                                        @php
                                        $intestatari = json_decode($pratica->id_intestatari);
                                        @endphp
                                        @if($intestatari && is_array($intestatari))
                                        @foreach ($intestatari as $id_intestatario)
                                        @php
                                        $intestatario_obj = App\Models\Intestatari::find($id_intestatario);
                                        @endphp
                                        @if($intestatario_obj && ($intestatario_obj->nome || $intestatario_obj->cognome))
                                        {{ $intestatario_obj->nome ?? 'N/A' }} {{ $intestatario_obj->cognome ?? 'N/A' }}<br>
                                        @endif
                                        @endforeach
                                        @else
                                        <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $pratica->stato->nome ?? '' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a class=" btn-sm p-0 m-1" onclick="mostraModificaForm({{ $pratica->id }})" style="cursor: pointer;">
                                                <i class="fa-solid fa-pen fa-lg"></i>
                                            </a>
                                            <a class=" btn-sm text-danger" onclick="eliminaPratica({{ $pratica->id }})" style="cursor: pointer;">
                                                <i class="fa-solid fa-trash-can fa-lg"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="modificaForm_{{ $pratica->id }}" class="modificaForm" style="display: none;">
                                    <td colspan="10">
                                        <form method="POST" action="{{ route('pages.modifica-pratica', $pratica->id) }}" class="mt-4">
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
                                                    <label for="indirizzo">Indirizzo</label>
                                                    <input type="text" id="indirizzo" name="indirizzo" class="form-control" style="width: 75%;" value="{{ $pratica->indirizzo }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="numero_civico">Numero Civico</label>
                                                    <input type="text" id="numero_civico" name="numero_civico" class="form-control" style="width: 75%;" value="{{ $pratica->numero_civico }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="provincia">Provincia</label>
                                                    <input type="text" id="provincia" name="provincia" class="form-control" style="width: 75%;" value="{{ $pratica->provincia }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="comune">Comune</label>
                                                    <input type="text" id="comune" name="comune" class="form-control" style="width: 75%;" value="{{ $pratica->comune }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="cap">CAP</label>
                                                    <input type="text" id="cap" name="cap" class="form-control" style="width: 75%;" value="{{ $pratica->cap }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="anni_contratto">Anni Contratto</label>
                                                    <input type="number" id="anni_contratto" name="anni_contratto" class="form-control" style="width: 75%;" value="{{ $pratica->anni_contratto }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-md-6">
                                                    <label for="id_stato">Stato</label>
                                                    <select id="id_stato" name="id_stato" class="form-control" style="width: 75%;" required>
                                                        <option value="1" {{ $pratica->stato->nome == 1 ? 'selected' : '' }}>Lavorazione</option>
                                                        <option value="2" {{ $pratica->stato->nome == 2 ? 'selected' : '' }}>Finita</option>
                                                        <option value="3" {{ $pratica->stato->nome == 3 ? 'selected' : '' }}>Annullata</option>
                                                    </select>
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
                    @if(count($pratiche) > 8)
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
                            <a class="btn btn-primary" href="{{ route('pages.login') }}">Logout</a>
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
                function modificaPratica(id) {
                    window.location.href = '/modifica-pratica/' + id;
                }

                function eliminaPratica(id) {
                    if (confirm('Sei sicuro di voler eliminare questa pratica?')) {
                        window.location.href = '/elimina-pratica/' + id;
                    }
                }
            </script>
            <script>
                function modificaPratica(id) {
                    window.location.href = '/modifica-pratica/' + id;
                }
            </script>
            <script>
                function mostraModificaForm(id) {
                    $('.modificaForm').hide();
                    $('#modificaForm_' + id).show();
                    $.ajax({
                        url: '/modifica-pratica/' + id + '/get-data',
                        type: 'GET',
                        success: function(data) {
                            $('#indirizzo').val(data.indirizzo);
                            $('#numero_civico').val(data.numero_civico);
                            $('#provincia').val(data.provincia);
                            $('#comune').val(data.comune);
                            $('#cap').val(data.cap);
                            $('#anni_contratto').val(data.anni_contratto);
                            $('#utente').val(data.utente);
                            $('#stato').val(data.stato);
                            $('#modificaForm form').attr('action', '/modifica-pratica/' + id);
                        },
                        error: function(error) {
                            console.error('Errore nel recupero dei dati della pratica:', error);
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
            <script src="https://kit.fontawesome.com/1f4c0029b5.js" crossorigin="anonymous"></script>
</body>

</html>

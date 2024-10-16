<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SB Admin 2 - Dashboard</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        input[type="file"]::file-selector-button {

            border: none;
            background: white;

            color: grey;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type="file"]::file-selector-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        input[type="file"]::file-selector-button:hover {
            background: white;
        }

        input[type="file"] {
            color: transparent;
        }

        .pratica-details-container {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .pratica-details-heading {
            color: #343a40;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .pratica-details-list {
            list-style-type: none;
            padding: 0;
        }

        .detail-label {
            font-weight: bold;
            margin-right: 5px;
        }

        .pratica-details-container {
            display: flex;
            justify-content: space-evenly;
            max-width: 60%;
            margin: auto;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 17px;
        }

        .pratica-details-left,
        .pratica-details-right {
            width: 48%;
        }

        .pratica-details-list {
            list-style-type: none;
            padding: 0;
        }

        .pratica-details-list li {
            margin-bottom: 15px;
            font-family: 'Arial', sans-serif;
        }

        .detail-label {
            font-weight: bold;
            margin-right: 5px;
        }


        .custom-upload-btn {
            display: inline-block;
            background-color: #858585;
            color: #fff;
        }

        .file-input-container {
            width: 10%;
        }

        .file-input-container,
        .col-6 {
            margin: 8% 0;
            padding: 0;
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



                <div class="container mt-5">
                    <div class="card border-0 shadow-lg custom-card">
                        <div class="card-body p-5">
                            <h2 class="card-title text-center mb-4">Carica Allegati</h2>

                            @if($pratica)
                            <div class="pratica-details-container">
                                <div class="pratica-details-column">
                                    <ul class="pratica-details-list">
                                        <li><span class="detail-label">Indirizzo:</span> {{ $pratica->indirizzo }}</li>
                                        <li><span class="detail-label">Numero Civico:</span> {{ $pratica->numero_civico }}</li>
                                        <li><span class="detail-label">Provincia:</span> {{ $pratica->provincia }}</li>
                                    </ul>
                                </div>

                                <div class="pratica-details-column">
                                    <ul class="pratica-details-list">
                                        <li><span class="detail-label">Comune:</span> {{ $pratica->comune }}</li>
                                        <li><span class="detail-label">CAP:</span> {{ $pratica->cap }}</li>
                                        <li><span class="detail-label">Anni Contratto:</span> {{ $pratica->anni_contratto }}</li>
                                    </ul>
                                </div>
                            </div>
                            @endif

                            <form class="user" method="post" action="{{ route('pages.allegati.upload', ['id_pratica' => $praticaId]) }}" id="uploadForm" enctype="multipart/form-data">
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

                                <input type="hidden" name="id_pratica" value="{{ $pratica ? $pratica->id : '' }}">
                                <div class="d-flex justify-content-center">
                                    <div class="file-input-container">
                                        <div class="input-group">

                                            <input type="file" class="form-control short-file-input" id="fileInput" name="file" multiple required onchange="updateFileName(this)">
                                        </div>
                                    </div>
                                    <div class="col-6 me-auto">
                                        <div class="mb-3">

                                            <input type="text" class="form-control short-file-input" id="inputNomeAllegato" name="NomeFile" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary rounded-pill custom-upload-btn" onclick="submitForm()" id="caricaFileBtn" disabled>Carica File</button>
                                </div>
                            </form>
                            <div class="modal fade" id="fileUploadedModal" tabindex="-1" aria-labelledby="fileUploadedModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fileUploadedModalLabel">File inviato!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Vuoi inviare un altro file?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <button type="button" class="btn btn-primary" onclick="sendAnotherFile()">Sì</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="js/demo/comuni.js"></script>
    <script src="js/demo/pratiche.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>

    <script>
        function updateFileName(input) {
            var fileName = input.value.split('\\').pop();
            document.getElementById('inputNomeAllegato').value = fileName;
            document.getElementById('caricaFileBtn').disabled = !input.files.length;
        }

        function submitForm() {
            var formData = new FormData(document.getElementById("uploadForm"));
            axios.post("{{ route('pages.allegati.upload', ['id_pratica' => $praticaId]) }}", formData)
                .then(function(response) {
                    if (confirm('Vuoi inviare un altro file?')) {

                        var fileUploadedModal = new bootstrap.Modal(document.getElementById('fileUploadedModal'));
                        fileUploadedModal.hide();
                        window.location.reload();
                    } else {
                        window.location.href = response.data.redirectUrl;
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
    </script>
    <script src="https://kit.fontawesome.com/1f4c0029b5.js" crossorigin="anonymous"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ url('css/favicon.jpg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ url('amongus.png') }}">
    <style>
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
        .note {
            display: none;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .modal-header,
        .modal-footer {
            border: none;
        }
    </style>

    <!-- Custom fonts for this template-->
{{--    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">--}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    @vite('resources/css/app.css')
    <title>{{ $title ?? 'Dbesto' }}</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/" wire:navigate>
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DBesto</div>
            </a>
            <hr class="sidebar-divider my-0">

            <!-- Nav - Menu Utama -->
            @auth
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}" wire:navigate>
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Menu Utama</span></a>
                    </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Pilih Menu
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed py-2" href="/kehadiran" wire:navigate>
                        Kehadiran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed py-2 " href="/pengeluaran" wire:navigate>
                        Pengeluaran
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    </div>
                </li>
            @endauth
            <!-- Sidebar  -->
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Search -->
                    {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari disini..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search -->
                   {{--     <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Cari disini..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>--}}

                        @auth
                            <!-- Nav Item - User -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-3 d-none d-lg-inline text-gray-600 small">{{auth()->user()->username}}</span>
                                    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    @livewire('logout')
                                </div>
                            </li>
                        @endauth
                    </ul>
                </nav>
                {{$slot}}
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; DBesto 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- Script --}}
    <!-- Bootstrap core JavaScript-->
{{--    <script src="vendor/jquery/jquery.min.js"></script>--}}
{{--    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>--}}

{{--    <!-- Core plugin JavaScript-->--}}
{{--    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>--}}

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js" data-navigate-once></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" data-navigate-once></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" data-navigate-once></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" data-navigate-once></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" data-navigate-once></script>
    <script>
        feather.replace();
    </script>
    <script>
        document.addEventListener('livewire:init', () => {
            window.addEventListener('swal', event => {
                Swal.fire({
                    icon: event.detail.icon,
                    title: event.detail.title,
                })
            });
            window.addEventListener('swal-dialog', event => {
                console.log(event.detail.id)

                Swal.fire({
                    title: event.detail.title,
                    showCancelButton: event.detail.showCancelButton,
                    confirmButtonText: event.detail.confirmButtonText,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch(event.detail.functionName, {id: event.detail.id});
                    }
                })
            });
        });
    </script>
</body>
</html>

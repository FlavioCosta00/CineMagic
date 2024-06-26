<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CineMagic</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{route('admin.dashboard')}}">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('img/CinemaLogo.png')}}" alt="Logo" class="logo-img">
                </div>
                <div class="sidebar-brand-text mx-3">CineMagic</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{Route::currentRouteName()=='admin.dashboard'? 'active': ''}}">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            @if (auth()->user()->tipo == 'A')
            <li class="nav-item {{Route::currentRouteName()=='admin.estatisticas.show' ? 'active': ''}}">
                <a class="nav-link" href="{{route('admin.estatisticas.show')}}">
                    <i class="icon-bar-chart"></i>
                    <span>Estatísticas</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            @can('viewAny', App\Models\Cliente::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.clientes' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.clientes') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Clientes</span></a>
            </li>
            @endcan

            @can('viewAny', App\Models\Filme::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.filmes' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.filmes') }}">
                    <i class="icon-film"></i>
                    <span>Filmes</span></a>
            </li>
            @endcan


            @can('viewAny', App\Models\Sala::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.salas' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.salas') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Salas</span></a>
            </li>
            @endcan

            @can('viewAny', App\Models\Sessao::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.sessoes' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.sessoes') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Sessões</span></a>
            </li>
            @endcan

            @can('viewAny', App\Models\Lugar::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.lugares' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.lugares') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Lugares</span></a>
            </li>
            @endcan

            @can('viewAny', App\Models\Genero::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.generos' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.generos') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Géneros</span></a>
            </li>
            @endcan

            @can('viewAny', App\Models\Bilhete::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.bilhetes' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.bilhetes') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Bilhetes</span></a>
            </li>
            @endcan

            @can('viewAny', App\Models\Recibo::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.recibos' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.recibos') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Recibos</span></a>
            </li>
            @endcan

            @can('viewAny', App\Models\User::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users') }}">
                    <i class="icon-user"></i>
                    <span>Users</span></a>
            </li>
            @endcan


            @can('viewAny', App\Models\Configuracao::class)
            <li class="nav-item {{ Route::currentRouteName() == 'admin.configuracao' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.configuracao') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Configuracao</span></a>
            </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            @endif
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Parte Publica</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @else
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::user()->foto_url ? asset('storage/fotos/' . Auth::user()->foto_url) : asset('img/default_img.png') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @if (auth()->user()->tipo != 'O')
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                @endif
                                <a class="dropdown-item" href="{{route('admin.password.edit')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Alterar Password
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        @endguest
                    </ul>


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @if (session('alert-msg'))
                    @include('partials.message')
                    @endif
                    @if ($errors->any())
                    @include('partials.errors-message')
                    @endif

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            @yield('content')
                        </div>

                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CineMagic 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


</body>

</html>
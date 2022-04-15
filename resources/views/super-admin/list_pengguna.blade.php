<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Sosial Media Desaku</title>    
	<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sb-admin-2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="margin-top: 0;">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/sosial-media/dashboard-admin">
            {{-- <div class="sidebar-brand-icon rotate-n-15"> --}}
            <div class="sidebar-brand-icon">
                {{-- <i class="fas fa-laugh-wink"></i> --}}
                <img src="/logo-home-1.png" style="max-height: 50px;">
            </div>
            <div class="sidebar-brand-text mx-3">DESAFEED</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/sosial-media/dashboard-admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Charts -->
        <li class="nav-item active">
            <a class="nav-link" href="/sosial-media/list-pengguna">
                <i class="fa fa-users"></i>
                <span>List Pengguna</span>
            </a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/sosial-media/list-report">
                <i class="fa fa-warning"></i>
                <span>List Content Report</span>
                @if(COUNT($get) != 0)
                    <span class="badge badge-danger" style="font-size: 10px;"> {{ COUNT($get) }} </span>
                @endif
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

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Super Admin</span>
                    <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    {{-- <a class="dropdown-item" href="/sosial-media/logout_proses">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
                </li>

            </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">List Pengguna</h1>
                    <br>
                    <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#pills-desa" role="tab" aria-controls="pills-desa" aria-selected="true">Akun Desa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-pribadi-tab" data-toggle="pill" href="#pills-pribadi" role="tab" aria-controls="pills-pribadi" aria-selected="false">Akun Pribadi</a>
                        </li>
                    </ul>
                </div>

            <!-- Content Row -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-desa" role="tabpanel" aria-labelledby="pills-desa-tab">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Akun Desa</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableX" width="100%" cellspacing="0">
                                        <thead class="thead-light">
                                            <tr align="center">
                                                <th>No.</th>
                                                <th>Tanggal Join</th>
                                                <th>Foto Profil</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($akun_desa as $data)
                                            <tr align="center">
                                                <td>{{ $i++ }}.</td>
                                                <td>{{ date_format(date_create($data->tgl_join), "d M Y H:i A") }}</td>
                                                <td><img class="img-profile rounded-circle" src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}"></td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->username }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-pribadi" role="tabpanel" aria-labelledby="pills-pribadi-tab">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Akun Pribadi</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableY" width="100%" cellspacing="0">
                                        <thead class="thead-light">
                                            <tr align="center">
                                                <th>No.</th>
                                                <th>Tanggal Join</th>
                                                <th>Foto Profil</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($akun_pribadi as $data)
                                            <tr align="center">
                                                <td>{{ $i++ }}.</td>
                                                <td>{{ date_format(date_create($data->tgl_join), "d M Y H:i A") }}</td>
                                                <td><img class="img-profile rounded-circle" src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}"></td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->username }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                <span>Copyright &copy; Your Website 2020</span>
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
        <i class="fa fa-chevron-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    

    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-action.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> 
    

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script> -->
    <!-- <script src="js/demo/chart-pie-demo.js"></script> -->

</body>

</html>

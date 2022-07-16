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
        
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sb-admin-2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<style>
.highcharts-figure, .highcharts-data-table table {
  min-width: 360px; 
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: black;
}
.highcharts-data-table th {
	font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}

svg.highcharts-root{
  font-family: "Muli", "Segoe Ui" !important;
}

rect.highcharts-background{
  /* fill: #f8f9fc; */
  fill: white;
}

.card-header{
  background: white;
}
</style>

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
          <li class="nav-item active">
            <a class="nav-link" href="/sosial-media/dashboard-admin">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Nav Item - Charts -->
          <li class="nav-item">
            <a class="nav-link" href="/sosial-media/list-pengguna">
              <i class="fa fa-users"></i>
              <span>List Pengguna</span>
            </a>
          </li>

          <!-- Nav Item - Dashboard -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="fa-solid fa-gauge"></i>
              <span>Marketplace</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('manualBook') }}">
              <i class="fa-solid fa-gauge"></i>
              <span>Lahan</span>
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
<div class="container" style="margin-top: 50px" >
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Ubah Manual Book
                </div>
                <div class="card-body">
          
                <form action="{{url('lahan/update_manual')}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 @foreach ($manual as $manual)
                 <div class="form-group">
                     <label>Kategori Lahan</label>
                     <select class="form-control" name="id_categoryLahan" placeholder="--Pilih kategori">
                         @foreach ($category as $category)
                         <option value="{{$category->id}}" @if(old('category',$manual->id_categoryLahan) == $category->id) selected="selected" @endif>
                             {{$category->nama}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    
                        <input type="hidden" name="id_manual" value="{{old('id_manual',$manual->id_manual)}}" class="form-control form-control-user" placeholder="Jenis Lahan">
                            <label>Jenis Lahan</label>
                            <input type="input" name="jenis_lahan" value="{{old('jenis_lahan',$manual->jenis_lahan)}}" class="form-control form-control-user" placeholder="Jenis Lahan">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <img src="{{ url('gambar_manual') }}/{{ $manual->gambar }} "width="50" height="50">
                            <input type="file" name="gambar" value="{{old('gambar',$manual->gambar)}}" required>
                        </div>
                        <div class="form-group">
                            <label>Langkah-Langkah</label>
                            <textarea name="deskripsi" cols="30" rows="10">{{$manual->deskripsi}}</textarea>

                          
                        </div>
                        <div class="form-group">
                            <label>Sumber</label>
                            <input type="input" name="sumber" value="{{old('sumber',$manual->sumber)}}" class="form-control form-control-user" placeholder="sumber">
                        </div>
                   
                        @endforeach               
                        <button type="submit" class="btn btn-success">SIMPAN</button>     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

    
</body>
</html>

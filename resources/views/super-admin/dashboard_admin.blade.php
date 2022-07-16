@php
    foreach($total_akun as $row){
      foreach($akun as $acc){
        $data[] = round(($acc->jml/$row->total)*100);
      }
    }
    
    foreach($total_device as $row){
      foreach($device as $dvc){
        $data_device[] = array(
          'nama'    => $dvc->device,
          'jumlah'  => round(($dvc->jml/$row->total)*100)
        );
      }
    }
    // dd($data_device);
@endphp
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

          <li class="nav-item">
            <a class="nav-link" href="{{route('superadmin.sosial-media.video.index')}}">
              <i class="fa fa-play"></i>
              <span>Video</span>
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

            <!-- Begin Page Content -->
            <div class="container-fluid">

              <!-- Page Heading -->
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download"></i> Generate Report</a> --}}
              </div>

              <!-- Content Row -->
              <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengguna (Weekly)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_weekly }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengguna (Total)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fa fa-users fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Report Task (To Do)</div>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ COUNT($get) }} <small>{{ COUNT($get) <= 1 ? 'report' : 'reports' }}</small></div>
                        </div>
                        <div class="col-auto">
                          <i class="fa fa-warning fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Content Row -->

              <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-7">
                  <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      {{-- <h6 class="m-0 font-weight-bold text-primary">Chart Pengguna (per week)</h6> --}}
                      <div class="x_panel">
                          <div class="x_title">
                            <h2 class="m-0 font-weight-bold text-primary">Statistik Jumlah Pengguna</h2>
                            <ul class="toolbox">
                              <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                            </ul>
                          </div>
                          <div class="x_content">
                              <select name="filter" id="filter_time" class="form-control form-control-sm">
                                <option value="0" selected>Per Bulan</option>
                                <option value="1">Per Tahun</option>
                              </select>
                              <figure class="highcharts-figure">
                                <div id="container"></div>
                              </figure>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-6 col-lg-7">
                  <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <div class="x_panel">
											  <div class="x_title">
												<h2 class="m-0 font-weight-bold text-primary">Statistik Jenis Akun</h2>
												<ul class="toolbox">
												  <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
												  </li>
												</ul>
											  </div>
											  <div class="x_content">
												  <figure class="highcharts-figure">
                            <div id="container-pie"></div>
                          </figure>
											  </div>
											</div>
                    </div>
                  </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-6 col-lg-5">
                  <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <div class="x_panel">
											  <div class="x_title">
                          <h2 class="m-0 font-weight-bold text-primary">Statistik Jenis Device</h2>
                          <ul class="toolbox">
                            <li>
                              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                          </ul>
											  </div>
											  <div class="x_content">
                          <figure class="highcharts-figure">
                            <div id="container-mini-pie"></div>
                          </figure>
                        </div>
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
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
      $('#filter_time').on('change', function(){
        let x_tmp = $(this).val();
        if(x_tmp == 0){
           var new_serie = [
              {data: {{ $total_pengguna }},
              name: 'Pengguna Baru'}
          ];
          var cat = {!! $monthAndYear !!}
          var subt = '5 bulan terakhir';
        }else{
          var new_serie = [
              {data: {{ $total_pengguna_year }},
              name: 'Pengguna Baru'}
          ];
          var cat = {!! $year !!}
          var subt = '5 tahun terakhir';
        }

        for (var i = chart.series.length-1; i>=0; i--) {
            chart.series[i].remove();
        }
        for (var y = new_serie.length-1; y >= 0; y--) {
            chart.addSeries(new_serie[y]);
            chart.xAxis[0].setCategories(cat);
            chart.setTitle(null, { text: subt });
        }
      });
      
      let chart = Highcharts.chart('container', {
        credits: {
          enabled: false
        },

        title: {
          text: 'Kenaikan Jumlah Pengguna <b style="font-style: italic;">"Desafeed"</b>'
        },

        subtitle: {
          text: '5 bulan terakhir'
        },

        yAxis: {
          title: {
            text: 'Jumlah Pengguna'
          }
        },

        xAxis: {
          categories: {!! $monthAndYear !!},
          reversed: true
        },

        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
        },

        series: [{
          data: {{ $total_pengguna }},
          name: 'Pengguna Baru'
        }],

        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }

      });

      Highcharts.chart('container-pie', {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: 'Perbandingan Jumlah Jenis Akun'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
          point: {
            valueSuffix: '%'
          }
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
          }
        },
        series: [{
          name: 'Jumlah',
          colorByPoint: true,
          data: [{
            name: 'Akun Desa',
            y: <?php echo json_encode($data[0]);?>,
            sliced: true,
            selected: true
          }, {
            name: 'Akun Pribadi',
            y: <?php echo json_encode($data[1]);?>
          }]
        }]
      });

      Highcharts.chart('container-mini-pie', {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: 0,
          plotShadow: false
        },
        title: {
          text: 'Jenis<br>Device',
          align: 'center',
          verticalAlign: 'middle',
          y: 60
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
          point: {
            valueSuffix: '%'
          }
        },
        plotOptions: {
          pie: {
            dataLabels: {
              enabled: true,
              distance: -50,
              style: {
                fontWeight: 'bold',
                color: 'white'
              }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%'],
            size: '110%'
          }
        },
        series: [{
          type: 'pie',
          name: 'Jumlah Akses',
          innerSize: '50%',
          data: [ <?php for($i=0; $i<COUNT($data_device); $i++){ ?>
            [<?php echo json_encode($data_device[$i]['nama']);?>, <?php echo json_encode($data_device[$i]['jumlah']);?>],
            <?php } ?>
            // {
            //   name: 'Other',
            //   y: 0,
            //   dataLabels: {
            //     enabled: false
            //   }
            // }
          ]
        }]
      });
    </script>

</body>

</html>

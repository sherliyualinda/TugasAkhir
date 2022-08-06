 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anggaran Awal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css3/styles.css" rel="stylesheet" />

@include('nav_barMar')
        
 <style type="text/css">
            html, body{
                height:100%;
                padding:0px;
                margin:0px;
                
            }
 
    </style>
</head>
<?php session_start() ?>
    <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                 <li>            
                    <a href="/lahan/request/{{$_SESSION['id_lahan']}}" class="btn btn-secondary"> < Kembali</a>
                </li>
            </ol>
        </nav>
    </div>
<!-- <body style="background: lightgray"> -->

    <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/gantt/{{$_SESSION['id_sewa']}}">Jadwal Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/wbs/{{$_SESSION['id_sewa']}}">Anggaran Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('boq-wbs', $_SESSION['id_sewa'])}}">Anggaran Awal</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('scurve', $_SESSION['id_sewa'])}}">Grafik</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_risk/{{$_SESSION['id_sewa']}}">Risiko</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/lihat_jadwal/{{$_SESSION['id_sewa']}}">Kalender Ketemu</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/jadwal/kelola/{{$_SESSION['id_sewa']}}">Jadwal Ketemu</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_daily/{{$_SESSION['id_sewa']}}">Laporan Harian</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_struk/{{$_SESSION['id_sewa']}}">Struk Pembayaran</a>
                </div>
            </div>
            <!-- Page content wrapper-->
           
                <!-- Page content-->
                <div class="container">
                    <!-- ini isi -->
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-header text-center"><h2>Anggaran Awal</h2></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Uraian Pekerjaan</th>
                                <th scope="col">Jumlah Harga</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $total = 0;
                                @endphp
                                @foreach ($history as $parent)
                                @if ($parent->parent == 0)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$parent->text}}</td>
                                        <td>{{number_format($parent->totalHarga)}}
                                            @php
                                                $total += $parent->totalHarga
                                            @endphp
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-right h5">Total</td>
                                    <td class="h5">{{number_format($total)}}</td>
                                </tr>
                            </tbody>
                          </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>

      <!-- tutup isi -->
      </div>




      <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    @yield('js')
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js3/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js3/scripts.js"></script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Jadwal Ketemu</title>
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
 
<?php session_start(); ?>
</head>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <div class="col-md-12 mt-2">
                        <nav aria-label="breadcrumb">
                        <!-- <ol class="breadcrumb">
                    
                        <li class="breadcrumb-item"><a href="/lahan/request/{{$_SESSION['id_lahan']}}">Back</a></li>
                        </ol> -->
                        </nav>
                    </div>
                    @foreach($jadwal2 as $index=>$jadwal2)
                    <table>
                        <tr>
                            <th scope="col">Nama Penyewa</th>          
                            <th scope="col">:</th>     
                            <td>{{ $jadwal2->nama}}</td>     
                                               
                        </tr>
                        <tr>
                            <th scope="col" >NIK</th>     
                            <th scope="col">:</th>     
                            <td>{{ $jadwal2->nik}}</td>                         
                        </tr>
                        
                    </table>
                    @endforeach

                    @foreach($jadwal3 as $index=>$jadwal3)
                    <table>
                        <tr>
                             <td>
                                 <a href="/lahan/createJadwal/{{$jadwal3->id_sewa}}" class="btn btn-sm btn-info">Tambah Jadwal</a>
                                 
                            </td>
                        </tr>
                    
                    </table>
                    @endforeach
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Tanggal</th>
                                <th scope="col">Agenda</th>                               
                                <th scope="col">Keterangan</th>
                                <th scope="col">Link Meet</th>
                                <th scope="col">Kelola</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($jadwal as $index=>$jadwals)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{$jadwals->date}}</td>
                                    <td>{{$jadwals->agenda}}</td>
                                    <td>{{$jadwals->keterangan}}</td>
                                    <td>{{$jadwals->linkMeet}}</td>
                                    <td>
                                        <a href="/lahan/ubah_jadwal/{{$jadwals->id_jadwal}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                        
                              @endforeach   
                            </tbody>
                          </table>  
                          <div>
                            Showing {{ $jadwal->firstItem() }}
                            to {{ $jadwal->lastItem() }}
                            of {{ $jadwal->total() }}
                            entries
                        </div>
                        <div class="pull-right">
                            {{ $jadwal->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tutup isi -->


    </div>
            

<!--     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->


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

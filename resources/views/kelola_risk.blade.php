
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Risiko</title>
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
 
</head>
<div class="col-md-12 mt-2">
    <?php session_start(); ?>
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
                                <div class="card-body">
                                <div class="col-md-12 mt-2">
                                    <nav aria-label="breadcrumb">
                                    <!-- <ol class="breadcrumb">
                                    
                                    <li class="breadcrumb-item"><a href="/lahan/request/{{$_SESSION['id_lahan']}}">Back</a></li>
                                    </ol> -->
                                    </nav>
                                </div>
                                @foreach($risk2 as $index=>$risk2)
                                <table>
                                    <tr>
                                        <th scope="col">Nama Penyewa</th>          
                                        <th scope="col">:</th>     
                                        <td>{{ $risk2->nama}}</td>     
                                                        
                                    </tr>
                                    <tr>
                                        <th scope="col" >NIK</th>     
                                        <th scope="col">:</th>     
                                        <td>{{ $risk2->nik}}</td>                         
                                    </tr>
                                    
                                </table>
                                @endforeach

                                @foreach($risk3 as $index=>$risk3)
                                <table>
                                    <tr>
                                        <td>
                                            <a href="/lahan/createRisk/{{$risk3->id_sewa}}" class="btn btn-sm btn-info">Tambah Resiko</a>
                                        </td>
                                    </tr>
                                
                                </table>
                                @endforeach
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">No</th>                                
                                            <th scope="col">Penyebab</th>
                                            <th scope="col">Dampak</th>                               
                                            <th scope="col">Strategi</th>                               
                                            <th scope="col">Biaya</th>                               
                                            <th scope="col">Probabilitas</th>                               
                                            <th scope="col">Impact</th>                               
                                            <th scope="col">Level Risk</th>                               
                                            <th scope="col">Kelola</th>                               
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($risk as $index=>$risks)
                                            <tr>
                                                <td>{{ $index+1}}</td>
                                                <td>{{ $risks->penyebab}}</td>
                                                <td>{{ $risks->dampak}}</td>
                                                <td>{{ $risks->strategi}}</td>
                                                <td>{{ $risks->biaya}}</td>
                                                <td>{{ $risks->ket}}</td>
                                                <td>{{ $risks->ket_impact}}</td>
                                                <td>{{ $risks->levelRisk}}</td>
                                                <td>
                                                    <a href="/lahan/ubah_risk/{{$risks->id_risk}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                                </td>

                                            </tr>
                                    
                                        @endforeach   
                                        </tbody>
                                    </table>  
                                    <div>
                                        Showing {{ $risk->firstItem() }}
                                        to {{ $risk->lastItem() }}
                                        of {{ $risk->total() }}
                                        entries
                                    </div>
                                    <div class="pull-right">
                                        {{ $risk->links("pagination::bootstrap-4") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    


                    <!-- tutup isi -->
                </div>
            
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
<!--     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 -->


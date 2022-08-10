<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kalender</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')
  




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
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Back</a></li>
                        </ol> -->
                        </nav>
                    </div>
                    <h3>Jadwal Pertemuan</h3>
    
    
<div id='calendar'></div>

                     </div>
                </div>
            </div>
        </div>
    </div>
   
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events : [
                @foreach($jadwal as $jadwal)
                {
                    title : '{{ $jadwal->agenda }}',
                    start : '{{ $jadwal->date }}',
                    link : '{{ $jadwal->linkMeet }}',
                    url : '/lahan/ubah_jadwal/{{$jadwal->id_jadwal}}'
                },
                @endforeach
            ]
        })
    });
</script>

@yield('js')
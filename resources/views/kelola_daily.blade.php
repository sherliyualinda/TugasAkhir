
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Laporan Harian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

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

     <!-- Core theme CSS (includes Bootstrap)-->
     <link href="css3/styles.css" rel="stylesheet" />


    <style>
    
    
    .modal-body{
        height: 80vh;
        
    }
    </style>


<?php session_start(); ?>
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
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/surat_pemilik/{{$_SESSION['id_sewa']}}">Surat Perjanjian</a>    
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/gantt/{{$_SESSION['id_sewa']}}">Jadwal Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/wbs/{{$_SESSION['id_sewa']}}">Anggaran Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('boq-wbs', $_SESSION['id_sewa'])}}">Anggaran Awal</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('scurve', $_SESSION['id_sewa'])}}">Grafik</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_risk/{{$_SESSION['id_sewa']}}">Risiko</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/lihat_jadwal/{{$_SESSION['id_sewa']}}">Kalender Ketemu</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/jadwal/kelola/{{$_SESSION['id_sewa']}}">Jadwal Ketemu</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 active" href="/lahan/kelola_daily/{{$_SESSION['id_sewa']}}">Laporan Harian</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_struk/{{$_SESSION['id_sewa']}}">Struk Pembayaran</a>
                </div>
            </div>
            <!-- Page content wrapper-->
           
                <!-- Page content-->
                <div class="container">
                    <!-- isi -->
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
                    @foreach($daily2 as $index=>$daily2)
                    <table>
                        <tr>
                            <th scope="col">Nama Penyewa</th>          
                            <th scope="col">:</th>     
                            <td>{{ $daily2->nama}}</td>     
                                               
                        </tr>
                        <tr>
                            <th scope="col" >NIK</th>     
                            <th scope="col">:</th>     
                            <td>{{ $daily2->nik}}</td>                         
                        </tr>
                        
                    </table>
                    @endforeach

                    @foreach($daily3 as $index=>$daily3)
                    <!-- <table>
                        <tr>
                             <td>
                                 <a href="/lahan/createDaily/{{$daily3->id_sewa}}" class="btn btn-sm btn-info">Tambah Laporan Harian</a>
                            </td>
                        </tr>
                    
                    </table> -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="/lahan/createDaily/{{$daily3->id_sewa}}">
                    Tambah Data
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Laporan Harian </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{url('lahan/simpan_daily/{id}')}}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                        {{ csrf_field() }}
                            @foreach ($daily4 as $dailyy)
                                <div class="form-group">
                                    <input type="hidden" name="id_sewa" value="{{$dailyy->id_sewa}}">
                                </div>
                            @endforeach
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" name="gambar">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control form-control-user" rows="4" placeholder="Masukkan Keterangan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="date" class="form-control form-control-user" placeholder="Tanggal">
                                </div>                  
                                                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">SIMPAN</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>

                    <!-- tutup modal -->


                    @endforeach
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Gambar</th>
                                <th scope="col">keterangan</th>                               
                                <th scope="col">date</th>
                                <th scope="col">Kelola</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($daily as $index=>$dailies)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>
                                        <a href="{{ url('gambar_daily') }}/{{ $dailies->gambar }}" target="_blank"><img src="{{ url('gambar_daily') }}/{{ $dailies->gambar }} "width="50" height="50"><a>
                                       
                                    </td>
                                    <td>{{ $dailies->keterangan}}</td>
                                    <td>{{ $dailies->date}}</td>
                                    <td>
                                        <a href="/lahan/ubah_daily/{{$dailies->id_daily}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                        
                              @endforeach   
                            </tbody>
                          </table>  
                          <div>
                            Showing {{ $daily->firstItem() }}
                            to {{ $daily->lastItem() }}
                            of {{ $daily->total() }}
                            entries
                        </div>
                        <div class="pull-right">
                            {{ $daily->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tutup isi -->
    </div>


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

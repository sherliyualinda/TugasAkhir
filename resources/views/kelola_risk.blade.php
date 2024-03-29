
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Risiko</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdn.jsdelivr.net/n-pm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

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




<style>


.modal-body{
    height: 80vh;
    
}
</style>

   
    <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/surat_pemilik/{{$_SESSION['id_sewa']}}">Surat Perjanjian</a>    
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/gantt/{{$_SESSION['id_sewa']}}">Jadwal Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/wbs/{{$_SESSION['id_sewa']}}">Anggaran Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('boq-wbs', $_SESSION['id_sewa'])}}">Anggaran Awal</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('scurve', $_SESSION['id_sewa'])}}">Grafik</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 active" href="/lahan/kelola_risk/{{$_SESSION['id_sewa']}}">Risiko</a>
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
                                <!-- <table>
                                    <tr>
                                        <td>
                                            <a href="/lahan/createRisk/{{$risk3->id_sewa}}" class="btn btn-sm btn-info">Tambah Resiko</a>
                                        </td>
                                    </tr>
                                
                                </table> -->

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" href="/lahan/createRisk/{{$risk3->id_sewa}}">
                                Tambah Risiko
                                </button>



                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Risiko</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{url('lahan/simpan_risk/{id}')}}" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                        {{ csrf_field() }}
                                            @foreach ($risk4 as $riskk)
                                                <div class="form-group">
                                                    <input type="hidden" name="id_sewa" value="{{$riskk->id_sewa}}">
                                                </div>
                                            @endforeach
                                                <div class="form-group">
                                                    <label>Penyebab Risiko</label>
                                                    <input type="input" name="penyebab" class="form-control form-control-user" placeholder="Penyebab">
                                                </div>
                                                <div class="form-group">
                                                    <label>Dampak Risiko</label>
                                                    <input type="input" name="dampak" class="form-control form-control-user" placeholder="Dampak">
                                                </div>
                                                <div class="form-group">
                                                    <label>Strategi</label>
                                                    <input type="input" name="strategi" class="form-control form-control-user" placeholder="Strategi">
                                                </div>
                                                <div class="form-group">
                                                    <label>Biaya</label>
                                                    <input type="biaya" name="biaya" class="form-control form-control-user" placeholder="Biaya">
                                                </div>
                                                <div class="form-group">
                                                    <label>Probabilitas</label>
                                                    <select class="form-control" name="probabilitas" placeholder="--Skala Kemungkinan--">
                                                        <option value="1">Rendah</option>
                                                        <option value="2">Sedang</option>
                                                        <option value="3">Tinggi</option>
                                                    
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Dampak</label>
                                                    <select class="form-control" name="impact" placeholder="--Skala Dampak">
                                                        <option value="1">Rendah</option>
                                                        <option value="2">Sedang</option>
                                                        <option value="3">Tinggi</option>
                                                    
                                                    </select>
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
                                            <th scope="col">Penyebab</th>
                                            <th scope="col">Dampak</th>                               
                                            <th scope="col">Strategi</th>                               
                                            <th scope="col">Biaya</th>                               
                                            <th scope="col">Probabilitas</th>                               
                                            <th scope="col">Dampak</th>                               
                                            <th scope="col">Level Risiko</th>                               
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>



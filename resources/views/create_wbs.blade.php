<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anggaran Kegiatan</title>
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
        
    </div>

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

<form action="#" method="POST">

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

        <div class="row" >
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">                   
                        <table class="table table-bordered" >
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kegiatan Induk</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th>
                                <th>
                                    kelola
                                </th>

                              </tr>
                            </thead>
                            <tbody>
                        
                            <?php //$sum = array(); ?>
                            @foreach($wbs as $index=>$wbs)
                            
                            
                                <?php
                                // $sum[]= $wbs->thCucu;
                                // $Total = array_sum($sum);
                                // echo $Total;
                                if(!isset($nenek)){
                                    $nenek  = $wbs->Nenek;
                                    $ibu    = $wbs->Ibu;
                                    //$totN = array_sum($arr);
                                    $iter = array(1,1,1);
                                    ?>
                                    
                                    <tr>
                                        <td><b>{{ $iter[0] }}</b></td>
                                        <td><b>{{$wbs->Nenek}}</b></td>
                                        <td>{{ $wbs->tanggalNenek }}</td>
                                        <td>{{ (int)$wbs->qtyNenek > 0 ? $wbs->qtyNenek : "-" }}</td>
                                        <td>{{ (int)$wbs->qtyNenek > 0 ? $wbs->satuanNenek : "-" }}</td>
                                        <td>{{ (int)$wbs->hargaNenek > 0 ? $wbs->hargaNenek : "-" }}</td>
                                        <td>{{ $wbs->thNenek }}</td>
                                        <td>
                                            <?php if($wbs->Id_Nenek != $wbs->Parent_Ibu){?>
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Nenek}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                            <?php }else{?>
                                                
                                                <?php }?>
                                        </td>
                                    </tr>
                                    <?php if(!empty($wbs->Ibu)){ ?>

                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] }}</td>
                                        <td>{{ $wbs->Ibu }}</td>
                                        <td>{{ $wbs->tanggalIbu }}</td>
                                        <td>{{ (int)$wbs->qtyIbu > 0 ? $wbs->qtyIbu : "-" }}</td>
                                        <td>{{ (int)$wbs->qtyIbu > 0 ? $wbs->satuanIbu : "-" }}</td>
                                        <td>{{ $wbs->hargaIbu > 0 ? $wbs->hargaIbu : "-" }}</td>
                                        <td>{{ $wbs->thIbu }}</td>
                                        <td>
                                            <?php if($wbs->Id_Ibu != $wbs->Parent_Cucu){?>
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Ibu}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                            <?php }else{?>
                                                
                                                <?php }?>
                                        </td>
                                    </tr>

                                    <?php } if(!empty($wbs->Cucu)){ ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] .".". $iter[2]}}</td>
                                        <td>{{ $wbs->Cucu }}</td>
                                        <td>{{ $wbs->tanggalCucu }}</td>
                                        <td>{{ $wbs->qtyCucu }}</td>
                                        <td>{{ $wbs->satuanCucu }}</td>
                                        <td>{{ $wbs->hargaCucu }}</td>
                                        <td>{{ $wbs->thCucu }}</td>
                                        <td>
                                             <a href="/lahan/update_wbs/{{$wbs->Id_Cucu}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php } elseif($nenek == $wbs->Nenek && $ibu == $wbs->Ibu){ 
                                            $iter[2] += 1;
                                    ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] .".". $iter[2]}}</td>
                                        <td>{{ $wbs->Cucu }}</td>
                                        <td>{{ $wbs->tanggalCucu }}</td>
                                        <td>{{ $wbs->qtyCucu }}</td>
                                        <td>{{ $wbs->satuanCucu }}</td>
                                        <td>{{ $wbs->hargaCucu }}</td>
                                        <td>{{ $wbs->thCucu }}</td>
                                        <td>
                                             <a href="/lahan/update_wbs/{{$wbs->Id_Cucu}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                <?php } elseif($nenek == $wbs->Nenek && $ibu != $wbs->Ibu && !empty($wbs->Ibu)){ 
                                            $iter[2] = 1;
                                            $iter[1] += 1;
                                            $ibu = $wbs->Ibu;
                                    ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] }}</td>
                                        <td>{{ $wbs->Ibu }}</td>
                                        <td>{{ $wbs->tanggalIbu }}</td>
                                        <td>{{ (int)$wbs->qtyIbu > 0 ? $wbs->qtyIbu : "-" }}</td>
                                        <td>{{ (int)$wbs->qtyIbu > 0 ? $wbs->satuanIbu : "-" }}</td>
                                        <td>{{ $wbs->hargaIbu > 0 ? $wbs->hargaIbu : "-" }}</td>
                                        <td>{{ $wbs->thIbu }}</td>
                                        <td>
                                            <?php if($wbs->Id_Ibu != $wbs->Parent_Cucu){?>
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Ibu}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                            <?php }else{?>
                                                
                                                <?php }?>
                                        </td>
                                    </tr>
                                    <?php if(!empty($wbs->Cucu)){ ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] .".". $iter[2]}}</td>
                                        <td>{{ $wbs->Cucu }}</td>
                                        <td>{{ $wbs->tanggalCucu }}</td>
                                        <td>{{ $wbs->qtyCucu }}</td>
                                        <td>{{ $wbs->satuanCucu }}</td>
                                        <td>{{ $wbs->hargaCucu }}</td>
                                        <td>{{ $wbs->thCucu }}</td>
                                        <td>
                                             <a href="/lahan/update_wbs/{{$wbs->Id_Cucu}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php } elseif($nenek != $wbs->Nenek){ 
                                            $iter[2] = 1;
                                            $iter[1] = 1;
                                            $iter[0] += 1;
                                            $nenek = $wbs->Nenek;
                                            $ibu = $wbs->Ibu;
                                    ?>
                                    <tr>
                                        <td><b>{{ $iter[0] }}</b></td>
                                        <td><b>{{ $wbs->Nenek }}</b></td>
                                        <td>{{ $wbs->tanggalNenek }}</td>
                                        <td>{{ (int)$wbs->qtyNenek > 0 ? $wbs->qtyNenek : "-" }}</td>
                                        <td>{{ (int)$wbs->qtyNenek > 0 ? $wbs->satuanNenek : "-" }}</td>
                                        <td>{{ (int)$wbs->hargaNenek > 0 ? $wbs->hargaNenek : "-" }}</td>
                                        <td>{{ $wbs->thNenek }}</td>
                                        <td>
                                            <?php if($wbs->Id_Nenek != $wbs->Parent_Ibu){?>
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Nenek}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                            <?php }else{?>
                                                
                                                <?php }?>
                                        </td>
                                    </tr>
                                    <?php if(!empty($wbs->Ibu)){ ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] }}</td>
                                        <td>{{ $wbs->Ibu }}</td>
                                        <td>{{ $wbs->tanggalIbu }}</td>
                                        <td>{{ (int)$wbs->qtyIbu > 0 ? $wbs->qtyIbu : "-" }}</td>
                                        <td>{{ (int)$wbs->qtyIbu > 0 ? $wbs->satuanIbu : "-" }}</td>
                                        <td>{{ $wbs->hargaIbu > 0 ? $wbs->hargaIbu : "-" }}</td>
                                        <td>{{ $wbs->thIbu }}</td>
                                        <td>
                                            <?php if($wbs->Id_Ibu != $wbs->Parent_Cucu){?>
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Ibu}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                            <?php }else{?>
                                                
                                                <?php }?>
                                        </td>
                                    </tr>
                                        <?php } if(!empty($wbs->Cucu)){ ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] .".". $iter[2]}}</td>
                                        <td>{{ $wbs->Cucu }}</td>
                                        <td>{{ $wbs->tanggalCucu }}</td>
                                        <td>{{ $wbs->qtyCucu }}</td>
                                        <td>{{ $wbs->satuanCucu }}</td>
                                        <td>{{ $wbs->hargaCucu }}</td>
                                        <td>{{ $wbs->thCucu }}</td>
                                        <td>
                                             <a href="/lahan/update_wbs/{{$wbs->Id_Cucu}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                <?php }} ?>
                                @endforeach
                                      
                                </tbody>
                            </table>
                            @if (!isset($history))
                                @foreach($wbs2 as $index=>$wbs2)
                                <a href="/lahan/simpan_history/{{$wbs2->id_sewa}}" class="btn btn-sm btn-warning">Save</a>
                                @endforeach
                            @endif
                    </div>
                </div>
            </div>
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


</body>
</html>
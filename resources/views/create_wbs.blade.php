@extends('layouts2.main')

@section('title', 'WBS')

@section('content') 

<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')



<form action="#" method="POST">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <li class="breadcrumb-item"><a href="/gantt/{{$_SESSION['id_sewa']}} " class="btn btn-secondary mb-3">< Kembali</a></li>                       
                        <table class="table table-bordered">
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
@endsection


<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    @yield('js')
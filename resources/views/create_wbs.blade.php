<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman WBS</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
	
        @include('nav_barMar')

<body style="background: lightgray">
<form action="#" method="POST">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <div class="col-md-12 mt-2">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           
                            <li class="breadcrumb-item"><a href="/gantt/{{$_SESSION['id_sewa']}}">Back</a></li>
                        </ol>
                        </nav>
                    </div>                        
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
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Nenek}}" class="btn btn-sm btn-success">Edit</a>
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
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Ibu}}" class="btn btn-sm btn-success">Edit</a>
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
                                             <a href="/lahan/update_wbs/{{$wbs->Id_Cucu}}" class="btn btn-sm btn-success">Edit</a>
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
                                             <a href="/lahan/update_wbs/{{$wbs->Id_Cucu}}" class="btn btn-sm btn-success">Edit</a>
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
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Ibu}}" class="btn btn-sm btn-success">Edit</a>
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
                                             <a href="/lahan/update_wbs/{{$wbs->Id_Cucu}}" class="btn btn-sm btn-success">Edit</a>
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
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Nenek}}" class="btn btn-sm btn-success">Edit</a>
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
                                                
                                                <a href="/lahan/update_wbs/{{$wbs->Id_Ibu}}" class="btn btn-sm btn-success">Edit</a>
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
                                             <a href="/lahan/update_wbs/{{$wbs->Id_Cucu}}" class="btn btn-sm btn-success">Edit</a>
                                        </td>
                                    </tr>
                                <?php }} ?>
                                @endforeach
                                      
                                </tbody>
                            </table>  
                            @foreach($wbs2 as $index=>$wbs2)
                            <a href="/lahan/simpan_history/{{$wbs2->id_sewa}}" class="btn btn-sm btn-success">Save</a>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>
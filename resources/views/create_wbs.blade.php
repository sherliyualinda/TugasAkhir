@extends('layouts2.main')

@section('title', 'WBS')

@section('content') 
<form action="#" method="POST">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">< Kembali</a>                       
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
                            @if (!isset($history))
                                @foreach($wbs2 as $index=>$wbs2)
                                <a href="/lahan/simpan_history/{{$wbs2->id_sewa}}" class="btn btn-sm btn-success">Save</a>
                                @endforeach
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman BOQ</title>
    
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kegiatan Induk</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th>
                                    kelola
                                </th>

                              </tr>
                            </thead>
                            <tbody>
                            @foreach($wbs as $index=>$wbs)
                                <?php
                                if(!isset($nenek)){
                                    $nenek  = $wbs->Nenek;
                                    $ibu    = $wbs->Ibu;
                                    $iter = array(1,1,1);
                                    ?>
                                    <tr>
                                        <td><b>{{ $iter[0] }}</b></td>
                                        <td><b>{{ $wbs->Nenek }}</b></td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                    </tr>
                                    <?php if(!empty($wbs->Ibu)){ ?>

                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] }}</td>
                                        <td>{{ $wbs->Ibu }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                    </tr>

                                    <?php } if(!empty($wbs->Cucu)){ ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] .".". $iter[2]}}</td>
                                        <td>{{ $wbs->Cucu }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                    </tr>
                                    <?php } ?>
                                <?php } elseif($nenek == $wbs->Nenek && $ibu == $wbs->Ibu){ 
                                            $iter[2] += 1;
                                    ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] .".". $iter[2]}}</td>
                                        <td>{{ $wbs->Cucu }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                    </tr>
                                <?php } elseif($nenek == $wbs->Nenek && $ibu != $wbs->Ibu && !empty($wbs->Ibu)){ 
                                            $iter[2] = 1;
                                            $iter[1] += 1;
                                            $ibu = $wbs->Ibu;
                                    ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] }}</td>
                                        <td>{{ $wbs->Ibu }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                    </tr>
                                    <?php if(!empty($wbs->Cucu)){ ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] .".". $iter[2]}}</td>
                                        <td>{{ $wbs->Cucu }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
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
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                    </tr>
                                    <?php if(!empty($wbs->Ibu)){ ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] }}</td>
                                        <td>{{ $wbs->Ibu }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                    </tr>
                                        <?php } if(!empty($wbs->Cucu)){ ?>
                                    <tr>
                                        <td>{{ $iter[0] .".". $iter[1] .".". $iter[2]}}</td>
                                        <td>{{ $wbs->Cucu }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                    </tr>
                                <?php }} ?>
                                
                                    @endforeach   
                                </tbody>
                            </table>  
                            <a href="#" class="btn btn-sm btn-success">Save</a>
                       
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
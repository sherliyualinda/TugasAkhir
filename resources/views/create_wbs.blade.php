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
                            @foreach($wbs as $index=>$wbs)

                            <tr>
                                
                                <?php
                                    if($wbs->parent == null && $wbs->idNenek == null){?>
                                        <td>{{1}}</td>
                                        <td>{{ $wbs->nenek }}</td>
                                        <td>{{ $wbs->start_date }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                        <td>{{ $wbs->totalHarga }}</td>
                                
                                <?php }elseif($wbs->parent == null && $wbs->idNenek != null ){?>
                                        <td>{{1}}</td>
                                        <td>{{ $wbs->induk }}</td>
                                        <td>{{ $wbs->start_date }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                        <td>{{ $wbs->totalHarga }}</td>
                                
                                <?php }else{ ?>
                                        <td>{{1}}</td>
                                        <td>{{ $wbs->anak }}</td>
                                        <td>{{ $wbs->start_date }}</td>
                                        <td>{{ $wbs->qty }}</td>
                                        <td>{{ $wbs->satuan }}</td>
                                        <td>{{ $wbs->harga }}</td>
                                        <td>{{ $wbs->totalHarga }}</td>
                                        
                                        <?php } ?>
                                        
                                        @endforeach   
                            </tr>
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
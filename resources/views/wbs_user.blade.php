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

</div>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">                        
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Durasi</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($wbs as $index=>$wbs)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <?php if($wbs->parent == 0){?>
                                        <td><b>{{ $wbs->text}}</b></td>
                                    <?php }else{?>
                                        <td>{{ $wbs->text}}</td>
                                    <?php }?>
                                    <td>{{ $wbs->duration}}</td>
                                    <td>{{ $wbs->start_date}}</td>

                                    <td>{{ $wbs->qty}}</td>
                                    <td>{{ $wbs->harga}}</td>
                                    <td>{{ $wbs->totalHarga}}</td>
                                </tr>
                              @endforeach   
                            </tbody>
                          </table>  
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    function edit(val){
        alert(val)
        }
    </script>


</body>
</html>
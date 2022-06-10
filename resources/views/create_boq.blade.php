<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman BOQ</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
	
        @include('nav_barMar')

</div>
<body style="background: lightgray">
<form action="proses.php" method="POST">
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
                                <th>
                                    kelola
                                </th>
                                <!-- <th scope="col">QTY</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th> -->
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($boq as $index=>$boq)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <?php if($boq->parent == 0){?>
                                        <td><b>{{ $boq->text}}</b></td>
                                    <?php }else{?>
                                        <td>{{ $boq->text}}</td>
                                    <?php }?>
                                    <td>{{ $boq->duration}}</td>
                                    <td>{{ $boq->start_date}}</td>
                                    <td>
                                        <?php if($boq->parent != 0){?>
                                        <button class="btn btn-success add-more" type="button">
                                            <i class="glyphicon glyphicon-plus"></i> Add
                                        </button>
                                        <?php }else {?>

                                        <?php }
                                        ?>
                                    </td>

                                    <!-- <td>{{ $boq->qty}}</td>
                                    <td>{{ $boq->satuan}}</td>
                                    <td>{{ $boq->harga}}</td>
                                    <td>{{ $boq->totalHarga}}</td> -->
                                </tr>
                                    @endforeach   
                                </tbody>
                            </table>  
                            <a href="/lahan/update_boq/{{$boq->id}}" class="btn btn-sm btn-success">Save</a>
                       
                    </div>
                    <div class="copy hide">
                        <div class="control-group">
                            <label>Kegiatan</label>
                                <input type="input" name="kegiatan" class="form-control">
                            <label>Qty</label>
                                <input type="input" name="qty" class="form-control">
                            <label>Satuan</label>
                                <input type="input" name="satuan" class="form-control">
                            <label>Harga</label>
                                <input type="input" name="harga" class="form-control">
                            <label>Total Harga</label>
                                <input type="input" name="totalHarga" class="form-control">
                            <br>
                            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
</script>


</body>
</html>
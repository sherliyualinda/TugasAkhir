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
                                <th scope="col">Kegiatan Induk</th>
                                <!-- <th scope="col">Kegiatan Anak</th> -->
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
                                    
                                    <?php 
                                    if(!isset($last_parent)){
                                        $last_parent = $boq->induk;
                                        $Lindex=1;
                                        $subindex = 1;
                                        ?>
                                        <td><b>{{ $Lindex }}</b></td>
                                        <td><b>{{ $boq->induk }}</b></td>
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
                                        </tr>
                                        
                                        <?php if(!empty($boq->anak) && !empty($boq->duration)){ ?>
                                            <td>{{ $Lindex.'.'.$subindex }}</td>
                                            <td>{{ $boq->anak }}</td>
                                        <?php } 
                                    }

                                    elseif($last_parent == $boq->induk){
                                        $subindex+=1;
                                        ?>

                                        <?php if(!empty($boq->anak) && !empty($boq->duration)){ ?>
                                        <td>{{ $Lindex.'.'.$subindex }}</td>
                                        <td>{{ $boq->anak }}</td>
                                        <?php } ?>
                                        
                                        <?php 
                                        $last_parent = $boq->induk;
                                    }
                                    elseif($last_parent != $boq->induk){
                                        $subindex = 1;
                                        $Lindex+=1;
                                        ?>
                                        <td>{{ $Lindex }}</td>
                                        <td><b>{{ $boq->induk }}</b></td>
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
                                        </tr>

                                        <?php if(!empty($boq->anak)){ ?>
                                            <td>{{ $Lindex.'.'.$subindex }}</td>
                                            <td>{{ $boq->anak }}</td>
                                        <?php } 
                                        $last_parent = $boq->induk;
                                    } ?>

                                    <!-- <td>{{ $index}}</td> -->
                                    <!-- <td><b>{{ $boq->induk}}</b></td> -->
                                    <!-- <td>{{ $boq->anak}}</td> -->
                                    <?php if(!empty($boq->anak) && !empty($boq->duration)){ ?>
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
                                </tr>
                                <?php } ?>
                                    @endforeach   
                                </tbody>
                            </table>  
                            <a href="#" class="btn btn-sm btn-success">Save</a>
                       
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
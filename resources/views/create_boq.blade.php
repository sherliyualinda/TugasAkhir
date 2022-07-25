<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Anggaran Awal</title>
    
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
                                <th>
                                    kelola
                                </th>

                              </tr>
                            </thead>
                            <tbody>
                            @foreach($wbs as $index=>$wbs)
                                <tr>
                                    
                                    <?php 
                                    if(!isset($last_parent)){
                                        $last_parent = $wbs->induk;
                                        $Lindex=1;
                                        $subindex = 1;
                                        ?>
                                        <td><b>{{ $Lindex }}</b></td>
                                        <td><b>{{ $wbs->induk }}</b></td>
                                        <td>{{ $wbs->start_date}}</td>
                                        <td>
                                            <?php if($wbs->parent != 0){?>
                                                <a href="/lahan/create_formBoq/{{$wbs->id}}" class="btn btn-sm btn-success">Add</a>
                                            <?php }else {?>

                                            <?php }
                                            ?>
                                        </td>
                                        </tr>
                                        
                                        <?php if(!empty($wbs->anak) ){ ?>
                                            <td>{{ $Lindex.'.'.$subindex }}</td>
                                            <td>{{ $wbs->anak }}</td>
                                        <?php } 
                                    }

                                    elseif($last_parent == $wbs->induk){
                                        $subindex+=1;
                                        ?>

                                        <?php if(!empty($wbs->anak) ){ ?>
                                        <td>{{ $Lindex.'.'.$subindex }}</td>
                                        <td>{{ $wbs->anak }}</td>
                                        <?php } ?>
                                        
                                        <?php 
                                        $last_parent = $wbs->induk;
                                    }
                                    elseif($last_parent != $wbs->induk){
                                        $subindex = 1;
                                        $Lindex+=1;
                                        ?>
                                        <td><b>{{ $Lindex }}</b></td>
                                        <td><b>{{ $wbs->induk }}</b></td>
                                        <td>{{ $wbs->start_date}}</td>
                                        <td>
                                            <?php if($wbs->parent != 0){?>
                                                <a href="/lahan/create_formBoq/{{$wbs->id}}" class="btn btn-sm btn-success">Add</a>
                                            <?php }else {?>

                                            <?php }
                                            ?>
                                        </td>
                                        </tr>

                                        <?php if(!empty($wbs->anak)){ ?>
                                            <td>{{ $Lindex.'.'.$subindex }}</td>
                                            <td>{{ $wbs->anak }}</td>
                                        <?php } 
                                        $last_parent = $wbs->induk;
                                    } ?>

                                    <?php if(!empty($wbs->anak) ){ ?>
                                    <td>{{ $wbs->start_date}}</td>
                                    <td>
                                        <?php if($wbs->parent != 0){?>
                                            <a href="/lahan/create_formBoq/{{$wbs->id}}" class="btn btn-sm btn-success">Add</a>
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
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>
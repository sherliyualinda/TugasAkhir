<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Request Lahan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
	
        @include('nav_barMar')

</div>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-20">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <div class="col-md-12 mt-2">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('lahan.kelola_lahan') }}">Kelola Lahan</a></li>
                        </ol>
                        </nav>
                    </div>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Penyewa</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Alamat Penyewa</th>
                                <th scope="col">KTP</th>
                                <th scope="col" >Kelola</th>
                                <th scope="col">Gantt Chart</th>
                                <th scope="col" >Resiko</th>
                                <th scope="col" >Jadwal Ketemu</th>
                                <th scope="col">Laporan Harian</th>
                                <th scope="col">Struk Pembayaran</th>
                                <th colspan="2" >Progres</th>
                               

                              </tr>
                            </thead>
                            <tbody>
                            @foreach($sewa as $index=>$sewa)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $sewa->nama}}</td>
                                    <td>{{ $sewa->nik}}</td>
                                    <td>{{ $sewa->alamat}}</td>
                                    <td>
                                        <img src="{{ url('foto_ktp') }}/{{ $sewa->foto_ktp }} "width="50" height="50">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#" method="POST">
                                        {{ csrf_field() }}
                                            <input type="hidden" name="status" class="form-control form-control-user" value="acc">
                                            <input type="hidden" name="id_penyewa" class="form-control form-control-user" value="{{$sewa->id_penyewa}}">
                                            <?php if($sewa->status == 'Acc'){?>
                                                Disetujui
                                            <?php }elseif($sewa->status == 'Tolak'){?>
                                                Tidak Disetujui
                                            <?php }else{?>
                                                <a href="/lahan/tolak/{{$sewa->id_penyewa}}" class="btn btn-sm btn-danger">Tolak</a>
                                                <a href="/lahan/acc/{{$sewa->id_penyewa}}" class="btn btn-sm btn-success">Terima</a>
                                            <?php } ?>
                                        </form>
                                       
                                    </td>
                                    <td>

                                    <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                        <a href="/gantt/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">Kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary"> Kelola</a>
                                        <?php } ?>

                                        
                                    </td>
                                    <td>
                                        <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                             <a href="/lahan/kelola_risk/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">Kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary"> Kelola</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                            <a href="/jadwal/kelola/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary"> Kelola</a>
                                        <?php } ?>

                                        
                                    </td>
                                  
                                    <td>
                                        <?php if($sewa->status == 'Acc'&& $sewa->progres != 'Done'){?>
                                            <a href="/lahan/kelola_daily/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">Kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary">Kelola</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($sewa->status == 'Acc'&& $sewa->progres != 'Done'){?>
                                            <a href="/lahan/kelola_struk/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary">Kelola</a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#" method="POST">
                                        {{ csrf_field() }}
                                            <input type="hidden" name="progres" class="form-control form-control-user" value="Done">
                                            <input type="hidden" name="id_penyewa" class="form-control form-control-user" value="{{$sewa->id_penyewa}}">
                                            <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                                Proses
                                            <?php }elseif($sewa->status == 'Acc' && $sewa->progres == 'Done'){?>
                                                Done
                                            <?php }else{?>
                                                -
                                            <?php } ?>
                                        </form>
                                    </td>
                                    <td>
                                         <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                            <a href="/lahan/doneRequest/{{$sewa->id_sewa}}" class="btn btn-sm btn-success">Done</a>
                                        <?php }else{ ?>
                                            <a href="#" class="btn btn-sm btn-secondary">Done</a>
                                        <?php } ?>
                                    </td>
                                    
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

</body>
</html>
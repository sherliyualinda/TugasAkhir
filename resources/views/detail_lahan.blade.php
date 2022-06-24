<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Lahan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
	
        @include('nav_barMar')

</div>
<body style="background: lightgray">
    <div class="container">
    <div class="row">
        @foreach ($lahan as $data)
        
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('lahan') }}">Home</a></li>
                <?php if($data->id_user != Auth::user()->pengguna->id_pengguna){?>
                    <!-- <li class="breadcrumb-item"><a href="/gantt/{{$data->id}}">Gantt Chart Lahan</a></li>
                    <li class="breadcrumb-item"><a href="/wbs_user/{{$data->id}}">Work Breakdown Structure</a></li> -->
                    <?php }else{ ?>
                <?php } ?>
            </ol>
            </nav>
        </div>
        <div class="col-md-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('gambar_lahan') }}/{{ $data->gambar }}" class="rounded mx-auto d-block" width="100%" alt=""> 
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2>{{ $data->nama }}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Pemilik</td>
                                        <td>:</td>
                                        <td>{{$data->pemilik}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran</td>
                                        <td>:</td>
                                        <td>{{$data->ukuran}}</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td>{{$data->deskripsi}}</td>
                                    </tr> 
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>{{$data->statusLahan}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            <b> Orang Yang Membantu </b>
                            <table class="table table-bordered">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                              </tr>
                            @foreach($orang as $index=>$orang)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $orang->resource}}</td>
                                </tr>
                                @endforeach
                            </table>
                            <b>Material Yang Digunakan</b>
                            <table class="table table-bordered">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Material</th>
                              </tr>
                            @foreach($material as $index=>$material)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $material->resource}}</td>
                                </tr>
                                @endforeach
                            </table>
                            <b> Alat Yang Digunakan</b>
                            <table class="table table-bordered">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Alat</th>
                              </tr>
                            @foreach($alat as $index=>$alat)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $alat->resource}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
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
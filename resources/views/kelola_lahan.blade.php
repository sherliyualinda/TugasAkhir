<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Lahan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
	
        @include('nav_barMar')

</div>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('lahan.create') }}" class="btn btn-md btn-success mb-3">+ Buat Lahan</a>
                        <div class="col-md-12 mt-2">
                            <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('lahan') }}">Home</a></li>
                            </ol>
                            </nav>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Kelola</th>
                                <th scope="col">Tambah Sumber Daya</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($lahan as $index=>$lahan)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $lahan->ukuran}}</td>
                                    <td>{{ $lahan->deskripsi}}</td>
                                    <td>
                                        <img src="{{ url('gambar_lahan') }}/{{ $lahan->gambar }} "width="50" height="50">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#" method="POST">
                                            <a href="/lahan/ubah/{{$lahan->id}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>Edit</a>
                                            <a href="/lahan/hapus/{{$lahan->id}}" class="btn btn-sm btn-danger">Delete</a>
                                            
                                            <!-- <a href="/wbs/{{$lahan->id}}" class="btn btn-sm btn-info">BOQ</a> -->
                                            <a href="/lahan/request/{{$lahan->id}}" class="btn btn-sm btn-info">Request</a>
                
                                        </form>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Sumber Daya
                                                <span></span></button>
                                                <ul class="dropdown-menu">
                                                <li><a href="/lahan/kelola_resource/{{$lahan->id}}"><b>Kelola</b></a></li>
                                                <li><a href="/lahan/orang/{{$lahan->id}}">Orang</a></li>
                                                <li><a href="/lahan/material/{{$lahan->id}}">Material</a></li>
                                                <li><a href="/lahan/alat/{{$lahan->id}}">Alat</a></li>
                                                </ul>
                                            </div>

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
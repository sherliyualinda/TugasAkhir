<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Peralatan</title>
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
                        <a href="{{ route('peralatan.create') }}" class="btn btn-md btn-success mb-3">+ Tambah Alat</a>
                        
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Gambar</th>
                                <th colspan="2" >Kelola</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($peralatan as $index=>$peralatan)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $peralatan->nama_alat}}</td>
                                    <td>{{ $peralatan->deskripsi}}</td>
                                    <td>{{ $peralatan->harga}}</td>
                                    <td>
                                        <center>
                                        <img src="{{ url('gambar_peralatan') }}/{{ $peralatan->gambar }} "width="50" height="50">
                                        </center>
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#" method="POST">
                                            <a href="/peralatan/ubah/{{$peralatan->id_peralatan}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>Edit</a>
                                            <a href="/peralatan/hapus_peralatan/{{$peralatan->id_peralatan}}" class="btn btn-sm btn-danger">Delete</a>
                                            <a href="/peralatan/request/{{$peralatan->id_peralatan}}" class="btn btn-sm btn-info">Request</a>
                                        </form>
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
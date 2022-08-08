<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projek Saya</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
	
        @include('nav_barMar')

</div>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('lahan') }}" class="btn btn-secondary mb-3">< Kembali</a>
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Deskripsi</th>
                                <th colspan="2" >Detail Sewa Lahan</th>
                               

                              </tr>
                            </thead>
                            <tbody>
                            @foreach($projek as $index=>$projek)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{$projek->nama}}</td>
                                    <td>
                                        <a href="{{ url('gambar_lahan') }}/{{ $projek->gambar }}" target="_blank"><img src="{{ url('gambar_lahan') }}/{{ $projek->gambar }} "width="50" height="50"><a>


                                        <!-- <img src="{{ url('gambar_lahan') }}/{{ $projek->gambar }} "width="50" height="50"> -->
                                    </td>
                                   <td>{!! $projek->deskripsi !!}</td>
                                   <td>
                                        <a href="/lahan/Dprojek_user/{{$projek->id_sewa}}" class="btn btn-primary">lihat</a>
                                        <a href="/sosial-media/chat_lahan/{{$projek->username}}" class="btn btn-primary"><i class="fa fa-inbox"></i> chat</a>
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
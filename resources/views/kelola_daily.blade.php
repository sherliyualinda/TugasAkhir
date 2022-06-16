<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Laporan Harian</title>
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
                    <div class="col-md-12 mt-2">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/lahan/request/{id}')}}">Back</a></li>
                        </ol>
                        </nav>
                    </div>
                    @foreach($daily2 as $index=>$daily2)
                    <table>
                        <tr>
                            <th scope="col">Nama Penyewa</th>          
                            <th scope="col">:</th>     
                            <td>{{ $daily2->nama}}</td>     
                                               
                        </tr>
                        <tr>
                            <th scope="col" >NIK</th>     
                            <th scope="col">:</th>     
                            <td>{{ $daily2->nik}}</td>                         
                        </tr>
                        
                    </table>
                    @endforeach

                    @foreach($daily3 as $index=>$daily3)
                    <table>
                        <tr>
                             <td>
                                 <a href="/lahan/createDaily/{{$daily3->id_sewa}}" class="btn btn-sm btn-info">Tambah Resiko</a>
                            </td>
                        </tr>
                    
                    </table>
                    @endforeach
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Gambar</th>
                                <th scope="col">keterangan</th>                               
                                <th scope="col">date</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($daily as $index=>$daily)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td><img src="{{ url('gambar_daily') }}/{{ $daily->gambar }} "width="50" height="50"></td>
                                    <td>{{ $daily->keterangan}}</td>
                                    <td>{{ $daily->date}}</td>
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
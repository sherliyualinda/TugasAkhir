<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Struk Pembayaran</title>
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
                        <?php session_start(); ?>
                        <li class="breadcrumb-item"><a href="/lahan/request/{{$_SESSION['id_lahan']}}">Back</a></li>
                        </ol>
                        </nav>
                    </div>
                    @foreach($struk2 as $index=>$struk2)
                    <table>
                        <tr>
                            <th scope="col">Nama Penyewa</th>          
                            <th scope="col">:</th>     
                            <td>{{ $struk2->nama}}</td>     
                                               
                        </tr>
                        <tr>
                            <th scope="col" >NIK</th>     
                            <th scope="col">:</th>     
                            <td>{{ $struk2->nik}}</td>                         
                        </tr>
                        
                    </table>
                    @endforeach
                    <table>

                        <tr>
                             <td>
                                 <a href="/lahan/struk/{{$_SESSION['id_sewa']}}" class="btn btn-sm btn-success" class="btn btn-sm btn-info">Tambah Struk</a>
                            </td>
                        </tr>
                
                    </table>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Gambar</th>
                                <th scope="col">Keterangan</th>                               
                                <th scope="col">Tanggal</th>  
                                <th scope="col">Kelola</th>                               
                                
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($struk as $index=>$struk)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>
                                        <img src="{{ url('gambar_struk') }}/{{ $struk->gambar }} "width="50" height="50">
                                    </td>
                                    <td>{{ $struk->keterangan}}</td>
                                    <td>{{ $struk->tanggal}}</td>
                    
                                    <td>
                                        <a href="/lahan/ubah_struk/{{$struk->id_struk}}" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="/lahan/hapus_Struk/{{$struk->id_struk}}" class="btn btn-sm btn-danger">Hapussss</a>
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
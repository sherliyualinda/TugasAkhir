<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi Saya</title>
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
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Jumlah Sewa</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Hari Sewa</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Bukti Bayar</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail Sewa Lahan</th>
                                <th scope="col">Chat</th>
                               

                              </tr>
                            </thead>
                            <tbody>
                            @foreach($transaksi as $index=>$projek)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{$projek->nama_alat}}</td>
                                    <td>
                                        <a href="{{ url('gambar_peralatan') }}/{{ $projek->gambar }}" target="_blank">
                                        <img src="{{ url('gambar_peralatan') }}/{{ $projek->gambar }} "width="50" height="50"><a>
                                    </td>
                                   <td>{{$projek->deskripsi}}</td>
                                   <td>{{$projek->qty}}</td>
                                   <td>{{$projek->harga}}</td>
                                   <td>{{$projek->totalHari}} Hari</td>
                                   <td>Rp {{$projek->totalHarga}}</td>
                                   <td>
                                        <a href="{{ url('bukti_bayar') }}/{{ $projek->bukti_bayar }}" target="_blank">
                                        <img src="{{ url('bukti_bayar') }}/{{ $projek->bukti_bayar }} "width="50" height="50"><a>
                                    </td>
                                   <td><b>{{$projek->status}}<b></td>
                                   <td>
                                        <a href="/peralatan/bukti_bayar/{{$projek->id_sewa}}" class="btn btn-primary">Bukti Bayar</a>
                                        
                                   </td>
                                   <td>
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
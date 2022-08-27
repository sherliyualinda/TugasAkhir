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
<style>
     .container .popup-image{
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0,.9);
    height: 100%;
    width: 100%;
    z-index: 100;
    display: none;

}
.container .popup-image span{
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 60px;
    font-weight: bolder;
    color: #fff;
    cursor: pointer;
    z-index: 100%;

}
.container .popup-image img{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    border: 5px solid #fff;
    border-radius: 5px;
    width: 500px;
    object-fit: cover;

}
@media (max-width:768px){
    .container .popup-image img{
        width: 95%;
    }
}
</style>
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
                                        
                                        <img src="{{ url('gambar_peralatan') }}/{{ $projek->gambar }} "width="50" height="50">

                                        <div class="popup-image">
                                        <span>
                                            &times;
                                        </span>
                                        <img src="{{ url('gambar_peralatan') }}/{{ $projek->gambar }} ">
                                        </div>
                                    </td>
                                   <td>{{$projek->deskripsi}}</td>
                                   <td>{{$projek->qty}}</td>
                                   <td>{{$projek->harga}}</td>
                                   <td>{{$projek->totalHari}} Hari</td>
                                   <td>Rp {{$projek->totalHarga}}</td>
                                   <td>
                                        
                                        <img src="{{ url('bukti_bayar') }}/{{ $projek->bukti_bayar }} "width="50" height="50">
                                        <div class="popup-image">
                                        <span>
                                            &times;
                                        </span>
                                        <img src="{{ url('bukti_bayar') }}/{{ $projek->bukti_bayar }} ">
                                        </div>
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
                          <div>
                            Showing {{ $transaksi->firstItem() }}
                            to {{ $transaksi->lastItem() }}
                            of {{ $transaksi->total() }}
                            entries
                        </div>
                        <div class="pull-right">
                            {{ $transaksi->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    
    <script>
    document.querySelectorAll('.card-body img').forEach(image =>{
       image.onclick =() =>{
           document.querySelector('.popup-image').style.display ='block';
           document.querySelector('.popup-image img').src=image.getAttribute('src');
           
       } 
    });
    document.querySelector('.popup-image span').onclick = () =>{
        document.querySelector('.popup-image').style.display ='none';
    }
</script>
</body>
</html>
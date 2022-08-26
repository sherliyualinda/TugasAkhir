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

<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 	    
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
	
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
                                        <img src="{{ url('gambar_lahan') }}/{{ $projek->gambar }} "width="50" height="50">
                                        <div class="popup-image">
                                        <span>
                                            &times;
                                        </span>
                                        <img src="{{ url('gambar_lahan') }}/{{ $projek->gambar }} ">
                                        </div>

                                        <!-- <img src="{{ url('gambar_lahan') }}/{{ $projek->gambar }} "width="50" height="50"> -->
                                    </td>
                                   <td>{!! $projek->deskripsi !!}</td>
                                   <td>
                                        <a href="/lahan/Dprojek_user/{{$projek->id_sewa}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="/sosial-media/chat_lahan/{{$projek->username}}" class="btn btn-primary"><i class="fa fa-inbox"></i> Pesan</a>
                                        
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
@include('nav_barMar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 	    
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
<hr>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">
        <a href="{{ route('peralatan.create') }}" class="btn btn-primary">+ Upload</a>
        <a href="{{ route('peralatan.kelola_peralatan') }}" class="btn btn-primary">  Kelola </a>
    </div>

        @foreach($peralatan as $peralatan)
        <div class="col-md-4">
            <div class="card" >
              <img src="{{ url('gambar_peralatan') }}/{{ $peralatan->gambar }}" class="card-img-top" alt="..."  >
              <div class="card-body">
                <h5 class="card-title">{{ $peralatan->nama_alat }}</h5>
                <p class="card-text">
                    <strong>Harga : </strong>Rp {{ $peralatan->harga}} <br>
                    <hr>
                    <strong>Deskripsi : </strong> <br>
                    {{ $peralatan->deskripsi }} 
                </p>
                <a href="/peralatan/sewaPeralatan/{{$peralatan->id_peralatan}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Sewa</a>
                <!-- <a href="#" class="btn btn-primary"><i class="fa fa-info"></i> Detail Lahan</a> -->
                <a href="/lahan/detail_peralatan/{{$peralatan->id_peralatan}}" class="btn btn-primary"><i class="fa fa-info"></i> Detail</a>
                <a href="/sosial-media/chat_lahan/{{$peralatan->username}}" class="btn btn-primary"><i class="fa fa-inbox"></i> chat</a>
              </div>
            </div> 
        </div>
        @endforeach
    </div>
</div>
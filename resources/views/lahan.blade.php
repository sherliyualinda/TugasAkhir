@include('nav_barMar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 	    
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">
            <img src="/Diessnie-logo.png" class="rounded mx-auto d-block" width="100" alt="">
            <a href="{{ route('lahan.create') }}" class="btn btn-primary">+ Buat Lahan</a>
            <hr>
        </div>
        @foreach($lahan as $lahan)
        <div class="col-md-4">
            <div class="card">
              <img src="{{ url('gambar_lahan') }}/{{ $lahan->gambar }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{ $lahan->nama }}</h5>
                <p class="card-text">
                    <strong>Pemilik : </strong>{{ $lahan->pemilik}} <br>
                    <strong>Ukuran : </strong>{{ $lahan->ukuran}} <br>
                    <!-- <strong>Deskripsi :</strong> {{ $lahan->deskripsi }} <br> -->
                    <hr>
                    <strong>Deskripsi : </strong> <br>
                    {{ $lahan->deskripsi }} 
                </p>
                <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Pesan</a>
              </div>
            </div> 
        </div>
        @endforeach
    </div>
</div>
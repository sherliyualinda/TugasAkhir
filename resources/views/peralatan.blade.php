@extends('layouts2.main')

@section('title', 'Kelola Lahan')

<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 	    
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">

@section('content') 
    <div class="row justify-content-center mb-5">
        <div class="col-md-12 mb-5">
            <a href="{{ url('lahan') }}" class="btn btn-secondary">< Kembali</a>
        <!-- <a href="{{ route('peralatan.create') }}" class="btn btn-primary">+ Upload</a> -->
        <a href="{{ route('peralatan.kelola_peralatan') }}" class="btn btn-primary">  Kelola </a>
        <a href="{{ route('transaksi.peralatan') }}" class="btn btn-primary">  Transaksi </a>
        <hr>
    </div>
@php
   
@endphp
        @foreach($peralatans as $peralatan)
        <div class="col-md-4">
            <div class="card mt-2" >
                <div style="width:100%; height:300px;">
                    <img src="{{ url('gambar_peralatan') }}/{{ $peralatan->gambar }}" class="card-img-top" alt="peralatan"  style="width:100%; height:100%; object-fit:cover;">
                </div>
              <div class="card-body">
                <h5 class="card-title">{{ $peralatan->nama_alat }}</h5>
                <p class="card-text">
                    <strong>Harga : </strong>Rp {{ $peralatan->harga}} <br>
                    <hr>
                    <strong>Deskripsi : </strong> <br>
                    {!! $peralatan->deskripsi !!} 
                </p>
                <a href="/peralatan/sewaPeralatan/{{$peralatan->id_peralatan}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Sewa</a>
                <!-- <a href="#" class="btn btn-primary"><i class="fa fa-info"></i> Detail Lahan</a> -->
                <a href="/lahan/detail_peralatan/{{$peralatan->id_peralatan}}" class="btn btn-primary"><i class="fa fa-info"></i> Detail</a>
                <a href="/sosial-media/chat_lahan/{{$peralatan->pengguna->username}}" class="btn btn-primary"><i class="fa fa-inbox"></i> Pesan</a>
              </div>
            </div> 
        </div>
        @endforeach
    </div>
</div>
@endsection
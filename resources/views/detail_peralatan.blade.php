@extends('layouts2.main')

@section('title', 'Detail Peralatan')

@section('content') 
    <div class="row">
        @foreach ($peralatan as $data)
        
        <div class="col-md-12">
            <a href="{{ route('peralatan') }}" class="btn btn-secondary">< Kembali</a>
        </div>
        <div class="col-md-12 mt-1">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('gambar_peralatan') }}/{{ $data->gambar }}" class="rounded mx-auto d-block" width="100%" alt=""> 
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2>{{ $data->nama_alat }}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Pemilik</td>
                                        <td>:</td>
                                        <td>{{$data->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>{{$data->harga}}</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td>{{$data->deskripsi}}</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
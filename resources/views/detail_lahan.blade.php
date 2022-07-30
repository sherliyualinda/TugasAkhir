@extends('layouts2.main')

@section('title', 'Detail Lahan')

@section('content') 
    <div class="row">
        @foreach ($lahan as $data)
        <div class="col-md-12 mt-1">
            <a href="{{ url('lahan') }}" class="btn btn-secondary mb-3">< Kembali</a>
            @foreach ($lahan4 as $data4)
                <a href="/lahan/halmanual/{{$data4->category_lahan_id}}" class="btn btn-info mb-3">Manual Book</a>
                <a href="/lahan/lihat_portofolio/{{$data4->id}}" class="btn btn-info mb-3">Portofolio</a>
            @endforeach
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('gambar_lahan') }}/{{ $data->gambar }}" class="rounded mx-auto d-block" width="100%" alt=""> 
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2>{{ $data->nama }}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Pemilik</td>
                                        <td>:</td>
                                        <td>{{$data->pemilik}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran</td>
                                        <td>:</td>
                                        <td>{{$data->ukuran}}</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td>{!! $data->deskripsi !!}</td>
                                    </tr> 
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>{{$data->statusLahan}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                                @foreach($sewa as $index=>$sewa)
                                    <b>Sudah disewa {{$sewa->totSewa}} kali</b>
                                @endforeach
                            </table>
                            <b> Orang Yang Membantu </b>
                            <table class="table table-bordered">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                              </tr>
                            @foreach($orang as $index=>$orang)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $orang->resource}}</td>
                                </tr>
                                @endforeach
                            </table>
                            <b>Material Yang Digunakan</b>
                            <table class="table table-bordered">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Material</th>
                              </tr>
                            @foreach($material as $index=>$material)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $material->resource}}</td>
                                </tr>
                                @endforeach
                            </table>
                            <b> Alat Yang Digunakan</b>
                            <table class="table table-bordered">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Alat</th>
                              </tr>
                            @foreach($alat as $index=>$alat)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $alat->resource}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
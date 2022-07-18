@extends('layouts2.main')

@section('title', 'Kelola Peralatan')

@section('content') 
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('peralatan') }}" class="btn btn-secondary mb-3">< Kembali</a>
                        <a href="{{ route('peralatan.create') }}" class="btn btn-md btn-success mb-3">+ Tambah Alat</a>
                        
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Status</th>
                                <th colspan="2" >Kelola</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($peralatans as $index=>$peralatan)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $peralatan->nama_alat}}</td>
                                    <td>{{ $peralatan->deskripsi}}</td>
                                    <td>{{ $peralatan->harga}}</td>
                                    <td>
                                        <center>
                                        <img src="{{ url('gambar_peralatan') }}/{{ $peralatan->gambar }} "width="50" height="50">
                                        </center>
                                    </td>
                                    <td>{{ $peralatan->status }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#" method="POST">
                                            <a href="/peralatan/ubah/{{$peralatan->id_peralatan}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>Edit</a>
                                            <a href="/peralatan/hapus_peralatan/{{$peralatan->id_peralatan}}" class="btn btn-sm btn-danger">Delete</a>
                                            @if ($peralatan->status === 'Ready')
                                            <a href="/peralatan/request/{{$peralatan->id_peralatan}}" class="btn btn-sm btn-info">Request</a>
                                            @endif
                                        </form>
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
@endsection
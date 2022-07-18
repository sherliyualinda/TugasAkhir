@extends('layouts2.main')

@section('title', 'Kelola Pralatan')

@section('content') 
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('lahan/kelola_lahan') }}" class="btn btn-secondary mb-3">< Kembali</a>
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kebutuhan</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Keterangan</th>
                                <th colspan="2" >Kelola</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($resource as $index=>$resource)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $resource->resource}}</td>
                                    <td>{{ $resource->keterangan}}</td>
                                    <td>{{ $resource->role}}</td>
                                    <td class="text-center">
                                            <a href="/lahan/ubah_sdm/{{$resource->id_lahan_resources}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>Edit</a>
                                            <a href="/lahan/hapus_sdm/{{$resource->id_lahan_resources}}" class="btn btn-sm btn-danger">Delete</a>
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
@extends('super-admin.layouts.app')

@section('title')
    Manual Book Lahan
@endsection

@section('content')
<style>
#myDIV {
  height:300px;
  background-color:#FFFFFF;
}
.ex1 {
  
  width: 200px;
  height: 300px;
  overflow-y: scroll;
}
</style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                   
                    <table>
                        <tr>
                             <td>
                                 <a href="/lahan/createManual" class="btn btn-sm btn-info mb-3">Tambah Manual Book</a>
                            </td>
                        </tr>
                    
                    </table>

                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Kategori Lahan</th>
                                <th scope="col">Gambar</th>                                
                                <th scope="col">Jenis Lahan</th>
                                <th scope="col">Langkah-Langkah</th>                            
                                <th scope="col">Sumber</th>                               
                                <th scope="col">Kelola</th>                               
                                
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($manual as $index=>$manual)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $manual->nama}}</td>
                                    <td><img src="{{ url('gambar_manual') }}/{{ $manual->gambar }} "width="50" height="50"></td>
                                    <td>{{ $manual->jenis_lahan}}</td>
                                    <td>
                                      <div id="myDIV">
                                        <div class="ex1">
                                            {!! $manual->deskripsi!!}
                                        </div>
                                      </div>
                                    </td>
                                    <td class="td">{{ $manual->sumber}}</td>
                                    <td>
                                        <a href="/lahan/lihat_manual/{{$manual->id_manual}}" class="btn btn-sm btn-info">Lihat</a><br>
                                        <a href="/lahan/ubah_manual/{{$manual->id_manual}}" class="btn btn-sm btn-warning">Edit</a><br>
                                        <a href="/lahan/hapus_manual/{{$manual->id_manual}}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')">Hapus</a>
                                        
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

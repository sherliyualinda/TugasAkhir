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
                                        <a href="/lahan/lihat_manual/{{$manual->id_manual}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="/lahan/ubah_manual/{{$manual->id_manual}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="/lahan/hapus_manual/{{$manual->id_manual}}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')">Hapus</a>
                                        <a href="/lahan/hapus_manual/{{$manual->id_manual}}" class="btn btn-danger delete btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
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

<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/lahan/hapus_manual/{{$manual->id_manual}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete" />
                <h5 class="text-center">Apakah Anda Yakin Akan Menggapus {{$manual->jenis_lahan}} ini?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-sm btn-danger">Ya, Hapus Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
        <!-- End Delete Modal --> 
@endsection

@section('js')
<script>
     $(document).on('click','.delete',function(){
         let url = $(this).attr('data-url');
         $('#deleteModal form').attr('action',url);
    });
</script>
@endsection
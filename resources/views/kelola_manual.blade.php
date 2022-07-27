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
                    <div class="table-responsive">

                    
                        <table class="table table-bordered" >
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
                            @foreach($manual as $index=>$manuals)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $manuals->nama}}</td>
                                    <td><img src="{{ url('gambar_manual') }}/{{ $manuals->gambar }} "width="50" height="50"></td>
                                    <td>{{ $manuals->jenis_lahan}}</td>
                                    <td>
                                      <div id="myDIV">
                                        <div class="ex1">
                                            {!! $manuals->deskripsi!!}
                                        </div>
                                      </div>
                                    </td>
                                    <td class="td">{{ $manuals->sumber}}</td>
                                    <td>
                                        <a href="/lahan/lihat_manual/{{$manuals->id_manual}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="/lahan/ubah_manual/{{$manuals->id_manual}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <!-- <a href="/lahan/hapus_manual/{{$manuals->id_manual}}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')">Hapus</a> -->
                                        
                                        <button class="btn btn-sm btn-danger deleteProduct" data-id="{{$manuals->id_manual}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                        
                              @endforeach   
                            </tbody>
                          </table> 
                          <div>
                            Showing {{ $manual->firstItem() }}
                            to {{ $manual->lastItem() }}
                            of {{ $manual->total() }}
                            entries
                        </div>
                        <div class="pull-right">
                            {{ $manual->links("pagination::bootstrap-4") }}
                        </div> 
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
     $(document).on('click','.delete',function(){
         let url = $(this).attr('data-url');
         $('#deleteModal form').attr('action',url);
    });
    // function deletes(obj){
    $(".deleteProduct").click(function(){
        var id = $(this).data("id");        
        var token = $(this).data("token");
    // obj.preventDefault();
    // const url = $(this).attr('href');
    swal({
        title: 'Apakah Anda Yakin?',
        text: 'Data Ini Akan Dihapus Secara Permanen!',
        icon: 'warning',
        buttons: ["Tidak", "Iya"],
    }).then(function(value) {
        if (value) {
           
        $.ajax(
        {
            url: "/lahan/hapus_manual/"+id,
            type: 'GET',
            dataType: "JSON",
            data: {
                "id": id,
                
            },
            success: function ()
            {
                console.log("it Work");
            }
        });

        window.location = "/lahan/manualBook";
            
        }

    });
    });
</script>
@endsection




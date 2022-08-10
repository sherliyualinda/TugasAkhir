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

.modal-body{
    height: 80vh;
    
}
</style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                   
                    <!-- <table>
                        <tr>
                             <td>
                                 <a href="/lahan/createManual" class="btn btn-sm btn-info mb-3">Tambah Manual Book</a>
                            </td>
                        </tr>
                    
                    </table> -->

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="/lahan/createManual">
                    Tambah Data
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Manual Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{url('lahan/simpan_manual')}}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            {{ csrf_field() }}
                                    <div class="form-group" background-color:lightgrey>
                                        <div class="form-group">
                                            <label>Kategori Lahan</label>
                                            <select class="form-control" name="id_categoryLahan" placeholder="--Skala Kemungkinan--">
                                                <option value="1">Pertanian</option>
                                                <option value="2">Perkebunan</option>
                                                <option value="3">Perikanan</option>
                                                <option value="4">Peternakan</option>
                                            
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="gambar">
                                        </div>
                                        <label>Jenis Lahan</label>
                                        <input type="input" name="jenis_lahan" class="form-control form-control-user" placeholder="Jenis Lahan">
                                    </div>
                                    <div class="form-group">
                                        <label>Langkah-Langkah</label>
                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> 
                                    </div>
                                    <div class="form-group">
                                        <label>Sumber</label>
                                        <input type="input" name="sumber" class="form-control form-control-user" placeholder="sumber">
                                    </div>
                                
                        
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">SIMPAN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>

                    <!-- tutup modal -->



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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
@endsection




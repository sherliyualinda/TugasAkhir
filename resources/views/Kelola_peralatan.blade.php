@extends('layouts2.main')

@section('title', 'Kelola Peralatan')

@section('content') 


<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<style>


.modal-body{
    height: 80vh;
    
}
</style>

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('peralatan') }}" class="btn btn-secondary mb-3">< Kembali</a>
                        <!-- <a href="{{ route('peralatan.create') }}" class="btn btn-md btn-info mb-3">+ Tambah Alat</a> -->

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{ route('peralatan.create') }}">
                        Tambah Data
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Alat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('peralatan.simpan')}}" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                
                            {{ csrf_field() }}
                                    <div class="form-group">
                                        <label> Nama Alat</label>
                                        <input type="input" name="nama_alat" class="form-control form-control-user" placeholder="nama alat">
                                    </div>
                                    <div class="form-group">
                                        <label> Harga Sewa</label>
                                        <input type="input" name="harga" class="form-control form-control-user" placeholder="0">
                                    </div>
                                    <div class="form-group">
                                        <label> Stok</label>
                                        <input type="input" name="stok" class="form-control form-control-user" placeholder="0">
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <!-- <textarea class="form-control" name="content" placeholder="Masukkan Content" rows="4"></textarea> -->
                                        <textarea name="deskripsi" id="deskripsi" class="form-control form-control-user" rows="4" placeholder="Masukkan Deskripsi"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="gambar" class="form-control form-control-user">
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


                        
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Status</th>
                                <th colspan="2" >Kelola</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($peralatans as $index=>$peralatanss)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $peralatanss->nama_alat}}</td>
                                    <td>{!! $peralatanss->deskripsi !!}</td>
                                    <td>{{ $peralatanss->harga}}</td>
                                    <td>{{ $peralatanss->stok}}</td>
                                    <td>
                                        <center>
                                        <a href="{{ url('gambar_peralatan') }}/{{ $peralatanss->gambar }}" target="_blank">
                                        <img src="{{ url('gambar_peralatan') }}/{{ $peralatanss->gambar }} "width="50" height="50"><a>
                                        </center>
                                    </td>
                                    <td>
                                        @if ($peralatanss->status === 'Ready')
                                        <span class="badge badge-success">Tersedia</span>
                                    @elseif ($peralatanss->status === 'Waiting')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif ($peralatanss->status === 'Reject')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                        
                                            <a href="/peralatan/ubah/{{$peralatanss->id_peralatan}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                            

                                            <button class="btn btn-sm btn-danger deleteProduct" data-id="{{$peralatanss->id_peralatan}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash"></i></button>
                                            @if ($peralatanss->status === 'Ready')
                                            <a href="/peralatan/request/{{$peralatanss->id_peralatan}}" class="btn btn-sm btn-info">Permintaan</a>
                                            @endif
                                        
                                    </td>
                                </tr>
                              @endforeach   
                            </tbody>
                          </table>  
                          <div>
                            Showing {{ $peralatans->firstItem() }}
                            to {{ $peralatans->lastItem() }}
                            of {{ $peralatans->total() }}
                            entries
                        </div>
                        <div class="pull-right">
                            {{ $peralatans->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    @yield('js')

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
            url: "/peralatan/hapus_peralatan/"+id,
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

        window.location = "/peralatan/kelola_peralatan";
            
        }

    });
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
@endsection



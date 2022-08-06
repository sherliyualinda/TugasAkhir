@extends('layouts2.main')

@section('title', 'Kelola Lahan')

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
            <a href="{{ route('lahan') }}" class="btn btn-secondary mb-3">< Kembali</a>
            <!-- <a href="{{ route('lahan.create') }}" class="btn btn-info  mb-3">+ Buat Lahan</a> -->

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{ route('lahan.create') }}">
            Buat Lahan
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Lahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('lahan.simpan')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    
                {{ csrf_field() }}
                    <div class="form-group">
                        <label>Kategori</label>
                        <!-- <input type="text" name="title" placeholder="Masukkan Title" class="form-control"> -->
                        <select class="form-control" name="category_lahan_id" placeholder="--Pilih Kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach($categori as $categorii)
                                <option value="{{$categorii->id}}">{{$categorii->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="input" name="ukuran" class="form-control" placeholder="Ukuran">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <!-- <textarea class="form-control" name="content" placeholder="Masukkan Content" rows="4"></textarea> -->
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Masukkan Deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar">
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








            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Kelola</th>
                            <th scope="col">Tambah Sumber Daya</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lahan as $index=>$lahans)
                            <tr>
                                <td>{{ $index+1}}</td>
                                <td>{{ $lahans->ukuran}}</td>
                                <td>{!! $lahans->deskripsi!!}</td>
                                <td>
                                    <a href="{{ url('gambar_lahan') }}/{{ $lahans->gambar }}" target="_blank"><img src="{{ url('gambar_lahan') }}/{{ $lahans->gambar }} "width="50" height="50"><a>

                                    <!-- <img src="{{ url('gambar_lahan') }}/{{ $lahans->gambar }} "width="50" height="50"> -->
                                </td>
                                <td>
                                    @if ($lahans->statusLahan === 'Ready')
                                        <span class="badge badge-success">{{ $lahans->statusLahan }}</span>
                                    @elseif ($lahans->statusLahan === 'Waiting')
                                        <span class="badge badge-warning">{{ $lahans->statusLahan }}</span>
                                    @elseif ($lahans->statusLahan === 'Not Ready')
                                        <span class="badge badge-danger">{{ $lahans->statusLahan }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="/lahan/ubah/{{$lahans->id}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <!-- <a href="/lahan/hapus/{{$lahans->id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->

                                        <button class="btn btn-sm btn-danger deleteProduct" data-id="{{$lahans->id}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash"></i>
                                        </button>
                                        @if ($lahans->statusLahan != 'Waiting' )
                                        <a href="/lahan/request/{{$lahans->id}}" class="btn btn-sm btn-info">Request</a>
                                        @endif
                                    </div>
                                    
                                </td>
                                <td class="text-center">
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Sumber Daya
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="/lahan/kelola_resource/{{$lahans->id}}" class="dropdown-item"><b>Kelola</b></a>
                                            <a href="/lahan/orang/{{$lahans->id}}" class="dropdown-item">Orang</a>
                                            <a href="/lahan/material/{{$lahans->id}}" class="dropdown-item">Material</a>
                                            <a href="/lahan/alat/{{$lahans->id}}" class="dropdown-item">Alat</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach   
                        </tbody>
                        </table>  
                        <div>
                            Showing {{ $lahan->firstItem() }}
                            to {{ $lahan->lastItem() }}
                            of {{ $lahan->total() }}
                            entries
                        </div>
                        <div class="pull-right">
                            {{ $lahan->links("pagination::bootstrap-4") }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jstop')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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
            url: "/lahan/hapus/"+id,
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

        window.location = "/lahan/kelola_lahan";
            
        }

    });
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
@endsection
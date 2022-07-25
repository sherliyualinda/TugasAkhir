@extends('layouts2.main')

@section('title', 'Kelola Lahan')

@section('content')

<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')


    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('lahan') }}" class="btn btn-secondary mb-3">< Kembali</a>
            <a href="{{ route('lahan.create') }}" class="btn btn-info  mb-3">+ Buat Lahan</a>
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
                        @foreach($lahan as $index=>$lahan)
                            <tr>
                                <td>{{ $index+1}}</td>
                                <td>{{ $lahan->ukuran}}</td>
                                <td>{!! $lahan->deskripsi!!}</td>
                                <td>
                                    <img src="{{ url('gambar_lahan') }}/{{ $lahan->gambar }} "width="50" height="50">
                                </td>
                                <td>
                                    @if ($lahan->statusLahan === 'Ready')
                                        <span class="badge badge-success">{{ $lahan->statusLahan }}</span>
                                    @elseif ($lahan->statusLahan === 'Waiting')
                                        <span class="badge badge-warning">{{ $lahan->statusLahan }}</span>
                                    @elseif ($lahan->statusLahan === 'Not Ready')
                                        <span class="badge badge-danger">{{ $lahan->statusLahan }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="/lahan/ubah/{{$lahan->id}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <!-- <a href="/lahan/hapus/{{$lahan->id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->

                                        <button class="btn btn-sm btn-danger deleteProduct" data-id="{{$lahan->id}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash"></i>
                                        </button>
                                        <a href="/lahan/dokumentasi/{{$lahan->id}}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-file-text"></i></a>
                                        @if ($lahan->statusLahan === 'Ready')
                                        <a href="/lahan/request/{{$lahan->id}}" class="btn btn-sm btn-info">Request</a>
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
                                            <a href="/lahan/kelola_resource/{{$lahan->id}}" class="dropdown-item"><b>Kelola</b></a>
                                            <a href="/lahan/orang/{{$lahan->id}}" class="dropdown-item">Orang</a>
                                            <a href="/lahan/material/{{$lahan->id}}" class="dropdown-item">Material</a>
                                            <a href="/lahan/alat/{{$lahan->id}}" class="dropdown-item">Alat</a>
                                    </div>
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
@endsection
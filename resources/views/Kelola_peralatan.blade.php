@extends('layouts2.main')

@section('title', 'Kelola Peralatan')

@section('content') 


<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('peralatan') }}" class="btn btn-secondary mb-3">< Kembali</a>
                        <a href="{{ route('peralatan.create') }}" class="btn btn-md btn-info mb-3">+ Tambah Alat</a>
                        
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
                                    <td>{{ $peralatanss->status }}</td>
                                    <td class="text-center">
                                        
                                            <a href="/peralatan/ubah/{{$peralatanss->id_peralatan}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                            

                                            <button class="btn btn-sm btn-danger deleteProduct" data-id="{{$peralatanss->id_peralatan}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash"></i></button>
                                            @if ($peralatanss->status === 'Ready')
                                            <a href="/peralatan/request/{{$peralatanss->id_peralatan}}" class="btn btn-sm btn-info">Request</a>
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
@endsection



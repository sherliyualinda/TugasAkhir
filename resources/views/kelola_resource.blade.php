@extends('layouts2.main')

@section('title', 'Kelola Sumberdaya')

@section('content') 


<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')

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
                            @foreach($resource as $index=>$resources)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    @if ($resources->role === 'Orang')
                                    <td><a href="/sosial-media/profil/{{$resources->resource}}" style="color: black">{{$resources->resource}}</a></td>
                                    @else
                                    <td>{{ $resources->resource}}</td>
                                    @endif
                                    <td>{!! $resources->keterangan !!}</td>
                                    <td>{{ $resources->role}}</td>
                                    <td class="text-center">
                                            <a href="/lahan/ubah_sdm/{{$resources->id_lahan_resources}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-sm btn-danger deleteProduct" data-id="{{$resources->id_lahan_resources}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash"></i>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                              @endforeach   
                            </tbody>
                          </table>  
                          <div>
                            Showing {{ $resource->firstItem() }}
                            to {{ $resource->lastItem() }}
                            of {{ $resource->total() }}
                            entries
                        </div>
                        <div class="pull-right">
                            {{ $resource->links("pagination::bootstrap-4") }}
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
            url: "/lahan/hapus_sdm/"+id,
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

        // window.location = "/lahan/kelola_resource/"+$_SESSION['id_lahan'];
        location.reload();   
        }

    });
    });
</script>
@endsection


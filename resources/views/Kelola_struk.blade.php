<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Struk Pembayaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')
</head>
	
        @include('nav_barMar')

</div>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <div class="col-md-12 mt-2">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                       
                        <li class="breadcrumb-item"><a href="/lahan/request/{{$_SESSION['id_lahan']}}">Back</a></li>
                        </ol>
                        </nav>
                    </div>
                    @foreach($struk2 as $index=>$struk2)
                    <table>
                        <tr>
                            <th scope="col">Nama Penyewa</th>          
                            <th scope="col">:</th>     
                            <td>{{ $struk2->nama}}</td>     
                                               
                        </tr>
                        <tr>
                            <th scope="col" >NIK</th>     
                            <th scope="col">:</th>     
                            <td>{{ $struk2->nik}}</td>                         
                        </tr>
                        
                    </table>
                    @endforeach
                    <table>

                        <tr>
                             <td>
                                 <a href="/lahan/struk/{{$_SESSION['id_sewa']}}" class="btn btn-sm btn-info" class="btn btn-sm btn-info">Tambah Struk</a>
                            </td>
                        </tr>
                
                    </table>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Gambar</th>
                                <th scope="col">Keterangan</th>                               
                                <th scope="col">Tanggal</th>  
                                <th scope="col">Kelola</th>                               
                                
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($struk as $index=>$struks)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>
                                        <a href="{{ url('gambar_struk') }}/{{ $struks->gambar }}" target="_blank"><img src="{{ url('gambar_struk') }}/{{ $struks->gambar }} "width="50" height="50"><a>
                                        
                                    </td>
                                    <td>{{ $struks->keterangan}}</td>
                                    <td>{{ $struks->tanggal}}</td>
                    
                                    <td>
                                        <a href="/lahan/ubah_struk/{{$struks->id_struk}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                        
                                        <button class="btn btn-sm btn-danger deleteProduct" data-id="{{$struks->id_struk}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                        
                              @endforeach   
                            </tbody>
                          </table>  
                          <div>
                            Showing {{ $struk->firstItem() }}
                            to {{ $struk->lastItem() }}
                            of {{ $struk->total() }}
                            entries
                        </div>
                        <div class="pull-right">
                            {{ $struk->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    

</body>
</html>

   

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
            url: "/lahan/hapus_Struk/"+id,
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

<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    @yield('js')
   



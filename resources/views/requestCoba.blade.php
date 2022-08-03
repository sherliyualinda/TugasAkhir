@extends('layouts2.main')

@section('title', 'Request Lahan')

@section('content')  
 

<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')


<style>

.card-body{
    width: auto;
    overflow: auto;
 }
 
</style>


        <div class="row1" >
            <div class="col-md-21">
                <div class="card border-0 shadow rounded">
                    <div class="card-body" >
                        <a href="{{ route('lahan.kelola_lahan') }}" class="btn btn-secondary mb-2">< Kembali</a>
                        <table class="table table-bordered" >
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Penyewa</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Alamat Penyewa</th>
                                <th scope="col">KTP</th>
                                <th scope="col" >Kelola</th>
                                <th scope="col" >Pesan</th>
                                <th scope="col" >Kelola</th>
                                <th colspan="2">Progres</th>
                                
                               

                              </tr>
                            </thead>
                            <tbody >
                            @foreach($sewa as $index=>$sewa)
                                <tr >
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $sewa->nama}}</td>
                                    <td>{{ $sewa->nik}}</td>
                                    <td>{{ $sewa->alamat}}</td>
                                    <td>
                                        <a href="{{ url('foto_ktp') }}/{{ $sewa->foto_ktp }}" target="_blank"><img src="{{ url('foto_ktp') }}/{{ $sewa->foto_ktp }} "width="50" height="50"><a>
<!-- 
                                        <img src="{{ url('foto_ktp') }}/{{ $sewa->foto_ktp }} "width="50" height="50"> -->
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#" method="POST">
                                        {{ csrf_field() }}
                                            <input type="hidden" name="status" class="form-control form-control-user" value="acc">
                                            <input type="hidden" name="id_penyewa" class="form-control form-control-user" value="{{$sewa->id_penyewa}}">
                                            <?php if($sewa->status == 'Acc'){?>
                                                Disetujui
                                            <?php }elseif($sewa->status == 'Tolak'){?>
                                                Tidak Disetujui
                                            <?php }else{?>
                                                <a href="/lahan/tolak/{{$sewa->id_penyewa}}" class="btn btn-sm btn-danger">Tolak</a>
                                                <a href="/lahan/acc/{{$sewa->id_penyewa}}" class="btn btn-sm btn-success">Terima</a>
                                            <?php } ?>
                                        </form>
                                       
                                    </td>

                                    <td>
                                    <a href="/sosial-media/chat_lahan/{{$sewa->username}}" class="btn btn-primary"><i class="fa fa-inbox"></i> chat</a>
                                    </td>
                                    
                                    <td>
                                    <a href="/gantt/{{$sewa->id_sewa}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                         <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                            <a href="/lahan/doneRequest/{{$sewa->id_sewa}}" class="btn btn-sm btn-success">Done</a>
                                        <?php }else{ ?>
                                            <a href="#" class="btn btn-sm btn-secondary">Done</a>
                                        <?php } ?>
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








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
    overflow-x: auto;
    overflow-y: auto;
 }
 
</style>
<!-- <div class="row">
    <div class="col-md-12 mt-1">
        <div class="card mb-5">
            <div class="card-body">
                @foreach($gambarnya as $manual)
                <center>
                    <img src="{{ url('gambar_lahan') }}/{{ $manual->gambar }} ">
                    {!! $manual->deskripsi !!}
                </center>
                @endforeach   
            </div>
        </div>
    </div>
</div> -->

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
                                <th scope="col">Foto</th>
                                <th scope="col" >Persetujuan</th>
                                <th scope="col" >Kelola Proyek</th>
                                
                                <!-- <th scope="col">Jadwal Kegiatan</th>
                                <th scope="col" >Risiko</th>
                                <th scope="col" >Jadwal Ketemu</th>
                                <th scope="col">Laporan Harian</th>
                                <th scope="col">Struk Pembayaran</th> -->
                                <th scope="col">Laporan</th>
                                <th scope="col" >Pesan</th>
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
                                        <a href="/data_file/{{$sewa->nama}}/foto_profil/{{ $sewa->foto_profil }}" target="_blank"><img src="/data_file/{{$sewa->nama}}/foto_profil/{{ $sewa->foto_profil }} "width="50" height="50"><a>
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
                                        <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                            <center>

                                                <a href="/gantt/{{$sewa->id_sewa}}"><i class="fa fa-list-alt fa-2x"></i></a>
                                            </center>
                                        <?php }else{?>
                                            <center>

                                                <a href="#" class="btn btn-sm btn-secondary"><i class="fa fa-list-alt fa-2x"></i> </a>
                                            </center>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="/lahan/dokumentasi/{{$sewa->id_sewa}}/{{$sewa->id_penyewa}}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                    <a href="/sosial-media/chat_lahan/{{$sewa->username}}" class="btn btn-primary"><i class="fa fa-inbox"></i></a>
                                    </td>

                                    <td>
                                         <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                            <a href="/lahan/doneRequest/{{$sewa->id_sewa}}" class="btn btn-sm btn-success">Selesai</a>
                                        <?php }else{ ?>
                                            <a href="#" class="btn btn-sm btn-secondary">Selesai</a>
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








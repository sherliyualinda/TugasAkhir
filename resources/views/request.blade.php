@extends('layouts2.main')

@section('title', 'Request Lahan')

@section('content')   
        <div class="row">
            <div class="col-md-20">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('lahan.kelola_lahan') }}" class="btn btn-secondary mb-2">< Kembali</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Penyewa</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Alamat Penyewa</th>
                                <th scope="col">KTP</th>
                                <th scope="col" >Kelola</th>
                                <th scope="col">Jadwal Kegiatan</th>
                                <th scope="col" >Risiko</th>
                                <th scope="col" >Jadwal Ketemu</th>
                                <th scope="col">Laporan Harian</th>
                                <th scope="col">Struk Pembayaran</th>
                                <th colspan="2">Progres</th>
                                <th scope="col" >Pesan</th>
                                
                               

                              </tr>
                            </thead>
                            <tbody>
                            @foreach($sewa as $index=>$sewa)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $sewa->nama}}</td>
                                    <td>{{ $sewa->nik}}</td>
                                    <td>{{ $sewa->alamat}}</td>
                                    <td>
                                        <img src="{{ url('foto_ktp') }}/{{ $sewa->foto_ktp }} "width="50" height="50">
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
                                        <a href="/gantt/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">Kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary"> Kelola</a>
                                        <?php } ?>

                                        
                                    </td>
                                    <td>
                                        <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                             <a href="/lahan/kelola_risk/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">Kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary"> Kelola</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                            <a href="/jadwal/kelola/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary"> Kelola</a>
                                        <?php } ?>

                                        
                                    </td>
                                  
                                    <td>
                                        <?php if($sewa->status == 'Acc'&& $sewa->progres != 'Done'){?>
                                            <a href="/lahan/kelola_daily/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">Kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary">Kelola</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($sewa->status == 'Acc'&& $sewa->progres != 'Done'){?>
                                            <a href="/lahan/kelola_struk/{{$sewa->id_sewa}}" class="btn btn-sm btn-info">kelola</a>
                                        <?php }else{?>
                                            <a href="#" class="btn btn-sm btn-secondary">Kelola</a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#" method="POST">
                                        {{ csrf_field() }}
                                            <input type="hidden" name="progres" class="form-control form-control-user" value="Done">
                                            <input type="hidden" name="id_penyewa" class="form-control form-control-user" value="{{$sewa->id_penyewa}}">
                                            <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                                Proses
                                            <?php }elseif($sewa->status == 'Acc' && $sewa->progres == 'Done'){?>
                                                Done
                                            <?php }else{?>
                                                -
                                            <?php } ?>
                                        </form>
                                    </td>
                                    <td>
                                         <?php if($sewa->status == 'Acc' && $sewa->progres != 'Done'){?>
                                            <a href="/lahan/doneRequest/{{$sewa->id_sewa}}" class="btn btn-sm btn-success">Done</a>
                                        <?php }else{ ?>
                                            <a href="#" class="btn btn-sm btn-secondary">Done</a>
                                        <?php } ?>
                                    </td>

                                    <td>
                                    <a href="/sosial-media/chat_lahan/{{$sewa->username}}" class="btn btn-primary"><i class="fa fa-inbox"></i> chat</a>
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
@extends('layouts2.main')

@section('title', 'Request Peralatan')

@section('content') 
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ url('peralatan/kelola_peralatan') }}" class="btn btn-secondary mb-2">< Kembali</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Penyewa</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Alamat Penyewa</th>
                                <th scope="col">KTP</th>
                                <th scope="col">Total Alat</th>
                                <th scope="col">Total Hari</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Bukti Bayar</th>
                                <th scope="col" >Kelola</th>
                                <th scope="col">Status</th>
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
                                        <center>
                                        <a href="{{ url('foto_ktp') }}/{{ $sewa->foto_ktp }}" target="_blank"><img src="{{ url('foto_ktp') }}/{{ $sewa->foto_ktp }} "width="50" height="50"><a>
                                        </center>
                                    </td>
                                    <td>{{ $sewa->qty}}</td>
                                    <td>{{ $sewa->totalHari}}</td>
                                    <td>{{ $sewa->totalHarga}}</td>
                                    <td>
                                        <center>
                                        <a href="{{ url('bukti_bayar') }}/{{ $sewa->bukti_bayar }}" target="_blank">
                                            <img src="{{ url('bukti_bayar') }}/{{ $sewa->bukti_bayar }} "width="50" height="50"><a>
                                        </center>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{url('peralatan/acc/{$sewa->id_sewa}')}}" method="POST">
                                        {{ csrf_field() }}
                                            <input type="hidden" name="status" class="form-control form-control-user" value="acc">
                                            <input type="hidden" name="id_penyewa" class="form-control form-control-user" value="{{$sewa->id_penyewa}}">
                                            <input type="hidden" name="qty" class="form-control form-control-user" value="{{$sewa->qty}}">
                                            <?php if($sewa->status == 'Acc'){?>
                                                Disetujui
                                            <?php }elseif($sewa->status == 'Tolak'){?>
                                                Tidak Disetujui
                                            <?php }elseif($sewa->status == 'Done'){?>
                                                Done
                                            <?php }else{?>
                                                <a href="/peralatan/tolak/{{$sewa->id_sewa}}" class="btn btn-sm btn-danger">Tolak</a>
                                                <a href="/peralatan/acc/{{$sewa->id_sewa}},{{$sewa->id_peralatan}},{{$sewa->stok}},{{$sewa->qty}}" class="btn btn-sm btn-success">Terima</a>
                                            <?php } ?>
                                            <td>
                                            <?php if($sewa->status == 'Acc'){?>
                                            <a href="/peralatan/done/{{$sewa->id_sewa}},{{$sewa->id_peralatan}},{{$sewa->stok}},{{$sewa->qty}}" class="btn btn-sm btn-success">Done</a>
                                        <?php }else{ ?>
                                            <a href="#" class="btn btn-sm btn-secondary">Done</a>
                                        <?php } ?>    
                                            </td>
                                            @endforeach 
                                            @foreach($peralatan as $peralatan)
                                            <input type="hidden" name="stok" class="form-control form-control-user" value="{{ $peralatan->stok}}">
                                            <input type="hidden" name="stok" class="form-control form-control-user" value="{{ $peralatan->id_peralatan}}">
                                        </form>
                        
                              @endforeach   
                            </tbody>
                          </table>  
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
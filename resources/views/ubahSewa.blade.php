@extends('layouts2.main')

@section('title', 'Sewa Lahan')

@section('content') 
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Tolong diisi
                </div>
                <div class="card-body">
                <form action="{{route('updateSewa')}}" method="POST" enctype="multipart/form-data">
                @foreach ($lahan as $lahan)
                <input type="hidden" name="id_lahan" value="{{$lahan->id}}">
                <input type="hidden" name="id_pemilik" value="{{$lahan->id_user}}">
                @endforeach
                @foreach ($pengguna as $pengguna)
                 {{ csrf_field() }}
                 <input type="hidden" name="id_pengguna" value="{{$pengguna->id}}">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="input" name="alamat" value="{{old('alamat',$pengguna->alamat)}}" class="form-control form-control-user" placeholder="Alamat">
                            <input type="hidden" name="id_penyewa" value="{{Auth::user()->pengguna->id_pengguna}}" class="form-control form-control-user" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="input" name="pekerjaan" value="{{old('pekerjaan',$pengguna->pekerjaan)}}" class="form-control form-control-user" rows="4" placeholder="Pekerjaan">
                        </div>
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="input" name="nik" value="{{old('nik',$pengguna->nik)}}" class="form-control form-control-user" rows="4" placeholder="NIK">
                        </div>
                        <div class="form-group">
                            <label>Foto KTP</label><br>
                            <input type="file" name="foto_ktp" value="{{old('foto_ktp',$pengguna->foto_ktp)}}" required>
                            <br>
                            <img src="{{ url('foto_ktp') }}/{{ $pengguna->foto_ktp }} "width="50" height="50" class="mt-2">
                        </div>
                        @endforeach
                        <center>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ajukan Investasi</button>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
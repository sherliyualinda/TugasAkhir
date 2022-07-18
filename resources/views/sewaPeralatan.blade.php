@extends('layouts2.main')

@section('title', 'Sewa Peralatan')

@section('content') 
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    Tolong Diisi
                </div>
                <div class="card-body">
                <form action="{{route('updateSewaPeralatan')}}" method="POST" enctype="multipart/form-data">
                @foreach ($peralatan as $peralatan)
                <input type="hidden" name="id_peralatan" value="{{$peralatan->id_peralatan}}">
                <input type="hidden" name="id_pemilik" value="{{$peralatan->id_pemilik}}">
                <input type="hidden" name="harga" value="{{$peralatan->harga}}">
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
                            <input type="file" name="foto_ktp" class="form-control form-control-user mb-1" value="{{old('foto_ktp',$pengguna->foto_ktp)}}" required>
                            <img src="{{ url('foto_ktp') }}/{{ $pengguna->foto_ktp }} "width="50" height="50">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Peralatan</label>
                            <input type="input" name="qty" class="form-control form-control-user" value="{{old('qty',$peralatan->qty)}}" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Hari</label>
                            <input type="input" name="totalHari" class="form-control form-control-user" value="{{old('totalHari',$peralatan->totalHari)}}" required>
                        </div>
                        @endforeach
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">< Kembali</a>
                        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Sewa</button>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
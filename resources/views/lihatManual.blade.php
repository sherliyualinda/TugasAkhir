@extends('super-admin.layouts.app')

@section('title')
    Lihat Manual Book Lahan
@endsection

@section('content')
<div class="container" style="margin-top: 50px" >
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lihat Manual Book
                </div>
                <div class="card-body">
          
                 <div class="form-group">
                     <label>Kategori Lahan</label>
                     <input type="text" name="jenis_lahan" value="{{old('jenis_lahan',$manual->category->nama)}}" class="form-control form-control-user" placeholder="Jenis Lahan" readonly>
                    
                    </div>
                        <input type="hidden" name="id_manual" value="{{old('id_manual',$manual->id_manual)}}" class="form-control form-control-user" placeholder="Jenis Lahan" readonly>
                        <div class="form-group">
                            <label>Jenis Lahan</label>
                            <input type="text" name="jenis_lahan" value="{{old('jenis_lahan',$manual->jenis_lahan)}}" class="form-control form-control-user" placeholder="Jenis Lahan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <img src="{{ url('gambar_manual') }}/{{ $manual->gambar }} "width="50" height="50">
                        </div>
                        <div class="form-group">
                            <label>Langkah-Langkah</label>
                            <div>{!! $manual->deskripsi !!}</div>
                        </div>
                        <div class="form-group">
                            <label>Sumber</label>
                            <input type="text" name="sumber" value="{{old('sumber',$manual->sumber)}}" readonly class="form-control form-control-user" placeholder="sumber">
                        </div>
                               
                        <a href="{{ url('lahan/manualBook') }}" class="btn btn-secondary">< Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
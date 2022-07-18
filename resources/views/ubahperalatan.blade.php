@extends('layouts2.main')

@section('title', 'Ubah Peralatan')

@section('content') 
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    Ubah Peralatan
                </div>
                <div class="card-body">
                @foreach ($peralatan as $peralatan)
                <form action="{{route('updateperalatan')}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <input type="hidden" name="id_peralatan" value="{{$peralatan->id_peralatan}}">  
                        <div class="form-group">
                            <label>Nama Alat</label>
                            <input type="input" name="nama_alat" value="{{old('nama_alat',$peralatan->nama_alat)}}" class="form-control form-control-user" placeholder="Nama Alat">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="input" name="deskripsi" id="deskripsi" value="{{old('deskripsi',$peralatan->deskripsi)}}" class="form-control form-control-user" rows="4" placeholder="Masukkan Deskripsi">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="input" name="harga" value="{{old('harga',$peralatan->harga)}}" class="form-control form-control-user" rows="4" placeholder="Masukkan Harga">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <input type="file" name="gambar" value="{{old('gambar',$peralatan->gambar)}}" class="form-control mb-1 form-control-user" required>
                            <img src="{{ url('gambar_peralatan') }}/{{ $peralatan->gambar }} "width="50" height="50">
                        </div>
                        @endforeach
                        <a href="{{ url('peralatan/kelola_peralatan') }}" class="btn btn-secondary">< Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'deskripsi' );
</script>
@endsection

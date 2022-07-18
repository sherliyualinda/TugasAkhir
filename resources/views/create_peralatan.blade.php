@extends('layouts2.main')

@section('title', 'Tambah Peralatan')

@section('content') 
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    Upload Peralatan
                </div>
                <div class="card-body">
                <form action="{{route('peralatan.simpan')}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                        <div class="form-group">
                            <label> Nama Alat</label>
                            <input type="input" name="nama_alat" class="form-control form-control-user" placeholder="nama alat">
                        </div>
                        <div class="form-group">
                            <label> Harga Sewa</label>
                            <input type="input" name="harga" class="form-control form-control-user" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <!-- <textarea class="form-control" name="content" placeholder="Masukkan Content" rows="4"></textarea> -->
                            <textarea name="deskripsi" id="deskripsi" class="form-control form-control-user" rows="4" placeholder="Masukkan Deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control form-control-user">
                        </div>
                        <a href="{{ route('peralatan') }}" class="btn btn-secondary">< Kembali</a>
                        <button type="submit" class="btn btn-success">SIMPAN</button>                    
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
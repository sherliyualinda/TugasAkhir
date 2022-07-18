@extends('layouts2.main')

@section('title', 'Buat Lahan Baru')

@section('content')    
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-5">
            <div class="card-header">
                Buat Lahan Baru
            </div>
            <div class="card-body">
            <form action="{{route('lahan.simpan')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label>Kategori</label>
                        <!-- <input type="text" name="title" placeholder="Masukkan Title" class="form-control"> -->
                        <select class="form-control" name="category_lahan_id" placeholder="--Pilih Kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach($categori as $categori)
                                <option value="{{$categori->id}}">{{$categori->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="input" name="ukuran" class="form-control" placeholder="Ukuran">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <!-- <textarea class="form-control" name="content" placeholder="Masukkan Content" rows="4"></textarea> -->
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Masukkan Deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar">
                    </div>
                    <div class="form-group">
                        <a href="{{ route('lahan') }}" class="btn btn-secondary">< Kembali</a>
                        <button type="submit" class="btn btn-success">SIMPAN</button>                    
                    </div>
                </form>
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

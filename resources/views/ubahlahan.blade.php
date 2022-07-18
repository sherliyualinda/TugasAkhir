@extends('layouts2.main')

@section('title', 'Ubah Lahan')

@section('content')   
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    Ubah Lahan
                </div>
                <div class="card-body">
                @foreach ($lahan as $lahan)
                <form action="{{route('updatelahan')}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <input type="hidden" name="id" value="{{$lahan->id}}">
                 @endforeach
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category_lahan_id" placeholder="--Pilih Kategori">
                                @foreach ($categori as $categori)
                                    <option value="{{$categori->id}}" @if(old('categori',$lahan->category_lahan_id) == $categori->id) selected="selected" @endif>
                                        {{$categori->nama}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @foreach ($lahan2 as $lahan2)
                        <div class="form-group">
                            <label>Ukuran</label>
                            <input type="input" name="ukuran" value="{{old('ukuran',$lahan2->ukuran)}}" class="form-control form-control-user" placeholder="Ukuran">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10">{{$lahan2->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <img src="{{ url('gambar_lahan') }}/{{ $lahan2->gambar }} "width="50" height="50">
                            <input type="file" name="gambar" value="{{old('gambar',$lahan2->gambar)}}" required>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <a href="{{ route('lahan') }}" class="btn btn-secondary">< Kembali</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>                    
                        </div>
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

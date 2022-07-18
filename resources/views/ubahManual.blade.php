@extends('super-admin.layouts.app')

@section('title')
    Tambah Manual Book
@endsection

@section('content')
<div class="container" style="margin-top: 50px" >
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Ubah Manual Book
                </div>
                <div class="card-body">
          
                <form action="{{url('lahan/update_manual')}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 @foreach ($manual as $manual)
                    <div class="form-group">
                        <label>Kategori Lahan</label>
                        <select class="form-control" name="id_categoryLahan" placeholder="--Pilih kategori">
                            @foreach ($category as $category)
                            <option value="{{$category->id}}" @if(old('category',$manual->id_categoryLahan) == $category->id) selected="selected" @endif>
                                {{$category->nama}}
                                </option>
                              @endforeach
                          </select>
                      </div>

                    
                        <input type="hidden" name="id_manual" value="{{old('id_manual',$manual->id_manual)}}" class="form-control form-control-user" placeholder="Jenis Lahan">
                        <div class="form-group">
                            <label>Jenis Lahan</label>
                            <input type="input" name="jenis_lahan" value="{{old('jenis_lahan',$manual->jenis_lahan)}}" class="form-control form-control-user" placeholder="Jenis Lahan">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <img src="{{ url('gambar_manual') }}/{{ $manual->gambar }} "width="50" height="50">
                            <input type="file" name="gambar" class="form-control" value="{{old('gambar',$manual->gambar)}}" required>
                        </div>
                        <div class="form-group">
                            <label>Langkah-Langkah</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10">{{$manual->deskripsi}}</textarea>

                          
                        </div>
                        <div class="form-group">
                            <label>Sumber</label>
                            <input type="input" name="sumber" value="{{old('sumber',$manual->sumber)}}" class="form-control form-control-user" placeholder="sumber">
                        </div>
                   
                        @endforeach 
                        <a href="{{ url('lahan/manualBook') }}" class="btn btn-secondary">< Kembali</a>
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

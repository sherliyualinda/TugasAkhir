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
                    Buat Manual
                </div>
                <div class="card-body">
          
                <form action="{{url('lahan/simpan_manual')}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                        <div class="form-group" background-color:lightgrey>
                            <div class="form-group">
                                <label>Kategori Lahan</label>
                                <select class="form-control" name="id_categoryLahan" placeholder="--Skala Kemungkinan--">
                                    <option value="1">Pertanian</option>
                                    <option value="2">Perkebunan</option>
                                    <option value="3">Perikanan</option>
                                    <option value="4">Peternakan</option>
                                
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Gambar</label>
                              <input type="file" name="gambar">
                            </div>
                            <label>Jenis Lahan</label>
                            <input type="input" name="jenis_lahan" class="form-control form-control-user" placeholder="Jenis Lahan">
                        </div>
                        <div class="form-group">
                            <label>Langkah-Langkah</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> 
                        </div>
                        <div class="form-group">
                            <label>Sumber</label>
                            <input type="input" name="sumber" class="form-control form-control-user" placeholder="sumber">
                        </div>
                    
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

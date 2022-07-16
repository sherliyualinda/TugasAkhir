@include('nav_barMar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 	    
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">




<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Tambah Post</title>
</head>

<body>

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
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
                            <textarea name="deskripsi" cols="30" rows="10">{{$lahan2->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <img src="{{ url('gambar_lahan') }}/{{ $lahan2->gambar }} "width="50" height="50">
                            <input type="file" name="gambar" value="{{old('gambar',$lahan2->gambar)}}" required>
                        </div>
                        @endforeach
                        <!-- <button type="submit" class="btn btn-success">SIMPAN</button> -->
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Data</button>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>

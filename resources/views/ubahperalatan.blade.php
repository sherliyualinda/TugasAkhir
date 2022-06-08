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
    <title>Ubah Peralatan</title>
</head>

<body>

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
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
                            <input type="input" name="deskripsi" value="{{old('deskripsi',$peralatan->deskripsi)}}" class="form-control form-control-user" rows="4" placeholder="Masukkan Deskripsi">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="input" name="harga" value="{{old('harga',$peralatan->harga)}}" class="form-control form-control-user" rows="4" placeholder="Masukkan Harga">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <img src="{{ url('gambar_peralatan') }}/{{ $peralatan->gambar }} "width="50" height="50">
                            <input type="file" name="gambar" value="{{old('gambar',$peralatan->gambar)}}" required>
                        </div>
                        @endforeach
                        <!-- <button type="submit" class="btn btn-success">SIMPAN</button> -->
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>                    
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
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
    <title>Tambah WBS</title>
</head>

<body>

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
        <div class="col-md-8 offset-md-2">
                    <div class="col-md-12 mt-2">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <?php session_start(); ?>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">< Kembali</a>  
                        </ol>
                        </nav>
                    </div>
            <div class="card">
            <div class="card">
                <div class="card-header">
                    Isi Kebutuhan dari {{ $wbs->text }}
                </div>
                <div class="card-body">
                    <form action="{{route('simpan_wbs')}}" method="POST" enctype="multipart/form-data">                
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$wbs->id}}">
                            <input type="hidden" name="parent" value="{{$wbs->parent}}">
                        </div>
                        <div class="form-group">
                            <label>QTY</label>
                            <input type="number" name="qty" class="form-control form-control-user" placeholder="qty" value="{{ $wbs->qty }}">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" class="form-control form-control-user" placeholder="satuan" value="{{ $wbs->satuan }}">
                        </div>
                        <div class="form-group">
                            <label>Harga Per Satuan</label>
                            <input type="number" name="harga" class="form-control form-control-user" placeholder="harga" value="{{ $wbs->harga }}">
                        </div>
                        
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>                    
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

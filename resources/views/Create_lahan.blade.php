@include('nav_barMar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 	    
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">

<div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
    <h1>Create Lahan</h1>
    <hr>
    <hr>
    <form action="{{route('lahan.simpan')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field() }}
    <table>
  <div class="form-group">
    <tr>
        <label>Kategori</label>
        <select class="form-control" name="category_lahan_id">
            <option value="">Pilih Kategori</option>
            @foreach($categori as $categori)
                <option value="{{$categori->id}}">{{$categori->nama}}</option>
            @endforeach
         </select>
    </tr>
  </div>
  <div class="form-group">
    <tr>
        <td>Ukuran</td> 
        <td><input type="input" name="ukuran" class="form-control form-control-user">
        </td>
    </tr>
  </div>
  <div class="form-group">
    <tr>
        <td>Deskripsi</td> 
        <td><textarea name="deskripsi" class="form-control form-control-user"></textarea></td>
    </tr>
  </div>
  <div class="form-group">
  <div class="form-group">
		<tr>
            <td>File Gambar</td>
		    <td><input type="file" name="gambar"></td>
        </tr>
    </div>
    <tr>
        <td><button type="submit">Create</button></td> 
    </tr> 
  </div>
</table>


<!-- Percobaan -->

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
        <td><input type="input" name="ukuran" class="form-control form-control-user"></td>
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
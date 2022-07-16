@extends('layouts2.dashboard')

@section('title')
    Tambah Video
@endsection

@section('css')
    <style>
        .pt-6, .py-6 {
            padding-top: 5rem !important;
        }
        .form-control {
            background-color: #e9ecef80 !important;
            color: gray !important;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 pt-6">
      <h1 class="h3 mb-0 text-gray-800">Tambah Video</h1>
  </div>
  @if($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach($errors->all() as $error)
          <li> {{ $error }} </li>
          @endforeach
      </ul>
  </div>
  @endif
<!-- Content Row -->
  <div class="card">
    <div class="card-body">
        <div class="col-lg-8">
            <div class="p-5">
                <form method="POST" action="{{route('video.store')}}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control" accept=".jpeg,.png,.jpg,.gif" required>
                    </div>
                    <div class="form-group">
                        <label for="">Video</label>
                        <input type="file" name="video" class="form-control" accept=".mp4,.mov,.3gp" required>
                    </div>
                    <div class="form-group">
                        <a href="{{route('superadmin.sosial-media.video.index')}}" class="btn btn-warning btn-user">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-user">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
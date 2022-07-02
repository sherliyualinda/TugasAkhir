@extends('super-admin.layouts.app')

@section('title')
    Lihat Video
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Lihat Video</h1>
  </div>
  
<!-- Content Row -->
  <div class="card">
    <div class="card-body">
        <div class="col-lg-8">
            <div class="p-5">
                <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" name="title" class="form-control border-1" readonly value="{{ $video->title }}">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <p>{{ $video->description }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail</label>
                        <br>
                        <img src="{{asset($video->thumbnail)}}" alt="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="">Video</label>
                        <br>
                        <video width="320" height="240" controls>
                            <source src="{{asset($video->url)}}" type="video/mp4">
                          Your browser does not support the video tag.
                      </video>
                    </div>
                    <div class="form-group">
                        <a href="{{route('superadmin.sosial-media.video.index')}}" class="btn btn-warning btn-user">Kembali</a>
                    </div>
            </div>
        </div>
    </div>
  </div>
@endsection
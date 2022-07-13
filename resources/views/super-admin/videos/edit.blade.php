@extends('super-admin.layouts.app')

@section('title')
    Edit Video
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Edit Video</h1>
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
                <form method="POST" action="{{route('superadmin.sosial-media.video.update', $video->id)}}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put" />
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" name="title" class="form-control border-1" required value="{{ $video->title }}">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="description" class="form-control border-1" rows="3">{{ $video->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control border-1" accept=".jpeg,.png,.jpg,.gif">
                        <img src="{{asset($video->thumbnail)}}" alt="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="">Video</label>
                        <input type="file" name="video" class="form-control border-1" accept=".mp4,.mov,.3gp">
                        <video width="320" height="240" controls>
                            <source src="{{asset($video->url)}}" type="video/mp4">
                          Your browser does not support the video tag.
                      </video>
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
@endsection
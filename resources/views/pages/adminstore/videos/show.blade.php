@extends('layouts2.dashboard')

@section('title')
    Lihat Video
@endsection

@section('css')
    <style>
        .pt-6, .py-6 {
            padding-top: 5rem !important;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-flex mb-4 pt-6">
      <h1 class="h3 mb-0 text-gray-800">Video {{ $video->title }}</h1>
      @if ($video->is_active == 1)
          <span class="badge badge-primary ml-2">Disetujui</span>
        @elseif ($video->is_active == 2)
          <span class="badge badge-danger ml-2">Ditolak</span>
      @else
          <span class="badge badge-secondary ml-2">Perlu Ditinjau</span>
      @endif
  </div>
  
<!-- Content Row -->
  <div class="card">
    <div class="card-body">
        <div class="col-lg-12">
          <div class="form-group">
              <label for="">Judul</label>
              <p>{{ $video->title }}</p>
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
        </div>
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Views</th>
                    <th scope="col">Like</th>
                    <th scope="col">Don't Like</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Subscribe</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ ($video->detail) ? number_format($video->detail['views']) : '0' }}</td>
                    <td>{{ ($video->detail) ? number_format($video->detail['like']) : '0' }}</td>
                    <td>{{ ($video->detail) ? number_format($video->detail['dont_like']) : '0' }}</td>
                    <td>{{ ($video->detail) ? number_format($video->detail['comment']) : '0' }}</td>
                    <td>{{ ($video->detail) ? number_format($video->detail['subscribes']) : '0' }}</td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div class="text-center">
          <a href="{{route('video.index')}}" class="btn btn-warning btn-user">Kembali</a>
          @if ($video->is_active == 0)
            <a href="{{route('dashboard.video.status',['id' => $video->id,'status' => 1])}}" class="btn btn-primary btn-user">Setujui</a>
            <a href="{{route('dashboard.video.status',['id' => $video->id,'status' => 2])}}" class="btn btn-danger btn-user">Ditolak</a>
          @endif
        </div>
    </div>
  </div>
</div>
@endsection
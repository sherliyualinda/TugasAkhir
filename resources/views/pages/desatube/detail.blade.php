@extends('layouts2.app')

@push('addon-style')
<style>
.video-title-scope{
  font-family: "Roboto","Arial",sans-serif;
  font-size: 1.4rem;
  line-height: 2rem;
  font-weight: 500;
  max-height: 4rem;
  overflow: hidden;
  display: block;
  -webkit-line-clamp: 2;
  display: box;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  text-overflow: ellipsis;
  white-space: normal;
}
.identity-scope, .identity-detail-scope{
  display: flex;
  font-family: "Roboto","Arial",sans-serif;
  font-size: 0.8rem;
  line-height: 1rem;
  font-weight: 400;
}
.identity-detail-scope{
  font-size: 1rem;
}
.identity-scope .time{
  padding-left: 5px;
}
.channel::after{
  content: "•";
  margin: 0 4px;
}
.btn-like a{
  color: #212529;
  text-decoration: none;
  cursor: pointer;
}
.text-blue{
  color: #0056b3 !important;
}
a.disabled {
  pointer-events: none;
  cursor: default;
}
.mini-text{
  font-size: 11px;
}
</style>    
@endpush

@section('title')
{{$video->title}}
@endsection

@section('content')
<div class="page-content page-home">

  <!-- Store new Produk -->
  <section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-8">
          <video width="720" controls>
            <source src="{{asset($video->url)}}" type="video/mp4">
              Your browser does not support the video tag.
          </video>
          <h3>{{ $video->title }}</h3>
          <div class="d-block identity-detail-scope">
            @if (!is_null($video->detail))
            <span class="channel">{{ number_format($video->detail->views) . ' x ditonton' }}</span>
            @endif
            <span>{{ $video->created_at->diffForHumans() }}</span>
            <span class="float-right pr-2 pl-2 btn-like"><a id="onDislike" class="{{ ($videoLike && $videoLike->type === 'dont_like') ? 'text-blue':'' }} {{ ($videoLike && $videoLike->type === 'like') ? 'disabled':'' }}" data-id="{{$video->id}}"><i class="fa fa-thumbs-down"></i> {{($video->detail->dont_like > 0) ? $video->detail->dont_like:'' }} Tidak Suka</a></span>
            <span class="float-right btn-like"><a id="onLike" class="{{ ($videoLike && $videoLike->type === 'like') ? 'text-blue':'' }}" data-id="{{$video->id}} {{ ($videoLike && $videoLike->type === 'dont_like') ? 'disabled':'' }}"><i class="fa fa-thumbs-up"></i> {{($video->detail->like > 0) ? $video->detail->like:'' }} Suka</a></span>
          </div>
          <hr>
          <div class="d-block pengguna">
            <span>{{ $video->user->name }}</span>
            <button type="submit" class="btn btn-danger float-right">SUBSCRIBE</button>
          </div>
          <p>
            {{ $video->description }}
          </p>
          <hr>
          <div class="row">
            <div class="col-12">
              <h5>{{($video->detail->comment > 0) ? $video->detail->comment .' Komentar': ''}} </h5>
            </div>
          </div>
          <form action="{{route('desatube.comment')}}" method="POST">
            <input type="hidden" name="id_video" value="{{$video->id}}">
            {{csrf_field()}}
            <div class="form-group">
              <textarea name="content" class="form-control" rows="2"></textarea>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
          </form>

          <div class="list-command">
            <div class="row">
              @foreach ($comments as $item)
              <div class="col-12">
                <div class="d-block pengguna">
                  <span>{{ $item->user->name }}</span>
                  <span class="mini-text">{{ $item->created_at->diffForHumans() }}</span>
                </div>
                @if ($item->user->id == auth()->user()->id)
                <i class="fa fa-trash" style="float: right;"></i>
                @endif
                <p>{{$item->content}}</p>
                <hr>
              </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="col-4">
          <div class="pl-3 pb-2">
            <h4>Video Terbaru</h4>
          </div>
          @forelse ( $videos as $item)
            <div class="col-12 col-md-12 col-lg-12" data-aos="fade-up">
              <a href="{{ route('desatube.show', $item->id) }}" class="component-products d-block">
                <div class="products-thumbnail">
                  <div class="products-image" style="
                                @if (!empty($item->thumbnail))
                                    background-image: url('{{ asset($item->thumbnail) }}')
                                @else
                                    background-image: #eee
                                @endif 
                                ">
                  </div>
                </div>
                <div class="products-text">
                  <div class="video-title-scope">
                    {{ $item->title }}
                  </div>
                  <div class="identity-scope">
                    <span class="channel">{{ $item->user->name }}</span>
                    <span class="time">{{ $item->created_at->diffForHumans() }}</span>
                  </div>
                </div>
              </a>
            </div>
            @empty
              <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                Data Tidak Di Temukan
              </div>
            @endforelse
        </div>
      </div>
      
    </div>
  </section>
</div>
@endsection

@section('script')
    <script>
        $('#onLike').click(function(){
          $.ajax({
            url: '/desatube/like/'+this.dataset.id +'/like',
            type: 'get',
            success: function (data) {
              if (data.message == 'success') {
                $('#onLike').addClass('text-blue')
              }else{
                $('#onLike').removeClass('text-blue')
              }
              location.reload()
            }
          });
        });

        $('#onDislike').click(function(){
          $.ajax({
            url: '/desatube/like/'+this.dataset.id +'/dont_like',
            type: 'get',
            success: function (data) {
              if (data.message == 'success') {
                $('#onDislike').addClass('text-blue')
              }else{
                $('#onDislike').removeClass('text-blue')
              }
                location.reload()
            }
          });
        });
    </script>
@endsection
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
          <div class="identity-detail-scope">
            <span class="channel">{{ ($video->detail->views == 0) ? '': $video->detail->views . ' x ditonton' }}</span>
            <span>{{ $video->created_at->diffForHumans() }}</span>
          </div>
          <hr>
          <div class="pengguna">
            <span>{{ $video->pengguna->nama }}</span>
          </div>
          <p>
            {{ $video->description }}
          </p>
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
                    <span class="channel">{{ $item->pengguna->nama }}</span>
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
@extends('layouts2.app')

@push('addon-style')
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/color.css') }}">
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
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
.identity-scope{
  display: grid;
  font-family: "Roboto","Arial",sans-serif;
  font-size: 0.8rem;
  line-height: 1rem;
  font-weight: 400;
}
.channel::after{
  content: "•";
  margin: 0 4px;
}
</style>    
@endpush

@section('title')
DesaTube
@endsection

@section('content')
<div class="page-content page-home">

  <!-- video -->
  <section class="store-new-products">
    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
          <a href="{{ route('desatube.index') }}" class="dropdown-item">
            <img src="/TT.png" style="min-width: 150px;">
            <br>
            <small style="white-space: normal!important;">Konten video desa di DesaTube!</small>
          </a>
        </div>
        <div class="col-10">
          @php
            $incrementProduct = 0;
          @endphp
          <div class="row">
            @forelse ( $videos as $item)
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct+=100 }}">
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
                    <span>{{ $item->user->name }}</span>
                    @if (!is_null($item->detail))
                    <span class="channel">{{ number_format($item->detail->views) . ' x ditonton' }}</span>
                    @endif
                    <span>{{ $item->created_at->diffForHumans() }}</span>
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
          <div class="row">
            <div class="col-12 mt-4">
              {{ $videos->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
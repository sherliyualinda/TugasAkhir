@extends('layouts2.app')

@section('title')
Desaku Video Page
@endsection

@section('content')
<div class="page-content page-home">

  <!-- video -->
  <section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Video</h5>
        </div>
      </div>
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
              {{ $item->title }}
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
  </section>
</div>
@endsection
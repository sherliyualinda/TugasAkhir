<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="padding-left: 32px; padding-bottom: 10px; height: 250px; padding-left: 0; padding-right: 32px;">
    <div class="carousel-inner">
        @php
        $api_wisata = json_decode( file_get_contents('https://desaku-desatour.masuk.id/api/wisata'), true );
        @endphp
        @foreach($api_wisata['data'] as $api)
            <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}" data-item="{{$loop->iteration}}">
                <img src="{{ $api['foto'] }}" class="d-block w-100" style="height: 250px; padding-bottom: 10px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <div style="margin-bottom: 10px;">
                        <h5><a href="{{ $api['url'] }}" target="_blank">{{ $api['nama'] }}</a></h5>
                        <small class="badge badge-success" style="display: inline">{{ $api['jam'] }}</small>
                        <small class="badge badge-warning" style="display: inline">{{ $api['biaya'] }}</small>
                    </div>
                </div>
            </div>
            @if($loop->iteration == 3)
            @break
            @endif
        @endforeach
    </div>
    {{-- <a class="carousel-control-prev" href="#Indicators" role="button" data-slide="prev" style="height: 250px; padding-bottom: 10px;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Indicators" role="button" data-slide="next" style="height: 250px; padding-bottom: 10px;">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a> --}}
</div>
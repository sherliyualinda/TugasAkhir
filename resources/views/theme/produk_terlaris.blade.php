<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="padding-left: 32px; padding-bottom: 10px; height: 250px; padding-left: 32px; padding-right: 0;">
    <div class="carousel-inner">
        @php
            $produk_terlaris = json_decode(file_get_contents('https://marketpalcedesaku.masuk.web.id/api/productterlaris'), true);
        @endphp
        @foreach($produk_terlaris as $api)
            <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}" data-item="{{$loop->iteration}}">
                @php
                $foto_produk = json_decode(file_get_contents('https://marketpalcedesaku.masuk.web.id/api/produkgalleri/'.$api['products_id']), true);
                @endphp
                @foreach($foto_produk as $api_foto)
                    <img src="https://marketpalcedesaku.masuk.web.id/storage/{{ $api_foto['photos'] }}" class="d-block w-100" style="height: 250px; padding-bottom: 10px; object-fit: cover;">
                    @if($loop->iteration == 1)
                    @break
                    @endif
                @endforeach
                <div class="carousel-caption d-none d-md-block">
                    <div class="header-text-carousel">TOP 3 SELLING</div>
                    <div style="margin-bottom: 10px;">
                        <h5 style="display: inline"><a href="https://marketpalcedesaku.masuk.web.id/details/{{ $api['slug'] }}" target="_blank">{{ $api['name'] }}</a></h5>
                        <small class="badge badge-warning" style="display: inline">{{ $api['jumlah_terjual'] }} Terjual</small>
                    </div>
                </div>
            </div>
            @if($loop->iteration == 3)
            @break
            @endif
        @endforeach
    </div>
    {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="height: 250px; padding-bottom: 10px;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="height: 250px; padding-bottom: 10px;">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a> --}}
</div>
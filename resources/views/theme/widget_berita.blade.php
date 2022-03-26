@php
    $url = "https://desaku-desanews.masuk.id/api/berita";
    $headers = @get_headers($url);
@endphp
@if($headers && strpos( $headers[0], '200'))
@php
	$api_berita = json_decode( file_get_contents('https://desaku-desanews.masuk.id/api/berita'), true );
@endphp
@if ($api_berita != NULL)
	@foreach ($api_berita as $api)
		<li>
			<figure style="width:100%; margin-bottom: 5px;">
				<img src="https://desaku-desanews.masuk.id/{{ $api['gambar'] }}" alt="" onerror="this.onerror=null;this.src='{{ asset('sampul.jpg') }}';" style="width: 100%; height: 75px; border-radius: 0;">
			</figure>
			<div class="friendz-meta" style="padding-left: 0;">
				<a href="https://desaku-desanews.masuk.id/berita/{{ $api['id']}}/{{ $api['slug']}}" target="_blank"><b>{{ $api['judul'] }}</b></a>
				<small style="text-transform: capitalize;">{{ strtolower($api['kelurahans']) }} - {{ date_format(date_create($api['created_at']), "d M 'y") }}</small>
			</div>
		</li>
		@if($loop->iteration == 3)
		@break
		@endif
	@endforeach
@else
	<li>
		<div align="center">Tidak Ada Berita Terbaru</div>
	</li>
@endif
@else
    <li>
		<div align="center">Server Desanews Down. <small onclick="refresh_berita()" style="cursor: pointer; color: red;">Refresh</small></div>
	</li>
@endif
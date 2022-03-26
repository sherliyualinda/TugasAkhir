@php
    $url = "https://desatube.masuk.web.id/api/video";
    $headers = @get_headers($url);
@endphp
@if($headers && strpos( $headers[0], '200'))
@php
	$api_video = json_decode( file_get_contents('https://desatube.masuk.web.id/api/video'), true );
@endphp
@if ($api_video != NULL)
	@foreach ($api_video as $api)
	<li>
		<figure style="width:100%; margin-bottom: 5px;">
			<img src="https://desatube.masuk.web.id{{$api['thumbnail']}}" alt="" style="width: 100%; height: 75px; border-radius: 0;">
		</figure>
		<div class="friendz-meta" style="padding-left: 0;">
			<a href="https://desatube.masuk.web.id/watch/{{$api['uid']}}" target="_blank"><b>{{ $api['title'] }}</b></a>
			<small style="text-transform: capitalize;">{{ strtolower($api['village_name']) }} - {{ date_format(date_create($api['created_at']), "d M 'y") }}</small>
		</div>
	</li>
	@if($loop->iteration == 3)
	@break
	@endif
	@endforeach 
@else
	<li>
		<div align="center">Tidak Ada Video Terbaru</div>
	</li>
@endif
@else
    <li>
		<div align="center">Server Desatube Down. <small onclick="refresh_video()" style="cursor: pointer; color: red;">Refresh</small></div>
	</li>
@endif
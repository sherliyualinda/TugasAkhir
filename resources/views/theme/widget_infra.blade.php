@php
    $url = "https://desaku-desatour.masuk.id/api/infrastruktur";
    $headers = @get_headers($url);
@endphp
@if($headers && strpos( $headers[0], '200'))
@php
	$api_infra = json_decode( file_get_contents('https://desaku-desatour.masuk.id/api/infrastruktur'), true );
@endphp
@if ($api_infra != NULL)
	@foreach ($api_infra['data'] as $api)
	<li>
		<figure style="width:100%; margin-bottom: 5px;">
			<img src="{{$api['foto']}}" alt="" style="width: 100%; height: 75px; border-radius: 0;">
		</figure>
		<div class="friendz-meta" style="padding-left: 0;">
			<a href="{{$api['url']}}" target="_blank"><b>{{ $api['nama'] }}</b></a>
			<small style="text-transform: capitalize; display: inline">{{ strtolower($api['desa']) }}</small> <small class="{{ $api['Status'] == 'nonMusrenbang' ? 'badge badge-warning' : 'badge badge-success'}}" style="display: inline;">{{ $api['Status'] }}</small>
		</div>
	</li>
	@if($loop->iteration == 3)
	@break
	@endif
	@endforeach 
@else
	<li>
		<div align="center">Tidak Ada Infrastruktur Terbaru</div>
	</li>
@endif
@else
    <li>
		<div align="center">Server Desatour Down. <small onclick="refresh_infra()" style="cursor: pointer; color: red;">Refresh</small></div>
	</li>
@endif
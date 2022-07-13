@if ($video_news)
	@foreach ($video_news as $item)
	<li>
		<figure style="width:100%; margin-bottom: 5px;">
			<img src="{{ $item->thumbnail != null ? asset($item->thumbnail) : asset('user.jpg') }}" alt="" style="width: 100%; height: 75px; border-radius: 0;">
		</figure>
		<div class="friendz-meta" style="padding-left: 0;">
			<a href="{{route('desatube.show', $item->id)}}" target="_blank"><b>{{ $item->title }}</b></a>
			<small style="text-transform: capitalize;">{{ $item->user->name }} - {{ $item->created_at->diffForHumans() }}</small>
		</div>
	</li>
	@endforeach 
@else
	<li>
		<div align="center">Tidak Ada Video Terbaru</div>
	</li>
@endif
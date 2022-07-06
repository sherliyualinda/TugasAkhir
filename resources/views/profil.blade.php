<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Sosial Media Desaku</title>
	<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 
	{{-- <link rel="icon" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/images/fav.png') }}" type="image/png" sizes="16x16">  --}}
    
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('jquery-ui-1.12.1.custom/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slideshow.css') }}">
	<link rel="stylesheet" href="{{ asset('css/read-less-more.css') }}">
	<link rel="stylesheet" href="{{ asset('css/profil.css') }}">
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
		.video-thumbnail {
			width: 100%;
			height: 150px;
			border-radius: 8px;
			overflow: hidden;
			position: relative;
			z-index: 1;
		}
		.detail-thumbnail{
			width: 100%;
			height: 100%;
			background-color: #ddd;
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
		}
		</style>  
</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		@include('theme.nav_bar')
	</nav>
    
    <section>
    	@foreach ($profil as $data)
		<div class="feature-photo">
			<figure class="img_sampul">
				<img src="{{ $data->foto_sampul != null ? url('/data_file/'.$data->username.'/foto_sampul/'.$data->foto_sampul) : asset('sampul.jpg') }}" id="img_sampul" alt="" style="width: 1366px; height: 200px;">
			</figure>
			@if(Auth::check())
				@if ($data->username == auth()->user()->pengguna->username)
				<form class="edit-phto" style="bottom: 120px;" enctype="multipart/form-data">
				{{ csrf_field() }}
					<i class="fa fa-camera-retro"></i>
					<label class="fileContainer">
						Ubah Foto Sampul
						<input type="file" name="foto_sampul" id="sampul" accept="image/*"/>
						<input type="hidden" name="id_pengguna" value="{{$data->id_pengguna}}" class="id_pengguna"/>
						<input type="hidden" name="username_pengguna" value="{{$data->username}}" class="uname_pengguna"/>
					</label>
				</form>
				@endif
			@endif
			<div class="container-fluid">
				<div class="row merged">
					<div class="col-lg-5 col-sm-4"></div>
					<div class="col-lg-2 col-sm-3">
						<div class="user-avatar">
							<figure class="img_profil">
								<img src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}" id="img_profil" alt="">
								@if(Auth::check())
									@if ($data->username == auth()->user()->pengguna->username)
									<form class="edit-phto" enctype="multipart/form-data">
									{{ csrf_field() }}
										<i class="fa fa-camera-retro"></i>
										<label class="fileContainer">
											Ubah Foto Profil
											<input type="file" name="foto_profil" id="profil" accept="image/*"/>
											<input type="hidden" name="id_pengguna" value="{{$data->id_pengguna}}" class="id_pengguna"/>
											<input type="hidden" name="username_pengguna" value="{{$data->username}}" class="uname_pengguna"/>
										</label>
									</form>
									@endif
								@endif
							</figure>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</section>
	<?php $array = array();
		if(Auth::check()){
			foreach($follow_request as $req){
				$array[] = $req->id_pengguna;
			}
		}

		$arr_flw = array();
		if(Auth::check()){
			foreach ($followers_saya as $flw) {
				$arr_flw[] = $flw->username;
			}
		}

		$arr_flwing = array();
		if(Auth::check()){
			foreach ($teman_saya as $tmn_sy) {
				$arr_flwing[] = $tmn_sy->username;
			}
		}
		// print_r($arr_flwing);die;
	?>
	<section style="background-color: #f4f2f2;">
		<div style="padding-top:15px; text-align:center; color: #000;">
			<div class="col-lg-1"></div>
			<div class="central-meta col-lg-10" style="text-align: left;">
				@foreach ($profil as $d)
					<h3>{{ $d->nama }} <small class="text-muted" style="font-size: 14px;">{{ '@'.$d->username }}</small></h3>
					<p style="color: black;">{{ $d->bio }}</p>
					<div>
						@if($d->marketplace)
							<a href="{{ $d->marketplace }}" target="_blank" style="color:blue;" data-toggle="tooltip" title="{{$d->jenis_akun == 'desa' ? 'Desastore' : 'Marketplace'}}"><i class="ti-shopping-cart" style="padding: 5px; border: 1px solid; border-radius: 3px;"></i></a>
						@endif
						@if($d->youtube)
							<a href="{{ $d->youtube }}" target="_blank" style="color:blue;" data-toggle="tooltip" title="{{$d->jenis_akun == 'desa' ? 'Desatube' : 'Youtube'}}"><i class="ti-video-camera" style="padding: 5px; border: 1px solid; border-radius: 3px;"></i></a>
						@endif
						@if($d->website)
							<a href="{{ $d->website }}" target="_blank" style="color:blue;" data-toggle="tooltip" title="{{$d->jenis_akun == 'desa' ? 'Wisata' : 'Website'}}"><i class="ti-gallery" style="padding: 5px; border: 1px solid; border-radius: 3px;"></i></a>
						@endif
						@if($d->berita)
							<a href="{{ $d->berita }}" target="_blank" style="color:blue;" data-toggle="tooltip" title="Desanews"><i class="ti-announcement" style="padding: 5px; border: 1px solid; border-radius: 3px;"></i></a>
						@endif
						<!-- @if($d->musrembang)
							<a href="{{ $d->musrembang }}" target="_blank" style="color:blue;"><i class="ti-agenda" style="padding: 5px; border: 1px solid; border-radius: 3px;"></i></a>
						@endif -->
					</div>
				@endforeach
				@if(Auth::check())
					@if ($d->username != auth()->user()->pengguna->username)
						<!-- <br> -->
						<div style="position: absolute; right: 0; top: 0; padding-right: 25px; padding-top: 25px;">
							<a href="#" onclick="cek_chat('{{ url('/data_file/'.$d->username.'/foto_profil/'.$d->foto_profil) }}', '{{ $d->username }}', '{{ auth()->user()->pengguna->id_pengguna }}', '{{ auth()->user()->pengguna->username }}')" class="btn btn-outline-secondary btn-sm" role="button" style="position: relative; border: 1px solid;">Pesan</a>
							@if(!in_array($d->id_pengguna, $array))
								@if(in_array($d->username, $arr_flwing))
									<!-- <a href="" role="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#myModalUnfollow{{$d->username}}" style="position: relative; border: 1px solid;">Following</a> -->
									<a onclick="modalUnfollow('{{ $d->id_pengguna }}', '{{ $d->username }}', '{{ $d->foto_profil }}')" href="#" role="button" class="btn btn-outline-success btn-sm" style="position: relative; border: 1px solid;">Following</a>
								@elseif(in_array($d->username, $arr_flw))
										<a href="/sosial-media/tambah_teman2/{{ $d->username }}" role="button" class="btn btn-success btn-sm" style="position: relative; border: 1px solid #28a745;">Follow Back</a>
								@else
									<a href="/sosial-media/tambah_teman2/{{ $d->username }}" role="button" class="btn btn-success btn-sm" style="position: relative; border: 1px solid #28a745;">Follow</a>
								@endif
								<!-- <div class="modal fade" id="myModalUnfollow{{$d->username}}" role="dialog">
									<div class="modal-dialog modal-sm" style="max-width: 400px;">
										<div class="modal-content">
											<div class="modal-content" style="text-align: center;">
											<ul class="list-group list-group-flush">
												<li class="list-group-item" style="padding-top: 20px;">
													<img src="{{ url('/data_file/foto_profil/'.$d->foto_profil) }}" style="border-radius: 50%; width: 20%; height: 70px;"><br><br>
													<span>Berhenti mengikuti {{'@'.$data->username}}?</span><br>
													<small>{{$d->username}} tidak akan mengetahui bahwa Anda telah berhenti mengikutinya.</small>
												</li>
												<li class="list-group-item"><a onclick="if(!confirm('Anda yakin ingin berhenti mengikuti akun ini?')) return false;" href="/sosial-media/hapus_following/{{$d->username}}" style="font-weight: 600; color: red;"> Berhenti Mengikuti </a></li>
												<li class="list-group-item"><a href="" data-dismiss="modal"> Batalkan </a></li>
											</ul>
										</div>
										</div>
									</div>
								</div> -->
							@else
								<a href="/sosial-media/batal_request/{{ $req->id }}" role="button" class="btn btn-success btn-sm" style="position: relative; border: 1px solid #28a745;">Requested</a>
							@endif
							<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#myModalMore" style="position: relative;"><i class="fa fa-ellipsis-h"></i></button>
						</div>
					@endif
				@endif
			</div>
			<div class="col-lg-1"></div>
			<div class="col-lg-1"></div>
			<div class="central-meta col-lg-10" style="margin-bottom: 0px; border-bottom-right-radius: 0; border-bottom-left-radius: 0; border-bottom: 0px none;">
				<div>
					<?php foreach($pengaturan as $p){
							$pengaturan_akun = $p->akun_privat;
					} ?>
					@foreach ($jml_konten as $data)
						<a data-ripple="" style="padding:15px"><b>{{ $data->jml_konten }}</b> Post</a>
					@endforeach
					@foreach ($jml_followers as $d3)
						@if($pengaturan_akun == 'tidak')
							<a <?php if(Auth::check()) { echo 'href="#" data-toggle="modal" data-target="#myModalFollowers" data-ripple=""'; } ?> style="padding:15px"><b>{{ $d3->jml_followers }}</b> Followers</a>
						@else
							@if(Auth::check())
								@if($p->id_pengguna == auth()->user()->pengguna->id_pengguna)
									<a <?php if(Auth::check()) { echo 'href="#" data-toggle="modal" data-target="#myModalFollowers" data-ripple=""'; } ?> style="padding:15px"><b>{{ $d3->jml_followers }}</b> Followers</a>
								@elseif(in_array($d->username, $arr_flwing))
									<a <?php if(Auth::check()) { echo 'href="#" data-toggle="modal" data-target="#myModalFollowers" data-ripple=""'; } ?> style="padding:15px"><b>{{ $d3->jml_followers }}</b> Followers</a>
								@else
									<a style="padding:15px"><b>{{ $d3->jml_followers }}</b> Followers</a>
								@endif
							@else
								<a style="padding:15px"><b>{{ $d3->jml_followers }}</b> Followers</a>
							@endif
						@endif
					@endforeach
					@foreach ($jml_teman as $d2)
						@if($pengaturan_akun == 'tidak')
							<a  <?php if(Auth::check()) { echo 'href="#" data-toggle="modal" data-target="#myModalFollowing" data-ripple=""'; } ?> style="padding:15px"><b>{{ $d2->jml_following }}</b> Following</a>
						@else
							@if(Auth::check())
								@if($p->id_pengguna == auth()->user()->pengguna->id_pengguna)
									<a  <?php if(Auth::check()) { echo 'href="#" data-toggle="modal" data-target="#myModalFollowing" data-ripple=""'; } ?> style="padding:15px"><b>{{ $d2->jml_following }}</b> Following</a>
								@elseif(in_array($d->username, $arr_flwing))
									<a  <?php if(Auth::check()) { echo 'href="#" data-toggle="modal" data-target="#myModalFollowing" data-ripple=""'; } ?> style="padding:15px"><b>{{ $d2->jml_following }}</b> Following</a>
								@else
									<a style="padding:15px"><b>{{ $d2->jml_following }}</b> Following</a>
								@endif
							@else
								<a style="padding:15px"><b>{{ $d2->jml_following }}</b> Following</a>
							@endif
						@endif
					@endforeach
				</div>
			</div>
			@if($d->marketplace)
			<div class="central-meta col-lg-10" style="padding: 0; border-top-right-radius: 0; border-top-left-radius: 0;">
				<ul class="nav nav-tabs nav-pills nav-fill" style="padding: 5px;">
					<li class="nav-item">
						<a class="active" href="#link1" data-toggle="tab" style="font-size: 15px; font-weight: bold; display: block;">Post</a>
					</li>
					<li class="nav-item">
						<a class="" href="#link2" data-toggle="tab" style="font-size: 15px; font-weight: bold; display: block;">Shop</a>
					</li>
				</ul>
			</div>
			<!-- Tab panes -->
			<div class="tab-content">
			  	<div class="tab-pane active fade show " id="link1" >
			  		@include('theme.postingan')
			  	</div>
			  	<div class="tab-pane fade" id="link2" >
				  	@include('theme.shop')
			  	</div>
			</div>
			@else
				<br>
				<br>
				@include('theme.postingan')
			@endif
		</div>
		<div class="col-lg-4 col-sm-4"></div>
	</section>

	<div class="container">
		<div class="row">
			<div class="pt-3 pb-3">
				<h4>History Video</h4>
			</div>
		</div>
		<div class="row">
			@if ($video_history_view)
				@foreach ($video_history_view as $item)
				<div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
					<a href="{{ route('desatube.show', $item->id_video) }}" class="component-products d-block">
						<div class="video-thumbnail">
							<div class="detail-thumbnail" style="
							@if (!empty($item->video->thumbnail))
									background-image: url('{{ asset($item->video->thumbnail) }}')
							@else
									background-image: #eee
							@endif 
							">
							</div>
						</div>
						<div class="products-text">
							<div class="video-title-scope">
								{{ $item->video->title }}
							</div>
							<div class="identity-scope">
								<span>{{ $item->video->pengguna->nama }}</span>
								@if (!is_null($item->video->detail))
								<span class="channel">{{ number_format($item->video->detail->views) . ' x ditonton' }}</span>
								@endif
								<span>{{ $item->video->created_at->diffForHumans() }}</span>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			@else
			<div class="col-lg" style="padding-bottom:15px;">
				<strong style="font-size: 16px;">Belum Ada Video Dilihat</strong>
			</div>
			@endif
		</div>
	</div>

	@if(Auth::check())
		<div class="modal fade" id="myModalFollowers" role="dialog">
			<div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 500px;">
				<div class="modal-content">
					<div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
						<h6 class="modal-title">Followers</h6>
					</div>
					<ul class="list-group list-group-flush">
						<div class="input-group flex-nowrap" id="cari_teman2">
							<div class="input-group-prepend">
								<span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
									Cari: 
								</span>
							</div>
							<div id="kolom_input_cari2" style="width: 100%;"></div>
						</div>
						<div class="list-group list-group-flush" style="overflow-y: auto; max-height: 315px;" id="teman_yang_dicari2">
							@if ($followers != NULL)
								@foreach ($followers as $data)
									<a class="list-group-item list-group-item-action">
										<div class="media">
											<img src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
											<div class="media-body align-self-center">
												<small onclick="lihatProfil('{{$data->username}}')" target="_blank" style="cursor: pointer; font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data->username }}</small><br>
												<small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data->nama }}</small>
											</div>
											@if(Auth::check())
												@if($d->username != auth()->user()->pengguna->username)
													@if($data->username != auth()->user()->pengguna->username)
														<!--@if($d->username == auth()->user()->pengguna->username)-->
															<!-- <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#hapusFollowers{{$data->username}}" style="position: relative; top:10px; margin-top: 10px;">Remove</button> -->
															<button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusFollowers('{{ $data->id_pengguna }}', '{{ $data->username }}', '{{ $data->foto_profil }}')" style="position: relative; margin-top: 10px;">Remove</button>
														<!--@endif-->
														@if(!in_array($data->id_pengguna, $array))
															@if(in_array($data->username, $arr_flwing))
																<!-- <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#myModalUnfollow2{{$data->username}}" style="position: relative; top:10px;">Following</button> -->
																<button type="button" class="btn btn-outline-success btn-sm" onclick="modalUnfollow('{{ $data->id_pengguna }}', '{{ $data->username }}', '{{ $data->foto_profil }}')" style="position: relative; top:10px;">Following</button>
															@elseif(in_array($data->username, $arr_flw))
																<button type="button" onclick="tambah_teman2('{{ $data->username }}')" class="btn btn-success btn-sm" style="position: relative; margin-left: 5px; margin-top: 10px;">Follow Back</button>
															@else
																<button type="button" onclick="tambah_teman2('{{ $data->username }}')" class="btn btn-success btn-sm" style="position: relative; margin-top: 10px;">Follow</button>
															@endif
														@else
															<button onclick="batal_request('{{ $req->id }}')" type="button" class="btn btn-success btn-sm" style="position: relative; border: 1px solid #28a745; margin-top: 10px;">Requested</button>
														@endif
													@endif
												@else			
													@if(in_array($data->username, $arr_flwing))
														<!-- <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#hapusFollowers{{$data->username}}" style="position: relative; margin-top: 10px;">Remove</button> -->
														<button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusFollowers('{{ $data->id_pengguna }}', '{{ $data->username }}', '{{ $data->foto_profil }}')" style="position: relative; margin-top: 10px;">Remove</button>
													@elseif(in_array($data->username, $arr_flw))
														<!--@if($d->username == auth()->user()->pengguna->username)-->
															<!-- <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#hapusFollowers{{$data->username}}" style="position: relative; margin-top: 10px;">Remove</button> -->
															<button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusFollowers('{{ $data->id_pengguna }}', '{{ $data->username }}', '{{ $data->foto_profil }}')" style="position: relative; margin-top: 10px;">Remove</button>
														<!--@endif-->
														@if(!in_array($data->id_pengguna, $array))
															<button type="button" onclick="tambah_teman2('{{ $data->username }}')" class="btn btn-success btn-sm" style="position: relative; margin-left: 5px; margin-top: 10px;">Follow Back</button>
														@else
															<button onclick="batal_request('{{ $req->id }}')" type="button" class="btn btn-success btn-sm" style="position: relative; border: 1px solid #28a745; margin-top: 10px;">Requested</button>
														@endif
													@else
														<!-- <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#hapusFollowers{{$data->username}}" style="position: relative; margin-top: 10px;">Remove</button> -->
														<button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusFollowers('{{ $data->id_pengguna }}', '{{ $data->username }}', '{{ $data->foto_profil }}')" style="position: relative; margin-top: 10px;">Remove</button>
														@if(!in_array($data->id_pengguna, $array))
															<button type="button" onclick="tambah_teman2('{{ $data->username }}')" class="btn btn-success btn-sm" style="position: relative; margin-top: 10px;">Follow</button>
														@else
															<button onclick="batal_request('{{ $req->id }}')" type="button" class="btn btn-success btn-sm" style="position: relative; border: 1px solid #28a745; margin-top: 10px;">Requested</button>
														@endif
													@endif
												@endif
											@endif
										</div>
									</a>
								@endforeach 
							@else
								<br>
								<p style="text-align: center; color: black;">Tidak Ada Teman</p>
							@endif
						</div>
					</ul>
				</div>
			</div>
		</div>
	@endif
	
	@if(Auth::check())
		<div class="modal fade" id="myModalFollowing" role="dialog">
			<div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 500px;">
				<div class="modal-content">
					<div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
						<h6 class="modal-title">Following</h6>
					</div>
					<ul class="list-group list-group-flush">
							<div class="input-group flex-nowrap" id="cari_teman">
								<div class="input-group-prepend">
									<span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
										Cari: 
									</span>
								</div>
								<div id="kolom_input_cari" style="width: 100%;"></div>
							</div>
							<div class="list-group list-group-flush" style="overflow-y: auto; max-height: 315px;" id="teman_yang_dicari">
							@if ($teman != NULL)
								@foreach ($teman as $data)
									<a class="list-group-item list-group-item-action">
										<div class="media">
											<img src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
											<div class="media-body align-self-center">
												<small onclick="lihatProfil('{{$data->username}}')" style="cursor: pointer;font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data->username }}</small><br>
												<small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data->nama }}</small>
											</div>
											@if($d->username == auth()->user()->pengguna->username)
												@if($data->username != auth()->user()->pengguna->username)
													<!-- <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#myModalUnfollow2{{$data->username}}" style="position: relative; top:10px;">Following</button> -->
													<button type="button" class="btn btn-outline-success btn-sm" onclick="modalUnfollow('{{ $data->id_pengguna }}', '{{ $data->username }}', '{{ $data->foto_profil }}')" style="position: relative; top:10px;">Following</button>
												@endif
											@else
												@if($data->username != auth()->user()->pengguna->username)
												@if(!in_array($data->id_pengguna, $array))
													@if(in_array($data->username, $arr_flwing))
														<!-- <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#myModalUnfollow2{{$data->username}}" style="position: relative; top:10px;">Following</button> -->
														<button type="button" class="btn btn-outline-success btn-sm" onclick="modalUnfollow('{{ $data->id_pengguna }}', '{{ $data->username }}', '{{ $data->foto_profil }}')" style="position: relative; top:10px;">Following</button>
													@elseif(!in_array($data->username, $arr_flwing) AND in_array($data->username, $arr_flw))
    													<button type="button" onclick="tambah_teman2('{{ $data->username }}')" class="btn btn-success btn-sm" style="position: relative; margin-top: 10px; margin-left: 5px;">Follow Back</button>
													@else
														<button type="button" onclick="tambah_teman2('{{ $data->username }}')" class="btn btn-success btn-sm" style="position: relative; margin-top: 10px;">Follow</button>
													@endif
												@else
													<button onclick="batal_request('{{ $req->id }}')" type="button" class="btn btn-success btn-sm" style="position: relative; border: 1px solid #28a745; margin-top: 10px;">Requested</button>
												@endif
												@endif
											@endif
										</div>
									</a>
								@endforeach 
							@else
								<br>
								<p style="text-align: center; color: black;">Tidak Ada Teman</p>
							@endif
							</div>
					</ul>
				</div>
			</div>
		</div>
	@endif

</div>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="{{ asset('js/read-less-more.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slideshow.js') }}"></script>
<script src="{{ asset('js/profil.js') }}"></script>
<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // $('#notif').click(function() {
    // 	$.ajax({
    //         url:"{{route('sosial-media.update_notif')}}",
    //         type: 'post',
    //         // dataType: "json",
    //         data: {
    //            _token: CSRF_TOKEN
    //         },
    //         success: function( data ) {
    //            	if(document.getElementById("jml_notif")){
    //            		document.getElementById("jml_notif").style.visibility = "hidden";
    //            	}
    //         }
    //     });
    // });
</script>
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.min.js') }}"></script>
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#search" ).autocomplete({
      	appendTo: "#container_search",
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('sosial-media.cari_pengguna')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           let username = ui.item.value;
           window.location.href = window.location.origin+"/sosial-media/profil/"+username;
           return false;
        }
      })
      .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	      return $( "<li>" )
	        .append( "<div class='media'><img src='"+item.icon+"' class='align-self-center mr-3' alt='...' style='width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;'> <div class='media-body align-self-center'> <small style='font-weight: 700; color: black; margin-bottom: 0rem;'>"+item.value+"</small><br><small class='mt-0' style='margin-bottom: 0rem; font-weight: 500; color: #989e99;'>"+item.label+"</small>")
	        .appendTo( ul );
	  };

    });
</script>

</body>	

</html>
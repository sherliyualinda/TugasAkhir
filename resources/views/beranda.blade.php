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
	    
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slideshow.css') }}">
	<link rel="stylesheet" href="{{ asset('css/read-less-more.css') }}">
	<link rel="stylesheet" href="{{ asset('css/halaman-beranda.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/> -->

</head>
<body id="bodies" style="overflow-y: auto;">
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		@include('theme.nav_bar')
	</nav>
		
	<section>
		<div class="gap grey-bg" style="padding-top: 100px;">
			<div class="container-fluid">
				@if (Session::get('success'))
					<div class="alert alert-success">
						{{ Session::get('success') }}
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
				@endif
				@php
				    $url = "https://marketpalcedesaku.masuk.web.id/api/productterlaris";
				    $headers = @get_headers($url);
				@endphp
				@if($headers && strpos( $headers[0], '200'))
				<div class="row" style="padding-bottom: 10px; height: 250px;">
					<div class="col" style="height: 250px; padding-bottom: 10px;">
						@include('theme.produk_terlaris')
					</div>
					<div class="col" style="height: 250px; padding-bottom: 10px;">
						@include('theme.wisata')
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="widget static-widget" style="margin-bottom: 10px;">
										<h4 class="widget-title" style="margin-bottom: 0; padding: 10px 20px;">Posting 
											<i class="ti-pencil-alt" onclick="newpost()" id="new-post" style="float: right; cursor: pointer;"></i>
										</h4>
									</div>
									<div class="widget static-widget">
										<h4 class="widget-title">Rekomendasi Desa</h4>
										<ul class="followers">
										@if ($rekomendasi != NULL)
	                                        @foreach ($rekomendasi as $rek)
												<li>
													<figure><img src="{{ $rek->foto_profil != null ? url('/data_file/'.$rek->username.'/foto_profil/'.$rek->foto_profil) : asset('user.jpg') }}" alt="" style="width: 45px; height: 45px; object-fit: cover;"></figure>
													<div class="friend-meta">
														<h4><a href="/sosial-media/profil/{{ $rek->username }}" title="">{{ $rek->nama }}</a></h4>
														<a href="/sosial-media/tambah_teman/{{ $rek->username }}" title="" class="underline">Follow</a>
													</div>
												</li>
	                                        @endforeach
	                                    @else
											<li>
												<div align="center">Tidak Ada Rekomendasi Desa</div>
											</li>
										@endif
										</ul>
									</div><!-- who's following -->
									<div class="widget static-widget">
										<h4 class="widget-title">Rekomendasi Teman</h4>
										<ul class="followers">
										@if ($rekomendasi_teman != NULL)
	                                        @foreach ($rekomendasi_teman as $rek_tmn)
												<li>
													<figure><img src="{{ $rek_tmn->foto_profil != null ? url('/data_file/'.$rek_tmn->username.'/foto_profil/'.$rek_tmn->foto_profil) : asset('user.jpg') }}" alt="" style="width: 45px; height: 45px; object-fit: cover;"></figure>
													<div class="friend-meta">
														<h4><a href="/sosial-media/profil/{{ $rek_tmn->username }}" title="">{{ $rek_tmn->nama }}</a></h4>
														<a href="/sosial-media/tambah_teman/{{ $rek_tmn->username }}" title="" class="underline">Tambah Teman</a>
													</div>
												</li>
	                                        @endforeach
	                                    @else
											<li>
												<div align="center">Tidak Ada Rekomendasi Teman</div>
											</li>
										@endif
										</ul>
									</div>
									<div class="widget static-widget">
										<h4 class="widget-title">Group</h4>
										<div id="searchDir2"></div>
										<ul id="people-list2" class="friendz-list" style="max-height: 200px;">
											@if($list_all_group)
		                                        @foreach ($list_all_group as $grup)
													<li>
														<figure>
															<img src="{{ url('/data_file/group/'.$grup->nama_group.'/foto_sampul/'.$grup->foto_sampul_group) }}" alt="" style="width: 45px; height: 45px; object-fit: cover;">
														</figure>
														<div class="friend-meta">
															<h4><a href="/sosial-media/halaman_group_detail/{{ $grup->id_group }}" title="">{{ $grup->nama_group }}</a></h4>
														</div>
													</li>
		                                        @endforeach
		                                    @else
		                                    	<li>
													<div align="center">Tidak Ada Group Terdaftar</div>
												</li>
		                                    @endif
										</ul>
									</div>
									<div class="widget friend-list stick-widget">
										<h4 class="widget-title">Infrastruktur Desa</h4>
										<ul class="friendz-list" id="widget_infra">
										    @include('theme.widget_infra')
										</ul>
									</div>
								</aside>
							</div><!-- sidebar -->
							<br>
							<div class="col-lg-6">
								<div class="central-meta" id="postbox">
									<div class="new-postbox">
										<figure>
											<img src="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" style="width: 60px; height: 60px;">
										</figure>
										<div class="newpst-input">
											<form method="post" action="/sosial-media/post" enctype="multipart/form-data">
											{{ csrf_field() }}
												<div class="form-group">
													<input type="text" name="tempat" id="tempat" style="border:1px solid #eeeeee; background-color: white; padding: 10px;" placeholder="Pilih Lokasi" required/>
													<input type="hidden" id="long" name="longitude_tempat">
													<input type="hidden" id="lat" name="latitude_tempat">
												</div>
												<textarea rows="3" name="caption" onkeyup="countChars(this);" placeholder="write something" id="caption_post" maxlength="500" required></textarea>
												<div class="attachments">
													<ul>
														<li><small id="charNum" style="margin:0;">500/500</small></li>
														<li>
															<i class="fa fa-image"></i>
															<label class="fileContainer">
																<input type="file" name="file_foto[]" id="pro-image" accept="video/*,image/*" required multiple> <!-- id="pro-image" -->
															</label>
														</li>
														<li>
															<button type="submit">Post</button>
														</li>
													</ul>
												</div>
											</form>
											<!-- <span id="error-message-capt" class="validation-error-label"></span> -->
											<small id="error-message" class="validation-error-label"></small>
											<div class="preview-images-zone">
											</div>
										</div>
									</div>
								</div><!-- add post new box -->
								<div id="map"></div>
								<!-- include ke beranda before / two page -->
								@include('theme.two_page')
							</div><!-- centerl meta -->
							<div class="col-lg-3">
								<aside class="sidebar static">
									@if(auth()->user()->pengguna->jenis_akun == 'desa')
									<div class="widget">
										<h4 class="widget-title">Your page</h4>	
										<div class="your-page">
											<figure>
												<img src="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" style="width: 50px; height: 50px;">
											</figure>
											<div class="page-meta">
												<a href="/sosial-media/profil/{{auth()->user()->pengguna->username}}" title="" class="underline">My page</a>
												<span>
													<i class="ti-user" style="vertical-align: unset"></i>
													@foreach($jml_konten as $jml)
														<a href="insight.html" title="">Post <em>{{$jml->jml_konten}}</em></a>
													@endforeach
												</span>
												<!-- <span><i class="ti-user"></i><a href="insight.html" title="">Following <em>2</em></a></span> -->
											</div>
											<div class="page-likes">
												<ul class="nav nav-tabs likes-btn">
													<li class="nav-item"><a class="active" href="#link1" data-toggle="tab">likes</a></li>
													 <li class="nav-item"><a class="" href="#link2" data-toggle="tab">Followers</a></li>
												</ul>
												<!-- Tab panes -->
												<div class="tab-content">
												  	<div class="tab-pane active fade show " id="link1" >
												  		@foreach ($data_likes_total as $dt_likes)
															<span><i class="ti-heart"></i>{{ number_format($dt_likes->jml_likes) }}</span>
														@endforeach
														@foreach($data_likes_week as $dt_likes_week)
														  	@if($dt_likes_week->jml_likes !== 0)
														  		<a href="#" title="weekly-likes">{{ number_format($dt_likes_week->jml_likes) }} like baru minggu ini</a>
														  	@endif
														@endforeach
												  	</div>
												  	<div class="tab-pane fade" id="link2" >
													  	@foreach ($data_followers_total as $dt_followers)
														  	<span><i class="ti-user"></i>{{ number_format($dt_followers->jml) }}</span>
													  	@endforeach
													  	@foreach($data_followers_week as $dt_followers_week)
														  	@if($dt_followers_week->jml !== 0)
														  		<a href="#" title="weekly-likes">{{ number_format($dt_followers_week->jml)}} Followers Baru Minggu Ini</a>
														  	@endif
														@endforeach
												  	</div>
												</div>
											</div>
										</div>
									</div><!-- page like widget -->
									@endif
									<!-- <div class="widget friend-list stick-widget"> -->
									<div class="widget friend-list">
										<h4 class="widget-title">Berita Desa Terbaru</h4>
										<ul class="friendz-list" id="widget_berita">
										    @include('theme.widget_berita')
										</ul>
									</div>
									<div class="widget friend-list stick-widget">
										<h4 class="widget-title">Video Desa Terbaru</h4>
										<ul class="friendz-list" id="widget_video">
										    @include('theme.widget_video')
										</ul>
									</div>
								</aside>
							</div><!-- sidebar -->
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

</div>		
<div class="modal fade" id="modalReport" role="dialog">
    <div class="modal-dialog modal-sm" style="max-width: 600px;">
        <form method="post" action="/sosial-media/report_proses" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report <span class="kategori_report"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Alasan Pelaporan <span class="kategori_report"></span></label>
                        <select class="form-control" id="alasan_report" name="alasan_report">
                            <option selected disabled>Pilih Alasan</option>
                            <option value="Spam">Spam</option>
                            <option value="Ujaran / Simbol Kebencian">Ujaran / Simbol Kebencian</option>
                            <option value="Ketelanjangan / Aktivitas Seksual">Ketelanjangan / Aktivitas Seksual</option>
                            <option value="Kekerasan / Organisasi Berbahaya">Kekerasan / Organisasi Berbahaya</option>
                            <option value="Penipuan">Penipuan</option>
                            <option value="Informasi Palsu">Informasi Palsu</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="kategori" name="kategori_report" value=""/>
                    <input type="hidden" name="acct_reporter" value="{{ Auth::user()->pengguna->id_pengguna }}"/>
                    <input type="hidden" id="reported" name="id_reported" value=""/>
                    <input class="btn btn-sm btn-submit" type="submit" style="background-color: red; color: white;" value="Report"></input>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="{{ asset('js/read-less-more.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script> -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slideshow.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-iHgzDAzd_uS3biSkqVRw_sxAoqS1o04&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/halaman-beranda.js') }}"></script>
<script>
// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
// $('#notif').click(function () {
//     $.ajax({
//         url: "{{route('sosial-media.update_notif')}}",
//         type: 'post',
//         // dataType: "json",
//         data: {
//             _token: CSRF_TOKEN
//         },
//         success: function (data) {
//             if (document.getElementById("jml_notif")) {
//                 document.getElementById("jml_notif").style.visibility = "hidden";
//             }
//         }
//     });
// });

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    $("#search").autocomplete({
		appendTo: "#container_search",
		source: function (request, response) {
			// Fetch data
			$.ajax({
				url: "{{route('sosial-media.cari_pengguna')}}",
				type: 'post',
				dataType: "json",
				data: {
					_token: CSRF_TOKEN,
					search: request.term
				},
				success: function (data) {
					response(data);
				}
			});
		},
		select: function (event, ui) {
			let username = ui.item.value;
			window.location.href = window.location.origin + "/sosial-media/profil/" + username;
			return false;
		}
	})
	.data("ui-autocomplete")._renderItem = function (ul, item) {
		return $("<li>")
			.append("<div class='media'><img src='" + item.icon + "' class='align-self-center mr-3' alt='...' style='width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;'> <div class='media-body align-self-center'> <small style='font-weight: 700; color: black; margin-bottom: 0rem;'>" + item.value + "</small><br><small class='mt-0' style='margin-bottom: 0rem; font-weight: 500; color: #989e99;'>" + item.label + "</small>")
			.appendTo(ul);
	};
});

function refresh_berita(){
    $('#widget_berita').load('widget_berita.blade.php');
}

function refresh_infra(){
    $('#widget_infra').load('widget_infra.blade.php');
}

function refresh_video(){
    $('#widget_video').load('widget_video.blade.php');
}
</script>
</body>	

</html>
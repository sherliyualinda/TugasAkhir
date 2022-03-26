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
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('jquery-ui-1.12.1.custom/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/slideshow.css') }}">
	<link rel="stylesheet" href="{{ asset('css/read-less-more.css') }}">
	<link rel="stylesheet" href="{{ asset('css/konten-detail.css') }}">

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/> -->

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		@include('theme.nav_bar')
	</nav>
		
	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
			@if (Session::get('success'))
			    <div class="alert alert-success">
			        {{ Session::get('success') }}
			        <button type="button" class="close" data-dismiss="alert">&times;</button>
			    </div>
			@endif
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="widget static-widget">
										<h4 class="widget-title">Rekomendasi Desa</h4>
										<ul class="followers">
										@if(Auth::check())
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
										@else
											<li>
												<div align="center"><a href="/sosial-media" class="underline" style="color: green; font-weight: bold;">Login</a> untuk melihat rekomendasi</div>
											</li>
										@endif
										</ul>
									</div><!-- who's following -->
									<div class="widget static-widget">
										<h4 class="widget-title">Rekomendasi Teman</h4>
										<ul class="followers">
										@if(Auth::check())
											@if ($rekomendasi_teman != NULL)
												@foreach ($rekomendasi_teman as $rek_tmn)
													<li>
														<figure><img src="{{ $rek_tmn->foto_profil != null ? url('/data_file/'.$rek_tmn->username.'/foto_profil/'.$rek_tmn->foto_profil) : asset('user.jpg') }}" alt="" style="width: 45px; height: 45px; object-fit: cover;"></figure>
														<div class="friend-meta">
															<h4><a href="/sosial-media/profil/{{ $rek_tmn->username }}" title="">{{ $rek_tmn->nama }}</a></h4>
															<a href="/sosial-media/tambah_teman2/{{ $rek_tmn->username }}" title="" class="underline">Tambah Teman</a>
														</div>
													</li>
												@endforeach
											@else
												<li>
													<div align="center">Tidak Ada Rekomendasi Teman</div>
												</li>
											@endif
										@else
											<li>
												<div align="center"><a href="/sosial-media" class="underline" style="color: green; font-weight: bold;">Login</a> untuk melihat rekomendasi</div>
											</li>
										@endif
										</ul>
									</div>
									<div class="widget static-widget">
										<h4 class="widget-title">Group</h4>
										<div id="searchDir2"></div>
										<ul id="people-list2" class="friendz-list" style="max-height: 200px;">
										@if(Auth::check())
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
										@else
											<li>
												<div align="center"><a href="/sosial-media" class="underline" style="color: green; font-weight: bold;">Login</a> untuk melihat daftar group</div>
											</li>
										@endif
										</ul>
									</div><!-- who's following -->
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
								<div>
									@if (isset($konten))
										@foreach ($konten as $data)
										<div class="central-meta item">
											<div class="user-post">
												<div class="friend-info">
													<figure>
														<img src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}" alt="" style="width: 45px; height: 45px;">
													</figure>
													<div class="friend-name">
														<ins>
															<a href="/sosial-media/profil/{{$data->username}}" title="">
																{{ $data->username }}
															</a>
														</ins>
														<span style="color: black;"><a href="/sosial-media/explore/{{$data->tempat}}">{{ $data->tempat }}</a></span>
														<div class="d-flex justify-content-end">
														@if(Auth::check())
														<?php $tgl = date_format(date_create($data->created_at), "d-m-Y"); ?>
															@if(($data->username) != auth()->user()->pengguna->username)
																<a onclick="modalMore('{{ $data->id_konten }}', '{{ $data->username }}', '{{ $data->slug }}', '{{ $data->foto_profil }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-v"></i></a>
															@else
																<a onclick="modalMore2('{{ $data->id_konten }}', '{{ $data->foto_profil }}', '{{ $data->username }}', '{{ $data->tempat }}', '{{ $data->foto_video_konten }}', '{{ str_replace('"', "&quot;", str_replace("'", "\'", $data->caption)) }}', '{{ $tgl }}', '{{ $data->slug }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-v"></i></a>
															@endif
														@endif
														</div>
													</div>
													<div class="post-meta">
														<div class="align-self-center single-item">
														<?php $media = explode(", ", $data->foto_video_konten); ?>
														<?php $tgl = date_format(date_create($data->created_at),"d-m-Y"); ?>
														@foreach ($media as $media_konten)
															@if (strpos($media_konten, '.mp4'))
																<video width="100%" height="100%" autoplay loop muted>
																  	<source src="{{ url('/data_file/'.$data->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" type="video/mp4">
																  	<source src="{{ url('/data_file/'.$data->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" type="video/ogg">
																  	Your browser does not support the video tag.
																</video>
															@else
																<img src="{{ url('/data_file/'.$data->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" alt="">
															@endif
														@endforeach
														</div>
														<div class="we-video-info" style="padding-top: 0; padding-bottom: 0;">
															<ul style="max-height: 30px;">
																@if(Auth::check())
																<li data-id="{{$data->id_konten}}" data-is-like="{{$data->is_like ? 1 : 0}}" class="action-like-or-dislike" style="margin-right: 5px;height: 23px;">
																	<span class="like" data-toggle="tooltip" title="{{$data->is_like ? 'Batal Menyukai' : 'Menyukai'}}">
																		<div class="menu" style="width: 23px; height: 23px;">
																			<div class="btn trigger" style="background: none;">
																				<i id="icon_like{{$data->id_konten}}" class="{{$data->is_like ? 'fa fa-heart' : 'fa fa-heart-o'}}" style="font-size: 20px;color: black;"></i>
																			</div>
																		</div>
																	</span>
																</li>
																<li class="social-media" style="margin-right: 5px; height: 23px; position: absolute;">
																	<span class="like">
																		<div class="menu" style="width: 23px; height: 23px;">
																			<div class="btn trigger" style="background: none;">
																				<i class="fa fa-share-alt" style="color: black; font-size: 20px;"></i>
																			</div>
																			<?php

																				$url = url("/sosial-media/p/".$data->slug);
																				$media = explode(", ", $data->foto_video_konten); $i=1;
																				foreach ($media as $media_konten){
																					$img = urlencode(url('/data_file/'.$media_konten));
																					if($loop->iteration == 1){
																						break;
																					}
																				}
																				$title = $data->username;
																				$summary = $data->caption;

																				// $url=urlencode("http://www.fbchandra.com/developers/share-page-on-facebook");

																				// $img=urlencode("http://www.fbchandra.com/media/developers/share-page.jpg");

																				// $title=urlencode("Share your link on facebook");

																				// $summary="Share your link on facebook using sharer.php. You can choose your custom title, image and summary to share content on facebook timeline.";

																			?>
																			<div class="rotater">
																				<div class="btn btn-icon"><a href="https://www.facebook.com/sharer/sharer.php?u={{$url}}&display=popup" target="_blank" title=""><i class="fa fa-facebook"></i></a></div>
																			</div>
																			<!-- <div class="rotater">
																				<div class="btn btn-icon"><a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $url ?>&p[images][0]=<?php echo $img ?>&p[title]=<?php echo $title ?>&p[summary]=<?php echo $summary ?>" target="_blank" title=""><i class="fa fa-facebook"></i></a></div>
																			</div> -->
																			<div class="rotater">
																				<div class="btn btn-icon"><a href="https://twitter.com/intent/tweet?url={{$url}}" target="_blank" title=""><i class="fa fa-twitter"></i></a></div>
																			</div>
																			<div class="rotater">
																				<div class="btn btn-icon"><a href="whatsapp://send?text={{$url}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title=""><i class="fa fa-whatsapp"></i></a>
																				</div>
																			</div>
																		</div>
																	</span>
																</li>
																@endif
															</ul>
														</div>
														@if(Auth::check())
															@if($likes)
																@foreach ($likes as $like)
																	@if($like->id_konten == $data->id_konten)
																		<p style="margin-bottom: 0px;">Disukai oleh <a href="/sosial-media/profil/{{$like->username}}"><b>{{$like->username}}</b></a> dan<span style="cursor: pointer" data-toggle="modal" data-target="#modalLike{{$data->id_konten}}"> <b>lainnya</b></span></p>
																		@if(COUNT((array)$like->username) == 1)
																		@break
																		@endif
																	@endif
																@endforeach
															@endif
														@endif
														<div class="description" style="margin-top: 0;">
															<p style="margin-bottom: 0px;"> 
																<strong>{{ $data->username }}</strong> <span class="addReadMore showlesscontent"> {{ $data->caption }} </span>
															</p>
															<span style="color: #999; float: left;font-size: 12px;text-transform: capitalize;width: 100%;">
																<?php echo date_format(date_create($data->created_at), "d M Y H:i A"); ?>
															</span>
														</div>
													</div>
												</div>
												<div class="modal fade" id="modalLike{{$data->id_konten}}" role="dialog">
												    <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
												      	<div class="modal-content">
													        <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
													          	<h6 class="modal-title">Menyukai</h6>
													        </div>
												        	<ul class="friendz-list list-group list-group-flush" style="overflow-y: auto!important; max-height: 250px;">
													        	@if ($likes_all != NULL)
																	@foreach ($likes_all as $data2)
																		@if($data2->id_konten == $data->id_konten)
																			<div class="list-group list-group-flush" style="max-height: 315px;">
																	        	<a href="#" class="list-group-item list-group-item-action" data-dismiss="modal" style="padding-left: 10px; padding-right: 10px;">
																	        		<div class="media">
																						<img src="{{ $data2->foto_profil != null ? url('/data_file/'.$data2->username.'/foto_profil/'.$data2->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
																					  	<div class="media-body align-self-center">
																					  		<small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data2->username}}</small><br>
																					    	<small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data2->nama }}</small>
																					  	</div>
																					</div>
																	        	</a>
																	        </div>
																	    @endif
													        		@endforeach
																@endif
												        	</ul>
												      	</div>
												    </div>
												</div>
												<div class="coment-area">
													<ul class="we-comet list-cmt{{$data->id_konten}}" style="overflow-y: auto; max-height: 200px;">
														@foreach ($komentar as $dataa)
															@if(isset($dataa->isi_komentar))
																@if(($data->id_konten == $dataa->id_konten) && $dataa->id_balas_komen == 0)
																	<li id="comment_{{$dataa->id_cmt}}" class="list-rep_cmt_{{$dataa->id_cmt}}">
																		<div id="li-cmt-{{$dataa->id_cmt}}">
																			<div class="comet-avatar">
																				<img src="{{ $dataa->foto_profil != null ? url('/data_file/'.$dataa->username.'/foto_profil/'.$dataa->foto_profil) : asset('user.jpg') }}" alt="" style="height: 45px; width: 45px;">
																			</div>
																			<div class="we-comment">
																				<div class="coment-head">
																					<h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$dataa->username}}" title="">{{ $dataa->username }}</a></h5>
																					<span>{{ date_format(date_create($dataa->tanggal_komen), "d M Y H:i A") }}</span>
																					<!-- <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a> -->
																					{{-- <a onclick="moreOnComment('{{ $dataa->id }}', '{{Auth::user()->pengguna->username}}', '{{$dataa->username}}', '{{$data->username}}')" style="cursor: pointer"><i class="fa fa-ellipsis-h"></i></a> --}}
																					@if(Auth::check())
																					@if((Auth::user()->pengguna->username == $dataa->username) OR (Auth::user()->pengguna->username == $data->username))
																					<a onclick="modalHapusKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer"><i class="ti-trash hide" style="color: red;"></i></a>
																					@endif
																					@if(Auth::user()->pengguna->username != $dataa->username)
																					<a onclick="modalReportKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer"><i class="ti-info-alt hide" style="color: red;"></i></a>
																					@endif
																					<button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" onclick="balas_komen('{{ '@'.$dataa->username }}', '{{$dataa->id_cmt}}', '{{$dataa->username}}', '{{$data->id_konten}}')" value="{{$dataa->id_cmt}}">Balas</button>
																					@endif
																				</div>
																				<p style="margin-top: 0px;">{{ $dataa->isi_komentar }}</p>
																			</div>
																		</div>
																		<?php $id_cmt_parent = $dataa->id_cmt; ?>
																		@foreach ($balas_komentar as $balas_komen)
																		@if($balas_komen->id_balas_komen != 0)
																		@if($dataa->id_cmt == $balas_komen->id_balas_komen)
																		<div id="li-cmt-{{$balas_komen->id_cmt}}">
																			<ul id="comment_{{$balas_komen->id_cmt}}">
																				<li>
																					<div class="comet-avatar">
																						<img src="{{ $balas_komen->foto_profil != null ? url('/data_file/'.$balas_komen->username.'/foto_profil/'.$balas_komen->foto_profil) : asset('user.jpg') }}" alt="" style="height: 35px; width: 35px;">
																					</div>
																					<div class="we-comment">
																						<div class="coment-head">
																							<h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$balas_komen->username}}" title="">{{ $balas_komen->username }}</a></h5>
																							<span>{{ date_format(date_create($balas_komen->tanggal_komen), "d M Y H:i A") }}</span>
																							{{-- <a onclick="moreOnComment('{{ $balas_komen->id }}', '{{Auth::user()->pengguna->username}}', '{{$balas_komen->username}}', '{{$data->username}}')" style="cursor: pointer"><i class="fa fa-ellipsis-h"></i></a> --}}
																							@if(Auth::check())
																							@if((Auth::user()->pengguna->username == $balas_komen->username) OR (Auth::user()->pengguna->username == $data->username))
																							<a onclick="modalHapusKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer"><i class="ti-trash hide" style="color:red;"></i></a>
																							@endif
																							@if(Auth::user()->pengguna->username != $balas_komen->username)
																							<a onclick="modalReportKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer"><i class="ti-info-alt hide" style="color: red;"></i></a>
																							@endif
																							<button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" onclick="balas_komen('{{ '@'.$balas_komen->username }}', '{{$id_cmt_parent}}', '{{$balas_komen->username}}','{{$data->id_konten}}')" value="{{$balas_komen->id_cmt}}">Balas</button>
																							@endif
																						</div>
																						<p style="margin-top: 0px;"><?php echo  html_entity_decode($balas_komen->isi_komentar) ?></p>
																					</div>
																				</li>
																			</ul>
																		</div>
																		@endif
																		@endif
																		@endforeach
																	</li>
																	
																	<!-- <li>
																		<a href="#" title="" class="showmore underline">more comments</a>
																	</li> -->
																@endif
															@endif
														@endforeach
													</ul>
													<ul class="we-comet">
														<li class="post-comment">
															@if(Auth::check())
																<div class="comet-avatar">
																	<img src="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" alt="" style="width: 35px; height: 35px;">
																</div>
																<div class="post-comt-box2"> <!-- post-comt-box -->
																	<form method="post" action="/sosial-media/post_komen" enctype="multipart/form-data">
																	{{ csrf_field() }}
																		<input type="hidden" name="id_konten" value="{{$data->id_konten}}" class="konten_{{$data->id_konten}}">
																		<span class="thumb-xs{{$data->id_konten}}">
																			<textarea placeholder="Post your comment" name="isi_komentar" style="width: 100%;" class="txt_comment_{{$data->id_konten}}" onkeyup="showBtn(this, '{{$data->id_konten}}');"></textarea>
																		</span>
																		{{-- <button type="submit" class="btn btn-submit" style="border-radius: 3px;">Post</button> --}}
																		<button type="button" onclick="uploadKomen('{{$data->id_konten}}')" class="btn btn-submit btn-{{$data->id_konten}}" style="border-radius: 3px; display: none;">Post</button>
																	</form>	
																</div>
															@else
																<a href="/sosial-media" class="underline" style="color: green; font-weight: bold;">Login</a> untuk membuat komentar.
															@endif
														</li>
													</ul>
												</div>
											</div>
										</div>
										@endforeach
									@endif
								</div>
							</div><!-- centerl meta -->
							<div class="col-lg-3">
								<aside class="sidebar static">
									@if(Auth::check())
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
									@endif
									<!-- <div class="widget friend-list stick-widget"> -->
									<div class="widget friend-list">
										<h4 class="widget-title">Berita Terbaru</h4>
										<ul class="friendz-list" id="widget_berita">
										    @include('theme.widget_berita')
										</ul>
									</div>
									<div class="widget friend-list stick-widget">
										<h4 class="widget-title">Video Terbaru</h4>
										<ul class="friendz-list" id="widget_video">
										    @include('theme.widget_video')
										</ul>
									</div><!-- friends list sidebar -->
								</aside>
							</div><!-- sidebar -->
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

</div>

<div class="modal fade" id="myModalEdit" role="dialog">
    <div class="modal-dialog" style="max-width: 600px;">
        <form method="post" action="/sosial-media/edit_konten_proses" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Konten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closebtn" value="">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <div class="friend-info" style="text-align: left; margin-bottom: 15px;">
                        <figure style="width: 10%;">
                            <img id="foto_post" src="" alt="" style="width: 45px; height: 45px; border-radius: 50%;">
                        </figure>
                        <div class="friend-name" style="width:85%; padding-left: 0px;">
                            <ins>
                                <a id="uname" href="" title=""></a>
                            </ins>
                            <span id="tmpt" style="color: black;"></span>
                        </div>
                    </div>
                    <div class="wrap-modal-slider">
                        <div class="slideshow-container editSlide">
                            <div id="media_post"></div>
                            <a class="prev" onclick="" id="prevClick">&#10094;</a>
                            <a class="next" onclick="" id="nextClick">&#10095;</a>
                        </div>
                    </div>
					<div class="newpst-input" style="margin-top: 15px;">
						<input type="hidden" name="id_konten" id="hidden_id" value=""></input>
						<textarea rows="3" name="caption" id="capt" style="border: 1px solid #eeeeee; border-radius: 0; border-bottom: 0;" onkeyup="countCharsEdit(this);" maxlenght="500"></textarea>
						<div class="attachments">
                            <ul>
                                <li><small id="charNumEdit" style="margin:0;"></small></li>
                            </ul>
                        </div>
					</div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Update"></input>
                </div>
            </div>
        </form>
    </div>
</div>

@if(Auth::check())
<div class="modal fade" id="modalShare" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                <h6 class="modal-title">Bagikan</h6>
            </div>
            <div class="input-group flex-nowrap searchKey" id="cari_teman_2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
                        Ke: 
                    </span>
                </div>
                <div id="kolom_input_cari_2" class="kolom_cari" style="width: 100%;"></div>
            </div>
            <form method="post" action="/sosial-media/share_post" enctype="multipart/form-data">
            {{csrf_field()}}
                <ul class="friendz-list list-group list-group-flush findFr" style="margin-top: 0px; overflow-y: auto!important; max-height: 250px;" id="teman_yang_dicari_2">
                    @if ($teman != NULL) 
                        @foreach ($teman as $data2)
                        <div class="list-group list-group-flush" style="max-height: 315px;">
                            <a class="list-group-item list-group-item-action" style="padding-right: 10px; padding-left: 10px;">
                                <div class="input-group mb-3" style="margin-bottom: 0px!important;">
                                    <div class="media">
                                        <img src="{{ $data2->foto_profil != null ? url('/data_file/'.$data2->username.'/foto_profil/'.$data2->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
                                        <div class="media-body align-self-center">
                                            <small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data2->username }}</small><br>
                                            <small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data2->nama }}</small>
                                        </div>
                                    </div>
                                    <div class="input-group-append" style="position: absolute;right: 0;top: 35%;">
                                        <input type="checkbox" name="pilih_teman[]" value="{{$data2->id_pengguna}}" aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach 
                    @else
                        <li>
                            <div align="center">Tidak ada teman</div>
                        </li>
                    @endif
                </ul>
                <input type="hidden" name="id_konten" id="hidden_id_share" value=""></input>
                <div class="modal-footer" style="padding: 8px;">
                    <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Submit"></input> 
                </div>
            </form>
        </div>
    </div>
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
@endif
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slideshow.js') }}"></script>
<script src="{{ asset('js/read-less-more.js') }}"></script>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/konten-detail.js') }}"></script>

<!-- Script --><!-- 
<script src="{{asset('js/jquery-2.1.4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('jquery-ui-1.12.1.custom/jquery-ui.min.js')}}" type="text/javascript"></script> -->
<script type="text/javascript">
    function refresh_berita(){
        $('#widget_berita').load('widget_berita.blade.php');
    }
    
    function refresh_infra(){
        $('#widget_infra').load('widget_infra.blade.php');
    }
    
    function refresh_video(){
        $('#widget_video').load('widget_video.blade.php');
    }
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

	// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	// $('#notif').click(function () {
	// 	$.ajax({
	// 		url: "{{route('sosial-media.update_notif')}}",
	// 		type: 'post',
	// 		// dataType: "json",
	// 		data: {
	// 			_token: CSRF_TOKEN
	// 		},
	// 		success: function (data) {
	// 			if (document.getElementById("jml_notif")) {
	// 				document.getElementById("jml_notif").style.visibility = "hidden";
	// 			}
	// 		}
	// 	});
	// });
</script>
</body>	

</html>
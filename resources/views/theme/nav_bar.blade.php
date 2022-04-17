<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-info text-white">
	<div class="logo col-lg-2">
		<a title="" href="{{ asset('/sosial-media/beranda') }}">
			<img src="/Diessnie-logo.jpeg" alt="" style="max-height: 50px;">
		</a>
	</div>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto col-lg-2">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle menu-text" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
				Produk Desaku
				</a>
				<div class="dropdown-menu box-size" aria-labelledby="navbarDropdown" style="width: 850px!important;">
					<div class="row" style="margin-right: 0; margin-left: 0;">
						
						<div class="col desa-col">
						    @if(Auth::check())
							<a href="{{ url('/lahan') }}" class="dropdown-item">
							    <img src="/desatour-logo.png" style="min-width: 150px;">
								<br>
								<small style="white-space: normal!important;">Jelajahi wisata, kuliner, penginapan, dan infrastruktur desa di DesaTour!</small>
							</a>
                            <form id="login-form-tour" action="{{ url('/lahan') }}" method="POST" class="d-none">
                                <input type="hidden" name="email" value="{{ auth()->user()->pengguna->email }}">
                                <input type="hidden" name="id_desa" value="{{ auth()->user()->pengguna->village_id }}">
                            </form>
							@else
							<a class="dropdown-item" target="_blank" href="https://desaku-desatour.masuk.id">
								<img src="/desatour-logo.png" style="min-width: 150px;">
								<br>
								<small style="white-space: normal!important;">Jelajahi wisata, kuliner, penginapan, dan infrastruktur desa di DesaTour!</small>
							</a>
							@endif
						</div>
					</div>
					<div class="row" style="margin-right: 0; margin-left: 0;">
						<div class="col desa-col">
						    @if(Auth::check())
							<a href="{{ url('categories') }}" class="dropdown-item">
							    <img src="/desastore-logo.png" style="min-width: 150px;">
								<br>
								<small style="white-space: normal!important;">Jual & beli berbagai produk desa di DesaStore!</small>
							</a>
                            <form id="login-form-store" action="#" method="POST" class="d-none">
                                <!-- <input type="hidden" name="email" value="{{ auth()->user()->pengguna->email }}">
                                <input type="hidden" name="id_desa" value="{{ auth()->user()->pengguna->village_id }}"> -->
                            </form>
							@else
							<a class="dropdown-item" target="_blank" href="{{ url(sosial-media/marketplace) }}">
								<img src="/desastore-logo.png" style="min-width: 150px;">
								<br>
								<small style="white-space: normal!important;">Jual & beli berbagai produk desa di DesaStore!</small>
							</a>
							@endif
						</div>
					</div>
				</div>
			</li>
		</ul>
		@if(Auth::check())
			<div class="col-lg-6 d-flex justify-content-center box-search">
				<form class="form-inline my-lg-0">
					<div id="container_search" style="display: block; position:relative">
						<input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
						<input type="hidden" name="searchUname"></input>
					</div>
				</form>
			</div>
		@endif
		<ul class="navbar-nav col-lg-4 d-flex justify-content-end">
			{{-- <li class="nav-item">
				<a class="nav-link" href="/sosial-media/shop" title="Produk Desa" data-ripple=""><i class="ti-shopping-cart" style="color:white; border: 2px double gold; padding: 5px;"></i></a>
			</li> --}}
			@if(Auth::check())
				<li class="nav-item active">
					<a class="nav-link beranda" href="/sosial-media/beranda" title="Home" data-ripple=""><i class="ti-home" style="color:white;"></i></a>
					<!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
				</li>
				<li class="nav-item">
					<a class="nav-link notif" title="Notification" id="notif" data-ripple="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="ti-bell" style="color:white;"></i>
						@if($total_notif != 0)
							<span class="badge badge-danger" id="jml_notif">{{ $total_notif }}</span>
						@endif
					</a>
					<div class="dropdown-menu dropdown-menu-right" style="min-width: 100%">
						<h6 style="text-align: center">Notifikasi</h6>
						<hr style="margin-top: 0.25rem; margin-bottom: 0.25rem;">
						<div class="a" style="overflow-y: auto; max-height: 250px;">
						@if(sizeof($list_notif_display) > 0)
							@foreach($list_notif_display as $list)
								@if($list->jenis_notif == 'Menyukai')
									<button class="dropdown-item" type="button" onclick="location.href='/sosial-media/konten_detail/{{$list->id_konten_likes}}';">
										<div class="media">
											<img src="{{ (url('/data_file/'.$list->username_likers.'/foto_profil/'.$list->foto_profil_likers)) }}" class="align-self-center mr-3" alt="..." style="width: 30px; height: 30px; border-radius: 50%;">
											<div class="media-body align-self-center" style="white-space: initial; width:200px;">
												<small style="color: white"><b>{{ $list->username_likers }}</b> 
												menyukai postingan anda
												</small>
												<small style="color: #989e99">-{{ date_format(date_create($list->tanggal_like), "d M Y H:i A") }}</small>
											</div>
											<?php $media = explode(", ", $list->foto_video_konten); ?>
											<?php $tgl = date_format(date_create($list->tgl_konten),"d-m-Y"); ?>
											@for($x = 0; $x < 1; $x++)
												@if (strpos($media[$x], '.mp4'))
													<video width="40" height="40" style="object-fit:none; margin-left: 16px;">
														<source src="{{ url('/data_file/'.$list->username_konten.'/foto_konten/'.$tgl.'/'.$list->slugg.'/'.$media[$x]) }}" type="video/mp4">
														<source src="{{ url('/data_file/'.$list->username_konten.'/foto_konten/'.$tgl.'/'.$list->slugg.'/'.$media[$x]) }}" type="video/ogg">
														Your browser does not support the video tag.
													</video>
												@else
													<img src="{{ url('/data_file/'.$list->username_konten.'/foto_konten/'.$tgl.'/'.$list->slugg.'/'.$media[$x]) }}" class="align-self-center ml-3" style="width: 40px; height: 40px; border-radius: 0%;">
												@endif
											@endfor
										</div>
									</button>
								@elseif($list->jenis_notif == 'Komentar')
									<button class="dropdown-item" type="button" onclick="location.href='/sosial-media/konten_detail/{{$list->id_konten_komen}}';">
										<div class="media">
											<img src="{{ (url('/data_file/'.$list->username_commentor.'/foto_profil/'.$list->foto_profil_commentor)) }}" class="align-self-center mr-3" alt="..." style="width: 30px; height: 30px; border-radius: 50%;">
											<div class="media-body align-self-center" style="white-space: initial; width:200px;">
												<small style="color: white"><b>{{ $list->username_commentor }}</b> 
												@if(strpos($list->isi_komentar, auth()->user()->pengguna->username) !== false)
													menyebut anda dalam komentar: 
												@else 
													mengomentari postingan anda:
												@endif
												<?php echo html_entity_decode($list->isi_komentar); ?> 
												</small>
												<small style="color: #989e99">-{{ date_format(date_create($list->tanggal_komen), "d M Y H:i A") }}</small>
											</div>
											<?php $media = explode(", ", $list->foto_video_konten_komen); ?>
											<?php $tgl = date_format(date_create($list->tgl_konten_2),"d-m-Y"); ?>
											@for($x = 0; $x < 1; $x++)
												@if (strpos($media[$x], '.mp4'))
													<video width="40" height="40" style="object-fit:none; margin-left: 16px;">
														<source src="{{ url('/data_file/'.$list->username_konten_2.'/foto_konten/'.$tgl.'/'.$list->slug.'/'.$media[$x]) }}" type="video/mp4">
														<source src="{{ url('/data_file/'.$list->username_konten_2.'/foto_konten/'.$tgl.'/'.$list->slug.'/'.$media[$x]) }}" type="video/ogg">
														Your browser does not support the video tag.
													</video>
												@else
													<img src="{{ url('/data_file/'.$list->username_konten_2.'/foto_konten/'.$tgl.'/'.$list->slug.'/'.$media[$x]) }}" class="align-self-center ml-3" alt="..." style="width: 40px; height: 40px; border-radius: 0%;">
												@endif
											@endfor
										</div>
									</button>
								@elseif($list->jenis_notif == 'Post Grup')
									<button class="dropdown-item" type="button" onclick="location.href='/sosial-media/halaman_group_detail/{{$list->id_group}}';">
										<div class="media">
											<img src="{{ (url('/data_file/'.$list->username_post.'/foto_profil/'.$list->foto_profil_post)) }}" class="align-self-center mr-3" alt="..." style="width: 30px; height: 30px; border-radius: 50%;">
											<div class="media-body align-self-center" style="white-space: initial; width:200px;">
												<small style="color: white"><b>{{ $list->username_post }}</b> 
													memposting sesuatu di <strong>{{ $list->nama_group }}</strong>
												</small>
												<small style="color: #989e99">-{{ date_format(date_create($list->created_at), "d M Y H:i A") }}</small>
											</div>
										</div>
									</button>
								@elseif($list->jenis_notif == 'Undangan Grup')
									<button class="dropdown-item" type="button">
										<div class="media">
											<img src="{{ (url('/data_file/'.$list->username_pengirim.'/foto_profil/'.$list->foto_pengirim)) }}" class="align-self-center mr-3" alt="..." style="width: 30px; height: 30px; border-radius: 50%;">
											<div class="media-body align-self-center" style="white-space: initial; width:200px; height: 90px;">
												<small style="color: white"><b>{{ $list->username_pengirim }}</b> 
													mengundang anda ke dalam grup <strong>{{ $list->nama_group_undangan }}</strong>
												</small>
												<small style="color: #989e99">-{{ date_format(date_create($list->tanggal_undangan), "d M Y H:i A") }}</small>
												<br>
												<a href="/sosial-media/terima_undangan_grup/{{$list->id}}" class="btn btn-success btn-sm" role="button" style="position: relative; top:10px; border: 1px solid #358f66; background: #358f66;">Terima</a>
												<a href="/sosial-media/tolak_undangan_grup/{{$list->id}}" class="btn btn-success btn-sm" role="button" style="position: relative; top:10px; border: 1px solid #358f66; background: #358f66;">Tolak</a>
											</div>
										</div>
									</button>
								@elseif($list->jenis_notif == 'Admin Grup')
									<button class="dropdown-item" type="button" onclick="location.href='/sosial-media/halaman_group_detail/{{$list->id_group_adm}}';">
										<div class="media">
											<img src="{{ (url('/data_file/'.$list->username_admin_penambah.'/foto_profil/'.$list->foto_admin_penambah)) }}" class="align-self-center mr-3" alt="..." style="width: 30px; height: 30px; border-radius: 50%;">
											<div class="media-body align-self-center" style="white-space: initial; width:200px;">
												<small style="color: white"><b>{{ $list->username_admin_penambah }}</b> 
												menjadikan Anda sebagai admin grup <b>{{$list->nama_group_adm}}</b>
												</small>
												<small style="color: #989e99">-{{ date_format(date_create($list->tanggal_admin), "d M Y H:i A") }}</small>
											</div>
										</div>
									</button>
								@elseif($list->jenis_notif == 'Followers')
									@if(strpos($list->isi_notif, "mengirim permintaan mengikuti") !== false)
										<button class="dropdown-item" type="button">
											<div class="media">
												<img src="{{ (url('/data_file/'.$list->username_requester.'/foto_profil/'.$list->foto_requester)) }}" class="align-self-center mr-3" alt="..." style="width: 30px; height: 30px; border-radius: 50%;">
												@if($list->status_request == 'Menunggu')
													<div class="media-body align-self-center" style="white-space: initial; width:200px; height: 90px;">
														<small style="color: white"><b>{{ $list->username_requester }}</b> 
															mengirim permintaan mengikuti
														</small>
														<small style="color: #989e99">-{{ date_format(date_create($list->tanggal_follow), "d M Y H:i A") }}</small>
														<br>
														<a href="/sosial-media/terima_request/{{$list->id_request}}" class="btn btn-success btn-sm" role="button" style="position: relative; top:10px; border: 1px solid #358f66; background: #358f66;">Terima</a>
														<a href="/sosial-media/tolak_request/{{$list->id_request}}" class="btn btn-success btn-sm" role="button" style="position: relative; top:10px; border: 1px solid #358f66; background: #358f66;">Tolak</a>
													</div>
												@else
													<div class="media-body align-self-center" style="white-space: initial; width:200px;">
														<small style="color: white"><b>{{ $list->username_requester }}</b> 
														mulai mengikuti Anda
														</small>
														<small style="color: #989e99">-{{ date_format(date_create($list->tanggal_follow), "d M Y H:i A") }}</small>
													</div>
												@endif
											</div>
										</button>
									@else
										<button class="dropdown-item" type="button">
											<div class="media">
												<img src="{{ (url('/data_file/'.$list->username_followers.'/foto_profil/'.$list->foto_profil_followers)) }}" class="align-self-center mr-3" alt="..." style="width: 30px; height: 30px; border-radius: 50%;">
												<div class="media-body align-self-center" style="white-space: initial; width:200px;">
													<small style="color: white"><b>{{ $list->username_followers }}</b> 
														mulai mengikuti Anda
													</small>
													<small style="color: #989e99">-{{ date_format(date_create($list->tanggal_follow), "d M Y H:i A") }}</small>
												</div>
											</div>
										</button>
									@endif
								@endif
							@endforeach
						@else
							<div align="center"> Tidak Ada Notifikasi </div>
						@endif
						</div>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link pesan" href="{{ asset('/sosial-media/chat') }}" title="Message" data-ripple="">
						<i class="fa fa-send-o" style="color:white;"></i> 
						@if(isset($notif_pesan))
							@foreach ($notif_pesan as $notif)
								@if($notif->jml != 0)
									<span class="badge badge-danger">{{ $notif->jml }}</span>
								@endif
							@endforeach
						@endif
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link group" href="{{ asset('/sosial-media/halaman_group') }}" title="Group" title="Group Notification" id="notif_group" data-ripple="">
						<i class="fa fa-group" style="color:white;"></i>
						@if(isset($notif_group))
							@foreach ($notif_group as $row)
								@if($row->jml != 0)
									<span class="badge badge-danger" id="jml_notif_group">{{ $row->jml }}</span>
								@endif
							@endforeach
						@endif
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle img_nav prof" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" alt="" style="height: 20px;width:20px;border-radius:50%;vertical-align:sub;">
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#" title="">{{ auth()->user()->name }}</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/sosial-media/profil/{{auth()->user()->pengguna->username}}" title=""><i class="ti-user" style="padding-right: 1rem;"></i>Profil</a>
						<!-- <a class="dropdown-item" href="" title=""><i class="fa fa-bar-chart-o" style="padding-right: 1rem;"></i>Insight</a> -->
						<a class="dropdown-item" href="/sosial-media/pengaturan" title=""><i class="ti-settings" style="padding-right: 1rem;"></i>Pengaturan</a>
						{{-- <a class="dropdown-item" href="/sosial-media/logout_proses" title=""><i class="ti-power-off" style="padding-right: 1rem;"></i>Logout</a> --}}
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off" style="padding-right: 1rem;"></i> Logout </a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</div>
				</li>
			@else
				<li class="nav-item">
					<a href="/sosial-media" class="nav-link notif">
						Login
					</a>
				</li>
			@endif
		</ul>
	</div>
</nav>
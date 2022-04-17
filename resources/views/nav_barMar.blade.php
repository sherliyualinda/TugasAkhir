<nav class="navbar navbar-expand-lg navbar-dark bg-info">
	<div class="logo col-lg-2">
		<a title="" href="{{ asset('/sosial-media/beranda') }}">
			<img src="/Diessnie-logo.jpeg" alt="" style="max-height: 50px;">
		</a>
	</div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
  	<ul class="navbar-nav mr-auto">
	  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle menu-text" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
				Produk Desaku
				</a>
				<div class="dropdown-menu box-size" aria-labelledby="navbarDropdown" style="width: 850px!important;">
					<div class="row" style="margin-right: 0; margin-left: 0;">
						<div class="col desa-col">
							@if(Auth::check())
							<a href="{{ url('sosial-media/beranda') }}" class="dropdown-item">
								<img src="/desafeed-logo.png" style="min-width: 150px;">
								<br>
								<small style="white-space: normal!important;">Media Sosial Untuk Kamu</small>
							</a>
								<form id="login-form-store" action="#" method="POST" class="d-none">
									</form>
							@else
							<a class="dropdown-item" target="_blank" href="{{ url(sosial-media/beranda) }}">
								<img src="/desafeed-logo.png" style="min-width: 150px;">
								<br>
								<small style="white-space: normal!important;">Jual & beli berbagai produk desa di DesaStore!</small>
							</a>
							@endif
						</div>
					</div>
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
			<li>
				<div class="mx-auto" style="width: 200px;">
				
				</div>
			</li>
			<li>
				<form class="form-inline my-2 my-lg-0">
				  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				  <button class="btn btn-secondary my-2 my-sm-0" type="submit" >Search</button>
				</form>
			</li>
			
		</ul>
		<ul class="navbar-nav ml-auto text-center">
			<li class="nav-item dropdown ">
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
		</ul>
	</div>
</nav>
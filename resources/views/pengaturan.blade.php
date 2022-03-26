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
    <link rel="stylesheet" type="text/css" href="{{asset('jquery-ui-1.12.1.custom/jquery-ui.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/pengaturan.css')}}">

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
				<div class="row" style="padding-left: 10px;">
					<div class="col-lg-12">
						<div class="row justify-content-center" id="page-contents" style="padding-left: 0;">
							<div class="central-meta col-lg-3">
								<nav class="navbar bg-transparent">
								  <ul class="navbar-nav">
								    <li class="nav-item">
								      <a class="nav-link active" href="{{ asset('/sosial-media/pengaturan') }}">Ubah Profil</a>
								    </li>
								    <li class="nav-item">
								      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_pass') }}">Ubah Password</a>
								    </li>
								    <li class="nav-item">
								      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_notif') }}">Notifikasi</a>
								    </li>
								    @foreach ($profil as $d)
									    @if($d->jenis_akun == 'pribadi')
										    <li class="nav-item">
										      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_privasi') }}">Privasi Akun</a>
										    </li>
									    @endif
								    @endforeach
								    <li class="nav-item">
								      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_log') }}">Riwayat Login</a>
								    </li>
								    <li class="nav-item">
								      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_hapus_akun') }}">Hapus Akun</a>
								    </li>
								  </ul>
								</nav>
							</div>
							<div class="central-meta item col-lg-7">
								<h5 class="f-title" style="margin-bottom: 0px;"><i class="ti-info-alt"></i> Ubah Profil</h5>
								@foreach ($profil as $data)
								<form action="/sosial-media/ubah_profil_proses" method="post" class="form-horizontal" enctype="multipart/form-data">
								{{ csrf_field() }}
									<div style="margin:17px 44px;">
									  <input type="hidden" name="id_pengguna" value="{{ $data->id_pengguna }}"></input>
									  <div class="form-group half">
										  <div class="media">
										    <label for="staticEmail" class="col-form-label">
										    	<div class="foto_profil">
										    		<img src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}" name="foto_profil" class="mr-3" style="height: 50px;width:50px;border-radius:50%;vertical-align:sub;" id="item-img-output-profil">
										    	</div>
										    </label>
										    <div class="media-body align-self-center">
											    <!-- <h6> {{ $data->username }} </h6> -->
											    <div class="attachments" style="border:0; padding: 0px; background: #fdfdfd; text-align: left;">
													<ul>
														<li data-toggle="tooltip" title="Ubah Foto Profil">
														    <i class="fa fa-image" style="color: blue;"></i>
															<label class="fileContainer">
																<input type="file" name="foto_profil" class="item-img" id="foto_profil" accept="image/*">
															</label>
														</li>
														<li data-toggle="tooltip" title="Remove Foto Profil">
															<i class="fa fa-remove" style="color: red;" onclick="removeSrc()"></i>
														</li>
													</ul>
												</div>
										    </div>
										  </div>
									  </div>
									  <div class="form-group half">
									  	<div class="media">
										    <label for="staticEmail" class="col-form-label">
										    	<div class="foto_sampul">
										    		<img src="{{ $data->foto_sampul != null ? url('/data_file/'.$data->username.'/foto_sampul/'.$data->foto_sampul) : asset('sampul.jpg') }}" name="foto_sampul" class="mr-3" style="height: 50px;width:50px;border-radius:50%;vertical-align:sub;" id="item-img-output-sampul">
										    	</div>
										    </label>
										    <div class="media-body align-self-center">
										      	<div class="attachments" style="border:0; padding: 0px; background: #fdfdfd; text-align: left;">
													<ul>
														<li data-toggle="tooltip" title="Ubah Foto Sampul">
														    <i class="fa fa-image" style="color: blue;"></i>
															<label class="fileContainer">
																<input type="file" name="foto_sampul" class="item-img-sampul" id="foto_sampul" accept="image/*">
															</label>
														</li>
														<li data-toggle="tooltip" title="Remove Foto Sampul">
															<i class="fa fa-remove" style="color: red;" onclick="removeSrc_sampul()"></i>
														</li>
													</ul>
												</div>
										    </div>
										</div>
									  </div>
									  <div class="form-group half">
									      <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" {{ $data->jenis_akun == 'desa' ? 'readonly' : '' }}>
									      <label for="nama" class="control-label {{ $data->jenis_akun == 'desa' ? 'sr-only' : '' }}">Nama</label><i class="mtrl-select"></i>
									  </div>
									  <div class="form-group half">
									      <input type="text" class="form-control field_uname" name="username" value="{{ $data->username }}" onkeyup="check_username()">
									      <label for="nama" class="control-label">Username</label><i class="mtrl-select"></i>
									      <small id="err_msg" style="color: red;"></small>
									  </div>
									  <div class="form-group">
									      <textarea class="form-control" rows="3" name="bio">{{ $data->bio }}</textarea>
									      <label for="nama" class="control-label">Bio</label><i class="mtrl-select"></i>
									  </div>
									  <div class="form-group half">
									      <input type="url" class="form-control" name="website" value="{{ $data->website }}">
									      <label for="nama" class="control-label">{{ $data->jenis_akun == 'desa' ? 'Desatour' : 'Website' }}</label><i class="mtrl-select"></i>
									  </div>
									  <div class="form-group half">
									      <input type="url" class="form-control" name="youtube" value="{{ $data->youtube }}">
									      <label for="nama" class="control-label">{{ $data->jenis_akun == 'desa' ? 'Desatube' : 'Youtube' }}</label><i class="mtrl-select"></i>
									  </div>
									  @if($data->jenis_akun == 'desa')
									  <div class="form-group half">
									      <input type="url" class="form-control" name="marketplace" value="{{ $data->marketplace }}">
									      <label for="nama" class="control-label">{{ $data->jenis_akun == 'desa' ? 'Desastore' : '' }}</label><i class="mtrl-select"></i>
									  </div>
									  <div class="form-group half">
									      <input type="url" class="form-control" name="berita" value="{{ $data->berita }}">
									      <label for="nama" class="control-label">{{ $data->jenis_akun == 'desa' ? 'Desanews' : '' }}</label><i class="mtrl-select"></i>
									  </div>
									  <!-- <div class="form-group half">
									      <input type="url" class="form-control" name="musrembang" value="{{ $data->musrembang }}">
									      <label for="nama" class="control-label">Web Musrembang</label><i class="mtrl-select"></i>
									  </div> -->
									  @endif
									  <div class="form-group half">
									      <input type="email" class="form-control field_email" name="email" value="{{ $data->email }}" onkeyup="check_email()">
									      <label for="nama" class="control-label">E-mail</label><i class="mtrl-select"></i>
									      <small id="err_msg_email" style="color: red;"></small>
									  </div>
									  <div class="form-group half">
									      <input type="number" class="form-control" name="nomor_hp" value="{{ $data->nomor_hp }}">
									      <label for="nama" class="control-label">Nomor HP</label><i class="mtrl-select"></i>
									  </div>
									  <div class="submit-btns">
									      <input class="btn btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Update"></input>
									  </div>
									</div>
								</form>
								@endforeach	
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

</div>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="{{ asset('js/pengaturan.js') }}"></script>

<script type="text/javascript">
	function removeSrc() {
		let html = '';
		html += '<img src="{{asset('user.jpg')}}" name="foto_profil" class="mr-3" style="height: 50px; width:50px;border-radius:50%; vertical-align:sub;">';
		$('.foto_profil').html(html);
	}

	function removeSrc_sampul() {
		let html = '';
		html += '<img src="{{asset('sampul.jpg')}}" name="foto_sampul" class="mr-3" style="height: 50px; width: 50px;border-radius: 50%; vertical-align: sub;">';
		$('.foto_sampul').html(html);
	}
	// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // $('#notif').click(function() {
    // 	$.ajax({
    //         url:"{{route('sosial-media.update_notif')}}",
    //         type: 'post',
    //         // dataType: "json",
    //         data: {
    //            _token: CSRF_TOKEN
    //         },
    //         success: function( data ) {
    //           	if(document.getElementById("jml_notif")){
    //            		document.getElementById("jml_notif").style.visibility = "hidden";
    //            	}
    //         }
    //     });
    // });
</script>
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
    
    function check_username(){
		var username = $('.field_uname').val();
		if(username != ''){
			$.ajax({
				type: 'GET',
				url: '/sosial-media/check-username/'+username,
				success: function(data){
					if(data.length != 0){
						$('#err_msg').text('Username tidak available!');
					}else{
						$('#err_msg').text('');
					}
				}
			});
		}else{
			$('#err_msg').text('');
		}
	}

	function check_email(){
		var email = $('.field_email').val();
		if(email != ''){
			$.ajax({
				type: 'GET',
				url: '/sosial-media/check-email/'+email,
				success: function(data){
					if(data.length != 0){
						$('#err_msg_email').text('Email sudah terdaftar! Silahkan coba dengan email yang berbeda.');
					}else{
						$('#err_msg_email').text('');
					}
				}
			});
		}else{
			$('#err_msg_email').text('');
		}
	}
</script>
</body>	

</html>
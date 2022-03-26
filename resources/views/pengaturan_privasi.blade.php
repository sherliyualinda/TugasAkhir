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
	<link rel="stylesheet" type="text/css" href="{{asset('css/pengaturan-privasi.css')}}">

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		@include('theme.nav_bar')
	</nav>
		
	<section>
		<div class="gap gray-bg">
		@if (Session::get('success'))
		    <div class="alert alert-success">
		        {{ Session::get('success') }}
		        <button type="button" class="close" data-dismiss="alert">&times;</button>
		    </div>
		@elseif(Session::get('alert'))
			<div class="alert alert-danger">
		        {{ Session::get('alert') }}
		        <button type="button" class="close" data-dismiss="alert">&times;</button>
		    </div>
		@endif
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row justify-content-center" id="page-contents" style="padding-left: 0;">
							<div class="central-meta col-lg-3">
								<nav class="navbar bg-transparent">
								  <ul class="navbar-nav">
								    <li class="nav-item">
								      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan') }}">Ubah Profil</a>
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
										      <a class="nav-link active" href="{{ asset('/sosial-media/pengaturan_privasi') }}">Privasi Akun</a>
										    </li>
									    @endif
								    @endforeach
								    <li class="nav-item">
								      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_log') }}">Aktifitas Login</a>
								    </li>
								    <li class="nav-item">
								      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_hapus_akun') }}">Hapus Akun</a>
								    </li>
								  </ul>
								</nav>
							</div>
							<div class="central-meta item col-lg-7">
								<h5 class="f-title" style="margin-bottom: 0px;"><i class="ti-settings"></i> Privasi Akun</h5>
								<form action="/sosial-media/ubah_privasi_proses" method="post" class="form-horizontal">
								{{ csrf_field() }}
								<div style="margin:17px 44px;">
									<div class="row">
									    <h5>
									    	Privasi Akun
									    </h5>
								   	</div>
								   	<div class="row">
										@foreach ($pengaturan as $data)
										<div class="form-radio">
										  	<div class="radio" style="width: auto; margin-right: 30px;">
												<label>
											  		<input type="radio" name="pilihan" value="iya" <?php if ($data->akun_privat == 'iya') { echo "checked"; }?>/><i class="check-box"></i>Akun Privat
												</label>
										  	</div>
										  	<div class="radio" style="width: auto;">
												<label>
											  		<input type="radio" name="pilihan" value="tidak" <?php if ($data->akun_privat == 'tidak') { echo "checked"; }?>/><i class="check-box"></i>Akun Publik
												</label>
										  	</div>
										</div>
										<small style="color: #b3b3b3">Apabila akun bersifat pribadi, hanya orang yang Anda setujui yang dapat melihat foto dan video Anda. Pengikut Anda yang ada tidak akan terpengaruh.</small>
										@endforeach
									</div>
									<hr>
									<!-- <div class="row">
									    <h5>
									    	Privasi Akun
									    </h5>
								   	</div>
								   	<div class="row">
										<div class="checkbox" style="margin: 0px;">
										  	<label>
												<input type="checkbox" name="pilihan"><i class="check-box"></i>Akun Private
										  	</label>
										</div>
										<small style="color: #b3b3b3">When your account is private, only people you approve can see your photos and videos on Instagram. Your existing followers won't be affected.</small>
									</div> -->
								
								  	<div class="row">
								      	<input class="btn btn-submit" type="submit" style="background-color: #358f66; color: white; margin-top: 15px;" value="Submit"></input> 
								  	</div>
								</div>
								</form>	
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

</div>
<div class="side-panel">
	<h4 class="panel-title">General Setting</h4>
	<form method="post">
		<div class="setting-row">
			<span>use night mode</span>
			<input type="checkbox" id="nightmode1" onclick="myFunction()"/> 
			<label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>Notifications</span>
			<input type="checkbox" id="switch22" /> 
			<label for="switch22" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>Notification sound</span>
			<input type="checkbox" id="switch33" /> 
			<label for="switch33" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>My profile</span>
			<input type="checkbox" id="switch44" /> 
			<label for="switch44" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>Show profile</span>
			<input type="checkbox" id="switch55" /> 
			<label for="switch55" data-on-label="ON" data-off-label="OFF"></label>
		</div>
	</form>
	<h4 class="panel-title">Account Setting</h4>
	<form method="post">
		<div class="setting-row">
			<span>Sub users</span>
			<input type="checkbox" id="switch66" /> 
			<label for="switch66" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>personal account</span>
			<input type="checkbox" id="switch77" /> 
			<label for="switch77" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>Business account</span>
			<input type="checkbox" id="switch88" /> 
			<label for="switch88" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>Show me online</span>
			<input type="checkbox" id="switch99" /> 
			<label for="switch99" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>Delete history</span>
			<input type="checkbox" id="switch101" /> 
			<label for="switch101" data-on-label="ON" data-off-label="OFF"></label>
		</div>
		<div class="setting-row">
			<span>Expose author name</span>
			<input type="checkbox" id="switch111" /> 
			<label for="switch111" data-on-label="ON" data-off-label="OFF"></label>
		</div>
	</form>
</div><!-- side panel -->		
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="{{ asset('js/pengaturan-privasi.js') }}"></script>
<script type="text/javascript">
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
    //            	if(document.getElementById("jml_notif")){
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
</script>
</body>	

</html>
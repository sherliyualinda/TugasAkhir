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
	<link rel="stylesheet" type="text/css" href="{{asset('css/pengaturan-notif.css')}}">

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
								      <a class="nav-link active" href="{{ asset('/sosial-media/pengaturan_notif') }}">Notifikasi</a>
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
								<h5 class="f-title" style="margin-bottom: 0px;"><i class="ti-settings"></i> Pengaturan Notifikasi</h5>
								@foreach ($pengaturan as $data)
								<form action="/sosial-media/ubah_notif_proses" method="post" class="form-horizontal">
								{{ csrf_field() }}
								<div style="margin:17px 44px;">
								<input type="hidden" name="id_pengguna" value="{{ $data->id_pengguna }}"></input>
									<div class="row">
									    <h5>
									    	Notifikasi Menyukai
									    </h5>
								   	</div>
							    	<div class="form-check">
									  <input class="form-check-input" type="radio" name="notif_suka" value="nonaktif" 
									  		<?php if ($data->notifikasi_menyukai == 'nonaktif') { echo "checked"; }?> 
									  >
									  <label class="form-check-label" for="exampleRadios1">
									    Nonaktif
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="radio" name="notif_suka" value="dari orang yang saya ikuti" 
									  		<?php if ($data->notifikasi_menyukai == 'dari orang yang saya ikuti') { echo "checked"; }?>
									  >
									  <label class="form-check-label" for="exampleRadios2">
									    Dari Orang Yang Saya Ikuti
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="radio" name="notif_suka" value="dari semua orang" 		<?php if ($data->notifikasi_menyukai == 'dari semua orang') { echo "checked"; }?>
									  >
									  <label class="form-check-label" for="exampleRadios3">
									    Dari Semua Orang
									  </label>
									</div>
									<small style="color: #b3b3b3">johnappleseed menyukai foto Anda.</small>
									<hr>
									<div class="row">
									    <h5>
									    	Notifikasi Komentar
									    </h5>
								   	</div>
								   	<div class="form-check">
									  <input class="form-check-input" type="radio" name="notif_komentar" value="nonaktif" 
									  		<?php if ($data->notifikasi_komentar == 'nonaktif') { echo "checked"; }?>
									  >
									  <label class="form-check-label" for="exampleRadios1">
									    Nonaktif
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="radio" name="notif_komentar" value="dari orang yang saya ikuti" 
									  		<?php if ($data->notifikasi_komentar == 'dari orang yang saya ikuti') { echo "checked"; }?>
									  >
									  <label class="form-check-label" for="exampleRadios2">
									    Dari Orang Yang Saya Ikuti
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="radio" name="notif_komentar" value="dari semua orang" 
									  		<?php if ($data->notifikasi_komentar == 'dari semua orang') { echo "checked"; }?>
									  >
									  <label class="form-check-label" for="exampleRadios3">
									    Dari Semua Orang
									  </label>
									</div>
									<small style="color: #b3b3b3">johnappleseed mengomentari postingan Anda: "Tembakan bagus!".</small>
									<hr>
									<div class="row">
									    <h5>
									    	Notifikasi Pesan
									    </h5>
								   	</div>
								   	<div class="form-check">
									  <input class="form-check-input" type="radio" name="notif_pesan" value="nonaktif" 
									  		<?php if ($data->notifikasi_pesan == 'nonaktif') { echo "checked"; }?>
									  >
									  <label class="form-check-label" for="exampleRadios1">
									    Nonaktif
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="radio" name="notif_pesan" value="dari semua orang" 
									  		<?php if ($data->notifikasi_pesan == 'dari semua orang') { echo "checked"; }?>
									  >
									  <label class="form-check-label" for="exampleRadios3">
									    Dari Semua Orang
									  </label>
									</div>
									<!-- <hr> -->
								  	<div class="row">
								      	<input class="btn btn-submit" type="submit" style="background-color: #358f66; color: white; margin-top: 15px;"></input> 
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
<script src="{{ asset('js/pengaturan-notif.js') }}"></script>
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
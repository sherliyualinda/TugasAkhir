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
	<link rel="stylesheet" type="text/css" href="{{asset('css/pengaturan-log.css')}}">

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
										      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_privasi') }}">Privasi Akun</a>
										    </li>
									    @endif
								    @endforeach
								    <li class="nav-item">
								      <a class="nav-link active" href="{{ asset('/sosial-media/pengaturan_log') }}">Riwayat Login</a>
								    </li>
								    <li class="nav-item">
								      <a class="nav-link" href="{{ asset('/sosial-media/pengaturan_hapus_akun') }}">Hapus Akun</a>
								    </li>
								  </ul>
								</nav>
							</div>
							<div class="central-meta item col-lg-7">
								<h5 class="f-title" style="margin-bottom: 0px;"><i class="ti-location-pin"></i> Riwayat Login</h5>
								<div style="margin:17px 44px;">
									<div class="margin-bottom-15">
									@foreach($login_terbaru as $row_terbaru)
										<!-- <div id="map"></div>  -->
										<img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s-l+000({{$row_terbaru->longitude}},{{$row_terbaru->latitude}})/{{$row_terbaru->longitude}},{{$row_terbaru->latitude}},9.67,0.00,0.00/800x300?access_token=pk.eyJ1IjoiYWZyYWFrbmltIiwiYSI6ImNrbmZ0eXN1bDA1cDAyb253eWxjdjlpYXoifQ.z6oYKQ9BNNt8RHmh7GAnEQ"> 
									@endforeach 
										<!-- <a class="btn btn-light btn-block" style="border-radius: 0px; font-weight: 500;" role="button" data-toggle="modal" data-target="#myModal">Ini Saya</a>
										<a class="btn btn-light btn-block" style="border-radius: 0px; font-weight: 500;margin-top:0;" role="button" data-toggle="modal" data-target="#myModal2">Ini Bukan Saya</a> -->
		                            </div>
		                            <br>
		                            <div class="row">
									    <h7 style="font-weight: 700; color: black;"> Riwayat Login </h7>
								   	</div>
								   	<div class="accordion" id="accordionExample" style="margin-top: 5px; width: 100%;">
								   	<?php $i=1; ?>
								   	@foreach ($riwayat_login as $row)
									  	<div class="card">
									    	<div class="card-header" id="heading{{$i}}">
									      		<h2 class="mb-0">
									        		<button class="btn" type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="false" aria-controls="collapse{{$i}}" style="width: 100%; text-align: left;white-space:normal; margin-top: 0!important;">
									          		{{$row->kota}} <br>
									          		<small style="color:#808080;white-space:normal;"> {{ date_format(date_create($row->tanggal), "d M Y H:i A") }} - {{$row->device}}
													  <?php if(date_format(date_create($row->tanggal), "d M Y") == date("d M Y")) { ?>
													  <span style="color:green; font-weight: bold;">- Hari Ini</span>
													  <?php } ?>
													</small>
									        		</button>
									      		</h2>
									    	</div>

										    <div id="collapse{{$i}}" class="collapse" aria-labelledby="heading{{$i}}" data-parent="#accordionExample">
										      <div class="card-body">
										        <div class="margin-bottom-15">
													<!-- <div id="map2" style="height:200px;"></div> -->
													<!-- <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$row->latitude}},{{$row->longitude}}&zoom=12&size=400x400&key=AIzaSyCuA2DiexaTyox7TTX09orh3AsWJHLw3TE"> -->
													<img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s-l+000({{$row->longitude}},{{$row->latitude}})/{{$row->longitude}},{{$row->latitude}},9.67,0.00,0.00/800x300?access_token=pk.eyJ1IjoiYWZyYWFrbmltIiwiYSI6ImNrbmZ0eXN1bDA1cDAyb253eWxjdjlpYXoifQ.z6oYKQ9BNNt8RHmh7GAnEQ">
													<!-- <a class="btn btn-light btn-block" onclick="if(!confirm('Anda yakin ingin logout?')) return false;" href="{{ asset('/sosial-media/logout_proses') }}" role="button" style="border-radius: 0px; font-weight: 500;">Logout</a> -->
					                            </div>
										      </div>
										    </div>
									  	</div>
									  	<?php $i++;?>
									@endforeach
									</div>
                                </div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>
	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog modal-sm">
	      	<div class="modal-content" style="text-align: center;">
		        <div class="modal-header d-flex justify-content-center">
		          <h6 class="modal-title">Konfirmasi Aktifitas Login Ini? <br>
		          	<small style="color: #b3b3b3">If you recognize this device and location, we'll keep your account logged in.</small>
		          </h6>
		        </div>
		        <ul class="list-group list-group-flush">
		        	<li class="list-group-item"><a href="#" style="font-weight: 600; color: blue;"> Konfirmasi </a></li>
		        	<li class="list-group-item"><a href="#" data-dismiss="modal"> Tidak Sekarang / Batalkan </a></li>
		        </ul>
	      	</div>
	    </div>
	</div>
	<div class="modal fade" id="myModal2" role="dialog">
	    <div class="modal-dialog" style="max-width: 400px;">
	      	<div class="modal-content" style="text-align: center;">
		        <div class="modal-header d-flex justify-content-center">
		          <h6 class="modal-title">Ubah Password Untuk Mengamankan Akun <br>
		          	<small style="color: #b3b3b3">Update your password to keep your account safe and you'll be logged out everywhere else.</small>
		          </h6>
		        </div>
		        <ul class="list-group list-group-flush">
		        	<li class="list-group-item"><a href="{{ asset('/sosial-media/pengaturan_pass') }}" style="font-weight: 600; color: blue;"> Ubah Password </a></li>
		        	<li class="list-group-item"><a href="#" data-dismiss="modal"> Tidak Sekarang / Batalkan </a></li>
		        </ul>
	      	</div>
	    </div>
	</div>

</div>		
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="{{ asset('js/pengaturan-log.js') }}"></script>

<script>
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
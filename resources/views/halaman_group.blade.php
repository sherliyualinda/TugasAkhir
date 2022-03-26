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
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/group.css') }}">

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/> -->

</head>
<body style="overflow-y: auto;">
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
							<div class="col-lg-4" style="padding-right: 0px;">
								<aside class="sidebar static" style="margin-right: 0px;">
									<div class="widget static-widget stick-widget">
										<h4 class="widget-title">GROUP</h4>
										<ul class="naves">
											<li class="nav-item" style="margin-bottom: 0px;">
												<a class="nav-link active" href="/sosial-media/halaman_group" title="" style="padding-left: 0px;">Beranda</a>
												<!-- <button type="button" class="btn outline-secondary btn-sm btn-block" style="border-radius: 3px;">Beranda</button> -->
											</li>
											<!-- <li></li> -->
											<li class="nav-item" style="margin-bottom: 0px;">
												<button type="button" data-toggle="modal" data-target="#formBuatGrup" data-ripple="" class="btn outline-secondary btn-sm btn-block" style="border-radius: 3px;">Buat Grup Baru</button>
											</li>
										</ul>
										<div id="searchDir" style="padding-left: 25px; padding-right: 25px;"></div>
										<ul id="people-list" class="friendz-list" style="max-height: 200px;">
										@if($list_group)
											@foreach ($list_group as $row)
												<li>
													<figure>
														<img src="{{ url('/data_file/group/'.$row->nama_group.'/foto_sampul/'.$row->foto_sampul_group) }}" alt="" style="height: 45px; width: 45px; object-fit: cover;">
													</figure>
													<div class="friendz-meta">
														<a href="/sosial-media/halaman_group_detail/{{ $row->id_group }}" style="font-weight: 700;">{{ $row->nama_group }}</a>
														@foreach ($data_anggota as $row2)
															@if($row->id_group == $row2->id_group)
																<span style="font-size: 12px;">{{ $row2->jml_anggota }} anggota</span>
															@endif
														@endforeach
														@if($notif_group)
															@foreach ($notif_group as $j)
															  	@if($row->id_group == $j->id_group)
															  		<span class="badge pull-right align-self-center" style="margin-right: 5px;">{{ $j->jml }}</span>
															  	@endif
														  	@endforeach
													  	@endif
													</div>
												</li>
											@endforeach
										@else
											<li style="text-align: center; font-weight: bold;">Belum Bergabung Dengan Grup</li>
										@endif
										</ul>
									</div>
								</aside>
							</div><!-- sidebar -->
							<br>
							<div class="col-lg-7" style="padding-left: 20px;">
								@if($list_all_group)
									<div class="central-meta" style="padding: 20px;">
										<input class="form-control form-control-sm" id="tableSearch" type="text" placeholder="Cari Grup" style="border-radius: 3px;">
										<div class="form-group col-6" id="nama_prov2" style="margin-top: 0; margin-bottom: 15px; padding-left: 0;">
											<select class="form-control form-control-sm nama_prov2" name="nama_prov_cari" style="color: black;" required>
												<option disabled selected>-Pilih Provinsi-</option>
												@foreach ($province as $data)
													<option value="{{$data->name}}+++{{$data->id}}" style="text-transform: capitalize;"> {{ ucwords(html_entity_decode(strtolower($data->name))) }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-5" id="nama_kab2" style="margin-top: 0; margin-bottom: 15px; padding-left: 0;">
											<select class="form-control form-control-sm nama_kab2" name="nama_kab_cari" style="color: black;" required>
												<option disabled selected>-Pilih Kabupaten-</option>
											</select>
										</div>
										<div class="form-group col-5" id="nama_kec2" style="margin-top: 0; margin-bottom: 15px; padding-left: 0;">
											<select class="form-control form-control-sm nama_kec2" name="nama_kec_cari" style="color: black;" required>
												<option disabled selected>-Pilih Kecamatan-</option>
											</select>
										</div>
										<div class="form-group col-4" id="nama_des2" style="margin-top: 0; margin-bottom: 15px; padding-left: 0;">
											<select class="form-control form-control-sm nama_des2" name="nama_des_cari" style="color: black;" required>
												<option disabled selected>-Pilih Desa-</option>
											</select>
										</div>
										<button class="btn btn-sm btn-warning col-2" id="carigr" style="color: white; font-weight: bold;">Cari</button>
										<div class="row loadMore" style="overflow-y: auto; max-height: 450px;">
											@foreach ($list_all_group as $data)
												<div class="col-sm-6 data_grup item">
													<div class="card" style="margin-bottom: 20px;">
														<div class="card-body" style="background: #f5f5f5;">
															<img class="card-img-top" src="{{ url('/data_file/group/'.$data->nama_group.'/foto_sampul/'.$data->foto_sampul_group) }}" alt="" style="margin-bottom: 10px; height: 87px;">
															<a href="/sosial-media/halaman_group_detail/{{ $data->id_group }}"><h5 class="card-title" style="margin-bottom: 0px; color: black;">{{ $data->nama_group }}</h5></a>
															@foreach ($data_anggota_all_group as $data_anggota)
																@if ($data->id_group == $data_anggota->id_group)
																	<span style="font-size: 12px; padding-bottom: 12px;">{{ $data_anggota->jml_anggota }} anggota</span>
																@endif
															@endforeach
															<p class="card-text" style="margin-bottom: 0;">{{ $data->deskripsi_group }}</p>
															<small style="text-transform: capitalize; margin-bottom: 5px;"><i class="ti-location-pin" style="color: red; font-weight: bold;"></i>
																@if($data->nm_desa)
																	{{strtolower($data->nm_prov_2)}}, {{strtolower($data->nm_kab_2)}}, Kec. {{strtolower($data->nm_kec_2)}}, Desa {{strtolower($data->nm_desa)}}
																@elseif($data->nm_kab)
																	{{strtolower($data->nm_provK)}}, {{strtolower($data->nm_kab)}}
																@elseif($data->nm_prov)
																	{{strtolower($data->nm_prov)}}
																@endif
															</small>
															<a href="/sosial-media/gabung_grup/{{$data_anggota->id_group}}" class="btn btn-sm btn-primary btn-block">Gabung Grup</a>
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@else
									<div class="central-meta" style="padding: 20px; height: 400px;">
										<div class="row" style="position: relative; top: 35%;">
											<div class="col-sm-12" align="center">
												<div><i class="fa fa-group" style="border: 5px double;padding: 10px;border-radius: 50%;font-size: 30px;margin-bottom: 10px;"></i></div>
												<strong style="font-size: 16px;">Belum Ada Grup</strong>
											</div>
										</div>
									</div>
								@endif
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>
	<div class="modal fade" id="formBuatGrup" role="dialog">
	    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
	    	<form method="post" action="/sosial-media/buat_group_proses" enctype="multipart/form-data">
			{{ csrf_field() }}
		      	<div class="modal-content">
		      		<div class="modal-header" style="padding-top: 8px; padding-bottom: 8px;">
				        <h5 class="modal-title">Buat Group Baru</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
		        	<div class="modal-body" style="padding-top: 8px; padding-bottom: 8px;">
						<div class="form-group half" style="width: auto;">
							<figure class="foto_sampul align-self-center" style="margin-bottom: 0;">
								<img src="{{ asset('user.jpg') }}" alt="" style="height: 50px; border-radius: 50%;">
							</figure>
						</div>
						<div class="form-group half">
							<label for="foto_profil" style="left: 0; margin-bottom: 0;">Foto Sampul Group</label>
						  	<input type="file" id="foto_sampul" name="foto_sampul" required="required" accept="image/*"/>
						</div>
						<div class="form-group half" id="nama_prov">
							<select class="form-control nama_prov" name="nama_prov" style="color: black;" required>
								<option disabled selected>-- Pilih Provinsi --</option>
								@foreach ($province as $data)
									<option value="{{$data->name}}+++{{$data->id}}" style="text-transform: capitalize;"> {{ ucwords(html_entity_decode(strtolower($data->name))) }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group half" id="nama_kab">
							<select class="form-control nama_kab" name="nama_kab" style="color: black;" required>
								<option disabled selected>-- Pilih Kabupaten --</option>
							</select>
						</div>
						<div class="form-group half" id="nama_kec" style="margin-right: 0;">
							<select class="form-control nama_kec" name="nama_kec" style="color: black;" required>
								<option disabled selected>-- Pilih Kecamatan --</option>
							</select>
						</div>
						<div class="form-group half" id="nama_des" style="float: right; margin-right: 0;">
							<select class="form-control nama_des" name="nama_des" style="color: black;" required>
								<option disabled selected>-- Pilih Desa --</option>
							</select>
						</div>
		        		<div class="form-group">	
						  	<input type="text" id="input" name="nama_group" required="required"/>
						  	<label class="control-label" for="input" style="left: 0;">Nama Group</label><i class="mtrl-select"></i>
						</div>
						<div class="form-group">	
						  	<textarea rows="2" id="textarea" name="deskripsi_group" required="required" maxlength="70"></textarea>
						  	<label class="control-label" for="textarea" style="left: 0;">Deskripsi Group</label><i class="mtrl-select"></i>
						  	<span style="font-size: 12px; color: red;">*maks. 70 huruf</span>
						</div>
			      	</div>
			      	<div class="modal-footer" style="padding-top: 8px; padding-bottom: 8px;">
			      		<input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Submit"></input> 
			      	</div>
		      	</div>
		    </form>
	    </div>
	</div>

</div>	
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="{{ asset('js/group.js') }}"></script>
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
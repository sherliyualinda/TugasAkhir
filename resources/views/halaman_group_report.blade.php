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
    <link rel="stylesheet" type="text/css" href="{{asset('jquery-ui-1.12.1.custom/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slideshow.css') }}">
	<link rel="stylesheet" href="{{ asset('css/read-less-more.css') }}">
	<link rel="stylesheet" href="{{ asset('css/group-detail.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">

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
											</li>
											<li class="nav-item" style="margin-bottom: 0px;">
												<button type="button" data-toggle="modal" data-target="#formBuatGrup" data-ripple="" class="btn outline-secondary btn-sm btn-block" style="border-radius: 3px;">Buat Grup Baru</button>
											</li>
										</ul>
										<div id="searchDir" style="padding-left: 25px; padding-right: 25px;"></div>
										<ul id="people-list" class="friendz-list" style="max-height: 200px;">
										@if($list_group_user)
											@foreach ($list_group_user as $row)
												<li>
													<figure class="img_sampul_list{{$row->id_group}}">
														<img src="{{ url('/data_file/group/'.$row->nama_group.'/foto_sampul/'.$row->foto_sampul_group) }}" alt="" style="width: 45px; height: 45px; object-fit: cover;">
													</figure>
													<div class="friendz-meta">
														<a href="/sosial-media/halaman_group_detail/{{ $row->id_group }}" style="font-weight: 700;" class="nm_gr_list">{{ $row->nama_group }}</a>
														@foreach ($jml_anggota as $row2)
															@if($row2->id_group == $row->id_group)
																<span style="font-size: 12px;">{{ $row2->jml_anggota }} anggota</span>
															@endif
														@endforeach
														@if($notif_group)
															@foreach ($notif_group as $j)
															  	@if($row->id_group == $j->id_group)
															  		<span class="badge badge-danger pull-right align-self-center" style="margin-right: 5px;">{{ $j->jml }}</span>
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
							</div>
							<br>
							<div class="col-lg-7" style="padding-left: 20px;">
								<div class="central-meta" style="padding: 20px;">
									<section>
								    	@foreach ($kueri as $data)
										<div class="feature-photo">
											<figure class="img_sampul_grup">
												<img src="{{ url('/data_file/group/'.$data->nama_group.'/foto_sampul/'.$data->foto_sampul_group) }}" alt="" style="width: 1366px; height: 200px;">
											</figure>
											<?php $array = array();
												foreach($list_admin as $adm){
													$array[] = $adm->id_admin;
												}
											?>
											@if(in_array(auth()->user()->pengguna->id_pengguna, $array))
											<form class="edit-phto" style="bottom: 0px; left: 0px; height: 35px!important;" method="post" action="/sosial-media/ubah_foto_sampul">
												<i class="fa fa-camera-retro"></i>
												<label class="fileContainer">
													Ubah Foto Sampul
													<input type="file" name="foto_sampul_grup" id="ubah_sampul"/>
													<input type="hidden" name="id_group" value="{{$data->id_group}}" class="id_group"/>
													<input type="hidden" name="nama_group" value="{{$data->nama_group}}" class="nama_group"/>
												</label>
											</form>
											@endif
										</div>
										@break
										@endforeach
									</section>
									<section class="col-lg-4" style="padding-left: 0px;">
										<div style="padding-top: 15px;">
											<h4 id="nm_gr" style="color: black; margin-bottom: 0px; display:inline;">{{$data->nama_group}}</h4>
											@if(in_array(auth()->user()->pengguna->id_pengguna, $array))
												<i class="ti-pencil edit_nama" style="font-size: 12px; cursor: pointer;" title="Edit Nama Group" onclick="editNama({{$data->id_group}});"></i>
											@endif
											@foreach ($data_anggota as $data2)
												@if ($data->id_group == $data2->id_group)
													<span style="font-size: 12px; display: block;">{{$data2->jml_anggota}} anggota</span>
												@endif
											@endforeach
										</div>
									</section>
									<section class="col-lg-5" style="padding-left: 0px;">
										<div style="padding-top: 15px;">
											<div class="users-thumb-list" style="margin-top: 0px; text-align: right;">
											@foreach ($list_group as $row)
												<a href="/sosial-media/profil/{{$row->username}}" title="{{$row->nama}}" data-toggle="tooltip" style="display: inline-block; margin-left: -17px;">
													<img src="{{ $row->foto_profil != null ? url('/data_file/'.$row->username.'/foto_profil/'.$row->foto_profil) : asset('user.jpg') }}" style="border: 2px solid #fff; border-radius: 50%; width: 36px; height: 36px; object-fit: cover;">  
												</a>
											@endforeach
											</div>
										</div>
									</section>
									<section class="col-lg-3" style="padding-right: 0px;">
										<div style="padding-top: 15px; float: right;">
										<?php $array_anggota = array();
											foreach($list_group as $anggota){
												$array_anggota[] = $anggota->id_pengguna;
											}
										?>
										@if(in_array(auth()->user()->pengguna->id_pengguna, $array_anggota))
											<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalInvite"  style="position: relative;">Undang Teman</button>
											<div class="btn-group">
												<button type="button" class="btn btn-sm btn-primary" style="position: relative;" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
												<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
												    <!-- <button class="dropdown-item" type="button">Action</button> -->
												    <button class="dropdown-item" type="button"><a href="#" onclick="keluarGrup('{{ $data->id_group }}', '{{ $data->nama_group }}', '{{ $data->foto_sampul_group }}')" style="color: red;">Keluar Dari Group</a></button>
												    @if(in_array(auth()->user()->pengguna->id_pengguna, $array))
													<div class="dropdown-divider"></div>
												    <button class="dropdown-item" type="button" onclick="hapusGrup('{{ $data->id_group }}', '{{ $data->nama_group }}', '{{ $data->foto_sampul_group }}')" style="cursor: pointer; background: red; color: white">Hapus Group</button>
												    @endif
												</div>
											</div>
										@else
											<a href="/sosial-media/gabung_grup/{{$data->id_group}}"><button type="button" class="btn btn-sm btn-primary" style="position: relative;">Gabung Grup</button></a>
										@endif
										</div>
									</section>
								</div>
								<div class="modal fade" id="modalInvite" role="dialog">
								    <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
								      	<div class="modal-content">
									        <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
									          	<h6 class="modal-title">Undang Teman</h6>
									        </div>
							        		<div class="input-group flex-nowrap" id="cari_teman">
							        			<div class="input-group-prepend">
											    	<span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
											    		Ke: 
											    	</span>
												</div>
												<!-- <input type="text" class="form-control form-control-sm" placeholder="cari.." style="border-radius: 0rem;"> -->
												<div id="kolom_input_cari" style="width: 100%;"></div>
											</div>
											<form method="post" action="/sosial-media/undangan_grup_proses" enctype="multipart/form-data">
											{{csrf_field()}}
									        	<ul class="friendz-list list-group list-group-flush" style="margin-top: 0px; overflow-y: auto!important; max-height: 250px;" id="teman_yang_dicari">
										        	@if ($teman != NULL)
														@foreach ($teman as $data2)
														<div class="list-group list-group-flush" style="max-height: 315px;">
												        	<a class="list-group-item list-group-item-action" style="padding-right: 10px; padding-left: 10px;">
												        		<div class="input-group mb-3" style="margin-bottom: 0px;">
													        		<div class="media">
																		<img src="{{ $data2->foto_profil != null ? url('/data_file/'.$data2->username.'/foto_profil/'.$data2->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
																	  	<div class="media-body align-self-center">
																	  		<small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data2->username }}</small><br>
																	    	<small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data2->nama }}</small>
																	  	</div>
																	</div>
																	<div class="input-group-append" style="position: absolute;right: 0;top: 35%;">
																    	<!-- <div class="input-group-text" style="background-color: #fff; border-color: #fff;"> -->
																      		<input type="checkbox" name="pilih_teman[]" value="{{$data2->id_pengguna}}" aria-label="Checkbox for following text input">
																    	<!-- </div> -->
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
									        	<input type="hidden" name="id_group" value="{{$data->id_group}}"></input>
									        	<div class="modal-footer" style="padding: 8px;">
										      		<input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Submit"></input> 
										      	</div>
										    </form>
								      	</div>
								    </div>
								</div>
								<div class="col-lg-12 central-meta item">
									{{-- <div class="row" id="page-contents"> --}}
									<nav aria-label="breadcrumb" style="font-size: 14px;">
										<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="/sosial-media/halaman_group_detail/{{$data->id_group}}">Group</a></li>
										<li class="breadcrumb-item" aria-current="page" style="color: blue;">List Report</li>
										</ol>
									</nav>
									<small style="color: red; font-weight: bold;">Catatan:</small><br>
									<small>- klik pada <strong>badge kategori</strong> untuk melihat detil konten / comment yang di report</small><br>
									<small>- search berdasarkan <strong>Reported Username</strong> / <strong>Alasan</strong></small>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                                            <thead class="thead-light">
                                                <tr align="center">
                                                    <th>Tanggal</th>
                                                    <th>Kategori</th>
                                                    <th>Reported Username</th>
                                                    <th>Alasan</th>
                                                    <th>Reporter Username</th>
                                                <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
									{{-- </div> --}}
								</div>
								<div class="col-lg-12 central-meta item">
									<nav aria-label="breadcrumb" style="font-size: 14px;">
										<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="/sosial-media/halaman_group_detail/{{$data->id_group}}">Group</a></li>
										<li class="breadcrumb-item" aria-current="page" style="color: blue;">List Histori Report</li>
										</ol>
									</nav>
									<small style="color: red; font-weight: bold;">Catatan:</small><br>
									<small>- klik pada <strong>badge kategori</strong> untuk melihat detil konten / comment yang di report</small><br>
									<small>- search berdasarkan <strong>Reported Username</strong> / <strong>Alasan</strong></small>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0" style="font-size: 13px;">
                                            <thead class="thead-light">
                                                <tr align="center">
                                                    <th>Tanggal</th>
                                                    <th>Kategori</th>
                                                    <th>Reported Username</th>
                                                    <th>Alasan</th>
                                                    <th>Reporter Username</th>
													<th>Ket.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
									{{-- </div> --}}
								</div>
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
						  	<input type="file" id="foto_sampul" name="foto_sampul" required="required"/>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slideshow.js') }}"></script>
<script src="{{ asset('js/read-less-more.js') }}"></script>
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/group-report.js') }}"></script>
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

<script src="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
{{-- <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script> --}}
<script src="{{ asset('js/reports.js') }}"></script>
<script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	let id_group = {{ $kueri[0]->id_group }};
</script>
<script src="{{ asset('js/demo/datatables-action-group.js') }}"></script>
</body>	

</html>
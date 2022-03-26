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
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/chat.css') }}">
	<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

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
							<div class="central-meta col-lg-3" style="padding: 15px;">
								<div class="modal-header d-flex justify-content-left" style="padding: 0.75rem 0rem;">
						          <h6 class="modal-title"><a href="{{ asset('/sosial-media/chat') }}">Pesan</a></h6>
						          <a href="#" data-toggle="modal" data-target="#myModal" style="height: 24px;"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a>
						        </div>
								{{-- @if($list_chat) --}}
									<div class="input-group flex-nowrap" style="margin-top: 10px; margin-bottom: 10px;" id="cari">
										<!-- <input type="text" class="form-control" placeholder="cari pesan"> -->
										<div id="kolom_input" style="width: 100%;"></div>
										<div class="input-group-append">
											<span class="input-group-text" id="addon-wrapping">
												<i class="fa fa-search"></i>
											</span>
										</div>
									</div>
								{{-- @endif --}}
						        <div class="list-group list-group-flush" style="height: 339px; overflow-y: auto; max-height: 339px;" id="list_yang_dicari">
						        	@if($list_chat)
										@foreach ($list_chat as $list)
											<?php if(auth()->user()->pengguna->username == $list->username_pengirim) {
													$username_yang_tampil = $list->username_penerima;
											}else{
													$username_yang_tampil = $list->username_pengirim;
											} ?>
											<div class="list-hover" id="room_{{$list->id_room_chat}}">
												<a href="/sosial-media/chat/{{$list->id_room_chat}}" class="list-group-item list-group-item-action">
													<input type="hidden" name="id_room_chat" value="{{$list->id_room_chat}}"></input>
													<div class="media">
														@if(url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) == url('/data_file/'.$list->username_pengirim.'/foto_profil/'.$list->foto_pengirim))
															<img src="{{ $list->foto_penerima != null ? url('/data_file/'.$list->username_penerima.'/foto_profil/'.$list->foto_penerima) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 50px; height: 50px; border-radius: 50%;">
														@else
															<img src="{{ $list->foto_pengirim != null ? url('/data_file/'.$list->username_pengirim.'/foto_profil/'.$list->foto_pengirim) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 50px; height: 50px; border-radius: 50%;">
														@endif
														<div class="media-body align-self-center">
															<h6 class="mt-0" style="margin-bottom: 0rem; font-weight: 100; color: black;">{{ $username_yang_tampil }}</h6>
															@if($list->isi_chat != null)
																<small style="color: #989e99;">{{ strip_tags($list->isi_chat) }}</small>
															@else
																@if(auth()->user()->pengguna->username == $list->username_pengirim)
																	<small style="color: #989e99">Anda mengirim foto</small>
																@else
																	<small style="color: #989e99">{{ $list->username_pengirim }} mengirim foto</small>
																@endif
															@endif
															<small style="color: #989e99">-{{ date_format(date_create($list->tanggal_chat), "d M Y H:i") }}</small>
														</div>
														@foreach ($jumlah as $j)
															@if($list->id_room_chat == $j->id_room_chat)
																<span class="badge pull-right align-self-center" style="margin-right: 5px;">{{ $j->jml }}</span>
															@endif
														@endforeach
													</div>
												</a>
												<i class="ti-trash align-self-center" onclick="modalHapusRoomChat('{{ $list->id_room_chat }}', '{{ $username_yang_tampil }}')" style="cursor: pointer; color: red;" title="Hapus"></i>
											</div>
										@endforeach
									@else
										<div style="font-weight: bold; top: 25%; position: relative;" class="align-self-center">Belum Ada Pesan</div>
									@endif
						        </div>
							</div>
							<div class="central-meta item col-lg-7" style="padding: 15px;">
								@if(!isset($data_penerima))
									<div class="row" style="position: relative; top: 35%;">
										<div class="col-sm-12" align="center">
											<div><i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#myModal" style="border: 5px double;padding: 10px;border-radius: 50%;font-size: 30px;margin-bottom: 10px; cursor: pointer;"></i></div>
											<strong style="font-size: 16px;">Kirim Pesan Sekarang</strong>
										</div>
									</div>
						        @else
						        	<div class="modal-header d-flex justify-content-left" style="padding: 0.75rem 0rem;"> 
							        	<div class="media"> 
							        		<img src="{{ $data_penerima->foto_profil != null ? url('/data_file/'.$data_penerima->username.'/foto_profil/'.$data_penerima->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" style="width: 20px; height: 20px; border-radius: 50%;">
							        		<div class="media-body align-self-center">
							        			<a href="/sosial-media/profil/{{ $data_penerima->username }}" style="font-weight: 600">{{ $data_penerima->username }}</a>
							        		</div>
							        	</div>
							        	{{-- <i class="fa fa-info-circle" style="font-size:24px"></i> --}}
						        	</div>
						        	<div class="modal-body" style="height: 80%; overflow-y: auto; max-height: 347px;"></div>
						        	<div class="modal-footer align-items-end" style="padding: 0.5rem 0rem;">
						        		<div class="post-comt-box2" style="width:100%; padding-left:0;">
						        			<form method="post" action="/sosial-media/chat_proses" enctype="multipart/form-data">
						        			{{ csrf_field() }}
						        				<input type="hidden" name="username_penerima" value="{{ $data_penerima->username }}" class="penerima"></input>
						        				<input type="hidden" name="username_pengirim" value="{{ auth()->user()->pengguna->username }}"></input>
						        				<input type="hidden" name="id_pengguna" value="{{ auth()->user()->pengguna->id_pengguna }}"></input>
						        				<div class="input-group mb-3">
						        					<div class="input-group-prepend">
						        						<div class="attachments">
						        							<ul>
						        								<li>
						        									<i class="fa fa-image"></i>
						        									<label class="fileContainer">
						        										<input type="file" name="file_foto[]" id="pro-image" accept="image/*, video/*">
						        									</label>
						        								</li>
						        							</ul>
						        						</div>
						        					</div>
						        					<textarea  name="isi_chat" style="width: 93%; overflow-y: auto;" required></textarea>
						        					<button type="submit" class="btn btn-submit" style="border-radius: 3px;">Post</button>
						        				</div>
						        			</form>
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
	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
	      	<div class="modal-content">
		        <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
		          	<h6 class="modal-title">Buat Pesan Baru</h6>
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
	        	<ul class="friendz-list list-group list-group-flush" style="overflow-y: auto!important; max-height: 250px;" id="teman_yang_dicari">
		        	@if ($teman != NULL)
						@foreach ($teman as $data)
						<div class="list-group list-group-flush" style="max-height: 315px;">
				        	<!-- <a href="#" onclick="isiChatKosong('{{ url('/data_file/foto_profil/'.$data->foto_profil) }}', '{{ $data->username }}', '{{ Session::get('id_pengguna') }}', '{{ Session::get('username') }}')" class="list-group-item list-group-item-action" data-dismiss="modal" style="padding-left: 10px; padding-right: 10px;"> -->
				        	<a href="#" onclick="cek_chat('{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}', '{{ $data->username }}', '{{ auth()->user()->pengguna->id_pengguna }}', '{{ auth()->user()->pengguna->username }}')" class="list-group-item list-group-item-action" data-dismiss="modal" style="padding-left: 10px; padding-right: 10px;">
				        		<div class="media">
									<img src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
								  	<div class="media-body align-self-center">
								  		<small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data->username }}</small><br>
								    	<small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data->nama }}</small>
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
	      	</div>
	    </div>
	</div>

</div>		
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/chat.js') }}"></script>
<script type="text/javascript">
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
			window.location.href = window.location.origin+"/sosial-media/profil/" + username;
			return false;
		}
	})
	.data("ui-autocomplete")._renderItem = function (ul, item) {
		return $("<li>")
			.append("<div class='media'><img src='" + item.icon + "' class='align-self-center mr-3' alt='...' style='width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;'> <div class='media-body align-self-center'> <small style='font-weight: 700; color: black; margin-bottom: 0rem;'>" + item.value + "</small><br><small class='mt-0' style='margin-bottom: 0rem; font-weight: 500; color: #989e99;'>" + item.label + "</small>")
			.appendTo(ul);
	};

});

function isiChatKosong(foto_profil, username_penerima, id_pengguna_pengirim, username_pengirim) {
    let html = '';
    html += '<div class="modal-header d-flex justify-content-left" style="padding: 0.75rem 0rem;"> <div class="media"> <img src="' + foto_profil + '" class="align-self-center mr-3" style="width: 20px; height: 20px; border-radius: 50%;"><div class="media-body align-self-center"><a href="/sosial-media/profil/' + username_penerima + '" style="font-weight: 600">' + username_penerima + '</a></div></div></div><div class="modal-body" style="height: 80%; overflow-y: auto; max-height: 347px;"></div><div class="modal-footer align-items-end" style="padding: 0.5rem 0rem;"><div class="post-comt-box2" style="width:100%; padding-left:0;"><form method="post" action="/sosial-media/chat_proses" enctype="multipart/form-data">{{ csrf_field() }}<input type="hidden" name="username_penerima" value="' + username_penerima + '" class="penerima"></input><input type="hidden" name="username_pengirim" value="' + username_pengirim + '"></input><input type="hidden" name="id_pengguna" value="' + id_pengguna_pengirim + '"></input><div class="input-group mb-3"><div class="input-group-prepend"><div class="attachments"><ul><li><i class="fa fa-image"></i><label class="fileContainer"><input type="file" name="file_foto[]" id="pro-image" accept="image/*, video/*"></label></li></ul></div></div><textarea  name="isi_chat" style="width: 93%; overflow-y: auto;" required></textarea><button type="submit" class="btn btn-submit" style="border-radius: 3px;">Post</button></div></form></div></div>';
    $('.col-lg-7').html(html);

    $('#pro-image').on('change', function () {
        var formData = new FormData();
        var files = $('#pro-image')[0].files[0];
        formData.append('gambar', files);
        var username_penerima = $('.penerima').val();
        formData.append('username_penerima', username_penerima);
        var url = window.location.origin+"/sosial-media/chat_proses";
        $.ajax({
            url: url,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
            },
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                if (response.length !== 0) {
                    for (var i = 0; i < response.length; i++) {
                        window.location.href = window.location.origin+"/sosial-media/chat/" + response[i].id_room_chat;
                    }
                }
            }
        });
    });
}

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
//                 // $('#jml_notif').remove();
//             }
//         }
//     });
// });
</script>
</body>	

</html>
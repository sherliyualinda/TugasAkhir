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
    
	<link rel="stylesheet" href="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/css/color.css') }}">
	<link rel="stylesheet" href="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/css/responsive.css') }}">

</head>
<style type="text/css">
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.form-radio label {
	font-size: 15px;
}

.form-radio>.radio {
	width: 40%;
}

.radio .check-box::after, .radio .check-box::before {
	top: 3px;
}

.radio input:checked~.check-box::before {
    color: #4682B4;
}

.radio .check-box::after {
	/*background-color: #088dcd;
    border-color: #088dcd;*/
    background-color: #4682B4;
    border-color: #4682B4;
}

select.form-control{
	border-bottom: 1px solid #ced4da;
	border-radius: 0px;
	color: #b7b7b7;
	margin-top: 5px;
	margin-bottom: 5px;
}

.chosen-container {
	/*border: 1px solid #ced4da;*/
	/*border-radius: 0.25rem;*/
	/*padding-right: 15px;*/
}

.chosen-single {
	color: #b7b7b7;
	text-transform: capitalize;
}

.chosen-container-single .chosen-single {
	border-width: 0 0 0;
	padding: 0 0 0 0;
	border-bottom: 1px solid #ced4da;
	/*border-radius: 0.25rem;*/
	color: #b7b7b7;
	background: white;
}

.chosen-container-single .chosen-single span {
	margin-left: 5px;
	color: #2a2a2a;
    font-size: 1rem;
}

.chosen-container .chosen-results li.highlighted {
	background-color: #358f66;
	background-image: -webkit-gradient(linear, 50% 0, 50% 100%, color-stop(20%, #358f61), color-stop(90%, #358f66));
    background-image: -webkit-linear-gradient(#358f61 20%, #358f66 90%);
    background-image: -moz-linear-gradient(#358f61 20%, #358f66 90%);
    background-image: -o-linear-gradient(#358f61 20%, #358f66 90%);
    background-image: linear-gradient(#358f61 20%, #358f66 90%);
}

.form-control:focus{
	border-color: #ced4da;
	box-shadow: none;
}

.help-block{
	font-size: 10px;
	color: red;
}

select.form-control:not([size]):not([multiple]) {
    text-transform: capitalize;
}

.form-group{
	margin-top: 10px;
	margin-bottom: 10px;
}

.land-featureareaa{
	background-color: #4682B4;
	
}
.content{
	background-color: #4682B4;
	padding:20px;
	margin-top: 80px;
	margin-left: 140px;
	width:400px;
	color: white;
	
}

</style>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	<div class="container-fluid pdng0">
		<div class="row merged">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 land-featureareaa">
				<div class="content">
					
						{{-- <div class="friend-logo">
							<span><img src="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/images/wink.png') }}" alt=""></span>
						</div> --}}
						<center><img src="/Diessnie-logo.png" style="width: 100%; object-fit: cover;">
						<h3 style="font-size: 30px;">Digital Business Millenial Village</h3></center>
						{{-- <a href="#" title="" class="folow-me">Follow Us on</a> --}}
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-reg-bg">
					<div class="log-reg-area sign">
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
						<h2 class="log-title">Login</h2>
							<form method="post" action="{{ route('login')}}">
							{{ csrf_field() }}
							<div class="form-group">	
							  	<input type="email" name="email" id="input" class="form-control form-control-sm @error('email') is-invalid @enderror" required="required"/>
							  	<label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
							  	@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">	
							  	<input type="password" name="password" required="required" id="myInput" class="form-control form-control-sm @error('password') is-invalid @enderror"><span class="fa fa-eye field-icon" id="pass_login_icon" onclick="myFunction()"></span>
							  	<label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
								@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							<a href="/sosial-media/reset-password" title="" class="forgot-pwd">Lupa Password?</a>
							<div class="submit-btns" style="margin-top: 0px;">
								<button class="mtr-btn" type="submit" style="color: #4682B4"><span>Login</span></button>
								<button class="mtr-btn signup" type="button" style="color: #4682B4"><span>Register</span></button>
							</div>
						</form>
					</div>
					<div class="log-reg-area reg">
						<h2 class="log-title">Register</h2>
							<form method="post" action="/sosial-media/register_proses" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-radio" id="akun_desa">
							  	<div class="radio">
									<label>
								  		<input type="radio" name="jenis_akun" class="jenis" value="desa" checked/><i class="check-box"></i>Akun Desa
									</label>
							  	</div>
							  	<div class="radio">
									<label>
								  		<input type="radio" name="jenis_akun" class="jenis" value="pribadi"/><i class="check-box"></i>Akun Pribadi
									</label>
							  	</div>
							</div>
							<!--<div id="link1">-->
							<div class="form-group" id="nama_prov">
									<select class="form-control form-control-sm nama_prov" name="nama_prov" style="color: black;" required>
										<option disabled selected>-- Pilih Provinsi --</option>
										@foreach ($provinces as $data)
											<option value="{{$data->name}}+++{{$data->id}}" style="text-transform: capitalize;"> {{ ucwords(html_entity_decode(strtolower($data->name))) }}</option>
										@endforeach
									</select>
								</div>
								<!-- <div class="form-group" id="nama_kab">
									<select class="form-control form-control-sm nama_kab" name="nama_kab" style="color: black;" required>
										<option disabled selected>-- Pilih Kota / Kabupaten --</option>
										@foreach ($regency as $data)
											<option value="{{$data->name}}+++{{$data->id}}" style="text-transform: capitalize;"> {{ ucwords(html_entity_decode(strtolower($data->name))) }}</option>
										@endforeach
									</select>
								</div> -->
								<div class="form-group" id="nama_kab">
									<select class="form-control form-control-sm nama_kab" name="nama_kab" style="color: black;" required>
										<option disabled selected>-- Pilih Kabupaten/Kota --</option>
									</select>
								</div>
								<div class="form-group half" id="nama_kec">
									<select class="form-control form-control-sm nama_kec" name="nama_kec" style="color: black;" required>
										<option disabled selected>-- Pilih Kecamatan --</option>
									</select>
								</div>
								<div class="form-group half" id="nama_des" style="float:right; margin-right:0;">
									<select class="form-control  form-control-sm nama_des" name="nama_desa" style="color: black;" required>
										<option disabled selected>-- Pilih Desa --</option>
									</select>
								</div>
							<!--</div>-->
							<div id="link2" style="display: none;">
								<div class="form-group" id="input_nama">
									<input type="text" name="nama_pribadi" class="form-control form-control-sm nama_pribadi"/>
									<label class="control-label" for="input">Nama</label>
									<i class="mtrl-select"></i>
								</div>
							</div>
							<div class="form-group">	
							  	<input type="email" required="required" name="email" class="form-control form-control-sm field_email" onkeyup="check_email()"/>
							  	<label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
								<small id="err_msg_email" style="color: red;"></small>
							</div>
							<div class="form-group half">	
							  	<label>Foto Profil</label>
								<input type="file" name="foto_prof" accept="image/*" required>
							</div>
							<div class="form-group half" style="float:right; margin-right:0;">	
							  	<label>Foto Sampul</label>
								<input type="file" name="foto_samp" accept="image/*" required>
							</div>
							<div class="form-group half">	
							  	<input type="text" required="required" name="username" class="field_uname" onkeyup="check_username()"/>
							  	<label class="control-label" for="input">Username</label><i class="mtrl-select"></i>
								<small id="err_msg" style="color: red;"></small>
							</div>
							<div class="form-group half" style="float:right; margin-right:0;">	
							  	<input type="number" required="required" name="nomor_hp" class="form-control form-control-sm"/>
							  	<label class="control-label" for="input">Nomor HP</label><i class="mtrl-select"></i>
							</div>
							<div class="form-group half">	
							  	<input type="password" required="required" name="password" id="txt_password" minlength="8" class="form-control form-control-sm"/>
							  	<span class="fa fa-eye field-icon" id="pass_icon" onclick="myFunction2()"></span>
							  	<label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
							</div>
							<div class="form-group half" style="float:right; margin-right:0;">	
							  	<input type="password" required="required" name="konfirmasi_password" id="txt_konfirmasi" class="form-control form-control-sm"/>
							  	<span class="fa fa-eye field-icon" id="pass_konf_icon" onclick="myFunction3()"></span>
							  	<label class="control-label" for="input">Konfirmasi Password</label><i class="mtrl-select"></i>
							</div>
							<div class="submit-btns" style="margin-top: 0px;">
								<button type="submit" class="mtr-btn" id="btnSubmit" style="color: #4682B4"><span>Register</span></button>
								<a href="#" title="" class="already-have" style="float: right; margin-top: 10px;">Sudah Punya Akun</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script type="text/javascript">
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

	$(function () {
        $("#btnSubmit").click(function () {
            var password = $("#txt_password").val();
            var confirmPassword = $("#txt_konfirmasi").val();
            if (password != confirmPassword) {
                $('#txt_password').css('background', '#FAEBD7');
                $('#txt_konfirmasi').css('background', '#FAEBD7');
                alert("Password tidak sesuai.");
                return false;
            }
            return true;
        });
    });

    function myFunction() {
	  var x = document.getElementById("myInput");
	  if (x.type === "password") {
	    x.type = "text";
	    document.getElementById('pass_login_icon').className = "fa fa-eye-slash field-icon";
	  } else {
	    x.type = "password";
	    document.getElementById('pass_login_icon').className = "fa fa-eye field-icon";
	  }
	}

	function myFunction2() {
	  var x = document.getElementById("txt_password");
	  if (x.type === "password") {
	    x.type = "text";
	    document.getElementById('pass_icon').className = "fa fa-eye-slash field-icon";
	  } else {
	    x.type = "password";
	    document.getElementById('pass_icon').className = "fa fa-eye field-icon";
	  }
	}

	function myFunction3() {
	  var x = document.getElementById("txt_konfirmasi");
	  if (x.type === "password") {
	    x.type = "text";
	    document.getElementById('pass_konf_icon').className = "fa fa-eye-slash field-icon";
	  } else {
	    x.type = "password";
	    document.getElementById('pass_konf_icon').className = "fa fa-eye field-icon";
	  }
	}

	window.setTimeout(function() {
	    $(".alert").fadeTo(500, 0).slideUp(500, function(){
	        $(this).remove(); 
	    });
	}, 2000);

</script>
<script type="text/javascript">

	$('.jenis').on('change', function() {
    	let tmp = $(this).val();
      	if (tmp == 'pribadi'){
      		$('#link1').hide('slow');
      		$('#link2').show('slow');
      		$('.nama_pribadi').attr('required', '');
      		// document.getElementById("link1").style.display = "none";
      		// document.getElementById("link2").style.display = "block";
      	}else{
      		$('#link2').hide('slow');
      		$('#link1').show('slow');
      		$('.nama_pribadi').removeAttr('required');
      		// document.getElementById("link1").style.display = "block";
      		// document.getElementById("link2").style.display = "none";
      	}
    });

	
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$('.nama_prov').on('change', function () {
		var value = $(this).val();
		console.log(id);
		const myArr = value.split("+++");
		var id = myArr[1];
		console.log(id);
		$.ajax({
			url: "/sosial-media/login/get-regency/" + id,
			type: 'get',
			data: {
				_token: CSRF_TOKEN
			},
			success: function (data) {
				let html = '';
				console.log(html);
				if (data.length !== 0) {
					for (var i = 0; i < data.length; i++) {
						html += '<option value="Kab. ' + data[i].name + '+++' + data[i].id + '"' +
							' style="text-transform: capitalize;" class="appended_kab">' +
							'Kab. ' + data[i].name.toLowerCase() + '</option>';
						// $('.nama_kec').html(html);
						// console.log(data[i].name);
					}
				}
				// document.getElementById("nama_kec").style.display = "block";
				$('.appended_kab').remove();
				$('.nama_kab').append(html);
				// $('.chosen-results').append(html);
			    
			}
		});
	});


	$('.nama_kab').on('change', function () {
		var value = $(this).val();
		console.log(id);
		const myArr = value.split("+++");
		var id = myArr[1];
		console.log(id);
		$.ajax({
			url: "/sosial-media/login/get-district/" + id,
			type: 'get',
			data: {
				_token: CSRF_TOKEN
			},
			success: function (data) {
				let html = '';
				console.log(html);
				if (data.length !== 0) {
					for (var i = 0; i < data.length; i++) {
						html += '<option value="Kec. ' + data[i].name + '+++' + data[i].id + '"' +
							' style="text-transform: capitalize;" class="appended_kec">' +
							'Kec. ' + data[i].name.toLowerCase() + '</option>';
						// $('.nama_kec').html(html);
						console.log(data.length);
					}
				}
				// document.getElementById("nama_kec").style.display = "block";
				$('.appended_kec').remove();
				$('.nama_kec').append(html);
				// $('.chosen-results').append(html);
				// console.log(html);
			}
		});
	});

	$('.nama_kec').on('change', function () {
		var value = $(this).val();
		// console.log(id);
		const myArr = value.split("+++");
		var id = myArr[1];
		// console.log(id);
		$.ajax({
			url: "/sosial-media/login/get-village/" + id,
			type: 'get',
			data: {
				_token: CSRF_TOKEN
			},
			success: function (data) {
				let html = '';
				if (data.length !== 0) {
					for (var i = 0; i < data.length; i++) {
						html += '<option value="Desa ' + data[i].name + '+++' + data[i].id + '"' +
							' style="text-transform: capitalize;" class="appended_des">' +
							'Desa ' + data[i].name.toLowerCase() + '</option>';
						// $('.nama_kec').html(html);
						// console.log(data[i].name);
					}
				}
				// document.getElementById("nama_kec").style.display = "block";
				$('.appended_des').remove();
				$('.nama_des').append(html);
				// $('.chosen-results').append(html);
				// console.log(html);
			}
		});
	});
</script>

</body>	

</html>
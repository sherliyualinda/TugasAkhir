<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Sosial Media Desaku</title>
    <link rel="icon" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/images/fav.png') }}" type="image/png" sizes="16x16"> 
    
	<link rel="stylesheet" href="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/css/color.css') }}">
	<link rel="stylesheet" href="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/sweetalert2.min.css') }}">

</head>
<style type="text/css">
.form-control:focus{
	border-color: #ced4da;
	box-shadow: none;
}

ul#parsley-id-5.parsley-errors-list.filled{
	padding-left: 0!important;
}
ul{
	list-style-type: none;
}
</style>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	<div class="container-fluid pdng0">
		<div class="row merged">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="land-featurearea">
					<div class="land-meta">
						<h1>DESAFEED</h1>
						<div class="friend-logo">
								<span><img src="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/images/wink.png') }}" alt=""></span>
						</div>
						{{-- <a href="#" title="" class="folow-me">Follow Us on</a> --}}
					</div>	
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
						<h2 class="log-title">Reset Password</h2>
						<form class="form-reset" id="form-reset">
							{{ csrf_field() }}
							<div class="form-group">	
							  	<input type="email" required="" name="email" 
							  	data-parsley-errors-container="#email_fix" 
							  	data-parsley-type="email" 
							  	data-parsley-type-message="Gunakan format email, contoh: tes@gmail.com" 
							  	data-parsley-required-message="Email belum diisi."/>
							  	<label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
							</div>
							<div id="email_fix" style="font-size: 12px; color: red; padding-left: 0!important;"></div>
							<div class="form-group">	
							  	<input type="password" required="required" name="password" id="txt_password" />
							  	<span class="fa fa-eye field-icon" onclick="myFunction2()"></span>
							  	<label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
							</div>
							<div class="form-group">	
							  	<input type="password" required="required" name="konfirmasi_password" id="txt_konfirmasi"/>
							  	<span class="fa fa-eye field-icon" onclick="myFunction3()"></span>
							  	<label class="control-label" for="input">Konfirmasi Password</label><i class="mtrl-select"></i>
							</div>
						</form>
						<div class="submit-btns" style="margin-top: 0px;">
							<button type="button" id="btn-kirim-link" class="mtr-btn" id="btnSubmit" style="color: #358f66"><span>Reset Password</span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="{{ asset('/js/parsley.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
	function myFunction2() {
	  var x = document.getElementById("txt_password");
	  if (x.type === "password") {
	    x.type = "text";
	  } else {
	    x.type = "password";
	  }
	}

	function myFunction3() {
	  var x = document.getElementById("txt_konfirmasi");
	  if (x.type === "password") {
	    x.type = "text";
	  } else {
	    x.type = "password";
	  }
	}
</script>

</body>	

</html>
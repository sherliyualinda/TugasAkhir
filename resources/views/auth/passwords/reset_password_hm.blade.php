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
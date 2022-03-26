<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Sosial Media Desaku</title>
	<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 

    {{-- <link rel="icon" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/images/fav.png') }}" type="image/png" sizes="16x16">  --}}
    
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

.parsley-errors-list{
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
						<h1 style="font-size: 80px;">DESAFEED</h1>
						{{-- <div class="friend-logo">
								<span><img src="{{ asset('/Winku-Social-Network-Corporate-Responsive-Template/images/wink.png') }}" alt=""></span>
						</div> --}}
						<img src="/logo-home-1.png" style="width: 40%; object-fit: cover;">
						{{-- <a href="#" title="" class="folow-me">Follow Us on</a> --}}
					</div>	
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-reg-bg">
					<div class="log-reg-area sign">
						@if (session('status'))
	                        <div class="alert alert-success">
	                            {{ session('status') }}
	                        </div>
	                    @endif

						<h2 class="log-title">Reset Password</h2>
						<form class="form-reset" id="form-reset" method="POST" action="{{ route('password.email') }}">
							{{ csrf_field() }}
							<div class="form-group">	
							  	<input type="email" required="" name="email" 
							  	data-parsley-errors-container="#email_fix" 
							  	data-parsley-type="email" 
							  	data-parsley-type-message="Gunakan format email, contoh: tes@gmail.com" 
							  	data-parsley-required-message="Email harus diisi."/>
							  	<label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
							</div>
							<div id="email_fix" style="font-size: 12px; color: red; padding-left: 0!important;"></div>
							@if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
						<div class="submit-btns" style="margin-top: 0px;">
							<button type="submit" id="btn-kirim-linkaa" class="mtr-btn" style="color: #358f66"><span>Kirim Link Reset Password</span></button>
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
<script src="{{ asset('/js/parsley.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
	$('#form-reset').parsley().validate();
	// $('#btn-kirim-link').on('click', function(){
	// 	if($('#form-reset').parsley().isValid()){
	// 		let timerInterval
	// 		kirim_email();
	// 		Swal.fire({
	// 		  title: 'Sedang Dikirim!',
	// 		  html: 'Silahkan tunggu beberapa detik.',
	// 		  timer: 6200,
	// 		  timerProgressBar: true,
	// 		  didOpen: () => {
	// 		    Swal.showLoading()
	// 		    timerInterval = setInterval(() => {
	// 		      const content = Swal.getHtmlContainer()
	// 		      if (content) {
	// 		        const b = content.querySelector('b')
	// 		        if (b) {
	// 		          b.textContent = Swal.getTimerLeft()
	// 		        }
	// 		      }
	// 		    }, 100)
	// 		  },
	// 		  willClose: () => {
	// 		    clearInterval(timerInterval)
	// 		  }
	// 		}).then((result) => {
	// 		  if (result.dismiss === Swal.DismissReason.timer) {
	// 		    console.log('I was closed by the timer')
	// 		  }
	// 		})
	// 	}else{
	// 		swal.fire('Email Tidak Valid');
	// 	}
	// });

	// function kirim_email(){
	// 	let formDatas = $('#form-reset').get(0);
 //        let formProg = new FormData(formDatas);
	// 	$.ajax({
	// 		url: "{{ route('password.email') }}",
	// 		method: "post",
	// 		processData: false,
	// 		contentType: false,
	// 		data: formProg,
	// 		success: function() {
	// 			swal.fire({
	// 				icon: 'success',
	// 				text: 'Link reset password telah dikirimkan ke email Anda'
	// 			});
	// 		}
	// 	});
	// }
</script>

</body>	

</html>
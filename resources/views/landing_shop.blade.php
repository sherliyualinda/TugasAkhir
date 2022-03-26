<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Sosial Media Desaku</title>
	<link rel="icon" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/images/fav.png') }}" type="image/png" sizes="16x16"> 
	<!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
	<!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
    
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
	<link rel="stylesheet" href="{{ asset('css/profil.css') }}">

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		@include('theme.nav_bar')
	</nav>
    
    <section>
        <div class="ext-gap bluesh high-opacity">
            <div class="content-bg-wrap" style="{{ asset('sampul.jpg') }}" style="width: 1366px; height: 200px; object-fit: cover;"></div>
        </div>
	</section>
	<section>
        <div class="gap100" style="padding: 20px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-page">
                            <div class="row">
                            @if ($api_product != NULL)
                                @foreach ($api_product as $api)
                                    <div class="col-4">
                                        <div class="product-box">
                                            <figure>
                                                <span class="new">New</span>
                                                @foreach ($api['galleries'] as $api_gbr)
                                                    <img src="http://marketpalcedesaku.masuk.web.id/storage/{{ $api_gbr['photos'] }}" style="height: 261px; widht: 261px; object-fit: cover;" alt="">
                                                    @if($loop->iteration == 1)
                                                    @break
                                                    @endif
                                                @endforeach
                                            </figure>
                                            <div class="product-name" style="padding-bottom: 5px; text-align: left">
                                                <h5><a href="#" title="">{{ $api['name'] }}</a></h5>
                                                <div class="prices">
                                                    <ins>Rp{{ number_format($api['price']) }}</ins>
                                                </div>
                                            </div>
                                            <a href="http://marketpalcedesaku.masuk.web.id/details/{{ $api['slug'] }}" target="_blank">
                                                <button type="button" class="btn btn-sm btn-warning btn-block" style="position: relative; float: left; font-weight: bold; color: white;padding-bottom: 1px; padding-top: 1px; border-radius: 0;">Lihat</button>
                                            </a>
                                        </div>
                                    </div>
                                    @if($loop->iteration == 6)
                                    @break
                                    @endif
                                @endforeach 
                            @else
                                <div class="col-lg" style="padding-bottom:15px;">
                                    <strong style="font-size: 16px;">Belum Ada Produk</strong>
                                </div>
                            @endif
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
<script src="{{ asset('js/read-less-more.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#notif').click(function() {
    	$.ajax({
            url:"{{route('sosial-media.update_notif')}}",
            type: 'post',
            // dataType: "json",
            data: {
               _token: CSRF_TOKEN
            },
            success: function( data ) {
               	if(document.getElementById("jml_notif")){
               		document.getElementById("jml_notif").style.visibility = "hidden";
               	}
            }
        });
    });
</script>
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.min.js') }}"></script>
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
           window.location.href = "http://127.0.0.1:8000/sosial-media/profil/"+username;
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
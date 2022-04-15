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
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slideshow.css') }}">
	<link rel="stylesheet" href="{{ asset('css/read-less-more.css') }}">
	<link rel="stylesheet" href="{{ asset('css/halaman-beranda.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/> -->

</head>
<body id="bodies" style="overflow-y: auto;">
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		@include('nav_barMar')
	</nav>
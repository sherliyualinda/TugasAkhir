<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DIESSNIE</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<style>
 * {
	padding:0;
	margin:0;
	font-family: sans-serif;
    
}
a {
	color: inherit;
	text-decoration: none;
}
.medsos {
	padding:5px 0;
	background-color: #148F77;
}
.medsos ul li {
	display: inline-block;
	color: #fff;
	margin-right: 10px;
}
.container {
width:80%;
	margin:0 auto;
    background-color: #4682B4;
}

.container:after {
	content:'';
	display: block;
	clear: both;
}
header h1 {
	float: left;
	padding:15px 0;
	color: #148F77;
}
header ul {
	float: right;
}
header ul li {
	display: inline-block;
}
header ul li a {
	padding:25px 20px;
	display: inline-block;
}
header ul li a:hover {
	background-color: white;
	
}
.active {
    size: ;
	background-color: white;
	
}
.banner {
	height: 60vh;
	background-image: url('../img/banner.jpg');
	background-size: cover;
	position: relative;
	display: flex;
	justify-content: center;
	align-items: center;
}
.banner:after {
	content:'';
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: rgba(20, 143, 119, .6);
}
.banner h2 {
	color: #fff;
	z-index: 1;
	padding: 20px 25px;
	border:3px solid #fff;
}
section {
	padding:50px 0;
}
section h3 {
	text-align: center;
	padding:20px 0;
	color: #148F77;
	margin-bottom: 25px;
}
.about,
.service {
	padding-bottom: 100px;
    background-color: white;
}
.about p {
	color: #666;
	word-spacing: 2px;
	line-height: 25px;
	margin-bottom: 20px;
	text-align: center;
}
.service {
	background-color: #f9f9f9;
}
.box {
	color: white;
}
.box:after {
	content: '';
	display: block;
	clear: both;
}
.box .col-4 {
	width:25%;
	padding:20px;
	box-sizing: border-box;
	text-align: center;
	float: left;
}
.icon {
	width:70px;
	height:70px;
	border:1px solid;
	border-radius: 50%;
	text-align: center;
	line-height: 70px;
	font-size: 20px;
	margin:0 auto;
}
.box .col-4 h4 {
	margin:20px 0;
}
footer {
	padding:30px 0;
	background-color: #333;
	color: #fff;
	text-align: center;
}
.bg-loader {
	background-color: #eee;
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 9999;
	display: flex;
	justify-content: center;
	align-items: center;
}
.bg-loader .loader {
	width:100px;
	height: 100px;
	border:3px solid #fff;
	border-radius: 50%;
	border-top-color: #148F77;
	border-right-color: #148F77;
	border-bottom-color: #148F77;
	animation: puterin .8s linear infinite;
}
.label {
	background-color: #148F77;
	color: #fff;
}
@keyframes puterin {
	100% {
		transform: rotate(360deg);
	}
}
@media screen and (max-width: 768px){
	.container {
		width:90%;
	}
	header h1 {
		text-align: center;
		float: none;
	}
	header ul {
		text-align: center;
		float: none;
	}
	.box .col-4 {
		width:100%;
		float: none;
		margin-bottom: 20px;
	}
}
</style>
<body>
	<!-- loader -->
	<div class="bg-loader">
		<div class="loader"></div>
	</div>

	<!-- header -->
	
	<header style="background-color: #4682B4;">
		<div class="container">
        <img src="/Diessnie-logo.png" style="max-height: 70px;">
			
			<ul>
				<li class="active"><a href=""><p> Home</p></a></li>
				<li><a href=""><p> Home</p></a></li>
				<li><a href=""><p> Home</p></a></li>
				<li><a href=""><p> Home</p></a></li>
			</ul>
		</div>
	</header>

	<!-- banner -->
	<section class="banner">
		<h2>WELCOME TO MY WEBSITE</h2>
	</section>

	<!-- about -->
	<section class="about">
		<div class="container">
			<h3>ABOUT</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</strong>, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>
		</div>
	</section>

	<!-- service -->
	<section class="service">
		<div class="container">
			<h3>SERVICE</h3>
			<div class="box">
				<div class="col-4">
					<div class="icon"><i class="fas fa-mobile"></i></div>
					<h4>MOBILE APP</h4>
				</div>
				<div class="col-4">
					<div class="icon"><i class="fas fa-globe"></i></div>
					<h4>WEB DEVELOPMENT</h4>
				</div>
				<div class="col-4">
					<div class="icon"><i class="fas fa-edit"></i></div>
					<h4>DESIGN</h4>
				</div>
				<div class="col-4">
					<div class="icon"><i class="fas fa-chart-bar"></i></div>
					<h4>DIGITAL MARKETING</h4>
				</div>
			</div>
		</div>
	</section>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2020 - Dzulfikar. All Rights Reserved.</small>
		</div>
	</footer>


	<script type="text/javascript">
		$(document).ready(function(){
			$(".bg-loader").hide();
		})
	</script>
</body>
</html>
<!-- <!DOCTYPE html>

<style>
	*{
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
}

body{
  overflow-x: hidden;
}

nav .left img{
  width: 90px;
}

nav{
  display: flex;
  justify-content: space-between;
  min-height: 80px;
  align-items: center;
  border-bottom: 1px solid #DCDCDC;
  padding: 0px 5% 0px 5%;
}

nav .right a{
	text-decoration: none;
	color: black;
}

.slides{
	width: 100%;
	height: 20%;
  	position: relative;
	margin-left: auto;
	margin-right: auto;
 
}


.slides .slide{
  display: none;
   
   
}


.slides .slide img{
  width: 100%;
  height: 0%;
  animation-name: fade;
  animation-duration: 1.5s;
}

.slides .navigation{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.slides .navigation .prev, .slides .navigation .next{
  cursor: pointer;
  padding: 16px;
  font-weight: bold;
  font-size: 20px;
  color: white;
  background: rgba(0,0,0,0.2);
  user-select: none;
  transition: 0.6s ease;
}

.slides .navigation .prev:hover, .slides .navigation .next:hover{
  background: rgba(0,0,0,1);
}

@keyframes fade {
  from{opacity: 0.3}
  to {opacity: 1}
}
@media (max-width: 992px){
  .slides .navigation .prev, .slides .navigation .next{
    font-size: 18px;
    padding: 13px;
  }
}

@media (max-width: 768px){
  .slides .navigation .prev, .slides .navigation .next{
    font-size: 15px;
    padding: 10px;
  }
}

@media (max-width: 576px){
  .slides .navigation .prev, .slides .navigation .next{
    font-size: 12px;
    padding: 7px;
  }
}

@media (max-width: 360px){
  .slides .navigation .prev, .slides .navigation .next{
    font-size: 11px;
    padding: 6px;
  }
}
</style>



<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Responsive Slideshow</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
  </head>
  <body>
    <nav>
      <div class="left">
        <img src="/Diessnie-logo.png" alt="">
      </div>
      <div class="right">
		  <a href="">About Aplikasi |</a>
        <a href="">About Us |</a>
        <a href="">Login</a>
      </div>
    </nav>

    <div class="slides" >
      <div class="slide">
    
		 <img src="/ssawah.jpg" alt="">
	  
      </div>
      <div class="slide">
        <img src="/sawit.jpg" alt="">
      </div>
      <div class="slide">
        <img src="/ikan.jpg" alt="">
      </div>
      <div class="slide">
        <img src="/sapi.png" alt="">
      </div>
      <div class="slide">
        <img src="/padi1.jpg" alt="">
      </div>
      <div class="navigation">
        <a class = "prev" onclick = "plusSlides(-1)">&#10094;</a>
        <a class = "next" onclick = "plusSlides(-1)">&#10095;</a>
      </div>
    </div>
	<div class="contain1">
		<center>
			<h1>Aplikai Diessnie</h1><br>
			<h4> Digital Bussiness Millenial Village</h4><br>
		</center>
		
		<table>
			<tr>
				<td>					
					<div class="card-body">
					<img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
						<h4 class="card-title">Desa Feed</h4>
						<p class="card-text">Merupakan fitur yang digunakan untuk dapat saling berkomunikasi antara 1 dengan yang lain seperti halnya sosial media desa</p>
					</div>
				</td>
				<td>
					
					<div class="card-body">
					<img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
						<h4 class="card-title">Desa Store</h4>
						<p class="card-text">Merupakan fitur yang digunakan untuk menjual barang/hasil dari UMKM desa</p>
					</div>
				</td>
				<td>
					<div class="card-body">
					<img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
						<h4 class="card-title">Desa Tube</h4>
						<p class="card-text">Merupakan fitur yang digunakan untuk mengunggah video-video yang dihasilkan</p>
					</div>
				</td>
				<td>
					<div class="card-body">
					<img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
						<h4 class="card-title">Desa Tour</h4>
						<p class="card-text">Merupakan fitur yang digunakan untuk penanaman modal dari orang kota ke pertanian, perkebunan, perikanan yang dijalankan di desa</p>
					</div>
				</td>
			</tr>
		</table>
			
	</div>
	<div class="content">
		<h1>Diessnie</h1><br>
		

	</div>

    <script>
      var slideIndex = 1;
      showSlides(slideIndex);

      function plusSlides(n) {
        showSlides(slideIndex += n);
      }

      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("slide");
        if (n > slides.length)
        {
          slideIndex = 1;
        }
        if (n < 1)
        {
          slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++)
        {
          slides[i].style.display = "none";
        }
        slides[slideIndex-1].style.display = "block";
      }
    </script>
  </body>
</html> -->


<!DOCTYPE html>

<html lang="en">

<style>
	*{
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
}

body{
  overflow-x: hidden;
}

nav .left img{
  width: 90px;
}

nav{
  display: flex;
  justify-content: space-between;
  min-height: 80px;
  align-items: center;
  border-bottom: 1px solid #DCDCDC;
  padding: 0px 5% 0px 5%;
}

nav .right a{
	text-decoration: none;
	color: black;
}

.slides{
	width: 100%;
	height: 20%;
  	position: relative;
	margin-left: auto;
	margin-right: auto;
 
}


.slides .slide{
  display: none;
   
   
}


.slides .slide img{
  width: 100%;
  height: 0%;
  animation-name: fade;
  animation-duration: 1.5s;
}

.slides .navigation{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.slides .navigation .prev, .slides .navigation .next{
  cursor: pointer;
  padding: 16px;
  font-weight: bold;
  font-size: 20px;
  color: white;
  background: rgba(0,0,0,0.2);
  user-select: none;
  transition: 0.6s ease;
}

.slides .navigation .prev:hover, .slides .navigation .next:hover{
  background: rgba(0,0,0,1);
}

@keyframes fade {
  from{opacity: 0.3}
  to {opacity: 1}
}
@media (max-width: 992px){
  .slides .navigation .prev, .slides .navigation .next{
    font-size: 18px;
    padding: 13px;
  }
}

@media (max-width: 768px){
  .slides .navigation .prev, .slides .navigation .next{
    font-size: 15px;
    padding: 10px;
  }
}

@media (max-width: 576px){
  .slides .navigation .prev, .slides .navigation .next{
    font-size: 12px;
    padding: 7px;
  }
}

@media (max-width: 360px){
  .slides .navigation .prev, .slides .navigation .next{
    font-size: 11px;
    padding: 6px;
  }
}



.carousel-item img{
    opacity: 0.6;
}
.nav-icon{
    background: #1b1b1b;
    width: 3.8rem;
    height:  3.8rem;
    border-radius: 50%;
    border: 0;
    opacity: 0.7;
    text-shadow: none;
    color: #fff;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
}
.nav-icon:hover{
    background-color:  #000;
    opacity: 1.0;
    transition: all ease 0.3s;
    color: #fff;
}
.carousel-indicators li{
    border-radius: 50%;
    width: .8rem;
    height:  .8rem;
    background: transparent;
    border: solid 2px  #1b1b1b;
}
</style>



<head>
    <title>Template Web Responsive dengan Bootstrap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css2/bootstrap.min.css">
    
    <script src="assets/js2/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="index.html">
        <img src="/Diessnie-logo.png" alt="logo" style="width:100px;">
    </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Pemrograman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Database</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Framework</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Lainnya</a>
            </li>
        </ul>
    </div>
</nav>
<div class="jumbotron text-center">
<div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/ssawah.jpg" alt="First slide">
                     
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/sawit.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/sapi.png" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <div class="nav-icon">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </div>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <div class="nav-icon">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </div>
            </a>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="artikel.html"><img src="gambar/HTML_&_CSS.png" width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                    <h3>Belajar HTML & CSS</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris</p>
                    <p><a href="artikel.html" class="btn btn-light btn-block" role="button">Selengkapnya</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="artikel.html"><img src="gambar/Programming.png" width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                    <h3><a href="artikel.html" style="text-decoration:none;color: black;">Web Programming</a> </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris</p>
                    <p><a href="artikel.html" class="btn btn-light btn-block" role="button">Selengkapnya</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="artikel.html"><img src="gambar/Python.png" width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                    <h3>Belajar Python</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris</p>
                    <p><a href="artikel.html" class="btn btn-light btn-block" role="button">Selengkapnya</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="artikel.html"><img src="gambar/Desain_UI_&_UX.png"  width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                    <h3>Desain UI & UX</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris</p>
                    <p><a href="artikel.html" class="btn btn-light btn-block " role="button">Selengkapnya</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="jumbotron text-center" style="margin-bottom:0">
    <p>Copyright 2020 kelasprogrammer.com</p>
</div>
</body>
</html>
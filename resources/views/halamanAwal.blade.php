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



/* .carousel-item img{
    opacity: 0.6;
} */
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
/* .carousel-indicators li{
    border-radius: 50%;
    width: .8rem;
    height:  .8rem;
    background: transparent;
    border: solid 2px  #1b1b1b;
} */
.navbar{
  background-color: #4682B4;
}
.jumbotron1{
  background-color: #F2F3F4;
  padding-top: 3%;
  padding-bottom: 3%;
}
.nav-link{
  color: white;
  text-align: right;
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
<nav class="navbar navbar-expand-md  navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="index.html">
        <img src="/Diessnie-logo.png" alt="logo" style="width:60px;">
    </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#aplikasi"> About Application</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#team">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/login')}}" target="_blank">Login</a>
            </li>
        </ul>
    </div>
</nav>
<div class="jumbotron1">
<div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" height="500"  src="/ssawah.jpg" alt="First slide">
                     
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" height="500" src="/sawit.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" height="500" src="/sapi.png" alt="Third slide">
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

<!-- tentang aplikasi -->
<div class="container" id="aplikasi">
        <center>
          <h1>Aplikasi Diessnie</h1>
          <h4> Digital Bussiness Millenial Village</h4><br>
        </center>
    <div class="row">
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="artikel.html"><img src="/ssawah.jpg" width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                <center><h3><a href="artikel.html" style="text-decoration:none;color: black ;">Desa Feed</a> </h3></center>
                    <p align='justify'>Merupakan fitur yang dapat digunakan untuk saling berkomunikasi antara satu dengan yang lain seperti halnya sosial media desa</p>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="artikel.html"><img src="/ssawah.jpg" width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                    <center><h3><a href="artikel.html" style="text-decoration:none;color: black ;">Desa Store</a> </h3></center>
                    <p align='justify'>Merupakan fitur yang digunakan untuk menjual barang/hasil dari UMKM desa</p>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="artikel.html"><img src="/ssawah.jpg" width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                <center><h3><a href="artikel.html" style="text-decoration:none;color: black ;">Desa Tour</a> </h3></center>
                    <p align='justify'>Merupakan fitur yang digunakan untuk penanaman modal dari orang kota ke pertanian, perkebunan, perikanan yang dijalankan di desa</p>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="artikel.html"><img src="/ssawah.jpg"  width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                <center><h3><a href="artikel.html" style="text-decoration:none;color: black ;">Desa Tube</a> </h3></center>
                    <p align='justify'>Merupakan fitur yang digunakan untuk mengunggah video-video yang dihasilkan</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team aplikasi -->
<div class="jumbotron" id="team">
  <div class="text-center container" style="margin-bottom:0">
          <center>
            <h1>Application Team From Diessnie</h1><br>
          </center>
          <div class="row">
            <div class="col-sm-3 ">
                <div class="thumbnail ">
                  <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;">
                  <img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Fakhrunnisa Nur Afra</h5>
                    <p class="card-text">Full Stack Developer</p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email : </li>
                    <li class="list-group-item">IG :</li>
                    
                  </ul>
                </div>
                </div>
            </div>
            <div class="col-sm-1 ">
              <div class="thumbnail ">
              </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                  <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;">
                  <img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Riswan Ardinata</h5>
                    <p class="card-text">Full Stack Developer</p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email : </li>
                    <li class="list-group-item">IG :</li>
                    
                  </ul>
                </div>
                </div>
            </div>
            <div class="col-sm-1 ">
              <div class="thumbnail ">
              </div>
            </div>
            <div class="col-sm-3 ">
                <div class="thumbnail">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;">
                  <img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Yusril Wahyuda</h5>
                    <p class="card-text">Full Stack Developer</p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email : </li>
                    <li class="list-group-item">IG :</li>
                    
                  </ul>
                </div>
                </div>
            </div>
          </div>
  </div>
  <div class="text-center container" style="margin-bottom:0">
          <div class="row">
            <div class="col-sm-3">
              <div class="thumbnail">
              <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;">
                  <img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Sherla Yualinda</h5>
                    <p class="card-text">Full Stack Developer</p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email : </li>
                    <li class="list-group-item">IG :</li>
                    
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-1 ">
                <div class="thumbnail">
                </div>
            </div>
            <div class="col-sm-3">
              <div class="thumbnail">
              <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;">
                  <img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Sherli Yualinda</h5>
                    <p class="card-text">Full Stack Developer</p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email : </li>
                    <li class="list-group-item">IG :</li>
                    
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                </div>
            </div>           
            <div class="col-sm-3 ">
            <div class="thumbnail">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;">
                  <img class="card-img-top" src="/ssawah.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Gifari Abi Waqqosh</h5>
                    <p class="card-text">Full Stack Developer</p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email : </li>
                    <li class="list-group-item">IG :</li>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
  </div>
</div>
<div class="container">
<center>
  <p>Copyright Juli 2022 @Diessnie</p>
</center>
</div>


</body>
</html>
<!DOCTYPE html>

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
</html>
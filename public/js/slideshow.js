/* SLIDESHOW ALL PAGE */
var jml = $('.all').length;
var b=0;
var arr_index = new Array();
for(var j = 1; j <= jml; j++){
	arr_index[b] = 1;
	b++;
}

var a=0;
var arr = new Array();
for(var j = 1; j <= jml; j++){
	arr[a] = "mySlides"+j;
	a++;
}

var slideIndex = arr_index;
var slideId = arr;

for(var j = 0; j < jml; j++){
	showSlides(1, j);
}

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  var i;
  var x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {
  	slideIndex[no] = 1
  }    
  if (n < 1) {
  	slideIndex[no] = x.length
  }
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}

/* SLIDESHOW FOLLOWING PAGE */
var jmlFlw = $('.allFlw').length;

var bFlw=0;
var arr_indexFlw = new Array();
for(var jFlw = 1; jFlw <= jmlFlw; jFlw++){
  arr_indexFlw[bFlw] = 1;
  bFlw++;
}

var aFlw=0;
var arrFlw = new Array();
for(var jFlw = 1; jFlw <= jmlFlw; jFlw++){
  arrFlw[aFlw] = "mySlidesFlw"+jFlw;
  aFlw++;
}

var slideIndexFlw = arr_indexFlw;
var slideIdFlw = arrFlw;
// console.log(slideIdFlw);

for(var j = 0; j < jmlFlw; j++){
  showSlidesFlw(1, j);
}

function plusSlidesFlw(n, no) {
  showSlidesFlw(slideIndexFlw[no] += n, no);
}

function showSlidesFlw(n, no) {
  var i;
  var x = document.getElementsByClassName(slideIdFlw[no]);
  if (n > x.length) {
    slideIndexFlw[no] = 1
  }    
  if (n < 1) {
    slideIndexFlw[no] = x.length
  }
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndexFlw[no]-1].style.display = "block";  
}

/* SLIDESHOW EDIT */
// var slideIndexSl = $('.editSlide').length;
// showSlidesSl(slideIndexSl);

// function plusSlidesSl(n) {
//   showSlidesSl(slideIndexSl += n);
// }

// function showSlidesSl(n) {
//   var i;
//   var x = document.getElementsByClassName('mySlidesEd');
//   if (n > x.length) {
//     slideIndexSl = 1
//   }    
//   if (n < 1) {
//     slideIndexSl = x.length
//   }
//   for (i = 0; i < x.length; i++) {
//      x[i].style.display = "none";  
//   }
//   x[slideIndexSl-1].style.display = "block";  
// }
$(function () {
    $("#upload_link").on('click', function (e) {
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });
});

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("activee");
        // var panel = this.nextElementSibling;
        // if (panel.style.maxHeight) {
        //   panel.style.maxHeight = null;
        // } else {
        //   panel.style.maxHeight = panel.scrollHeight + "px";
        // } 
    });
}

$(window).resize(function () {
    if ($(window).width() < 992) {
        $('.desa-col').removeClass('col');
        $('.desa-col').addClass('col-12');
        $('.box-size').css('width', '300px');
        $('.box-size').css('margin-bottom', '5px');
        $('#container_search').css('width', '100%');
        $('.box-search').css('padding-right', '0');
        $('.box-search').css('padding-left', '0');
    } else {
        $('.desa-col').removeClass('col-12');
        $('.desa-col').addClass('col');
        $('.box-size').css('width', '850px');
        $('.box-size').css('margin-bottom', '');
        $('#container_search').css('width', '');
        $('.box-search').css('padding-right', '15px');
        $('.box-search').css('padding-left', '15px');
    }
});

$(document).ready(function () {
    if ($(window).width() < 992) {
        $('.desa-col').removeClass('col');
        $('.desa-col').addClass('col-12');
        $('.box-size').css('width', '300px');
        $('.box-size').css('margin-bottom', '5px');
        $('#container_search').css('width', '100%');
        $('.box-search').css('padding-right', '0');
        $('.box-search').css('padding-left', '0');
    } else {
        $('.desa-col').removeClass('col-12');
        $('.desa-col').addClass('col');
        $('.box-size').css('width', '850px');
        $('.box-size').css('margin-bottom', '');
        $('#container_search').css('width', '');
        $('.box-search').css('padding-right', '15px');
        $('.box-search').css('padding-left', '15px');
    }
});
$(function () {
    $("#btnSubmit").click(function () {
        var password = $("#pass_baru").val();
        var confirmPassword = $("#konfirmasi_pass").val();
        if (password != confirmPassword) {
            $('#txt_password').css('background', '#FAEBD7');
            $('#txt_konfirmasi').css('background', '#FAEBD7');
            alert("Password tidak sesuai.");
            return false;
        }
        return true;
    });
});

function myFunction() {
    var x = document.getElementById("pass_lama");
    if (x.type === "password") {
        x.type = "text";
        document.getElementById('pass_lama_icon').className = "fa fa-eye-slash field-icon";
    } else {
        x.type = "password";
        document.getElementById('pass_lama_icon').className = "fa fa-eye field-icon";
    }
}

function myFunction2() {
    var x = document.getElementById("pass_baru");
    if (x.type === "password") {
        x.type = "text";
        document.getElementById('pass_baru_icon').className = "fa fa-eye-slash field-icon";
    } else {
        x.type = "password";
        document.getElementById('pass_baru_icon').className = "fa fa-eye field-icon";
    }
}

function myFunction3() {
    var x = document.getElementById("konfirmasi_pass");
    if (x.type === "password") {
        x.type = "text";
        document.getElementById('pass_konf_icon').className = "fa fa-eye-slash field-icon";
    } else {
        x.type = "password";
        document.getElementById('pass_konf_icon').className = "fa fa-eye field-icon";
    }
}

window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

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
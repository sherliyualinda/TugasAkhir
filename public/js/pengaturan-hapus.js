function myFunction() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
        document.getElementById('pass_icon').className = "fa fa-eye-slash field-icon";
    } else {
        x.type = "password";
        document.getElementById('pass_icon').className = "fa fa-eye field-icon";
    }
}

window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

$('#alasan').on('change', function () {
    let alasan_tmp = $(this).val();
    if (alasan_tmp !== null && alasan_tmp !== "") {
        getTeks();
    }
});

function getTeks() {
    var d = new Date();
    d.setMonth(d.getMonth() + 2);

    var bulan = '';
    if (d.getMonth() == 1) {
        bulan = "Januari";
    } else if (d.getMonth() == 2) {
        bulan = "Februari";
    } else if (d.getMonth() == 3) {
        bulan = "Maret";
    } else if (d.getMonth() == 4) {
        bulan = "April";
    } else if (d.getMonth() == 5) {
        bulan = "Mei";
    } else if (d.getMonth() == 6) {
        bulan = "Juni";
    } else if (d.getMonth() == 7) {
        bulan = "Juli";
    } else if (d.getMonth() == 8) {
        bulan = "Agustus";
    } else if (d.getMonth() == 9) {
        bulan = "September";
    } else if (d.getMonth() == 10) {
        bulan = "Oktober";
    } else if (d.getMonth() == 11) {
        bulan = "November";
    } else if (d.getMonth() == 12) {
        bulan = "Desember";
    }

    $(".pass-label").text('Masukkan password');
    let html_pass = '';
    html_pass += '<input type="password" name="password" class="form-control" id="pass"><span class="fa fa-eye field-icon" id="pass_icon" onclick="myFunction()"></span>';
    $(".col-sm-9").html(html_pass);

    let html = '';
    // html += '<small style="margin-top: 10px;"> Jika melanjutkan, profil dan detail akun Anda akan dihapus pada <strong>' + d.getDate() + ' ' + bulan + ' ' + d.getFullYear() + '</strong>. Anda tidak akan bisa dilihat di Desafeed <strong> mulai sekarang hingga tanggal tersebut</strong>. Jika berubah pikiran, Anda bisa login kembali sebelum tanggal penghapusan dan memilih untuk menyimpan akun Anda.</small><br><small><b>Anda akan otomatis ter-logout ketika men-submit ini.</b></small>';
    html += '<small style="margin-top: 10px;"> Jika melanjutkan, profil dan detail akun Anda akan dihapus. Jika berubah pikiran, Anda bisa login kembali.</small><br><small><b>Anda akan otomatis ter-logout ketika men-submit ini.</b></small>';
    $('#teks').html(html);
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
$(document).ready(function () {
    $("#tableSearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".data_grup").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
// $('#notif_group').click(function () {
//     $.ajax({
//         url: "{{route('sosial-media.update_notif_group')}}",
//         type: 'post',
//         // dataType: "json",
//         data: {
//             _token: CSRF_TOKEN
//         },
//         success: function (data) {
//             if (document.getElementById("jml_notif_group")) {
//                 document.getElementById("jml_notif_group").style.visibility = "hidden";
//             }
//         }
//     });
// });

$(document).ready(function () {
    document.getElementById('foto_sampul').addEventListener('change', readImage2, false);

    $(".foto_sampul").sortable();
});

var num = 0;

function readImage2() {
    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".foto_sampul");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;

            var picReader = new FileReader();

            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                var html = '<img src="' + picFile.result + '" alt="" style="height: 50px;">';

                // output.append(html);
                output.html(html);
                num = num + 1;
            });

            picReader.readAsDataURL(file);
        }
    } else {
        console.log('Browser not support');
    }
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

$('.nama_prov').on('change', function () {
    var value = $(this).val();
    // console.log(id);
    const myArr = value.split("+++");
    var id = myArr[1];
    // console.log(id);
    $.ajax({
        url: "/sosial-media/get-regency/" + id,
        type: 'get',
        data: {
            _token: CSRF_TOKEN
        },
        success: function (data) {
            let html = '';
            if (data.length !== 0) {
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].name + '+++' + data[i].id + '"' +
                        ' style="text-transform: capitalize;" class="appended_kab">' +
                        data[i].name.toLowerCase() + '</option>';
                    // $('.nama_kec').html(html);
                    // console.log(data[i].name);
                }
            }
            // document.getElementById("nama_kec").style.display = "block";
            $('.appended_kab').remove();
            $('.nama_kab').append(html);
            // $('.chosen-results').append(html);
            // console.log(html);
        }
    });
});

$('.nama_kab').on('change', function () {
    var value = $(this).val();
    // console.log(id);
    const myArr = value.split("+++");
    var id = myArr[1];
    // console.log(id);
    $.ajax({
        url: "/sosial-media/get-district/" + id,
        type: 'get',
        data: {
            _token: CSRF_TOKEN
        },
        success: function (data) {
            let html = '';
            if (data.length !== 0) {
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="Kec. ' + data[i].name + '+++' + data[i].id + '"' +
                        ' style="text-transform: capitalize;" class="appended_kec">' +
                        'Kec. ' + data[i].name.toLowerCase() + '</option>';
                    // $('.nama_kec').html(html);
                    // console.log(data[i].name);
                }
            }
            // document.getElementById("nama_kec").style.display = "block";
            $('.appended_kec').remove();
            $('.nama_kec').append(html);
            // $('.chosen-results').append(html);
            // console.log(html);
        }
    });
});

$('.nama_kec').on('change', function () {
    var value = $(this).val();
    // console.log(id);
    const myArr = value.split("+++");
    var id = myArr[1];
    // console.log(id);
    $.ajax({
        url: "/sosial-media/get-village/" + id,
        type: 'get',
        data: {
            _token: CSRF_TOKEN
        },
        success: function (data) {
            let html = '';
            if (data.length !== 0) {
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="Desa ' + data[i].name + '+++' + data[i].id + '"' +
                        ' style="text-transform: capitalize;" class="appended_desa">' +
                        'Desa ' + data[i].name.toLowerCase() + '</option>';
                    // $('.nama_kec').html(html);
                    // console.log(data[i].name);
                }
            }
            // document.getElementById("nama_kec").style.display = "block";
            $('.appended_desa').remove();
            $('.nama_des').append(html);
            // $('.chosen-results').append(html);
            // console.log(html);
        }
    });
});

$('.nama_prov2').on('change', function () {
    var value = $(this).val();
    // console.log(id);
    const myArr = value.split("+++");
    var id = myArr[1];
    // console.log(id);
    $.ajax({
        url: "/sosial-media/get-regency/" + id,
        type: 'get',
        data: {
            _token: CSRF_TOKEN
        },
        success: function (data) {
            let html = '';
            if (data.length !== 0) {
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].name + '+++' + data[i].id + '"' +
                        ' style="text-transform: capitalize;" class="appended_kab2">' +
                        data[i].name.toLowerCase() + '</option>';
                    // $('.nama_kec').html(html);
                    // console.log(data[i].name);
                }
            }
            // document.getElementById("nama_kec").style.display = "block";
            $('.appended_kab2').remove();
            $('.nama_kab2').append(html);
            // $('.chosen-results').append(html);
            // console.log(html);
        }
    });
});

$('.nama_kab2').on('change', function () {
    var value = $(this).val();
    // console.log(id);
    const myArr = value.split("+++");
    var id = myArr[1];
    // console.log(id);
    $.ajax({
        url: "/sosial-media/get-district/" + id,
        type: 'get',
        data: {
            _token: CSRF_TOKEN
        },
        success: function (data) {
            let html = '';
            if (data.length !== 0) {
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="Kec. ' + data[i].name + '+++' + data[i].id + '"' +
                        ' style="text-transform: capitalize;" class="appended_kec2">' +
                        'Kec. ' + data[i].name.toLowerCase() + '</option>';
                    // $('.nama_kec').html(html);
                    // console.log(data[i].name);
                }
            }
            // document.getElementById("nama_kec").style.display = "block";
            $('.appended_kec2').remove();
            $('.nama_kec2').append(html);
            // $('.chosen-results').append(html);
            // console.log(html);
        }
    });
});

$('.nama_kec2').on('change', function () {
    var value = $(this).val();
    // console.log(id);
    const myArr = value.split("+++");
    var id = myArr[1];
    // console.log(id);
    $.ajax({
        url: "/sosial-media/get-village/" + id,
        type: 'get',
        data: {
            _token: CSRF_TOKEN
        },
        success: function (data) {
            let html = '';
            if (data.length !== 0) {
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="Desa ' + data[i].name + '+++' + data[i].id + '"' +
                        ' style="text-transform: capitalize;" class="appended_desa2">' +
                        'Desa ' + data[i].name.toLowerCase() + '</option>';
                    // $('.nama_kec').html(html);
                    // console.log(data[i].name);
                }
            }
            $('.appended_desa2').remove();
            // document.getElementById("nama_kec").style.display = "block";
            $('.nama_des2').append(html);
            // $('.chosen-results').append(html);
            // console.log(html);
        }
    });
});

$("#carigr").on("click", function () {
    // var value = $(this).val().toLowerCase();
    var prov = $('.nama_prov2').val();
    if (prov != null) {
        var data_prov = prov.split('+++');
        var nm_prov = data_prov[0].toLowerCase();
    }

    var kab = $('.nama_kab2').val();
    if (kab != null) {
        var data_kab = kab.split('+++');
        var nm_kab = data_kab[0].toLowerCase();
    }

    var kec = $('.nama_kec2').val();
    if (kec != null) {
        var data_kec = kec.split('+++');
        var nm_kec = data_kec[0].toLowerCase();
    }

    var desa = $('.nama_des2').val();
    if (desa != null) {
        var data_desa = desa.split('+++');
        var nm_desa = data_desa[0].toLowerCase();
    }
    $(".data_grup").filter(function () {
        if (nm_prov != null && nm_kab != null && nm_kec != null && nm_desa != null) {
            var txt = nm_prov + ', ' + nm_kab + ', ' + nm_kec + ', ' + nm_desa;
            // console.log(txt);
            $(this).toggle($(this).text().toLowerCase().indexOf(txt) > -1);
        } else if (nm_prov != null && nm_kab != null && nm_kec != null) {
            var txt = nm_prov + ', ' + nm_kab + ', ' + nm_kec;
            // console.log(txt);
            $(this).toggle($(this).text().toLowerCase().indexOf(txt) > -1);
        } else if (nm_prov != null && nm_kab != null) {
            var txt = nm_prov + ', ' + nm_kab;
            // console.log(txt);
            $(this).toggle($(this).text().toLowerCase().indexOf(txt) > -1);
        } else if (nm_prov != null) {
            var txt = nm_prov;
            // console.log(txt);
            $(this).toggle($(this).text().toLowerCase().indexOf(txt) > -1);
        }
    });
});
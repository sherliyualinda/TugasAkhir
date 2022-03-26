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

function keluarGrup(id_group, nama, foto_sampul) {
    Swal.fire({
        title: '<span style="font-size:18px;"> Keluar Group </span>',
        html: '<small>Apakah Anda yakin ingin keluar dari group ini?</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Keluar Dari Group',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = window.location.origin + "/sosial-media/keluar_group_proses/" + id_group;
        }
    })
}

function hapusGrup(id_group) {
    Swal.fire({
        title: '<span style="font-size:18px;"> Hapus Group </span>',
        html: '<small>Apakah Anda yakin ingin hapus group ini? Semua data group akan dihapus.</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Hapus Group',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = window.location.origin + "/sosial-media/hapus_group_proses/" + id_group;
        }
    })
}

function countCharsEdit(obj) {
    var maxLength = 500;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if (charRemain < 0) {
        document.getElementById("charNumEdit").innerHTML = '<span style="color: red;">You have exceeded the limit of ' + maxLength + ' characters</span>';
    } else {
        document.getElementById("charNumEdit").innerHTML = charRemain + '/500';
    }
}

$(document).ready(function () {
    $('#ubah_sampul').on('change', function () {
        var formData = new FormData();
        // console.log(formData);
        var files = $('#ubah_sampul')[0].files[0];
        formData.append('gambar', files);
        var id_group = $('.id_group').val();
        formData.append('id_group', id_group);
        var nama_group = $('.nama_group').val();
        formData.append('nama_group', nama_group);
        var url = "/sosial-media/ubah_foto_sampul";
        $.ajax({
            url: url,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
            },
            // cache:false,
            // dataType:"json",
            contentType: false,
            processData: false,
            data: formData,
            success: function () {
                // console.log("success");
                // location.reload();
                let html = '';
                html += '<img src="' + window.location.origin + '/data_file/group/' + nama_group + '/foto_sampul/' + files.name + '" alt="" style="width: 1366px; height: 200px;">';

                let html_list = '';
                html_list += '<img src="' + window.location.origin + '/data_file/group/' + nama_group + '/foto_sampul/' + files.name + '" alt="" style="width: 45px; height: 45px; object-fit: cover;">';

                $('.img_sampul_grup').html(html);
                $('.img_sampul_list' + id_group).html(html_list);
            }
        });
    });
});

window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

(
    function ($) {
        // custom css expression for a case-insensitive contains()
        jQuery.expr[':'].Contains = function (a, i, m) {
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

        function listFilter(cari_teman, list) {
            var form = $("<form>").attr({
                    "class": "filterform",
                    "action": "#"
                }),
                input = $("<input>").attr({
                    "class": "filterinput form-control",
                    "type": "text",
                    "placeholder": "Cari",
                    "style": "border-radius:0"
                });
            $(form).append(input).appendTo(kolom_input_cari);

            $(input)
                .change(function () {
                    var filter = $(this).val();
                    if (filter) {
                        $(list).find("a:not(:Contains(" + filter + "))").slideUp();
                        $(list).find("a:Contains(" + filter + ")").slideDown();
                    } else {
                        $(list).find("a").slideDown();
                    }
                    return false;
                })
                .keyup(function () {
                    $(this).change();
                });
        }


        //search friends widget
        $(function () {
            listFilter($("#cari_teman"), $("#teman_yang_dicari"));
        });
    }(jQuery)
);

function countChars(obj) {
    var maxLength = 500;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if (charRemain < 0) {
        document.getElementById("charNum").innerHTML = '<span style="color: red;">You have exceeded the limit of ' + maxLength + ' characters</span>';
    } else {
        document.getElementById("charNum").innerHTML = charRemain + '/500';
    }
}

function countCharsEdit(obj) {
    var maxLength = 500;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if (charRemain < 0) {
        document.getElementById("charNumEdit").innerHTML = '<span style="color: red;">You have exceeded the limit of ' + maxLength + ' characters</span>';
    } else {
        document.getElementById("charNumEdit").innerHTML = charRemain + '/500';
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

function countCharsEditDesc(obj) {
    var maxLength = 70;
    var strLength = obj.value.length;
    // console.log(strLength);
    var charRemain = (maxLength - strLength);

    if (charRemain < 0) {
        document.getElementById("charNumEditDesc").innerHTML = '<span style="color: red;">You have exceeded the limit of ' + maxLength + ' characters</span>';
    } else {
        document.getElementById("charNumEditDesc").innerHTML = charRemain + '/70';
    }
}

function editNama(id_group) {
    var txt = document.getElementById("nm_gr").textContent;
    // console.log(txt);
    let html = '';
    html += '<input type="text" name="nama_group" class="form-control form-control-sm updated_nama" value="' + txt + '" style="border-radius: 0;">' +
        '<button type="btn btn-sm" style="background:#358f66; color: white; border: medium none; font-size: 11px; font-weight: bold;" onclick="updNama(' + id_group + ');"> Update </button> <button type="btn btn-sm" style="background:gold; color: black; border: medium none; font-size: 11px; font-weight: bold;" onclick="cancel2(`' + txt + '`);"> Cancel </button>';

    $('#nm_gr').html(html);
    $('.edit_nama').css('display', 'none');
}

function updNama(id_group) {
    var formData = new FormData();
    var id_group = id_group;
    formData.append('id_group', id_group);
    var nama_group = $('.updated_nama').val();
    formData.append('nama_group', nama_group);
    $.ajax({
        url: '/sosial-media/edit-nama-group',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        },
        contentType: false,
        processData: false,
        data: formData,
        success: function (data_updated) {
            if (data_updated.length !== 0) {
                for (var i = 0; i < data_updated.length; i++) {
                    $('.edit_nama').css('display', '');
                    $('#nm_gr').text(data_updated[i].nama_group);
                    $('.nm_gr_list').text(data_updated[i].nama_group);
                    // console.log(css);
                }
            }
        }
    });
}

function cancel2(txt) {
    $('.edit_nama').css('display', '');
    $('#nm_gr').text(txt);
}
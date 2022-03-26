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
            $(form).append(input).appendTo("#kolom_input_cari_2");

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
            listFilter($("#cari_teman_2"), $("#teman_yang_dicari_2"));
        });
    }(jQuery)
);

function modalHapus(id_konten) {
    Swal.fire({
        title: '<span style="font-size:18px;"> Hapus Konten </span>',
        html: '<small>Apakah Anda yakin ingin menghapus konten ini?</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = window.location.origin + "/sosial-media/hapus_konten/" + id_konten;
        }
    })
}

function modalUnfollow(username, foto_profil) {
    let url = window.location.origin + '/data_file/' + username + '/foto_profil/';
    Swal.fire({
        title: '<span style="font-size:18px;">Berhenti mengikuti @' + username + ' ?</span>',
        html: '<small>' + username + ' tidak akan mengetahui bahwa Anda telah berhenti mengikutinya.</small>',
        imageUrl: url + foto_profil,
        imageHeight: '80px',
        imageWidth: '80px',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Berhenti Mengikuti',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = window.location.origin + "/sosial-media/hapus_following/" + username;
        }
    })
}

function modalMore(id_konten, username, slug, foto_profil) {
    swal.fire({
        html: '<ul class="list-group list-group-flush">' +
            // '<li class="list-group-item"><a onclick="modalReportKonten(' + id_konten + ')" id="reportKonten" href="#" style="font-weight: 600; color: red;"> Report </a></li>' +
            '<li class="list-group-item"><a id="salinLink" content="' + id_konten + '" url="' + window.location.origin + '/sosial-media/p/' + slug + '" style="cursor: pointer;"> Salin Link </a></li>' +
            '<li class="list-group-item"><a id="sharePost" onclick="modalShare(' + id_konten + ')" class="bagikan" style="cursor: pointer;"> Bagikan </a></li>' +
            '<li class="list-group-item"><a onclick="Swal.close()" style="cursor: pointer;"> Batalkan </a></li>' +
            '</ul>',
        showConfirmButton: false,
        width: 250,
        padding: '1.25rem'
    })
}

$(document).on('click', '#editKonten', function () {
    const id_konten = $(this).attr('data-id');
    const foto_profil = $(this).attr('image');
    const username = $(this).attr('data-username');
    const tempat = $(this).attr('data-tempat');
    const media_konten = $(this).attr('data-media');
    const caption = $(this).attr('data-caption');
    const tgl = $(this).attr('data-tgl');
    const slug = $(this).attr('data-slug');
    // alert(`id_konten: ${id_konten}, url: ${image}`);
    modalEdit(id_konten, foto_profil, username, tempat, media_konten, caption, tgl, slug);
})

$(document).on('click', '#salinLink', function () {
    const id_konten = $(this).attr('content');
    const url = $(this).attr('url');
    // alert(`id_konten: ${id_konten}, url: ${url}`);
    var temp = $("<input>");
    $("body").append(temp);
    temp.val(url).select();
    document.execCommand("copy");
    temp.remove();

    const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Link berhasil di copy'
    })
})

function modalMore2(id_konten, foto_profil, username, tempat, media, caption, tanggal, slug) {
    swal.fire({
        html: '<ul class="list-group list-group-flush">' +
            '<li class="list-group-item"><a onclick="modalHapus(' + id_konten + ')" id="hapusKonten" href="#" style="font-weight: 600; color: red;"> Hapus </a></li>' +
            '<li class="list-group-item"><a data-id="' + id_konten + '" image="' + foto_profil + '" data-username="' + username + '" data-tempat="' + tempat + '" data-media="' + media + '" data-caption="' + caption.split('&').join('&amp;').split('<').join('&lt;').split('"').join('&quot;').split("'").join('&#39;') + '" data-tgl="' + tanggal + '" data-slug="' + slug + '" style="cursor: pointer; font-weight: 600; color: blue;" id="editKonten"> Edit </a></li>' +
            // '<li class="list-group-item"><a onclick="modalReportKonten(' + id_konten + ')" id="reportKonten" href="#" style="font-weight: 600; color: red;"> Report </a></li>' +
            '<li class="list-group-item"><a id="salinLink" content="' + id_konten + '" url="' + window.location.origin + '/sosial-media/p/' + slug + '" style="cursor: pointer;"> Salin Link </a></li>' +
            '<li class="list-group-item"><a onclick="modalShare(' + id_konten + ')" id="shareKonten" style="cursor: pointer;" class="bagikan"> Bagikan </a></li>' +
            '<li class="list-group-item"><a onclick="Swal.close()" style="cursor: pointer;"> Batalkan </a></li>' +
            '</ul>',
        showConfirmButton: false,
        width: 350,
        padding: '1.25rem'
    })
}

function moreOnComment(id_komentar, username_auth, username_komen, username_konten) {
    let html_hapus = '';
    if (username_auth == username_konten || username_auth == username_komen) {
        html_hapus += '<li class="list-group-item"><a onclick="modalHapusKomentar(' + id_komentar + ')" id="hapusKomentar" href="#" style="font-weight: 600; color: orange;"> Hapus Komentar</a></li>';
    }
    swal.fire({
        html: '<ul class="list-group list-group-flush">' +
            // '<li class="list-group-item"><a onclick="modalReportKomentar(' + id_komentar + ')" id="reportKonten" href="#" style="font-weight: 600; color: red;"> Report Komentar</a></li>' +
            html_hapus +
            '<li class="list-group-item"><a onclick="Swal.close()" style="cursor: pointer;"> Batalkan </a></li>' +
            '</ul>',
        showConfirmButton: false,
        width: 250,
        padding: '1.25rem'
    })
}

function modalHapusKomentar(id_komentar) {
    swal.fire({
        heightAuto: false,
        icon: 'warning',
        title: 'Hapus Komentar?',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        confirmButtonColor: '#FF0000',
        cancelButtonText: 'Batalkan'
    }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    url: "/sosial-media/hapus_komentar_proses/" + id_komentar,
                    type: 'get',
                    // dataType: "json",
                    success: function (data) {
                        $('#comment_' + id_komentar).hide('slow');
                    }
                });
            } else {
                e.dismiss;
            }
        },
        function (dismiss) {
            return false;
        });
}

function modalReportKonten(id_konten) {
    Swal.close();
    $('#modalReport').modal('show');
    $('.kategori_report').text('Konten');
    $('#kategori').attr('value', 'Konten');
    $('#reported').attr('value', id_konten);
}

function modalReportKomentar(id_komentar) {
    Swal.close();
    $('#modalReport').modal('show');
    $('.kategori_report').text('Komentar');
    $('#kategori').attr('value', 'Komentar');
    $('#reported').attr('value', id_komentar);
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

function modalEdit(id_konten, foto_profil, username, tempat, media_konten, caption, tgl, slug) {
    Swal.close();
    let url = window.location.origin + '/data_file/' + username + '/foto_konten/' + tgl + '/' + slug + '/';
    $('#myModalEdit').modal('show');
    $('#closebtn').attr('value', id_konten);
    $('#foto_post').attr('src', window.location.origin + '/data_file/' + username + '/foto_profil/' + foto_profil);
    $('#uname').attr('href', '/sosial-media/profil/' + username);
    $('#uname').text(username);
    $('#tmpt').text(tempat);
    $('#hidden_id').attr('value', id_konten);
    let html = '';
    var media_desa = media_konten.split(", ");
    for (let i = 0; i < media_desa.length; i++) {
        if (media_desa[i].includes('.mp4')) {
            html += '<div class="mySlidesEd"><video width="200" height="400" autoplay loop muted><source src="' + url + media_desa[i] + '" type="video/mp4"><source src="' + url + media_desa[i] + '" type="video/ogg">Your browser does not support the video tag.</video></div>';
        } else {
            html += '<div class="mySlidesEd"><img src="' + url + media_desa[i] + '" alt="" style="height: 200px; width: 400px;"></div>';
        }
    }
    $('#media_post').html(html);
    $('#capt').text(caption);
    var char_remain = 500 - caption.length;
    $('#charNumEdit').text(char_remain + '/500');

    $('#prevClick').attr('onclick', 'plusSlidesSl(-1)');
    $('#nextClick').attr('onclick', 'plusSlidesSl(1)');

    var slideIndexSl = $('.editSlide').length;
    showSlidesSl(slideIndexSl);

    function plusSlidesSl(n) {
        showSlidesSl(slideIndexSl += n);
    }

    function showSlidesSl(n) {
        var i;
        var x = document.getElementsByClassName('mySlidesEd');
        if (n > x.length) {
            slideIndexSl = 1
        }
        if (n < 1) {
            slideIndexSl = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndexSl - 1].style.display = "block";
    }
}

function plusSlidesSl(n) {
    var slideIndexSl = $('.editSlide').length;
    showSlidesSl(slideIndexSl += n);

    function showSlidesSl(n) {
        var i;
        var x = document.getElementsByClassName('mySlidesEd');
        if (n > x.length) {
            slideIndexSl = 1
        }
        if (n < 1) {
            slideIndexSl = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndexSl - 1].style.display = "block";
    }
}

function modalShare(id_konten) {
    Swal.close();
    $('#modalShare').modal('show');
    $('#hidden_id_share').attr('value', id_konten);
}

window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

// function balas_komen(balas, id_balas_komen, username, id_konten) {
//     let html = '';
//     html += '<input type="hidden" name="id_balas_komen" value="' + id_balas_komen + '"><input type="hidden" name="username" value="' + username + '"></input><textarea placeholder="Post your comment" name="isi_komentar" style="width: 90%;">' + balas + ' </textarea>';
//     $('.thumb-xs' + id_konten).html(html);
// }

function balas_komen(balas, id_balas_komen, username, id_konten) {
    let html = '';
    html += '<input type="hidden" name="id_balas_komen" class="id_balas_komen" value="' + id_balas_komen + '"><input type="hidden" name="username" value="' + username + '" class="username_balas"></input><textarea placeholder="Post your comment" name="isi_komentar" style="width: 90%;" class="txt_comment_' + id_konten + '">' + balas + ' </textarea>';
    $('.thumb-xs' + id_konten).html(html);
}

function showBtn(obj, id_konten){
    if(obj.value.length > 0){
        $('.txt_comment_' + id_konten).css('width', '90%');
        $('.btn-'+id_konten).css('display', 'inline-block');
    }else{
        $('.txt_comment_' + id_konten).css('width', '100%');
        $('.btn-'+id_konten).css('display', 'none');
    }
}

function uploadKomen(id_konten) {
    var formData = new FormData();
    var id_konten = $('.konten_' + id_konten).val();
    formData.append('id_konten', id_konten);
    var isi_komentar = $('.txt_comment_' + id_konten).val();
    formData.append('isi_komentar', isi_komentar);
    if ($('.id_balas_komen')[0]) {
        var id_balas_komen = $('.id_balas_komen').val();
        formData.append('id_balas_komen', id_balas_komen);
        var username = $('.username_balas').val();
        formData.append('username', username);
    }
    // console.log(id_balas_komen);
    $.ajax({
        url: "/sosial-media/post_komen",
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        },
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            if (data.length !== 0) {
                for (var i = 0; i < data.length; i++) {
                    let html = '';
                    if (data[i].id_balas_komen == 0) {
                        html += '<li id="comment_' + data[i].id_cmt + '" class="list-rep_cmt_' + data[i].id_cmt + '">' +
                            '<div class="comet-avatar">' +
                            '<img src = "' + window.location.origin + '/data_file/' + data[i].username + '/foto_profil/' + data[i].foto_profil + '" alt = "" style = "height: 45px; width: 45px;">' +
                            '</div>' +
                            '<div class="we-comment">' +
                            '<div class = "coment-head">' +
                            '<h5 style = "text-transform: none;" > <a href = "/sosial-media/profil/' + data[i].username + '" title = "">' + data[i].username + '</a></h5>' +
                            '<span>' + data[i].tanggal_komen + '</span>' +
                            '<a onclick = "modalHapusKomentar(' + data[i].id_cmt + ')" style = "cursor: pointer" ><i class = "ti-trash hide" style = "color: red;"></i></a>' +
                            // '<a onclick="modalReportKomentar(' + data[i].id_cmt + ')" style="cursor: pointer" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>' +
                            '<button class = "we-reply btn btn-link" style = "font-size: 12px; font-weight: 500; float: right; position: relative; top: 0;" onclick = "balas_komen(`' + '@' + data[i].username + '`, `' + data[i].id_cmt + '`, `' + data[i].username + '`, `' + data[i].id_konten + '`)" value = "' + data[i].id_cmt + '" > Balas </button>' +
                            '</div>' +
                            '<p style = "margin-top: 0px;">' + data[i].isi_komentar + '</p>' +
                            '</div></li>';
                        $('.list-cmt' + data[i].id_konten).append(html);
                    } else {
                        html += '<ul id="comment_' + data[i].id_cmt + '">' +
                            '<li>' +
                            '<div class="comet-avatar">' +
                            '<img src = "' + window.location.origin + '/data_file/' + data[i].username + '/foto_profil/' + data[i].foto_profil + '" alt = "" style="height: 35px; width: 35px;">' +
                            '</div>' +
                            '<div class="we-comment">' +
                            '<div class = "coment-head">' +
                            '<h5 style = "text-transform: none;" > <a href = "/sosial-media/profil/' + data[i].username + '" title = "">' + data[i].username + '</a></h5>' +
                            '<span>' + data[i].tanggal_komen + '</span>' +
                            '<a onclick = "modalHapusKomentar(' + data[i].id_cmt + ')" style = "cursor: pointer" ><i class = "ti-trash hide" style = "color: red;"></i></a>' +
                            // '<a onclick="modalReportKomentar(' + data[i].id_cmt + ')" style="cursor: pointer" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>' +
                            '<button class = "we-reply btn btn-link" style = "font-size: 12px; font-weight: 500; float: right; position: relative; top: 0;" onclick = "balas_komen(`' + '@' + data[i].username + '`, `' + data[i].id_balas_komen + '`, `' + data[i].username + '`, `' + data[i].id_konten + '`)" value = "' + data[i].id_balas_komen + '" > Balas </button>' +
                            '</div>' +
                            '<p style = "margin-top: 0px;">' + data[i].isi_komentar + '</p>' +
                            '</div></li></ul>';
                        $('.list-rep_cmt_' + data[i].id_balas_komen).append(html);
                    }
                    // $('.txt_comment_' + id_konten).val('');
                    $('.thumb-xs' + data[i].id_konten).html('<textarea placeholder="Post your comment" name="isi_komentar" style="width: 90%;" class="txt_comment_' + data[i].id_konten + '"></textarea>');
                }
            }
        }
    });
}

$('.action-like-or-dislike').on('click', function () {
    let isLike = $(this).attr('data-is-like');
    let id = $(this).attr('data-id');
    let this_element = $(this);
    if (isLike == 0) {
        $.ajax({
            url: "/sosial-media/menyukai_proses/" + id,
            type: 'post',
            // dataType: "json",
            data: {
                _token: CSRF_TOKEN
            },
            success: function (data) {
                document.getElementById("icon_like" + id).className = "fa fa-heart";
                this_element.attr('data-is-like', 1);
                this_element.children('span')[0].setAttribute('data-original-title', 'Batal Menyukai');
            }
        });
    } else {
        $.ajax({
            url: "/sosial-media/batal_menyukai_proses/" + id,
            type: 'post',
            // dataType: "json",
            data: {
                _token: CSRF_TOKEN
            },
            success: function (data) {
                document.getElementById("icon_like" + id).className = "fa fa-heart-o";
                this_element.attr('data-is-like', 0);
                this_element.children('span')[0].setAttribute('data-original-title', 'Menyukai');
            }
        });
    }
});

$(document).ready(function () {
    $('.single-item').slick({
        adaptiveHeight: true,
        dots: true,
        // infinite: false
        // arrows: true
    });
});

$(document).ready(function () {
    $('.single-item2').slick({
        adaptiveHeight: true,
        dots: true
    });
});

$('.modal').on('shown.bs.modal', function (e) {
    $('.single-item2').slick('setPosition');
    $('.wrap-modal-slider').addClass('open');
});

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
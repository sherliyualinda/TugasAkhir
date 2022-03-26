// Get the image and insert it inside the modal - use its "alt" text as a caption
$('.modal_img').on('click', function () {
    var id_chat = $(this).attr('data-id');

    var img = document.getElementById("myImg-" + id_chat);
    var modalImg = document.getElementById("img/" + id_chat);
    var modal = document.getElementById("myModalImg/" + id_chat);

    modal.style.display = "block";
    modalImg.src = this.src;


    // Get the <span> element that closes the modal
    var span = document.getElementById("close/" + id_chat);

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
});

// $(document).ready(function () {
    $('#pro-image').on('change', function () {
        var formData = new FormData();
        // console.log(formData);
        var files = $('#pro-image')[0].files[0];
        // if (files.size < 1000000) {
            formData.append('gambar', files);
            var username_penerima = $('.penerima').val();
            formData.append('username_penerima', username_penerima);
            var id_room_chat = $('.room').val();
            formData.append('id_room_chat', id_room_chat);
            var url = "/sosial-media/chat_proses";
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
                    location.reload();
                }
            });
        // }else{
        //     const Toast = Swal.mixin({
        //         toast: true,
        //         position: 'center',
        //         showConfirmButton: false,
        //     })
        
        //     Toast.fire({
        //         icon: 'error',
        //         title: 'Ukuran file melebihi 1MB!'
        //     })
        // }
    });
// });

$(function () {
    $("#upload_link").on('click', function (e) {
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });
});

function cek_chat(foto_profil, username_penerima, id_pengguna_pengirim, username_pengirim) {
    $.ajax({
        url: "/sosial-media/cek_chat/" + username_penerima,
        type: 'get',
        dataType: "json",
        data: {
            // _token: CSRF_TOKEN,
            // username_penerima: username_penerima
        },
        success: function (data_chat) {
            if (data_chat.length !== 0) {
                for (var i = 0; i < data_chat.length; i++) {
                    window.location.href = window.location.origin + "/sosial-media/chat/" + data_chat[i].id_room_chat;
                }
            } else {
                isiChatKosong(foto_profil, username_penerima, id_pengguna_pengirim, username_pengirim);
            }
        }
    });
}

function isiChatKosong(foto_profil, username_penerima, id_pengguna_pengirim, username_pengirim) {
    let html = '';
    html += '<div class="modal-header d-flex justify-content-left" style="padding: 0.75rem 0rem;"> <div class="media"> <img src="' + foto_profil + '" class="align-self-center mr-3" style="width: 20px; height: 20px; border-radius: 50%;"><div class="media-body align-self-center"><a href="/sosial-media/profil/' + username_penerima + '" style="font-weight: 600">' + username_penerima + '</a></div></div><i class="fa fa-info-circle" style="font-size:24px"></i></div><div class="modal-body" style="height: 80%; overflow-y: auto; max-height: 347px;"></div><div class="modal-footer align-items-end" style="padding: 0.5rem 0rem;"><div class="post-comt-box2" style="width:100%; padding-left:0;"><form method="post" action="/sosial-media/chat_proses" enctype="multipart/form-data">{{ csrf_field() }}<input type="hidden" name="username_penerima" value="' + username_penerima + '" class="penerima"></input><input type="hidden" name="username_pengirim" value="' + username_pengirim + '"></input><input type="hidden" name="id_pengguna" value="' + id_pengguna_pengirim + '"></input><div class="input-group mb-3"><div class="input-group-prepend"><div class="attachments"><ul><li><i class="fa fa-image"></i><label class="fileContainer"><input type="file" name="file_foto[]" id="pro-image" accept="image/*, video/*"></label></li></ul></div></div><textarea  name="isi_chat" style="width: 93%;"></textarea><button type="submit" class="btn btn-submit" style="border-radius: 3px;">Post</button></div></form></div></div>';
    $('.col-lg-7').html(html);

    $('#pro-image').on('change', function () {
        var formData = new FormData();
        var files = $('#pro-image')[0].files[0];
        formData.append('gambar', files);
        var username_penerima = $('.penerima').val();
        formData.append('username_penerima', username_penerima);
        var url = "/sosial-media/chat_proses";
        $.ajax({
            url: url,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
            },
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                if (response.length !== 0) {
                    for (var i = 0; i < response.length; i++) {
                        window.location.href = window.location.origin + "/sosial-media/chat/" + response[i].id_room_chat;
                    }
                }
            }
        });
    });
}

function modalHapusChat(id_chat, id_room_chat, id_auth, username_yg_tampil) {
    swal.fire({
        heightAuto: false,
        icon: 'warning',
        title: 'Hapus Chat?',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        confirmButtonColor: '#FF0000',
        cancelButtonText: 'Batalkan'
    }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    url: "/sosial-media/hapus_chat_proses/" + id_chat,
                    type: 'get',
                    // dataType: "json",
                    success: function (data_chat) {
                        $('#container_' + id_chat).hide('slow');
                        const isi = $('.isi_chat' + id_room_chat);
                        const tgl = $('.tgl_chat' + id_room_chat);
                        // console.log(data_chat);
                        if (data_chat.length !== 0) {
                            for (var i = 0; i < data_chat.length; i++) {
                                var str = data_chat[i].tanggal_chat;
                                var str2 = str.split("-");
                                var str3 = str2[2].split(" ");
                                var str4 = str3[1].split(":");
                                // console.log(str2[0] + '-' + str2[1] + '-' + str3[0] + ' ' + str4[0] + ':' + str4[1]);

                                // console.log(split);
                                var d = new Date();
                                d.setFullYear(str2[0], str2[1], str3[0]);
                                var h = new Date();
                                h.setHours(str4[0]);
                                var m = new Date();
                                m.setMinutes(str4[1]);

                                var bulan = '';
                                if (d.getMonth() == 1) {
                                    bulan = "Jan";
                                } else if (d.getMonth() == 2) {
                                    bulan = "Feb";
                                } else if (d.getMonth() == 3) {
                                    bulan = "Mar";
                                } else if (d.getMonth() == 4) {
                                    bulan = "Apr";
                                } else if (d.getMonth() == 5) {
                                    bulan = "May";
                                } else if (d.getMonth() == 6) {
                                    bulan = "Jun";
                                } else if (d.getMonth() == 7) {
                                    bulan = "Jul";
                                } else if (d.getMonth() == 8) {
                                    bulan = "Aug";
                                } else if (d.getMonth() == 9) {
                                    bulan = "Sep";
                                } else if (d.getMonth() == 10) {
                                    bulan = "Oct";
                                } else if (d.getMonth() == 11) {
                                    bulan = "Nov";
                                } else if (d.getMonth() == 12) {
                                    bulan = "Dec";
                                }

                                if (d.getDate().length == 1) {
                                    var tanggal = 0 + d.getDate();
                                } else {
                                    var tanggal = d.getDate();
                                }

                                if (d.getHours().length == 1) {
                                    var jam = 0 + h.getHours();
                                } else {
                                    var jam = h.getHours();
                                }

                                if (d.getMinutes().length == 1) {
                                    var menit = 0 + m.getMinutes();
                                } else {
                                    var menit = m.getMinutes();
                                }

                                if (data_chat[i].isi_chat != null) {
                                    isi.text(data_chat[i].isi_chat + ' -');
                                    tgl.text(tanggal + ' ' + bulan + ' ' + d.getFullYear() + ' ' + jam + ':' +
                                        menit);
                                } else if (data_chat[i].media != null) {
                                    if (data_chat[i].id_pengirim == id_auth) {
                                        isi.text('Anda mengirim media -');
                                    } else {
                                        isi.text(username_yg_tampil + ' mengirim media -');
                                    }
                                    tgl.text(tanggal + ' ' + bulan + ' ' + d.getFullYear() + ' ' + jam + ':' +
                                        menit);
                                }
                            }
                        } else {
                            window.location.href = document.location.origin + "/sosial-media/chat";
                        }
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

function modalHapusRoomChat(id_room_chat, username) {
    swal.fire({
        heightAuto: false,
        icon: 'warning',
        title: 'Hapus Room Chat?',
        html: 'Apakah anda yakin ingin menghapus room chat dengan <strong>' + username + '</strong>?',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        confirmButtonColor: '#FF0000',
        cancelButtonText: 'Batalkan'
    }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    url: "/sosial-media/hapus_room_chat_proses/" + id_room_chat,
                    type: 'get',
                    // dataType: "json",
                    success: function () {
                        window.location.href = document.location.origin + "/sosial-media/chat";
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

(
    function ($) {
        // custom css expression for a case-insensitive contains()
        jQuery.expr[':'].Contains = function (a, i, m) {
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

        function listFilter(cari, list) {
            var form = $("<form>").attr({
                    "class": "filterform",
                    "action": "#"
                }),
                input = $("<input>").attr({
                    "class": "filterinput form-control",
                    "type": "text",
                    "placeholder": "Cari"
                });
            $(form).append(input).appendTo(kolom_input);

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
            listFilter($("#cari"), $("#list_yang_dicari"));
        });
    }(jQuery)
);

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

var isi = document.querySelector('#isi');
isi.scrollTop = isi.scrollHeight - isi.clientHeight;

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
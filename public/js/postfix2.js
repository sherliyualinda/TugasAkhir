$(document).on('click', '.ukf', function(){
    let id_konten2 = $(this).attr('komen');
    // swal.fire(`tes: ${id_konten2}`);
    console.log('tes2');
    var formData = new FormData();
    var id_konten = $('.konten_' + id_konten2).val();
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
        url: "/sosial-media/post_komen/",
        method: "post",
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
                        html += '<li id="comment_' + data[i].id_cmt + '" class="list-rep_cmt' + data[i].id_cmt + '">' +
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
});

function uploadKomen(id_konten) {
    // swal.fire('tes');
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
        url: "/sosial-media/post_komen/",
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
                        html += '<li id="comment_' + data[i].id_cmt + '" class="list-rep_cmt' + data[i].id_cmt + '">' +
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
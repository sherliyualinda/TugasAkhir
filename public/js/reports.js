function btnEksekusiKonten(id_konten) {
    var jml = $('.badge-danger').text();
    Swal.fire({
        icon: 'warning',
        title: 'Report Konten',
        text: 'Apakah anda yakin ingin menghapus konten ini?',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        // cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/sosial-media/delete-reported-content/" + id_konten,
                type: 'get',
                // dataType: "json",
                success: function (data) {
                    tabelData.ajax.reload();
                    tabelData2.ajax.reload();
                }
            });
        }
    })
}

function btnTolakReport(id_reports) {
    var jml = $('.badge-danger').text();
    Swal.fire({
        icon: 'warning',
        title: 'Tolak Report',
        text: 'Apakah anda yakin ingin menghapus report ini?',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        // cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/sosial-media/decline-report/" + id_reports,
                type: 'get',
                // dataType: "json",
                success: function (data) {
                    tabelData.ajax.reload();
                    tabelData2.ajax.reload();
                }
            });
        }
    })
}

function btnEksekusiComment(id_comment) {
    var jml = $('.badge-danger').text();
    Swal.fire({
        icon: 'warning',
        title: 'Report Komentar',
        text: 'Apakah anda yakin menghapus komentar ini?',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        // cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/sosial-media/delete-reported-comment/" + id_comment,
                type: 'get',
                // dataType: "json",
                success: function (data) {
                    tabelData.ajax.reload();
                    tabelData2.ajax.reload();
                }
            });
        }
    })
}

function viewContentReported(slug) {
    if (slug.match(/-/g).length == 2) {
        window.open(window.location.origin + "/sosial-media/group/p/" + slug, '_blank');
    } else {
        window.open(window.location.origin + "/sosial-media/p/" + slug, '_blank');
    }

}

function viewCommentReported(id_comment) {
    $.ajax({
        url: "/sosial-media/get-content-of-comment/" + id_comment,
        type: 'get',
        // dataType: "json",
        success: function (data) {
            if (data.length !== 0) {
                for (var i = 0; i < data.length; i++) {
                    var slug = data[i].slug;
                    if (slug.match(/-/g).length == 2) {
                        var tab = window.open(window.location.origin + "/sosial-media/group/p/" + slug, '_blank');
                    } else {
                        var tab = window.open(window.location.origin + "/sosial-media/p/" + slug, '_blank');
                    }
                    tab.onload = function () {
                        tab.document.getElementById("li-cmt-" + id_comment).style.border = '2px solid red'
                    };
                }
            }
        }
    });
}
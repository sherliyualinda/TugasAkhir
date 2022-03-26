// Call the dataTables jQuery plugin
$(document).ready(function () {
   $('#dataTableX').DataTable();
   $('#dataTableY').DataTable();
});

var tabelData = $('#dataTable').DataTable({
  processing: true,
  scrollX: true,
  autoWidth: false,
  searching: true,
  pagingType: "simple_numbers",
  paging: true,
  oLanguage: {
    sProcessing: 'Loading'
  },
  serverSide: true,
  ajax: {
    url: "/sosial-media/get-report-list",
    type: "post",
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    },
    data: function (d) {
      var search_data = {
        product: $('#product').val(),
        name: $('#name').val(),
        status: $('#status').val(),
      };
      d.search_param = search_data;
    },
    dataSrc: function (json) {
      return json.data;
    }
  },
  columns: [{
      data: "created_at"
    },
    {
      mRender: function (data, type, row) {
        let action = '';

        action = '<a onclick="' + (row.kategori_report == 'Konten' ? 'viewContentReported(' + "'" + row.slug + "'" + ')' : 'viewCommentReported(' + row.id + ')') + '" style="cursor: pointer; color: white;" class="' + (row.kategori_report == 'Konten' ? 'badge badge-success' : 'badge badge-info') + '">' + row.kategori_report + '</a>';

        return action;
      }
    },
    {
      mRender: function (data, type, row) {
        var html = '';

        if (row.kategori_report == 'Konten') {
          html = row.username_reported;
        } else {
          html = row.username_cmt_reported;
        }

        return html;
      }
    },
    {
      data: "alasan_report"
    },
    {
      data: "username_reporter"
    },
    {
      mRender: function (data, type, row) {
        let action = '';

        action = '<button onclick="' + (row.kategori_report == 'Konten' ? 'btnEksekusiKonten(' + row.id_konten + ')' : 'btnEksekusiComment(' + row.id + ')') + '" type="button" class="btn btn-sm btn-danger mr-2" style="padding: 3px;" title="Eksekusi">' +
          '<i class="ti-check" style="font-size: 10px;"></i></button>' +
          '<button onclick="btnTolakReport(' + row.id_rep + ')" type="button" class="btn btn-sm btn-warning" style="padding: 3px;" title="Tolak">' +
          '<i class="ti-close" style="font-size: 10px;"></i></button>';

        return action;
      }
    },
  ],
  order: [],
  columnDefs: [{
    targets: 'no-sort',
    orderable: false,
  }]
});

var tabelData2 = $('#dataTable2').DataTable({
  processing: true,
  scrollX: true,
  autoWidth: false,
  searching: true,
  pagingType: "simple_numbers",
  paging: true,
  oLanguage: {
    sProcessing: 'Loading'
  },
  serverSide: true,
  ajax: {
    url: "/sosial-media/get-report-list",
    type: "post",
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    },
    data: function (d) {
      var search_data = {
        tipe: 'histori',
      };
      d.param = search_data;
    },
    dataSrc: function (json) {
      return json.data;
    }
  },
  columns: [{
      data: "created_at"
    },
    {
      mRender: function (data, type, row) {
        let action = '';

        action = '<a onclick="' + (row.kategori_report == 'Konten' ? 'viewContentReported(' + "'" + row.slug + "'" + ')' : 'viewCommentReported(' + row.id + ')') + '" style="cursor: pointer; color: white;" class="' + (row.kategori_report == 'Konten' ? 'badge badge-success' : 'badge badge-info') + '">' + row.kategori_report + '</a>';

        return action;
      }
    },
    {
      mRender: function (data, type, row) {
        var html = '';

        if (row.kategori_report == 'Konten') {
          html = row.username_reported;
        } else {
          html = row.username_cmt_reported;
        }

        return html;
      }
    },
    {
      data: "alasan_report"
    },
    {
      data: "username_reporter"
    },
    {
      mRender: function (data, type, row) {
        let action = '';

        action = '<span class="' + (row.is_active == 0 ? 'badge badge-danger' : 'badge badge-info') + '">' + (row.is_active == 0 ? 'Diterima' : 'Ditolak') + '</span>';

        return action;
      }
    },
  ],
  order: [],
  columnDefs: [{
    targets: 'no-sort',
    orderable: false,
  }]
});
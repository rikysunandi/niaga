$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    $('#tbl_saldo_up3').DataTable( {
        "Processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/getDataAgendaEvaluasi.php',
            "type": "GET",
            "timeout": 10000
        },
        //"deferRender": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv'
        ],
        "scrollY": 500,
        "scrollX": true,
        
        columns: [
          {
            data: "NOAGENDA_INDIVIDU",
            title: "NOAGENDA_INDIVIDU",
            readonly: true,
          },
          {
            data: "TGLMOHON",
            title: "TGLMOHON",
          },
          {
            data: "KET_TRANSAKSI",
            title: "KET_TRANSAKSI",
          },
          {
            data: "ALASAN_KRITERIA_TMP",
            title: "ALASAN_KRITERIA_TMP",
          },
          {
            data: "TARIF_LAMA",
            title: "TARIF_LAMA",
          },
          {
            data: "DAYA_LAMA",
            title: "DAYA_LAMA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "TARIF_BARU",
            title: "TARIF_BARU",
          },
          {
            data: "DAYA_BARU",
            title: "DAYA_BARU",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "V_DURASI_HARI_KERJA",
            title: "V_DURASI_HARI_KERJA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "STATUS_TMP",
            title: "STATUS_TMP",
          },
          {
            data: "RP_RAB",
            title: "RP_RAB",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "RP_RAB_EXCEL",
            title: "RP_RAB_EXCEL",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "RP_RAB_KETERANGAN",
            title: "RP_RAB_KETERANGAN",
          },
          {
            data: "RP_BP",
            title: "RP_BP",
          },
          {
            data: "STATUS_PROSES",
            title: "STATUS_PROSES",
          },
          ],
    });

});
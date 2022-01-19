$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    $('#tbl_rekap_tmp_segmen_tegangan').DataTable( {
        "Processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/getRekapTMPUP.php',
            "type": "GET",
            "timeout": 10000
        },
        columns: [
          {
            data: "UNITUP",
            title: "UNITUP",
            readonly: true,
          },
          {
            data: "NAMA_UP",
            title: "NAMA UNIT",
          },
          {
            data: "JML_AGENDA",
            title: "JML_AGENDA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_DALAM_TMP",
            title: "DALAM TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MENDEKATI_TMP",
            title: "MENDEKATI_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MELEBIHI_TMP",
            title: "MELEBIHI_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TR_DALAM_TMP",
            title: "TR_DALAM_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TR_MENDEKATI_TMP",
            title: "TR_MENDEKATI_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TR_MELEBIHI_TMP",
            title: "TR_MELEBIHI_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TM_DALAM_TMP",
            title: "TM_DALAM_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TM_MENDEKATI_TMP",
            title: "TM_MENDEKATI_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TM_MELEBIHI_TMP",
            title: "TM_MELEBIHI_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TT_DALAM_TMP",
            title: "TT_DALAM_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TT_MENDEKATI_TMP",
            title: "TT_MENDEKATI_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_TT_MELEBIHI_TMP",
            title: "TT_MELEBIHI_TMP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          
        ],
        //"deferRender": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        "scrollY": 280,
        "scrollX": true,
    });

    $('#tbl_rekap_tmp_ket_transaksi').DataTable( {
        "Processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/getRekapTMPKetTransaksiUP.php',
            "type": "GET",
            "timeout": 10000
        },
        columns: [
          {
            data: "UNITUP",
            title: "UNITUP",
            readonly: true,
          },
          {
            data: "NAMA_UP",
            title: "NAMA UNIT",
          },
          {
            data: "JML_AGENDA",
            title: "JML_AGENDA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_DALAM_TMP_PASANG_BARU",
            title: "DALAM TMP<br/>PASANG BARU",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_DALAM_TMP_TAMBAH_DAYA",
            title: "DALAM TMP<br/>TAMBAH_DAYA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_DALAM_TMP_TURUN_DAYA",
            title: "DALAM TMP<br/>TURUN_DAYA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_DALAM_TMP_UBAH_TARIF",
            title: "DALAM TMP<br/>UBAH_TARIF",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_DALAM_TMP_MIGRASI_KE_PRABAYAR",
            title: "DALAM TMP<br/>MIGRASI_KE_PRABAYAR",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_DALAM_TMP_MIGRASI_KE_PASCABAYAR",
            title: "DALAM TMP<br/>MIGRASI_KE_PASCABAYAR",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_DALAM_TMP_SAMBUNG_KEMBALI",
            title: "DALAM TMP<br/>SAMBUNG_KEMBALI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MENDEKATI_TMP_PASANG_BARU",
            title: "MENDEKATI TMP<br/>PASANG BARU",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MENDEKATI_TMP_TAMBAH_DAYA",
            title: "MENDEKATI TMP<br/>TAMBAH_DAYA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MENDEKATI_TMP_TURUN_DAYA",
            title: "MENDEKATI TMP<br/>TURUN_DAYA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MENDEKATI_TMP_UBAH_TARIF",
            title: "MENDEKATI TMP<br/>UBAH_TARIF",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MENDEKATI_TMP_MIGRASI_KE_PRABAYAR",
            title: "MENDEKATI TMP<br/>MIGRASI_KE_PRABAYAR",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MENDEKATI_TMP_MIGRASI_KE_PASCABAYAR",
            title: "MENDEKATI TMP<br/>MIGRASI_KE_PASCABAYAR",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MENDEKATI_TMP_SAMBUNG_KEMBALI",
            title: "MENDEKATI TMP<br/>SAMBUNG_KEMBALI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MELEBIHI_TMP_PASANG_BARU",
            title: "MELEBIHI TMP<br/>PASANG BARU",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MELEBIHI_TMP_TAMBAH_DAYA",
            title: "MELEBIHI TMP<br/>TAMBAH_DAYA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MELEBIHI_TMP_TURUN_DAYA",
            title: "MELEBIHI TMP<br/>TURUN_DAYA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MELEBIHI_TMP_UBAH_TARIF",
            title: "MELEBIHI TMP<br/>UBAH_TARIF",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MELEBIHI_TMP_MIGRASI_KE_PRABAYAR",
            title: "MELEBIHI TMP<br/>MIGRASI_KE_PRABAYAR",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MELEBIHI_TMP_MIGRASI_KE_PASCABAYAR",
            title: "MELEBIHI TMP<br/>MIGRASI_KE_PASCABAYAR",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA_MELEBIHI_TMP_SAMBUNG_KEMBALI",
            title: "MELEBIHI TMP<br/>SAMBUNG_KEMBALI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
        ],
        "deferRender": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        "scrollY": 280,
        "scrollX": true,
    });

});
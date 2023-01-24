$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var unitupi, unitap, unitup, petugas, blth, rbm, status;

    if(urlParams.has('blth')){
      $('#sel_blth').val(urlParams.get('blth'));
    }


    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_realisasi_migrasi')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!');
        $('div.content-body').unblock();
      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        "ajax": {
            "url": '../controller/migrasi/getRealisasiMigrasi.php',
            "type": "POST",
            "timeout": 60000
        },
        //responsive: true,
        columns: [
          {
            data: "UNITAP",
            visible: true
          },
          {
            data: "UNITUP",
            visible: true
          },
          {
            data: "IDPEL",
            visible: true
          },
          {
            data: "NAMA",
            visible: true
          },
          {
            data: "KOGOL",
            visible: true
          },
          {
            data: "TARIF",
            visible: true
          },
          {
            data: "DAYA",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "KDDK",
            visible: true
          },
          {
            data: "NOAGENDA",
            visible: true
          },
          {
            data: "TARIF_BARU",
            visible: true
          },
          {
            data: "DAYA_BARU",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "MENUNGGAK_12BLN_BERTURUT2",
            visible: true
          },
          {
            data: "MENUNGGAK_9BLN_BERTURUT2",
            visible: true
          },
          {
            data: "MENUNGGAK_6BLN_BERTURUT2",
            visible: true
          },
          {
            data: "MENUNGGAK_3BLN_BERTURUT2",
            visible: true
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            { extend: 'colvis', text: 'Columns' },
            { extend: 'excelHtml5', 
              text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Download CSV', 
              titleAttr: 'Download ke CSV',
              footer: true,
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open('../controller/migrasi/expCSVRealisasiMigrasi.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&status='+status );
              }
            },
        ],
        "scrollY": 370,
        "scrollX": true,
        "paging": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[11, 'desc'],[12, 'desc'],[13, 'desc'],[14, 'desc'],[1, 'asc'],[7, 'asc']],
    });


    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        unitupi = $('#sel_unitupi').val();
        unitap = $('#sel_unitap').val();
        unitup = $('#sel_unitup').val();
        status = $('#sel_status').val();
        // tgl_pemutusan_from = $('#tgl_pemutusan_range')
        //                         .data('daterangepicker')
        //                         .startDate.format('YYYY-MM-DD');
        // tgl_pemutusan_to = $('#tgl_pemutusan_range')
        //                         .data('daterangepicker')
        //                         .endDate.format('YYYY-MM-DD');


        // table.clear().draw();
        // var container = $('#map').parent();
        // $('#map').remove();
        // container.append('<div id="map"></div>');

        table.ajax.url( '../controller/migrasi/getRealisasiMigrasi.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&status='+status ).load();
        //table.ajax.url( '../controller/pemutusan/getDatapemutusan.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    });


});
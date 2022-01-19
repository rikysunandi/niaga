$(document).ready(function () {

    "use strict";



    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_ts_p2tl')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $(this).block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!');
        $(this).unblock();
      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/ts_p2tl/getDataTSP2TL.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&kesesuaian='+$('#sel_kesesuaian').val()+'&jenis_plg='+$('#sel_jenis_plg').val()+'&sisa_saldo='+$('#sel_sisa_saldo').val(),
            "type": "POST",
            "timeout": 360000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          {
            data: "UNITUP",
          },
          {
            data: "NOAGENDA",
          },
          {
            data: "IDPEL",
          },
          {
            data: "NAMA",
            visible: false,
          },
          {
            data: "TARIF_DIL",
          },
          {
            data: "DAYA_DIL",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "KATEGORI",
            render: function ( data, type, row ) {

              if(data=='HIJAU'){
                return '<span class="label label-sm label-success">HIJAU</span>';
              }else if(data=='KUNING'){
                return '<span class="label label-sm label-warning">KUNING</span>';
              }else if(data=='MERAH'){
                return '<span class="label label-sm label-danger">MERAH</span>';
              }

            },
          },
          {
            data: "BL_ANG_AW",
            visible: false
          },
          {
            data: "BL_ANG_AK",
            visible: false
          },
          {
            data: "RPTS",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "BA_SESUAI",
            render: function ( data, type, row ) {

              if(data=='Y'){
                return '<a href="#" title="SESUAI" class="text-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>';
              }else{
                return '<a href="#" title="TIDAK SESUAI" class="text-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>';
              }

            },
          },
          {
            data: "TS_SESUAI",
            render: function ( data, type, row ) {

              if(data=='Y'){
                return '<a href="#" title="SESUAI" class="text-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>';
              }else{
                return '<a href="#" title="TIDAK SESUAI" class="text-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>';
              }

            },
          },
          {
            data: "SPH_SESUAI",
            render: function ( data, type, row ) {

              if(data=='Y'){
                return '<a href="#" title="SESUAI" class="text-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>';
              }else{
                return '<a href="#" title="TIDAK SESUAI" class="text-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>';
              }

            },
          },
          {
            data: "CEKLOK_SESUAI",
            render: function ( data, type, row ) {

              if(data=='Y'){
                return '<a href="#" title="SESUAI" class="text-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>';
              }else{
                return '<a href="#" title="TIDAK SESUAI" class="text-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>';
              }

            },
          },
          {
            data: "NAMA_GARDU",
          },
          {
            data: "NOMOR_GARDU",
          },
          {
            data: "NOMOR_TIANG",
          },
          {
            data: "KOORDINAT_X",
          },
          {
            data: "KOORDINAT_Y",
          },
          {
            data: "AKURASI_KOORDINAT",
          },
          {
            data: "SUMBER_KOORDINAT",
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        lengthChange: true,
        buttons: [
            { 
              text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Download CSV', 
              titleAttr: 'Download semua data TS',
              //"sTooltip": "My CSV button's tooltip",
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open("../controller/ts_p2tl/expCSVTSP2TL.php?unitupi="+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&jenis_plg='+$('#sel_jenis_plg').val()+'&kategori='+$('#sel_kategori').val() );
              }

            },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        pageLength: 25,
        "order": [[1, 'asc']],
    });



    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/ts_p2tl/getDataTSP2TL.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&kategori='+$('#sel_kategori').val()+'&jenis_plg='+$('#sel_jenis_plg').val() ).load();
    });



    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };


    var unitupi = getUrlParameter('unitupi'),
        unitap = getUrlParameter('unitap'),
        unitup = getUrlParameter('unitup'),
        jenis_plg = getUrlParameter('jenis_plg'),
        kategori = getUrlParameter('kategori');

    if(jenis_plg.length>0 && kategori.length>0){
      $('#sel_jenis_plg').selectpicker('val', jenis_plg);
      $('#sel_kategori').selectpicker('val', kategori);

      table.ajax.url( '../controller/ts_p2tl/getDataTSP2TL.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&kategori='+kategori+'&jenis_plg='+jenis_plg ).load();
    
    }

});
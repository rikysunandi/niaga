$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var unitupi, unitap, unitup, petugas, blth, rbm, petugas_baru;

    if(urlParams.has('blth')){
      $('#sel_blth').val(urlParams.get('blth'));
    }


    $('#sel_unitup').change(function(){

      $('#sel_petugas_baru').empty();
      $.getJSON('../controller/referensi/getPetugas.php?unitup='+$('#sel_unitup').val(), function(data){
          
          $.each(data.rows,function(i,v){
              $('#sel_petugas_baru').append('<option value="'+v.kode+'">'+v.nama+'</option>');
          });
          // $('#sel_petugas_baru').append('<option value="00">SEMUA PETUGAS</option>');
          $('#sel_petugas_baru').selectpicker('refresh');

          // if(urlParams.has('petugas')){
          //   $('#sel_petugas_baru').selectpicker('val', urlParams.get('petugas'));
          //   console.log('petugas', urlParams.get('petugas'));

          //  // setTimeout(function(){ $('#btn_cari').trigger('click'); }, 500);
          // }
          // else{
          //   $('#sel_petugas').selectpicker('val', "00");
          //   console.log('semua petugas');
          // }

          //$('#sel_rbm').selectpicker('refresh');
        });
    });

    $('#sel_unitup').change(function(){

      $('#sel_petugas').empty();
      $('#sel_rbm').empty();
      $.getJSON('../controller/referensi/getPetugasPemutusan.php?unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val(), function(data){
          
          $.each(data.rows,function(i,v){
              $('#sel_petugas').append('<option value="'+v.kode+'">'+v.nama+'</option>');
          });
          // $('#sel_petugas').append('<option value="00">SEMUA PETUGAS</option>');
          $('#sel_petugas').selectpicker('refresh');

          if(urlParams.has('petugas')){
            $('#sel_petugas').selectpicker('val', urlParams.get('petugas'));
            console.log('petugas', urlParams.get('petugas'));

           // setTimeout(function(){ $('#btn_cari').trigger('click'); }, 500);
          }
          // else{
          //   $('#sel_petugas').selectpicker('val', "00");
          //   console.log('semua petugas');
          // }

          //$('#sel_rbm').selectpicker('refresh');
        });
    });

    $('#sel_petugas').change(function(){

      $('#sel_rbm').empty();
      $.getJSON('../controller/referensi/getRBMPemutusan.php?unitup='+$('#sel_unitup').val()+'&petugas='+$('#sel_petugas').val()+'&blth='+$('#sel_blth').val(), function(data){
          
          $.each(data.rows,function(i,v){
              $('#sel_rbm').append('<option value="'+v.kode+'">'+v.nama+'</option>');
          });
          //$('#sel_rbm').append('<option value="00">SEMUA RBM</option>');
          $('#sel_rbm').selectpicker('refresh');

          if(urlParams.has('rbm')){
            $('#sel_rbm').selectpicker('val', urlParams.get('rbm'));
            console.log('rbm', urlParams.get('rbm'));

            setTimeout(function(){ $('#btn_cari').trigger('click'); }, 500);
          }
          // else{
          //   $('#sel_rbm').selectpicker('val', "00");
          //   console.log('semua rbm');
          // }

          //$('#sel_rbm').selectpicker('refresh');
        });
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_wo_pemutusan')
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
            "url": '../controller/pemutusan/getReassignWOPemutusan.php',
            "type": "POST",
            "timeout": 60000
        },
        //responsive: true,
        columns: [
          {
            data: "KODEPETUGAS",
            visible: true
          },
          {
            data: "RBM",
            visible: true
          },
          {
            data: "LANGKAH",
            visible: true
          },
          {
            data: "UNITAP",
            visible: false
          },
          {
            data: "UNITUP",
            visible: false
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
            data: "RPTAG",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RPBK",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "STATUS",
            visible: true
          },
          {
            data: "GARDU",
            visible: true
          },
          {
            data: "TIANG",
            visible: true
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        select: {
            style:  'multi+shift'
        },
        buttons: [
            { extend: 'colvis', text: 'Columns' },
            // { extend: 'excelHtml5', 
            //   text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Download CSV', 
            //   titleAttr: 'Download ke CSV',
            //   footer: true,
            //   action: function ( e, dt, node, config ) {
            //       // alert( 'Download!' );
            //       // //this.disable(); // disable button
            //       // console.log('dt', dt);
            //       // console.log('node', node);
            //       window.open('../controller/pemutusan/expCSVMonWOPemutusan.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&petugas='+petugas+'&blth='+blth+'&status='+status );
            //   }
            // },
        ],
        "scrollY": 370,
        "scrollX": true,
        "paging": false,
        // lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        // pageLength: 100,
        "order": [[0, 'asc'],[1, 'asc'],[2, 'asc']],
    });


    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        unitupi = $('#sel_unitupi').val();
        unitap = $('#sel_unitap').val();
        unitup = $('#sel_unitup').val();
        petugas = $('#sel_petugas').val();
        blth = $('#sel_blth').val();
        rbm = $('#sel_rbm').val();
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

        table.ajax.url( '../controller/pemutusan/getReassignWOPemutusan.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&petugas='+petugas+'&blth='+blth+'&rbm='+rbm ).load();
        //table.ajax.url( '../controller/pemutusan/getDatapemutusan.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    });


    $( 'body' ).on( 'click', '#btn_wo', function(btn) {

        var count = table.rows( { selected: true } ).count();
        if(count>0){
          unitupi = $('#sel_unitupi').val();
          unitap = $('#sel_unitap').val();
          unitup = $('#sel_unitup').val();
          petugas = $('#sel_petugas').val();
          petugas_baru = $('#sel_petugas_baru').val();
          blth = $('#sel_blth').val();
          rbm = $('#sel_rbm').val();

          var idpels='';
          table.rows( { selected: true } ).data().each( function ( d, j ) {
              if(d.IDPEL)
                idpels += d.IDPEL+',';
          } );
          idpels=idpels.slice(0, -1);
          console.log('idpels',idpels);

          $('div.content-body').block({ message: 'Mengupdate Petugas WO Pemutusan...' });
          $.post( '../controller/pemutusan/updateWOPemutusanPelanggan.php',{ 
              unitupi: unitupi, 
              unitap: unitap, 
              unitup: unitup, 
              blth: blth, 
              idpels: idpels, 
              petugas_baru: petugas_baru, 
          })
          .done(function( data ) {
            $('div.content-body').unblock();
            $.notify({
                  message: data.msg 
              },{
                  // settings
                type: (data.success)?'success':'warning', 
                offset: {
                    y: 20, 
                    x: 320
                },
                spacing: 5,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                placement: {
                    from: 'top', 
                    align: 'right'
                },
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });

            if(data.success)
              table
                .rows( '.selected' )
                .remove()
                .draw();
          
          });
        }else{

          $.notify({
                message: 'Silahkan pilih WO pelanggan yang akan diubah Petugas Pemutusannya!' 
            },{
                // settings
              type: 'warning', 
              offset: {
                  y: 20, 
                  x: 320
              },
              spacing: 5,
              z_index: 1031,
              delay: 5000,
              timer: 1000,
              placement: {
                  from: 'top', 
                  align: 'right'
              },
              animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
              }
          });

        }

    });


});
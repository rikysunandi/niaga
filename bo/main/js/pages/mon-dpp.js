$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var unitupi, unitap, unitup, rbm, status_lalu, blth, pic, status_bayar, is_first;

    is_first=true;

    if(urlParams.has('status_lalu')){
      $('#sel_status_lalu').selectpicker('val', urlParams.get('status_lalu'));
    }

    if(urlParams.has('pic')){
      $('#sel_pic').selectpicker('val', urlParams.get('pic'));
    }

    if(urlParams.has('status_bayar')){
      $('#sel_status_bayar').selectpicker('val', urlParams.get('status_bayar'));
    }

    if(urlParams.has('blth')){
      $('#sel_blth').val(urlParams.get('blth'));
    }
    
    $('#sel_unitup').change(function(){

      $('#sel_rbm').empty();
      $.getJSON('../controller/referensi/getRBM.php?unitup='+$('#sel_unitup').val(), function(data){
          console.log('LOAD RBM 1');
          $.each(data.rows,function(i,v){
              $('#sel_rbm').append('<option value="'+v.kode+'">'+v.nama+'</option>');
          });
          $('#sel_rbm').append('<option value="00">SEMUA RBM</option>');
          $('#sel_rbm').selectpicker('refresh');
          
          if(urlParams.has('rbm')){
            $('#sel_rbm').selectpicker('val', urlParams.get('rbm'));
            console.log('rbm', urlParams.get('rbm'));

            if(is_first){
              setTimeout(function(){ $('#btn_cari').trigger('click'); }, 800);
              is_first=false;
            }
          }
          else{
            $('#sel_rbm').selectpicker('val', "00");
            console.log('semua rbm');
          }

          //$('#sel_rbm').selectpicker('refresh');
        });
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_dpp')
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
        "deferLoading": 1000,
        "ajax": {
            "url": '../controller/sorek/getDetailDPP.php',
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
            data: "PIC",
            visible: true
          },
          {
            data: "KODEPETUGAS",
            visible: true
          },
          {
            data: "RBM",
            visible: true
          },
          {
            data: "STATUS_LALU",
            render: function ( data, type, row ) {
                  if(data){
                    if(data == 'LANCAR')
                        return '<span class="label label-success">'+data+'</span>';
                    else if(data == 'BARU')
                        return '<span class="label label-warning">'+data+'</span>';
                    else if(data == 'IRISAN')
                        return '<span class="label label-danger">'+data+'</span>';
                  }else
                    return null;
                },
          },
          {
            data: "PEMKWH",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RPPTL",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TGLBAYAR",
            render: function ( data, type, row ) {
                  if(data)
                    return data.substring(0,10);
                  else
                    return null;
                },
          },
          {
            data: "PERCEPATAN",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_TUNGGAKAN",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "STATUS_BAYAR",
            render: function ( data, type, row ) {
                  if(data){
                    if(data == 'LANCAR')
                        return '<span class="label label-success">'+data+'</span>';
                    else if(data == 'BARU')
                        return '<span class="label label-warning">'+data+'</span>';
                    else if(data == 'IRISAN')
                        return '<span class="label label-danger">'+data+'</span>';
                  }else
                    return null;
                },
          },
          {
            data: "KODESTATUS",
            visible: false
          },
          {
            data: "SUMBER_SOREK",
            visible: true
          },
          {
            data: "TGL_INPUT",
            visible: true
          },
          {
            data: "TGL_UPDATE",
            visible: true
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        buttons: [
           // { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;&nbsp;Copy', footer: true },
            //{ extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true },
            //{ extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            
            { 
              text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', 
              titleAttr: 'Download CSV',
              //"sTooltip": "My CSV button's tooltip",
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open('../controller/sorek/expCSVDetailDPP.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&rbm='+rbm+'&blth='+blth+'&status_lalu='+status_lalu+'&pic='+pic+'&status_bayar='+status_bayar );
              }

            },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        "order": [[2, 'asc']],
    });

    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        console.log('Klikk');
        unitupi=$('#sel_unitupi').val();
        unitap=$('#sel_unitap').val();
        unitup=$('#sel_unitup').val();
        rbm=$('#sel_rbm').val();
        status_lalu=$('#sel_status_lalu').val();
        blth=$('#sel_blth').val();
        pic=$('#sel_pic').val();
        status_bayar=$('#sel_status_bayar').val();

        table.ajax.url( '../controller/sorek/getDetailDPP.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&rbm='+rbm+'&blth='+blth+'&status_lalu='+status_lalu+'&pic='+pic+'&status_bayar='+status_bayar ).load();
    });
    
    if(urlParams.has('unitap')){

      // $('#sel_unitupi').val(urlParams.get('unitupi'));
      // $('#sel_unitap').val(urlParams.get('unitap'));
      // $('#sel_unitupi').selectpicker('val', urlParams.get('unitupi'));
      // $('#sel_unitap').selectpicker('val', urlParams.get('unitap'));
      // $('#sel_unitup').selectpicker('val', urlParams.get('unitup'));
      $('#sel_blth').selectpicker('val', urlParams.get('blth'));
      $('#sel_status').selectpicker('val', urlParams.get('status'));

      $('#sel_rbm').empty();
      $.getJSON('../controller/referensi/getRBM.php?unitup='+urlParams.get('unitup'), function(data){
          console.log('LOAD RBM 2');
          $('#sel_rbm').append('<option value="00">SEMUA RBM</option>');
          $.each(data.rows,function(i,v){
              $('#sel_rbm').append('<option value="'+v.kode+'">'+v.nama+'</option>');
          });
          $('#sel_rbm').selectpicker('refresh');

          if(urlParams.has('rbm')){
            $('#sel_rbm').selectpicker('val', urlParams.get('rbm'));
            console.log('rbm', urlParams.get('rbm'));
          }
          else{
            $('#sel_rbm').selectpicker('val', "00");
            console.log('semua rbm');
          }

          //$('#sel_rbm').selectpicker('refresh');
          setTimeout(function(){ $('#btn_cari').trigger('click'); }, 2000);
      });

      //$('.selectpicker').selectpicker('refresh');
      
    }


});
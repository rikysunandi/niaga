$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var unitupi, unitap, unitup, blth;

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_wo_pemutusan')
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
            "url": '../controller/pemutusan/getWOPemutusan.php',
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
            data: "ULP",
            visible: true
          },
          {
            data: "KODEPETUGAS",
            visible: true
          },
          {
            data: "JML_RBM",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          
          },
          {
            data: "JML_LANCAR",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_BARU",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_IRISAN",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TOTAL_WO",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TOTAL_RPPTL",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TOTAL_RPTAG",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TOTAL_RPBK",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
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
                  window.open('../controller/pemutusan/expCSVWOPemutusan.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() );
              }

            },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 360,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[50, 100, -1], [50, 100, "All"]],
        pageLength: 100,
        order: [[0, 'asc'],[1, 'asc']],

        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 4;
          while(j < nb_cols){
            var pageTotal = api
                  .column( j, { page: 'current'} )
                  .data()
                  .reduce( function (a, b) {
                      return Number(a) + Number(b);
                  }, 0 );
            // Update footer
            $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
            j++;
          } 
        }
        // rowGroup: {
        //     startRender: null,
        //     endRender: function ( rows, group ) {
        //         var jml_rbm = rows
        //             .data()
        //             .pluck('JML_RBM')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0) ;
        //         jml_rbm = $.fn.dataTable.render.number(',', '.', 0, '').display( jml_rbm );
 
        //         var jml_baru = rows
        //             .data()
        //             .pluck('JML_BARU')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0) ;
        //         jml_baru = $.fn.dataTable.render.number(',', '.', 0, '').display( jml_baru );
 
        //         var jml_irisan = rows
        //             .data()
        //             .pluck('JML_IRISAN')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0) ;
        //         jml_irisan = $.fn.dataTable.render.number(',', '.', 0, '').display( jml_irisan );
 
        //         var total_wo = rows
        //             .data()
        //             .pluck('TOTAL_WO')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0) ;
        //         total_wo = $.fn.dataTable.render.number(',', '.', 0, '').display( total_wo );
 
 
        //         return $('<tr/>')
        //             .append( '<td colspan="4">TOTAL '+group+'</td>' )
        //             .append( '<td>'+jml_rbm+'</td>' )
        //             .append( '<td>'+jml_baru+'</td>' )
        //             .append( '<td>'+jml_irisan+'</td>' )
        //             .append( '<td>'+total_wo+'</td>' );
        //     },
        //     dataSrc: 'ULP'
        // }
    });

    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        unitupi = $('#sel_unitupi').val();
        unitap = $('#sel_unitap').val();
        unitup = $('#sel_unitup').val();
        blth = $('#sel_blth').val();
        table.ajax.url( '../controller/pemutusan/getWOPemutusan.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    });

    $( 'body' ).on( 'click', '#btn_wo', function(btn) {

        $('div.content-body').block({ message: 'Menetapkan WO Pemutusan...' });
        $.post( '../controller/pemutusan/tetapkanWOPemutusan.php',{ 
            unitupi: unitupi, 
            unitap: unitap, 
            unitup: unitup, 
            blth: blth, 
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
        
        });

    });




});
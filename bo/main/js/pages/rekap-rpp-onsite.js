$(document).ready(function () {

    "use strict";



    // $('.input-daterange-datepicker').daterangepicker({
    //     buttonClasses: ['btn', 'btn-sm'],
    //     applyClass: 'btn-danger',
    //     cancelClass: 'btn-inverse',
    //     opens: 'left',
    //     startDate: '13/06/2022',
    //     endDate: moment(),
    //     locale: {
    //       format: 'DD/MM/YYYY'
    //     }
    // });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_onsite_petugas')
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
            "url": '../controller/pemeriksaan_lpb/getRekapRPPOnsite.php',
            "type": "POST",
            "timeout": 180000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          {
            data: "UNITAP",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "UNITUP",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "ULP",
            visible: false,
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "RPP_PETUGAS",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "RPP",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "RANGE_TGL_INPUT",
          },
          {
            data: "JML_ON_DESK",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_SESUAI_WO",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_SISIPAN",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_PAGAR_KUNCI",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_TIDAK_DITEMUKAN",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_DOUBLE",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_SISIPAN_RPP_LAIN",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "REAL_PETUGAS",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "REAL_RPP",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "REAL_TARGET",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "SISA_WO",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
        ],
        dom:
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthChange: false,
        buttons: [
            
            { extend: 'excelHtml5', 
              text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Download CSV', 
              titleAttr: 'Download ke CSV',
              footer: true,
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open('../controller/pemeriksaan_lpb/expCSVRekapOnsite.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() );
              }
            },
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        "order": [[0,'asc'],[1,'asc'],[3,'asc'], [4,'asc']],
      //   footerCallback: function ( row, data, start, end, display ) {
      //     var api = this.api();
      //     //console.log('footerCallback', api);
      //     var nb_cols = api.columns().nodes().length;
      //     var j = 8;
      //     while(j < nb_cols){
      //       var pageTotal = api
      //             .column( j, { page: 'current'} )
      //             .data()
      //             .reduce( function (a, b) {
      //                 return Number(a) + Number(b);
      //             }, 0 );
      //       // Update footer
      //       $( api.column( j ).footer() ).html( $.fn.dataTable.render.number(',', '.', 0, '').display( pageTotal ));
      //       j++;
      //     } 
      // }
    });



    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/pemeriksaan_lpb/getRekapRPPOnsite.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() ).load();
    });

});
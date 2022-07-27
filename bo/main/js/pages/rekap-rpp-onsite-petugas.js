$(document).ready(function () {

    "use strict";



    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: '13/06/2022',
        endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });

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
            "url": '../controller/pemeriksaan_lpb/getRekapRPPOnsitePetugas.php',
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
            data: "UP3",
            visible: false,
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
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "USER_INPUT",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "TGL_INPUT",
            render: function ( data, type, row ) {
                    return data.substring(0,10);
                },
          },
          {
            data: "RPP",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "JML_ON_DESK",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_ON_SITE",
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
                  window.open('../controller/pemeriksaan_lpb/expCSVRekapOnsitePetugas.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_upload_from='+$('#tgl_upload_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_upload_to='+$('#tgl_upload_range').data('daterangepicker').endDate.format('YYYY-MM-DD') );
              }
            },
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        "order": [[0,'asc'],[2,'asc'],[4,'asc'], [5,'desc']],
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
        table.ajax.url( '../controller/pemeriksaan_lpb/getRekapRPPOnsitePetugas.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_upload_from='+$('#tgl_upload_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_upload_to='+$('#tgl_upload_range').data('daterangepicker').endDate.format('YYYY-MM-DD') ).load();
    });

});
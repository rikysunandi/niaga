$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_upload_sorek')
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
            "url": '../controller/sorek/getUploadSorek.php',
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
            data: "UP3",
            visible: false
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
            data: "JML_PLG",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "PEMKWH",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "RPPTL",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "EIS_LEMBAR",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "EIS_PEMKWH",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "EIS_RPPTL",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "SELISIH",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , 
            render: function ( data, type, row ) {
                var cls;
                //console.log($(this));
                if (data == 0) 
                    return '<span class="text-success">'+
                        $.fn.dataTable.render.number(".", ",", 0, '').display(data)+'</span>';
                else
                    return $.fn.dataTable.render.number(".", ",", 0, '').display(data);

            },
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            { extend: 'colvis', text: 'Columns' },
            { extend: 'csvHtml5', 
              text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', 
              titleAttr: 'Download ke CSV',
              footer: true
            },
            { extend: 'excelHtml5', 
              text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', 
              titleAttr: 'Download ke Excel',
              footer: true
            },
            { extend: 'pdfHtml5', 
              text: '<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;PDF', 
              titleAttr: 'Download ke PDF',
              footer: true
            },
        ],
        //"scrollY": 520,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[0, 'asc'],[3, 'asc']],
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
    });


    $( 'body' ).on( 'click', '#btn_cari', function(btn) {

          table
            .clear();

        table.ajax.url( '../controller/sorek/getUploadSorek.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    });


});
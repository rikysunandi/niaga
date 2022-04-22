$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
   
    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table_up3 = $('#tbl_rekap_pemutusan_up3')
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
            "url": '../controller/pemutusan/getRekapPemutusanUP3.php',
            "type": "POST",
            "timeout": 60000
        },
        //responsive: true,
        columns: [
          {
            data: "UNITUPI",
            visible: true
          },
          {
            data: "UNITAP",
            visible: true
          },
          {
            data: "UP3",
            visible: true
          },
          {
            data: "JML_PETUGAS",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_WO",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "PERSEN_TOTAL",
            visible: true,
            "sClass" : "text-right" , 
            render: function ( data, type, row ) {
                var cls;
                //console.log($(this));
                if (data < 50) {
                    cls='danger';
                  }else if (data < 80) {
                    cls='warning';
                  }else {
                    cls='success';
                  }
              return '<span class="text-'+cls+'">'+
                $.fn.dataTable.render.number(".", ",", 2, '').display(data)+'%</span>';

            },
          },
          {
            data: "RATA_PLG_PER_PETUGAS",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_GT_25",
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
        //"scrollY": 370,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[13, 'desc'],[4, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 3;
          var wo, jml;
          while(j < nb_cols){
            if(j==13){

                var persen;
                persen = ((jml/wo))*100;
                var cls;

                if (persen < 50) {
                    cls='danger';
                  }else if (persen < 80) {
                    cls='warning';
                  }else {
                    cls='success';
                  }

                $( api.column( j ).footer() ).html('<span class="text-'+cls+'">'+$.fn.dataTable.render.number(".", ",", 2, '').display(persen)+'%</span>');
            }else{
                var pageTotal = api
                    .column( j, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return Number(a) + Number(b);
                    }, 0 );

                if(j==4)
                  wo=pageTotal;
                if(j==12)
                  jml=pageTotal;
                // Update footer

                if(j==14)
                  $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal/data.length));
                else
                  $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
            }
            
            // var pageTotal = api
            //       .column( j, { page: 'current'} )
            //       .data()
            //       .reduce( function (a, b) {
            //           return Number(a) + Number(b);
            //       }, 0 );
            // // Update footer
            // $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
            j++;
          } 
        }
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_pemutusan_ulp')
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
            "url": '../controller/pemutusan/getRekapPemutusanULP.php',
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
            data: "JML_PETUGAS",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_WO",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "PERSEN_TOTAL",
            visible: true,
            "sClass" : "text-right" , 
            render: function ( data, type, row ) {
                var cls;
                //console.log($(this));
                if (data < 50) {
                    cls='danger';
                  }else if (data < 80) {
                    cls='warning';
                  }else {
                    cls='success';
                  }
              return '<span class="text-'+cls+'">'+
                $.fn.dataTable.render.number(".", ",", 2, '').display(data)+'%</span>';

            },
          },
          {
            data: "RATA_PLG_PER_PETUGAS",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_21",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_22",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_23",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_24",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_BY_SYSTEM_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_MANDIRI_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_LUNAS_DITEMPAT_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_SEGEL_MCB_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_MCB_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_CABUT_APP_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RUMAH_KOSONG_GT_25",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_GT_25",
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
        "scrollY": 260,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[13, 'desc'],[4, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 3;
          var wo, jml;
          while(j < nb_cols){
            if(j==13){

                var persen;
                persen = ((jml/wo))*100;
                var cls;

                if (persen < 50) {
                    cls='danger';
                  }else if (persen < 80) {
                    cls='warning';
                  }else {
                    cls='success';
                  }

                $( api.column( j ).footer() ).html('<span class="text-'+cls+'">'+$.fn.dataTable.render.number(".", ",", 2, '').display(persen)+'%</span>');
            }else{
                var pageTotal = api
                    .column( j, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return Number(a) + Number(b);
                    }, 0 );

                if(j==4)
                  wo=pageTotal;
                if(j==12)
                  jml=pageTotal;
                // Update footer
                
                if(j==14)
                  $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal/data.length));
                else
                  $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
            }
            
            // var pageTotal = api
            //       .column( j, { page: 'current'} )
            //       .data()
            //       .reduce( function (a, b) {
            //           return Number(a) + Number(b);
            //       }, 0 );
            // // Update footer
            // $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
            j++;
          } 
        }

        // fixedColumns:   {
        //     leftColumns: 3
        // },
        
        // rowGroup: {
        //     startRender: null,
        //     endRender: function ( rows, group ) {

        //         var SUM_JML_LUNAS_21 = rows
        //             .data()
        //             .pluck('JML_LUNAS_21')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_21 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_21 );

        //         var SUM_JML_PUTUS_21 = rows
        //             .data()
        //             .pluck('JML_PUTUS_21')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_21 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_21 );

        //         var SUM_JML_PLG_21 = rows
        //             .data()
        //             .pluck('JML_PLG_21')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_21 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_21 );


        //         var SUM_JML_LUNAS_22 = rows
        //             .data()
        //             .pluck('JML_LUNAS_22')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_22 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_22 );

        //         var SUM_JML_PUTUS_22 = rows
        //             .data()
        //             .pluck('JML_PUTUS_22')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_22 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_22 );

        //         var SUM_JML_PLG_22 = rows
        //             .data()
        //             .pluck('JML_PLG_22')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_22 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_22 );


        //         var SUM_JML_LUNAS_23 = rows
        //             .data()
        //             .pluck('JML_LUNAS_23')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_23 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_23 );

        //         var SUM_JML_PUTUS_23 = rows
        //             .data()
        //             .pluck('JML_PUTUS_23')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_23 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_23 );

        //         var SUM_JML_PLG_23 = rows
        //             .data()
        //             .pluck('JML_PLG_23')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_23 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_23 );


        //         var SUM_JML_LUNAS_24 = rows
        //             .data()
        //             .pluck('JML_LUNAS_24')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_24 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_24 );

        //         var SUM_JML_PUTUS_24 = rows
        //             .data()
        //             .pluck('JML_PUTUS_24')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_24 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_24 );

        //         var SUM_JML_PLG_24 = rows
        //             .data()
        //             .pluck('JML_PLG_24')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_24 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_24 );


        //         var SUM_JML_LUNAS_25 = rows
        //             .data()
        //             .pluck('JML_LUNAS_25')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_25 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_25 );

        //         var SUM_JML_PUTUS_25 = rows
        //             .data()
        //             .pluck('JML_PUTUS_25')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_25 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_25 );

        //         var SUM_JML_PLG_25 = rows
        //             .data()
        //             .pluck('JML_PLG_25')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_25 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_25 );


        //         var SUM_JML_LUNAS_26 = rows
        //             .data()
        //             .pluck('JML_LUNAS_26')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_26 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_26 );

        //         var SUM_JML_PUTUS_26 = rows
        //             .data()
        //             .pluck('JML_PUTUS_26')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_26 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_26 );

        //         var SUM_JML_PLG_26 = rows
        //             .data()
        //             .pluck('JML_PLG_26')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_26 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_26 );


        //         var SUM_JML_LUNAS_27 = rows
        //             .data()
        //             .pluck('JML_LUNAS_27')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_27 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_27 );

        //         var SUM_JML_PUTUS_27 = rows
        //             .data()
        //             .pluck('JML_PUTUS_27')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_27 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_27 );

        //         var SUM_JML_PLG_27 = rows
        //             .data()
        //             .pluck('JML_PLG_27')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_27 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_27 );


        //         var SUM_JML_LUNAS_28 = rows
        //             .data()
        //             .pluck('JML_LUNAS_28')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_28 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_28 );

        //         var SUM_JML_PUTUS_28 = rows
        //             .data()
        //             .pluck('JML_PUTUS_28')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_28 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_28 );

        //         var SUM_JML_PLG_28 = rows
        //             .data()
        //             .pluck('JML_PLG_28')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_28 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_28 );


        //         var SUM_JML_LUNAS_29 = rows
        //             .data()
        //             .pluck('JML_LUNAS_29')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_29 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_29 );

        //         var SUM_JML_PUTUS_29 = rows
        //             .data()
        //             .pluck('JML_PUTUS_29')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_29 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_29 );

        //         var SUM_JML_PLG_29 = rows
        //             .data()
        //             .pluck('JML_PLG_29')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_29 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_29 );


        //         var SUM_JML_LUNAS_30 = rows
        //             .data()
        //             .pluck('JML_LUNAS_30')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_30 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_30 );

        //         var SUM_JML_PUTUS_30 = rows
        //             .data()
        //             .pluck('JML_PUTUS_30')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_30 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_30 );

        //         var SUM_JML_PLG_30 = rows
        //             .data()
        //             .pluck('JML_PLG_30')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_30 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_30 );


        //         var SUM_JML_LUNAS_31 = rows
        //             .data()
        //             .pluck('JML_LUNAS_31')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS_31 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS_31 );

        //         var SUM_JML_PUTUS_31 = rows
        //             .data()
        //             .pluck('JML_PUTUS_31')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS_31 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS_31 );

        //         var SUM_JML_PLG_31 = rows
        //             .data()
        //             .pluck('JML_PLG_31')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG_31 = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG_31 );

        //         var SUM_JML_LUNAS = rows
        //             .data()
        //             .pluck('JML_LUNAS')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_LUNAS = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_LUNAS );

        //         var SUM_JML_PUTUS = rows
        //             .data()
        //             .pluck('JML_PUTUS')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PUTUS = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PUTUS );

        //         var SUM_JML_PLG = rows
        //             .data()
        //             .pluck('JML_PLG')
        //             .reduce( function (a, b) {
        //                 return a + b*1;
        //             }, 0);
        //         SUM_JML_PLG = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_JML_PLG );

        //         if( !( group == 'T' || group == 'C' || group == 'L' ))
        //         return $('<tr/>')
        //             .append( '<td colspan="3">Jumlah '+group+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_21+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_21+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_21+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_22+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_22+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_22+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_23+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_23+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_23+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_24+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_24+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_24+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_25+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_25+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_25+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_26+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_26+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_26+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_27+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_27+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_27+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_28+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_28+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_28+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_29+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_29+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_29+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_30+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_30+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_30+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS_31+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS_31+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG_31+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_LUNAS+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PUTUS+'</td>' )
        //             .append( '<td class="text-right">'+SUM_JML_PLG+'</td>' );
        //     },
        //     dataSrc: 'UNITAP'

        // },
    });


    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        console.log('Klikk');
        table_up3.ajax.url( '../controller/pemutusan/getRekapPemutusanUP3.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
        table.ajax.url( '../controller/pemutusan/getRekapPemutusanULP.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    });


});
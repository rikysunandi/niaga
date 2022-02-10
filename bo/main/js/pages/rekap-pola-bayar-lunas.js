$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    
    var unitupi, unitap, unitup, blth;
    var chart_pelunasan_irisan, chart_pelunasan_baru, chart_pelunasan_lancar ;

    $('#sel_unitupi').val('53');

    var table = $('#tbl_rekap_lunas_intimasi')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!', data);
        $('div.content-body').unblock();

      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        "ajax": {
            "url": '#',
            "type": "POST",
            "timeout": 60000
        },
        //language: { "thousands": ".", "decimal": ","},
        //responsive: true,
        columns: [
          {
            data: "UNIT",
            visible: false
          },
          {
            data: "NAMA",
            visible: true
          },
          {
            data: "TARGET_IRISAN",
            title: "IRISAN",
            ariaTitle: "WO IRISAN",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TARGET_BARU",
            title: "BARU",
            ariaTitle: "WO BARU",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TARGET_TOTAL",
            title: "TOTAL",
            ariaTitle: "WO TOTAL",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "MUTASI",
            type: 'number',
            visible: false,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_IRISAN",
            type: 'number',
            visible: false,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_BARU",
            type: 'number',
            visible: false,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_TOTAL",
            type: 'number',
            visible: false,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_IRISAN",
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
          {
            data: "SALDO_BARU",
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
          {
            data: "SALDO_TOTAL",
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
          {
            data: "SALDO_MUP3",
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
          {
            data: "SALDO_MBSAR",
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
          {
            data: "SALDO_MULP",
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
          {
            data: "SALDO_BILLER",
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
            data: "LATEST_TGLBAYAR",
            visible: false
          },
        ],
        // rowCallback: function( row, data, index ) {
        //   if (data.PERSEN_TOTAL < 50) {
        //     $('td:eq(12)', row).addClass('bg-danger-lighten-2');
        //   }else if (data.PERSEN_TOTAL < 80) {
        //     $('td:eq(12)', row).addClass('bg-warning-lighten-2');
        //   }else {
        //     $('td:eq(12)', row).addClass('bg-success-lighten-2');
        //   }
        // }, 
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
              footer: false
            },
            { 
                extend: 'excelHtml5', 
                text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', 
                titleAttr: 'Download ke Excel',
                title: null,
                exportOptions: {
                  columns: ':visible',
                  format: {
                      body: function(data, row, column, node) {
                        data = $('<p>' + data + '</p>').text();
                        return $.isNumeric(data.replace('.', '')) ? data.replace('.', '') : data;
                      }
                  }
                },
                filename: function(){
                    return 'REKAP_PELUNASAN_' +  moment().format('YYYYMMDDHHmmss');
                },
                footer: false
            },
        ],
        //"scrollY": 430,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[16, 'desc'],[17, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var wo, jml;
          var j = 2;
          while(j < nb_cols){
            if(j==nb_cols-2){

                var persen;
                persen = (1-(jml/wo))*100;
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
                if(j==11)
                jml=pageTotal;
                // Update footer
                $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
            }

            j++;
          } 
        }
    });


    var table_up = $('#tbl_rekap_lunas_intimasi_up')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!', data);
        $('div.content-body').unblock();

      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        "ajax": {
            "url": '#',
            "type": "POST",
            "timeout": 60000
        },
        //language: { "thousands": ".", "decimal": ","},
        //responsive: true,
        columns: [
          {
            data: "UNIT",
            visible: true
          },
          {
            data: "UNITAP",
            visible: false
          },
          {
            data: "NAMA",
            visible: true
          },
          {
            data: "TARGET_IRISAN",
            title: "IRISAN",
            ariaTitle: "WO IRISAN",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TARGET_BARU",
            title: "BARU",
            ariaTitle: "WO BARU",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TARGET_TOTAL",
            title: "TOTAL",
            ariaTitle: "WO TOTAL",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "MUTASI",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_IRISAN",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_BARU",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_TOTAL",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_IRISAN",
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
          {
            data: "SALDO_BARU",
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
          {
            data: "SALDO_TOTAL",
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
          {
            data: "SALDO_MUP3",
            type: 'number',
            visible: false,
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
          {
            data: "SALDO_MBSAR",
            type: 'number',
            visible: false,
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
          {
            data: "SALDO_MULP",
            type: 'number',
            visible: false,
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
          {
            data: "SALDO_BILLER",
            type: 'number',
            visible: false,
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
            data: "LATEST_TGLBAYAR",
            visible: false
          },
        ],
        // rowCallback: function( row, data, index ) {
        //   if (data.PERSEN_TOTAL < 50) {
        //     $('td:eq(12)', row).addClass('bg-danger-lighten-2');
        //   }else if (data.PERSEN_TOTAL < 80) {
        //     $('td:eq(12)', row).addClass('bg-warning-lighten-2');
        //   }else {
        //     $('td:eq(12)', row).addClass('bg-success-lighten-2');
        //   }
        // }, 
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
              footer: false
            },
            { 
                extend: 'excelHtml5', 
                text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', 
                titleAttr: 'Download ke Excel',
                title: null,
                exportOptions: {
                  columns: ':visible',
                  format: {
                      body: function(data, row, column, node) {
                        data = $('<p>' + data + '</p>').text();
                        return $.isNumeric(data.replace('.', '')) ? data.replace('.', '') : data;
                      }
                  }
                },
                filename: function(){
                    return 'REKAP_PELUNASAN_' +  moment().format('YYYYMMDDHHmmss');
                },
                footer: false
            },
        ],
        "scrollY": 260,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[17, 'desc'],[18,'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var wo, jml;
          var j = 3;
          while(j < nb_cols){
            if(j==nb_cols-2){

                var persen;
                persen = (1-(jml/wo))*100;
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

                if(j==5)
                wo=pageTotal;
                if(j==12)
                jml=pageTotal;
                // Update footer
                $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
            }

            j++;
          } 
        }
    });


    function addAlpha(color, opacity) {
        // coerce values so ti is between 0 and 1.
        var _opacity = Math.round(Math.min(Math.max(opacity || 1, 0), 1) * 255);
        return color + _opacity.toString(16).toUpperCase();
    }

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    // var table = $('#tbl_rekap_tglbayar')
    //   .on('preXhr.dt', function ( e, settings, data ) {
    //     console.log('preXhr!');
    //     $('div.content-body').block({ message: 'Mengambil data...' });
    //   })
    //   .on('xhr.dt', function ( e, settings, data ) {
    //     console.log('xhr!', data);
    //     $('div.content-body').unblock();

    //     $('div.chart-card').block({ message: 'Mengambil data...' });

    //     var jml_lunas = new Array();
    //     var labels = new Array();
    //     $.each(data.data, function(k, v){
    //       labels[k] = v.TGLBAYAR.substring(v.TGLBAYAR.length - 2);
    //       jml_lunas[k] = v.JML_PLG;
    //     });

    //     chart_pelunasan_irisan.data.labels= labels;
    //     chart_pelunasan_irisan.data.datasets[0].data = jml_lunas;
    //     chart_pelunasan_irisan.update();

    //     $('div.chart-card').unblock();

    //   })
    //   .DataTable( {
    //     "processing": true,
    //     "serverSide": true,
    //     "deferLoading": 0,
    //     "ajax": {
    //         "url": '../controller/pelunasan/getRekapTglBayar.php',
    //         "type": "POST",
    //         "timeout": 60000
    //     },
    //     //responsive: true,
    //     columns: [
    //       {
    //         data: "UNITAP",
    //         visible: true
    //       },
    //       {
    //         data: "UNITUP",
    //         visible: true
    //       },
    //       {
    //         data: "ULP",
    //         visible: true
    //       },
    //       {
    //         data: "TGLBAYAR",
    //         visible: true,
    //       },
    //       {
    //         data: "JML_PLG",
    //         type: 'number',
    //         visible: true,
    //         "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
    //       },
    //     ],
    //     dom:
    //        // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
    //         "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
    //         "<'row'<'col-sm-12 mb-2'tr>>" +
    //         "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
    //     buttons: [
    //         { extend: 'colvis', text: 'Columns' },
    //         { extend: 'csvHtml5', 
    //           text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', 
    //           titleAttr: 'Download ke CSV',
    //           footer: true
    //         },
    //         { extend: 'excelHtml5', 
    //           text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', 
    //           titleAttr: 'Download ke Excel',
    //           footer: true
    //         },
    //     ],
    //     "scrollY": 370,
    //     "scrollX": true,
    //     "paging": false,
    //     lengthMenu: [[25, 100, -1], [25, 100, "All"]],
    //     pageLength: 100,
    //     "order": [[3, 'asc']],
    //     footerCallback: function ( row, data, start, end, display ) {
    //       var api = this.api();
    //       //console.log('footerCallback', api);
    //       var nb_cols = api.columns().nodes().length;
    //       var j = 4;
    //       while(j < nb_cols){
    //         var pageTotal = api
    //               .column( j, { page: 'current'} )
    //               .data()
    //               .reduce( function (a, b) {
    //                   return Number(a) + Number(b);
    //               }, 0 );
    //         // Update footer
    //         $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
    //         j++;
    //       } 
    //     }
    // });


    // $( 'body' ).on( 'click', '#btn_cari', function(btn) {
    //     console.log('Klikk');
    //     table.ajax.url( '../controller/pelunasan/getRekapTglBayar.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    // });



    var ctx = document.getElementById("chart_pelunasan_irisan");
    ctx.height = 380;
    //ctx.width = 0.45*panel_width;
    chart_pelunasan_irisan = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [
                {
                  label: 'TARGET',
                  borderColor: '#74BCC7',
                  backgroundColor: addAlpha('#74BCC7', 0.1),
                  fill: true
                },
                {
                  label: 'SALDO IRISAN',
                  borderColor: '#EC5B43',
                  backgroundColor: '#EC5B43',
                  fill: false
                },
              ]
        },
        //plugins: [ChartDataLabels],
        options: {
            maintainAspectRatio: false, 
            responsive: true,
            barRadius: 2,
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each horizontal bar to be 2px wide
            elements: {
              bar: {
                borderWidth: 2,
              }
            },
            layout: {
              padding: {
                left: 40,
                right: 60,
                top: 20,
                bottom: 20
              }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: true //this will remove only the label
                    }
                },
                y: {
                    grid: {
                        display: true,
                        drawBorder: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                    },
                    ticks: {
                        display: true,
                        text: 'Jml Pelanggan (Ribu)',
                        callback: function(value, index, values) {
                                    return new Intl.NumberFormat('id-ID').format(value);
                                }
                    }
                },
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                      usePointStyle: true,
                    },
                    position: 'top'
                },
                title: {
                    display: false,
                },
                tooltip: {
                   bodyFontSize: 10,
                   callbacks: {
                        title: function(t) {
                            //.log('title', t);
                            return "TANGGAL "+t[0].label;
                        },
                        label: function(t) {
                            console.log('label', t);
                            var dstLabel = t.dataset.label;
                            var yLabel = t.raw;
                            return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format(yLabel)+' plg' ;
                        }
                   }
                },
            }
          },
    });

    var ctx2 = document.getElementById("chart_pelunasan_baru");
    ctx2.height = 380;
    //ctx.width = 0.45*panel_width;
    chart_pelunasan_baru = new Chart(ctx2, {
        type: 'line',
        data: {
            datasets: [
                {
                  label: 'TARGET',
                  borderColor: '#74BCC7',
                  backgroundColor: addAlpha('#74BCC7', 0.1),
                  fill: true
                },
                {
                  label: 'SALDO BARU',
                  borderColor: '#F2C36B',
                  backgroundColor: '#F2C36B',
                  fill: false
                },
              ]
        },
        //plugins: [ChartDataLabels],
        options: {
            maintainAspectRatio: false, 
            responsive: true,
            barRadius: 2,
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each horizontal bar to be 2px wide
            elements: {
              bar: {
                borderWidth: 2,
              }
            },
            layout: {
              padding: {
                left: 40,
                right: 60,
                top: 20,
                bottom: 20
              }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: true //this will remove only the label
                    }
                },
                y: {
                    grid: {
                        display: true,
                        drawBorder: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                    },
                    ticks: {
                        display: true,
                        text: 'Jml Pelanggan (Ribu)',
                        callback: function(value, index, values) {
                                    return new Intl.NumberFormat('id-ID').format(value);
                                }
                    }
                },
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                      usePointStyle: true,
                    },
                    position: 'top'
                },
                title: {
                    display: false,
                },
                tooltip: {
                   bodyFontSize: 10,
                   callbacks: {
                        title: function(t) {
                            //console.log('title', t);
                            return "TANGGAL "+t[0].label;
                        },
                        label: function(t) {
                            //console.log('label', t);
                            var dstLabel = t.dataset.label;
                            var yLabel = t.raw;
                            return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format(yLabel)+' plg' ;
                        }
                   }
                },
            }
          },
    });

    var ctx3 = document.getElementById("chart_pelunasan_lancar");
    ctx3.height = 380;
    //ctx.width = 0.45*panel_width;
    chart_pelunasan_lancar = new Chart(ctx3, {
        type: 'line',
        data: {
            datasets: [
                {
                  label: 'TARGET',
                  borderColor: '#74BCC7',
                  backgroundColor: addAlpha('#74BCC7', 0.1),
                  fill: true
                },
                {
                  label: 'SALDO LANCAR',
                  borderColor: '#135470',
                  backgroundColor: '#135470',
                  fill: false
                },
              ]
        },
        //plugins: [ChartDataLabels],
        options: {
            maintainAspectRatio: false, 
            responsive: true,
            barRadius: 2,
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each horizontal bar to be 2px wide
            elements: {
              bar: {
                borderWidth: 2,
              }
            },
            layout: {
              padding: {
                left: 40,
                right: 60,
                top: 20,
                bottom: 20
              }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: true //this will remove only the label
                    }
                },
                y: {
                    grid: {
                        display: true,
                        drawBorder: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                    },
                    ticks: {
                        display: true,
                        text: 'Jml Pelanggan (Ribu)',
                        callback: function(value, index, values) {
                                    return new Intl.NumberFormat('id-ID').format(value);
                                }
                    }
                },
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                      usePointStyle: true,
                    },
                    position: 'top'
                },
                title: {
                    display: false,
                },
                tooltip: {
                   bodyFontSize: 10,
                   callbacks: {
                        title: function(t) {
                            //console.log('title', t);
                            return "TANGGAL "+t[0].label;
                        },
                        label: function(t) {
                            //console.log('label', t);
                            var dstLabel = t.dataset.label;
                            var yLabel = t.raw;
                            return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format(yLabel)+' plg' ;
                        }
                   }
                },
            }
          },
    });


    //$('#tab_pelunasan a[href="#chart_irisan"]').tab('show');
    //$('#tab_pelunasan a[href="#chart_baru"]').tab('show');
    $('#tab_pelunasan a[href="#chart_irisan"]').tab('show');

    $( 'body' ).on( 'click', '#btn_cari', function(btn) {

      $('div.pelunasan').block({ message: 'Mengambil data...' });
      unitupi = $('#sel_unitupi').val();
      unitap = $('#sel_unitap').val();
      unitup = $('#sel_unitup').val();
      blth = $('#sel_blth').val();


      table.ajax.url( '../controller/pelunasan/getRekapPelunasanIntimasi.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&blth='+blth ).load();
      
      table_up.ajax.url( '../controller/pelunasan/getRekapPelunasanIntimasiUP.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&blth='+blth ).load();
        
        table_up.on( 'order.dt search.dt', function () {
            table_up.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

      $.getJSON('../controller/pelunasan/getPelunasanPolaBayarUnit.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&blth='+blth , function(data){


        chart_pelunasan_irisan.data.labels= data.tanggal;
        chart_pelunasan_irisan.data.datasets[0].label = 'TARGET';
        chart_pelunasan_irisan.data.datasets[0].data = data.target_irisan;
        chart_pelunasan_irisan.data.datasets[1].label = 'SALDO IRISAN';
        chart_pelunasan_irisan.data.datasets[1].data = data.jml_irisan;
        chart_pelunasan_irisan.update();

        chart_pelunasan_baru.data.labels= data.tanggal;
        chart_pelunasan_baru.data.datasets[0].label = 'TARGET';
        chart_pelunasan_baru.data.datasets[0].data = data.target_baru;
        chart_pelunasan_baru.data.datasets[1].label = 'SALDO BARU';
        chart_pelunasan_baru.data.datasets[1].data = data.jml_baru;
        chart_pelunasan_baru.update();

        chart_pelunasan_lancar.data.labels= data.tanggal;
        chart_pelunasan_lancar.data.datasets[0].label = 'TARGET';
        chart_pelunasan_lancar.data.datasets[0].data = data.target_lancar;
        chart_pelunasan_lancar.data.datasets[1].label = 'SALDO LANCAR';
        chart_pelunasan_lancar.data.datasets[1].data = data.jml_lancar;
        chart_pelunasan_lancar.update();

        $('div.pelunasan').unblock();

        $('div#table_lunas').block({ message: 'Mengambil data...' });
        var tr = '';
        $('div#table_lunas table tbody').empty();
        $.each(data.rows, function(k,v){
            tr += '<tr data-tanggal="'+v.tanggal+'" data-unitupi="'+unitupi+'" data-unitap="'+unitap+'" data-unitup="'+unitup+'" data-blth="'+blth+'" >';
            tr += '<td>'+v.tanggal+'</td>';
            tr += '<td class="text-right">'+v.awal_irisan+'</td>';
            tr += '<td class="text-right">'+v.jml_irisan+'</td>';
            tr += '<td class="text-right">'+v.saldo_irisan+'</td>';
            tr += '<td class="text-right">'+v.target_irisan+'</td>';
            tr += '<td class="text-right">'+v.real_irisan+'</td>';
            tr += '<td class="text-right">'+v.awal_baru+'</td>';
            tr += '<td class="text-right">'+v.jml_baru+'</td>';
            tr += '<td class="text-right">'+v.saldo_baru+'</td>';
            tr += '<td class="text-right">'+v.target_baru+'</td>';
            tr += '<td class="text-right">'+v.real_baru+'</td>';
            tr += '<td class="text-right">'+v.awal_lancar+'</td>';
            tr += '<td class="text-right">'+v.jml_lancar+'</td>';
            tr += '<td class="text-right">'+v.saldo_lancar+'</td>';
            tr += '<td class="text-right">'+v.target_lancar+'</td>';
            tr += '<td class="text-right">'+v.real_lancar+'</td>';
            tr += '</tr>';
        });
        $('div#table_lunas table tbody').append(tr);

        $('div#table_lunas').unblock();

      });


        

    });

    $('.btn-export').click(function(btn){
        var status = $(this).data('status');


        window.open('../controller/pelunasan/expCSVSaldoIntimasi.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&status='+status+'&blth='+blth );
          
    });



});
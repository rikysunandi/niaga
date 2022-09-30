$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
   
    var chart_tgl_bayar, chart_mom_tgl_bayar ;

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_unitap')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!', data);
        // $('div.content-body').unblock();

        // $('div.chart-card').block({ message: 'Mengambil data...' });

        // var jml_irisan = new Array();
        // var jml_baru = new Array();
        // var jml_lancar = new Array();
        // var jml_lunas = new Array();
        // var jml_lunas_1 = new Array();
        // var rp_irisan = new Array();
        // var rp_baru = new Array();
        // var rp_lancar = new Array();
        // var rp_lunas = new Array();
        // var rp_lunas_1 = new Array();
        // var labels = new Array();
        // $.each(data.data, function(k, v){
        //   labels[k] = v.TGLBAYAR.substring(v.TGLBAYAR.length - 2);
        //   jml_irisan[k] = v.LUNAS_IRISAN;
        //   jml_baru[k] = v.LUNAS_BARU;
        //   jml_lancar[k] = v.LUNAS_LANCAR;
        //   jml_lunas[k] = v.JML_LUNAS;
        //   //jml_lunas_1[k] = v.JML_LUNAS_1;
        //   rp_irisan[k] = Math.ceil(v.RP_IRISAN/1000000);
        //   rp_baru[k] = Math.ceil(v.RP_BARU/1000000);
        //   rp_lancar[k] = Math.ceil(v.RP_LANCAR/1000000);
        //   rp_lunas[k] = Math.ceil(v.RP_LUNAS/1000000);
        //   //rp_lunas_1[k] = Math.ceil(v.RP_LUNAS_1/1000000);
        // });

        // chart_tgl_bayar.data.labels= labels;
        // chart_tgl_bayar.data.datasets[0].data = jml_irisan;
        // chart_tgl_bayar.data.datasets[1].data = rp_irisan;
        // chart_tgl_bayar.data.datasets[2].data = jml_baru;
        // chart_tgl_bayar.data.datasets[3].data = rp_baru;
        // chart_tgl_bayar.data.datasets[4].data = jml_lancar;
        // chart_tgl_bayar.data.datasets[5].data = rp_lancar;
        // chart_tgl_bayar.data.datasets[6].data = jml_lunas;
        // chart_tgl_bayar.data.datasets[7].data = rp_lunas;
        // chart_tgl_bayar.update();

        // chart_mom_tgl_bayar.data.labels= labels;
        // chart_mom_tgl_bayar.data.datasets[0].data = jml_lunas_1;
        // chart_mom_tgl_bayar.data.datasets[1].data = rp_lunas_1;
        // chart_mom_tgl_bayar.data.datasets[2].data = jml_lunas;
        // chart_mom_tgl_bayar.data.datasets[3].data = rp_lunas;
        // chart_mom_tgl_bayar.update();

        $('div.chart-card').unblock();

      })
      .DataTable({
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        "ajax": {
            "url": '../controller/pelunasan/getSaldoTunggakan.php',
            "type": "POST",
            "timeout": 60000
        },
        //responsive: true,
        columns: [
          {
            data: "UNITAP",
            visible: true,
          },
          {
            data: "UP3",
            visible: true,
          },
          {
            data: "SALDO_AWAL_1",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_AWAL_2",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_AWAL_3",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_AWAL",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TARGET",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_LALU_1",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_LALU_2",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_LALU_3",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_LALU",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_KINI_1",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_KINI_2",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_KINI_3",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_KINI",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_1",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_2",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_3",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_LUNAS",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "PERSEN_HARI",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "PERSEN_BULAN",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "WAKTU_UPDATE",
            visible: true,
          },
          {
            data: "TGL_NIHIL",
            visible: true,
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
        ],
        //"scrollY": 370,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[0, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 2;
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


    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table_up = $('#tbl_rekap_unitup')
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
            "url": '../controller/pelunasan/getSaldoTunggakanUP.php',
            "type": "POST",
            "timeout": 60000
        },
        //responsive: true,
        columns: [
          {
            data: "UNITUP",
            visible: true,
          },
          {
            data: "ULP",
            visible: true,
          },
          {
            data: "SALDO_AWAL_1",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_AWAL_2",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_AWAL_3",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_AWAL",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TARGET",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_LALU_1",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_LALU_2",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_LALU_3",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_LALU",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_KINI_1",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_KINI_2",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "SALDO_KINI_3",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_KINI",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_1",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_2",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "LUNAS_3",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_LUNAS",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "PERSEN_HARI",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "PERSEN_BULAN",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "WAKTU_UPDATE",
            visible: true,
          },
          {
            data: "TGL_NIHIL",
            visible: true,
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
        ],
        //"scrollY": 370,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[0, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 2;
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
        console.log('Klikk');
        table.ajax.url( '../controller/pelunasan/getSaldoTunggakan.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
        table_up.ajax.url( '../controller/pelunasan/getSaldoTunggakanUP.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    });


    var ctx = document.getElementById("chart_tgl_bayar");
    ctx.height = 380;
    //ctx.width = 0.45*panel_width;
    chart_tgl_bayar = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [
                {
                  label: 'IRISAN',
                  borderColor: '#EC5B43',
                  backgroundColor: '#EC5B43',
                  borderWidth: 1.8,
                  fill: false
                },
                {
                  label: 'RP IRISAN',
                  borderColor: '#EC5B43',
                  backgroundColor: '#EC5B13',
                  pointStyle: 'rect',
                  pointRadius: 4,
                  hidden: true,
                  fill: false
                },
                {
                  label: 'BARU',
                  borderColor: '#F2C36B',
                  backgroundColor: '#F2C36B',
                  borderWidth: 1.8,
                  fill: false
                },
                {
                  label: 'RP BARU',
                  borderColor: '#F2C36B',
                  backgroundColor: '#F2C33B',
                  pointStyle: 'rect',
                  pointRadius: 4,
                  hidden: true,
                  fill: false
                },
                {
                  label: 'LANCAR',
                  borderColor: '#74BCC7',
                  backgroundColor: '#74BCC7',
                  borderWidth: 1.8,
                  fill: false
                },
                {
                  label: 'RP LANCAR',
                  borderColor: '#74BCC7',
                  backgroundColor: '#74BCA7',
                  pointStyle: 'rect',
                  pointRadius: 4,
                  hidden: true,
                  fill: false
                },
                {
                  label: 'TOTAL',
                  borderColor: '#135470',
                  backgroundColor: '#135470',
                  borderWidth: 1.8,
                  fill: false
                },
                {
                  label: 'RP TOTAL',
                  borderColor: '#135470',
                  backgroundColor: '#135430',
                  pointStyle: 'rect',
                  pointRadius: 4,
                  hidden: true,
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
                            console.log('title', t);
                            return "TANGGAL "+t[0].label;
                        },
                        label: function(t) {
                            console.log('label', t);
                            var dstLabel = t.dataset.label;
                            var yLabel = t.raw;
                            if( dstLabel.substring(0,2) == "RP" )
                              return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format(yLabel)+' juta' ;
                            else
                              return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format(yLabel)+' plg' ;
                        }
                   }
                },
            }
          },
    });


    // var ctx = document.getElementById("chart_mom_tgl_bayar");
    // ctx.height = 380;
    // //ctx.width = 0.45*panel_width;
    // chart_mom_tgl_bayar = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         datasets: [
    //             {
    //               label: 'LBR BLN LALU',
    //               borderColor: '#74BCC7',
    //               backgroundColor: '#74BCC7',
    //               borderWidth: 1.8,
    //               fill: false
    //             },
    //             {
    //               label: 'RP BLN LALU',
    //               borderColor: '#74BCC7',
    //               backgroundColor: '#74BCC7',
    //               pointStyle: 'rect',
    //               pointRadius: 4,
    //               hidden: true,
    //               fill: false
    //             },
    //             {
    //               label: 'PLG BLN INI',
    //               borderColor: '#135470',
    //               backgroundColor: '#135470',
    //               borderWidth: 1.8,
    //               fill: false
    //             },
    //             {
    //               label: 'RP BLN INI',
    //               borderColor: '#135470',
    //               backgroundColor: '#135470',
    //               pointStyle: 'rect',
    //               pointRadius: 4,
    //               hidden: true,
    //               fill: false
    //             },
    //           ]
    //     },
    //     //plugins: [ChartDataLabels],
    //     options: {
    //         maintainAspectRatio: false, 
    //         responsive: true,
    //         barRadius: 2,
    //         // Elements options apply to all of the options unless overridden in a dataset
    //         // In this case, we are setting the border of each horizontal bar to be 2px wide
    //         elements: {
    //           bar: {
    //             borderWidth: 2,
    //           }
    //         },
    //         layout: {
    //           padding: {
    //             left: 40,
    //             right: 60,
    //             top: 20,
    //             bottom: 20
    //           }
    //         },
    //         scales: {
    //             x: {
    //                 grid: {
    //                     display: false,
    //                     drawBorder: false,
    //                     drawOnChartArea: false,
    //                     drawTicks: false,
    //                 },
    //                 ticks: {
    //                     display: true //this will remove only the label
    //                 }
    //             },
    //             y: {
    //                 grid: {
    //                     display: true,
    //                     drawBorder: true,
    //                     drawOnChartArea: true,
    //                     drawTicks: true,
    //                 },
    //                 ticks: {
    //                     display: true,
    //                     text: 'Jml Pelanggan (Ribu)',
    //                     callback: function(value, index, values) {
    //                                 return new Intl.NumberFormat('id-ID').format(value);
    //                             }
    //                 }
    //             },
    //         },
    //         plugins: {
    //             legend: {
    //                 display: true,
    //                 labels: {
    //                   usePointStyle: true,
    //                 },
    //                 position: 'top'
    //             },
    //             title: {
    //                 display: false,
    //             },
    //             tooltip: {
    //                bodyFontSize: 10,
    //                callbacks: {
    //                     title: function(t) {
    //                         console.log('title', t);
    //                         return "TANGGAL "+t[0].label;
    //                     },
    //                     label: function(t) {
    //                         console.log('label', t);
    //                         var dstLabel = t.dataset.label;
    //                         var yLabel = t.raw;
    //                         return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format(yLabel)+' plg' ;
    //                     }
    //                }
    //             },
    //         }
    //       },
    // });



});
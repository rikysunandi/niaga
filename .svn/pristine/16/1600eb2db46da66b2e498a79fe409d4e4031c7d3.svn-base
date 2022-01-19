$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
   
    var chart_tgl_bayar ;

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_tglbayar')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!', data);
        $('div.content-body').unblock();

        $('div.chart-card').block({ message: 'Mengambil data...' });

        var jml_lunas = new Array();
        var labels = new Array();
        $.each(data.data, function(k, v){
          labels[k] = v.TGLBAYAR.substring(v.TGLBAYAR.length - 2);
          jml_lunas[k] = v.JML_PLG;
        });

        chart_tgl_bayar.data.labels= labels;
        chart_tgl_bayar.data.datasets[0].data = jml_lunas;
        chart_tgl_bayar.update();

        $('div.chart-card').unblock();

      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        "ajax": {
            "url": '../controller/pelunasan/getRekapTglBayar.php',
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
            data: "TGLBAYAR",
            visible: true,
          },
          {
            data: "JML_PLG",
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
        ],
        "scrollY": 370,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[3, 'asc']],
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
        console.log('Klikk');
        table.ajax.url( '../controller/pelunasan/getRekapTglBayar.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    });


    var ctx = document.getElementById("chart_tgl_bayar");
    ctx.height = 380;
    //ctx.width = 0.45*panel_width;
    chart_tgl_bayar = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [
                {
                  label: 'JML_LUNAS',
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
                            console.log('title', t);
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



});
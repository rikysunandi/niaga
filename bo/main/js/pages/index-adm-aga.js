$(function() {
    "use strict";

    var chart_percepatan_rata, chart_percepatan_non_kogol_1, 
        chart_percepatan_kogol_0, chart_percepatan_kogol_2, 
        chart_percepatan_kogol_3, chart_percepatan_kogol_4, 
        chart_percepatan_mup3, chart_percepatan_mbsar, 
        chart_percepatan_mulp, chart_percepatan_biller, 
        chart_percepatan_irisan_rata, chart_percepatan_irisan, 
        chart_trend_percepatan, chart_trend_percepatan_pic,
        chart_trend_percepatan_pola_bayar, chart_trend_jml_plg_pola_bayar,
        chart_pola_bayar, chart_pola_bayar_unit, chart_mom_per_tanggal, chart_mom_akumulasi_per_tanggal;

    var colours="";
    var alignments="";
    var panel_width = $('.content-body').width();

    $('#sel_unit').selectpicker('val', '00');
    $('#sel_blth').selectpicker('refresh');

    var unitap=$('#sel_unit').selectpicker('val');
    var blth=$('#sel_blth').selectpicker('val');

    function addAlpha(color, opacity) {
        // coerce values so ti is between 0 and 1.
        var _opacity = Math.round(Math.min(Math.max(opacity || 1, 0), 1) * 255);
        return color + _opacity.toString(16).toUpperCase();
    }

    var dataToTable = function (dataset) {
        var html = '<table class="charttable">';
        html += '<thead><tr><th>#</th>';
        
        var columnCount = 0;
        jQuery.each(dataset.datasets, function (idx, item) {
            html += '<th style="background-color:' + item.fillColor + ';">' + item.label + '</th>';
            columnCount += 1;
        });

        html += '</tr></thead>';

        var i;
        jQuery.each(dataset.labels, function (idx, item) {
            html += '<tr><td>' + item + '</td>';
            for (i = 0; i < columnCount; i++) {
                html += '<td style="background-color:' + dataset.datasets[i].fillColor + ';">' + (dataset.datasets[i].data[idx] === '0' ? '-' : dataset.datasets[i].data[idx]) + '</td>';
            }
            html += '</tr>';
        });

        html += '</tr><tbody></table>';

        return html;
    };

    var dataToTableTranspose = function (dataset) {
        var html = '<table class="charttable">';
        html += '<thead><tr><th style="width:120px;">#</th>';
        
        var columnCount = 0;
        jQuery.each(dataset.labels, function (idx, item) {
            html += '<th>' + item + '</th>';
            columnCount += 1;
        });

        html += '</tr></thead>';

        var i;
        jQuery.each(dataset.datasets, function (idx, item) {
            html += '<tr style="background-color:' + item.backgroundColor + ';"><td class="text-white">' + item.label + '</td>';
            for (i = 0; i < columnCount; i++) {
                html += '<td class="text-white text-right">' + (item.data[i] === '0' ? '-' : new Intl.NumberFormat('id-ID').format(item.data[i]) ) + '</td>';
            }
            html += '</tr>';
        });

        html += '</tr><tbody></table>';

        return html;
    };


    $('div#mom_akumulasi_per_tanggal').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardMOMAkumulasiPerTanggal.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        //const colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
        //const alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");

        var ctx = document.getElementById("chart_mom_akumulasi_per_tanggal");
        ctx.height = 380;
        //ctx.width = 0.45*panel_width;
        chart_mom_akumulasi_per_tanggal = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.tanggal,
                datasets: [
                    {
                      label: 'REK '+data.blth,
                      data: data.jml_plg,
                      borderColor: '#135470',
                      backgroundColor: addAlpha('#135470', 0.1),
                      fill: true
                    },
                    {
                      label: 'RPPTL '+data.blth,
                      data: data.rpptl,
                      borderColor: '#135440',
                      backgroundColor: addAlpha('#135440', 0.1),
                      fill: true,
                      hidden: true
                    },
                    {
                      label: 'REK '+data.blth_n1,
                      data: data.jml_plg_n1,
                      borderColor: '#F2C36B',
                      backgroundColor: addAlpha('#F2C36B', 0.1),
                      fill: true
                    },
                    {
                      label: 'RPPTL '+data.blth_n1,
                      data: data.rpptl_n1,
                      borderColor: '#F2C33B',
                      backgroundColor: addAlpha('#F2C33B', 0.1),
                      fill: true,
                      hidden: true
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
                                        return (value*10)+'Rb';
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
                                if(dstLabel.substring(0,2)=="RP")
                                    return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format((parseFloat(yLabel)*10).toFixed(2)) + 'Myr';
                                else
                                    return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format((parseFloat(yLabel)*10).toFixed(2)) + 'Rb';
                            }
                       }
                    },
                    // datalabels: {
                    //     // color: colours,
                    //     anchor: 'top',
                    //     align: 'top',
                    //     clip: false,
                    //     clamp: true,
                    //     display: true,
                    //     formatter: function(value, context) {
                    //       return value;
                    //     }
                    // }
                }
              },
        });

        $('div#mom_per_tanggal').unblock();

    });

    $('div#mom_per_tanggal').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardMOMPerTanggal.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        //const colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
        //const alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");

        var ctx = document.getElementById("chart_mom_per_tanggal");
        ctx.height = 380;
        //ctx.width = 0.45*panel_width;
        chart_mom_per_tanggal = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.tanggal,
                datasets: [
                    {
                      label: 'REK '+data.blth,
                      data: data.jml_plg,
                      borderColor: '#135470',
                      backgroundColor: addAlpha('#135470', 0.1),
                      fill: true
                    },
                    {
                      label: 'RPPTL '+data.blth,
                      data: data.rpptl,
                      borderColor: '#135440',
                      backgroundColor: addAlpha('#135440', 0.1),
                      fill: true,
                      hidden: true
                    },
                    {
                      label: 'REK '+data.blth_n1,
                      data: data.jml_plg_n1,
                      borderColor: '#F2C36B',
                      backgroundColor: addAlpha('#F2C36B', 0.1),
                      fill: true
                    },
                    {
                      label: 'RPPTL '+data.blth_n1,
                      data: data.rpptl_n1,
                      borderColor: '#F2C33B',
                      backgroundColor: addAlpha('#F2C33B', 0.1),
                      fill: true,
                      hidden: true
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
                                        return (value*10)+'Rb';
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
                                if(dstLabel.substring(0,2)=="RP")
                                    return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format((parseFloat(yLabel)*10).toFixed(2)) + 'Myr';
                                else
                                    return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format((parseFloat(yLabel)*10).toFixed(2)) + 'Rb';
                            }
                       }
                    },
                    // datalabels: {
                    //     // color: colours,
                    //     anchor: 'top',
                    //     align: 'top',
                    //     clip: false,
                    //     clamp: true,
                    //     display: true,
                    //     formatter: function(value, context) {
                    //       return value;
                    //     }
                    // }
                }
              },
        });

        $('div#mom_per_tanggal').unblock();

    });


    $('div#rbm_lancar table tbody').empty();
    $('div#rbm_lancar').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardRBMLancarTerbanyak.php?unitap='+unitap+'&blth='+blth, function(data){

        $('div#rbm_lancar small.blth').html('REKENING '+data.blth);
        var tr = '';
        $.each(data.rows, function(k,v){
            tr += '<tr data-blth="'+v.blth+'" data-unitupi="'+v.unitupi+'" data-unitap="'+v.unitap+'" data-unitup="'+v.unitup+'" data-rbm="'+v.rbm+'" >';
            tr += '<td>'+v.ulp+'</td>';
            tr += '<td>'+v.petugas+'</td>';
            tr += '<td>'+v.rbm+'</td>';
            tr += '<td class="text-right">'+v.jml_lancar+'</td>';
            tr += '<td class="text-right">'+v.jml_baru+'</td>';
            tr += '<td class="text-right">'+v.jml_irisan+'</td>';
            tr += '</tr>';
        });
        $('div#rbm_lancar table tbody').append(tr);
        $('div#rbm_lancar').unblock();
    });

    $('div#rbm_irisan table tbody').empty();
    $('div#rbm_irisan').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardRBMIrisanTerbanyak.php?unitap='+unitap+'&blth='+blth, function(data){

        $('div#rbm_irisan small.blth').html('REKENING '+data.blth);
        var tr = '';
        $.each(data.rows, function(k,v){
            tr += '<tr data-blth="'+v.blth+'" data-unitupi="'+v.unitupi+'" data-unitap="'+v.unitap+'" data-unitup="'+v.unitup+'" data-rbm="'+v.rbm+'" >';
            tr += '<td>'+v.ulp+'</td>';
            tr += '<td>'+v.petugas+'</td>';
            tr += '<td>'+v.rbm+'</td>';
            tr += '<td class="text-right">'+v.jml_lancar+'</td>';
            tr += '<td class="text-right">'+v.jml_baru+'</td>';
            tr += '<td class="text-right">'+v.jml_irisan+'</td>';
            tr += '</tr>';
        });
        $('div#rbm_irisan table tbody').append(tr);
        $('div#rbm_irisan').unblock();
    });

    var nFormatter = function nFormatter(num, digits) {
      const lookup = [
        { value: 1, symbol: "" },
        { value: 1e3, symbol: "Rb" },
        { value: 1e6, symbol: "Jt" },
        { value: 1e9, symbol: "M" },
        { value: 1e12, symbol: "T" }
      ];
      const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
      var item = lookup.slice().reverse().find(function(item) {
        return num >= item.value;
      });
      return item ? (num / item.value).toFixed(digits).replace(rx, "") + item.symbol : "0";
    };

    $('#btn_go').click(function(){

        var unitap=$('#sel_unit').selectpicker('val');
        var blth=$('#sel_blth').selectpicker('val');
        var colours="";
        var alignments="";

        $('div#mom_akumulasi_per_tanggal').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardMOMAkumulasiPerTanggal.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            chart_mom_akumulasi_per_tanggal.data.labels= data.tanggal;
            chart_mom_akumulasi_per_tanggal.data.datasets[0].label = 'REK '+data.blth;
            chart_mom_akumulasi_per_tanggal.data.datasets[0].data = data.jml_plg;
            chart_mom_akumulasi_per_tanggal.data.datasets[1].label = 'REK '+data.blth_n1;
            chart_mom_akumulasi_per_tanggal.data.datasets[1].data = data.jml_plg_n1;
            chart_mom_akumulasi_per_tanggal.update();

            $('div#mom_akumulasi_per_tanggal').unblock();
        });


        $('div#mom_per_tanggal').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardMOMPerTanggal.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            chart_mom_per_tanggal.data.labels= data.tanggal;
            chart_mom_per_tanggal.data.datasets[0].label = 'REK '+data.blth;
            chart_mom_per_tanggal.data.datasets[0].data = data.jml_plg;
            chart_mom_per_tanggal.data.datasets[1].label = 'REK '+data.blth_n1;
            chart_mom_per_tanggal.data.datasets[1].data = data.jml_plg_n1;
            chart_mom_per_tanggal.update();

            $('div#mom_per_tanggal').unblock();
        });

        $('div#percepatan_irisan_rata').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanIrisanUnit.php?rata=Y&unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }

            chart_percepatan_irisan_rata.data.labels= data.singkatan;
            chart_percepatan_irisan_rata.data.datasets[0].data = data.percepatan;
            chart_percepatan_irisan_rata.data.datasets[0].backgroundColor = colours;
            chart_percepatan_irisan_rata.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_irisan_rata.data.datasets[0].borderColor = colours;
            chart_percepatan_irisan_rata.data.datasets[0].borderColorHover = colours;
            chart_percepatan_irisan_rata.options.plugins.datalabels.color = colours;
            chart_percepatan_irisan_rata.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_irisan_rata.options.plugins.datalabels.align = alignments;
            chart_percepatan_irisan_rata.update();

            $('div#percepatan_irisan_rata').unblock();

        });

        $('div#percepatan_irisan').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanIrisanUnit.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_irisan.data.labels= data.singkatan;
            chart_percepatan_irisan.data.datasets[0].data = data.percepatan;
            chart_percepatan_irisan.data.datasets[0].backgroundColor = colours;
            chart_percepatan_irisan.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_irisan.data.datasets[0].borderColor = colours;
            chart_percepatan_irisan.data.datasets[0].borderColorHover = colours;
            chart_percepatan_irisan.options.plugins.datalabels.color = colours;
            chart_percepatan_irisan.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_irisan.options.plugins.datalabels.align = alignments;
            chart_percepatan_irisan.update();

            $('div#percepatan_irisan').unblock();

        });

        $('div#pola_bayar').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPolaBayarUnit.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            $('div#pola_bayar small.blth').html('REKENING '+data.blth);
            chart_pola_bayar.data.datasets[0].data = [data.total_lancar, data.total_baru, data.total_irisan, data.total_blm_upload];
            chart_pola_bayar.update();
            chart_pola_bayar_unit.data.labels= data.singkatan;
            chart_pola_bayar_unit.data.datasets[0].data = data.jml_lancar;
            chart_pola_bayar_unit.data.datasets[1].data = data.jml_baru;
            chart_pola_bayar_unit.data.datasets[2].data = data.jml_irisan;
            chart_pola_bayar_unit.data.datasets[3].data = data.jml_blm_upload;
            chart_pola_bayar_unit.update();

            jQuery('#pola_bayar_unit_datatable').html(dataToTableTranspose(chart_pola_bayar_unit.data));


            $('div#pola_bayar').unblock();

        });


        $('div#rbm_lancar table tbody').empty();
        $('div#rbm_lancar').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardRBMLancarTerbanyak.php?unitap='+unitap+'&blth='+blth, function(data){

            $('div#rbm_lancar small.blth').html('REKENING '+data.blth);
            var tr = '';
            $.each(data.rows, function(k,v){
                tr += '<tr data-blth="'+v.blth+'" data-unitupi="'+v.unitupi+'" data-unitap="'+v.unitap+'" data-unitup="'+v.unitup+'" data-rbm="'+v.rbm+'" >';
                tr += '<td>'+v.ulp+'</td>';
                tr += '<td>'+v.petugas+'</td>';
                tr += '<td>'+v.rbm+'</td>';
                tr += '<td class="text-right">'+v.jml_lancar+'</td>';
                tr += '<td class="text-right">'+v.jml_baru+'</td>';
                tr += '<td class="text-right">'+v.jml_irisan+'</td>';
                tr += '</tr>';
            });
            $('div#rbm_lancar table tbody').append(tr);
            $('div#rbm_lancar').unblock();
        });

        $('div#rbm_irisan table tbody').empty();
        $('div#rbm_irisan').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardRBMIrisanTerbanyak.php?unitap='+unitap+'&blth='+blth, function(data){

            $('div#rbm_irisan small.blth').html('REKENING '+data.blth);
            var tr = '';
            $.each(data.rows, function(k,v){
                tr += '<tr data-blth="'+v.blth+'" data-unitupi="'+v.unitupi+'" data-unitap="'+v.unitap+'" data-unitup="'+v.unitup+'" data-rbm="'+v.rbm+'" >';
                tr += '<td>'+v.ulp+'</td>';
                tr += '<td>'+v.petugas+'</td>';
                tr += '<td>'+v.rbm+'</td>';
                tr += '<td class="text-right">'+v.jml_lancar+'</td>';
                tr += '<td class="text-right">'+v.jml_baru+'</td>';
                tr += '<td class="text-right">'+v.jml_irisan+'</td>';
                tr += '</tr>';
            });
            $('div#rbm_irisan table tbody').append(tr);
            $('div#rbm_irisan').unblock();
        });

    });


    // document.getElementById("chart_pola_bayar").onclick = function(evt)
    // {   
    //     var activePoints = chart_pola_bayar.getElementsAtEvent(evt);

    //     if(activePoints.length > 0)
    //     {
    //         //get the internal index of slice in pie chart_pola_bayar
    //         var clickedElementindex = activePoints[0]["_index"];

    //         //get specific label by index 
    //         var label = chart_pola_bayar.data.labels[clickedElementindex];

    //         //get value by index      
    //         var value = chart_pola_bayar.data.datasets[0].data[clickedElementindex];

    //         var status = label;
    //         var unit = $('#sel_unit').val();
    //         var blth = $('#sel_blth').val();
    //         var unitap;

    //         window.open('mon-pola-bayar.php?unitupi=53&unitap='+unit+'&unitup=00&blth='+blth+'&status='+status+'&rbm=00', '_blank');

    //    }
    // }
    
    $('#rbm_lancar table').on('click', 'tr', function (e) {

        console.log('agenda click');
        var unitupi = $(this).data('unitupi');
        var unitap = $(this).data('unitap');
        var unitup = $(this).data('unitup');
        var blth = $(this).data('blth');
        var rbm = $(this).data('rbm');

        window.open('mon-pola-bayar.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&blth='+blth+'&rbm='+rbm+'&status=LANCAR', '_blank');

    });
    
    $('#rbm_irisan table').on('click', 'tr', function (e) {

        console.log('agenda click');
        var unitupi = $(this).data('unitupi');
        var unitap = $(this).data('unitap');
        var unitup = $(this).data('unitup');
        var blth = $(this).data('blth');
        var rbm = $(this).data('rbm');

        window.open('mon-pola-bayar.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&blth='+blth+'&rbm='+rbm+'&status=IRISAN', '_blank');

    });

    jQuery("path").hover(function() {
        //alert(jQuery(this).attr('title'));
    });


});
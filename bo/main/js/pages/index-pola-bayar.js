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

    $('div#trend_percepatan').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardTrendPercepatan.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        //const colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
        //const alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");

        var ctx = document.getElementById("chart_trend_percepatan");
        ctx.height = 380;
        //ctx.width = 0.45*panel_width;
        chart_trend_percepatan = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.blth,
                datasets: [
                    {
                      label: 'Kogol 0',
                      data: data.kogol_0,
                      borderColor: '#135470',
                      backgroundColor: addAlpha('#135470', 0.2),
                      fill: true
                    },
                    {
                      label: 'Kogol 2',
                      data: data.kogol_2,
                      borderColor: '#74BCC7',
                      backgroundColor: addAlpha('#74BCC7', 0.2),
                      fill: true
                    },
                    {
                      label: 'Kogol 3',
                      data: data.kogol_3,
                      borderColor: '#F2C36B',
                      backgroundColor: addAlpha('#F2C36B', 0.2),
                      fill: true
                    },
                    {
                      label: 'Kogol 4',
                      data: data.kogol_4,
                      borderColor: '#EC5B43',
                      backgroundColor: addAlpha('#EC5B43', 0.2),
                      fill: true
                    },
                  ]
            },
            plugins: [ChartDataLabels],
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
                    left: 80,
                    right: 60,
                    top: 20,
                    bottom: 20
                  }
                },
                scales: {
                    x: {
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            display: true //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
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
                    datalabels: {
                        // color: colours,
                        anchor: 'end',
                        align: 'right',
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return value;
                        }
                    }
                }
              },
        });

        $('div#trend_percepatan').unblock();

    });

    $('div#trend_percepatan_pic').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardTrendPercepatanPIC.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        //const colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
        //const alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");

        var ctx = document.getElementById("chart_trend_percepatan_pic");
        ctx.height = 380;
        chart_trend_percepatan_pic = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.blth,
                datasets: [
                    {
                      label: 'MUP3',
                      data: data.mup3,
                      borderColor: '#135470',
                      backgroundColor: addAlpha('#135470', 0.2),
                      fill: true
                    },
                    {
                      label: 'MBSAR',
                      data: data.mbsar,
                      borderColor: '#74BCC7',
                      backgroundColor: addAlpha('#74BCC7', 0.2),
                      fill: true
                    },
                    {
                      label: 'MULP',
                      data: data.mulp,
                      borderColor: '#F2C36B',
                      backgroundColor: addAlpha('#F2C36B', 0.2),
                      fill: true
                    },
                    {
                      label: 'BILLER',
                      data: data.biller,
                      borderColor: '#EC5B43',
                      backgroundColor: addAlpha('#EC5B43', 0.2),
                      fill: true
                    },
                  ]
            },
            plugins: [ChartDataLabels],
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
                    left: 80,
                    right: 60,
                    top: 20,
                    bottom: 20
                  }
                },
                scales: {
                    x: {
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            display: true //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
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
                    datalabels: {
                        // color: colours,
                        anchor: 'end',
                        align: 'right',
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return value;
                        }
                    }
                }
              },
        });

        $('div#trend_percepatan_pic').unblock();

    });

    $('div#percepatan_rata').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?rata=Y&unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_rata");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_rata = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_rata').unblock();

    });

    $('div#percepatan_non_kogol_1').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_non_kogol_1");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_non_kogol_1 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_non_kogol_1').unblock();

    });

    $('div#trend_percepatan_pola_bayar').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardTrendPercepatanPolaBayar.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        //const colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
        //const alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");

        var ctx = document.getElementById("chart_trend_percepatan_pola_bayar");
        ctx.height = 380;
        //ctx.width = 0.45*panel_width;
        chart_trend_percepatan_pola_bayar = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.blth,
                datasets: [
                    {
                      label: 'Lancar',
                      data: data.lancar,
                      borderColor: '#74BCC7',
                      backgroundColor: addAlpha('#74BCC7', 0.2),
                      fill: true
                    },
                    {
                      label: 'Baru',
                      data: data.baru,
                      borderColor: '#F2C36B',
                      backgroundColor: addAlpha('#F2C36B', 0.2),
                      fill: true
                    },
                    {
                      label: 'Irisan',
                      data: data.irisan,
                      borderColor: '#EC5B43',
                      backgroundColor: addAlpha('#EC5B43', 0.2),
                      fill: true
                    },
                  ]
            },
            plugins: [ChartDataLabels],
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
                    left: 80,
                    right: 60,
                    top: 20,
                    bottom: 20
                  }
                },
                scales: {
                    x: {
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            display: true //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
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
                    datalabels: {
                        // color: colours,
                        anchor: 'end',
                        align: 'right',
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return value;
                        }
                    }
                }
              },
        });

        $('div#trend_percepatan_pola_bayar').unblock();

    });

    $('div#trend_jml_plg_pola_bayar').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardTrendJmlPlgPolaBayar.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        //const colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
        //const alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");

        var ctx = document.getElementById("chart_trend_jml_plg_pola_bayar");
        ctx.height = 380;
        chart_trend_jml_plg_pola_bayar = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.blth,
                datasets: [
                    {
                      label: 'Lancar',
                      data: data.lancar,
                      borderColor: '#74BCC7',
                      backgroundColor: addAlpha('#74BCC7', 0.2),
                      fill: true
                    },
                    {
                      label: '(Baru + Irisan)',
                      data: data.wo,
                      borderColor: '#F2C36B',
                      backgroundColor: addAlpha('#F2C36B', 0.2),
                      fill: true
                    },
                  ]
            },
            plugins: [ChartDataLabels],
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
                    left: 80,
                    right: 60,
                    top: 20,
                    bottom: 20
                  }
                },
                scales: {
                    x: {
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            display: true //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
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
                    datalabels: {
                        // color: colours,
                        anchor: 'end',
                        align: 'right',
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return value;
                        }
                    }
                }
              },
        });

        $('div#trend_jml_plg_pola_bayar').unblock();

    });

    $('div#percepatan_irisan_rata').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanIrisanUnit.php?rata=Y&unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_irisan_rata");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_irisan_rata = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_irisan_rata').unblock();

    });

    $('div#percepatan_irisan').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanIrisanUnit.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_irisan");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_irisan = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_irisan').unblock();

    });

    $('div#percepatan_kogol_0').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=0&pic=X&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_kogol_0");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_kogol_0 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_kogol_0').unblock();

    });

    $('div#percepatan_kogol_2').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=2&pic=X&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_kogol_2");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_kogol_2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_kogol_2').unblock();

    });

    $('div#percepatan_kogol_3').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=3&pic=X&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_kogol_3");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_kogol_3 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_kogol_3').unblock();

    });

    $('div#percepatan_kogol_4').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=4&pic=X&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_kogol_4");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_kogol_4 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_kogol_4').unblock();

    });

    $('div#percepatan_mup3').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=MUP3&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_mup3");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_mup3 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_mup3').unblock();

    });

    $('div#percepatan_mbsar').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=MBSAR&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_mbsar");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_mbsar = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_mbsar').unblock();

    });

    $('div#percepatan_mulp').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=MULP&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_mulp");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_mulp = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_mulp').unblock();

    });

    $('div#percepatan_biller').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=BILLER&blth='+blth, function(data){

        if(data.success=='true' || data.success){
            colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
            alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
        }

        var ctx = document.getElementById("chart_percepatan_biller");
        ctx.height = 380;
        ctx.width = 0.45*panel_width;
        chart_percepatan_biller = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "PERCEPATAN",
                        backgroundColor: colours,
                        backgroundColorHover: colours,
                        borderColor: colours,
                        borderColorHover: colours,
                        data: data.percepatan,
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false, 
                responsive: false,
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
                    left: 80,
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
                            display: false //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        color: colours,
                        anchor: alignments,
                        align: alignments,
                        clip: false,
                        clamp: true,
                        display: true,
                        formatter: function(value, context) {
                          return ' '+context.chart.data.labels[context.dataIndex] + ': ' + value+' ' ;
                        }
                    }
                }
              },
        });

        $('div#percepatan_biller').unblock();

    });


    $('div#pola_bayar').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardPolaBayarUnit.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        $('div#pola_bayar small.blth').html('REKENING '+data.blth);
        var ctx = document.getElementById("chart_pola_bayar");
        ctx.height = 380;
        chart_pola_bayar = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [data.total_lancar, data.total_baru, data.total_irisan, data.total_blm_upload],
                    backgroundColor: [
                        '#74BCC7',
                        '#F2C36B',
                        '#EC5B43',
                        addAlpha('#212121', 0.1),
                    ],
                    hoverBorderColor: [
                        '#74BCC7',
                        '#F2C36B',
                        '#EC5B43',
                        addAlpha('#212121', 0.1),
                    ],
                    hoverBorderWidth: 6,
                    label: 'pelanggan',
                    pointStyle: 'rect',
                    pointRadius: 5,
                    pointBorderColor: 'rgb(0, 0, 0)'
                }],
                labels: ['LANCAR', 'BARU', 'IRISAN', ['BELUM UPLOAD','(POTENSI IRISAN)'] ]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                maintainAspectRatio: false,
                elements: {
                    arc: {
                        borderWidth: 0
                    }
                },
                tooltips:{
                    titleFontSize: 8,
                    bodyFontSize: 8,
                    footerFontSize: 8,
                },
                layout: {
                  padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                  }
                },
                onHover: (event, chartElement) => {
                    //console.log('hover', event);
                    $("#chart_pola_bayar").css("cursor", chartElement[0] ? "pointer" : "default");
                },
                onClick: (e) => {
                    const canvasPosition = Chart.helpers.getRelativePosition(e, chart_pola_bayar);
                    

                    const datasetIndex = chart_pola_bayar.getElementsAtEventForMode(e,'nearest', { intersect: true }, false)[0].datasetIndex;
                    const index = chart_pola_bayar.getElementsAtEventForMode(e,'nearest', { intersect: true }, false)[0].index;
                    //const model = chart_pola_bayar.getElementsAtEventForMode(e,'nearest', { intersect: true }, false)[datasetIndex]._model;
                    // console.log('element', chart_pola_bayar.getElementsAtEventForMode(e,'nearest', { intersect: true }, false));
                    // console.log('label', chart_pola_bayar.data.labels[index]);
                    // console.log('val', chart_pola_bayar.data.datasets[datasetIndex].data[index]);
                    //console.log('model', model);

                    var status = chart_pola_bayar.data.labels[index];
                    var value = chart_pola_bayar.data.datasets[datasetIndex].data[index];

                    var unit = $('#sel_unit').val();
                    var blth = $('#sel_blth').val();
                    var unitap;

                    window.open('mon-pola-bayar.php?unitupi=53&unitap='+unit+'&unitup=00&blth='+blth+'&status='+status+'&rbm=00', '_blank');

                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle: true,
                            font: {
                                size: 10
                            }
                        },
                        position: 'bottom'
                    },
                    title: {
                        display: false,
                    },
                    // labels: [
                    //     {
                    //       render: 'label',
                    //       fontSize: 7,
                    //       fontColor:  [
                    //             '#74BCC7',
                    //             '#F2C36B',
                    //             '#EC5B43',
                    //         ],
                    //       precision: 0,
                    //       position: 'outside',
                    //       arc: true,
                    //       textMargin: 2,
                    //     },
                    //     {
                    //       render: 'value',
                    //       fontSize: 9,
                    //       fontColor: 'white',
                    //       precision: 1,
                    //       position: 'border'
                    //     },
                    //     {
                    //       render: 'percentage',
                    //       fontSize: 9,
                    //       fontColor: 'white',
                    //       precision: 0,
                    //       position: 'default'
                    //     }
                    // ],
                    datalabels: {
                        // color: colours,
                        anchor: 'center',
                        align: 'center',
                        clip: false,
                        clamp: true,
                        display: 'auto',
                        offset: 4,
                        color: '#212121',
                        font: {
                            size: 11
                        },
                        formatter: function(value, context) {

                            var total = context.dataset.data[0]+context.dataset.data[1]+context.dataset.data[2]+context.dataset.data[3];
                          return nFormatter(value, 1)+' ('+Math.round((value/total)*100)+' %)';
                        }
                    }
                },
            }
        });

        

        var ctx = document.getElementById("chart_pola_bayar_unit");
        ctx.height = 380;
        //ctx.width = 0.45*panel_width;
        chart_pola_bayar_unit = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                      label: 'LANCAR',
                      data: data.jml_lancar,
                      borderColor: '#74BCC7',
                      backgroundColor: '#74BCC7',
                      pointStyle: 'rect',
                      pointRadius: 5,
                      pointBorderColor: 'rgb(0, 0, 0)'
                    },
                    {
                      label: 'BARU',
                      data: data.jml_baru,
                      borderColor: '#F2C36B',
                      backgroundColor: '#F2C36B',
                      pointStyle: 'rect',
                      pointRadius: 5,
                      pointBorderColor: 'rgb(0, 0, 0)'
                    },
                    {
                      label: 'IRISAN',
                      data: data.jml_irisan,
                      borderColor: '#EC5B43',
                      backgroundColor: '#EC5B43',
                      pointStyle: 'rect',
                      pointRadius: 5,
                      pointBorderColor: 'rgb(0, 0, 0)'
                    },
                    {
                      label: 'BLM UPLOAD (POTENSI IRISAN)',
                      data: data.jml_blm_upload,
                      borderColor: '#212121',
                      backgroundColor: addAlpha('#212121', 0.2),
                      pointStyle: 'rect',
                      pointRadius: 5,
                      pointBorderColor: 'rgb(0, 0, 0)'
                    },
                ]
            },
            plugins: [ChartDataLabels],
            options: {
                maintainAspectRatio: false, 
                responsive: true,
                layout: {
                  padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                  }
                },
                scales: {
                    x: {
                        grid: {
                            display: true,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: true,
                        },
                        stacked: true,
                        ticks: {
                            display: true //this will remove only the label
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        stacked: true,
                        ticks: {
                            display: false //this will remove only the label
                        }
                    },
                },
                onHover: (event, chartElement) => {
                    //console.log('hover', event);
                    $("#chart_pola_bayar_unit").css("cursor", chartElement[0] ? "pointer" : "default");
                },
                onClick: (e) => {
                    const canvasPosition = Chart.helpers.getRelativePosition(e, chart_pola_bayar_unit);
                    

                    const datasetIndex = chart_pola_bayar_unit.getElementsAtEventForMode(e,'nearest', { intersect: true }, false)[0].datasetIndex;
                    const index = chart_pola_bayar_unit.getElementsAtEventForMode(e,'nearest', { intersect: true }, false)[0].index;
                    //const model = chart_pola_bayar_unit.getElementsAtEventForMode(e,'nearest', { intersect: true }, false)[datasetIndex]._model;
                    console.log('element', chart_pola_bayar_unit.getElementsAtEventForMode(e,'nearest', { intersect: true }, false));
                    console.log('label', chart_pola_bayar_unit.data.labels[index]);
                    console.log('val', chart_pola_bayar_unit.data.datasets[datasetIndex].data[index]);
                    //console.log('model', model);

                    var unit = '53'+chart_pola_bayar_unit.data.labels[index];
                    var status = chart_pola_bayar_unit.data.datasets[datasetIndex].label;
                    var value = chart_pola_bayar_unit.data.datasets[datasetIndex].data[index];

                    var blth = $('#sel_blth').val();
                    var unitap;

                    window.open('mon-pola-bayar.php?unitupi=53&unitap='+unit+'&unitup=00&blth='+blth+'&status='+status+'&rbm=00', '_blank');

                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle: true,
                            font: {
                                size: 10
                            }
                        },
                        position: 'bottom'
                    },
                    title: {
                        display: false,
                    },
                    datalabels: {
                        // color: colours,
                        // anchor: alignments,
                        // align: alignments,
                        clip: false,
                        clamp: true,
                        display: false,
                        color: '#212121',
                        font: {
                            size: 9
                        },
                        formatter: function(value, context) {
                          return nFormatter(value, 0);
                        }
                    }
                }
              },
        });

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
            chart_mom_akumulasi_per_tanggal.data.datasets[1].label = 'RPPTL '+data.blth;
            chart_mom_akumulasi_per_tanggal.data.datasets[1].data = data.rpptl;
            chart_mom_akumulasi_per_tanggal.data.datasets[2].label = 'REK '+data.blth_n1;
            chart_mom_akumulasi_per_tanggal.data.datasets[2].data = data.jml_plg_n1;
            chart_mom_akumulasi_per_tanggal.data.datasets[3].label = 'RPPTL '+data.blth_n1;
            chart_mom_akumulasi_per_tanggal.data.datasets[3].data = data.rpptl_n1;
            chart_mom_akumulasi_per_tanggal.update();

            $('div#mom_akumulasi_per_tanggal').unblock();
        });


        $('div#mom_per_tanggal').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardMOMPerTanggal.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            chart_mom_per_tanggal.data.labels= data.tanggal;
            chart_mom_per_tanggal.data.datasets[0].label = 'REK '+data.blth;
            chart_mom_per_tanggal.data.datasets[0].data = data.jml_plg;
            chart_mom_per_tanggal.data.datasets[1].label = 'RPPTL '+data.blth;
            chart_mom_per_tanggal.data.datasets[1].data = data.rpptl;
            chart_mom_per_tanggal.data.datasets[2].label = 'REK '+data.blth_n1;
            chart_mom_per_tanggal.data.datasets[2].data = data.jml_plg_n1;
            chart_mom_per_tanggal.data.datasets[3].label = 'RPPTL '+data.blth_n1;
            chart_mom_per_tanggal.data.datasets[3].data = data.rpptl_n1;
            chart_mom_per_tanggal.update();

            $('div#mom_per_tanggal').unblock();
        });

        $('div#trend_percepatan').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardTrendPercepatan.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            chart_trend_percepatan.data.labels= data.blth;
            chart_trend_percepatan.data.datasets[0].data = data.kogol_0;
            chart_trend_percepatan.data.datasets[1].data = data.kogol_2;
            chart_trend_percepatan.data.datasets[2].data = data.kogol_3;
            chart_trend_percepatan.data.datasets[3].data = data.kogol_4;
            chart_trend_percepatan.update();

            $('div#trend_percepatan').unblock();
        });

        $('div#trend_percepatan_pic').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardTrendPercepatanPIC.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            chart_trend_percepatan_pic.data.labels= data.blth;
            chart_trend_percepatan_pic.data.datasets[0].data = data.mup3;
            chart_trend_percepatan_pic.data.datasets[1].data = data.mbsar;
            chart_trend_percepatan_pic.data.datasets[2].data = data.mulp;
            chart_trend_percepatan_pic.data.datasets[3].data = data.biller;
            chart_trend_percepatan_pic.update();

            $('div#trend_percepatan_pic').unblock();
        });

        $('div#percepatan_rata').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?rata=Y&unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }

            chart_percepatan_rata.data.labels= data.singkatan;
            chart_percepatan_rata.data.datasets[0].data = data.percepatan;
            chart_percepatan_rata.data.datasets[0].backgroundColor = colours;
            chart_percepatan_rata.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_rata.data.datasets[0].borderColor = colours;
            chart_percepatan_rata.data.datasets[0].borderColorHover = colours;
            chart_percepatan_rata.options.plugins.datalabels.color = colours;
            chart_percepatan_rata.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_rata.options.plugins.datalabels.align = alignments;
            chart_percepatan_rata.update();

            $('div#percepatan_rata').unblock();

        });

        $('div#percepatan_non_kogol_1').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_non_kogol_1.data.labels= data.singkatan;
            chart_percepatan_non_kogol_1.data.datasets[0].data = data.percepatan;
            chart_percepatan_non_kogol_1.data.datasets[0].backgroundColor = colours;
            chart_percepatan_non_kogol_1.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_non_kogol_1.data.datasets[0].borderColor = colours;
            chart_percepatan_non_kogol_1.data.datasets[0].borderColorHover = colours;
            chart_percepatan_non_kogol_1.options.plugins.datalabels.color = colours;
            chart_percepatan_non_kogol_1.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_non_kogol_1.options.plugins.datalabels.align = alignments;
            chart_percepatan_non_kogol_1.update();

            $('div#percepatan_non_kogol_1').unblock();

        });

        $('div#percepatan_kogol_0').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=0&pic=X&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_kogol_0.data.labels= data.singkatan;
            chart_percepatan_kogol_0.data.datasets[0].data = data.percepatan;
            chart_percepatan_kogol_0.data.datasets[0].backgroundColor = colours;
            chart_percepatan_kogol_0.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_kogol_0.data.datasets[0].borderColor = colours;
            chart_percepatan_kogol_0.data.datasets[0].borderColorHover = colours;
            chart_percepatan_kogol_0.options.plugins.datalabels.color = colours;
            chart_percepatan_kogol_0.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_kogol_0.options.plugins.datalabels.align = alignments;
            chart_percepatan_kogol_0.update();

            $('div#percepatan_kogol_0').unblock();

        });

        $('div#percepatan_kogol_2').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=2&pic=X&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_kogol_2.data.labels= data.singkatan;
            chart_percepatan_kogol_2.data.datasets[0].data = data.percepatan;
            chart_percepatan_kogol_2.data.datasets[0].backgroundColor = colours;
            chart_percepatan_kogol_2.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_kogol_2.data.datasets[0].borderColor = colours;
            chart_percepatan_kogol_2.data.datasets[0].borderColorHover = colours;
            chart_percepatan_kogol_2.options.plugins.datalabels.color = colours;
            chart_percepatan_kogol_2.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_kogol_2.options.plugins.datalabels.align = alignments;
            chart_percepatan_kogol_2.update();

            $('div#percepatan_kogol_2').unblock();

        });

        $('div#percepatan_kogol_3').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=3&pic=X&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_kogol_3.data.labels= data.singkatan;
            chart_percepatan_kogol_3.data.datasets[0].data = data.percepatan;
            chart_percepatan_kogol_3.data.datasets[0].backgroundColor = colours;
            chart_percepatan_kogol_3.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_kogol_3.data.datasets[0].borderColor = colours;
            chart_percepatan_kogol_3.data.datasets[0].borderColorHover = colours;
            chart_percepatan_kogol_3.options.plugins.datalabels.color = colours;
            chart_percepatan_kogol_3.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_kogol_3.options.plugins.datalabels.align = alignments;
            chart_percepatan_kogol_3.update();

            $('div#percepatan_kogol_3').unblock();

        });

        $('div#percepatan_kogol_4').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=4&pic=X&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_kogol_4.data.labels= data.singkatan;
            chart_percepatan_kogol_4.data.datasets[0].data = data.percepatan;
            chart_percepatan_kogol_4.data.datasets[0].backgroundColor = colours;
            chart_percepatan_kogol_4.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_kogol_4.data.datasets[0].borderColor = colours;
            chart_percepatan_kogol_4.data.datasets[0].borderColorHover = colours;
            chart_percepatan_kogol_4.options.plugins.datalabels.color = colours;
            chart_percepatan_kogol_4.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_kogol_4.options.plugins.datalabels.align = alignments;
            chart_percepatan_kogol_4.update();

            $('div#percepatan_kogol_4').unblock();

        });

        $('div#percepatan_mup3').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=MUP3&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_mup3.data.labels= data.singkatan;
            chart_percepatan_mup3.data.datasets[0].data = data.percepatan;
            chart_percepatan_mup3.data.datasets[0].backgroundColor = colours;
            chart_percepatan_mup3.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_mup3.data.datasets[0].borderColor = colours;
            chart_percepatan_mup3.data.datasets[0].borderColorHover = colours;
            chart_percepatan_mup3.options.plugins.datalabels.color = colours;
            chart_percepatan_mup3.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_mup3.options.plugins.datalabels.align = alignments;
            chart_percepatan_mup3.update();

            $('div#percepatan_mup3').unblock();

        });

        $('div#percepatan_mbsar').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=MBSAR&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_mbsar.data.labels= data.singkatan;
            chart_percepatan_mbsar.data.datasets[0].data = data.percepatan;
            chart_percepatan_mbsar.data.datasets[0].backgroundColor = colours;
            chart_percepatan_mbsar.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_mbsar.data.datasets[0].borderColor = colours;
            chart_percepatan_mbsar.data.datasets[0].borderColorHover = colours;
            chart_percepatan_mbsar.options.plugins.datalabels.color = colours;
            chart_percepatan_mbsar.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_mbsar.options.plugins.datalabels.align = alignments;
            chart_percepatan_mbsar.update();

            $('div#percepatan_mbsar').unblock();

        });

        $('div#percepatan_mulp').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=MULP&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_mulp.data.labels= data.singkatan;
            chart_percepatan_mulp.data.datasets[0].data = data.percepatan;
            chart_percepatan_mulp.data.datasets[0].backgroundColor = colours;
            chart_percepatan_mulp.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_mulp.data.datasets[0].borderColor = colours;
            chart_percepatan_mulp.data.datasets[0].borderColorHover = colours;
            chart_percepatan_mulp.options.plugins.datalabels.color = colours;
            chart_percepatan_mulp.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_mulp.options.plugins.datalabels.align = alignments;
            chart_percepatan_mulp.update();

            $('div#percepatan_mulp').unblock();

        });

        $('div#percepatan_biller').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardPercepatanUnit.php?unitap='+unitap+'&kogol=X&pic=BILLER&blth='+blth, function(data){

            if(data.success=='true' || data.success){
                colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
                alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");
            }
            
            chart_percepatan_biller.data.labels= data.singkatan;
            chart_percepatan_biller.data.datasets[0].data = data.percepatan;
            chart_percepatan_biller.data.datasets[0].backgroundColor = colours;
            chart_percepatan_biller.data.datasets[0].backgroundColorHover = colours;
            chart_percepatan_biller.data.datasets[0].borderColor = colours;
            chart_percepatan_biller.data.datasets[0].borderColorHover = colours;
            chart_percepatan_biller.options.plugins.datalabels.color = colours;
            chart_percepatan_biller.options.plugins.datalabels.anchor = alignments;
            chart_percepatan_biller.options.plugins.datalabels.align = alignments;
            chart_percepatan_biller.update();

            $('div#percepatan_biller').unblock();

        });

        $('div#trend_percepatan_pola_bayar').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardTrendPercepatanPolaBayar.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            chart_trend_percepatan_pola_bayar.data.labels= data.blth;
            chart_trend_percepatan_pola_bayar.data.datasets[0].data = data.lancar;
            chart_trend_percepatan_pola_bayar.data.datasets[1].data = data.baru;
            chart_trend_percepatan_pola_bayar.data.datasets[2].data = data.irisan;
            chart_trend_percepatan_pola_bayar.update();

            $('div#trend_percepatan_pola_bayar').unblock();
        });

        $('div#trend_jml_plg_pola_bayar').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardTrendJmlPlgPolaBayar.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            chart_trend_jml_plg_pola_bayar.data.labels= data.blth;
            chart_trend_jml_plg_pola_bayar.data.datasets[0].data = data.lancar;
            chart_trend_jml_plg_pola_bayar.data.datasets[1].data = data.wo;
            chart_trend_jml_plg_pola_bayar.update();

            $('div#trend_jml_plg_pola_bayar').unblock();
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
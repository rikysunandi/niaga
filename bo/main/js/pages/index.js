$(function() {
    "use strict";

    var chart_unit, chart_akhir_unit, chart_akhir_tetap_unit, chart_trend_rata_rata_saldo_tunggakan;

        // Parsing miss-matches and typo's
    var Format = wNumb({
        thousand: '.',
        decimals: 1
    });

    var colours="";
    var alignments="";
    var panel_width = $('.content-body').width();

    $('#sel_unit').selectpicker('val', '00');
    $('#sel_blth').selectpicker('refresh');

    var unitap=$('#sel_unit').selectpicker('val');
    var blth=$('#sel_blth').selectpicker('val');

    // $('div.card').block({ message: '...' });
    // $('div#trend_rata_rata_saldo_tunggakan').block({ message: 'Mengambil data...' });
    // $('div#card_ts_p2tl_akhir').block({ message: 'Mengambil data...' });
    // $('div#card_ts_p2tl_akhir_tetap').block({ message: 'Mengambil data...' });
    // $('div#card_blocking_token').block({ message: 'Mengambil data...' });
    // $('div#card_saldo_awal').block({ message: 'Mengambil data...' });
    // $('div#card_pengurangan').block({ message: 'Mengambil data...' });
    // $('div#card_saldo_akhir').block({ message: 'Mengambil data...' });
    // $('div#card_saldo_akhir_tetap').block({ message: 'Mengambil data...' });
    // $('div#card_saldo_detail').block({ message: 'Mengambil data...' });
    // $('div#card_rekap_blocking table tbody').empty();


    $('div#peta_rata_rata_saldo_tunggakan').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getRataRataSaldoTunggakan.php?unitap='+unitap+'&blth='+blth, function(data){
        var tr = '';
        $.each(data.rows, function(k,v){

            $('#'+v.unitap+' path').removeClass('default');
            if(v.realisasi>110){
                $('#'+v.unitap+' path').addClass('os');
                tr += '<tr class="tr-os">';
            }else if(v.realisasi>=100){
                $('#'+v.unitap+' path').addClass('mr');
                tr += '<tr class="tr-mr">';
            }else if(v.realisasi>=80){
                $('#'+v.unitap+' path').addClass('ur');
                tr += '<tr class="tr-ur">';
            }else if(v.realisasi>=0){
                $('#'+v.unitap+' path').addClass('ni');
                tr += '<tr class="tr-ni">';
            }else{
                $('#'+v.unitap+' path').addClass('minus');
                tr += '<tr class="tr-minus">';
            }
            $('#'+v.unitap+' path').attr('title', v.nama+' ('+v.realisasi+'%)')
                                    .attr('data-original-title', v.nama+' ('+v.realisasi+'%)')
                                    .tooltip('update');

            tr += '<td class="text-center">'+v.unitap+'</td>';
            tr += '<td class="text-right">'+v.pal_tagsus+'</td>';
            tr += '<td class="text-right">'+v.rata2_saldo_tunggakan+'</td>';
            tr += '<td class="text-right">'+v.target+'</td>';
            tr += '<td class="text-right">'+v.realisasi+'%</td>';
            tr += '<td class="text-right">'+v.kali_nihil+'</td>';
            tr += '<td class="text-right">'+v.batas_saldo_bulan_depan+'</td>';
            tr += '<td class="text-right">'+v.max_realisasi_bulan_depan+'%</td>';
            tr += '<td class="text-right">'+v.batas_saldo_bulan_sisa+'</td>';
            tr += '<td class="text-right">'+v.max_realisasi_bulan_sisa+'%</td>';
            tr += '</tr>';

        });

        var tfoot = '';
        if(data.uid.realisasi>110){
            tfoot += '<tr class="tr-os">';
        }else if(data.uid.realisasi>=100){
            tfoot += '<tr class="tr-mr">';
        }else if(data.uid.realisasi>=80){
            tfoot += '<tr class="tr-ur">';
        }else if(data.uid.realisasi>=0){
            tfoot += '<tr class="tr-ni">';
        }else{
            tfoot += '<tr class="tr-minus">';
        }

        tfoot += '<td class="text-center">TOTAL</td>';
        tfoot += '<td class="text-right">'+(data.uid.pal_tagsus)+'</td>';
        tfoot += '<td class="text-right">'+(data.uid.rata2_saldo_tunggakan)+'</td>';
        tfoot += '<td class="text-right">'+(data.uid.target)+'</td>';
        tfoot += '<td class="text-right">'+(data.uid.realisasi)+'%</td>';
        tfoot += '<td class="text-right">'+(data.uid.kali_nihil)+'</td>';
        tfoot += '<td class="text-right">'+(data.uid.batas_saldo_bulan_depan)+'</td>';
        tfoot += '<td class="text-right">'+(data.uid.max_realisasi_bulan_depan)+'%</td>';
        tfoot += '<td class="text-right">'+(data.uid.batas_saldo_bulan_sisa)+'</td>';
        tfoot += '<td class="text-right">'+(data.uid.max_realisasi_bulan_sisa)+'%</td>';
        tfoot += '</tr>';

        $('div#peta_rata_rata_saldo_tunggakan table tbody').append(tr);
        $('div#peta_rata_rata_saldo_tunggakan table tfoot').append(tfoot);
        $('div#peta_rata_rata_saldo_tunggakan').unblock();

    });

    
    $('div#trend_rata_rata_saldo_tunggakan').block({ message: 'Mengambil data...' });
    $.getJSON('../controller/getDashboardTrendRataRataSaldoTunggakan.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

        //const colours = data.percepatan.map((value) => value < 0 ? "#EC5B43" : "#135470");
        //const alignments = data.percepatan.map((value) => value < 0 ? "start" : "end");

        var ctx = document.getElementById("chart_trend_rata_rata_saldo_tunggakan");
        ctx.height = 380;
        //ctx.width = 0.45*panel_width;
        chart_trend_rata_rata_saldo_tunggakan = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.blth,
                datasets: [
                    {
                      label: 'RP TARGET',
                      data: data.target,
                      borderColor: '#135440',
                      backgroundColor: addAlpha('#135440', 0.1),
                      fill: true,
                      //hidden: true
                    },
                    {
                      label: 'RP SALDO',
                      data: data.pal_tagsus,
                      borderColor: '#F2C36B',
                      backgroundColor: addAlpha('#F2C36B', 0.1),
                      fill: false
                    },
                    {
                      label: 'RP RATA2 SALDO',
                      data: data.rata2_saldo_tunggakan,
                      borderColor: '#EC5B43',
                      backgroundColor: addAlpha('#EC5B43', 0.1),
                      fill: false,
                      //hidden: true
                    },
                  ]
            },
            //plugins: [ChartDataLabels],
            options: {
                maintainAspectRatio: false, 
                responsive: true,
                barRadius: 2,
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
                interaction: {
                  intersect: false,
                  mode: 'index',
                },
                scales: { 

                    x: {
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: false,
                            drawTicks: true,
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
                            display: false,
                            // callback: function(val, index) {
                            //     // console.log('val '+val);
                            //     // return new Intl.NumberFormat('id-ID').format(val/1000000)+' Jt';
                            // }
                        },
                    }
                    
                } 
                // scales: {
                //     x: {
                //         grid: {
                //             display: false,
                //             drawBorder: false,
                //             drawOnChartArea: false,
                //             drawTicks: false,
                //         },
                //         ticks: {
                //             display: true //this will remove only the label
                //         }
                //     },
                //     y: {
                //         grid: {
                //             display: true,
                //             drawBorder: true,
                //             drawOnChartArea: true,
                //             drawTicks: true,
                //         },
                //         ticks: {
                //             display: true,
                //             text: 'Rupiah',
                //             callback: function(value, index, values) {
                //                 console.log('label2', value);
                //                 return (value)+'Jt';
                //             }
                //         }
                //     },
                // },
                // plugins: {
                //     legend: {
                //         display: true,
                //         labels: {
                //           usePointStyle: true,
                //         },
                //         position: 'top'
                //     },
                //     title: {
                //         display: false,
                //     },
                //     tooltip: {
                //        bodyFontSize: 10,
                //        callbacks: {
                //             title: function(t) {
                //                 console.log('title', t);
                //                 return "BLTH "+t[0].label;
                //             },
                //             label: function(t) {
                //                 console.log('label', t);
                //                 var dstLabel = t.dataset.label;
                //                 var yLabel = t.raw;
                //                 if(dstLabel.substring(0,2)=="RP")
                //                     return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format((parseFloat(yLabel)*10).toFixed(2)) + 'Myr';
                //                 else
                //                     return dstLabel + ': ' + new Intl.NumberFormat('id-ID').format((parseFloat(yLabel)*10).toFixed(2)) + 'Jt';
                //             }
                //        }
                //     },
                //     datalabels: {
                //         // color: colours,
                //         anchor: 'top',
                //         align: 'top',
                //         clip: false,
                //         clamp: true,
                //         display: true,
                //         formatter: function(value, context) {
                //           return value;
                //         }
                //     }
                // }
              },
        });

        var tr='';
        $.each(data.blth, function(k,v){

            if(data.realisasi[k]==null){
                tr += '<tr class="tr-blank">';
                tr += '<td class="text-center">'+v+'</td>';
                tr += '<td class="text-right"></td>';
                tr += '<td class="text-right"></td>';
                tr += '<td class="text-right"></td>';
                tr += '<td class="text-right"></td>';
                tr += '</tr>';
            }else{

                if(data.realisasi[k]>110){
                    tr += '<tr class="tr-os">';
                }else if(data.realisasi[k]>=100){
                    tr += '<tr class="tr-mr">';
                }else if(data.realisasi[k]>=80){
                    tr += '<tr class="tr-ur">';
                }else if(data.realisasi[k]>=0){
                    tr += '<tr class="tr-ni">';
                }else{
                    tr += '<tr class="tr-minus">';
                }
                
                tr += '<td class="text-center">'+v+'</td>';
                tr += '<td class="text-right">'+new Intl.NumberFormat('id-ID').format(data.pal_tagsus[k])+'</td>';
                tr += '<td class="text-right">'+new Intl.NumberFormat('id-ID').format(data.rata2_saldo_tunggakan[k])+'</td>';
                tr += '<td class="text-right">'+new Intl.NumberFormat('id-ID').format(data.target[k])+'</td>';
                tr += '<td class="text-right">'+new Intl.NumberFormat('id-ID').format(data.realisasi[k])+'%</td>';
                tr += '</tr>';
            }

        });


        $('div#trend_rata_rata_saldo_tunggakan table tbody').append(tr);
        $('div#trend_rata_rata_saldo_tunggakan').unblock();

    });

    $('#btn_go').click(function(){

        var unitap=$('#sel_unit').selectpicker('val');
        var blth=$('#sel_blth').selectpicker('val');

        // $('div#card_ts_p2tl').block({ message: 'Mengambil data...' });
        // $('div#card_ts_p2tl_akhir').block({ message: 'Mengambil data...' });
        // $('div#card_blocking_token').block({ message: 'Mengambil data...' });
        // $('div#card_saldo_awal').block({ message: 'Mengambil data...' });
        // $('div#card_pengurangan').block({ message: 'Mengambil data...' });
        // $('div#card_saldo_akhir').block({ message: 'Mengambil data...' });
        // $('div#card_saldo_detail').block({ message: 'Mengambil data...' });
        // $('div#card_rekap_blocking table tbody').empty();

        $('div#peta_rata_rata_saldo_tunggakan').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getRataRataSaldoTunggakan.php?unitap='+unitap+'&blth='+blth, function(data){
            var tr = '';
            $('div#peta_rata_rata_saldo_tunggakan table tbody').empty();
            $('div#peta_rata_rata_saldo_tunggakan table tfoot').empty();

            $.each(data.rows, function(k,v){

                $('#'+v.unitap+' path').removeClass('default');
                $('#'+v.unitap+' path').removeClass('os');
                $('#'+v.unitap+' path').removeClass('mr');
                $('#'+v.unitap+' path').removeClass('ur');
                $('#'+v.unitap+' path').removeClass('ni');
                $('#'+v.unitap+' path').removeClass('minus');
                if(v.realisasi>110){
                    $('#'+v.unitap+' path').addClass('os');
                    tr += '<tr class="tr-os">';
                }else if(v.realisasi>=100){
                    $('#'+v.unitap+' path').addClass('mr');
                    tr += '<tr class="tr-mr">';
                }else if(v.realisasi>=80){
                    $('#'+v.unitap+' path').addClass('ur');
                    tr += '<tr class="tr-ur">';
                }else if(v.realisasi>=0){
                    $('#'+v.unitap+' path').addClass('ni');
                    tr += '<tr class="tr-ni">';
                }else{
                    $('#'+v.unitap+' path').addClass('minus');
                    tr += '<tr class="tr-minus">';
                }
                $('#'+v.unitap+' path').attr('title', v.nama+' ('+v.realisasi+'%)')
                                        .attr('data-original-title', v.nama+' ('+v.realisasi+'%)')
                                        .tooltip('update');

                tr += '<td class="text-center">'+v.unitap+'</td>';
                tr += '<td class="text-right">'+v.pal_tagsus+'</td>';
                tr += '<td class="text-right">'+v.rata2_saldo_tunggakan+'</td>';
                tr += '<td class="text-right">'+v.target+'</td>';
                tr += '<td class="text-right">'+v.realisasi+'%</td>';
                tr += '<td class="text-right">'+v.kali_nihil+'</td>';
                tr += '<td class="text-right">'+v.batas_saldo_bulan_depan+'</td>';
                tr += '<td class="text-right">'+v.max_realisasi_bulan_depan+'%</td>';
                tr += '<td class="text-right">'+v.batas_saldo_bulan_sisa+'</td>';
                tr += '<td class="text-right">'+v.max_realisasi_bulan_sisa+'%</td>';
                tr += '</tr>';

            });

            var tfoot = '';
            if(data.uid.realisasi>110){
                tfoot += '<tr class="tr-os">';
            }else if(data.uid.realisasi>=100){
                tfoot += '<tr class="tr-mr">';
            }else if(data.uid.realisasi>=80){
                tfoot += '<tr class="tr-ur">';
            }else if(data.uid.realisasi>=0){
                tfoot += '<tr class="tr-ni">';
            }else{
                tfoot += '<tr class="tr-minus">';
            }

            tfoot += '<td class="text-center">TOTAL</td>';
            tfoot += '<td class="text-right">'+(data.uid.pal_tagsus)+'</td>';
            tfoot += '<td class="text-right">'+(data.uid.rata2_saldo_tunggakan)+'</td>';
            tfoot += '<td class="text-right">'+(data.uid.target)+'</td>';
            tfoot += '<td class="text-right">'+(data.uid.realisasi)+'%</td>';
            tfoot += '<td class="text-right">'+(data.uid.kali_nihil)+'</td>';
            tfoot += '<td class="text-right">'+(data.uid.batas_saldo_bulan_depan)+'</td>';
            tfoot += '<td class="text-right">'+(data.uid.max_realisasi_bulan_depan)+'%</td>';
            tfoot += '<td class="text-right">'+(data.uid.batas_saldo_bulan_sisa)+'</td>';
            tfoot += '<td class="text-right">'+(data.uid.max_realisasi_bulan_sisa)+'%</td>';
            tfoot += '</tr>';

            $('div#peta_rata_rata_saldo_tunggakan table tbody').append(tr);
            $('div#peta_rata_rata_saldo_tunggakan table tfoot').append(tfoot);
            $('div#peta_rata_rata_saldo_tunggakan').unblock();


        });


        $('div#trend_rata_rata_saldo_tunggakan').block({ message: 'Mengambil data...' });
        $.getJSON('../controller/getDashboardTrendRataRataSaldoTunggakan.php?unitap='+unitap+'&kogol=X&pic=X&blth='+blth, function(data){

            chart_trend_rata_rata_saldo_tunggakan.data.labels= data.blth;
            chart_trend_rata_rata_saldo_tunggakan.data.datasets[0].data = data.target;
            chart_trend_rata_rata_saldo_tunggakan.data.datasets[1].data = data.pal_tagsus;
            chart_trend_rata_rata_saldo_tunggakan.data.datasets[2].data = data.rata2_saldo_tunggakan;
            chart_trend_rata_rata_saldo_tunggakan.update();

            $('div#trend_rata_rata_saldo_tunggakan table tbody').empty();

            var tr='';
            $.each(data.blth, function(k,v){

                if(data.realisasi[k]==null){
                    tr += '<tr class="tr-blank">';
                    tr += '<td class="text-center">'+v+'</td>';
                    tr += '<td class="text-right"></td>';
                    tr += '<td class="text-right"></td>';
                    tr += '<td class="text-right"></td>';
                    tr += '<td class="text-right"></td>';
                    tr += '</tr>';
                }else{

                    if(data.realisasi[k]>110){
                        tr += '<tr class="tr-os">';
                    }else if(data.realisasi[k]>=100){
                        tr += '<tr class="tr-mr">';
                    }else if(data.realisasi[k]>=80){
                        tr += '<tr class="tr-ur">';
                    }else if(data.realisasi[k]>=0){
                        tfoot += '<tr class="tr-ni">';
                    }else{
                        tfoot += '<tr class="tr-minus">';
                    }
                    
                    tr += '<td class="text-center">'+v+'</td>';
                    tr += '<td class="text-right">'+new Intl.NumberFormat('id-ID').format(data.pal_tagsus[k])+'</td>';
                    tr += '<td class="text-right">'+new Intl.NumberFormat('id-ID').format(data.rata2_saldo_tunggakan[k])+'</td>';
                    tr += '<td class="text-right">'+new Intl.NumberFormat('id-ID').format(data.target[k])+'</td>';
                    tr += '<td class="text-right">'+new Intl.NumberFormat('id-ID').format(data.realisasi[k])+'%</td>';
                    tr += '</tr>';
                }

            });


            $('div#trend_rata_rata_saldo_tunggakan table tbody').append(tr);
            $('div#trend_rata_rata_saldo_tunggakan').unblock();

        });

    });

    // draw background
    // var backgroundColor = 'white';
    // Chart.plugins.register({
    //     beforeDraw: function(c) {
    //         var ctx = c.chart.ctx;
    //         ctx.fillStyle = backgroundColor;
    //         ctx.fillRect(0, 0, c.chart.width, c.chart.height);
    //     }
    // });


    function addAlpha(color, opacity) {
        // coerce values so ti is between 0 and 1.
        var _opacity = Math.round(Math.min(Math.max(opacity || 1, 0), 1) * 255);
        return color + _opacity.toString(16).toUpperCase();
    }

    $(".btn-download").click(function(){
        console.log('download');
        var canvas = $(this).closest( ".card" ).children('.card-body').children('canvas');

        canvas.get(0).toBlob(function(blob) {
            saveAs(blob, "Chart.png");
        });
    });

});
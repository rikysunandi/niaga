$(function() {
    "use strict";

    $('select[name=sel_unit]').val("00");
    $('.selectpicker').selectpicker('refresh')

    var chart_unit, chart_status_proses, chart_tmp, chart_segmen_tegangan, chart_alasan, chart_ket_transaksi;

    // Parsing miss-matches and typo's
    var Format = wNumb({
        thousand: ','
    });

    $('div#card_tagging_lpb').block({ message: 'Mengambil data...' });
    $('div#card_rank_up3').block({ message: 'Mengambil data...' });
    $('div#card_rank_up3 table tbody').empty();
    $('div#card_rank_unit').block({ message: 'Mengambil data...' });
    $('div#card_rank_unit table tbody').empty();


    $.getJSON('../controller/pemeriksaan_lpb/getDashboardTaggingLPBUnit.php', function(data){
        $('#total_plg').html(Format.to(data.total_plg)+'<small> PLG</small>');
        $('#total_sdh_tagging').html(Format.to(data.total_sdh_tagging)+'<small> PLG</small>');
        $('#total_blm_tagging').html(Format.to(data.total_blm_tagging)+'<small> PLG</small>');

        var ctx = document.getElementById("chart_tagging_lpb_unit");
        ctx.height = 240;
        chart_unit = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    // {
                    //     label: "Sudah Tagging (%)",
                    //     type: "bar",
                    //     stack: 'TAGGING LPB PERSEN',
                    //     backgroundColor: "#7F63F4",
                    //     backgroundColorHover: "#7F63F4",
                    //     data: data.persentase_sdh,
                    // },
                    // {
                    //     label: "Belum Tagging (%)",
                    //     type: "bar",
                    //     stack: 'TAGGING LPB PERSEN',
                    //     backgroundColor: "#9DA6AB",
                    //     backgroundColorHover: "#9DA6AB",
                    //     data: data.persentase_blm,
                    // },
                    {
                        label: "Sudah Tagging",
                        type: "bar",
                        stack: 'TAGGING LPB',
                        backgroundColor: "#135450",
                        backgroundColorHover: "#135450",
                        data: data.jml_sdh_tagging,
                    },
                    {
                        label: "Belum Tagging",
                        type: "bar",
                        stack: 'TAGGING LPB',
                        backgroundColor: "#9DA6AB",
                        backgroundColorHover: "#9DA6AB",
                        data: data.jml_blm_tagging,
                    },
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false, 
                barRadius: 2,
                title: {
                    display: false,
                    text: 'Rekap Tagging LPB'
                },
                // tooltips: {
                //     mode: 'index',
                //     intersect: false,
                //     callbacks: {
                //     }
                // },
                tooltips: {
                   mode: 'label',
                   callbacks: {
                      label: function(t, d) {
                         var dstLabel = d.datasets[t.datasetIndex].label;
                         var yLabel = t.yLabel;
                         return dstLabel + ': ' + Format.to(yLabel) ;
                      }
                   }
                },
                legend: {
                    position: 'bottom',
                    display: true,
                    stacked: true,
                    labels: {
                        // fontFamily: 'CircularStdBook',
                    },
                },
                plugins: {
                    labels: []
                },
                scales: {
                    yAxes: [{
                        display: false,
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                    }]
                }
            }
        });

        $('div#card_tagging_lpb').unblock();

        var tr = '';
        $.each(data.rows, function(k,v){
            tr += '<tr>';
            tr += '<td>'+v.unit+'</td>';
            tr += '<td>'+v.nama+'</td>';
            tr += '<td>'+v.jml_plg+'</td>';
            tr += '<td>'+v.jml_sdh_tagging+'</td>';
            tr += '<td>'+v.jml_blm_tagging+'</td>';
            tr += '<td>'+v.persentase+'</td>';
            tr += '</tr>';
        });

        tr += '<tr>';
        tr += '<td></td>';
        tr += '<td><strong>TOTAL</strong></td>';
        tr += '<td><strong>'+Format.to(data.total_plg)+'</strong></td>';
        tr += '<td><strong>'+Format.to(data.total_sdh_tagging)+'</strong></td>';
        tr += '<td><strong>'+Format.to(data.total_blm_tagging)+'</strong></td>';
        tr += '<td><strong>'+data.total_persentase+'</strong></td>';
        tr += '</tr>';

        $('div#card_rank_up3 table tbody').append(tr);
        $('div#card_rank_up3').unblock();

        var tr = '';
        $.each(data.ulp, function(k,v){
            tr += '<tr>';
            tr += '<td>'+v.unit+'</td>';
            tr += '<td>'+v.nama+'</td>';
            tr += '<td>'+v.jml_plg+'</td>';
            tr += '<td>'+v.jml_sdh_tagging+'</td>';
            tr += '<td>'+v.jml_blm_tagging+'</td>';
            tr += '<td>'+v.persentase+'</td>';
            tr += '</tr>';
        });

        tr += '<tr>';
        tr += '<td></td>';
        tr += '<td><strong>TOTAL</strong></td>';
        tr += '<td><strong>'+Format.to(data.ulp_total_plg)+'</strong></td>';
        tr += '<td><strong>'+Format.to(data.ulp_total_sdh_tagging)+'</strong></td>';
        tr += '<td><strong>'+Format.to(data.ulp_total_blm_tagging)+'</strong></td>';
        tr += '<td><strong>'+data.ulp_total_persentase+'</strong></td>';
        tr += '</tr>';

        $('div#card_rank_unit table tbody').append(tr);
        $('div#card_rank_unit').unblock();

    });

    $('#sel_unit').change(function(){
        var unitap=this.value;

        // Update Bar Chart per Unit
        $('div#card_tagging_lpb').block({ message: 'Mengambil data...' });
        $('div#card_rank_up3').block({ message: 'Mengambil data...' });
        $('div#card_rank_up3 table tbody').empty();
        $('div#card_rank_unit').block({ message: 'Mengambil data...' });
        $('div#card_rank_unit table tbody').empty();
        chart_unit.reset();
        $('#total_plg').html("0");
        $('#total_sdh_tagging').html("0");
        $('#total_blm_tagging').html("0");

        $.getJSON('../controller/pemeriksaan_lpb/getDashboardTaggingLPBUnit.php?unitap='+unitap, function(data){
            $('#total_plg').html(Format.to(data.total_plg)+'<small> PLG</small>');
            $('#total_sdh_tagging').html(Format.to(data.total_sdh_tagging)+'<small> PLG</small>');
            $('#total_blm_tagging').html(Format.to(data.total_blm_tagging)+'<small> PLG</small>');

            chart_unit.data.labels = data.singkatan;
            chart_unit.data.datasets[0].data = data.jml_sdh_tagging;
            chart_unit.data.datasets[1].data = data.jml_blm_tagging;
            chart_unit.update();

            $('div#card_tagging_lpb').unblock();


            var tr = '';
            $.each(data.rows, function(k,v){
                tr += '<tr>';
                tr += '<td>'+v.unit+'</td>';
                tr += '<td>'+v.nama+'</td>';
                tr += '<td>'+v.jml_plg+'</td>';
                tr += '<td>'+v.jml_sdh_tagging+'</td>';
                tr += '<td>'+v.jml_blm_tagging+'</td>';
                tr += '<td>'+v.persentase+'</td>';
                tr += '</tr>';
            });

            tr += '<tr>';
            tr += '<td></td>';
            tr += '<td><strong>TOTAL</strong></td>';
            tr += '<td><strong>'+Format.to(data.total_plg)+'</strong></td>';
            tr += '<td><strong>'+Format.to(data.total_sdh_tagging)+'</strong></td>';
            tr += '<td><strong>'+Format.to(data.total_blm_tagging)+'</strong></td>';
            tr += '<td><strong>'+data.total_persentase+'</strong></td>';
            tr += '</tr>';

            $('div#card_rank_up3 table tbody').append(tr);
            $('div#card_rank_up3').unblock();
            
            var tr = '';
            $.each(data.ulp, function(k,v){
                tr += '<tr>';
                tr += '<td>'+v.unit+'</td>';
                tr += '<td>'+v.nama+'</td>';
                tr += '<td>'+v.jml_plg+'</td>';
                tr += '<td>'+v.jml_sdh_tagging+'</td>';
                tr += '<td>'+v.jml_blm_tagging+'</td>';
                tr += '<td>'+v.persentase+'</td>';
                tr += '</tr>';
            });

            tr += '<tr>';
            tr += '<td></td>';
            tr += '<td><strong>TOTAL</strong></td>';
            tr += '<td><strong>'+Format.to(data.ulp_total_plg)+'</strong></td>';
            tr += '<td><strong>'+Format.to(data.ulp_total_sdh_tagging)+'</strong></td>';
            tr += '<td><strong>'+Format.to(data.ulp_total_blm_tagging)+'</strong></td>';
            tr += '<td><strong>'+data.ulp_total_persentase+'</strong></td>';
            tr += '</tr>';

            $('div#card_rank_unit table tbody').append(tr);
            $('div#card_rank_unit').unblock();

        });
    });

    // draw background
    var backgroundColor = 'white';
    Chart.plugins.register({
        beforeDraw: function(c) {
            var ctx = c.chart.ctx;
            ctx.fillStyle = backgroundColor;
            ctx.fillRect(0, 0, c.chart.width, c.chart.height);
        }
    });

    $(".btn-download").click(function(){
        console.log('download');
        var canvas = $(this).closest( ".card" ).children('.card-body').children('canvas');

        canvas.get(0).toBlob(function(blob) {
            saveAs(blob, "Chart.png");
        });
    });

});
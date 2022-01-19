$(document).ready(function () {

    "use strict";

    $('#tbl_agenda_evaluasi thead tr').clone(true).appendTo( '#tbl_agenda_evaluasi thead' );
    $('#tbl_agenda_evaluasi thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
    
    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_agenda_evaluasi').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/getDataAgendaEvaluasi.php',
            "type": "POST",
            "timeout": 10000
        },
        columns: [
          {
            data: "NOAGENDA_INDIVIDU",
            render: function ( data, type, row ) {
                return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            }
          },
          {
            data: "TGLMOHON",
            render: function ( data, type, row ) {
                    return data.substring(0,10);
                },
          },
          {
            data: "STATUS_TMP",
            render: function ( data, type, row ) {
                    if(data == 'DALAM TMP')
                        return '<span class="label label-success">'+data+'</span>';
                    else if(data == 'MENDEKATI TMP')
                        return '<span class="label label-warning">'+data+'</span>';
                    else if(data == 'MELEBIHI TMP')
                        return '<span class="label label-danger">'+data+'</span>';
                },
          },
          {
            data: "RP_BP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "RP_RAB",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            sortable: false,
            render: function ( data, type, row ) {
                    //console.log(row);
                    var rows = new Array();
                    // rows.push(['2020', '2', '3', '4', '5', '6', '7']);
                    // rows.push(['2021', '2', '3', '4', '5', '6', '7']);
                    // rows.push(['2022', '2', '3', '4', '5', '6', '7']);
                    // rows.push(['2023', '2', '3', '4', '5', '6', '7']);
                    // rows.push(['2024', '2', '3', '4', '5', '6', '7']);

                    return '<a href="#" title="FORM 5"><i class="fa fa-file-pdf-o form-5" aria-hidden="true"></i></a>&nbsp;|&nbsp;'+
                            '<a href="#" title="FORM 6"><i class="fa fa-file-pdf-o form-6" aria-hidden="true"></i></a>&nbsp;|&nbsp;'+
                            '<a href="#" title="FORM 7"><i class="fa fa-file-pdf-o form-7" aria-hidden="true"></i></a>&nbsp;';
                },
          },
          {
            data: "RWACC",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "IRR",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "NPV",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "PBP",
          },
          {
            data: "KET_TRANSAKSI",
          },
          {
            data: "TARIF_LAMA",
          },
          {
            data: "DAYA_LAMA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "TARIF_BARU",
          },
          {
            data: "DAYA_BARU",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "ALASAN_KRITERIA_TMP",
          },
        ],
        dom:
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthChange: false,
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;&nbsp;Copy', footer: true },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        "order": [[1, 'asc']],
    });



    // var chart_segmen_tegangan, chart_alasan, chart_tanpa_perluasan, chart_perluasan_jtr, chart_perluasan_jtm;

    // $.getJSON('../controller/getRekapAgendaEvaluasi.php', function(data){
        
    //     var ctx = document.getElementById("chart_segmen_tegangan");
    //     chart_segmen_tegangan = new Chart(ctx, {
    //         type: 'pie',
    //         data: {
    //             datasets: [{
    //                 data: data.segmen_tegangan.jumlah,
    //                 backgroundColor: [
    //                     '#74BCC7',
    //                     '#F2C36B',
    //                     '#EC5B43',
    //                     '#7F63F4',
    //                     '#3D494A',
    //                     '#9DA6AB',
    //                 ],
    //                 label: 'Segmen Tegangan'
    //             }],
    //             labels: data.segmen_tegangan.label
    //         },
    //         options: {
    //             responsive: true,
    //             elements: {
    //                 arc: {
    //                     borderWidth: 0
    //                 }
    //             },
    //             legend: {
    //                 position: 'bottom',
    //                 display: true,
    //                 labels: {
    //                     // fontFamily: 'CircularStdBook',
    //                     fontSize: 8,
    //                 },
    //             },
    //             tooltips:{
    //                 titleFontSize: 8,
    //                 bodyFontSize: 8,
    //                 footerFontSize: 8,
    //             },
    //             plugins: {
    //                 labels: [
    //                     {
    //                       render: 'percentage',
    //                       fontSize: 9,
    //                       fontColor: 'white',
    //                       precision: 1
    //                     }
    //                 ]
    //             },
    //         }
    //     });

    //     var ctx = document.getElementById("chart_alasan");
    //     chart_alasan = new Chart(ctx, {
    //         type: 'pie',
    //         data: {
    //             datasets: [{
    //                 data: data.alasan.jumlah,
    //                 backgroundColor: [
    //                     '#74BCC7',
    //                     '#F2C36B',
    //                     '#EC5B43',
    //                     '#7F63F4',
    //                     '#3D494A',
    //                     '#9DA6AB',
    //                 ],
    //                 label: 'Alasan Kriteria TMP'
    //             }],
    //             labels: data.alasan.label
    //         },
    //         options: {
    //             responsive: true,
    //             elements: {
    //                 arc: {
    //                     borderWidth: 0
    //                 }
    //             },
    //             legend: {
    //                 position: 'bottom',
    //                 display: true,
    //                 labels: {
    //                     // fontFamily: 'CircularStdBook',
    //                     fontSize: 8,
    //                 },
    //             },
    //             tooltips:{
    //                 titleFontSize: 8,
    //                 bodyFontSize: 8,
    //                 footerFontSize: 8,
    //             },
    //             plugins: {
    //                 labels: [
    //                     {
    //                       render: 'percentage',
    //                       fontSize: 9,
    //                       fontColor: 'white',
    //                       precision: 1
    //                     }
    //                 ]
    //             },
    //         }
    //     });

    //     var ctx = document.getElementById("chart_tanpa_perluasan");
    //     chart_tanpa_perluasan = new Chart(ctx, {
    //         type: 'pie',
    //         data: {
    //             datasets: [{
    //                 data: data.tanpa_perluasan.jumlah,
    //                 backgroundColor: [
    //                     '#74BCC7',
    //                     '#F2C36B',
    //                     '#EC5B43',
    //                     '#7F63F4',
    //                     '#3D494A',
    //                     '#9DA6AB',
    //                 ],
    //                 label: 'Tanpa Perluasan'
    //             }],
    //             labels: data.tanpa_perluasan.label
    //         },
    //         options: {
    //             responsive: true,
    //             elements: {
    //                 arc: {
    //                     borderWidth: 0
    //                 }
    //             },
    //             legend: {
    //                 position: 'bottom',
    //                 display: true,
    //                 labels: {
    //                     // fontFamily: 'CircularStdBook',
    //                     fontSize: 8,
    //                 },
    //             },
    //             tooltips:{
    //                 titleFontSize: 8,
    //                 bodyFontSize: 8,
    //                 footerFontSize: 8,
    //             },
    //             plugins: {
    //                 labels: [
    //                     {
    //                       render: 'percentage',
    //                       fontSize: 9,
    //                       fontColor: 'white',
    //                       precision: 1
    //                     }
    //                 ]
    //             },
    //         }
    //     });

    //     var ctx = document.getElementById("chart_perluasan_jtr");
    //     chart_perluasan_jtr = new Chart(ctx, {
    //         type: 'pie',
    //         data: {
    //             datasets: [{
    //                 data: data.perluasan_jtr.jumlah,
    //                 backgroundColor: [
    //                     '#74BCC7',
    //                     '#F2C36B',
    //                     '#EC5B43',
    //                     '#7F63F4',
    //                     '#3D494A',
    //                     '#9DA6AB',
    //                 ],
    //                 label: 'Perluasan JTR'
    //             }],
    //             labels: data.perluasan_jtr.label
    //         },
    //         options: {
    //             responsive: true,
    //             elements: {
    //                 arc: {
    //                     borderWidth: 0
    //                 }
    //             },
    //             legend: {
    //                 position: 'bottom',
    //                 display: true,
    //                 labels: {
    //                     // fontFamily: 'CircularStdBook',
    //                     fontSize: 8,
    //                 },
    //             },
    //             tooltips:{
    //                 titleFontSize: 8,
    //                 bodyFontSize: 8,
    //                 footerFontSize: 8,
    //             },
    //             plugins: {
    //                 labels: [
    //                     {
    //                       render: 'percentage',
    //                       fontSize: 9,
    //                       fontColor: 'white',
    //                       precision: 1
    //                     }
    //                 ]
    //             },
    //         }
    //     });

    //     var ctx = document.getElementById("chart_perluasan_jtm");
    //     chart_perluasan_jtm = new Chart(ctx, {
    //         type: 'pie',
    //         data: {
    //             datasets: [{
    //                 data: data.perluasan_jtm.jumlah,
    //                 backgroundColor: [
    //                     '#74BCC7',
    //                     '#F2C36B',
    //                     '#EC5B43',
    //                     '#7F63F4',
    //                     '#3D494A',
    //                     '#9DA6AB',
    //                 ],
    //                 label: 'Perluasan JTM'
    //             }],
    //             labels: data.perluasan_jtm.label
    //         },
    //         options: {
    //             responsive: true,
    //             elements: {
    //                 arc: {
    //                     borderWidth: 0
    //                 }
    //             },
    //             legend: {
    //                 position: 'bottom',
    //                 display: true,
    //                 labels: {
    //                     // fontFamily: 'CircularStdBook',
    //                     fontSize: 8,
    //                 },
    //             },
    //             tooltips:{
    //                 titleFontSize: 8,
    //                 bodyFontSize: 8,
    //                 footerFontSize: 8,
    //             },
    //             plugins: {
    //                 labels: [
    //                     {
    //                       render: 'percentage',
    //                       fontSize: 9,
    //                       fontColor: 'white',
    //                       precision: 1
    //                     }
    //                 ]
    //             },
    //         }
    //     });
    //     //$('div#card_permohonan_tmp').unblock();

    // });








    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/getDataAgendaEvaluasi.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() ).load();
    

        // $.getJSON('../controller/getRekapAgendaEvaluasi.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() , function(data){

        //     chart_segmen_tegangan.data.datasets[0].data = data.segmen_tegangan.jumlah;
        //     chart_segmen_tegangan.data.labels = data.segmen_tegangan.label;
        //     chart_segmen_tegangan.update();

        //     chart_alasan.data.datasets[0].data = data.alasan.jumlah;
        //     chart_alasan.data.labels = data.alasan.label;
        //     chart_alasan.update();

        //     chart_tanpa_perluasan.data.datasets[0].data = data.tanpa_perluasan.jumlah;
        //     chart_tanpa_perluasan.data.labels = data.tanpa_perluasan.label;
        //     chart_tanpa_perluasan.update();

        //     chart_perluasan_jtr.data.datasets[0].data = data.perluasan_jtr.jumlah;
        //     chart_perluasan_jtr.data.labels = data.perluasan_jtr.label;
        //     chart_perluasan_jtr.update();

        //     chart_perluasan_jtm.data.datasets[0].data = data.perluasan_jtm.jumlah;
        //     chart_perluasan_jtm.data.labels = data.perluasan_jtm.label;
        //     chart_perluasan_jtm.update();
        // });
    });

    $('#tbl_agenda_evaluasi').on('click', 'td i.form-5', function (e) {
        e.preventDefault();    
        var agenda = table.row($(this).closest('tr')).data();
        var pejabat = 'AGUNG NUGRAHA';
        var timestamp = new Date().getUTCMilliseconds();
        var kode_dokumen = 'FORM-6-'+timestamp+Math.random().toString(36).substr(2, 5).toUpperCase();
        
        var dd = {
                pageSize: 'A4',
                watermark: { text: kode_dokumen, color: 'grey', opacity: 0.1, fontSize: 72 },
                content: [
                    {
                        text: kode_dokumen,
                        alignment: 'right'
                    },
                    '\n\n',
                    {
                        text: 'FORMULIR 5\nPERHITUNGAN GANTI RUGI PEMUTUSAN KEPADA PLN\nUID JAWA BARAT\n\n', 
                        alignment: 'center',
                        style: 'header'
                    },
                    {
                        alignment: 'left',
                        widths: ['80%','120%'],
                        columns: [
                            {
                                
                                table: {
                                    body: [
                                        ['Idpelanggan', ': ', agenda.IDPEL],
                                        ['Tarif / Daya', ': ', agenda.TARIF_BARU+' / '+$.fn.dataTable.render.number('.', ',', 0, '').display( agenda.DAYA_BARU )+' VA'],
                                        ['BP', ': ', 'Rp. '+$.fn.dataTable.render.number('.', ',', 0, '').display( agenda.RP_BP )+',-'],
                                        ['Investasi', ': ', 'Rp. '+$.fn.dataTable.render.number('.', ',', 0, '').display( agenda.RP_RAB )+',-'],
                                        ['Hutang Total', ': ', 'Rp. '+$.fn.dataTable.render.number('.', ',', 0, '').display( agenda.RP_RAB - agenda.RP_BP )+',-'],
                                    ]
                                },
                                layout: 'noBorders'
                            },
                            {
                                borders: [[false, false, false, false], '*'],
                                table: {
                                    body: [
                                        ['Nama Pelanggan', ': ', agenda.NAMA],
                                        ['BPP / Marginal Cost Subs.', ': ', '??'],
                                        ['Tarif Adjustment / SPJBTL', ': ', '??'],
                                        ['Margin', ': ', '??'],
                                    ]
                                },
                                layout: 'noBorders'
                            },
                        ]
                    },
                    '\n',
                    {
                        style: 'tableExample',
                        color: '#444',
                        table: {
                            //widths: ['auto', 'auto', 'auto'],
                            headerRows: 1,
                            body: [
                                [
                                    {
                                        text: 'Tahun', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                        
                                    }, 
                                    {
                                        text: 'Jam Nyala Rata-Rata per Bulan', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                        
                                    }, 
                                    {
                                        text: 'kWh Setahun', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: 'Pendapatan (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: 'BPP / Marginal Cost Subsystem (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: 'Margin (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: 'Sisa Hutang (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                ],
                                ['2021', '2', '3', '4', '5', '6', '7'],
                                ['2022', '2', '3', '4', '5', '6', '7'],
                                ['2023', '2', '3', '4', '5', '6', '7'],
                                ['2024', '2', '3', '4', '5', '6', '7'],
                                ['2025', '2', '3', '4', '5', '6', '7'],
                            ]
                        }
                    },
                    {
                        text:  '*) Jangka waktu didasarkan pada perhitungan Payback Period paling lama 5 Tahun\n\n\n',
                        style: ['quote', 'small']
                    },
                    {
                        alignment: 'justify',
                        columns: [
                            '\n\n\n',
                            '',
                            [
                                '\n\n\n',
                                {
                                    alignment: 'center',
                                    text: 'Bandung, 17 Agustus 2020\n'
                                },
                                {
                                    alignment: 'center',
                                    bold: true,
                                    text: 'GENERAL MANAGER\n\n\n\n\n\n'
                                },
                                {
                                    alignment: 'center',
                                    text: pejabat
                                },
                                
                            ]
                        ]
                    }
                ],
                styles: {
                    header: {
                        fontSize: 14,
                        bold: true,
                        margin: [0, 0, 0, 10]
                    },
                    subheader: {
                        fontSize: 12,
                        bold: true,
                        margin: [0, 10, 0, 5]
                    },
                    tableExample: {
                        margin: [0, 5, 0, 15]
                    },
                    tableHeader: {
                        bold: true,
                        fontSize: 9,
                        color: 'black',
                    },
                    quote: {
                        italics: true
                    },
                    small: {
                        fontSize: 8
                    }

                },
                defaultStyle: {
                    // alignment: 'justify'
                    columnGap: 2,
                    fontSize: 9,
                }
                
            };


        pdfMake.createPdf(dd).open();
    });


    $('#tbl_agenda_evaluasi').on('click', 'td i.form-6', function (e) {
        e.preventDefault();    
        var agenda = table.row($(this).closest('tr')).data();
        var pejabat = 'AGUNG NUGRAHA';
        var timestamp = new Date().getUTCMilliseconds();
        var kode_dokumen = 'FORM-6-'+timestamp+Math.random().toString(36).substr(2, 5).toUpperCase();
        
        var dd = {
                pageSize: 'A4',
                watermark: { text: kode_dokumen, color: 'grey', opacity: 0.1, fontSize: 72 },
                content: [
                    {
                        text: kode_dokumen,
                        alignment: 'right'
                    },
                    '\n\n',
                    {
                        text: 'FORMULIR 6\nSURAT PERNYATAAN PENGAKUAN HUTANG\n\n', 
                        alignment: 'center',
                        style: 'header'
                    },
                    {
                        alignment: 'left',
                        widths: ['80%','120%'],
                        columns: [
                            {
                                
                                table: {
                                    body: [
                                        ['Idpelanggan', ': ', agenda.IDPEL],
                                        ['Nama Perusahaan', ': ', ''],
                                        ['Nama Direktur', ': ', ''],
                                        ['No. NPWP Perusahaan', ': ', ''],
                                        ['Alamat Kantor', ': ', ''],
                                        ['No Telepon Kantor', ': ', ''],
                                        ['No Fax Kantor', ': ', ''],
                                        ['No Akta Perusahaan Terakhir', ': ', ''],
                                    ]
                                },
                                layout: 'noBorders'
                            },
                        ]
                    },
                    '\n',
                    {
                        text: 'Sehubungan dengan penyambungan listrik dari PT PLN (Persero) (“PLN”) ke PT….. yang mengakibatkan PLN melakukan pembangunan jaringan dan peralatan tenaga listrik ke perusahaan kami yang membutuhkan biaya investasi sebesar Rp……, dengan ini kami menyatakan kesanggupan (komitmen) untuk menggunakan energi listrik dari PLN minimal …xx... kWh/tahun atau …yy... kWh/bulan selama minimum 5 (lima) tahun sesuai dengan tarif tenaga listrik PLN yang berlaku.',
                        alignment: 'justify'
                    },
                    '\n',
                    {
                        text: 'Dalam hal perusahaan kami,',
                        alignment: 'justify'
                    },
                    {
                        ol: [
                            'Gagal menggunakan energi listrik atau;',
                            'Tidak dapat mencapai realisasi pemakaian energi minimum bulanan atau;',
                            'Berhenti berlangganan sebelum masa 5 tahun terlampaui sebagaimana dimaksudkan di atas, ',
                          ]
                    },
                    {
                        text: 'maka kami menyatakan berhutang kepada PLN dan bersedia mempertanggungjawabkan hutang tersebut di atas secara hukum.',
                        alignment: 'justify'
                    },
                    '\n',
                    {
                        text: 'Besarnya nilai hutang yang timbul akibat kami,',
                        alignment: 'justify'
                    },
                    {
                        ol: [
                            'Gagal menggunakan energi listrik atau;',
                            'Tidak dapat mencapai realisasi pemakaian energi minimum bulanan atau;',
                            'Berhenti berlangganan sebelum masa 5 tahun terlampaui sebagaimana dimaksudkan di atas, ',
                          ]
                    },
                    {
                        text: 'dihitung sebesar nilai investasi yang dikeluarkan oleh PLN dikurangi dengan Biaya Penyambungan yang telah diterima oleh PLN dan nilai pengembalian investasi atas energi listrik yang telah kami gunakan secara proporsional dengan volume pemakaian yang seharusnya dalam masa 5 (lima) tahun.',
                        alignment: 'justify'
                    },
                    '\n',
                    {
                        text: 'Demikian pernyataan ini kami buat dalam keadaan sadar dan tanpa paksaan ataupun tekanan dari pihak manapun.',
                        alignment: 'justify'
                    },
                    {
                        alignment: 'justify',
                        columns: [
                            '\n\n\n',
                            '',
                            [
                                '\n\n\n',
                                {
                                    alignment: 'center',
                                    text: '...................., 17 Agustus 2020\n'
                                },
                                {
                                    alignment: 'center',
                                    bold: true,
                                    text: 'DIREKTUR PT ................. \n\n\n\n\n\n'
                                },
                                {
                                    alignment: 'center',
                                    text: '.............................'
                                },
                                
                            ]
                        ]
                    }
                ],
                styles: {
                    header: {
                        fontSize: 14,
                        bold: true,
                        margin: [0, 0, 0, 10]
                    },
                    subheader: {
                        fontSize: 12,
                        bold: true,
                        margin: [0, 10, 0, 5]
                    },
                    tableExample: {
                        margin: [0, 5, 0, 15]
                    },
                    tableHeader: {
                        bold: true,
                        fontSize: 9,
                        color: 'black',
                    },
                    quote: {
                        italics: true
                    },
                    small: {
                        fontSize: 8
                    }

                },
                defaultStyle: {
                    // alignment: 'justify'
                    columnGap: 2,
                    fontSize: 9,
                }
                
            };


        pdfMake.createPdf(dd).open();
    });


    $('#tbl_agenda_evaluasi').on('click', 'td i.form-7', function (e) {
        e.preventDefault();    
        var agenda = table.row($(this).closest('tr')).data();
        var pejabat = 'AGUNG NUGRAHA';
        var timestamp = new Date().getUTCMilliseconds();
        var kode_dokumen = 'FORM-7-'+timestamp+Math.random().toString(36).substr(2, 5).toUpperCase();
        
        var dd = {
                pageSize: 'A4',
                pageOrientation: 'landscape',
                watermark: { text: kode_dokumen, color: 'grey', opacity: 0.1, fontSize: 72 },
                // footer: {
                //     columns: [
                //         '',
                //         [
                //             {text: kode_dokumen, style:'small'},
                //             { qr: kode_dokumen, fit: '40', style: 'qrCode' },

                //         ]
                //     ]
                //   },
                content: [
                    {
                        text: 'FORMULIR 7\nMONITORING ARUS KAS PENGEMBALIAN INVESTASI\nPENYAMBUNGAN KONSUMEN BP < INVESTASI\nUID JAWA BARAT\n', 
                        alignment: 'center',
                        style: 'header'
                    },
                    {
                        alignment: 'left',
                        widths: ['80%','120%'],
                        columns: [
                            {
                                style: 'small',
                                table: {
                                    body: [
                                        ['Idpelanggan', ': ', agenda.IDPEL],
                                        ['Nama Pelanggan', ': ', agenda.NAMA],
                                        ['Tarif / Daya', ': ', agenda.TARIF_BARU+' / '+$.fn.dataTable.render.number('.', ',', 0, '').display( agenda.DAYA_BARU )+' VA'],
                                        ['RP BP', ': ', 'Rp. '+$.fn.dataTable.render.number('.', ',', 0, '').display( agenda.RP_BP )+',-'],
                                        ['Investasi', ': ', 'Rp. '+$.fn.dataTable.render.number('.', ',', 0, '').display( agenda.RP_RAB )+',-'],
                                        ['Metode Kelayakan', ': ', ''],
                                        ['Payback Period', ': ', ''],
                                    ]
                                },
                                layout: 'noBorders'
                            },
                        ]
                    },
                    '\n',
                    {
                        style: 'tableExample',
                        color: '#444',
                        table: {
                            //widths: ['auto', 'auto', 'auto'],
                            headerRows: 2,
                            body: [
                                [
                                    {
                                        text: 'No', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                        rowSpan: 2
                                        
                                    }, 
                                    {
                                        text: 'Uraian', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                        rowSpan: 2
                                        
                                    }, 
                                    {
                                        text: 'Bulan', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                        rowSpan: 2
                                    },
                                    {
                                        text: 'Cash Out', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                        colSpan: 3
                                    },
                                    '','',
                                    {
                                        text: 'Cash In', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                        colSpan: 3
                                    },
                                    '','',
                                    {
                                        text: 'Net Cash\nCummulative (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                        rowSpan: 2
                                    },
                                ],
                                [
                                    '', '', '', 
                                    {
                                        text: '    kWh    ', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: 'BPP / Marginal Cost Subsystem (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: 'Jumlah (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: '    kWh    ', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: 'Tarif Adjustment / Tarif SPJBTL (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    {
                                        text: 'Jumlah (Rp)', 
                                        style: 'tableHeader', 
                                        alignment: 'center',
                                        fillColor: '#c0e4ea',
                                    },
                                    '', 
                                ],
                                [{ text:'1', rowSpan: 2}, 'Penerimaan BP', '', '', '', '', '', '', '', ''],
                                ['', 'DP Investasi', '', '', '', '', '', '', '', ''],
                                ['2', 'Cicilan 1', '', '', '', '', '', '', '', ''],
                                ['3', 'Cicilan 2', '', '', '', '', '', '', '', ''],
                                ['4', 'Cicilan 3', '', '', '', '', '', '', '', ''],
                                [{ text:'5', rowSpan: 3}, 'Penerimaan Rp PTL', '', '', '', '', '', '', '', ''],
                                ['', 'Cicilan 4', '', '', '', '', '', '', '', ''],
                                ['', 'Biaya Produksi kWh', '', '', '', '', '', '', '', ''],
                                [{ text:'6', rowSpan: 2}, 'Penerimaan Rp PTL', '', '', '', '', '', '', '', ''],
                                ['', 'Biaya Produksi kWh', '', '', '', '', '', '', '', ''],
                                [{ text:'7', rowSpan: 2}, 'Penerimaan Rp PTL', '', '', '', '', '', '', '', ''],
                                ['', 'Biaya Produksi kWh', '', '', '', '', '', '', '', ''],
                            ]
                        }
                    },
                    {
                        alignment: 'justify',
                        columns: [
                            '\n\n\n',
                            '',
                            [
                                {
                                    alignment: 'center',
                                    text: 'Bandung, 17 Agustus 2020\n'
                                },
                                {
                                    alignment: 'center',
                                    bold: true,
                                    text: 'GENERAL MANAGER\n\n\n\n\n\n'
                                },
                                {
                                    alignment: 'center',
                                    text: pejabat
                                },
                                
                            ]
                        ]
                    },
                    '\n',
                    '\n',
                    { qr: kode_dokumen, fit: '25', style: 'qrCode' },
                ],
                styles: {
                    header: {
                        fontSize: 12,
                        bold: true,
                        margin: [0, 0, 0, 10]
                    },
                    subheader: {
                        fontSize: 11,
                        bold: true,
                        margin: [0, 10, 0, 5]
                    },
                    tableExample: {
                        fontSize: 8,
                        margin: [0, 4, 0, 6]
                    },
                    tableHeader: {
                        bold: true,
                        fontSize: 9,
                        color: 'black',
                    },
                    quote: {
                        italics: true
                    },
                    small: {
                        fontSize: 8,
                        lineHeight: 0.9
                    },
                    qrCode:
                    {   
                        alignment: 'right',
                        margin: [0, 0, 10, 0]
                    }

                },
                defaultStyle: {
                    // alignment: 'justify'
                    columnGap: 2,
                    fontSize: 8,
                    lineHeight: 1
                }
                
            };


        pdfMake.createPdf(dd).open();
    });





});
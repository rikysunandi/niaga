$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_formulir_1').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/getRekapUsulanSKAI.php',
            "type": "POST",
            "timeout": 200000
        },
        columns: [
          {
            data: "GOL_TARIF",
            visible: false,
          },
          {
            data: "URUT",
            readonly: true,
          },
          {
            data: "KETERANGAN_GOL_TARIF",
          },
          {
            data: "LT_900_TANPA_PERLUASAN_JML_PLG",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "LT_900_TANPA_PERLUASAN_RP_BP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "LT_900_TANPA_PERLUASAN_RP_INVESTASI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "INDIVIDU_JML_PLG",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "INDIVIDU_RP_BP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "INDIVIDU_RP_INVESTASI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "KOLEKTIF_JML_PLG",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "KOLEKTIF_RP_BP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "KOLEKTIF_RP_INVESTASI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "AGENDA_EVALUASI_JML_PLG",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "AGENDA_EVALUASI_RP_BP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "AGENDA_EVALUASI_RP_INVESTASI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
        ],
        dom:
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthChange: false,
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-file-o"></i>&nbsp;&nbsp;Copy', footer: true },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            { 
                extend: 'pdfHtml5', 
                text: '<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;PDF', 
                orientation: 'landscape',
                pageSize: 'LEGAL', 
                footer: true,
                customize: function (doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 1020,
        "scrollX": true,
        "paging": false,
        "order": [[1, 'asc']],
        rowGroup: {
            startRender: null,
            endRender: function ( rows, group ) {

                var SUM_LT_900_TANPA_PERLUASAN_JML_PLG = rows
                    .data()
                    .pluck('LT_900_TANPA_PERLUASAN_JML_PLG')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_LT_900_TANPA_PERLUASAN_JML_PLG = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_LT_900_TANPA_PERLUASAN_JML_PLG );

                var SUM_LT_900_TANPA_PERLUASAN_RP_BP = rows
                    .data()
                    .pluck('LT_900_TANPA_PERLUASAN_RP_BP')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_LT_900_TANPA_PERLUASAN_RP_BP = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_LT_900_TANPA_PERLUASAN_RP_BP );

                var SUM_LT_900_TANPA_PERLUASAN_RP_INVESTASI = rows
                    .data()
                    .pluck('LT_900_TANPA_PERLUASAN_RP_INVESTASI')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_LT_900_TANPA_PERLUASAN_RP_INVESTASI = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_LT_900_TANPA_PERLUASAN_RP_INVESTASI );



                var SUM_INDIVIDU_JML_PLG = rows
                    .data()
                    .pluck('INDIVIDU_JML_PLG')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_INDIVIDU_JML_PLG = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_INDIVIDU_JML_PLG );

                var SUM_INDIVIDU_RP_BP = rows
                    .data()
                    .pluck('INDIVIDU_RP_BP')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_INDIVIDU_RP_BP = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_INDIVIDU_RP_BP );

                var SUM_INDIVIDU_RP_INVESTASI = rows
                    .data()
                    .pluck('INDIVIDU_RP_INVESTASI')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_INDIVIDU_RP_INVESTASI = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_INDIVIDU_RP_INVESTASI );



                var SUM_KOLEKTIF_JML_PLG = rows
                    .data()
                    .pluck('KOLEKTIF_JML_PLG')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_KOLEKTIF_JML_PLG = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_KOLEKTIF_JML_PLG );

                var SUM_KOLEKTIF_RP_BP = rows
                    .data()
                    .pluck('KOLEKTIF_RP_BP')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_KOLEKTIF_RP_BP = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_KOLEKTIF_RP_BP );

                var SUM_KOLEKTIF_RP_INVESTASI = rows
                    .data()
                    .pluck('KOLEKTIF_RP_INVESTASI')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_KOLEKTIF_RP_INVESTASI = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_KOLEKTIF_RP_INVESTASI );



                var SUM_AGENDA_EVALUASI_JML_PLG = rows
                    .data()
                    .pluck('AGENDA_EVALUASI_JML_PLG')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_AGENDA_EVALUASI_JML_PLG = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_AGENDA_EVALUASI_JML_PLG );

                var SUM_AGENDA_EVALUASI_RP_BP = rows
                    .data()
                    .pluck('AGENDA_EVALUASI_RP_BP')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_AGENDA_EVALUASI_RP_BP = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_AGENDA_EVALUASI_RP_BP );

                var SUM_AGENDA_EVALUASI_RP_INVESTASI = rows
                    .data()
                    .pluck('AGENDA_EVALUASI_RP_INVESTASI')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_AGENDA_EVALUASI_RP_INVESTASI = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_AGENDA_EVALUASI_RP_INVESTASI );

                if( !( group == 'T' || group == 'C' || group == 'L' ))
                return $('<tr/>')
                    .append( '<td colspan="2">Jumlah '+group+'</td>' )
                    .append( '<td class="text-right">'+SUM_LT_900_TANPA_PERLUASAN_JML_PLG+'</td>' )
                    .append( '<td class="text-right">'+SUM_LT_900_TANPA_PERLUASAN_RP_BP+'</td>' )
                    .append( '<td class="text-right">'+SUM_LT_900_TANPA_PERLUASAN_RP_INVESTASI+'</td>' )
                    .append( '<td class="text-right">'+SUM_INDIVIDU_JML_PLG+'</td>' )
                    .append( '<td class="text-right">'+SUM_INDIVIDU_RP_BP+'</td>' )
                    .append( '<td class="text-right">'+SUM_INDIVIDU_RP_INVESTASI+'</td>' )
                    .append( '<td class="text-right">'+SUM_KOLEKTIF_JML_PLG+'</td>' )
                    .append( '<td class="text-right">'+SUM_KOLEKTIF_RP_BP+'</td>' )
                    .append( '<td class="text-right">'+SUM_KOLEKTIF_RP_INVESTASI+'</td>' )
                    .append( '<td class="text-right">'+SUM_AGENDA_EVALUASI_JML_PLG+'</td>' )
                    .append( '<td class="text-right">'+SUM_AGENDA_EVALUASI_RP_BP+'</td>' )
                    .append( '<td class="text-right">'+SUM_AGENDA_EVALUASI_RP_INVESTASI+'</td>' );
            },
            dataSrc: 'GOL_TARIF'
            // dataSrc: function ( row ) {
            //     if( !( row['GOL_TARIF'] == 'T' || row['GOL_TARIF'] == 'C' || row['GOL_TARIF'] == 'L' ))
            //         return row['GOL_TARIF'];
            // }

        },
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
            $( api.column( j ).footer() ).html( $.fn.dataTable.render.number('.', ',', 0, '').display( pageTotal ));
            j++;
          } 
        }
    });

    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/getRekapUsulanSKAI.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() ).load();
    });

});
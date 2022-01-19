$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_material').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/getKebutuhanMaterial.php',
            "type": "POST",
            "timeout": 200000
        },
        columns: [
          {
            data: "JENIS",
            readonly: true,
          },
          {
            data: "KEBUTUHAN",
            readonly: true,
          },
          {
            data: "HARGA_SATUAN",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "VOLUME",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "TOTAL_HARGA",
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
            { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;&nbsp;Copy', footer: true },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": false,
        "order": [[0, 'asc'],[1, 'asc']],
        rowGroup: {
            startRender: null,
            endRender: function ( rows, group ) {

                var SUM_VOLUME = rows
                    .data()
                    .pluck('VOLUME')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_VOLUME = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_VOLUME );

                var SUM_TOTAL_HARGA = rows
                    .data()
                    .pluck('TOTAL_HARGA')
                    .reduce( function (a, b) {
                        return a + b*1;
                    }, 0);
                SUM_TOTAL_HARGA = $.fn.dataTable.render.number('.', ',', 0, '').display( SUM_TOTAL_HARGA );

                return $('<tr/>')
                    .append( '<td colspan="3">Jumlah '+group+'</td>' )
                    .append( '<td class="text-right">'+SUM_VOLUME+'</td>' )
                    .append( '<td class="text-right">'+SUM_TOTAL_HARGA+'</td>' );
            },
            dataSrc: 'JENIS'
            // dataSrc: function ( row ) {
            //     if( !( row['GOL_TARIF'] == 'T' || row['GOL_TARIF'] == 'C' || row['GOL_TARIF'] == 'L' ))
            //         return row['GOL_TARIF'];
            // }

        },
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
            $( api.column( j ).footer() ).html( $.fn.dataTable.render.number('.', ',', 0, '').display( pageTotal ));
            j++;
          } 
        }
    });

    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/getKebutuhanMaterial.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() ).load();
    });

});
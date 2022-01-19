$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_ts_p2tl').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/ts_p2tl/getRekapKesesuaianTSP2TL.php',
            "type": "POST",
            "timeout": 10000
        },
        deferRender: true,
        deferLoading: 25,
        //responsive: true,
        columns: [
          {
            data: "UNITAP",
          },
          {
            data: "UNITUP",
          },
          {
            data: "NAMA_UP",
          },
          {
            data: "JML_TOTAL",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_BA_PENETAPAN_SPH_CEKLOK_SESUAI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_BA_PENETAPAN_SPH_SESUAI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_BA_PENETAPAN_SESUAI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_BA_SESUAI",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_TIDAK_SESUAI",
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
        //lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: -1,
        "order": [[0, 'asc'], [1, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 3;
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
        table.ajax.url( '../controller/ts_p2tl/getRekapKesesuaianTSP2TL.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() ).load();
    });

});
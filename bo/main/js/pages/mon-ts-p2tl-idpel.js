$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_ts_p2tl_idpel').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/ts_p2tl/getDataTSP2TLIdpel.php',
            "type": "POST",
            "timeout": 10000
        },
        deferRender: true,
        deferLoading: 25,
        //responsive: true,
        columns: [
          {
            data: "NAMA_UP",
          },
          {
            data: "IDPEL",
          },
          {
            data: "NAMA",
            visible: false,
          },
          {
            data: "TARIF",
          },
          {
            data: "DAYA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_AGENDA",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "TOTAL_RP_TS",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "KESESUAIAN",
            render: function ( data, type, row ) {

              if(data=='Y'){
                return '<a href="#" title="SESUAI" class="text-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>';
              }else{
                return '<a href="#" title="TIDAK SESUAI" class="text-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>';
              }

            },
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



    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/ts_p2tl/getDataTSP2TLIdpel.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() ).load();
    });

});
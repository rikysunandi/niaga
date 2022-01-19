$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table_ap = $('#tbl_rekap_kebutuhan').DataTable( {
        //responsive: true,
        "processing": true,
        "serverside": true,
        "ajax": {
            "url": '../controller/getRekapKebutuhanAP.php',
            "type": "POST",
            "timeout": 10000
        },
        columns: [
          {
            data: "UNITAP",
            readonly: true,
          },
          {
            data: "NAMA",
          },
          { data: 'METER_1_FASA_PRA', type: 'number', sClass : 'text-right' }, 
          { data: 'METER_3_FASA_PASCA', type: 'number', sClass : 'text-right' },
          { data: 'METER_1_FASA_PASCA', type: 'number', sClass : 'text-right' }, 
          { data: 'METER_3_FASA_PRA', type: 'number', sClass : 'text-right' },  
          { data: 'MCB_1_FASA_1A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_2A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_4A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_6A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_10A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_16A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_20A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_25A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_10A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_16A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_20A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_25A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_35A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_50A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_63A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_80A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_100A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_125A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_150A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_200A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_225A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_250A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_300A', type: 'number', sClass : 'text-right' }, 
          { data: 'SR_2_10', type: 'number', sClass : 'text-right' }, 
          { data: 'SL_4_16', type: 'number', sClass : 'text-right' }, 
          { data: 'TIC_3_70', type: 'number', sClass : 'text-right' }, 
          { data: 'FCO', type: 'number', sClass : 'text-right' }, 
          { data: 'ARRESTER', type: 'number', sClass : 'text-right' }, 
          { data: 'NYY_70', type: 'number', sClass : 'text-right' }, 
          { data: 'NYY_95', type: 'number', sClass : 'text-right' }, 
          { data: 'NYY_150', type: 'number', sClass : 'text-right' }, 
          { data: 'NYY_240', type: 'number', sClass : 'text-right' }, 
          { data: 'A3CS_150', type: 'number', sClass : 'text-right' }, 
          { data: 'PHBTR_2_JUR', type: 'number', sClass : 'text-right' }, 
          { data: 'PHBTR_4_JUR', type: 'number', sClass : 'text-right' }, 
          { data: 'TRAFO_100_kVA', type: 'number', sClass : 'text-right' }, 
          { data: 'TRAFO_160_kVA', type: 'number', sClass : 'text-right' }, 
          { data: 'TRAFO_250_kVA', type: 'number', sClass : 'text-right' }, 
          { data: 'ISOLATOR_TUMPU', type: 'number', sClass : 'text-right' }, 
          { data: 'ISOLATOR_ASPAN', type: 'number', sClass : 'text-right' }, 
          { data: 'T_BETON_9_200', type: 'number', sClass : 'text-right' }, 
          { data: 'T_BETON_12_200', type: 'number', sClass : 'text-right' }, 
          { data: 'T_BETON_12_350', type: 'number', sClass : 'text-right' },  
        ],
        //"deferRender": true,
        // lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        // pageLength: 25,
        dom:
        "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthChange: false,
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-file-o"></i>&nbsp;&nbsp;Copy', footer: true },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 420,
        "scrollX": true,
        "paging": false,
        // scrollCollapse: true,
        fixedColumns:   {
            leftColumns: 2
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
            $( api.column( j ).footer() ).html(pageTotal);
            j++;
          } 
        }
    });

    
    var table_up = $('#tbl_rekap_kebutuhan_up').DataTable( {
        //responsive: true,
        "processing": true,
        "serverside": true,
        "ajax": {
            "url": '../controller/getRekapKebutuhanUP.php',
            "type": "POST",
            "timeout": 10000
        },
        columns: [
          {
            data: "UNITAP",
            readonly: true,
          },
          {
            data: "UNITUP",
            readonly: true,
          },
          {
            data: "NAMA",
          },
          { data: 'METER_1_FASA_PRA', type: 'number', sClass : 'text-right' }, 
          { data: 'METER_3_FASA_PASCA', type: 'number', sClass : 'text-right' },
          { data: 'METER_1_FASA_PASCA', type: 'number', sClass : 'text-right' }, 
          { data: 'METER_3_FASA_PRA', type: 'number', sClass : 'text-right' },  
          { data: 'MCB_1_FASA_1A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_2A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_4A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_6A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_10A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_16A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_20A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_1_FASA_25A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_10A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_16A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_20A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_25A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_35A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_50A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_63A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_80A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_100A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_125A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_150A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_200A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_225A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_250A', type: 'number', sClass : 'text-right' }, 
          { data: 'MCB_3_FASA_300A', type: 'number', sClass : 'text-right' }, 
          { data: 'SR_2_10', type: 'number', sClass : 'text-right' }, 
          { data: 'SL_4_16', type: 'number', sClass : 'text-right' }, 
          { data: 'TIC_3_70', type: 'number', sClass : 'text-right' }, 
          { data: 'FCO', type: 'number', sClass : 'text-right' }, 
          { data: 'ARRESTER', type: 'number', sClass : 'text-right' }, 
          { data: 'NYY_70', type: 'number', sClass : 'text-right' }, 
          { data: 'NYY_95', type: 'number', sClass : 'text-right' }, 
          { data: 'NYY_150', type: 'number', sClass : 'text-right' }, 
          { data: 'NYY_240', type: 'number', sClass : 'text-right' }, 
          { data: 'A3CS_150', type: 'number', sClass : 'text-right' }, 
          { data: 'PHBTR_2_JUR', type: 'number', sClass : 'text-right' }, 
          { data: 'PHBTR_4_JUR', type: 'number', sClass : 'text-right' }, 
          { data: 'TRAFO_100_kVA', type: 'number', sClass : 'text-right' }, 
          { data: 'TRAFO_160_kVA', type: 'number', sClass : 'text-right' }, 
          { data: 'TRAFO_250_kVA', type: 'number', sClass : 'text-right' }, 
          { data: 'ISOLATOR_TUMPU', type: 'number', sClass : 'text-right' }, 
          { data: 'ISOLATOR_ASPAN', type: 'number', sClass : 'text-right' }, 
          { data: 'T_BETON_9_200', type: 'number', sClass : 'text-right' }, 
          { data: 'T_BETON_12_200', type: 'number', sClass : 'text-right' }, 
          { data: 'T_BETON_12_350', type: 'number', sClass : 'text-right' }, 
          
        ],
        //"deferRender": true,
        // lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        // pageLength: 25,
        dom:
        "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthChange: false,
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-file-o"></i>&nbsp;&nbsp;Copy', footer: true },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 420,
        "scrollX": true,
        "paging": false,
        // scrollCollapse: true,
        fixedColumns:   {
            leftColumns: 3
        },
        "order": [[ 0, 'asc' ],[1, 'asc']],
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
            $( api.column( j ).footer() ).html(pageTotal);
            j++;
          } 
        }
    });


    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table_ap.ajax.url( '../controller/getRekapKebutuhanAP.php?klasifikasi_rab='+$('#sel_klasifikasi_rab').val() ).load();
    });


    $('#btn_cari_up').click(function(btn){
        console.log('Klikk');
        table_up.ajax.url( '../controller/getRekapKebutuhanUP.php?klasifikasi_rab='+$('#sel_klasifikasi_rab_up').val() ).load();
    });

});
$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table_unit = $('#tbl_stok_material').DataTable( {
        //responsive: true,
        "processing": true,
        "serverside": true,
        "ajax": {
            "url": '../controller/getStokMaterialUnit.php',
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
          { data: 'MCB_1_FASA_1A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_2A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_4A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_6A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_10A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_16A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_20A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_25A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_35A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_50A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'METER_1_FASA_PRA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_1_FASA_PASCA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'SR_2_10', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_10A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_16A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_20A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_25A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_35A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_50A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'METER_3_FASA_PRA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_3_FASA_PASCA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_3_FASA_PASCA_STL', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'SL_4_16', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TIC_3_35', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TIC_3_70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_50_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_100_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_160_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_200_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_250_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_400_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_630_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_2JUR_OD', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_4JUR_OD', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_6JUR_ID', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X95', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ARRESTER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'FCO', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_TUMPU_POLYMER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_TUMPU_KERAMIK', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_ASPAN_POLYMER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_ASPAN_KERAMIK', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MVTIC_3X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'XLPE_3X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'XLPE_3X300', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_LBS', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_METER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_FUSE', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: "TGL_DATA", render: function ( data, type, row ) { return data.substring(0,10); } },
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

        "order": [[0, 'asc']],
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
            $( api.column( j ).footer() ).html($.fn.dataTable.render.number('.', ',', 0, '').display( pageTotal ));
            j++;
          } 
        }
    });

    
    
    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table_ap = $('#tbl_stok_material_ap').DataTable( {
        //responsive: true,
        "processing": true,
        "serverside": true,
        "ajax": {
            "url": '../controller/getStokMaterialAP.php',
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
          { data: 'MCB_1_FASA_1A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_2A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_4A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_6A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_10A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_16A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_20A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_25A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_35A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_50A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'METER_1_FASA_PRA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_1_FASA_PASCA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'SR_2_10', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_10A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_16A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_20A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_25A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_35A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_50A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'METER_3_FASA_PRA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_3_FASA_PASCA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_3_FASA_PASCA_STL', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'SL_4_16', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TIC_3_35', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TIC_3_70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_50_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_100_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_160_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_200_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_250_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_400_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_630_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_2JUR_OD', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_4JUR_OD', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_6JUR_ID', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X95', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ARRESTER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'FCO', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_TUMPU_POLYMER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_TUMPU_KERAMIK', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_ASPAN_POLYMER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_ASPAN_KERAMIK', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MVTIC_3X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'XLPE_3X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'XLPE_3X300', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_LBS', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_METER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_FUSE', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: "TGL_DATA", render: function ( data, type, row ) { return data.substring(0,10); } },
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
        "order": [[0, 'asc']],
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
            $( api.column( j ).footer() ).html($.fn.dataTable.render.number('.', ',', 0, '').display( pageTotal ));
            j++;
          } 
        }
    });


    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table_up = $('#tbl_stok_material_up').DataTable( {
        //responsive: true,
        "processing": true,
        "serverside": true,
        "ajax": {
            "url": '../controller/getStokMaterialUP.php',
            "type": "POST",
            "timeout": 10000
        },
        columns: [
          {
            data: "UNITAP",
            readonly: true,
            visible: false,
          },
          {
            data: "UNITUP",
            readonly: true,
          },
          {
            data: "NAMA",
          },
          { data: 'MCB_1_FASA_1A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_2A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_4A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_6A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_10A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_16A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_20A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_25A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_35A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_1_FASA_50A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'METER_1_FASA_PRA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_1_FASA_PASCA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'SR_2_10', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_10A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_16A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_20A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_25A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_35A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MCB_3_FASA_50A', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'METER_3_FASA_PRA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_3_FASA_PASCA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },
          { data: 'METER_3_FASA_PASCA_STL', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'SL_4_16', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TIC_3_35', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TIC_3_70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_50_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_100_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_160_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_200_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_250_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_400_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'TRAFO_630_kVA', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_2JUR_OD', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_4JUR_OD', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'LVSB_6JUR_ID', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X95', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'NYY_1X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ARRESTER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'FCO', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X70', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'A3CS_3X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_TUMPU_POLYMER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_TUMPU_KERAMIK', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_ASPAN_POLYMER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'ISOLATOR_ASPAN_KERAMIK', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'MVTIC_3X150', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'XLPE_3X240', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') }, 
          { data: 'XLPE_3X300', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_LBS', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_METER', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: 'KUBIKEL_FUSE', type: 'number', sClass : 'text-right', render: $.fn.dataTable.render.number(".", ",", 0, '') },  
          { data: "TGL_DATA", render: function ( data, type, row ) { return data.substring(0,10); } },
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
        "order": [[0, 'asc'],[1, 'asc']],
        // scrollCollapse: true,
        fixedColumns:   {
            leftColumns: 3
        },
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
            $( api.column( j ).footer() ).html($.fn.dataTable.render.number('.', ',', 0, '').display( pageTotal ));
            j++;
          } 
        }
    });


});
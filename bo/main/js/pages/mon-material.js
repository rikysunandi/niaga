$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_agenda').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/getMonitoringAgenda.php',
            "type": "POST",
            "timeout": 200000
        },
        columns: [
          {
            data: "NOAGENDA_INDIVIDU",
            readonly: true,
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
            data: "STATUS_PROSES",
            render: function ( data, type, row ) {
                    if(data == 'PROSES')
                        return '<span class="label label-pill label-success">'+data+'</span>';
                    else if(data == 'EVALUASI')
                        return '<span class="label label-pill label-warning">'+data+'</span>';
                    else if(data == 'NON RAB')
                        return '<span class="label label-pill label-dark">'+data+'</span>';
                },
          },
          {
            data: "NOAGENDA_KOLEKTIF",
            readonly: true,
            visible: false,
          },
          {
            data: "KET_TRANSAKSI",
            readonly: true,
          },
          {
            data: "ALASAN_KRITERIA_TMP",
            readonly: true,
          },
          {
            data: "TARIF_LAMA",
            readonly: true,
          },
          {
            data: "DAYA_LAMA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "TARIF_BARU",
            readonly: true,
          },
          {
            data: "DAYA_BARU",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
        ],
        dom:
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;&nbsp;Copy', footer: true },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        "order": [[0, 'asc']],
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        select: true,
    });


    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table_material = $('#tbl_mon_material_agenda').DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0, // here
        "ajax": {
            "url": '#',
            "type": "POST",
            "timeout": 200000
        },
        columns: [
          {
            data: "NOAGENDA_INDIVIDU",
            visible: false,
            readonly: true,
          },
          {
            data: "JENIS",
            readonly: true,
          },
          {
            data: "ID_KEBUTUHAN",
            type: 'hidden',
            visible: false,
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
            type: 'hidden',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
        ],
        dom:
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        select: 'single',
        altEditor: true,    
        buttons: [
          // { text: '<i class="fa fa-plus"></i>&nbsp;Tambah', name: 'add' },
          { extend: 'selected', text: '<i class="fa fa-edit"></i>&nbsp;Ubah', name: 'edit' },
          { extend: 'selected', text: '<i class="fa fa-trash"></i>&nbsp;Hapus', name: 'delete' },
            { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;Copy', footer: true },
        ],
        "scrollY": 280,
        "scrollX": true,
        "paging": false,
        "order": [[1, 'desc'],[2, 'asc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 6;
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
        },
        onAddRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be / with type='PUT'
                url: "../controller/simpanKebutuhanAgenda.php",
                type: 'GET',
                data: rowdata,
                success: success,
                error: error
            });
        },
        onDeleteRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be /{id} with type='DELETE'
                url: "../controller/hapusKebutuhanAgenda.php",
                type: 'GET',
                data: rowdata,
                success: success,
                error: error
            });
        },
        onEditRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be /{id} with type='POST'
                url: "../controller/simpanKebutuhanAgenda.php",
                type: 'GET',
                data: rowdata,
                success: function(data,b,c,d,e){ 
                    console.log(datatable); 
                    datatable._editRowCallback(data,b,c,d,e); 
                    $('#btn_noagenda_cari').trigger('click');
                  },
                error: error
            });
        }
    });

    $('#tbl_mon_agenda tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();

        table_material.ajax.url( '../controller/getMaterialAgenda.php?noagenda='+data.NOAGENDA_INDIVIDU ).load();
    } );

    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/getRekapMaterial.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() ).load();
    });

});
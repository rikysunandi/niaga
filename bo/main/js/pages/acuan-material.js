$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    $('#tbl_acuan_material').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/getAcuanMaterial.php',
            "type": "GET",
            "timeout": 10000
        },
        columns: [
          {
            data: "ID",
            title: "ID",
            readonly: true,
          },
          {
            data: "KATEGORI",
            title: "KATEGORI",
          },
          {
            data: "DAYA_BARU_FROM",
            title: "DAYA AWAL",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
         {
            data: "DAYA_BARU_TO",
            title: "DAYA AKHIR",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
         {
            data: "MATERIAL",
            title: "MATERIAL"
          },
          {
            data: "MDU",
            title: "MDU",
          },
         {
            data: "HARGA_SATUAN",
            title: "HARGA SATUAN",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, 'Rp. ')
          },
         {
            data: "VOLUME",
            title: "VOLUME",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
         {
            data: "HARGA_TOTAL",
            title: "TOTAL HARGA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, 'Rp. ')
        }],
        //"deferRender": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        dom:
        "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        select: 'single',
        //responsive: true,
        altEditor: true,     // Enable altEditor 
        buttons: [
            { text: '<i class="fa fa-plus"></i>&nbsp;Tambah', name: 'add' },
            { extend: 'selected', text: '<i class="fa fa-edit"></i>&nbsp;Ubah', name: 'edit' },
            { extend: 'selected', text: '<i class="fa fa-trash"></i>&nbsp;Hapus', name: 'delete' },
            { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;Copy', footer: true },
        ],
        "scrollY": 500,
        "scrollX": true,
        onAddRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be / with type='PUT'
                url: "../controller/simpanAcuanMaterial.php",
                type: 'GET',
                data: rowdata,
                success: success,
                error: error
            });
        },
        onDeleteRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be /{id} with type='DELETE'
                url: "../controller/hapusAcuanMaterial.php",
                type: 'GET',
                data: rowdata,
                success: success,
                error: error
            });
        },
        onEditRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be /{id} with type='POST'
                url: "../controller/simpanAcuanMaterial.php",
                type: 'GET',
                data: rowdata,
                success: success,
                error: error
            });
        }
    });

});
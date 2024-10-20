$(document).ready(function () {

    "use strict";


    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        // startDate: moment(),
        // endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_upload_pemeriksaan_lpb').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/pemeriksaan_lpb/getUploadPemeriksaanLPB.php',
            "type": "POST",
            "timeout": 360000
        },
        deferRender: true,
        deferLoading: 25,
        columns: [
          {
            data: "UNITUPI",
            visible: false,
          },
          {
            data: "UNITAP",
          },
          {
            data: "TGL_PROSES",
            render: function ( data, type, row ) {
                return data.substring(0,16);
            },
          },
          {
            data: "FILENAME",
          },
          {
            data: "JML_DATA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_FOTO",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_BARU",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_DOUBLE",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_ULANG",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "KETERANGAN",
          },
          {
            data: "FILEPATH",
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        lengthChange: true,
        buttons: [
            //{ extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;&nbsp;Copy', footer: true },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true, },
            // {
            //   text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel (All Rows)',
            //   action: function ( e, dt, node, config ) {
            //       dt.ajax.reload();
            //   }
            // },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        pageLength: 25,
        "order": [[2, 'desc'],],
    });


    // $('#tbl_mon_upload_pemeriksaan_lpb').on('click', 'td a.foto', function (e) {
    //     e.preventDefault();    
    //     var foto = $(this).data('foto');
    //     $('#img_foto').attr('src', foto);
    //     $("#modal_foto").modal('show');
    //   });

    $('#btn_cari').click(function(btn){
        console.log('START DATE', $('#tgl_proses_range').data('daterangepicker').startDate.format('YYYY-MM-DD'));
        console.log('END DATE', $('#tgl_proses_range').data('daterangepicker').endDate.format('YYYY-MM-DD'));
        table.ajax.url( '../controller/pemeriksaan_lpb/getUploadPemeriksaanLPB.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&tgl_proses_from='+$('#tgl_proses_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_proses_to='+$('#tgl_proses_range').data('daterangepicker').endDate.format('YYYY-MM-DD') ).load();
    });

});
$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_usulan_skai').DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        "ajax": {
            "url": '../controller/getDataRABPerluasan.php',
            "type": "POST",
            "timeout": 60000
        },
        //responsive: true,
        columns: [
          {
            data: "JENISLAP",
            visible: false
          },
          {
            data: "NOAGENDA_KOLEKTIF",
            visible: false
          },
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
            data: "KET_TRANSAKSI",
          },
          {
            data: "TARIF_LAMA",
          },
          {
            data: "DAYA_LAMA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "TARIF_BARU",
          },
          {
            data: "DAYA_BARU",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_BP",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "RP_RAB",
            type: 'number',
            "sClass" : "text-right" , 
            render: function ( data, type, row ) {

                  if(row.STATUS_PROSES != 'NON RAB')
                    return $.fn.dataTable.render.number('.', ',', 0, '').display( data );
                  else return null;

                },
          },
          {
            data: "STATUS_PROSES",
            render: function ( data, type, row ) {
                    if(data == 'PROSES')
                        return '<span class="label label-success">'+data+'</span>';
                    else if(data == 'EVALUASI')
                        return '<span class="label label-warning">'+data+'</span>';
                    else if(data == 'NON RAB')
                        return '<span class="label label-dark">'+data+'</span>';
                },
          },
          {
            data: "ALASAN_KRITERIA_TMP",
          },
          {
            data: "KETERANGAN_ALASAN_KRITERIA_TMP",
            visible: false
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
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        buttons: [
           // { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;&nbsp;Copy', footer: true },
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
        table.ajax.url( '../controller/getDataRABPerluasan.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&status_pengisian='+$('#sel_status_pengisian').val()+'&jenislap='+$('#sel_jenislap').val() ).load();
    });

});
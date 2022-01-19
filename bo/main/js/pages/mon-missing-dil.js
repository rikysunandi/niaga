$(document).ready(function () {

    "use strict";


    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: moment().subtract(1, 'months').format('DD/MM/YYYY'),
        endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_pemeriksaan_lpb_missing_dil').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/pemeriksaan_lpb/getDataMissingDIL.php',
            "type": "POST",
            "timeout": 360000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          {
            data: "IDPEL",
          },
          {
            data: "TGL_PEMERIKSAAN",
            render: function ( data, type, row ) {
                    return data.substring(0,10);
                },
          },
          {
            data: "LATITUDE",
          },
          {
            data: "LONGITUDE",
          },
          {
            data: "AKURASI_KOORDINAT",
          },
          {
            data: "USER_INPUT",
          },
          {
            data: "FOTOPATH",
            sortable: false,
            render: function ( data, type, row ) {
                  //console.log(data);
                  //532710010845_2020-09-01.jpg
                  if(!data && data == null)
                    return '<a href="#" class="btn btn-sm btn-primary disabled" title="TIDAK ADA FOTO"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
                  else
                    return '<a href="#" class="btn btn-sm btn-primary foto" title="FOTO" data-foto="'+data+'"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
              },
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
        "order": [[1, 'desc'],],
    });

    $('#tbl_mon_pemeriksaan_lpb_missing_dil').on('click', 'td a.foto', function (e) {
        e.preventDefault();    
        $('#img_foto').attr('src', '#');
        var foto = $(this).data('foto');
        $('#img_foto').attr('src', foto);

        $('.foto-wrapper').zoom({
            url: foto,
            magnify: 2
        });
        $("#modal_foto").modal('show');
      });


    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/pemeriksaan_lpb/getDataMissingDIL.php?tgl_pemeriksaan_from='+$('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_pemeriksaan_to='+$('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD') ).load();
    });

});
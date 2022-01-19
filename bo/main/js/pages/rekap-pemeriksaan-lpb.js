$(document).ready(function () {

    "use strict";



    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: moment().clone().startOf('month').format('DD/MM/YYYY'),
        endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_pemeriksaan_lpb').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/pemeriksaan_lpb/getRekapPemeriksaanLPB.php',
            "type": "POST",
            "timeout": 180000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          {
            data: "UNITUPI",
            visible: false,
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "UNITAP",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "UP3",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "UNITUP",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "ULP",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "TGL_UPLOAD",
            render: function ( data, type, row ) {
                    return data.substring(0,10);
                },
          },
          {
            data: "JML_PEMERIKSAAN",
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
        // lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        // pageLength: 25,
        "order": [[3,'desc'], [4,'desc']],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 5;
          while(j < nb_cols){
            var pageTotal = api
                  .column( j, { page: 'current'} )
                  .data()
                  .reduce( function (a, b) {
                      return Number(a) + Number(b);
                  }, 0 );
            // Update footer
            $( api.column( j ).footer() ).html( $.fn.dataTable.render.number(',', '.', 0, '').display( pageTotal ));
            j++;
          } 
      }
    });



    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/pemeriksaan_lpb/getRekapPemeriksaanLPB.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_upload_from='+$('#tgl_upload_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_upload_to='+$('#tgl_upload_range').data('daterangepicker').endDate.format('YYYY-MM-DD') ).load();
    });

});
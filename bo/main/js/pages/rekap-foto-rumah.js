$(document).ready(function () {

    "use strict";


    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: '15/03/2022',
        endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_foto_rumah')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!');
        $('div.content-body').unblock();
      }).DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/pemeriksaan_lpb/getFotoRumah.php',
            "type": "POST",
            "timeout": 180000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          {
            data: "UNITUPI",
          },
          {
            data: "UNITAP",
          },
          {
            data: "UNITUP",
          },
          {
            data: "ULP",
          },
          {
            data: "KODEPETUGAS",
          },
          {
            data: "RPP",
          },
          {
            data: "JML_PLG",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_PLG_SDH",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_FOTO_RUMAH",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "JML_PLG_BLM",
            type: 'number', 
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "PROGRESS",
            type: 'number', 
            "sClass" : "text-right" , 
            render: function ( data, type, row ) {
                var cls;
                //console.log($(this));
                if (data < 50) {
                    cls='danger';
                  }else if (data < 80) {
                    cls='warning';
                  }else {
                    cls='success';
                  }
              return '<span class="text-'+cls+'">'+
                $.fn.dataTable.render.number(".", ",", 2, '').display(data)+'%</span>';

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
        "paging": false,
        // lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        // pageLength: 25,
        "order": [1,2,4,5],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var j = 6;
          while(j < nb_cols){
            console.log('j', j);
            console.log('nb_cols', nb_cols);
            
            if(j==nb_cols-1){

              var totalPlg = api
                  .column( j-4, { page: 'current'} )
                  .data()
                  .reduce( function (a, b) {
                      return Number(a) + Number(b);
                  }, 0 );

              var totalPlgSdh = api
                  .column( j-2, { page: 'current'} )
                  .data()
                  .reduce( function (a, b) {
                      return Number(a) + Number(b);
                  }, 0 );

              var progress = (totalPlgSdh/totalPlg)*100;
              var cls;

                if (progress < 50) {
                    cls='danger';
                  }else if (progress < 80) {
                    cls='warning';
                  }else {
                    cls='success';
                  }

                $( api.column( j ).footer() ).html('<span class="text-'+cls+'">'+$.fn.dataTable.render.number(".", ",", 2, '').display(progress)+'%</span>');

              //$( api.column( j ).footer() ).html( $.fn.dataTable.render.number(',', '.', 2, '').display( progress ));
            
            }else{

              var pageTotal = api
                    .column( j, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return Number(a) + Number(b);
                    }, 0 );

              $( api.column( j ).footer() ).html( $.fn.dataTable.render.number(',', '.', 0, '').display( pageTotal ));
            
            } 

            j++;
          } 
      }
    });



    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        table.ajax.url( '../controller/pemeriksaan_lpb/getFotoRumah.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_pemeriksaan_from='+$('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_pemeriksaan_to='+$('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')  ).load();
    });

});
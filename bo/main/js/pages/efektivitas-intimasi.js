$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
   
    var unitupi, unitap, unitup, blth, tgl_intimasi_from, tgl_intimasi_to;
    var chart_intimasi_ulp ;


    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: moment().startOf('month').format('DD/MM/YYYY'), //.subtract(1, 'months').format('DD/MM/YYYY'),
        endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_efektivitas_petugas')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!', data);
        $('div.content-body').unblock();

      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        "ajax": {
            "url": '#',
            "type": "POST",
            "timeout": 60000
        },
        //responsive: true,
        columns: [
          {
            data: "BLTH",
            visible: false
          },
          {
            data: "UNITUPI",
            visible: false
          },
          {
            data: "UNITAP",
            visible: false
          },
          {
            data: "UNITUP",
            visible: false
          },
          {
            data: "KODEPETUGAS",
            visible: true
          },
          {
            data: "TGL_INTIMASI",
            visible: true
          },
          {
            data: "JAM_CLOCKIN",
            visible: true
          },
          {
            data: "SUHU",
            visible: true
          },
          {
            data: "MASKER",
            visible: true
          },
          {
            data: "SARUNG_TANGAN",
            visible: true
          },
          {
            data: "JAM_MULAI",
            visible: true
          },
          {
            data: "JAM_SELESAI",
            visible: true
          },
          {
            data: "DURASI",
            // type: 'number',
            visible: true,
            "sClass" : "text-right" , 
            //render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_INTIMASI",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , 
            //render: $.fn.dataTable.render.number(".", ",", 0, '')

            render: function ( data, type, row ) {
                var cls;
                //console.log('row', row);
                var efektivitas = data;
                //window.open("urut-langkah-rpp.php?unitupi="+unitupi+"&unitap="+unitap+"&unitup="+unitup+"&petugas="+petugas_dipilih+"&rpp="+rpp, "_blank");
                return '<a class="text-primary" href="mon-intimasi.php?unitupi='+row.UNITUPI+'&unitap='+row.UNITAP+'&unitup='+row.UNITUP+'&petugas='+row.KODEPETUGAS+'&keterangan=NOT_LUNAS_BY_SYSTEM'+'&blth='+row.BLTH+'&tgl_intimasi_from='+row.TGL_INTIMASI+'&tgl_intimasi_to='+row.TGL_INTIMASI+'" target="_blank" role="button">'+$.fn.dataTable.render.number(".", ",", 0, '').display(data)+'</a>';
                //return rpp;
            },
          },
          {
            data: "RATIO",
            //type: 'number',
            visible: true,
            "sClass" : "text-right" , 
            render: function ( data, type, row ) {
                var cls;
                //console.log($(this));
                var mnt = data;
                mnt = mnt.replace(' MENIT/PLG','');
                if (mnt > 30) {
                    cls='danger';
                  }else if (mnt > 15 || mnt < 5) {
                    cls='warning';
                  }else {
                    cls='success';
                  }
              return '<span class="text-'+cls+'">'+data+'</span>';

            },
          },
          // {
          //   data: "PERSEN",
          //   visible: true,
          //   "sClass" : "text-right" , 
          //   render: function ( data, type, row ) {
          //       var cls;
          //       //console.log($(this));
          //       if (data < 50) {
          //           cls='danger';
          //         }else if (data < 80) {
          //           cls='warning';
          //         }else {
          //           cls='success';
          //         }
          //     return '<span class="text-'+cls+'">'+
          //       $.fn.dataTable.render.number(".", ",", 2, '').display(data)+'%</span>';

          //   },
          // },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            { extend: 'colvis', text: 'Columns' },
            { extend: 'csvHtml5', 
              text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', 
              titleAttr: 'Download ke CSV',
              footer: true
            },
            { 
                extend: 'excelHtml5', 
                text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', 
                titleAttr: 'Download ke Excel',
                title: null,
                exportOptions: {
                  columns: ':visible',
                  format: {
                      body: function(data, row, column, node) {
                        data = $('<p>' + data + '</p>').text();
                        return $.isNumeric(data.replace('.', '')) ? data.replace('.', '') : data;
                      }
                  }
                },
                filename: function(){
                    return 'REKAP_INTIMASI_PETUGAS_' +  moment().format('YYYYMMDDHHmmss');
                },
                footer: false
            },
        ],
        "scrollY": 360,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[1, 'asc'],[2, 'asc']],
        // footerCallback: function ( row, data, start, end, display ) {
        //   var api = this.api();
        //   //console.log('footerCallback', api);
        //   var nb_cols = api.columns().nodes().length;
        //   var persen, cls, wo, jml, lunas, l_irisan, l_baru;
        //   var j = 3;
        //   while(j < nb_cols){
        //     if(j==11){
        //         persen = (jml/wo)*100;

        //         if (persen < 50) {
        //             cls='danger';
        //           }else if (persen < 80) {
        //             cls='warning';
        //           }else {
        //             cls='success';
        //           }

        //         $( api.column( j ).footer() ).html('<span class="text-'+cls+'">'+$.fn.dataTable.render.number(".", ",", 2, '').display(persen)+'%</span>');

        //       //$( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 2, '').display(persen)+'%');
        //     }
        //     else if(j==17){
        //         persen = ((l_irisan+l_baru)/wo)*100;

        //         if (persen < 50) {
        //             cls='danger';
        //           }else if (persen < 80) {
        //             cls='warning';
        //           }else {
        //             cls='success';
        //           }

        //         $( api.column( j ).footer() ).html('<span class="text-'+cls+'">'+$.fn.dataTable.render.number(".", ",", 2, '').display(persen)+'%</span>');

        //       //$( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 2, '').display(((l_irisan+l_baru)/wo)*100)+'%');
        //     }else{
        //       var pageTotal = api
        //             .column( j, { page: 'current'} )
        //             .data()
        //             .reduce( function (a, b) {
        //                 return Number(a) + Number(b);
        //             }, 0 );

        //       if(j==6)
        //         wo=pageTotal;
        //       if(j==10)
        //         jml=pageTotal;
        //       if(j==12)
        //         l_irisan=pageTotal;
        //       if(j==13)
        //         l_baru=pageTotal;
        //       if(j==16)
        //         lunas=pageTotal;
        //       // Update footer
        //       $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
        //     }

        //     j++;
        //   } 
        // }
    });


    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        console.log('Klikk');
        unitupi = $('#sel_unitupi').val();
        unitap = $('#sel_unitap').val();
        unitup = $('#sel_unitup').val();
        blth = $('#sel_blth').val();
        tgl_intimasi_from = $('#tgl_intimasi_range')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
        tgl_intimasi_to = $('#tgl_intimasi_range')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
        table.ajax.url( '../controller/intimasi/getEfektivitasPetugas.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&blth='+blth+'&tgl_intimasi_from='+tgl_intimasi_from+'&tgl_intimasi_to='+tgl_intimasi_to ).load();
    });




});
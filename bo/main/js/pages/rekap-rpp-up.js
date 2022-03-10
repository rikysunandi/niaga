$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
   
    var unitupi, unitap, unitup, petugas;


    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_rpp_up')
      .on('preXhr.dt', function ( e, settings, data ) {
        // console.log('preXhr!', $(this).DataTable().clear());
        // console.log('preXhr! data', data);
        //$(this).clear();
        $(this).DataTable().clear();
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
            data: "UNITAP",
            visible: true
          },
          {
            data: "UNITUP",
            visible: true
          },
          {
            data: "ULP",
            visible: true
          },
          {
            data: "JML_PLG",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_TAGGING",
            type: 'number',
            visible: true,
            "sClass" : "text-right", render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          // {
          //   data: "JML_PETUGAS_DIL",
          //   type: 'number',
          //   visible: true,
          //   "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          // },
          {
            data: "JML_PETUGAS",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_RPP",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_PLG_RPP",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_URUT_RPP",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "PERSEN",
            ariaTitle: "PERSEN",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , 
            render: function ( data, type, row ) {
                var cls;
                //console.log(data);
                if(data=== ""){
                  return data;
                }else{
                  if (data < 50) {
                      cls='danger';
                    }else if (data < 80) {
                      cls='warning';
                    }else {
                      cls='success';
                    }
                  return '<span class="text-'+cls+'">'+
                    $.fn.dataTable.render.number(".", ",", 2, '').display(data)+'%</span>';
                }

            },
          },
          // {
          //   data: "JML_RPP",
          //   visible: true,
          //   render: function ( data, type, row ) {
          //       var cls;
          //       //console.log('row', row);
          //       var rpp = data;
          //       //window.open("urut-langkah-rpp.php?unitupi="+unitupi+"&unitap="+unitap+"&unitup="+unitup+"&petugas="+petugas_dipilih+"&rpp="+rpp, "_blank");
          //       return '<a class="btn btn-primary btn-sm" href="urut-langkah-rpp.php?unitupi=53&unitap='+row.UNITAP+'&unitup='+row.UNITUP+'&petugas='+row.PETUGAS+'&rpp='+rpp+'" target="_blank" role="button">'+rpp+'</a>';
          //       //return rpp;
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
                    return 'REKAP_RPP_UP_' +  moment().format('YYYYMMDDHHmmss');
                },
                footer: false
            },
        ],
        //"scrollY": 300,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[0, 'asc'],[1, 'asc']],
        
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var persen, cls, wo, jml, lunas, l_irisan, l_baru;
          var j = 3;
          
          while(j < nb_cols){
            if(j==nb_cols-1){

                var persen;
                persen = ((jml/wo))*100;
                var cls;

                if (persen < 50) {
                    cls='danger';
                  }else if (persen < 80) {
                    cls='warning';
                  }else {
                    cls='success';
                  }

                $( api.column( j ).footer() ).html('<span class="text-'+cls+'">'+$.fn.dataTable.render.number(".", ",", 2, '').display(persen)+'%</span>');
            }else{
                var pageTotal = api
                    .column( j, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return Number(a) + Number(b);
                    }, 0 );

                if(j==4)
                wo=pageTotal;
                if(j==7)
                jml=pageTotal;
                // Update footer
                $( api.column( j ).footer() ).html($.fn.dataTable.render.number(".", ",", 0, '').display(pageTotal));
            }

            j++;
          } 


        }
    });


    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        console.log('Klikk');
        unitupi = $('#sel_unitupi').val();
        unitap = $('#sel_unitap').val();
        unitup = $('#sel_unitup').val();
        table.ajax.url( '../controller/pemeriksaan_lpb/getRekapRPPUP.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup ).load();
    });




});
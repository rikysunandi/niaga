$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
   
    var unitupi, unitap, unitup, petugas;


    $('#sel_unitup').change(function(){

        if($('#sel_unitup').val()!=null){
            $('#sel_petugas').empty();
            $.getJSON('../controller/referensi/getPetugasFinal.php?unitup='+$('#sel_unitup').val(), function(data){
              
                $.each(data.rows,function(i,v){
                  $('#sel_petugas').append('<option value="'+v.kode+'">'+v.nama+'</option>');
                });
            
                if($('#sel_petugas').data('inc-semua')!='T')
                  $('#sel_petugas').append('<option value="00">SEMUA PETUGAS</option>');

                $('#sel_petugas').selectpicker('refresh');

                if(urlParams.has('petugas')){
                    $('#sel_petugas').selectpicker('val', urlParams.get('petugas'));
                }
                // else{
                //     $('#sel_petugas').selectpicker('val', "00");
                //     console.log('semua petugas');
                // }

              //$('#sel_rbm').selectpicker('refresh');
            });
        }
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rekap_rpp')
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
            data: "PETUGAS",
            visible: true
          },
          {
            data: "RPP",
            visible: true,
            render: function ( data, type, row ) {
                var cls;
                //console.log('row', row);
                var rpp = data;
                //window.open("urut-langkah-rpp.php?unitupi="+unitupi+"&unitap="+unitap+"&unitup="+unitup+"&petugas="+petugas_dipilih+"&rpp="+rpp, "_blank");
                return '<a class="btn btn-primary btn-sm" href="urut-langkah-rpp-final.php?unitupi=53&unitap='+row.UNITAP+'&unitup='+row.UNITUP+'&petugas='+row.PETUGAS+'&rpp='+rpp+'" target="_blank" role="button">'+rpp+'</a>';
                //return rpp;
            },
            
          },
          {
            data: "JML",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_URUT",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "JML_UPDATE",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
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
                    return 'REKAP_RPP_' +  moment().format('YYYYMMDDHHmmss');
                },
                footer: false
            },
        ],
        //"scrollY": 300,
        "scrollX": true,
        "paging": false,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[3, 'asc'],[4, 'asc']],
        
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api();
          //console.log('footerCallback', api);
          var nb_cols = api.columns().nodes().length;
          var persen, cls, wo, jml, lunas, l_irisan, l_baru;
          var j = 5;
          
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

        }
    });


    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        console.log('Klikk');
        unitupi = $('#sel_unitupi').val();
        unitap = $('#sel_unitap').val();
        unitup = $('#sel_unitup').val();
        petugas = $('#sel_petugas').val();
        table.ajax.url( '../controller/pemeriksaan_lpb/getRekapRPPFinal.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&petugas='+petugas ).load();
    });




});
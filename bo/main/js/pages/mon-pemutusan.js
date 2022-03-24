$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var unitupi, unitap, unitup, petugas, blth, tgl_pemutusan_from, tgl_pemutusan_to;

    if(urlParams.has('tgl_pemutusan_from')){
      tgl_pemutusan_from = moment(urlParams.get('tgl_pemutusan_from')).format('DD/MM/YYYY');
    }else{
      tgl_pemutusan_from = '21/'+moment().format('MM/YYYY');
    }

    if(urlParams.has('tgl_pemutusan_to')){
      tgl_pemutusan_to = moment(urlParams.get('tgl_pemutusan_to')).format('DD/MM/YYYY');
    }else{
      tgl_pemutusan_to = moment();
    }

    if(urlParams.has('blth')){
      $('#sel_blth').val(urlParams.get('blth'));
    }

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: tgl_pemutusan_from,
        endDate: tgl_pemutusan_to,
        locale: {
          format: 'DD/MM/YYYY'
        }
    });

    $('#sel_unitup').change(function(){

      $('#sel_petugas').empty();
      $.getJSON('../controller/referensi/getPetugas.php?unitup='+$('#sel_unitup').val(), function(data){
          
          $.each(data.rows,function(i,v){
              $('#sel_petugas').append('<option value="'+v.kode+'">'+v.nama+'</option>');
          });
          $('#sel_petugas').append('<option value="00">SEMUA PETUGAS</option>');
          $('#sel_petugas').selectpicker('refresh');

          if(urlParams.has('petugas')){
            $('#sel_petugas').selectpicker('val', urlParams.get('petugas'));
            console.log('petugas', urlParams.get('petugas'));

            setTimeout(function(){ $('#btn_cari').trigger('click'); }, 500);
          }
          else{
            $('#sel_petugas').selectpicker('val', "00");
            console.log('semua petugas');
          }

          //$('#sel_rbm').selectpicker('refresh');
        });
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_pemutusan')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!');
        $('div.content-body').unblock();
      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        "ajax": {
            "url": '../controller/pemutusan/getDataPemutusan.php',
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
            data: "IDPEL",
            visible: true
          },
          {
            data: "TGL_PUTUS",
            visible: true,
            render: $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss.SSS', 'YYYY-MM-DD HH:mm' )
          },
          {
            data: "KET",
            visible: true
          },
          {
            data: "NOHP",
            visible: true
          },
          {
            data: "LATITUDE",
            visible: true
          },
          {
            data: "LONGITUDE",
            visible: true
          },
          {
            data: "USER_APP",
            visible: true
          },
          {
            data: "FOTOPATH",
            visible: true,
            sortable: false,
            render: function ( data, type, row ) {
                  //console.log(data);
                  //532710010845_2020-09-01.jpg
                  if(!data && data == null)
                    return '<a href="#" class="btn btn-sm btn-primary disabled" title="TIDAK ADA FOTO"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
                  else
                    return '<a href="#" class="btn btn-sm btn-primary foto" title="FOTO" data-foto="'+data+'" data-row="'+encodeURIComponent(JSON.stringify(row))+'"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
              },
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            { extend: 'colvis', text: 'Columns' },
            { extend: 'excelHtml5', 
              text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Download CSV', 
              titleAttr: 'Download ke CSV',
              footer: true,
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open('../controller/pemutusan/expCSVpemutusan.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&petugas='+petugas+'&blth='+blth+'&tgl_pemutusan_from='+tgl_pemutusan_from+'&tgl_pemutusan_to='+tgl_pemutusan_to );
              }
            },
            {
              text: '<i class="fa fa-map"></i>&nbsp;&nbsp;Peta', 
              titleAttr: 'Tampilkan Peta',
              footer: true,
              action: function ( e, dt, node, config ) {

                  var rows = dt.rows().data();
                  console.log('node', node);


                    // var markers = [];
                    // $.each(rows, function(k,v){
                    //   markers.push({
                    //     position:[parseFloat(v.LATITUDE), parseFloat(v.LONGITUDE)],
                    //     title: v.IDPEL,
                    //     icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+(k+1)+'|FF0000|000000'
                    //   });
                    // });

                    // $('#map')
                    //   .gmap3({
                    //     center:[-6.3487933, 107.6809901],
                    //     zoom:4
                    //   })
                    //   .marker(markers)
                    //   .on('click', function (marker) {
                    //     marker.setIcon('https://maps.google.com/mapfiles/marker_green.png');
                    //   })
                    //   .then(function (infowindow) {
                    //     var map = this.get(0);
                    //     var marker = this.get(1);
                    //     marker.addListener('click', function() {
                    //       infowindow.open(map, marker);
                    //     });
                    //   })
                    //   .wait(2000)
                    //   .fit();
                    

                    function initMap() {
                      const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 8,
                        center: { lat: -6.3487933, lng: 107.6809901 },
                      });

                        
                      var infowindow = new google.maps.InfoWindow();
                      var marker = new google.maps.Marker();
                      var bounds = new google.maps.LatLngBounds();

                      const markers = rows.map((tagging, i) => {

                        if(tagging.LATITUDE && tagging.LONGITUDE){

                          marker = new google.maps.Marker({
                            position: {
                                        lat: parseFloat(tagging.LATITUDE), 
                                        lng: parseFloat(tagging.LONGITUDE)
                                      },
                            title: tagging.IDPEL+' | '+tagging.TGL_PUTUS+' | '+tagging.USER_APP,
                            icon:'../controller/getMarkerIcon.php?color=red&text='+(i+1),
                            map: map
                          });

                          bounds.extend(new google.maps.LatLng(
                            parseFloat(tagging.LATITUDE), 
                            parseFloat(tagging.LONGITUDE))
                          );

                          google.maps.event.addListener(marker, 'click', (function (marker, i) {
                              return function () {
                                  infowindow.setContent(
                                    ` <div class="row">
                                        <div class="col-6">
                                          <dl>
                                            <dt>Idpel</dt>
                                            <dd>`+tagging.IDPEL+`</dd>
                                            <dt>Keterangan</dt>
                                            <dd>`+tagging.KET+`</dd>
                                            <dt>Tgl pemutusan</dt>
                                            <dd>`+tagging.TGL_PUTUS+`</dd>
                                            <dt>Petugas</dt>
                                            <dd>`+tagging.USER_APP+`</dd>
                                            <dt>Koordinat</dt>
                                            <dd>`+tagging.LATITUDE+`, `+tagging.LONGITUDE+`</dd>
                                          </dl>
                                        </div>
                                        <div class="col-6">
                                          <img id="map_foto" src="`+tagging.FOTOPATH+`" width="150px" height="220px"/></dd>
                                        </div>
                                      </div>
                                    `
                                    );
                                  infowindow.open(map, marker);

                              }
                          })(marker, i)); 

                          return marker;
                        }

                      });

                      map.fitBounds(bounds);

                    }

                    initMap();
                      
                    var mapTag = $("div#map");
                    $('html,body').animate({scrollTop: mapTag.offset().top},'slow');
              }
            },
        ],
        "scrollY": 370,
        "scrollX": true,
        "paging": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 100,
        "order": [[3, 'asc']],
    });

    $('#tbl_mon_pemutusan').on('click', 'td a.foto', function (e) {
        e.preventDefault();    
        var row = (JSON.parse(decodeURIComponent($(this).data('row'))));
        var foto = $(this).data('foto');
        $('#img_foto').attr('src', foto+'?time='+$.now());
        $('#idpel').html(row.IDPEL);
        $('#tgl_pemutusan').html(row.TGL_PUTUS.substr(0,16));
        $('#ket').html(row.KET);
        $('#user_app').html(row.USER_APP);
        $("#modal_foto").modal('show');

        var $image = $('#img_foto');

        $image.viewer({
          //inline: true,
          viewed: function() {
            $image.viewer('zoomTo', 1);
          }
        });

        // Get the Viewer.js instance after initialized
        //var viewer = $image.data('viewer');

      });

    $( 'body' ).on( 'click', '#btn_cari', function(btn) {
        unitupi = $('#sel_unitupi').val();
        unitap = $('#sel_unitap').val();
        unitup = $('#sel_unitup').val();
        petugas = $('#sel_petugas').val();
        blth = $('#sel_blth').val();
        tgl_pemutusan_from = $('#tgl_pemutusan_range')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
        tgl_pemutusan_to = $('#tgl_pemutusan_range')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');


        table.clear().draw();
        var container = $('#map').parent();
        $('#map').remove();
        container.append('<div id="map"></div>');

        table.ajax.url( '../controller/pemutusan/getDataPemutusan.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup+'&petugas='+petugas+'&blth='+blth+'&tgl_pemutusan_from='+tgl_pemutusan_from+'&tgl_pemutusan_to='+tgl_pemutusan_to ).load();
        //table.ajax.url( '../controller/pemutusan/getDatapemutusan.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&blth='+$('#sel_blth').val() ).load();
    });


});
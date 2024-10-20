$(document).ready(function () {

    "use strict";

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_plg_subsidi')
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
        "ajax": {
            "url": '../controller/pemeriksaan_lpb/getBlmPemeriksaanLPB.php',
            "type": "POST",
            "timeout": 360000
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
            data: "IDPEL",
          },
          {
            data: "NAMA",
          },
          {
            data: "TARIF",
            visible: false
          },
          {
            data: "DAYA",
            type: 'number',
            visible: false,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          {
            data: "KOGOL",
            visible: false
          },
          {
            data: "KDDK",
          },
          {
            data: "ALAMAT",
          },
          {
            data: "NAMA_GARDU",
          },
          {
            data: "NOMOR_JURUSAN_TIANG",
          },
          {
            data: "KOORDINAT_X",
          },
          {
            data: "KOORDINAT_Y",
          },
          {
            data: "NOMOR_METER_KWH",
          },
          {
            data: "TELEPON",
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [[25, 50, 100], [25, 50, 100]],
        lengthChange: true,
        buttons: [
            //{ extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;&nbsp;Copy', footer: true },
            
            { 
              text: '<span><i class="fa fa-arrow-circle-o-down"></i>&nbsp;&nbsp;DIL Priangan</span>',
              titleAttr: 'Download semua pelanggan ke dalam Format DIL Priangan',
              //"sTooltip": "My CSV button's tooltip",
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open("../controller/pemeriksaan_lpb/expCSVPlgSubsidi.php?unitup="+$('#sel_unitup').val() );
              }

            },
            // { 
            //   text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', 
            //   titleAttr: 'Download semua pelanggan',
            //   //"sTooltip": "My CSV button's tooltip",
            //   action: function ( e, dt, node, config ) {
            //       // alert( 'Download!' );
            //       // //this.disable(); // disable button
            //       // console.log('dt', dt);
            //       // console.log('node', node);
            //       window.open("../controller/pemeriksaan_lpb/expCSVBlmPemeriksaanLPBAll.php?unitup="+$('#sel_unitup').val()+'&koordinat='+$('#sel_koordinat').val()+'&tagging='+$('#sel_tagging').val() );
            //   }

            // },
            { 
              text: '<span><i class="fa fa-map-o"></i>&nbsp;&nbsp;Peta</span>',
              titleAttr: 'Tampilkan Peta',
              action: function ( e, dt, node, config ) {

                  var unitupi = $('#sel_unitupi').val();
                  var unitap = $('#sel_unitap').val();
                  var unitup = $('#sel_unitup').val();
                  var koordinat = $('#sel_koordinat').val();

                  $('div.content-body').block({ message: 'Mengambil data...' });
                  
                  $.ajax({
                    url: "../controller/pemeriksaan_lpb/getKoordinatBlmPemeriksaan.php",
                    method: "GET",
                    data: { 
                      unitupi : unitupi,
                      unitap : unitap,
                      unitup : unitup,
                      koordinat : koordinat,
                    },
                  }).done(function(data) {
                    var data  = $.parseJSON(data);
                    // console.log( "success", data );

                    var container = $('#map').parent();
                    $('#map').remove();
                    container.append('<div id="map"></div>');

                    

                    function initMap() {
                      const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 8,
                        center: { lat: -6.3487933, lng: 107.6809901 },
                      });

                        
                      var infowindow = new google.maps.InfoWindow();
                      var marker = new google.maps.Marker();

                      const markers = data.rows.map((tagging, i) => {
                        marker = new google.maps.Marker({
                          position: {
                                      lat: parseFloat(tagging.koordinat_x), 
                                      lng: parseFloat(tagging.koordinat_y)
                                    },
                          title: tagging.idpel+' | '+tagging.nama+' | '+tagging.tarif_daya+' | '+tagging.koordinat_x+', '+tagging.koordinat_y,
                        });

                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infowindow.setContent(
                                  ` <div class="row">
                                      <div class="col-12">
                                        <dl>
                                          <dt>Idpel</dt>
                                          <dd>`+tagging.idpel+`</dd>
                                          <dt>Nama</dt>
                                          <dd>`+tagging.nama+`</dd>
                                          <dt>Tarif/Daya</dt>
                                          <dd>`+tagging.tarif_daya+`</dd>
                                          <dt>Koordinat</dt>
                                          <dd>`+tagging.koordinat_x+`, `+tagging.koordinat_y+`</dd>
                                        </dl>
                                      </div>
                                    </div>
                                  `
                                  );
                                infowindow.open(map, marker);
                            }
                        })(marker, i)); 

                        return marker;
                      });
                      // Add a marker clusterer to manage the markers.
                      var markerCluster = new MarkerClusterer(map, markers, {
                        imagePath:
                          "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
                        maxZoom: 20,
                        //averageCenter: true,
                      });

                      google.maps.event.addListener(markerCluster, "click", function (c) {
                        var html = "";
                        html += ("<strong>Info Cluster: </strong> <span class='text-right'>("+moment().format('YYYY-MM-DD HH:mm:ss')+")</span><br/>");
                        html += ("&mdash;Titik Tengah Cluster: " + c.getCenter()+"<br/>");
                        html += ("&mdash;Jumlah Tagging: " + c.getSize()+"<br/>");
                        var m = c.getMarkers();
                        var p = [];
                        for (var i = 0; i < m.length; i++) {
                          p.push(m[i].getTitle());
                        }
                        if(m.length<20)
                          log(html + "&mdash;Tagging pada Cluster: <br/>" + p.join("<br/> "));
                        else
                          log(html + '&mdash;Tagging pada Cluster: <br/>Tidak ditampilkan karena lebih dari 20 tagging')
                      });

                    }

                    function log(h) {
                      // document.getElementById("log").innerHTML += h + "<br />";
                      $('#log').prepend(h+'<hr/>');
                    }

                    initMap();

                      
                    var mapTag = $("div#map");
                    $('html,body').animate({scrollTop: mapTag.offset().top},'slow');

                  })
                  .fail(function() {
                    console.log( "error" );
                  })
                  .always(function() {
                    $('div.content-body').unblock();
                    console.log( "complete" );
                  });
              }
            },
            { extend: 'colvis', text: 'Cols' }
            // { extend: 'excelHtml5', 
            //   text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', 
            //   titleAttr: 'Download ke Excel untuk data yang tampil pada Halaman ini',
            //   footer: true, },
            // // {
            // //   text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel (All Rows)',
            // //   action: function ( e, dt, node, config ) {
            // //       dt.ajax.reload();
            // //   }
            // // },
            // { extend: 'csvHtml5', 
            //   text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', 
            //   titleAttr: 'Download ke CSV untuk data yang tampil pada Halaman ini',
            //   footer: true },
            // { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        pageLength: 25,
        "order": [[3, 'asc']],
    });


    $('#tbl_plg_subsidi').on('click', 'td a.foto', function (e) {
        e.preventDefault();    
        var foto = $(this).data('foto');
        $('#img_foto').attr('src', foto);
        $("#modal_foto").modal('show');
      });

    $('#clear_log').click(function(){
        $('#log').empty();
    });

    $('#btn_cari').click(function(btn){
        console.log('Klikk');
        $('#log').empty();
        var container = $('#map').parent();
        $('#map').remove();
        container.append('<div id="map"></div>');
        table.ajax.url( '../controller/pemeriksaan_lpb/getPlgSubsidi.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() ).load();
    });

});
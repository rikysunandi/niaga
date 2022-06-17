$(document).ready(function () {

    "use strict";
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);


    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: '01/01/1990',
        endDate: '31/12/9999',
        locale: {
          format: 'DD/MM/YYYY'
        }
    });


    $('#sel_unitup').change(function(){

      $('#sel_petugas').empty();
      $.getJSON('../controller/referensi/getPetugasPriangan.php?unitup='+$('#sel_unitup').val(), function(data){
          
          $.each(data.rows,function(i,v){
              $('#sel_petugas').append('<option value="'+v.kode+'">'+v.nama+'</option>');
          });
          $('#sel_petugas').append('<option value="00">SEMUA PETUGAS</option>');
          $('#sel_petugas').selectpicker('refresh');

          if(urlParams.has('petugas')){
            $('#sel_petugas').selectpicker('val', urlParams.get('petugas'));
            $('#sel_foto_rumah').selectpicker('val', urlParams.get('foto_rumah'));
            $('#tgl_pemeriksaan_range').data('daterangepicker').setStartDate(urlParams.get('tgl_pemeriksaan_from'));
            $('#tgl_pemeriksaan_range').data('daterangepicker').setEndDate(urlParams.get('tgl_pemeriksaan_to'));
            
            setTimeout(function(){ $('#btn_cari').trigger('click'); }, 1000);
          }
          else{
            $('#sel_petugas').selectpicker('val', "00");
            console.log('semua petugas');
          }

          //$('#sel_rbm').selectpicker('refresh');
        });
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_foto_rumah') 
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
            "url": '../controller/pemeriksaan_lpb/getDataFotoRumah.php',
            "type": "POST",
            "timeout": 360000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          {
            data: "UNITAP",
            visible: false
          },
          {
            data: "UNITUP",
          },
          {
            data: "IDPEL",
            // render: function ( data, type, row ) {
            //     return '<a href="info-agenda.php?noagenda='+data+'" target="_blank">'+data+'</a>';
            // }
          },
          {
            data: "TGL_PEMERIKSAAN",
            // render: function ( data, type, row ) {
            //       console.log(data);
            //       if(data!=null && data.length>=10)
            //         return data.substring(0,10);
            //       //return data;
            //     },
          },
          {
            data: "NOMOR_METER_KWH",
            visible: false
          },
          {
            data: "NAMA",
            // render: function ( data, type, row ) {
            //         if(data == 'DALAM TMP')
            //             return '<span class="label label-success">'+data+'</span>';
            //         else if(data == 'MENDEKATI TMP')
            //             return '<span class="label label-warning">'+data+'</span>';
            //         else if(data == 'MELEBIHI TMP')
            //             return '<span class="label label-danger">'+data+'</span>';
            //     },
          },
          {
            data: "TARIF",
          },
          {
            data: "DAYA",
            type: 'number',
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          { data: "NIK", visible: true},
          { data: "EMAIL", visible: true},
          {
            data: "SISA_KWH",
            type: 'number', 
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(",", ".", 0, '')
          },
          // {
          //   data: "STATUS_PROSES",
          //   render: function ( data, type, row ) {
          //           if(data == 'PROSES')
          //               return '<span class="label label-success">'+data+'</span>';
          //           else if(data == 'EVALUASI')
          //               return '<span class="label label-warning">'+data+'</span>';
          //           else if(data == 'NON RAB')
          //               return '<span class="label label-dark">'+data+'</span>';
          //       },
          // },
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
                    return '<a href="#" class="btn btn-sm btn-primary foto" title="FOTO" data-foto="'+data+'" data-jenis-foto="RUMAH" data-row="'+encodeURIComponent(JSON.stringify(row))+'"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
              },
          },
          {
            data: "FOTORUMAH",
            sortable: false,
            render: function ( data, type, row ) {
                  //console.log(data);
                  //532710010845_2020-09-01.jpg
                  if(!data && data == null)
                    return '<a href="#" class="btn btn-sm btn-primary disabled" title="TIDAK ADA FOTO"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
                  else
                    return '<a href="#" class="btn btn-sm btn-primary foto" title="FOTO" data-foto="'+data+'" data-jenis-foto="METER" data-row="'+encodeURIComponent(JSON.stringify(row))+'"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
              },
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
            { 
              text: '<span><i class="fa fa-map-o"></i>&nbsp;&nbsp;Peta</span>',
              titleAttr: 'Tampilkan Peta',
              action: function ( e, dt, node, config ) {

                  var unitupi = $('#sel_unitupi').val();
                  var unitap = $('#sel_unitap').val();
                  var unitup = $('#sel_unitup').val();
                  var petugas = $('#sel_petugas').val();
                  var tgl_pemeriksaan_from = $('#tgl_pemeriksaan_range')
                                              .data('daterangepicker')
                                              .startDate.format('YYYY-MM-DD');
                  var tgl_pemeriksaan_to = $('#tgl_pemeriksaan_range')
                                              .data('daterangepicker')
                                              .endDate.format('YYYY-MM-DD');

                  $('div.content-body').block({ message: 'Mengambil data...' });
                  
                  $.ajax({
                    url: "../controller/pemeriksaan_lpb/getKoordinatPemeriksaan.php",
                    method: "GET",
                    data: { 
                      unitupi : unitupi,
                      unitap : unitap,
                      unitup : unitup,
                      unitup : unitup,
                      petugas : petugas,
                      tgl_pemeriksaan_from : tgl_pemeriksaan_from,
                      tgl_pemeriksaan_to : tgl_pemeriksaan_to,
                    },
                  }).done(function(data) {
                    var data  = $.parseJSON(data);
                    // console.log( "success", data );

                    var container = $('#map').parent();
                    $('#map').remove();
                    container.append('<div id="map"></div>');

                    

                    function initMap() {
                      const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 10,
                        center: { lat: -6.3487933, lng: 107.6809901 },
                      });

                        
                      var infowindow = new google.maps.InfoWindow();
                      var marker = new google.maps.Marker();
                        var bounds = new google.maps.LatLngBounds();

                      const markers = data.rows.map((tagging, i) => {
                        if(i==0 ){
                          marker = new google.maps.Marker({
                            position: {
                                        lat: parseFloat(tagging.latitude), 
                                        lng: parseFloat(tagging.longitude)
                                      },
                            label: ''+i,
                            map: map,
                            icon: {
                              url: "https://maps.google.com/mapfiles/ms/icons/green-dot.png"
                            },
                            title: tagging.idpel+' | '+tagging.tgl_pemeriksaan+' | '+tagging.user_input+' | '+tagging.latitude+', '+tagging.longitude,
                          });
                        }else if(i==data.rows.length-1){
                          marker = new google.maps.Marker({
                            position: {
                                        lat: parseFloat(tagging.latitude), 
                                        lng: parseFloat(tagging.longitude)
                                      },
                            label: ''+i,
                            map: map,
                            icon: {
                              url: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                            },
                            title: tagging.idpel+' | '+tagging.tgl_pemeriksaan+' | '+tagging.user_input+' | '+tagging.latitude+', '+tagging.longitude,
                          });
                        }else{
                          marker = new google.maps.Marker({
                            position: {
                                        lat: parseFloat(tagging.latitude), 
                                        lng: parseFloat(tagging.longitude)
                                      },
                            label: ''+i,
                            map: map,
                            title: tagging.idpel+' | '+tagging.tgl_pemeriksaan+' | '+tagging.user_input+' | '+tagging.latitude+', '+tagging.longitude,
                          });
                        }

                        bounds.extend(new google.maps.LatLng(parseFloat(tagging.latitude), parseFloat(tagging.longitude)));

                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infowindow.setContent(
                                  ` <div class="row">
                                      <div class="col-6">
                                        <dl>
                                          <dt>Idpel</dt>
                                          <dd>`+tagging.idpel+`</dd>
                                          <dt>No Meter</dt>
                                          <dd>`+tagging.nomor_meter_kwh+`</dd>
                                          <dt>Tgl Pemeriksaan</dt>
                                          <dd>`+tagging.tgl_pemeriksaan+`</dd>
                                          <dt>Petugas</dt>
                                          <dd>`+tagging.user_input+`</dd>
                                          <dt>Koordinat</dt>
                                          <dd>`+tagging.latitude+`, `+tagging.longitude+`</dd>
                                        </dl>
                                      </div>
                                      <div class="col-6">
                                        <img src="`+tagging.fotopath+`" width="300px" height="400px"/></dd>
                                      </div>
                                    </div>
                                  `
                                  );
                                infowindow.open(map, marker);
                            }
                        })(marker, i)); 

                        return marker;
                      });

                      map.fitBounds(bounds);
                      // Add a marker clusterer to manage the markers.
                      // var markerCluster = new MarkerClusterer(map, markers, {
                      //   imagePath:
                      //     "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
                      //   maxZoom: 20,
                      //   //averageCenter: true,
                      // });

                      // google.maps.event.addListener(markerCluster, "click", function (c) {
                      //   var html = "";
                      //   html += ("<strong>Info Cluster: </strong> <span class='text-right'>("+moment().format('YYYY-MM-DD HH:mm:ss')+")</span><br/>");
                      //   html += ("&mdash;Titik Tengah Cluster: " + c.getCenter()+"<br/>");
                      //   html += ("&mdash;Jumlah Tagging: " + c.getSize()+"<br/>");
                      //   var m = c.getMarkers();
                      //   var p = [];
                      //   for (var i = 0; i < m.length; i++) {
                      //     p.push(m[i].getTitle());
                      //   }
                      //   if(m.length<100)
                      //     log(html + "&mdash;Tagging pada Cluster: <br/>" + p.join("<br/> "));
                      //   else
                      //     log(html + '&mdash;Tagging pada Cluster: <br/>Tidak ditampilkan karena lebih dari 20 tagging')
                      // });

                      // google.maps.event.addListener(markerCluster, "mouseover", function (c) {
                      //   log("<strong>mouseover: </strong>");
                      //   log("&mdash;Center of cluster: " + c.getCenter());
                      //   log("&mdash;Number of managed markers in cluster: " + c.getSize());
                      // });
                      // google.maps.event.addListener(markerCluster, "mouseout", function (c) {
                      //   log("<strong>mouseout: </strong>");
                      //   log("&mdash;Center of cluster: " + c.getCenter());
                      //   log("&mdash;Number of managed markers in cluster: " + c.getSize());
                      // });

                    }

                    function log(h) {
                      // document.getElementById("log").innerHTML += h + "<br />";
                      $('#log').prepend(h+'<hr/>');
                    }

                    initMap();



                    // var red_house = "../../assets/images/markers/red/house.png";
                    // var blue_house = "../../assets/images/markers/blue/house.png";

                    // var markers = new Array(); 

                    // $(data.rows).each(function(key, obj){
                    //     // console.log('key', key);
                    //     // console.log('obj', obj);
                    //     markers.push(
                    //         {
                    //             title: obj.idpel+" ( "+obj.tgl_pemeriksaan+" ) ", 
                    //             position:[obj.latitude, obj.longitude], 
                    //             icon:red_house
                    //         });
                    // });

                    // console.log('markers', markers);

                    // var map = $('#map')
                    //   .gmap3({
                    //     center: [-6.3487933,107.6809901],
                    //     zoom:8
                    //   });

                    //   new MarkerClusterer(map, markers, {
                    //     imagePath:
                    //       "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
                    //   });

                      //.marker(markers)
                      // .cluster({
                      //   size: 500,
                      //   markers: markers,
                      //   cb: function (markers) {
                      //     if (markers.length > 200) { // 1 marker stay unchanged (because cb returns nothing)
                      //       if (markers.length < 6000) {
                      //         return {
                      //           content: "<div class='cluster cluster-1'>" + markers.length + "</div>",
                      //           x: -26,
                      //           y: -26
                      //         };
                      //       }
                      //     }
                      //   }
                      // })
                      // .wait(2000) // to let you appreciate the current zoom & center
                      // .fit();

                    // var map = $('#map')
                    //   .gmap3({
                    //     address:"Bandung, Indonesia",
                    //     zoom:14
                    //   })
                    //   .wait(2000) // to let you appreciate the current zoom & center
                    //   .fit();

                      
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
            { 
              text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Export Semua', 
              titleAttr: 'Download CSV',
              //"sTooltip": "My CSV button's tooltip",
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open('../controller/pemeriksaan_lpb/expCSVFotoRumah.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_pemeriksaan_from='+$('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_pemeriksaan_to='+$('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')+'&petugas='+$('#sel_petugas').val()+'&foto_rumah='+$('#sel_foto_rumah').val() );
              }

            },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        pageLength: 25,
        "order": [[3, 'desc'],[0, 'asc'],[1, 'asc'],],
        
    });


    $('#tbl_mon_foto_rumah').on('click', 'td a.foto', function (e) {
        e.preventDefault();    
        var row = (JSON.parse(decodeURIComponent($(this).data('row'))));
        var foto = $(this).data('foto');
        $('#img_foto').attr('src', foto+'?time='+$.now());
        $('#idpel').html(row.IDPEL);
        $('#tgl_pemeriksaan').html(row.TGL_PEMERIKSAAN.substr(0,16));
        $('#user_app').html(row.USER_INPUT);
        $("#modal_foto").modal('show');

        var $image = $('#img_foto');

        $image.viewer({
          //inline: true,
          viewed: function() {
            $image.viewer('zoomTo', 1);
          }
        });

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
        table.ajax.url( '../controller/pemeriksaan_lpb/getDataFotoRumah.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_pemeriksaan_from='+$('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_pemeriksaan_to='+$('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')+'&petugas='+$('#sel_petugas').val()+'&foto_rumah='+$('#sel_foto_rumah').val() ).load();
    });

});
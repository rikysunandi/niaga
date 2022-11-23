$(document).ready(function () {

    "use strict";


    $('#sel_unitup').change(function(){

        if($('#sel_unitup').val()!=null && $('#sel_unitup').val()!=''){
            console.log('pilih petugas', $('#sel_unitup').val());
            $('#sel_petugas').empty();
            $('#sel_rpp').empty();
            $.getJSON('../controller/referensi/getPetugasPriangan.php?unitup='+$('#sel_unitup').val(), function(data){
              
                $.each(data.rows,function(i,v){
                  $('#sel_petugas').append('<option value="'+v.kode+'">'+v.nama+'</option>');
                });
            
                if($('#sel_petugas').data('inc-semua')!='T')
                  $('#sel_petugas').append('<option value="00">SEMUA PETUGAS</option>');

                $('#sel_petugas').selectpicker('refresh');

            });
        }
    });

    $('#sel_petugas').change(function(){

        if($('#sel_petugas').val()!=null && $('#sel_petugas').val()!=''){
            console.log('pilih rpp', $('#sel_petugas').val());
            $('#sel_rpp').empty();
            $.getJSON('../controller/referensi/getRPP.php?petugas='+$('#sel_petugas').val(), function(data){
                  
                $.each(data.rows,function(i,v){
                  $('#sel_rpp').append('<option value="'+v.kode+'">'+v.nama+'</option>');
                });

                if($('#sel_rpp').data('inc-semua')!='T')
                  $('#sel_rpp').append('<option value="00">SEMUA RPP</option>');
                  
                $('#sel_rpp').selectpicker('refresh');

            });
        }
    });

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_mon_pemeriksaan_lpb') 
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
            "url": '../controller/pemeriksaan_lpb/getSisaWORPPOnsite.php',
            "type": "POST",
            "timeout": 360000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          // {
          //   data: "NO",
          //   visible: true
          // },
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
          {
            data: "RPP_PETUGAS",
          },
          {
            data: "RPP_KDDK",
          },
          { data: "NAMA_GARDU", visible: true},
          { data: "NOMOR_JURUSAN_TIANG", visible: true},
          { data: "LATITUDE", visible: true},
          { data: "LONGITUDE", visible: true},
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [[25, 50, 100], [25, 50, 100]],
        lengthChange: true,
        buttons: [
            // { 
            //   text: '<span><i class="fa fa-map-o"></i>&nbsp;&nbsp;Peta</span>',
            //   titleAttr: 'Tampilkan Peta',
            //   action: function ( e, dt, node, config ) {

            //       var unitupi = $('#sel_unitupi').val();
            //       var unitap = $('#sel_unitap').val();
            //       var unitup = $('#sel_unitup').val();
            //       var petugas = $('#sel_petugas').val();
            //       var tgl_pemeriksaan_from = $('#tgl_pemeriksaan_range')
            //                                   .data('daterangepicker')
            //                                   .startDate.format('YYYY-MM-DD');
            //       var tgl_pemeriksaan_to = $('#tgl_pemeriksaan_range')
            //                                   .data('daterangepicker')
            //                                   .endDate.format('YYYY-MM-DD');

            //       $('div.content-body').block({ message: 'Mengambil data...' });
                  
            //       $.ajax({
            //         url: "../controller/pemeriksaan_lpb/getKoordinatPemeriksaan.php",
            //         method: "GET",
            //         data: { 
            //           unitupi : unitupi,
            //           unitap : unitap,
            //           unitup : unitup,
            //           unitup : unitup,
            //           petugas : petugas,
            //           tgl_pemeriksaan_from : tgl_pemeriksaan_from,
            //           tgl_pemeriksaan_to : tgl_pemeriksaan_to,
            //         },
            //       }).done(function(data) {
            //         var data  = $.parseJSON(data);
            //         // console.log( "success", data );

            //         var container = $('#map').parent();
            //         $('#map').remove();
            //         container.append('<div id="map"></div>');

                    

            //         function initMap() {
            //           const map = new google.maps.Map(document.getElementById("map"), {
            //             zoom: 10,
            //             center: { lat: -6.3487933, lng: 107.6809901 },
            //           });

                        
            //           var infowindow = new google.maps.InfoWindow();
            //           var marker = new google.maps.Marker();
            //             var bounds = new google.maps.LatLngBounds();

            //           const markers = data.rows.map((tagging, i) => {
            //             if(tagging.latitude.length>4 && tagging.longitude>4){
            //                 if(i==0 ){
            //                   marker = new google.maps.Marker({
            //                     position: {
            //                                 lat: parseFloat(tagging.latitude), 
            //                                 lng: parseFloat(tagging.longitude)
            //                               },
            //                     map: map,
            //                     zIndex: 999,
            //                     icon: {
            //                       url: "../controller/getMarkerIcon.php?color=green-darker&text="+(i+1),
            //                     },
            //                     title: tagging.idpel+' | '+tagging.tgl_pemeriksaan+' | '+tagging.user_input+' | '+tagging.latitude+', '+tagging.longitude,
            //                   });
            //                 }else if(i==data.rows.length-1){
            //                   marker = new google.maps.Marker({
            //                     position: {
            //                                 lat: parseFloat(tagging.latitude), 
            //                                 lng: parseFloat(tagging.longitude)
            //                               },
            //                     map: map,
            //                     zIndex: 998,
            //                     icon: {
            //                       url: "../controller/getMarkerIcon.php?color=green-darker&text="+(i+1),
            //                     },
            //                     title: tagging.idpel+' | '+tagging.tgl_pemeriksaan+' | '+tagging.user_input+' | '+tagging.latitude+', '+tagging.longitude,
            //                   });
            //                 }else{
            //                   marker = new google.maps.Marker({
            //                     position: {
            //                                 lat: parseFloat(tagging.latitude), 
            //                                 lng: parseFloat(tagging.longitude)
            //                               },
            //                     map: map,
            //                     zIndex: data.rows.length - i,
            //                     icon: {
            //                       url: "../controller/getMarkerIcon.php?color=green&text="+(i+1),
            //                     },
            //                     title: tagging.idpel+' | '+tagging.tgl_pemeriksaan+' | '+tagging.user_input+' | '+tagging.latitude+', '+tagging.longitude,
            //                   });
            //                 }

            //                 bounds.extend(new google.maps.LatLng(parseFloat(tagging.latitude), parseFloat(tagging.longitude)));

            //                 google.maps.event.addListener(marker, 'click', (function (marker, i) {
            //                     return function () {
            //                         infowindow.setContent(
            //                           ` <div class="row">
            //                               <div class="col-6">
            //                                 <dl>
            //                                   <dt>Idpel</dt>
            //                                   <dd>`+tagging.idpel+`</dd>
            //                                   <dt>Nama</dt>
            //                                   <dd>`+tagging.nama+`</dd>
            //                                   <dt>Tgl Pemeriksaan</dt>
            //                                   <dd>`+tagging.tgl_pemeriksaan+`</dd>
            //                                   <dt>Tgl Input</dt>
            //                                   <dd>`+tagging.tgl_input+`</dd>
            //                                   <dt>Petugas</dt>
            //                                   <dd>`+tagging.user_input+`</dd>
            //                                   <dt>Koordinat</dt>
            //                                   <dd>`+tagging.latitude+`, `+tagging.longitude+`</dd>
            //                                 </dl>
            //                               </div>
            //                               <div class="col-6">
            //                                 <img src="`+tagging.fotopath+`" width="300px" height="400px"/></dd>
            //                               </div>
            //                             </div>
            //                           `
            //                           );
            //                         infowindow.open(map, marker);
            //                     }
            //                 })(marker, i)); 

            //                 return marker;
            //               }
            //           });

            //           map.fitBounds(bounds);
            //           // Add a marker clusterer to manage the markers.
            //           // var markerCluster = new MarkerClusterer(map, markers, {
            //           //   imagePath:
            //           //     "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
            //           //   maxZoom: 20,
            //           //   //averageCenter: true,
            //           // });

            //           // google.maps.event.addListener(markerCluster, "click", function (c) {
            //           //   var html = "";
            //           //   html += ("<strong>Info Cluster: </strong> <span class='text-right'>("+moment().format('YYYY-MM-DD HH:mm:ss')+")</span><br/>");
            //           //   html += ("&mdash;Titik Tengah Cluster: " + c.getCenter()+"<br/>");
            //           //   html += ("&mdash;Jumlah Tagging: " + c.getSize()+"<br/>");
            //           //   var m = c.getMarkers();
            //           //   var p = [];
            //           //   for (var i = 0; i < m.length; i++) {
            //           //     p.push(m[i].getTitle());
            //           //   }
            //           //   if(m.length<100)
            //           //     log(html + "&mdash;Tagging pada Cluster: <br/>" + p.join("<br/> "));
            //           //   else
            //           //     log(html + '&mdash;Tagging pada Cluster: <br/>Tidak ditampilkan karena lebih dari 20 tagging')
            //           // });

            //           // google.maps.event.addListener(markerCluster, "mouseover", function (c) {
            //           //   log("<strong>mouseover: </strong>");
            //           //   log("&mdash;Center of cluster: " + c.getCenter());
            //           //   log("&mdash;Number of managed markers in cluster: " + c.getSize());
            //           // });
            //           // google.maps.event.addListener(markerCluster, "mouseout", function (c) {
            //           //   log("<strong>mouseout: </strong>");
            //           //   log("&mdash;Center of cluster: " + c.getCenter());
            //           //   log("&mdash;Number of managed markers in cluster: " + c.getSize());
            //           // });

            //         }

            //         function log(h) {
            //           // document.getElementById("log").innerHTML += h + "<br />";
            //           $('#log').prepend(h+'<hr/>');
            //         }

            //         initMap();



            //         // var red_house = "../../assets/images/markers/red/house.png";
            //         // var blue_house = "../../assets/images/markers/blue/house.png";

            //         // var markers = new Array(); 

            //         // $(data.rows).each(function(key, obj){
            //         //     // console.log('key', key);
            //         //     // console.log('obj', obj);
            //         //     markers.push(
            //         //         {
            //         //             title: obj.idpel+" ( "+obj.tgl_pemeriksaan+" ) ", 
            //         //             position:[obj.latitude, obj.longitude], 
            //         //             icon:red_house
            //         //         });
            //         // });

            //         // console.log('markers', markers);

            //         // var map = $('#map')
            //         //   .gmap3({
            //         //     center: [-6.3487933,107.6809901],
            //         //     zoom:8
            //         //   });

            //         //   new MarkerClusterer(map, markers, {
            //         //     imagePath:
            //         //       "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
            //         //   });

            //           //.marker(markers)
            //           // .cluster({
            //           //   size: 500,
            //           //   markers: markers,
            //           //   cb: function (markers) {
            //           //     if (markers.length > 200) { // 1 marker stay unchanged (because cb returns nothing)
            //           //       if (markers.length < 6000) {
            //           //         return {
            //           //           content: "<div class='cluster cluster-1'>" + markers.length + "</div>",
            //           //           x: -26,
            //           //           y: -26
            //           //         };
            //           //       }
            //           //     }
            //           //   }
            //           // })
            //           // .wait(2000) // to let you appreciate the current zoom & center
            //           // .fit();

            //         // var map = $('#map')
            //         //   .gmap3({
            //         //     address:"Bandung, Indonesia",
            //         //     zoom:14
            //         //   })
            //         //   .wait(2000) // to let you appreciate the current zoom & center
            //         //   .fit();

                      
            //         var mapTag = $("div#map");
            //         $('html,body').animate({scrollTop: mapTag.offset().top},'slow');

            //       })
            //       .fail(function() {
            //         console.log( "error" );
            //       })
            //       .always(function() {
            //         $('div.content-body').unblock();
            //         console.log( "complete" );
            //       });
            //   }
            // },
            { 
              text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Export Semua', 
              titleAttr: 'Download CSV',
              //"sTooltip": "My CSV button's tooltip",
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open('../controller/pemeriksaan_lpb/expCSVSisaWORPPOnsite.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&petugas='+$('#sel_petugas').val()+'&rpp='+$('#sel_rpp').val() );
              }

            },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        pageLength: 25,
        "order": [[7, 'asc'],[8, 'asc']],
        
    });


    $('#tbl_mon_pemeriksaan_lpb').on('click', 'td a.foto', function (e) {
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
        table.ajax.url( '../controller/pemeriksaan_lpb/getSisaWORPPOnsite.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&petugas='+$('#sel_petugas').val()+'&rpp='+$('#sel_rpp').val() ).load();
    });

});
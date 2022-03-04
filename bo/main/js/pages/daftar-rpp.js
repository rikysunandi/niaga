$(document).ready(function () {

    "use strict";
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    
    var red_house = "../../assets/images/markers/red/house.png";
    var blue_house = "../../assets/images/markers/blue/house.png";
    var ic_gardu = "../../assets/images/markers/green/powersubstation.png";
    var selected = new Array();
    var start, end;
    var stop_simulasi = false;

    $('#btn_generate').prop('disabled', true);
    $('#btn_simulasi').prop('disabled', true);
    $('#btn_create').prop('disabled', true);

    var is_first = true;
    var opsi_petugas;
    var generated=false;

    $('#sel_unitup').change(function(){

        if($('#sel_unitup').val()!=null){
            $('#sel_petugas').empty();
            $.getJSON('../controller/referensi/getPetugasPriangan.php?unitup='+$('#sel_unitup').val(), function(data){
              
                $.each(data.rows,function(i,v){
                  $('#sel_petugas').append('<option value="'+v.kode+'">'+v.nama+'</option>');
                });
            
                if($('#sel_petugas').data('inc-semua')!='T')
                  $('#sel_petugas').append('<option value="00">SEMUA PETUGAS</option>');

                $('#sel_petugas').selectpicker('refresh');

                if(urlParams.has('petugas')){
                    $('#sel_petugas').selectpicker('val', urlParams.get('petugas'));
                }
                else{
                    $('#sel_petugas').selectpicker('val', "00");
                    console.log('semua petugas');
                }

              //$('#sel_rbm').selectpicker('refresh');
            });
        }
    });

    $('#sel_petugas').change(function(){

        if($('#sel_petugas').val()!=null){
            $('#sel_rpp').empty();
            $.getJSON('../controller/referensi/getRPP.php?petugas='+$('#sel_petugas').val(), function(data){
                  
                $.each(data.rows,function(i,v){
                  $('#sel_rpp').append('<option value="'+v.kode+'">'+v.nama+'</option>');
                });

                if($('#sel_rpp').data('inc-semua')!='T')
                  $('#sel_rpp').append('<option value="00">SEMUA RPP</option>');
                  
                $('#sel_rpp').selectpicker('refresh');

                if(urlParams.has('rpp')){
                    $('#sel_rpp').selectpicker('val', urlParams.get('rpp'));
                    console.log('rpp', urlParams.get('rpp'));

                    setTimeout(function(){ $('#btn_cari').trigger('click'); }, 1000);
                }
                else{
                    $('#sel_rpp').selectpicker('val', "00");
                    console.log('semua petugas');
                }

                  //$('#sel_rbm').selectpicker('refresh');
            });
        }
    });

    var map;
     // = $('#map')
     //  .gmap3({
     //    address:"Bandung, Indonesia",
     //    zoom:14
     //  })
     //  .wait(2000) // to let you appreciate the current zoom & center
     //  .fit();

    var markers;
    var infowindow = new google.maps.InfoWindow();


    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rpp')
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
        "deferLoading": 1000,
        "ajax": {
            "url": '../controller/pemeriksaan_lpb/getDetailRPP.php',
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
            data: "NAMA",
            visible: false
          },
          {
            data: "KOGOL",
            visible: false
          },
          {
            data: "TARIF",
            visible: false
          },
          {
            data: "DAYA",
            type: 'number',
            visible: false,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "NAMA_GARDU",
            visible: true
          },
          {
            data: "NOMOR_JURUSAN_TIANG",
            visible: true
          },
          {
            data: "RPP_KDDK",
            visible: true
          },
          {
            data: "RPP_PETUGAS",
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
            data: "NOMOR_METER_KWH",
            visible: true
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-6 mb-2'B><'col-sm-12 col-md-2 mb-2'l><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-5 mb-2'i><'col-sm-12 col-md-7'p>>",
        buttons: [
           // { extend: 'copyHtml5', text: '<i class="fa fa-clone"></i>&nbsp;&nbsp;Copy', footer: true },
            //{ extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel', footer: true },
            //{ extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', footer: true },
            
            { 
              text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV', 
              titleAttr: 'Download CSV',
              //"sTooltip": "My CSV button's tooltip",
              action: function ( e, dt, node, config ) {
                  // alert( 'Download!' );
                  // //this.disable(); // disable button
                  // console.log('dt', dt);
                  // console.log('node', node);
                  window.open('../controller/pemeriksaan_lpb/expCSVRPP.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&petugas='+$('#sel_petugas').val()+'&rpp='+$('#sel_rpp').val() );
              }

            },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        "order": [[9, 'asc']],
    });

    $('#btn_cari').click(function(){

        $('div.content-body').block({ message: 'Mengambil data pelanggan pada RPP '+$('#sel_rpp').val()+'...' });
        console.log('cari!!');
        // console.log($("#tgl_baca_to").datepicker("getFormattedDate"));
        // console.log($("#tgl_baca_from").datepicker("getFormattedDate"));

        table.ajax.url( '../controller/pemeriksaan_lpb/getDetailRPP.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&petugas='+$('#sel_petugas').val()+'&rpp='+$('#sel_rpp').val() ).load();

        $('#btn_generate').prop('disabled', true);
        $('#btn_simulasi').prop('disabled', true);
        $('#btn_create').prop('disabled', true);

        $('#map').gmap3({
            action: 'destroy'
        });

        selected = new Array();
        start = null;
        end = null;

        $('#btn_generate').prop('disabled', true);
        $('#btn_simulasi').prop('disabled', true);
        $('#btn_create').prop('disabled', true);

        var container = $('#map').parent();
        $('#map').remove();
        container.append('<div id="map"></div>');

        $.getJSON( "../controller/pemeriksaan_lpb/getDataRPP.php", 
        { 
            unitupi: $('#sel_unitupi').val(),
            unitap: $('#sel_unitap').val(),
            unitup: $('#sel_unitup').val(),
            petugas: $('#sel_petugas').val(),
            rpp: $('#sel_rpp').val(),
        }).done(function( json ) {
            if(json!=null){

                var markers = new Array();

                $(json.rpp).each(function(key, obj){
                    // console.log(obj);
                    markers.push(
                        {
                            title: obj.idpel+" ( "+obj.nama+" ) ", 
                            position:[obj.latitude, obj.longitude], 
                            icon: "../controller/getMarkerIcon.php?color=blue&text="+obj.urutan,
                            idpel: obj.idpel,
                            rpp: obj.rpp,
                            petugas: obj.petugas,
                            urutan: null,
                            start_end: false
                        });
                });

                // var gardu_markers = new Array(); 

                // $(json.gardu).each(function(key, obj){
                //     // console.log(obj);
                //     markers.push(
                //         {
                //             title: obj.nama_gardu+" ( "+obj.kapasitas_trafo+" kVA ) ", 
                //             //label: obj.nama_gardu,
                //             position:[obj.latitude, obj.longitude], 
                //             //icon:ic_gardu,
                //             icon: {
                //               url: ic_gardu,
                //               labelOrigin: new google.maps.Point(15, 40),
                //               //size: new google.maps.Size(32,32),
                //               //anchor: new google.maps.Point(16,32)
                //             },
                //             label: {
                //               text: obj.nama_gardu,
                //               color: "#4caf50",
                //               fontWeight: "bold"
                //             },
                //             gardu:obj.nama_gardu,
                //             idpel:"X",
                //             zIndex: 9999,
                //         });
                // });
                   
                var markers_obj;

                map = $('#map')
                  .gmap3({
                    //center: [-6.3487933,107.6809901],
                    //zoom:11,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                    },
                    navigationControl: true,
                    scrollwheel: true,
                    streetViewControl: true
                  })
                  .marker(markers)
                  // .cluster({
                  //   //radius: 10,
                  //   //size: 300,
                  //   markers: markers,
                  //   cb: function (markers) {
                  //     markers_obj = markers;

                  //     var jml_plg = $.grep(markers, function(e) { return e.idpel!="X" }).length;

                  //     if (jml_plg > 300) { // 1 marker stay unchanged (because cb returns nothing)
                  //       if (jml_plg > 10000) {
                  //         return {
                  //           content: "<div class='cluster cluster-3'>" + jml_plg + "</div>",
                  //           x: -43,
                  //           y: -43,
                  //           width: 96,
                  //           height: 95
                  //         };
                  //       }
                  //       else if (jml_plg > 1000) {
                  //         return {
                  //           content: "<div class='cluster cluster-2'>" + jml_plg + "</div>",
                  //           x: -33,
                  //           y: -33,
                  //           width: 76,
                  //           height: 75
                  //         };
                  //       }else{
                  //         return {
                  //           content: "<div class='cluster cluster-1'>" + jml_plg + "</div>",
                  //           x: -31,
                  //           y: -31,
                  //           width: 63,
                  //           height: 62
                  //         };
                  //       }
                  //     }
                  //   }
                  // })
                    // .then(function (markers) {

                    //     var map = this.get()[0];
                    //     console.log("map then", map);
                        
                    //     $('#btn_generate').prop('disabled', false);
                    //     $('#btn_simulasi').prop('disabled', false);
                    //     $('#btn_create').prop('disabled', false);

                    //     $('#total_plg').html("("+markers.length+" plg)");

                    //     $('div.content-body').unblock();


                    //     const directionsService = new google.maps.DirectionsService();
                    //     const directionsRenderer = new google.maps.DirectionsRenderer();
                    //     const distanceMatrixService = new google.maps.DistanceMatrixService();
                    //     directionsRenderer.setMap(map);

                    //     function chunkArrayInGroups(arr, size) {
                    //       var myArray = [];
                    //       for(var i = 0; i < arr.length; i += size) {
                    //         myArray.push(arr.slice(i, i+size));
                    //       }
                    //       return myArray;
                    //     }


                    //     function generateByDirectionService(directionsService, directionsRenderer, waypts_chunks, i) {  

                    //         const waypts = [];
                    //         for (let j = 1; j < waypts_chunks[i].length-1; j++) {
                    //             //if (!waypts_chunks[i][j].start_end) {
                    //               waypts.push({
                    //                 location: waypts_chunks[i][j].position,
                    //                 stopover: true,
                    //               });
                    //             //}
                    //         }
                    //         console.log('waypts', waypts);

                    //         setTimeout(function() { 

                    //             directionsService
                    //             .route({
                    //               origin: waypts_chunks[i][0].position,
                    //               destination: waypts_chunks[i][waypts_chunks[i].length-1].position,
                    //               waypoints: waypts,
                    //               optimizeWaypoints: true,
                    //               travelMode: google.maps.TravelMode.WALKING,
                    //             })
                    //             .then((response) => {
                    //                 console.log('response', response.routes[0].waypoint_order);
                    //                 // if(first){
                    //                 //     directionsRenderer.setDirections(response);
                    //                 //     first = false;
                    //                 // }
                    //                 markers[(i*25)].setIcon("../controller/getMarkerIcon.php?color=blue&text="+((i*25)+1));
                    //                 markers[(i*25)].urutan=(i*25)+1;
                    //                 markers[(i*25)+waypts_chunks[i].length-1].setIcon("../controller/getMarkerIcon.php?color=blue&text="+((i*25)+waypts_chunks[i].length));
                    //                 markers[(i*25)+waypts_chunks[i].length-1].urutan=(i*25)+waypts_chunks[i].length;
                    //                 $.each(response.routes[0].waypoint_order, function(idx, urut){
                    //                     //console.log(i, urut);
                    //                     markers[(i*25)+(urut+1)].setIcon("../controller/getMarkerIcon.php?color=blue&text="+((i*25)+(urut+2)));
                    //                     markers[(i*25)+(urut+1)].urutan=(i*25)+(urut+2);
                    //                 });

                    //               const route = response.routes[0];
                    //               const summaryPanel = $('.urut-langkah');

                    //               //summaryPanel.innerHTML = "";

                    //               // For each route, display summary information.
                    //               for (let i = 0; i < route.legs.length; i++) {
                    //                 const routeSegment = i + 1;

                    //                 summaryPanel.innerHTML +=
                    //                   "<b>Route Segment: " + routeSegment + "</b><br>";
                    //                 summaryPanel.innerHTML += route.legs[i].start_address + " to ";
                    //                 summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
                    //                 summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
                    //               }
                    //             })
                    //             .catch((e) => window.alert("Directions request failed due to " + status));
      

                    //             if (i < waypts_chunks.length) {           //  if the counter < 10, call the loop function
                    //               generateByDirectionService(directionsService, directionsRenderer, waypts_chunks, i+1);             //  ..  again which will trigger another 
                    //             }                       //  ..  setTimeout()
                    //         }, 2000)
                    //     }


                    //     function calculateAndDisplayRoute(datas, directionsService, directionsRenderer) {
                            
                    //         var waypts_chunks = chunkArrayInGroups(datas, 25);
                    //         console.log('waypts_chunks', waypts_chunks);

                    //         const summaryPanel = $('.urut-langkah');
                    //         var first = true;

                    //         summaryPanel.innerHTML = "";

                    //         generateByDirectionService(directionsService, directionsRenderer, waypts_chunks, 0);

                    //     }

                    //     function find_closest_markers(start) {
                    //         var markers_distances = [];
                    //         var before = start;
                    //         $('div.content-body').block({ message: 'Mengkalkulasi jarak dan mengurutkan titik koordinat...' });
                    //         for (var i = 0; i < markers.length; i++) {
                    //             // if(!markers[i].start_end){
                    //                 var d = google.maps.geometry.spherical.computeDistanceBetween(before.position, markers[i].position);
                    //                 // var d = turf.distance(
                    //                 //     turf.point([start.position.lat(), start.position.lng()]), 
                    //                 //     turf.point([markers[i].position.lat(), markers[i].position.lng()]), 
                    //                 //     {units: 'miles'});
                    //                 markers_distances[i] = {
                    //                     distance: d, 
                    //                     marker: markers[i]
                    //                 }
                    //                 markers[i].jarak = d;
                    //             // }
                    //         }

                    //         var closest_markers = markers_distances.sort((a, b) => {return a.distance-b.distance})
                    //         $('div.content-body').unblock();

                    //         return closest_markers.map((item) => {return item.marker})
                    //     }

                    //     function sortUrutan(datas, mulai, akhir, idx) {
                            
                    //         if(idx<datas.length){
                    //             if(idx==0)
                    //                 $('div.content-body').block({ message: 'Mengkalkulasi jarak dan mengurutkan titik koordinat...' });
                                
                    //             console.log('cek jarak ke-'+idx, mulai.title+' urutan ke-'+mulai.urutan);
                    //             var jarak, jarak_sebelumnya, closest_idx;
                    //             for (var i = 0; i < datas.length; i++) {

                    //                 // if(datas[i].idpel==start.idpel){
                    //                 //     datas[i].urutan=1;
                    //                 //     datas[i].start_end=true;
                    //                 // }

                    //                 // if(datas[i].idpel==end.idpel){
                    //                 //     datas[i].urutan=datas.length;
                    //                 //     datas[i].start_end=true;
                    //                 // }

                    //                 if(datas[i].urutan==null){
                    //                     jarak = google.maps.geometry.spherical.computeDistanceBetween(mulai.position, datas[i].position);
                                        
                    //                     if(jarak_sebelumnya==null){
                    //                         jarak_sebelumnya = jarak;
                    //                         closest_idx = i;
                    //                     }else if(jarak<jarak_sebelumnya){
                    //                         jarak_sebelumnya = jarak;
                    //                         closest_idx = i;
                    //                     }

                    //                 }
                    //             }
                    //             if(closest_idx!=null){
                    //                 datas[closest_idx].urutan = idx+2;
                    //                 console.log('titik terdekat '+closest_idx, datas[closest_idx].title);
                    //                 sortUrutan(datas, datas[closest_idx], end, idx+1);
                    //             }else{
                    //                 sortUrutan(datas, datas[0], end, datas.length);
                    //             }
                    //         }else{
                    //             //mulai.urutan = datas.length;
                    //             console.log('Selesai mengurutkan');
                    //             datas = datas.sort((a, b) => {return a.urutan-b.urutan});
                    //             console.log('datas dalam', datas);
                    //             $('div.content-body').unblock();

                    //         }
                    //     }


                    //     $('#btn_generate').bind( "click", function() {
                    //         console.log("GENERATE LANGKAH!");
                    //         if(start!=null && end!=null){
                    //             //calculateAndDisplayRoute(directionsService, directionsRenderer);
                    //             //markers = find_closest_markers(start);
                    //             sortUrutan(markers, start, end, 0);
                    //             console.log('closest_markers', markers);
                    //             //calculateAndDisplayRoute(markers, directionsService, directionsRenderer);
                                
                    //             $('div.content-body').block({ message: 'Memberikan Urutan...' });
                    //             var i=1;
                    //             asyncForEach(markers, function(marker) {
                    //                 marker.setIcon("../controller/getMarkerIcon.php?color=blue&text="+(marker.urutan));
                    //                 //marker.urutan=i;
                    //                 i++;
                    //             },function() {
                    //                 $('div.content-body').unblock();

                    //                 $('#btn_generate').prop('disabled', true);
                    //                 $('#btn_simulasi').prop('disabled', false);
                    //                 $('#btn_create').prop('disabled', false);

                    //                 start = null;
                    //                 end = null;
                    //                 generated = true;
                    //             });

                    //         }else{
                    //             bootbox.alert({
                    //                 message: "Silahkan tentukan titik awal dan titik akhir rute!",
                    //                 backdrop: true
                    //             });
                    //         }
                    //     });


                    //     $('#btn_simulasi').bind( "click", function() {
                    //         console.log("SIMULASI LANGKAH!");
                    //         if($(this).hasClass('btn-secondary')){
                    //             if(generated){
                    //                 var i=1;

                    //                 function simulasikan(markers, i) {  
                    //                     if(i<markers.length && !stop_simulasi){
                    //                         map.setZoom(19);
                    //                         map.panTo(markers[i].position);
                    //                         google.maps.event.trigger(markers[i], 'mouseover');
                    //                         $('#plg_dipilih').html('Pelanggan dipilih: <span class="text-primary">'+markers[i].title+'</span>');
                    //                         markers[i].setIcon("../controller/getMarkerIcon.php?color=green-darker&text="+(markers[i].urutan));
                    //                         markers[i].setAnimation(google.maps.Animation.BOUNCE);
                    //                         setTimeout(function() {   //  call a 3s setTimeout when the loop is called
                    //                             console.log('urutan', markers[i].urutan);
                    //                             markers[i].setIcon("../controller/getMarkerIcon.php?color=blue&text="+(markers[i].urutan));              //  increment the counter
                    //                             markers[i].setAnimation(null);
                    //                             if (i < markers.length) {           //  if the counter < 10, call the loop function
                    //                               simulasikan(markers, i+1);             //  ..  again which will trigger another 
                    //                             }                       //  ..  setTimeout()
                    //                         }, 400);
                    //                     }else{
                    //                         // map                    
                    //                         // .wait(2000) // to let you appreciate the current zoom & center
                    //                         // .fit();
                    //                         map.setZoom(18);
                    //                         //map.panTo(markers[0].position);
                    //                         stop_simulasi = false;
                    //                         $('#plg_dipilih').html("");
                    //                     }
                    //                 }

                    //                 $(this).removeClass('btn-secondary');
                    //                 $(this).addClass('btn-danger');
                    //                 $(this).html('Stop <span class="btn-icon-right"><i class="fa fa-stop-circle"></i></span>');

                    //                 simulasikan(markers, 0); 

                    //             }else{
                    //                 bootbox.alert({
                    //                     message: "Silahkan tentukan titik awal dan titik akhir rute!",
                    //                     backdrop: true
                    //                 });
                    //             }
                    //         }else{
                    //             stop_simulasi = true;
                    //             $(this).removeClass('btn-danger');
                    //             $(this).addClass('btn-secondary');
                    //             $(this).html('Simulasikan <span class="btn-icon-right"><i class="fa fa-gears"></i></span>');
                    //         }
                    //     });


                    //     $('#btn_create').bind( "click", function() {
                    //         console.log("SIMPAN LANGKAH!");
                    //         if(generated){

                    //             bootbox.confirm({
                    //                 title: "Simpan Data",
                    //                 message: "Apakah anda yakin menyimpan urut langkah ini ?", 
                    //                 buttons: {
                    //                     cancel: {
                    //                         className: 'btn-light',
                    //                         label: '<i class="fa fa-times"></i> Batal'
                    //                     },
                    //                     confirm: {
                    //                         className: 'btn-primary',
                    //                         label: '<i class="fa fa-check"></i> Ya, Simpan'
                    //                     }
                    //                 },
                    //                 callback: function (result) {
                    //                     if(result){

                    //                         function simpanRPP(datas, i, progress, petugas, rpp){

                    //                             if(i<datas.length){

                    //                                 var valeur = parseInt((i / datas.length)*100);
                    //                                 var marker = datas[i];

                    //                                 $($(progress).find('.progress-bar')[0]).css('width', valeur+'%').attr('aria-valuenow', valeur);
                    //                                 $($(progress).find('.msg')[0]).html('Menyimpan idpel '+marker.idpel+' ke RPP <span class="text-success">'+rpp+'</span> Urut Langkah ke-<span class="text-success">'+marker.urutan+'</span>...');

                    //                                 $.post('../controller/pemeriksaan_lpb/simpanRPP.php', 
                    //                                 { petugas: petugas, rpp: rpp, urutan: marker.urutan, idpel:marker.idpel }, 
                    //                                 function(res){
                    //                                     console.log('res',res);
                    //                                     if(res.success=='true' || res.success){
                    //                                         marker.setIcon(red_house);
                    //                                         marker.setMap(null);
                    //                                         //markers.splice(i, 1);
                    //                                     }
                    //                                     simpanRPP(datas, i+1, dialog, petugas, rpp);
                    //                                 }).fail(function() { 
                    //                                     simpanRPP(datas, i+1, dialog, petugas, rpp);
                    //                                 });

                    //                             }else{

                    //                                 $($(progress).find('.progress-bar')[0]).css('width', '100%').attr('aria-valuenow', 100);
                    //                                 //populateList(selected);
                    //                                 // if(selected.length>0){
                    //                                 //     $('#btn_reset').prop('disabled', false);
                    //                                 //     $('#btn_remove').prop('disabled', false);
                    //                                 //     $('#btn_create').prop('disabled', false);
                    //                                 // }
                    //                                 markers=null;
                    //                                 $('#btn_generate').prop('disabled', true);
                    //                                 $('#btn_simulasi').prop('disabled', true);
                    //                                 $('#btn_create').prop('disabled', true);
                    //                                 $('#plg_start').html("Pelanggan X");
                    //                                 $('#plg_end').html("Pelanggan Y");
                    //                                 $('#total_plg').html("");
                    //                                 progress.modal('hide');

                    //                             }

                    //                         }

                    //                         var dialog = bootbox.dialog({ 
                    //                             message: '<div id="proses" class="card"><div class="card-body"><div class="d-flex justify-content-between progress-label mb-2"><span class="msg">Menyimpan RPP...</span></div><div class="progress progress--medium"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div></div></div>', 
                    //                             closeButton: false 
                    //                         });

                    //                         console.log('dialog', dialog);
                    //                         var petugas_dipilih = $('#sel_petugas').val();
                    //                         var rpp = $('#sel_rpp').val();

                    //                         simpanRPP(markers, 0, dialog, petugas_dipilih, rpp);
                    //                     }
                    //                 }
                    //             });

                    //         }else{
                    //             bootbox.alert("Silahkan lengkapi urutan terlebih dahulu!");
                    //             return false;
                    //         }
                    //     });

                    //     $(document).on("click", "a.start-here", function(e){
                    //         e.preventDefault();
                    //         var idpel = $(this).data('idpel');
                    //         var marker = $.grep(markers, function(e) { return e.idpel==idpel })[0];

                    //         bootbox.confirm({
                    //             title: "Tentukan titik mulai",
                    //             message: "Apakah anda yakin akan memulai urut langkah dari titik ini ("+marker.title+") ?", 
                    //             buttons: {
                    //                 cancel: {
                    //                     className: 'btn-light',
                    //                     label: '<i class="fa fa-times"></i> Batal'
                    //                 },
                    //                 confirm: {
                    //                     className: 'btn-primary',
                    //                     label: '<i class="fa fa-check"></i> Ya, Mulai dari sini'
                    //                 }
                    //             },
                    //             callback: function (result) {
                    //                 if(result){

                    //                     if(start!=null){
                    //                         start.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                    //                         start.start_end = false;
                    //                         start = null;
                    //                         $('#plg_start').html("X");
                    //                     }

                    //                     $('div.content-body').block({ message: 'Menetapkan ulang urutan...' });
                    //                     asyncForEach(markers, function(marker) {
                    //                         marker.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                    //                         marker.urutan = null;
                    //                         marker.start_end = false;
                    //                     },function() {
                    //                         $('div.content-body').unblock();
                    //                     });

                    //                     marker.setIcon("../controller/getMarkerIcon.php?color=blue&text=START");
                    //                     start = marker;
                    //                     marker.urutan=1;
                    //                     marker.start_end = true;
                    //                     $('#plg_start').html(marker.idpel);
                    //                     $('#plg_end').html("Pelanggan Y");
                    //                     end = null;
                    //                     generated = false;

                    //                     $('#btn_generate').prop('disabled', true);
                    //                     $('#btn_simulasi').prop('disabled', true);
                    //                     $('#btn_create').prop('disabled', true);
                    //                 }
                    //                 infowindow.close();
                    //             }
                    //         });

                    //     });

                    //     $(document).on("click", "a.end-here", function(e){
                    //         e.preventDefault();
                    //         var idpel = $(this).data('idpel');
                    //         var marker = $.grep(markers, function(e) { return e.idpel==idpel })[0];

                    //         if(start!=null){

                    //             bootbox.confirm({
                    //                 title: "Tentukan titik akhir",
                    //                 message: "Apakah anda yakin akan mengakhiri urut langkah di titik ini ("+marker.title+") ?", 
                    //                 buttons: {
                    //                     cancel: {
                    //                         className: 'btn-light',
                    //                         label: '<i class="fa fa-times"></i> Batal'
                    //                     },
                    //                     confirm: {
                    //                         className: 'btn-primary',
                    //                         label: '<i class="fa fa-check"></i> Ya, Akhiri di sini'
                    //                     }
                    //                 },
                    //                 callback: function (result) {
                    //                     if(result){

                    //                         if(end!=null){
                    //                             end.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                    //                             end.start_end = false;
                    //                             end = null;
                    //                             $('#plg_end').html("X");
                    //                         }

                    //                         marker.setIcon("../controller/getMarkerIcon.php?color=blue&text=END");
                    //                         end = marker;
                    //                         marker.urutan=markers.length;
                    //                         marker.start_end = true;
                    //                         $('#plg_end').html(marker.idpel);


                    //                         $('#btn_generate').prop('disabled', false);
                    //                     }

                    //                     infowindow.close();
                    //                 }
                    //             });
                    //         }else{
                    //             bootbox.alert("Silahkan tentukan titik awal terlebih dahulu!");
                    //         }

                    //     });

                    //     $(document).on("click", "a.ganti-urutan", function(e){
                    //         e.preventDefault();
                    //         var idpel = $(this).data('idpel');
                    //         var marker = $.grep(markers, function(e) { return e.idpel==idpel })[0];

                    //         function array_move(arr, old_index, new_index) {
                    //             if (new_index >= arr.length) {
                    //                 var k = new_index - arr.length + 1;
                    //                 while (k--) {
                    //                     arr.push(undefined);
                    //                 }
                    //             }
                    //             arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
                    //             return arr; // for testing
                    //         }

                    //         if(marker.urutan==null){
                    //             bootbox.alert("Silahkan tentukan titik awal dan generate langkah terlebih dahulu!");
                    //         }else{
                    //             bootbox.prompt({
                    //                 title: "Ganti Urutan",
                    //                 message: "Silahkan isi urutan yang dikehendaki untuk Idpel "+idpel, 
                    //                 required: true,
                    //                 inputType: 'number',
                    //                 value: marker.urutan,
                    //                 callback: function (result) {
                    //                     if(result){

                    //                         markers[result-1].setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                    //                         markers[result-1].urutan = null;
                    //                         markers = array_move(markers, marker.urutan-1, result-1); 
                    //                         markers[result-1].urutan = result;

                    //                         $('div.content-body').block({ message: 'Menetapkan ulang urutan...' });
                    //                         asyncForEach(markers, function(marker) {
                    //                             if(marker.urutan>result){
                    //                                 marker.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                    //                                 marker.urutan = null;
                    //                             }
                    //                             i++;
                    //                         },function() {
                    //                             $('div.content-body').unblock();
                    //                         });

                    //                         console.log('markers[result-1]',markers[result-1]);
                    //                         console.log('result-1',result-1);

                    //                         sortUrutan(markers, markers[result-1], end, result-1);

                    //                         $('div.content-body').block({ message: 'Memberikan Urutan baru...' });
                    //                         var i=1;
                    //                         asyncForEach(markers, function(marker) {
                    //                             marker.setIcon("../controller/getMarkerIcon.php?color=blue&text="+(marker.urutan));
                    //                             //marker.urutan=i;
                    //                             i++;
                    //                         },function() {
                    //                             generated = true;
                    //                             $('div.content-body').unblock();
                    //                         });
                    //                     }
                    //                 }
                    //             });

                    //         }


                    //         infowindow.close();
                    //     });

                    // })
                    // .on('click', function (marker) {
                    //     if(marker){

                    //         var contentString = `
                    //             <ul id="context-menu" class="list-group m-2">
                    //                 <li class="list-group-item d-flex justify-content-between align-items-center">
                    //                     <a href="#" class="start-here" data-idpel="`+marker.idpel+`">Mulai dari sini</a>
                    //                 </li>
                    //                 <li class="list-group-item d-flex justify-content-between align-items-center">
                    //                     <a href="#" class="end-here" data-idpel="`+marker.idpel+`">Akhiri di sini</a>
                    //                 </li>
                    //                 <li class="list-group-item d-flex justify-content-between align-items-center">
                    //                     <a href="#" class="ganti-urutan" data-idpel="`+marker.idpel+`">Ganti Urutan</a>
                    //                 </li>
                    //             </ul>`;

                    //         infowindow.setContent(contentString);

                    //         infowindow.open({
                    //           anchor: marker,
                    //           map,
                    //         });

                    //         // if(start==null && !marker.start_end){
                    //         //     marker.setIcon("../controller/getMarkerIcon.php?color=blue&text=START");
                    //         //     start = marker;
                    //         //     marker.urutan=1;
                    //         //     marker.start_end = true;
                    //         //     $('#plg_start').html(marker.idpel);
                    //         // }else if(end==null && !marker.start_end){
                    //         //     marker.setIcon("../controller/getMarkerIcon.php?color=blue&text=END");
                    //         //     end = marker;
                    //         //     //marker.urutan=markers.length;
                    //         //     marker.start_end = true;
                    //         //     $('#plg_end').html(marker.idpel);
                    //         // }
                    //         // else if(start.idpel==marker.idpel){
                    //         //     marker.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                    //         //     start = null;
                    //         //     marker.start_end = false;
                    //         //     $('#plg_start').html("X");
                    //         // }else if(end.idpel==marker.idpel){
                    //         //     marker.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                    //         //     end = null;
                    //         //     marker.start_end = false;
                    //         //     $('#plg_end').html("Y");
                    //         // }
                    //     }
                    //   })
                    .wait(2000) // to let you appreciate the current zoom & center
                    .fit();

                // var markerCluster = new MarkerClusterer(map, markers, {
                //     imagePath:
                //       "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
                //     maxZoom: 20,
                //     //averageCenter: true,
                //   });

            }else{

                bootbox.alert({
                    message: "Gagal meload data RPP!",
                    backdrop: true
                });
                $('div.content-body').unblock();
            }
        }).fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        }).always(function() {
            console.log( "complete" );
        });

    });


    function asyncForEach(arr, cb, done) {
      (function next(i) {
        if(i >= arr.length) {
           if(done) done();
           return;
        }
        let stop = i + 1000;
        setTimeout(next, 0, stop); // a small trick to defer actions
        while(i < arr.length && i < stop)
          cb(arr[i], i++, arr);
      })(0);
    }


});
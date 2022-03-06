$(document).ready(function () {

    "use strict";
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    
    
    var red_house = "../../assets/images/markers/red/house.png";
    var blue_house = "../../assets/images/markers/blue/house.png";
    var ic_gardu = "../../assets/images/markers/green/powersubstation.png";
    var selected = new Array();
    var deleted = new Array();
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
                    //console.log('semua petugas');
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
                    //console.log('rpp', urlParams.get('rpp'));

                    setTimeout(function(){ $('#btn_cari').trigger('click'); }, 500);
                }
                else{
                    $('#sel_rpp').selectpicker('val', "00");
                    //console.log('semua petugas');
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
    infowindow.addListener('closeclick', function(){
        $('#plg_dipilih').empty();
        $('#info_tagging').empty();
    });

    $('#btn_cari').click(function(){

        $('div.content-body').block({ message: 'Mengambil data pelanggan pada RPP '+$('#sel_rpp').val()+'...' });
        //console.log('cari!!');
        // //console.log($("#tgl_baca_to").datepicker("getFormattedDate"));
        // //console.log($("#tgl_baca_from").datepicker("getFormattedDate"));
        $('#btn_generate').prop('disabled', true);
        $('#btn_simulasi').prop('disabled', true);
        $('#btn_create').prop('disabled', true);

        $('#map').gmap3({
            action: 'destroy'
        });

        selected = new Array();
        deleted = new Array();
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

                var markers_resp = new Array();
                var urutan, urutan_txt, color;

                $(json.rpp).each(function(key, obj){

                    if(obj.urutan>0){
                        urutan = obj.urutan;
                        urutan_txt = obj.urutan;
                        color = 'green-darker';
                        generated = true;
                    }else{
                        urutan = null;
                        urutan_txt = '..';
                        color = 'red';
                    }

                    markers_resp.push(
                        {
                            title: obj.idpel+" ( "+obj.nama+" ) ", 
                            tgl_tagging: obj.tgl_tagging_time,
                            position:[obj.latitude, obj.longitude], 
                            icon: "../controller/getMarkerIcon.php?color="+color+"&text="+urutan_txt,
                            idpel: obj.idpel,
                            rpp: obj.rpp,
                            petugas: obj.petugas,
                            urutan: urutan,
                            info_tagging: obj.petugas_priangan+" ( Tgl "+obj.tgl_tagging+" ) ",
                            start_end: false
                        });
                });

                // var gardu_markers = new Array(); 

                // $(json.gardu).each(function(key, obj){
                //     // //console.log(obj);
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
                  .marker(markers_resp)
                    .then(function (markers) {

                        var map = this.get()[0];
                        markers = markers;
                        //console.log("map then", map);
                        
                        $('#btn_generate').prop('disabled', false);
                        $('#btn_simulasi').prop('disabled', false);
                        $('#btn_create').prop('disabled', false);

                        $('#total_plg').html("("+markers.length+" plg)");
                        $('#jml_plg_dihapus').empty();
                          
                        map.enableKeyDragZoom({
                            noZoom: true,
                            visualEnabled: false,
                        });

                        var dz = map.getDragZoomObject();

                        google.maps.event.addListener(dz, 'dragstart', function (latlng) {
                            //console.log('KeyDragZoom Started: ' + latlng);
                        });

                        google.maps.event.addListener(dz, 'dragend', function (bnds) {
                            //console.log('KeyDragZoom Ended: ' + bnds);
                            //console.log(bnds);
                            //console.log(bnds.getSouthWest());

                            var GLOBE_WIDTH = 256; // a constant in Google's map projection
                            var west = bnds.getSouthWest().lng();
                            var east = bnds.getNorthEast().lng();
                            var angle = east - west;
                            if (angle < 0) {
                              angle += 360;
                            }
                            var pixelWidth = $('div#map').width();
                            var zoom = Math.round(Math.log(pixelWidth * 360 / angle / GLOBE_WIDTH) / Math.LN2);

                            //console.log('zoom', zoom);

                            if(zoom>=10){

                                $('div.content-body').block({ message: 'Memilih koordinat...' });
                                var urutan, urutan_txt, color;
                                asyncForEach(markers, function(marker) {

                                    if(marker.getPosition()){
                                        if (bnds.contains(marker.getPosition())) {
                                            ////console.log('marker dalam pilihan', marker);
                                            
                                            //if(!marker.selected){
                                            if(!marker.selected){

                                                if(marker.urutan>0){
                                                    urutan = marker.urutan;
                                                    urutan_txt = marker.urutan;
                                                    color = 'blue';
                                                }else{
                                                    urutan = null;
                                                    urutan_txt = '..';
                                                    color = 'red';
                                                }

                                                marker.setIcon("../controller/getMarkerIcon.php?color="+color+"&text="+urutan_txt);
                                                marker.selected = true;
                                                selected.push(marker);
                                                // $('#jml_plg_dipilih').html("Jumlah Pelanggan dipilih: <span class='text-primary'>"+selected.length+'</span>');
                                            }

                                            // }else{
                                            //     marker.setIcon(red_house);
                                            //     marker.selected = false;
                                            //     $('#plg_dipilih').html(selected.length);

                                            // }
                                        }
                                    }
                                  //marker.setIcon("http://maps.google.com/mapfiles/marker_green.png");
                                },function(){
                                    if(selected.length>0){

                                        bootbox.confirm({
                                            title: "Hapus Koordinat?",
                                            message: "Apakah anda yakin akan menghapus "+selected.length+" titik koordinat dari Peta?", 
                                            backdrop: false,
                                            buttons: {
                                                cancel: {
                                                    className: 'btn-light',
                                                    label: '<i class="fa fa-times"></i> Batal'
                                                },
                                                confirm: {
                                                    className: 'btn-danger',
                                                    label: '<i class="fa fa-check"></i> Ya, Hapus'
                                                }
                                            },
                                            callback: function (result) {
                                                if(result){
                                                    $('div.content-body').block({ message: 'Menghapus koordinat pelanggan yang dipilih...' });
                                                    asyncForEach(selected, function(marker) {
                                                        if(marker.selected){

                                                            marker.selected = false;
                                                            marker.setMap(null);
                                                            //selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                            selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                            markers = $.grep(markers, function(e) { return e.idpel!=marker.idpel });
                                                            
                                                            deleted.push(marker.idpel);
                                                            $('#jml_plg_dihapus').html("Jumlah Pelanggan dihapus: "+deleted.length);
                                                            $('#total_plg').html("("+markers.length+" plg)");
                                                        }
                                                    },function() {
                                                        
                                                        $('div.content-body').unblock();

                                                        bootbox.alert("Proses hapus selesai, silahkan melakukan pengurutan ulang jika diperlukan!");
                                                        // sortUrutan(markers, markers[0], markers[markers.length-1], 1);

                                                        // $('div.content-body').block({ message: 'Memberikan Urutan baru...' });
                                                        // var i=1;
                                                        // asyncForEach(markers, function(marker) {
                                                        //     marker.setIcon("../controller/getMarkerIcon.php?color=green-darker&text="+(marker.urutan));
                                                        //     //marker.urutan=i;
                                                        //     i++;
                                                        // },function() {
                                                        //     generated = true;
                                                        //     $('div.content-body').unblock();
                                                        // });

                                                    });
                                                }else{
                                                    var urutan, urutan_txt, color;
                                                    asyncForEach(selected, function(marker) {
                                                        if(marker.selected){
                                                            //console.log(marker);
                                                            if(marker.urutan>0){
                                                                urutan = marker.urutan;
                                                                urutan_txt = marker.urutan;
                                                                color = 'green-darker';
                                                            }else{
                                                                urutan = null;
                                                                urutan_txt = '..';
                                                                color = 'red';
                                                            }
                                                            
                                                            marker.setIcon("../controller/getMarkerIcon.php?color="+color+"&text="+urutan_txt);
                                                            marker.selected = false;
                                                            selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                            
                                                        }
                                                    },function() {

                                                    });
                                                }
                                            }
                                        });

                                    }
                                    $('div.content-body').unblock();
                
                                });
                            }else{
                                bootbox.alert("Rentang pilihan terlalu jauh!");
                                return false;
                            }

                        });


                        if(is_first){

                            const directionsService = new google.maps.DirectionsService();
                            const directionsRenderer = new google.maps.DirectionsRenderer();
                            const distanceMatrixService = new google.maps.DistanceMatrixService();
                            directionsRenderer.setMap(map);

                            function chunkArrayInGroups(arr, size) {
                              var myArray = [];
                              for(var i = 0; i < arr.length; i += size) {
                                myArray.push(arr.slice(i, i+size));
                              }
                              return myArray;
                            }


                            function generateByDirectionService(directionsService, directionsRenderer, waypts_chunks, i) {  

                                const waypts = [];
                                for (let j = 1; j < waypts_chunks[i].length-1; j++) {
                                    //if (!waypts_chunks[i][j].start_end) {
                                      waypts.push({
                                        location: waypts_chunks[i][j].position,
                                        stopover: true,
                                      });
                                    //}
                                }
                                //console.log('waypts', waypts);

                                setTimeout(function() { 

                                    directionsService
                                    .route({
                                      origin: waypts_chunks[i][0].position,
                                      destination: waypts_chunks[i][waypts_chunks[i].length-1].position,
                                      waypoints: waypts,
                                      optimizeWaypoints: true,
                                      travelMode: google.maps.TravelMode.WALKING,
                                    })
                                    .then((response) => {
                                        //console.log('response', response.routes[0].waypoint_order);
                                        // if(first){
                                        //     directionsRenderer.setDirections(response);
                                        //     first = false;
                                        // }
                                        markers[(i*25)].setIcon("../controller/getMarkerIcon.php?color=green&text="+((i*25)+1));
                                        markers[(i*25)].urutan=(i*25)+1;
                                        markers[(i*25)+waypts_chunks[i].length-1].setIcon("../controller/getMarkerIcon.php?color=green&text="+((i*25)+waypts_chunks[i].length));
                                        markers[(i*25)+waypts_chunks[i].length-1].urutan=(i*25)+waypts_chunks[i].length;
                                        $.each(response.routes[0].waypoint_order, function(idx, urut){
                                            ////console.log(i, urut);
                                            markers[(i*25)+(urut+1)].setIcon("../controller/getMarkerIcon.php?color=green&text="+((i*25)+(urut+2)));
                                            markers[(i*25)+(urut+1)].urutan=(i*25)+(urut+2);
                                        });

                                      const route = response.routes[0];
                                      const summaryPanel = $('.urut-langkah');

                                      //summaryPanel.innerHTML = "";

                                      // For each route, display summary information.
                                      for (let i = 0; i < route.legs.length; i++) {
                                        const routeSegment = i + 1;

                                        summaryPanel.innerHTML +=
                                          "<b>Route Segment: " + routeSegment + "</b><br>";
                                        summaryPanel.innerHTML += route.legs[i].start_address + " to ";
                                        summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
                                        summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
                                      }
                                    })
                                    .catch((e) => window.alert("Directions request failed due to " + status));
          

                                    if (i < waypts_chunks.length) {           //  if the counter < 10, call the loop function
                                      generateByDirectionService(directionsService, directionsRenderer, waypts_chunks, i+1);             //  ..  again which will trigger another 
                                    }                       //  ..  setTimeout()
                                }, 2000)
                            }


                            function calculateAndDisplayRoute(datas, directionsService, directionsRenderer) {
                                
                                var waypts_chunks = chunkArrayInGroups(datas, 25);
                                //console.log('waypts_chunks', waypts_chunks);

                                const summaryPanel = $('.urut-langkah');
                                var first = true;

                                summaryPanel.innerHTML = "";

                                generateByDirectionService(directionsService, directionsRenderer, waypts_chunks, 0);

                            }

                            function find_closest_markers(start) {
                                var markers_distances = [];
                                var before = start;
                                $('div.content-body').block({ message: 'Mengkalkulasi jarak dan mengurutkan titik koordinat...' });
                                for (var i = 0; i < markers.length; i++) {
                                    // if(!markers[i].start_end){
                                        var d = google.maps.geometry.spherical.computeDistanceBetween(before.position, markers[i].position);
                                        // var d = turf.distance(
                                        //     turf.point([start.position.lat(), start.position.lng()]), 
                                        //     turf.point([markers[i].position.lat(), markers[i].position.lng()]), 
                                        //     {units: 'miles'});
                                        markers_distances[i] = {
                                            distance: d, 
                                            marker: markers[i]
                                        }
                                        markers[i].jarak = d;
                                    // }
                                }

                                var closest_markers = markers_distances.sort((a, b) => {return a.distance-b.distance})
                                $('div.content-body').unblock();

                                return closest_markers.map((item) => {return item.marker})
                            }

                            function sortUrutan(datas, mulai, akhir, idx) {
                                
                                if(idx<datas.length){
                                    if(idx==0)
                                        $('div.content-body').block({ message: 'Mengkalkulasi jarak dan mengurutkan titik koordinat...' });
                                    
                                    //console.log('cek jarak ke-'+idx, mulai.title+' urutan ke-'+mulai.urutan);
                                    var jarak, jarak_sebelumnya, closest_idx;
                                    for (var i = 0; i < datas.length; i++) {

                                        // if(datas[i].idpel==start.idpel){
                                        //     datas[i].urutan=1;
                                        //     datas[i].start_end=true;
                                        // }

                                        // if(datas[i].idpel==end.idpel){
                                        //     datas[i].urutan=datas.length;
                                        //     datas[i].start_end=true;
                                        // }

                                        if(datas[i].urutan==null){
                                            jarak = google.maps.geometry.spherical.computeDistanceBetween(mulai.position, datas[i].position);
                                            
                                            if(jarak_sebelumnya==null){
                                                jarak_sebelumnya = jarak;
                                                closest_idx = i;
                                            }else if(jarak<jarak_sebelumnya){
                                                jarak_sebelumnya = jarak;
                                                closest_idx = i;
                                            }

                                        }
                                    }
                                    if(closest_idx!=null){
                                        datas[closest_idx].urutan = idx+2;
                                        //console.log('titik terdekat '+closest_idx, datas[closest_idx].title);
                                        sortUrutan(datas, datas[closest_idx], end, idx+1);
                                    }else{
                                        sortUrutan(datas, datas[0], end, datas.length);
                                    }
                                }else{
                                    //mulai.urutan = datas.length;
                                    //console.log('Selesai mengurutkan');
                                    datas = datas.sort((a, b) => {return a.urutan-b.urutan});
                                    //console.log('datas dalam', datas);
                                    $('div.content-body').unblock();

                                }
                            }


                            $('#btn_generate').bind( "click", function() {
                                //console.log("GENERATE LANGKAH!");
                                bootbox.dialog({
                                    title: 'Pilih Metode Pengurutan',
                                    message: "Silahkan pilih metode pengurutan: <ul><li><span class='text-primary'><b>Jarak Terdekat:</b></span> Diurutkan berdasarkan jarak terdekat antar titik</li><li><span class='text-primary'><b>Tgl Tagging:</b></span> Diurutkan berdasarkan tanggal tagging App Priangan (Titik awal dan akhir akan diabaikan)</li></ul>",
                                    //size: 'small',
                                    buttons: {
                                        tgl_tagging: {
                                            label: "Tanggal Tagging",
                                            className: 'btn-warning',
                                            callback: function(){
                                                markers = markers.sort((a,b) => (a.tgl_tagging > b.tgl_tagging) ? 1 : ((b.tgl_tagging > a.tgl_tagging) ? -1 : 0));
                                                //console.log('urut tgl tagging', markers);
                                                //calculateAndDisplayRoute(markers, directionsService, directionsRenderer);
                                                
                                                $('div.content-body').block({ message: 'Memberikan Urutan...' });
                                                var i=1;
                                                asyncForEach(markers, function(marker) {
                                                    marker.setIcon("../controller/getMarkerIcon.php?color=green-darker&text="+(i));
                                                    marker.urutan=i;
                                                    i++;
                                                },function() {
                                                    $('div.content-body').unblock();

                                                    $('#btn_generate').prop('disabled', false);
                                                    $('#btn_simulasi').prop('disabled', false);
                                                    $('#btn_create').prop('disabled', false);

                                                    start = null;
                                                    end = null;
                                                    generated = true;
                                                });
                                            }
                                        },
                                        jarak: {
                                            label: "Jarak Terdekat",
                                            className: 'btn-primary',
                                            callback: function(){
                                                
                                                if(start!=null && end!=null){
                                                    //calculateAndDisplayRoute(directionsService, directionsRenderer);
                                                    //markers = find_closest_markers(start);
                                                    sortUrutan(markers, start, end, 0);
                                                    //console.log('closest_markers', markers);
                                                    //calculateAndDisplayRoute(markers, directionsService, directionsRenderer);
                                                    
                                                    $('div.content-body').block({ message: 'Memberikan Urutan...' });
                                                    var i=1;
                                                    asyncForEach(markers, function(marker) {
                                                        marker.setIcon("../controller/getMarkerIcon.php?color=green-darker&text="+(marker.urutan));
                                                        //marker.urutan=i;
                                                        i++;
                                                    },function() {
                                                        $('div.content-body').unblock();

                                                        $('#btn_generate').prop('disabled', false);
                                                        $('#btn_simulasi').prop('disabled', false);
                                                        $('#btn_create').prop('disabled', false);

                                                        start = null;
                                                        end = null;
                                                        generated = true;
                                                    });

                                                }else{
                                                    bootbox.alert({
                                                        message: "Silahkan tentukan titik awal dan titik akhir rute!",
                                                        backdrop: true
                                                    });
                                                }

                                            }
                                        },
                                    }
                                });

                            });


                            $('#btn_simulasi').bind( "click", function() {
                                //console.log("SIMULASI LANGKAH!");
                                var btn = $(this);
                                if(btn.hasClass('btn-secondary')){
                                    if(generated){
                                        var i=1;

                                        function simulasikan(markers, i, delay) {  
                                            if(i<markers.length && !stop_simulasi){
                                                map.setZoom(19);
                                                map.panTo(markers[i].position);
                                                google.maps.event.trigger(markers[i], 'mouseover');
                                                $('#plg_dipilih').html('Pelanggan dipilih: <span class="text-primary">'+markers[i].title+'</span>');
                                                $('#info_tagging').html('Info Tagging: <span class="text-primary">'+markers[i].info_tagging+'</span>');
                                                markers[i].setIcon("../controller/getMarkerIcon.php?color=green&text="+(markers[i].urutan));
                                                markers[i].setAnimation(google.maps.Animation.BOUNCE);
                                                setTimeout(function() {   //  call a 3s setTimeout when the loop is called
                                                    //console.log('urutan', markers[i].urutan);
                                                    markers[i].setIcon("../controller/getMarkerIcon.php?color=green-darker&text="+(markers[i].urutan));              //  increment the counter
                                                    markers[i].setAnimation(null);
                                                    if (i < markers.length) {           //  if the counter < 10, call the loop function
                                                      simulasikan(markers, i+1, delay);             //  ..  again which will trigger another 
                                                    }                       //  ..  setTimeout()
                                                }, delay);
                                            }else{
                                                // map                    
                                                // .wait(2000) // to let you appreciate the current zoom & center
                                                // .fit();
                                                map.setZoom(18);
                                                //map.panTo(markers[0].position);
                                                stop_simulasi = false;
                                                $('#plg_dipilih').html("");

                                                btn.removeClass('btn-danger');
                                                btn.addClass('btn-secondary');
                                                btn.html('Simulasikan <span class="btn-icon-right"><i class="fa fa-gears"></i></span>');
                                            }
                                        }

                                        btn.removeClass('btn-secondary');
                                        btn.addClass('btn-danger');
                                        btn.html('Stop <span class="btn-icon-right"><i class="fa fa-stop-circle"></i></span>');

                                        markers = markers.sort((a, b) => {return a.urutan-b.urutan});

                                        bootbox.dialog({ 
                                            title: 'Simulasi Urut Langkah',
                                            message: '<p>Silahkan pilih kecepatan perpindahan titik pada saat Simulasi</p>',
                                            //size: 'large',
                                            onEscape: true,
                                            backdrop: true,
                                            buttons: {
                                                slow: {
                                                    label: 'Lambat',
                                                    className: 'btn-danger',
                                                    callback: function(){
                                                        simulasikan(markers, 0, 1500); 
                                                    }
                                                },
                                                medium: {
                                                    label: 'Sedang',
                                                    className: 'btn-warning',
                                                    callback: function(){
                                                        simulasikan(markers, 0, 1000); 
                                                    }
                                                },
                                                fast: {
                                                    label: 'Cepat',
                                                    className: 'btn-success',
                                                    callback: function(){
                                                        simulasikan(markers, 0, 600); 
                                                                        
                                                    }
                                                }
                                            }
                                        });


                                    }else{
                                        bootbox.alert({
                                            message: "Silahkan lakukan generate langkah terlebih dahulu!",
                                            backdrop: true
                                        });
                                    }
                                }else{
                                    stop_simulasi = true;
                                    btn.removeClass('btn-danger');
                                    btn.addClass('btn-secondary');
                                    btn.html('Simulasikan <span class="btn-icon-right"><i class="fa fa-gears"></i></span>');
                                }
                            });


                            $('#btn_create').bind( "click", function() {
                                //console.log("SIMPAN LANGKAH!");
                                if(generated){

                                    bootbox.confirm({
                                        title: "Simpan Data",
                                        message: "Apakah anda yakin menyimpan urut langkah ini ?", 
                                        buttons: {
                                            cancel: {
                                                className: 'btn-light',
                                                label: '<i class="fa fa-times"></i> Batal'
                                            },
                                            confirm: {
                                                className: 'btn-primary',
                                                label: '<i class="fa fa-check"></i> Ya, Simpan'
                                            }
                                        },
                                        callback: function (result) {
                                            if(result){

                                                function simpanRPP(datas, i, progress, petugas, rpp){

                                                    if(i<datas.length){

                                                        var valeur = parseInt((i / datas.length)*100);
                                                        var marker = datas[i];

                                                        $($(progress).find('.progress-bar')[0]).css('width', valeur+'%').attr('aria-valuenow', valeur);
                                                        $($(progress).find('.msg')[0]).html('Menyimpan idpel '+marker.idpel+' ke RPP <span class="text-success">'+rpp+'</span> Urut Langkah ke-<span class="text-success">'+marker.urutan+'</span>...');

                                                        $.post('../controller/pemeriksaan_lpb/simpanRPP.php', 
                                                        { petugas: petugas, rpp: rpp, urutan: marker.urutan, idpel:marker.idpel }, 
                                                        function(res){
                                                            //console.log('res',res);
                                                            if(res.success=='true' || res.success){
                                                                marker.setIcon(red_house);
                                                                marker.setMap(null);
                                                                //markers.splice(i, 1);
                                                                markers = $.grep(markers, function(e) { return e.idpel!=marker.idpel });
                                                                $('#total_plg').html("("+markers.length+" plg)");
                                                            }
                                                            simpanRPP(datas, i+1, dialog, petugas, rpp);
                                                        }).fail(function() { 
                                                            simpanRPP(datas, i+1, dialog, petugas, rpp);
                                                        });

                                                    }else{

                                                        $($(progress).find('.progress-bar')[0]).css('width', '100%').attr('aria-valuenow', 100);
                                                        //populateList(selected);
                                                        // if(selected.length>0){
                                                        //     $('#btn_reset').prop('disabled', false);
                                                        //     $('#btn_remove').prop('disabled', false);
                                                        //     $('#btn_create').prop('disabled', false);
                                                        // }
                                                        markers=null;
                                                        $('#btn_generate').prop('disabled', true);
                                                        $('#btn_simulasi').prop('disabled', true);
                                                        $('#btn_create').prop('disabled', true);
                                                        $('#plg_start').html("Pelanggan X");
                                                        $('#plg_end').html("Pelanggan Y");
                                                        $('#total_plg').html("");
                                                        progress.modal('hide');

                                                        if(deleted.length>0){

                                                            progress = bootbox.dialog({ 
                                                                message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Mengupdate RPP untuk titik pelanggan yang dihapus...</div>', 
                                                                closeButton: false 
                                                            });
                                                            console.log('deleted', deleted);

                                                            $.post('../controller/pemeriksaan_lpb/batchHapusRPP.php', 
                                                            { petugas: petugas, rpp: rpp, idpels:deleted.join(',') }, 
                                                            function(res){

                                                                console.log('res deleted',res);
                                                                if(res.success=='true' || res.success){
                                                                    bootbox.alert("Selesai menyimpan dan menghapus data!");
                                                                    deleted = $.grep(deleted, function(e) { return !res.idpels.includes(e) }); 
                                                                    $("#jml_plg_dihapus").html("Jumlah Pelanggan dihapus: "+deleted.length);
                                                                }
                                                                
                                                                progress.modal('hide');
                                                                bootbox.hideAll();

                                                            }).fail(function() { 
                                                                progress.modal('hide');
                                                                bootbox.alert("Gagal menghapus data!");
                                                            });
                                                        }

                                                    }

                                                }

                                                var dialog;
                                                //console.log('dialog', dialog);
                                                var petugas_dipilih = $('#sel_petugas').val();
                                                var rpp = $('#sel_rpp').val();

                                                dialog = bootbox.dialog({ 
                                                    message: '<div id="proses" class="card"><div class="card-body"><div class="d-flex justify-content-between progress-label mb-2"><span class="msg">Menyimpan RPP...</span></div><div class="progress progress--medium"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div></div></div>', 
                                                    closeButton: false 
                                                });


                                                simpanRPP(markers, 0, dialog, petugas_dipilih, rpp);
                                            }
                                        }
                                    });

                                }else{
                                    bootbox.alert("Silahkan lengkapi urutan terlebih dahulu!");
                                    return false;
                                }
                            });

                            $(document).on("click", "a.start-here", function(e){
                                e.preventDefault();
                                var idpel = $(this).data('idpel');
                                var marker = $.grep(markers, function(e) { return e.idpel==idpel })[0];

                                bootbox.confirm({
                                    title: "Tentukan titik mulai",
                                    message: "Apakah anda yakin akan memulai urut langkah dari titik ini ("+marker.title+") ?", 
                                    buttons: {
                                        cancel: {
                                            className: 'btn-light',
                                            label: '<i class="fa fa-times"></i> Batal'
                                        },
                                        confirm: {
                                            className: 'btn-primary',
                                            label: '<i class="fa fa-check"></i> Ya, Mulai dari sini'
                                        }
                                    },
                                    callback: function (result) {
                                        if(result){

                                            if(start!=null){
                                                start.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                                                start.start_end = false;
                                                start = null;
                                                $('#plg_start').html("X");
                                            }

                                            $('div.content-body').block({ message: 'Menetapkan ulang urutan...' });
                                            asyncForEach(markers, function(marker) {
                                                marker.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                                                marker.urutan = null;
                                                marker.start_end = false;
                                            },function() {
                                                $('div.content-body').unblock();
                                            });

                                            marker.setIcon("../controller/getMarkerIcon.php?color=green-darker&text=START");
                                            start = marker;
                                            marker.urutan=1;
                                            marker.start_end = true;
                                            $('#plg_start').html(marker.idpel);
                                            $('#plg_end').html("Pelanggan Y");
                                            end = null;
                                            generated = false;

                                            $('#btn_generate').prop('disabled', true);
                                            $('#btn_simulasi').prop('disabled', true);
                                            $('#btn_create').prop('disabled', true);
                                        }

                                        infowindow.close();
                                        $('#plg_dipilih').empty();
                                        $('#info_tagging').empty();
                                    }
                                });

                            });

                            $(document).on("click", "a.end-here", function(e){
                                e.preventDefault();
                                var idpel = $(this).data('idpel');
                                var marker = $.grep(markers, function(e) { return e.idpel==idpel })[0];

                                if(start!=null){

                                    bootbox.confirm({
                                        title: "Tentukan titik akhir",
                                        message: "Apakah anda yakin akan mengakhiri urut langkah di titik ini ("+marker.title+") ?", 
                                        buttons: {
                                            cancel: {
                                                className: 'btn-light',
                                                label: '<i class="fa fa-times"></i> Batal'
                                            },
                                            confirm: {
                                                className: 'btn-primary',
                                                label: '<i class="fa fa-check"></i> Ya, Akhiri di sini'
                                            }
                                        },
                                        callback: function (result) {
                                            if(result){

                                                if(end!=null){
                                                    end.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                                                    end.start_end = false;
                                                    end = null;
                                                    $('#plg_end').html("X");
                                                }

                                                marker.setIcon("../controller/getMarkerIcon.php?color=green-darker&text=END");
                                                end = marker;
                                                marker.urutan=markers.length;
                                                marker.start_end = true;
                                                $('#plg_end').html(marker.idpel);


                                                $('#btn_generate').prop('disabled', false);
                                            }

                                            infowindow.close();
                                            $('#plg_dipilih').empty();
                                            $('#info_tagging').empty();
                                        }
                                    });
                                }else{
                                    bootbox.alert("Silahkan tentukan titik awal terlebih dahulu!");
                                }

                            });

                            $(document).on("click", "a.ganti-urutan", function(e){
                                e.preventDefault();
                                var idpel = $(this).data('idpel');
                                var marker = $.grep(markers, function(e) { return e.idpel==idpel })[0];

                                function array_move(arr, old_index, new_index) {
                                    if (new_index >= arr.length) {
                                        var k = new_index - arr.length + 1;
                                        while (k--) {
                                            arr.push(undefined);
                                        }
                                    }
                                    arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
                                    return arr; // for testing
                                }

                                if(marker.urutan==null){
                                    bootbox.alert("Silahkan tentukan titik awal dan generate langkah terlebih dahulu!");
                                }else{
                                    bootbox.prompt({
                                        title: "Ganti Urutan",
                                        message: "Silahkan isi urutan yang dikehendaki untuk Idpel "+idpel, 
                                        required: true,
                                        inputType: 'number',
                                        value: marker.urutan,
                                        callback: function (result) {
                                            if(result){

                                                var idx_lama = markers.findIndex(x => x.urutan == result);
                                                var idx_baru = markers.findIndex(x => x.urutan == marker.urutan);
                                                console.log('idx urutan '+result+' lama', idx_lama );
                                                console.log('idx urutan '+result+' yang baru', idx_baru );
                                                markers[idx_lama].setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                                                markers[idx_lama].urutan = 99999;
                                                markers[idx_baru].urutan = result;
                                                markers = array_move(markers, idx_baru, result-1); 

                                                $('div.content-body').block({ message: 'Menetapkan ulang urutan...' });
                                                asyncForEach(markers, function(marker) {
                                                    if(marker.urutan>result){
                                                        marker.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                                                        marker.urutan = null;
                                                    }
                                                    i++;
                                                },function() {
                                                    $('div.content-body').unblock();
                                                });

                                                //console.log('markers[result-1]',markers[result-1]);
                                                //console.log('result-1',result-1);

                                                sortUrutan(markers, markers[result-1], end, result-1);

                                                $('div.content-body').block({ message: 'Memberikan Urutan baru...' });
                                                var i=1;
                                                asyncForEach(markers, function(marker) {
                                                    marker.setIcon("../controller/getMarkerIcon.php?color=green-darker&text="+(marker.urutan));
                                                    //marker.urutan=i;
                                                    i++;
                                                },function() {
                                                    generated = true;
                                                    $('div.content-body').unblock();
                                                });
                                            }
                                        }
                                    });

                                }


                                infowindow.close();
                                $('#plg_dipilih').empty();
                                $('#info_tagging').empty();
                            });
                        
                            is_first=false;
                        }

                        $('div.content-body').unblock();

                    })
                    .on('click', function (marker) {
                        if(marker){


                            $('#plg_dipilih').html('Pelanggan dipilih: <span class="text-primary">'+marker.title+'</span>');
                            $('#info_tagging').html('Info Tagging: <span class="text-primary">'+marker.info_tagging+'</span>');

                            var contentString = `
                                <ul id="context-menu" class="list-group m-2">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="#" class="start-here" data-idpel="`+marker.idpel+`">Mulai dari sini</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="#" class="end-here" data-idpel="`+marker.idpel+`">Akhiri di sini</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="#" class="ganti-urutan" data-idpel="`+marker.idpel+`">Ganti Urutan</a>
                                    </li>
                                </ul>`;

                            infowindow.setContent(contentString);

                            infowindow.open({
                              anchor: marker,
                              map,
                            });

                            // if(start==null && !marker.start_end){
                            //     marker.setIcon("../controller/getMarkerIcon.php?color=green&text=START");
                            //     start = marker;
                            //     marker.urutan=1;
                            //     marker.start_end = true;
                            //     $('#plg_start').html(marker.idpel);
                            // }else if(end==null && !marker.start_end){
                            //     marker.setIcon("../controller/getMarkerIcon.php?color=green&text=END");
                            //     end = marker;
                            //     //marker.urutan=markers.length;
                            //     marker.start_end = true;
                            //     $('#plg_end').html(marker.idpel);
                            // }
                            // else if(start.idpel==marker.idpel){
                            //     marker.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                            //     start = null;
                            //     marker.start_end = false;
                            //     $('#plg_start').html("X");
                            // }else if(end.idpel==marker.idpel){
                            //     marker.setIcon("../controller/getMarkerIcon.php?color=red&text=..");
                            //     end = null;
                            //     marker.start_end = false;
                            //     $('#plg_end').html("Y");
                            // }
                        }
                      })
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
            //console.log( "Request Failed: " + err );
        }).always(function() {
            //console.log( "complete" );
        });

    });

    // $('#btn_create').click(function(){

    //     //console.log('create!!');
    //     Swal.fire({
    //         title: 'Masukan nama RPP',
    //         input: 'text',
    //         showCancelButton: true,
    //         cancelButtonText: 'Kembali',
    //         confirmButtonText: 'Simpan',
    //         showLoaderOnConfirm: true,
    //         // confirmButtonColor: "#58db83",
    //         // cancelButtonColor: "#ec536c",
    //         preConfirm: function (nama_rpp) {
    //             return new Promise(function (resolve, reject) {
    //                 setTimeout(function () {
    //                     if (nama_rpp === 'taken@example.com') {
    //                         reject('This rpp is already taken.')
    //                     } else {
    //                         resolve()
    //                     }
    //                 }, 2000)
    //             })
    //         },
    //         allowOutsideClick: false
    //     }).then(function (nama_rpp) {
    //         Swal.fire({
    //             type: 'success',
    //             title: 'Ajax request finished!',
    //             html: 'Submitted rpp: ' + nama_rpp
    //         })
    //     })

    // });


    // if(urlParams.has('rpp')){
    //     $('#sel_unitupi').selectpicker('val', urlParams.get('unitupi'));
    //     $('#sel_unitap').selectpicker('val', urlParams.get('unitap'));
    //     $('#sel_unitup').selectpicker('val', urlParams.get('unitup'));
    //     $('#sel_petugas').selectpicker('val', urlParams.get('petugas'));
    //     $('#sel_rpp').selectpicker('val', urlParams.get('rpp'));

    //     setTimeout(function(){ $('#btn_cari').trigger('click'); }, 3000);
    // }

    

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
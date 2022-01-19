$(document).ready(function () {

    "use strict";
    
    var red_house = "../../assets/images/markers/red/house.png";
    var blue_house = "../../assets/images/markers/blue/house.png";


    $('#jstree_basic').jstree({
        "checkbox" : {
          "keep_selected_style" : false
        },
        "plugins" : [ "checkbox" ]
    });

    var map = $('#map')
      .gmap3({
        address:"West Java, Indonesia",
        zoom:14
      })
      .wait(2000) // to let you appreciate the current zoom & center
      .fit();

    $('#btn_cari').click(function(){

        console.log('cari!!');
        $('#jstree_basic').jstree('destroy');
        $('#jstree_basic').block({message: "Mengambil data Gardu dan Tiang..."});
        $.getJSON( "../controller/pemeriksaan_lpb/getDataGarduTiang.php", 
        { 
            unitupi: $('#sel_unitupi').val(),
            unitap: $('#sel_unitap').val(),
            unitup: $('#sel_unitup').val(),
        }).done(function( data ) {
            console.log( "JSON Data: ", data.rows );
            var first = true;
            var last_gardu='';
            var tree = '';
            $(data.rows).each(function(key, obj){
                if(obj.nama_gardu != last_gardu){
                    if(!first)
                        tree += '</li></ul>';

                    if(obj.nama_gardu == undefined)
                        tree += '<li>&nbsp;';
                    else
                        tree += '<li>'+obj.nama_gardu;
                    tree += '<ul>';
                    tree += '<li>'+obj.nomor_jurusan_tiang+'</li>';
                    last_gardu = obj.nama_gardu;
                    first = false;
                }else{
                    tree += '<li>'+obj.nomor_jurusan_tiang+'</li>';
                }
            });
            console.log('tree', '<ul>'+tree+'</ul>');
            $('#jstree_basic').unblock();
            $('#jstree_basic').html('<ul><li>Gardu<ul>'+tree+'</ul></li></ul>');
            $('#jstree_basic').jstree({
                checkbox: {       
                  "keep_selected_style" : false,
                  // three_state : false, // to avoid that fact that checking a node also check others
                  // whole_node : false,  // to avoid checking the box just clicking the node 
                  tie_selection : false // for checking without selecting and selecting without checking
                },
                "plugins" : [ "checkbox" ]
            }).on("check_node.jstree uncheck_node.jstree", function(e, data) {
                var selectedElmsIds = $('#jstree_basic').jstree("get_selected");
                console.log(selectedElmsIds);
                alert(data.node.id + ' ' + data.node.text +
                    (data.node.state.checked ? ' CHECKED': ' NOT CHECKED'))
            });

        }).fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
            $('#jstree_basic').unblock();
        }).always(function() {
            console.log( "complete" );
        });

    });
    // $('#btn_cari').click(function(){

    //     console.log('cari!!');
    //     // console.log($("#tgl_baca_to").datepicker("getFormattedDate"));
    //     // console.log($("#tgl_baca_from").datepicker("getFormattedDate"));

    //     $('#map').gmap3({
    //         action: 'destroy'
    //     });

    //     var container = $('#map').parent();
    //     $('#map').remove();
    //     container.append('<div id="map"></div>');

    //     $.getJSON( "../controller/pemeriksaan_lpb/getDataPembentukanRPP.php", 
    //     { 
    //         unitupi: $('#sel_unitupi').val(),
    //         unitap: $('#sel_unitap').val(),
    //         unitup: $('#sel_unitup').val(),
    //         tgl_pemeriksaan_from: $('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD'),
    //         tgl_pemeriksaan_to: $('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')
    //         // tgl_baca_from: $("#tgl_baca_from").datepicker("getFormattedDate"),
    //         // tgl_baca_to: $("#tgl_baca_to").datepicker("getFormattedDate")
    //     }).done(function( json ) {
    //         console.log( "JSON Data: " + json );


    //         var markers = new Array(); 

    //         $(json).each(function(key, obj){
    //             // console.log(obj);
    //             markers.push(
    //                 {
    //                     title: obj.idpel+" ( "+obj.nama+" ) ", 
    //                     position:[obj.latitude, obj.longitude], 
    //                     icon:red_house
    //                 });
    //         });
               
    //         var markers_obj;
    //         // var map = $('#map')
    //         //   .gmap3({
    //         //     center: [46.578498,2.457275],
    //         //     zoom: 4
    //         //   })
    //         //   .cluster({
    //         //     size: 200,
    //         //     markers: [
    //         //       {position: [48.8620722, 2.352047]},
    //         //       {position: [44.28952958093682, 6.152559438984804]},
    //         //       {position: [49.28952958093682, -1.1501188139848408]},
    //         //       {position: [44.28952958093682, -1.1501188139848408]}
    //         //     ],
    //         //     cb: function (markers) {
    //         //       if (markers.length > 1) { // 1 marker stay unchanged (because cb returns nothing)
    //         //         if (markers.length < 20) {
    //         //           return {
    //         //             content: "<div class='cluster cluster-1'>" + markers.length + "</div>",
    //         //             x: -26,
    //         //             y: -26
    //         //           };
    //         //         }
    //         //       }
    //         //     }
    //         //   });

    //         var map = $('#map')
    //           .gmap3({
    //             center: [-6.3487933,107.6809901],
    //             zoom:6
    //           })
    //           //.marker(markers)
    //           .cluster({
    //             //size: 200,
    //             markers: markers,
    //             cb: function (markers) {
    //               markers_obj = markers;
    //               if (markers.length > 30) { // 1 marker stay unchanged (because cb returns nothing)
    //                 if (markers.length < 100) {
    //                   return {
    //                     content: "<div class='cluster cluster-1'>" + markers.length + "</div>",
    //                     x: -26,
    //                     y: -26
    //                   };
    //                 }
    //                 if (markers.length < 500) {
    //                   return {
    //                     content: "<div class='cluster cluster-2'>" + markers.length + "</div>",
    //                     x: -26,
    //                     y: -26
    //                   };
    //                 }
    //                   return {
    //                     content: "<div class='cluster cluster-3'>" + markers.length + "</div>",
    //                     x: -26,
    //                     y: -26
    //                   };
    //               }
    //             }
    //           })
    //           .on('click', function (marker) {
    //             if(!marker.selected){
    //                 marker.setIcon(blue_house);
    //                 marker.selected = true;
    //                 $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())+1);
    //             }else{
    //                 marker.setIcon(red_house);
    //                 marker.selected = false;
    //                 $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())-1);

    //             }
    //           })
    //           .wait(2000) // to let you appreciate the current zoom & center
    //           .fit()
    //           .then(function (result) {
    //             console.log('result', result);      // returns the last circle
    //             console.log(this.$);      // returns $('#map')

    //             // No index: all object into an array
    //             console.log(this.get());
    //             console.log('markers', markers);

    //             var map = this.get()[0];
    //             console.log('map', map);

    //             // var markerCluster = new MarkerClusterer(map, markers, {
    //             //     imagePath:
    //             //       "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
    //             //     maxZoom: 20,
    //             //     //averageCenter: true,
    //             //   });
    //             // console.log('markerCluster', markerCluster);
                
    //             //var markers = this.get()[1].markers;

    //             $('#total_plg').html(markers.length);
    //             $('#plg_dipilih').html('0');
                  
    //             map.enableKeyDragZoom({
    //                 noZoom: true,
    //                 visualEnabled: false,
    //             });

    //             var dz = map.getDragZoomObject();

    //             google.maps.event.addListener(dz, 'dragstart', function (latlng) {
    //                 console.log('KeyDragZoom Started: ' + latlng);
    //             });

    //             google.maps.event.addListener(dz, 'dragend', function (bnds) {
    //                 console.log('KeyDragZoom Ended: ' + bnds);
    //                 //var bounds = new google.maps.LatLngBounds(sw, ne);

    //                 console.log('bnds', bnds);
    //                 console.log('map', map);
    //                 console.log('markers', markers);
    //                 $.each(markers_obj, function(i, marker){
    //                     console.log('marker', marker);
    //                     if(marker.getPosition()){
    //                         if (bnds.contains(marker.getPosition())) {
                                
    //                             if(!marker.selected){
    //                                 marker.setIcon(blue_house);
    //                                 marker.selected = true;
    //                                 $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())+1);
    //                             }else{
    //                                 marker.setIcon(red_house);
    //                                 marker.selected = false;
    //                                 $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())-1);

    //                             }
    //                         }
    //                     }
    //                   //marker.setIcon("http://maps.google.com/mapfiles/marker_green.png");
    //                 });

    //             });

    //         });

    //         // var markerCluster = new MarkerClusterer(map, markers, {
    //         //     imagePath:
    //         //       "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
    //         //     maxZoom: 20,
    //         //     //averageCenter: true,
    //         //   });

    //         $('#btn_reset').click(function(){
    //             console.log('reset');
    //             $.each( $('#map').gmap3('get').get()[1], function(i, marker){
    //                 if(marker.selected){
    //                     marker.setIcon(red_house);
    //                     marker.selected = false;
    //                     $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())-1);
    //                 }
    //             });
    //         });
    //     }).fail(function( jqxhr, textStatus, error ) {
    //         var err = textStatus + ", " + error;
    //         console.log( "Request Failed: " + err );
    //     }).always(function() {
    //         console.log( "complete" );
    //     });

    // });

    // $('#btn_create').click(function(){

    //     console.log('create!!');
    //     Swal.fire({
    //         title: 'Masukan nama RPP',
    //         input: 'text',
    //         showCancelButton: true,
    //         cancelButtonText: 'Kembali',
    //         confirmButtonText: 'Simpan',
    //         showLoaderOnConfirm: true,
    //         confirmButtonColor: "#58db83",
    //         cancelButtonColor: "#ec536c",
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


});
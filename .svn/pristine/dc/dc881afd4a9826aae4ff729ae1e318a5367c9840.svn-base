$(document).ready(function () {

    "use strict";

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: moment().subtract(3, 'days').format('DD/MM/YYYY'),
        endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });
    
    var red_house = "../../assets/images/markers/red/house.png";
    var blue_house = "../../assets/images/markers/blue/house.png";

    var map = $('#map')
      .gmap3({
        address:"Bandung, Indonesia",
        zoom:14
      })
      .wait(2000) // to let you appreciate the current zoom & center
      .fit();

    $('#btn_cari').click(function(){

        console.log('cari!!');
        // console.log($("#tgl_baca_to").datepicker("getFormattedDate"));
        // console.log($("#tgl_baca_from").datepicker("getFormattedDate"));

        $('#map').gmap3({
            action: 'destroy'
        });

        var container = $('#map').parent();
        $('#map').remove();
        container.append('<div id="map"></div>');

        $.getJSON( "../controller/pemeriksaan_lpb/getDataPembentukanRPP.php", 
        { 
            unitupi: $('#sel_unitupi').val(),
            unitap: $('#sel_unitap').val(),
            unitup: $('#sel_unitup').val(),
            tgl_pemeriksaan_from: $('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD'),
            tgl_pemeriksaan_to: $('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')
            // tgl_baca_from: $("#tgl_baca_from").datepicker("getFormattedDate"),
            // tgl_baca_to: $("#tgl_baca_to").datepicker("getFormattedDate")
        }).done(function( json ) {
            console.log( "JSON Data: " + json );


            var markers = new Array(); 

            $(json).each(function(key, obj){
                // console.log(obj);
                markers.push(
                    {
                        title: obj.idpel+" ( "+obj.nama+" ) ", 
                        position:[obj.latitude, obj.longitude], 
                        icon:red_house
                    });
            });
               
            var markers_obj;
            

            var map = $('#map')
              .gmap3({
                center: [-6.3487933,107.6809901],
                zoom:6
              })
              //.marker(markers)
              .cluster({
                size: 200,
                markers: markers,
                cb: function (markers) {
                  markers_obj = markers;
                  if (markers.length > 1) { // 1 marker stay unchanged (because cb returns nothing)
                    if (markers.length < 200) {
                      return {
                        content: "<div class='cluster cluster-1'>" + markers.length + "</div>",
                        x: -26,
                        y: -26
                      };
                    }
                  }
                }
              })
              .on('click', function (marker) {
                if(!marker.selected){
                    marker.setIcon(blue_house);
                    marker.selected = true;
                    $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())+1);
                }else{
                    marker.setIcon(red_house);
                    marker.selected = false;
                    $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())-1);

                }
              })
              .wait(2000) // to let you appreciate the current zoom & center
              .fit()
              .then(function (result) {
                console.log('result', result);      // returns the last circle
                console.log(this.$);      // returns $('#map')

                // No index: all object into an array
                console.log(this.get());

                var map = this.get()[0];
                
                //var markers = this.get()[1].markers;

                $('#total_plg').html(markers.length);
                $('#plg_dipilih').html('0');
                  
                map.enableKeyDragZoom({
                    noZoom: true,
                    visualEnabled: false,
                });

                var dz = map.getDragZoomObject();

                google.maps.event.addListener(dz, 'dragstart', function (latlng) {
                    console.log('KeyDragZoom Started: ' + latlng);
                });

                google.maps.event.addListener(dz, 'dragend', function (bnds) {
                    console.log('KeyDragZoom Ended: ' + bnds);
                    //var bounds = new google.maps.LatLngBounds(sw, ne);

                    console.log('bnds', bnds);
                    console.log('map', map);
                    console.log('markers', markers);
                    $.each(markers_obj, function(i, marker){
                        console.log('marker', marker);
                        if(marker.getPosition()){
                            if (bnds.contains(marker.getPosition())) {
                                
                                if(!marker.selected){
                                    marker.setIcon(blue_house);
                                    marker.selected = true;
                                    $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())+1);
                                }else{
                                    marker.setIcon(red_house);
                                    marker.selected = false;
                                    $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())-1);

                                }
                            }
                        }
                      //marker.setIcon("http://maps.google.com/mapfiles/marker_green.png");
                    });

                });

            });

            $('#btn_reset').click(function(){
                console.log('reset');
                $.each( $('#map').gmap3('get').get()[1], function(i, marker){
                    if(marker.selected){
                        marker.setIcon(red_house);
                        marker.selected = false;
                        $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())-1);
                    }
                });
            });
        }).fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        }).always(function() {
            console.log( "complete" );
        });

    });

    $('#btn_create').click(function(){

        console.log('create!!');
        Swal.fire({
            title: 'Masukan nama RPP',
            input: 'text',
            showCancelButton: true,
            cancelButtonText: 'Kembali',
            confirmButtonText: 'Simpan',
            showLoaderOnConfirm: true,
            confirmButtonColor: "#58db83",
            cancelButtonColor: "#ec536c",
            preConfirm: function (nama_rpp) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        if (nama_rpp === 'taken@example.com') {
                            reject('This rpp is already taken.')
                        } else {
                            resolve()
                        }
                    }, 2000)
                })
            },
            allowOutsideClick: false
        }).then(function (nama_rpp) {
            Swal.fire({
                type: 'success',
                title: 'Ajax request finished!',
                html: 'Submitted rpp: ' + nama_rpp
            })
        })

    });


});
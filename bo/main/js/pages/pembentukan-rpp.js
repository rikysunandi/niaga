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
    var selected = new Array();

    // $('#sel_unitup').change(function(){

    //   $('#sel_petugas').empty();
    //   $.getJSON('../controller/referensi/getPetugasPriangan.php?unitup='+$('#sel_unitup').val(), function(data){
          
    //       $.each(data.rows,function(i,v){
    //           $('#sel_petugas').append('<option value="'+v.kode+'">'+v.nama+'</option>');
    //       });
    //       $('#sel_petugas').append('<option value="00">SEMUA PETUGAS</option>');
    //       $('#sel_petugas').selectpicker('refresh');

    //       // if(urlParams.has('petugas')){
    //       //   $('#sel_petugas').selectpicker('val', urlParams.get('petugas'));
    //       //   console.log('petugas', urlParams.get('petugas'));
    //       // }
    //       // else{
    //       //   $('#sel_petugas').selectpicker('val', "00");
    //       //   console.log('semua petugas');
    //       // }

    //       //$('#sel_rbm').selectpicker('refresh');
    //     });
    // });

    var map = $('#map')
      .gmap3({
        address:"Bandung, Indonesia",
        zoom:14
      })
      .wait(2000) // to let you appreciate the current zoom & center
      .fit();

    $('#btn_cari').click(function(){

        $('div.content-body').block({ message: 'Mengambil data pelanggan dengan koordinat...' });
        console.log('cari!!');
        // console.log($("#tgl_baca_to").datepicker("getFormattedDate"));
        // console.log($("#tgl_baca_from").datepicker("getFormattedDate"));

        $('#map').gmap3({
            action: 'destroy'
        });

        selected = new Array();

        var container = $('#map').parent();
        $('#map').remove();
        container.append('<div id="map"></div>');

        $.getJSON( "../controller/pemeriksaan_lpb/getDataPembentukanRPP.php", 
        { 
            unitupi: $('#sel_unitupi').val(),
            unitap: $('#sel_unitap').val(),
            unitup: $('#sel_unitup').val(),
            // petugas: $('#sel_petugas').val(),
            // tgl_pemeriksaan_from: $('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD'),
            // tgl_pemeriksaan_to: $('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')
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
                        icon:red_house,
                        idpel: obj.idpel,
                        petugas: obj.petugas_priangan,
                        gardu: obj.nama_gardu
                    });
            });
               
            var markers_obj;

            var map = $('#map')
              .gmap3({
                center: [-6.3487933,107.6809901],
                zoom:10
              })
              //.marker(markers)
              .cluster({
                //size: 300,
                markers: markers,
                cb: function (markers) {
                  markers_obj = markers;
                  if (markers.length > 300) { // 1 marker stay unchanged (because cb returns nothing)
                    if (markers.length < 1000) {
                      return {
                        content: "<div class='cluster cluster-1'>" + markers.length + "</div>",
                        x: -26,
                        y: -26
                      };
                    }
                    if (markers.length < 500) {
                      return {
                        content: "<div class='cluster cluster-2'>" + markers.length + "</div>",
                        x: -26,
                        y: -26
                      };
                    }
                      return {
                        content: "<div class='cluster cluster-3'>" + markers.length + "</div>",
                        x: -26,
                        y: -26
                      };
                  }
                }
              })
              .then(function (cluster) {

                    var map = this.get()[0];
                    console.log('map', map);

                    $('#total_plg').html(cluster.markers().length);
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

                        $.each(cluster.markers(), function(i, marker){
                            //console.log('marker cek posisi', marker.getPosition());
                            var petugas = new Array(); 
                            var gardu = new Array(); 
                            if(marker.getPosition()){
                                if (bnds.contains(marker.getPosition())) {
                                    //console.log('marker dalam pilihan', marker);
                                    
                                    //if(!marker.selected){
                                        marker.setIcon(blue_house);
                                        marker.selected = true;
                                        selected.push(marker);
                                        $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())+1);


                                    // }else{
                                    //     marker.setIcon(red_house);
                                    //     marker.selected = false;
                                    //     $('#plg_dipilih').html(selected.length);

                                    // }
                                }
                            }
                          //marker.setIcon("http://maps.google.com/mapfiles/marker_green.png");
                        });

                        populateList(selected);

                    });


                    $('#btn_reset').bind( "click", function() {
                        $.each( cluster.markers(), function(i, marker){
                            if(marker.selected){
                                marker.setIcon(red_house);
                                marker.selected = false;
                                selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                $('#plg_dipilih').html(selected.length);
                            }
                        });

                        populateList(selected);
                    });

                    $('#btn_remove').bind( "click", function() {
                        asyncForEach(cluster.markers(), function(marker) {
                            if(marker.selected){
                                marker.setIcon(red_house);
                                marker.selected = false;
                                marker.setMap(null);
                                selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                $('#plg_dipilih').html(selected.length);
                                $('#total_plg').html(cluster.markers().length);
                            }
                        },function() {
                            populateList(selected);
                        });
                        // $.each( cluster.markers(), function(i, marker){
                        //     if(marker.selected){
                        //         marker.setIcon(red_house);
                        //         marker.selected = false;
                        //         marker.setMap(null);
                        //         selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                        //         $('#plg_dipilih').html(selected.length);
                        //     }
                        // });

                    });

                    $('ul#petugas-selected li.list-group-item a').bind( "click", function(c) {
                        console.log("PETUGAS HAPUS");
                        console.log($(this));
                        var petugas = $(this).prev().html();
                        $.each( cluster.markers(), function(i, marker){
                            if(marker.selected && marker.petugas==petugas){
                                marker.setIcon(red_house);
                                marker.selected = false;
                                marker.setMap(null);
                                selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                $('#plg_dipilih').html(selected.length);
                            }
                        });

                        populateList(selected);

                    });

                    $('ul#gardu-selected li.list-group-item a').bind( "click", function(c) {
                        console.log("GARDU HAPUS");
                        console.log($(this));
                        var gardu = $(this).prev().html();
                        $.each( cluster.markers(), function(i, marker){
                            if(marker.selected && marker.gardu==gardu){
                                marker.setIcon(red_house);
                                marker.selected = false;
                                marker.setMap(null);
                                selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                $('#plg_dipilih').html(selected.length);
                            }
                        });

                        populateList(selected);

                    });

                    $('div.content-body').unblock();

                })
              .on('click', function (marker) {
                if(marker){
                    if(!marker.selected){
                        marker.setIcon(blue_house);
                        marker.selected = true;
                        selected.push(marker);
                        $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())+1);
                    }else{
                        marker.setIcon(red_house);
                        marker.selected = false;
                        selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                        $('#plg_dipilih').html(selected.length);

                    }
                    populateList(selected);
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
            // confirmButtonColor: "#58db83",
            // cancelButtonColor: "#ec536c",
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

        // Accepts the array and key
    const groupBy = (array, key) => {
      // Return the end result
      return array.reduce((result, currentValue) => {
        // If an array already present for key, push it to the array. Else create an array and push the object
        (result[currentValue[key]] = result[currentValue[key]] || []).push(
          currentValue
        );
        // Return the current iteration `result` value, this will be taken as next iteration `result` value and accumulate
        return result;
      }, {}); // empty object is the initial value for result object
    };

    function populateList(items){
        var petugas_list = groupBy(items, 'petugas');
        var petugas_sort = [];
        for (var petugas in petugas_list) {
            petugas_sort.push([petugas, petugas_list[petugas].length]);
        }

        petugas_sort.sort(function(a, b) {
            return b[1] - a[1];
        });

        var gardu_list = groupBy(items, 'gardu');
        var gardu_sort = [];
        for (var gardu in gardu_list) {
            gardu_sort.push([gardu, gardu_list[gardu].length]);
        }

        gardu_sort.sort(function(a, b) {
            return b[1] - a[1];
        });

        console.log('petugas_sort', petugas_sort);
        console.log('gardu_sort', gardu_sort);

        $('ul#petugas-selected').empty();
        $.each(petugas_sort, function ( idx, val ) {
            $('ul#petugas-selected').append(
                `<li class="list-group-item col-9">
                    <span>`+val[0]+`</span>
                    <a href="#" class="pull-right mr-2" role="button" aria-pressed="true">
                      <i class="link-hapus fa fa-minus-circle"></i>
                    </a>
                    <span class="badge badge-primary badge-pill pull-right mr-2">`+val[1]+`</span>
                </li>`
            );
        });

        $('ul#gardu-selected').empty();
        $.each(gardu_sort, function ( idx, val ) {
            $('ul#gardu-selected').append(
                `<li class="list-group-item col-9">
                    <span>`+val[0]+`</span>
                    <a href="#" class="pull-right mr-2" role="button" aria-pressed="true">
                      <i class="link-hapus fa fa-minus-circle"></i>
                    </a>
                    <span class="badge badge-primary badge-pill pull-right mr-2">`+val[1]+`</span>
                </li>`
            );
        });

    }

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
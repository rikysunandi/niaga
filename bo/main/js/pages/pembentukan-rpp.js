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
    var ic_gardu = "../../assets/images/markers/green/powersubstation.png";
    var selected = new Array();

    $('#btn_reset').prop('disabled', true);
    $('#btn_remove').prop('disabled', true);
    $('#btn_create').prop('disabled', true);

    var is_first = true;

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
        $('#btn_reset').prop('disabled', true);
        $('#btn_remove').prop('disabled', true);
        $('#btn_create').prop('disabled', true);

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

            //json = JSON.parse(json);
            //console.log( "JSON Data: " + json );


            var markers = new Array(); 

            $(json.plg).each(function(key, obj){
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

            var gardu_markers = new Array(); 

            $(json.gardu).each(function(key, obj){
                // console.log(obj);
                markers.push(
                    {
                        title: obj.nama_gardu+" ( "+obj.kapasitas_trafo+" kVA ) ", 
                        //label: obj.nama_gardu,
                        position:[obj.latitude, obj.longitude], 
                        //icon:ic_gardu,
                        icon: {
                          url: ic_gardu,
                          labelOrigin: new google.maps.Point(20, 20),
                          //size: new google.maps.Size(32,32),
                          //anchor: new google.maps.Point(16,32)
                        },
                        label: {
                          text: obj.nama_gardu,
                          color: "#4caf50",
                          fontWeight: "bold"
                        },
                        gardu:obj.nama_gardu,
                        idpel:"X",
                        zIndex: 9999,
                    });
            });
               
            var markers_obj;

            var map = $('#map')
              .gmap3({
                //center: [-6.3487933,107.6809901],
                //zoom:11,
                // mapTypeControl: true,
                // mapTypeControlOptions: {
                //   style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                // },
                // navigationControl: true,
                // scrollwheel: true,
                // streetViewControl: true
              })
              .marker(gardu_markers)
              .cluster({
                //radius: 10,
                //size: 300,
                markers: markers,
                cb: function (markers) {
                  markers_obj = markers;

                  var jml_plg = $.grep(markers, function(e) { return e.idpel!="X" }).length;

                  if (jml_plg > 300) { // 1 marker stay unchanged (because cb returns nothing)
                    if (jml_plg > 10000) {
                      return {
                        content: "<div class='cluster cluster-3'>" + jml_plg + "</div>",
                        x: -43,
                        y: -43,
                        width: 86,
                        height: 85
                      };
                    }
                    else if (jml_plg > 1000) {
                      return {
                        content: "<div class='cluster cluster-2'>" + jml_plg + "</div>",
                        x: -33,
                        y: -33,
                        width: 66,
                        height: 65
                      };
                    }else{
                      return {
                        content: "<div class='cluster cluster-1'>" + jml_plg + "</div>",
                        x: -31,
                        y: -31,
                        width: 63,
                        height: 62
                      };
                    }
                  }
                }
              })
              .then(function (cluster) {

                    var map = this.get()[0];
                    console.log('map', map);
                    console.log("cluster", cluster);

                    $('#total_plg').html(cluster.markers().filter(function(e) { return e.idpel!="X" }).length);
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

                        $('div.content-body').block({ message: 'Memilih koordinat...' });
                        asyncForEach(cluster.markers(), function(marker) {
                            var petugas = new Array(); 
                            var gardu = new Array(); 
                            if(marker.getPosition()){
                                if (bnds.contains(marker.getPosition())) {
                                    //console.log('marker dalam pilihan', marker);
                                    
                                    //if(!marker.selected){
                                    if(marker.idpel!="X"){
                                        marker.setIcon(blue_house);
                                        marker.selected = true;
                                        selected.push(marker);
                                        $('#plg_dipilih').html(parseInt($('#plg_dipilih').html())+1);
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
                            populateList(selected);
                            if(selected.length>0){
                                $('#btn_reset').prop('disabled', false);
                                $('#btn_remove').prop('disabled', false);
                                $('#btn_create').prop('disabled', false);
                            }
                            $('div.content-body').unblock();
        
                        });

                    });

                    if(is_first){

                        $('#btn_create').bind( "click", function() {
                            if(selected.length>0){

                                bootbox.confirm({
                                    title: "Pembentukan RPP",
                                    message: "Apakah anda yakin akan membersihkan "+selected.length+" pilihan titik koordinat dari Peta?", 
                                    buttons: {
                                        cancel: {
                                            className: 'btn-light',
                                            label: '<i class="fa fa-times"></i> Batal'
                                        },
                                        confirm: {
                                            className: 'btn-primary',
                                            label: '<i class="fa fa-check"></i> Ya, Bersihkan'
                                        }
                                    },
                                    callback: function (result) {
                                        if(result){
                                            $('div.content-body').block({ message: 'Membersihkan koordinat yang dipilih...' });
                                            asyncForEach(cluster.markers(), function(marker) {
                                                if(marker.selected){
                                                    marker.setIcon(red_house);
                                                    marker.selected = false;
                                                    selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                    $('#plg_dipilih').html(selected.length);
                                                }
                                            },function(){
                                                populateList(selected);
                                                if(selected.length>0){
                                                    $('#btn_reset').prop('disabled', false);
                                                    $('#btn_remove').prop('disabled', false);
                                                    $('#btn_create').prop('disabled', false);
                                                }
                                                $('div.content-body').unblock();
                                            });
                                        }
                                    }
                                });

                            }else{
                                bootbox.alert({
                                    message: "Silahkan pilih koordinat yang akan dibentuk RPP!",
                                    backdrop: true
                                });
                            }

                        });


                        $('#btn_reset').bind( "click", function() {
                            if(selected.length>0){

                                bootbox.confirm({
                                    title: "Bersihkan Pilihan?",
                                    message: "Apakah anda yakin akan membersihkan "+selected.length+" pilihan titik koordinat dari Peta?", 
                                    buttons: {
                                        cancel: {
                                            className: 'btn-light',
                                            label: '<i class="fa fa-times"></i> Batal'
                                        },
                                        confirm: {
                                            className: 'btn-primary',
                                            label: '<i class="fa fa-check"></i> Ya, Bersihkan'
                                        }
                                    },
                                    callback: function (result) {
                                        if(result){
                                            $('div.content-body').block({ message: 'Membersihkan koordinat yang dipilih...' });
                                            asyncForEach(cluster.markers(), function(marker) {
                                                if(marker.selected){
                                                    marker.setIcon(red_house);
                                                    marker.selected = false;
                                                    selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                    $('#plg_dipilih').html(selected.length);
                                                }
                                            },function(){
                                                populateList(selected);
                                                if(selected.length>0){
                                                    $('#btn_reset').prop('disabled', false);
                                                    $('#btn_remove').prop('disabled', false);
                                                    $('#btn_create').prop('disabled', false);
                                                }
                                                $('div.content-body').unblock();
                                            });
                                        }
                                    }
                                });

                            }else{
                                bootbox.alert({
                                    message: "Silahkan pilih koordinat yang akan diunblok!",
                                    backdrop: true
                                });
                            }

                        });

                        $('#btn_remove').bind( "click", function() {
                            if(selected.length>0){

                                bootbox.confirm({
                                    title: "Hapus Koordinat?",
                                    message: "Apakah anda yakin akan menghapus "+selected.length+" titik koordinat dari Peta?", 
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
                                            $('div.content-body').block({ message: 'Menghapus koordinat yang dipilih...' });
                                            asyncForEach(cluster.markers(), function(marker) {
                                                if(marker.selected){
                                                    console.log(marker);
                                                    marker.setIcon(red_house);
                                                    marker.selected = false;
                                                    marker.setMap(null);
                                                    cluster.remove(marker);
                                                    //selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                    selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                    $('#plg_dipilih').html(selected.length);
                                                    $('#total_plg').html(cluster.markers().filter(function(e) { return e.idpel!="X" }).length);
                                                }
                                            },function() {
                                                populateList(selected);
                                                if(selected.length>0){
                                                    $('#btn_reset').prop('disabled', false);
                                                    $('#btn_remove').prop('disabled', false);
                                                    $('#btn_create').prop('disabled', false);
                                                }
                                                $('div.content-body').unblock();
                                            });
                                        }
                                    }
                                });

                            }else{
                                bootbox.alert({
                                    message: "Silahkan pilih koordinat yang akan dihapus!",
                                    backdrop: true
                                });
                            }

                        });

                        $("ul#petugas-selected").on("click", "li.list-group-item a", function(e){
                            e.preventDefault();
                            console.log("PETUGAS HAPUS");
                            console.log($(this));
                            //alert($(this).text());
                            var petugas = $(this).prev().html();
                            asyncForEach(cluster.markers(), function(marker) {
                                if(marker.selected && marker.petugas==petugas){
                                    marker.setIcon(red_house);
                                    marker.selected = false;
                                    selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                    $('#plg_dipilih').html(selected.length);
                                }
                            },function(){
                                populateList(selected);
                            });

                        });

                        $("ul#gardu-selected").on("click", "li.list-group-item a", function(e){
                            e.preventDefault();
                            console.log("GARDU HAPUS");
                            console.log($(this));
                            var gardu = $(this).prev().html();
                            asyncForEach(cluster.markers(), function(marker) {
                                if(marker.selected && marker.gardu==gardu){
                                    marker.setIcon(red_house);
                                    marker.selected = false;
                                    selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                    $('#plg_dipilih').html(selected.length);
                                }
                            },function(){
                                populateList(selected);
                            });

                        });

                        is_first = false;
                    }

                    $('div.content-body').unblock();

                })
              .on('click', function (marker) {
                if(marker){
                    if(marker.idpel!="X"){
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
                        if(selected.length>0){
                            $('#btn_reset').prop('disabled', false);
                            $('#btn_remove').prop('disabled', false);
                            $('#btn_create').prop('disabled', false);
                        }
                    }
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

    // $('#btn_create').click(function(){

    //     console.log('create!!');
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
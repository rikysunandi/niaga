$(document).ready(function () {

    "use strict";
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    
    var red_house = "../../assets/images/markers/red/house.png";
    var blue_house = "../../assets/images/markers/blue/house.png";
    var ic_gardu = "../../assets/images/markers/green/powersubstation.png";
    var selected = new Array();

    $('#btn_reset').prop('disabled', true);
    $('#btn_remove').prop('disabled', true);
    $('#btn_create').prop('disabled', true);

    var is_first = true;
    var opsi_petugas;

    $('#sel_unitup').change(function(){

        opsi_petugas = new Array();
        $.getJSON('../controller/referensi/getPetugasPriangan.php?unitup='+$('#sel_unitup').val(), function(data){
          
          $.each(data.rows,function(i,v){
              opsi_petugas.push(
                { 
                    value: v.kode,
                    text: v.nama
                });
          });

        });
    });

    var map = $('#map')
      .gmap3({
        address:"Bandung, Indonesia",
        zoom:14
      })
      .wait(2000) // to let you appreciate the current zoom & center
      .fit();

    $('#btn_cari').click(function(){

        $('div.content-body').block({ message: 'Mengambil data pelanggan dengan koordinat...' });
        //console.log('cari!!');
        // //console.log($("#tgl_baca_to").datepicker("getFormattedDate"));
        // //console.log($("#tgl_baca_from").datepicker("getFormattedDate"));
        $('#btn_reset').prop('disabled', true);
        $('#btn_remove').prop('disabled', true);
        $('#btn_create').prop('disabled', true);

        $('#map').gmap3({
            action: 'destroy'
        });

        selected = new Array();
        populateList(selected);
        $('#plg_dipilih').html(selected.length);
        $('#total_plg').html(0);

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
            ////console.log( "JSON Data: " + json );


            var markers = new Array();
            var wilker = json.wil; 

            $(json.plg).each(function(key, obj){
                // //console.log(obj);
                markers.push(
                    {
                        title: obj.idpel+" ( "+obj.nama+" ) ", 
                        position:[obj.latitude, obj.longitude], 
                        icon:red_house,
                        idpel: obj.idpel,
                        petugas: obj.petugas_priangan,
                        gardu: obj.nama_gardu,
                        rbm_paska: obj.rbm_paska,
                    });
            });

            var gardu_markers = new Array(); 

            $(json.gardu).each(function(key, obj){
                // //console.log(obj);
                markers.push(
                    {
                        title: obj.nama_gardu+" ( "+obj.kapasitas_trafo+" kVA ) ", 
                        //label: obj.nama_gardu,
                        position:[obj.latitude, obj.longitude], 
                        //icon:ic_gardu,
                        icon: {
                          url: ic_gardu,
                          labelOrigin: new google.maps.Point(15, 40),
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
                mapTypeControl: true,
                mapTypeControlOptions: {
                  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                },
                navigationControl: true,
                scrollwheel: true,
                streetViewControl: true
              })
              //.marker(gardu_markers)
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
                        x: -26,
                        y: -26,
                      };
                    }
                    else if (jml_plg > 1000) {
                      return {
                        content: "<div class='cluster cluster-2'>" + jml_plg + "</div>",
                        x: -26,
                        y: -26,
                      };
                    }else{
                      return {
                        content: "<div class='cluster cluster-1'>" + jml_plg + "</div>",
                        x: -26,
                        y: -26,
                      };
                    }
                  }
                }
              })
              .then(function (cluster) {

                    var map = this.get()[0];
                    //console.log('map', map);
                    //console.log("cluster", cluster);

                    $('#total_plg').html(cluster.markers().filter(function(e) { return e.idpel!="X" }).length);
                    $('#plg_dipilih').html('0');
                      
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
                            asyncForEach(cluster.markers(), function(marker) {
                                var petugas = new Array(); 
                                var gardu = new Array(); 

                                // if(selected.length > 500){
                                //     bootbox.alert("Pelanggan yang dipilih sudah mencapai maksimal 500 pelanggan!");
                                //     return false;
                                // }

                                if(marker.getPosition()){
                                    if (bnds.contains(marker.getPosition())) {
                                        ////console.log('marker dalam pilihan', marker);
                                        
                                        //if(!marker.selected){
                                        if(marker.idpel!="X" && !marker.selected){
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
                        }else{
                            bootbox.alert("Rentang pilihan terlalu jauh!");
                            return false;
                        }

                    });

                    if(is_first){

                        $('#btn_create').bind( "click", function() {

                            if(selected.length > 350){
                                bootbox.alert("Pelanggan yang anda pilih ("+selected.length+") terlalu banyak untuk 1 RPP (maks 350)!");
                                return false;
                            }

                            if(selected.length>0){

                                var petugas_list = groupBy(selected, 'petugas');
                                var petugas_sort = [];
                                for (var petugas in petugas_list) {
                                    if(petugas!='DIL' && petugas!='')
                                        petugas_sort.push([petugas, petugas_list[petugas].length]);
                                }

                                petugas_sort.sort(function(a, b) {
                                    return b[1] - a[1];
                                }); 

                                // if($('ul#petugas-selected li.list-group-item:first span').html()=='DIL')
                                //     var petugas =  $('ul#petugas-selected li.list-group-item:first').next().children('span').html();
                                // else
                                //     var petugas =  $('ul#petugas-selected li.list-group-item:first span').html();

                                //console.log('opsi_petugas', opsi_petugas);
                                //console.log('petugas', petugas);
                                var petugas_init='';
                                if(petugas_sort.length>0)
                                    petugas_init = petugas_sort[0][0];
                                
                                bootbox.prompt({
                                    title: "Pilih Petugas",
                                    message: "Silahkan pilih petugas untuk RPP yang akan dibentuk", 
                                    required: true,
                                    inputType: 'select',
                                    inputOptions: opsi_petugas,
                                    value: petugas_init,
                                    callback: function (result) {
                                        if(result){
                                            var petugas_dipilih = result;
                                            //console.log('wilker', wilker);
                                            var wil = $.grep(wilker, function(e) { return e.kodepetugas==petugas_dipilih });
                                            //console.log(wil);
                                            var rbm_prefill='';
                                            if(wil.length>0)
                                                rbm_prefill=wil[0].rbm;
                                            
                                            bootbox.prompt({
                                                title: "Nama RPP",
                                                message: "Tentukan Nama RPP untuk Petugas "+petugas_dipilih+" yang akan dibentuk (7 karakter)", 
                                                required: true,
                                                value: rbm_prefill,
                                                maxlength: 7,
                                                callback: function (result) {
                                                    if(result){
                                                        var rpp = result;
                                                        //console.log('petugas', petugas_dipilih);
                                                        //console.log('rpp', rpp);

                                                        if(rpp.length != 7){
                                                            bootbox.alert("Silahkan masukan nama RPP sebanyak 7 karakter!");
                                                            return false;
                                                        }

                                                        // function simpanRPP(datas, i, progress, petugas, rpp, berhasil){

                                                        //     if(i<datas.length){

                                                        //         var valeur = parseInt((i / datas.length)*100);
                                                        //         var marker = datas[i];

                                                        //         $($(progress).find('.progress-bar')[0]).css('width', valeur+'%').attr('aria-valuenow', valeur);
                                                        //         $($(progress).find('.msg')[0]).html('Menyimpan idpel '+marker.idpel+' ke RPP <span class="text-success">'+rpp+'</span> milik petugas <span class="text-success">'+petugas+'</span> ('+(i+1)+'/'+datas.length+')...');

                                                        //         $.post('../controller/pemeriksaan_lpb/simpanRPP.php', 
                                                        //         { petugas: petugas, rpp: rpp, urutan:0, idpel:marker.idpel }, 
                                                        //         function(res){
                                                        //             //console.log('res',res);
                                                        //             if(res.success=='true' || res.success){
                                                        //                 berhasil.push(marker.idpel);
                                                        //                 marker.setIcon(red_house);
                                                        //                 marker.selected = false;
                                                        //                 marker.setMap(null);
                                                        //                 cluster.remove(marker);
                                                        //                 selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                        //                 $('#plg_dipilih').html(selected.length);
                                                        //                 $('#total_plg').html(cluster.markers().filter(function(e) { return e.idpel!="X" }).length);
                                                        //             }
                                                        //             simpanRPP(datas, i+1, dialog, petugas, rpp, berhasil);

                                                        //         }).fail(function() { 
                                                        //             simpanRPP(datas, i+1, dialog, petugas, rpp, berhasil);
                                                        //         });

                                                        //     }else{

                                                        //         $($(progress).find('.progress-bar')[0]).css('width', '100%').attr('aria-valuenow', 100);
                                                        //         populateList(selected);
                                                        //         if(selected.length>0){
                                                        //             $('#btn_reset').prop('disabled', false);
                                                        //             $('#btn_remove').prop('disabled', false);
                                                        //             $('#btn_create').prop('disabled', false);
                                                        //         }
                                                        //         progress.modal('hide');

                                                        //         bootbox.confirm({
                                                        //             title: "Proses Selesai",
                                                        //             message: "Sebanyak "+berhasil.length+" pelanggan berhasil disimpan, apakah anda akan melanjutkan ke proses pemberian urut langkah? (klik allow/izinkan, jika muncul popup di browser anda)", 
                                                        //             buttons: {
                                                        //                 cancel: {
                                                        //                     className: 'btn-light',
                                                        //                     label: '<i class="fa fa-times"></i> Tidak'
                                                        //                 },
                                                        //                 confirm: {
                                                        //                     className: 'btn-primary',
                                                        //                     label: '<i class="fa fa-check"></i> Ya, Lanjutkan'
                                                        //                 }
                                                        //             },
                                                        //             callback: function (result) {
                                                        //                 if(result){

                                                        //                     var unitupi= $('#sel_unitupi').val();
                                                        //                     var unitap= $('#sel_unitap').val();
                                                        //                     var unitup= $('#sel_unitup').val();

                                                        //                     window.open("urut-langkah-rpp.php?unitupi="+unitupi+"&unitap="+unitap+"&unitup="+unitup+"&petugas="+petugas+"&rpp="+rpp, "_blank");
                                                        //                 }
                                                        //             }
                                                        //         });

                                                        //     }

                                                        // }

                                                        // var dialog = bootbox.dialog({ 
                                                        //     message: '<div id="proses" class="card"><div class="card-body"><div class="d-flex justify-content-between progress-label mb-2"><span class="msg">Menyimpan RPP...</span></div><div class="progress progress--medium"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div></div></div>', 
                                                        //     closeButton: false 
                                                        // });

                                                        // //console.log('dialog', dialog);
                                                        // var berhasil = new Array();

                                                        // simpanRPP(selected, 0, dialog, petugas_dipilih, rpp, berhasil);

                                                        var dialog = bootbox.dialog({ 
                                                            message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Menyimpan data RPP...</div>', 
                                                            closeButton: false 
                                                        });

                                                        var idpels='';
                                                        asyncForEach(selected, function(marker) {
                                                            idpels += marker.idpel+',';
                                                        },function(){
                                                            idpels = idpels.replace(/,\s*$/, "");
                                                        });

                                                        $.post('../controller/pemeriksaan_lpb/batchSimpanRPP.php', 
                                                        { petugas: petugas_dipilih, rpp: rpp, idpels:idpels }, 
                                                        function(res){
                                                            dialog.modal('hide');
                                                            console.log('idpels',res.idpels);
                                                            if(res.success=='true' || res.success){

                                                                asyncForEach(selected, function(marker) {
                                                                    if(res.idpels.includes(marker.idpel)){
                                                                        marker.setIcon(red_house);
                                                                        marker.selected = false;
                                                                        marker.setMap(null);
                                                                        cluster.remove(marker);
                                                                        selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                                                        $('#plg_dipilih').html(selected.length);
                                                                        $('#total_plg').html(cluster.markers().filter(function(e) { return e.idpel!="X" }).length);
                                                                    }
                                                                },function(){

                                                                    populateList(selected);

                                                                    bootbox.confirm({
                                                                        title: "Proses Selesai",
                                                                        message: "Sebanyak "+res.idpels.length+" pelanggan berhasil disimpan, apakah anda akan melanjutkan ke proses pemberian urut langkah? (klik allow/izinkan, jika muncul popup di browser anda)", 
                                                                        buttons: {
                                                                            cancel: {
                                                                                className: 'btn-light',
                                                                                label: '<i class="fa fa-times"></i> Tidak'
                                                                            },
                                                                            confirm: {
                                                                                className: 'btn-primary',
                                                                                label: '<i class="fa fa-check"></i> Ya, Lanjutkan'
                                                                            }
                                                                        },
                                                                        callback: function (result) {
                                                                            if(result){

                                                                                var unitupi= $('#sel_unitupi').val();
                                                                                var unitap= $('#sel_unitap').val();
                                                                                var unitup= $('#sel_unitup').val();

                                                                                window.open("urut-langkah-rpp.php?unitupi="+unitupi+"&unitap="+unitap+"&unitup="+unitup+"&petugas="+petugas_dipilih+"&rpp="+rpp, "_blank");
                                                                            }
                                                                        }
                                                                    });

                                                                });

                                                            }else{
                                                                bootbox.alert({
                                                                    message: res.msg,
                                                                    backdrop: true
                                                                });
                                                            }

                                                            

                                                        }).fail(function() { 
                                                            dialog.modal('hide');
                                                            bootbox.alert({
                                                                message: "Gagal menyimpan data!",
                                                                backdrop: true
                                                            });
                                                        });

                                                            
                                                    }
                                                }
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
                                            asyncForEach(selected, function(marker) {
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
                                    title: "Hilangkan Koordinat?",
                                    message: "Apakah anda yakin akan menghilangkan sementara "+selected.length+" titik koordinat dari Peta?", 
                                    buttons: {
                                        cancel: {
                                            className: 'btn-light',
                                            label: '<i class="fa fa-times"></i> Batal'
                                        },
                                        confirm: {
                                            className: 'btn-danger',
                                            label: '<i class="fa fa-check"></i> Ya, Hilangkan'
                                        }
                                    },
                                    callback: function (result) {
                                        if(result){
                                            $('div.content-body').block({ message: 'Menghilangkan sementara koordinat yang dipilih...' });
                                            asyncForEach(selected, function(marker) {
                                                if(marker.selected){
                                                    //console.log(marker);
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
                            ////console.log($(this));
                            //alert($(this).text());
                            var petugas = $(this).prev().html();
                            //console.log("PETUGAS HAPUS", petugas);
                            asyncForEach(selected, function(marker) {
                                ////console.log("CEK MARKER", marker.petugas);
                                if(marker.selected && marker.petugas==petugas){
                                    //console.log("CLEAR MARKER", marker.idpel);
                                    marker.setIcon(red_house);
                                    marker.selected = false;
                                    selected = $.grep(selected, function(e) { return e.idpel!=marker.idpel });
                                    $('#plg_dipilih').html(selected.length);
                                }
                            },function(){
                                populateList(selected);
                            });

                        });

                        $("ul#rbm-paska-selected").on("click", "li.list-group-item a", function(e){
                            e.preventDefault();
                            //console.log("rbm_paska HAPUS");
                            //console.log($(this));
                            var rbm_paska = $(this).prev().html();
                            asyncForEach(selected, function(marker) {
                                if(marker.selected && marker.rbm_paska==rbm_paska){
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
                            //console.log("GARDU HAPUS");
                            //console.log($(this));
                            var gardu = $(this).prev().html();
                            asyncForEach(selected, function(marker) {
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

        var rbm_paska_list = groupBy(items, 'rbm_paska');
        var rbm_paska_sort = [];
        for (var rbm_paska in rbm_paska_list) {
            rbm_paska_sort.push([rbm_paska, rbm_paska_list[rbm_paska].length]);
        }

        rbm_paska_sort.sort(function(a, b) {
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

        //console.log('petugas_sort', petugas_sort);
        //console.log('gardu_sort', gardu_sort);

        $('ul#petugas-selected').empty();
        $.each(petugas_sort, function ( idx, val ) {
            $('ul#petugas-selected').append(
                `<li class="list-group-item">
                    <span>`+val[0]+`</span>
                    <a href="#" class="pull-right mr-2" role="button" aria-pressed="true">
                      <i class="link-hapus fa fa-minus-circle"></i>
                    </a>
                    <span class="badge badge-primary badge-pill pull-right mr-2">`+val[1]+`</span>
                </li>`
            );
        });

        $('ul#rbm-paska-selected').empty();
        $.each(rbm_paska_sort, function ( idx, val ) {
            $('ul#rbm-paska-selected').append(
                `<li class="list-group-item">
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
                `<li class="list-group-item">
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
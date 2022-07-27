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


    function initMap(mapid, rows) {

      var container = $('#'+mapid).parent();
      $('#'+mapid).remove();
      container.append('<div id="'+mapid+'"></div>');

      var map = new google.maps.Map(document.getElementById(mapid), {
        zoom: 10,
        center: { lat: -6.3487933, lng: 107.6809901 },
      });

      var icon;
      var infowindow = new google.maps.InfoWindow();
      var marker = new google.maps.Marker();
      var bounds = new google.maps.LatLngBounds();

      var markers = rows.map((tagging, i) => {
        if(tagging.LATITUDE && tagging.LONGITUDE ){
              //icon= "../controller/getMarkerIcon.php?color=red&text="+(i+1);
              icon= "../../assets/images/markers/blue/house.png";

              marker = new google.maps.Marker({
                position: {
                            lat: parseFloat(tagging.LATITUDE), 
                            lng: parseFloat(tagging.LONGITUDE)
                          },
                map: map,
                zIndex: rows.length - i,
                icon: {
                  url: icon,
                },
                title: tagging.MARKER_TITLE,
              });
            

            bounds.extend(new google.maps.LatLng(parseFloat(tagging.LATITUDE), parseFloat(tagging.LONGITUDE)));

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(
                      ` <div class="row">
                          <div class="col-12">
                            <dl>
                              <dt>Idpel</dt>
                              <dd>`+tagging.IDPEL+`</dd>
                              <dt>Nama</dt>
                              <dd>`+tagging.NAMA+`</dd>
                            </dl>
                          </div>
                        </div>
                      `
                      );
                    infowindow.open(map, marker);
                }
            })(marker, i)); 

            return marker;
        }
      });

      map.fitBounds(bounds);

    }

    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rpp')
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!');
        $('div.content-body').unblock();
        var rows = data.data;
        initMap('map', rows);
      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "deferLoading": 1000,
        "ajax": {
            "url": '../controller/getTargetKompor.php',
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
            visible: true
          },
          {
            data: "TARIF",
            visible: true
          },
          {
            data: "DAYA",
            type: 'number',
            visible: true,
            "sClass" : "text-right" , render: $.fn.dataTable.render.number(".", ",", 0, '')
          },
          {
            data: "GARDU",
            visible: true
          },
          {
            data: "NOMOR_JURUSAN_TIANG",
            visible: true
          },
          {
            data: "NAMA_KECAMATAN",
            visible: true
          },
          {
            data: "NAMA_KELURAHAN",
            visible: false
          },
          {
            data: "KDDK",
            visible: true
          },
          {
            data: "JENIS_SUBSIDI",
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
                  window.open('../controller/expCSVTargetKompor.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val() );
              }

            },
            { extend: 'colvis', text: 'Columns' }
        ],
        "scrollY": 520,
        "scrollX": true,
        "paging": true,
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,
        "order": [[10, 'asc']],
    });

    $('#btn_cari').click(function(){

        var unitupi=$('#sel_unitupi').val();
        var unitap=$('#sel_unitap').val();
        var unitup=$('#sel_unitup').val();

        $('div.content-body').block({ message: 'Mengambil target kompor induksi...' });
        console.log('cari!!');
        
        table.ajax.url( '../controller/getTargetKompor.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup ).load();

    });


    $('#btn_reset').click(function(){
        console.log('RESET');

        bootbox.confirm({
            title: "Reset Target?",
            message: "Apakah anda yakin akan mereset seluruh target dari unit yang dipilih?", 
            buttons: {
                cancel: {
                    className: 'btn-light',
                    label: '<i class="fa fa-times"></i> Batal'
                },
                confirm: {
                    className: 'btn-primary',
                    label: '<i class="fa fa-check"></i> Ya, Reset'
                }
            },
            callback: function (result) {
                if(result){

                  var unitupi=$('#sel_unitupi').val();
                  var unitap=$('#sel_unitap').val();
                  var unitup=$('#sel_unitup').val();

                  var dialog = bootbox.dialog({ 
                      message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Menghapus data target...</div>', 
                      closeButton: false 
                  });

                  $.post('../controller/resetKompor.php', 
                  { 
                    unitupi:unitupi,
                    unitap:unitap,
                    unitup:unitup,
                  }, 
                  function(res){
                      dialog.modal('hide');

                      table.ajax.url( '../controller/getTargetKompor.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup ).load();
                      // if(res.success=='true' || res.success){

                      //     bootbox.alert({
                      //         message: res.msg,
                      //         backdrop: true,
                      //         callback: function (result) {
                      //           table.ajax.url( '../controller/getTargetKompor.php?unitupi='+unitupi+'&unitap='+unitap+'&unitup='+unitup ).load();
                      //         }
                      //     });
                          
                      // }else{
                      //     bootbox.alert({
                      //         message: res.msg,
                      //         backdrop: true
                      //     });
                      // }

                      

                  }).fail(function() { 
                      dialog.modal('hide');
                      bootbox.alert({
                          message: "Gagal mereset data!",
                          backdrop: true
                      });
                  });
                }

              }
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
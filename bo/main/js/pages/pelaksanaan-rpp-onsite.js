$(document).ready(function () {

    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    
    var red_house = "../../assets/images/markers/red/house.png";
    var blue_house = "../../assets/images/markers/blue/house.png";
    var ic_gardu = "../../assets/images/markers/green/powersubstation.png";
    var map_on_desk, map_on_site, markers_on_desk, markers_on_site;

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

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        // startDate: moment().subtract(1, 'months').format('DD/MM/YYYY'),
        startDate: '13/06/2022',
        endDate: moment(),
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
          //$('#sel_petugas').append('<option value="00">SEMUA PETUGAS</option>');
          $('#sel_petugas').selectpicker('refresh');

          if(urlParams.has('petugas')){
            $('#sel_petugas').selectpicker('val', urlParams.get('petugas'));
            console.log('petugas', urlParams.get('petugas'));
          }
          else{
            $('#sel_petugas').selectpicker('val', "00");
            console.log('semua petugas');
          }

          //$('#sel_rbm').selectpicker('refresh');
        });
    });

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

      var markerGroups=new google.maps.MVCObject();

      var markers = rows.map((tagging, i) => {
        if(tagging.LATITUDE && tagging.LONGITUDE ){

          if(tagging.STATUS_ONSITE=='BELUM ONSITE')
            icon= "../controller/getMarkerIcon.php?color=grey&text="+(i+1);
          else if(tagging.STATUS_ONSITE=='SUDAH ONSITE')
            icon= "../controller/getMarkerIcon.php?color=green&text="+(i+1);
          else if(tagging.STATUS_ONSITE=='SDH ONSITE BEDA RPP' || tagging.STATUS_ONSITE=='SDH ONSITE BEDA PETUGAS')
            icon= "../controller/getMarkerIcon.php?color=orange&text="+(i+1);
          else if(tagging.SISIPAN=='Y')
            icon= "../controller/getMarkerIcon.php?color=orange&text="+(i+1);
          else
            icon= "../controller/getMarkerIcon.php?color=green&text="+(i+1);

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
        }

        if(tagging.STATUS_ONSITE){
          marker.bindTo(mapid,markerGroups,tagging.STATUS_ONSITE);
        }
        else if(tagging.SISIPAN=='Y')
          marker.bindTo(mapid,markerGroups,'SISIPAN');
        else
          marker.bindTo(mapid,markerGroups,'ONSITE');

        bounds.extend(new google.maps.LatLng(parseFloat(tagging.LATITUDE), parseFloat(tagging.LONGITUDE)));

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(
                  ` <div class="row">
                      <div class="col-6">
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
        
      });

      map.fitBounds(bounds);

    }
    //$.blockUI({ message: '<h1 class="p-3">Mengambil data...</h1>' }); 
    var table = $('#tbl_rpp') 
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
        $('#card_map_on_desk .card-footer').addClass('d-none');
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr rpp ondesk!', data);
        $('div.content-body').unblock();
        var rows = data.data;
        //initMap('map_on_desk', rows);

        $('#card_map_on_desk .card-footer').removeClass('d-none');
        $('#card_map_on_desk .card-footer :checkbox').each(function(c){
          this.checked=true;
        });

        var container = $('#map_on_desk').parent();
        $('#map_on_desk').remove();
        container.append('<div id="map_on_desk"></div>');

        map_on_desk = new google.maps.Map(document.getElementById("map_on_desk"), {
          zoom: 10,
          center: { lat: -6.3487933, lng: 107.6809901 },
        });

        var icon;
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker();
        var bounds = new google.maps.LatLngBounds();

        markers_on_desk = rows.map((tagging, i) => {
          if(tagging.LATITUDE && tagging.LONGITUDE ){

            if(tagging.STATUS_ONSITE=='BELUM ONSITE')
              icon= "../controller/getMarkerIcon.php?color=dark&text="+(i+1);
            else if(tagging.STATUS_ONSITE=='SUDAH ONSITE')
              icon= "../controller/getMarkerIcon.php?color=green&text="+(i+1);
            else if(tagging.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS')
              icon= "../controller/getMarkerIcon.php?color=orange&text="+(i+1);
            else
              icon= "../controller/getMarkerIcon.php?color=green&text="+(i+1);

            marker = new google.maps.Marker({
              position: {
                          lat: parseFloat(tagging.LATITUDE), 
                          lng: parseFloat(tagging.LONGITUDE)
                        },
              map: map_on_desk,
              zIndex: rows.length - i,
              icon: {
                url: icon,
              },
              title: tagging.MARKER_TITLE,
              status: tagging.STATUS_ONSITE
            });
          }

          bounds.extend(new google.maps.LatLng(parseFloat(tagging.LATITUDE), parseFloat(tagging.LONGITUDE)));

          google.maps.event.addListener(marker, 'click', (function (marker, i) {
              return function () {
                  infowindow.setContent(
                    ` <div class="row">
                        <div class="col-12">
                          <dl>
                            <dt>KDDK</dt>
                            <dd>`+tagging.RPP_KDDK+`</dd>
                            <dt>Idpel</dt>
                            <dd>`+tagging.IDPEL+`</dd>
                            <dt>Nama</dt>
                            <dd>`+tagging.NAMA+`</dd>
                          </dl>
                        </div>
                      </div>
                    `
                    );
                  infowindow.open(map_on_desk, marker);
              }
          })(marker, i)); 

          return marker;
          
        });

        map_on_desk.fitBounds(bounds);

      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/pemeriksaan_lpb/getDataRPPOndesk.php',
            "type": "POST",
            "timeout": 360000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          {
            data: "NO",
            render: function ( data, type, row ) {
                
                  if(row.STATUS_ONSITE=='SUDAH ONSITE')
                    return '<span class="text-success">'+data+'</span>';
                  else if(row.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS' )
                    return '<span class="text-warning">'+data+'</span>';
                    return data;
              },
          },
          {
            data: "RPP_KDDK",
            render: function ( data, type, row ) {
                
                  if(row.STATUS_ONSITE=='SUDAH ONSITE')
                    return '<span class="text-success">'+data+'</span>';
                  else if(row.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS' )
                    return '<span class="text-warning">'+data+'</span>';
                    return data;
              },
          },
          {
            data: "IDPEL",
            render: function ( data, type, row ) {
                
                  if(row.STATUS_ONSITE=='SUDAH ONSITE')
                    return '<span class="text-success">'+data+'</span>';
                  else if(row.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS' )
                    return '<span class="text-warning">'+data+'</span>';
                    return data;
              },
          },
          {
            data: "NOMOR_METER_KWH",
            visible: false,
            render: function ( data, type, row ) {
                
                  if(row.STATUS_ONSITE=='SUDAH ONSITE')
                    return '<span class="text-success">'+data+'</span>';
                  else if(row.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS' )
                    return '<span class="text-warning">'+data+'</span>';
                    return data;
              },
          },
          {
            data: "NAMA",
            render: function ( data, type, row ) {
                
                  if(row.STATUS_ONSITE=='SUDAH ONSITE')
                    return '<span class="text-success">'+data+'</span>';
                  else if(row.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS' )
                    return '<span class="text-warning">'+data+'</span>';
                    return data;
              },
          },
          {
            data: "STATUS_ONSITE",
            render: function ( data, type, row ) {
                
                  if(row.STATUS_ONSITE=='SUDAH ONSITE')
                    return '<span class="text-success">'+data+'</span>';
                  else if(row.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS' )
                    return '<span class="text-warning">'+data+'</span>';
                    return data;
              },
          },
          {
            data: "RPP_ONSITE",
            render: function ( data, type, row ) {
                
                  if(row.STATUS_ONSITE=='SUDAH ONSITE')
                    return '<span class="text-success">'+data+'</span>';
                  else if(row.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS' )
                    return '<span class="text-warning">'+data+'</span>';
                    return data;
              },
          },
          {
            data: "PETUGAS_ONSITE",
            render: function ( data, type, row ) {
                
                  if(row.STATUS_ONSITE=='SUDAH ONSITE')
                    return '<span class="text-success">'+data+'</span>';
                  else if(row.STATUS_ONSITE=='SDH ONSITE BEDA RPP/PETUGAS' )
                    return '<span class="text-warning">'+data+'</span>';
                    return data;
              },
          },
        ],  
        // "language": {
        //   "lengthMenu": "Display _MENU_ records"
        // },
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-8 mb-2'i><'col-sm-12 col-md-4'p>>",
        //lengthMenu: [[25, 50, 100], [25, 50, 100]],
        // lengthChange: false,
        "scrollY": 520,
        "scrollX": true,
        "paging": false,
        pageLength: -1,
        "order": [0, 'asc'],
        
    });

    var tbl_uji_rpp = $('#tbl_uji_rpp') 
      .on('preXhr.dt', function ( e, settings, data ) {
        console.log('preXhr!');
        $('div.content-body').block({ message: 'Mengambil data...' });
        $('#card_map_on_site .card-footer').addClass('d-none');
      })
      .on('xhr.dt', function ( e, settings, data ) {
        console.log('xhr!');
        $('div.content-body').unblock();
        var rows = data.data;

        $('#card_map_on_site .card-footer').removeClass('d-none');
        $('#card_map_on_site .card-footer :checkbox').each(function(c){
          this.checked=true;
        });

        var container = $('#map_on_site').parent();
        $('#map_on_site').remove();
        container.append('<div id="map_on_site"></div>');

        map_on_site = new google.maps.Map(document.getElementById("map_on_site"), {
          zoom: 10,
          center: { lat: -6.3487933, lng: 107.6809901 },
        });

        var icon;
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker();
        var bounds = new google.maps.LatLngBounds();

        markers_on_site = rows.map((tagging, i) => {
          if(tagging.LATITUDE && tagging.LONGITUDE ){

            if(tagging.SISIPAN=='Y')
              icon= "../controller/getMarkerIcon.php?color=orange&text="+(i+1);
            else
              icon= "../controller/getMarkerIcon.php?color=green&text="+(i+1);

            marker = new google.maps.Marker({
              position: {
                          lat: parseFloat(tagging.LATITUDE), 
                          lng: parseFloat(tagging.LONGITUDE)
                        },
              map: map_on_site,
              zIndex: rows.length - i,
              icon: {
                url: icon,
              },
              title: tagging.MARKER_TITLE,
              status: (tagging.SISIPAN=='Y')?'SISIPAN':'ONSITE'
            });
          }

          bounds.extend(new google.maps.LatLng(parseFloat(tagging.LATITUDE), parseFloat(tagging.LONGITUDE)));

          google.maps.event.addListener(marker, 'click', (function (marker, i) {
              return function () {
                  infowindow.setContent(
                    ` <div class="row">
                        <div class="col-12">
                          <dl>
                            <dt>KDDK</dt>
                            <dd>`+tagging.TGL_INPUT+`</dd>
                            <dt>Idpel</dt>
                            <dd>`+tagging.IDPEL+`</dd>
                            <dt>Nama</dt>
                            <dd>`+tagging.NAMA+`</dd>
                          </dl>
                        </div>
                      </div>
                    `
                    );
                  infowindow.open(map_on_site, marker);
              }
          })(marker, i)); 

          return marker;
          
        });

        map_on_site.fitBounds(bounds);

        //initMap('map_on_site', rows);

        // var container = $('#map_on_site').parent();
        // $('#map_on_site').remove();
        // container.append('<div id="map_on_site"></div>');
      })
      .DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '../controller/pemeriksaan_lpb/getDataRPPOnSite.php',
            "type": "POST",
            "timeout": 360000
        },
        deferRender: true,
        deferLoading: 0,
        //responsive: true,
        columns: [
          {
            data: "NO",
            render: function ( data, type, row ) {
                
                  
                  if(row.SISIPAN=='Y')
                    return '<span class="text-warning">'+data+'</span>';
                  else
                    return '<span class="text-success">'+data+'</span>';
              },
          },
          {
            data: "TGL_INPUT",
            render: function ( data, type, row ) {
                
                  
                  if(row.SISIPAN=='Y')
                    return '<span class="text-warning">'+data+'</span>';
                  else
                    return '<span class="text-success">'+data+'</span>';
              },
          },
          {
            data: "PERUNTUKAN",
            render: function ( data, type, row ) {
                
                  
                  if(row.SISIPAN=='Y')
                    return '<span class="text-warning">'+data+'</span>';
                  else
                    return '<span class="text-success">'+data+'</span>';
              },
          },
          {
            data: "RPP_KDDK",
            render: function ( data, type, row ) {
                
                  if(row.SISIPAN=='Y' && !row.RPP_KDDK)
                    return '<span class="text-warning">-</span>';
                  if(row.SISIPAN=='Y')
                    return '<span class="text-warning">'+data+'</span>';
                  else
                    return '<span class="text-success">'+data+'</span>';
              },
          },
          {
            data: "IDPEL",
            render: function ( data, type, row ) {
                
                  if(row.SISIPAN=='Y')
                    return '<span class="text-warning">'+data+'</span>';
                  else
                    return '<span class="text-success">'+data+'</span>';
              },
          },
          {
            data: "NAMA",
            render: function ( data, type, row ) {
                
                  if(row.SISIPAN=='Y')
                    return '<span class="text-warning">'+data+'</span>';
                  else
                    return '<span class="text-success">'+data+'</span>';
              },
          },
        ],
        dom:
           // "<'row'<'col-sm-12 col-md-9 mb-2'B>>" +
            "<'row'<'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 mb-2'tr>>" +
            "<'row'<'col-sm-12 col-md-8 mb-2'i><'col-sm-12 col-md-4'p>>",
        // lengthMenu: [[25, 50, 100], [25, 50, 100]],
        lengthChange: false,
        // buttons: [
        //     { 
        //       text: '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Export Semua', 
        //       titleAttr: 'Download CSV',
        //       //"sTooltip": "My CSV button's tooltip",
        //       action: function ( e, dt, node, config ) {
        //           // alert( 'Download!' );
        //           // //this.disable(); // disable button
        //           // console.log('dt', dt);
        //           // console.log('node', node);
        //           window.open('../controller/pemeriksaan_lpb/expCSVPemeriksaanLPB.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_pemeriksaan_from='+$('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_pemeriksaan_to='+$('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')+'&petugas='+$('#sel_petugas').val() );
        //       }

        //     },
        //     { extend: 'colvis', text: 'Columns' }
        // ],
        "scrollY": 520,
        "scrollX": true,
        "paging": false,
        pageLength: -1,
        "order": [[0, 'asc']],
        
    });


    $('#tbl_uji_rpp').on('click', 'td a.foto', function (e) {
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

    $('.card-map .card-footer :checkbox').each(function(c){
      this.checked=true;
    });

    $('#card_map_on_desk .card-footer :checkbox').click(function(e){
        //console.log('klik checkbox',$(this).next('label').text());
        var status=$(this).next('label').text().toUpperCase();
        var checked=this.checked;
        $('div#card_map_on_desk').block({ message: 'Menyesuaikan peta...' });
        asyncForEach(markers_on_desk, function(marker) {
            if(marker.status==status){
              marker.setVisible(checked);
            }
        },function() {
            $('div#card_map_on_desk').unblock();
        });
    });

    
    $('#card_map_on_site .card-footer :checkbox').click(function(e){
        //console.log('klik checkbox',$(this).next('label').text());
        var status=$(this).next('label').text().toUpperCase();
        var checked=this.checked;
        $('div#card_map_on_site').block({ message: 'Menyesuaikan peta...' });
        asyncForEach(markers_on_site, function(marker) {
            if(marker.status==status){
              marker.setVisible(checked);
            }
        },function() {
            $('div#card_map_on_site').unblock();
        });
    });

    $('#btn_cari').click(function(btn){
        console.log('Klikk 2');

        table.ajax.url( '../controller/pemeriksaan_lpb/getDataRPPOndesk.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_pemeriksaan_from='+$('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_pemeriksaan_to='+$('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')+'&petugas='+$('#sel_petugas').val()+'&rpp='+$('#sel_rpp').val() ).load();
        tbl_uji_rpp.ajax.url( '../controller/pemeriksaan_lpb/getDataRPPOnSite.php?unitupi='+$('#sel_unitupi').val()+'&unitap='+$('#sel_unitap').val()+'&unitup='+$('#sel_unitup').val()+'&tgl_pemeriksaan_from='+$('#tgl_pemeriksaan_range').data('daterangepicker').startDate.format('YYYY-MM-DD')+'&tgl_pemeriksaan_to='+$('#tgl_pemeriksaan_range').data('daterangepicker').endDate.format('YYYY-MM-DD')+'&petugas='+$('#sel_petugas').val()+'&rpp='+$('#sel_rpp').val()+'&urut_rpp='+$('#cb_urut_rpp:checked').val() ).load();
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
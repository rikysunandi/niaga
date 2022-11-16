(function($) {
    "use strict"

    var params_url = location.search.replace('?', '').split('=')

	$('input').val('');

	$.getJSON('../controller/getSession.php?key=param_idpel&unset=Y', function(data){
		console.log(data);
		if(data.success){
    		$('#input_cari').val(data.value);
			$('#btn_cari').trigger('click');
		}
    });

    $('#btn_cari').click(function(){

    	var input_cari = $('#input_cari').val();
    	$('input').val('');
    	$('#input_cari').val(input_cari);

        var container = $('.map').parent();
        $('.map').remove();
        container.append('<div class="map"></div>');

    	$('div.content-body').block({ message: 'Mencari data...' });
    	$.getJSON('../controller/getInfoPelanggan.php?query='+input_cari, function(data){
	        $('#idpel').val(data.idpel);
	        $('#nomor_meter_kwh').val(data.nomor_meter_kwh);
	        $('#nama').val(data.nama);
	        $('#tarif_daya').val(data.tarif+'/'+data.daya+' VA');
	        $('#unitap').val(data.unitap);
	        $('#unitup').val(data.unitup);
	        $('#nama_gardu').val(data.nama_gardu);
	        $('#nomor_jurusan_tiang').val(data.nomor_jurusan_tiang);
	        $('#alamat').val(data.alamat);
	        $('#nohp').val(data.nohp);
	        $('#status_dil').val(data.status_dil);
	        $('#merk_meter_kwh').val(data.merk_meter_kwh);
	        $('#rpujl_real').val(data.rpujl_real);
	        $('#kddk').val(data.kddk);
	        $('#v_bulan_rekap').val(data.v_bulan_rekap);

            $('.img_foto').attr('src', data.foto);

            // $('.foto').zoom({
            //     url: data.foto,
            //     magnify: 2
            // });

	        var $image = $('.img_foto');

	        $image.viewer({
	          //inline: true,
	          viewed: function() {
	            $image.viewer('zoomTo', 1);
	          }
	        });

	        var center = [data.koordinat_x, data.koordinat_y];
		    $('.map')
		      .gmap3({
		        center: center,
		        zoom: 13,
		        mapTypeId : google.maps.MapTypeId.ROADMAP
		      })
		      .marker({
		        position: center,
		        icon: "../../assets/images/markers/red/house.png"
		      });

	        $('div.content-body').unblock();
	    });


    });


	// if(params_url[1].length>0){
	// 	$('#input_cari').val(params_url[1]);
	// 	$('#btn_cari').trigger('click');
	// }



})(jQuery);
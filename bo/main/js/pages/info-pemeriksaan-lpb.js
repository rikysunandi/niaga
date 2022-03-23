(function($) {
    "use strict"

    var params_url = location.search.replace('?', '').split('=')

	$('input').val('');

    $('#btn_cari').click(function(){

    	var input_cari = $('#input_cari').val();
    	$('input').val('');
    	$('#input_cari').val(input_cari);

        var container = $('.map').parent();
        $('.map').remove();
        container.append('<div class="map"></div>');

    	$('div.content-body').block({ message: 'Mencari data...' });
    	$.getJSON('../controller/pemeriksaan_lpb/getInfoPemeriksaanLPB.php?query='+input_cari, function(data){
	        $('#idpel').val(data.idpel);
	        $('#nomor_meter_kwh').val(data.nomor_meter_kwh);
	        $('#nama').val(data.nama);
	        $('#tarif_daya').val(data.tarif+'/'+data.daya+' VA');
	        $('#unitap').val(data.unitap);
	        $('#unitup').val(data.unitup);
	        $('#tgl_pemeriksaan').val(data.tgl_pemeriksaan);
	        $('#latitude').val(data.latitude);
	        $('#longitude').val(data.longitude);
	        $('#akurasi_koordinat').val(data.akurasi_koordinat);
	        $('#user_input').val(data.user_input);

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

	        var center = [data.latitude, data.longitude];
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


	if(params_url[1].length>0){
		$('#input_cari').val(params_url[1]);
		$('#btn_cari').trigger('click');
	}



})(jQuery);
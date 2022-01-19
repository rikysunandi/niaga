(function($) {
    "use strict"

    var params_url = location.search.replace('?', '').split('=');


    $('input#tgl_bayar').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left', 
        singleDatePicker: true,
        locale: {
          format: 'DD/MM/YYYY'
        }
    });


    $('#btn_noagenda_cari').click(function(){

    	var noagenda = $('#noagenda_cari').val();
    	$('input').val('');
    	$('textarea').val('');
    	$('#noagenda_cari').val(noagenda);

    	$('div.content-body').block({ message: 'Mencari data...' });
    	$.getJSON('../controller/getInfoAgenda.php?noagenda='+noagenda, function(data){
	        $('#noagenda_individu').val(data.noagenda_individu);
	        $('#noagenda_kolektif').val(data.noagenda_kolektif);
	        $('#jenislap').val(data.jenislap);
	        $('#tglmohon').val(data.tglmohon);
	        $('#jenis_transaksi').val(data.jenis_transaksi);
	        $('#ket_transaksi').val(data.ket_transaksi);
	        $('#jenis_mk').val(data.jenis_mk);
	        $('#idpel').val(data.idpel);
	        $('#nama').val(data.nama);
	        $('#tarif_daya_lama').val(data.tarif_daya_lama);
	        $('#tarif_daya_baru').val(data.tarif_daya_baru);
	        $('#segmen_tegangan').val(data.segmen_tegangan);
	        $('#keterangan_gol_tarif').val(data.keterangan_gol_tarif);
	        $('#rp_bp').val(data.rp_bp);
	        $('#rp_ujl').val(data.rp_ujl);
	        $('#status_permohonan').val(data.status_permohonan);
	        $('#alasan_kriteria_tmp').val(data.alasan_kriteria_tmp);
	        $('#rp_rab').val(data.rp_rab);
	        $('#rab_material').val(data.rab_material);
	        $('#rab_jasa').val(data.rab_jasa);
	        $('#status_tmp').val(data.status_tmp);
	        $('#klasifikasi_rab').val(data.klasifikasi_rab);
	        //$('#keterangan_rab').val(data.keterangan_rab);

	        $('div.content-body').unblock();
	    });


        table_material.ajax.url( '../controller/getMaterialAgenda.php?noagenda='+noagenda ).load();
    


    });


	if(params_url[1].length>0){
		$('#noagenda_cari').val(params_url[1]);
		$('#btn_noagenda_cari').trigger('click');
	}



})(jQuery);
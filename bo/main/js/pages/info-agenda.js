(function($) {
    "use strict"


    var params_url = location.search.replace('?', '').split('=');

	$('input').val('');
	$('textarea').val('');


    $('#btn_noagenda_cari').click(function(){

    	var noagenda = $('#noagenda_cari').val();
    	$('input').val('');
    	$('textarea').val('');
    	$('#noagenda_cari').val(noagenda);
        $('#status_tmp').removeClass().addClass('form-control');
        $('#status_proses').removeClass().addClass('form-control');

        if(noagenda.length>0){

	    	$('div.content-body').block({ message: 'Mencari data...' });
	    	$.getJSON('../controller/getInfoAgenda.php?noagenda='+noagenda, function(data){
		        if(data.success){
		        	$('#unitap').val(data.unitap);
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
		            $('#keterangan_alasan_kriteria_tmp').val(data.keterangan_alasan_kriteria_tmp);
			        $('#rp_rab').val(data.rp_rab);
			        $('#rab_material').val(data.rab_material);
			        $('#rab_jasa').val(data.rab_jasa);
			        $('#rp_rab_std').val(data.rp_rab_std);
			        $('#rab_material_std').val(data.rab_material_std);
			        $('#rab_jasa_std').val(data.rab_jasa_std);
			        $('#rp_rab_perluasan').val(data.rp_rab_perluasan);
			        $('#rab_material_perluasan').val(data.rab_material_perluasan);
			        $('#rab_jasa_perluasan').val(data.rab_jasa_perluasan);
			        $('#status_tmp').val(data.status_tmp);
			        $('#klasifikasi_rab').val(data.klasifikasi_rab);
			        
                    $('#status_tmp').val(data.status_tmp);
                    if(data.status_tmp=='DALAM TMP'){
                        $('#status_tmp').addClass('text-success');
                    }else if(data.status_tmp=='MENDEKATI TMP'){
                        $('#status_tmp').addClass('text-warning');
                    }else{
                        $('#status_tmp').addClass('text-danger');
                    }

                    $('#status_proses').val(data.status_proses).addClass((data.status_proses=='BP >= RAB')?'text-success':'text-warning');

			    }else{
                    showMsg(data.msg, 'warning');
                }

		        $('div.content-body').unblock();
		    });
	    }else{
            showMsg('Silahkan masukan No Agenda yang akan dicari', 'warning');
        }
    


    });


	if(params_url[1].length>0){
		$('#noagenda_cari').val(params_url[1]);
		$('#btn_noagenda_cari').trigger('click');
	}


    function showMsg(msg, status){

        $.notify({
            message: msg
        },{
            type: status, 
            offset: {
                y: 20, 
                x: 320
            },
            spacing: 5,
            z_index: 1031,
            delay: 4000,
            timer: 1000,
            placement: {
                from: 'top', 
                align: 'right'
            },
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            }
        });

    };

})(jQuery);
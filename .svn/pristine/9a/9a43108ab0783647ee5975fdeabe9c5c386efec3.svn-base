(function($) {
    "use strict";

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

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
            $.getJSON('../controller/pemasaran/getKondisiDaftung.php?noagenda='+noagenda, function(data){
                if(data.success){
                    $('#unitap').val(data.unitap);
                    $('#noagenda_individu').val(data.noagenda_individu);
                    $('#noagenda').val(data.noagenda_individu);
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

                    $('#status_tmp').val(data.status_tmp);
                    if(data.status_tmp=='DALAM TMP'){
                        $('#status_tmp').addClass('text-success');
                    }else if(data.status_tmp=='MENDEKATI TMP'){
                        $('#status_tmp').addClass('text-warning');
                    }else{
                        $('#status_tmp').addClass('text-danger');
                    }

                    $('#status_proses').val(data.status_proses).addClass((data.status_proses=='BP >= RAB')?'text-success':'text-warning');

                    $('#status_kelayakan').val(data.status_kelayakan).selectpicker('refresh');
                    $('#keterangan_kelayakan').val(data.keterangan_kelayakan);
                    $('#kendala_pln').val(data.kendala_pln);
                    $('#kendala_plg').val(data.kendala_plg);
                    $('#sudah_spb').val(data.sudah_spb);
                    $('#belum_spb').val(data.belum_spb);
                    $('#prosentase_pekerjaan').val(data.prosentase_pekerjaan);
                    $('#tgl_estimasi_nyala').val(data.tgl_estimasi_nyala);
                    $('#solusi_percepatan').val(data.solusi_percepatan);
                    $('#keterangan').val(data.keterangan);

                    $('#update_kondisi input').prop('readonly', false);
                    $('#update_kondisi textarea').prop('readonly', false);
                }else{
                    showMsg(data.msg, 'warning');
                }

                $('div.content-body').unblock();
            });

        }else{
            showMsg('Silahkan masukan No Agenda yang akan dicari', 'warning');
        }


    });

    if(urlParams.has('noagenda')){
        $('#noagenda_cari').val(urlParams.get('noagenda'));
        $('#btn_noagenda_cari').trigger('click');
    }

    $('#btn_simpan').click(function(){
        console.log($('#update_kondisi').serialize());
        $('div.content-body').block({ message: 'Menyimpan data...' });
        $.post('../controller/pemasaran/simpanKondisi.php', $('#update_kondisi').serialize(), function(data){
            console.log(data);

            showMsg(data.msg,(data.success)?'success':'warning');

            $('#btn_noagenda_cari').trigger( "click" );

            $('div.content-body').unblock();
        }, 'json' );

    });

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
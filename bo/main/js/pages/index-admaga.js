$(function() {
    "use strict";

    var chart_unit, chart_akhir_unit, chart_akhir_tetap_unit, chart_blocking, chart_segmen_tegangan, chart_alasan, chart_ket_transaksi;

        // Parsing miss-matches and typo's
    var Format = wNumb({
        thousand: '.',
        decimals: 1
    });

    $('div.card').block({ message: '...' });
    $('div#card_ts_p2tl').block({ message: 'Mengambil data...' });
    $('div#card_ts_p2tl_akhir').block({ message: 'Mengambil data...' });
    $('div#card_ts_p2tl_akhir_tetap').block({ message: 'Mengambil data...' });
    $('div#card_blocking_token').block({ message: 'Mengambil data...' });
    $('div#card_saldo_awal').block({ message: 'Mengambil data...' });
    $('div#card_pengurangan').block({ message: 'Mengambil data...' });
    $('div#card_saldo_akhir').block({ message: 'Mengambil data...' });
    $('div#card_saldo_akhir_tetap').block({ message: 'Mengambil data...' });
    $('div#card_saldo_detail').block({ message: 'Mengambil data...' });
    $('div#card_rekap_blocking table tbody').empty();


    $.getJSON('../controller/ts_p2tl/getDashboardTSP2TLUnit.php', function(data){
        $('#tgl_data').html('tanggal data: '+data.tgl_data);

        $('#total_jml_plg').html(Format.to(data.total_jml_plg)+'<small> PLG</small>');
        $('#total_jml_agenda').html(Format.to(data.total_jml_agenda)+'<small> AGENDA</small>');
        $('#total_rpts').html('Rp. '+Format.to(data.total_rpts/1000000000)+'<small> M</small>');
        $('#total_pengurangan_jml_plg').html(Format.to(data.total_pengurangan_jml_plg)+'<small> PLG</small>');
        $('#total_pengurangan_jml_agenda').html(Format.to(data.total_pengurangan_jml_agenda)+'<small> AGENDA</small>');
        $('#total_pengurangan_rpts').html('Rp. '+Format.to(data.total_pengurangan_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_jml_plg').html(Format.to(data.total_saldo_akhir_jml_plg)+'<small> PLG</small>');
        $('#total_saldo_akhir_jml_agenda').html(Format.to(data.total_saldo_akhir_jml_agenda)+'<small> AGENDA</small>');
        $('#total_saldo_akhir_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_jml_plg2').html(Format.to(data.total_saldo_akhir_jml_plg)+'<small> PLG</small>');
        $('#total_saldo_akhir_rpts2').html('Rp. '+Format.to(data.total_saldo_akhir_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_prabayar_jml_plg').html(Format.to(data.total_saldo_akhir_prabayar_jml_plg)+'<small> PLG</small>');
        $('#total_saldo_akhir_prabayar_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_prabayar_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_paskabayar_jml_plg').html(Format.to(data.total_saldo_akhir_paskabayar_jml_plg)+'<small> PLG</small>');
        $('#total_saldo_akhir_paskabayar_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_paskabayar_rpts/1000000000)+'<small> M</small>');
        
        $('#total_sesuai_rpts').html('Rp. '+Format.to(data.total_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#total_sesuai_jml_agenda').html(Format.to(data.total_sesuai_jml_agenda)+'<small> AGENDA</small>');
        $('#total_tdk_sesuai_rpts').html('Rp. '+Format.to(data.total_tdk_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#total_tdk_sesuai_jml_agenda').html(Format.to(data.total_tdk_sesuai_jml_agenda)+'<small> AGENDA</small>');
        $('#total_pengurangan_sesuai_rpts').html('Rp. '+Format.to(data.total_pengurangan_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#total_pengurangan_sesuai_jml_agenda').html(Format.to(data.total_pengurangan_sesuai_jml_agenda)+'<small> AGENDA</small>');
        $('#total_pengurangan_tdk_sesuai_rpts').html('Rp. '+Format.to(data.total_pengurangan_tdk_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#total_pengurangan_tdk_sesuai_jml_agenda').html(Format.to(data.total_pengurangan_tdk_sesuai_jml_agenda)+'<small> AGENDA</small>');
        $('#total_saldo_akhir_sesuai_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_sesuai_jml_agenda').html(Format.to(data.total_saldo_akhir_sesuai_jml_agenda)+'<small> AGENDA</small>');
        $('#total_saldo_akhir_tdk_sesuai_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_tdk_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_tdk_sesuai_jml_agenda').html(Format.to(data.total_saldo_akhir_tdk_sesuai_jml_agenda)+'<small> AGENDA</small>');

        $('#total_saldo_akhir_tetap_rpts').html('Rp. '+Format.to((data.total_saldo_akhir_tetap_sesuai_rpts+data.total_saldo_akhir_tetap_tdk_sesuai_rpts)/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_tetap_jml_agenda').html(Format.to((data.total_saldo_akhir_tetap_sesuai_jml_agenda+data.total_saldo_akhir_tetap_tdk_sesuai_jml_agenda))+'<small> AGENDA</small>');
        $('#total_saldo_akhir_tetap_sesuai_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_tetap_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_tetap_sesuai_jml_agenda').html(Format.to(data.total_saldo_akhir_tetap_sesuai_jml_agenda)+'<small> AGENDA</small>');
        $('#total_saldo_akhir_tetap_tdk_sesuai_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_tetap_tdk_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_tetap_tdk_sesuai_jml_agenda').html(Format.to(data.total_saldo_akhir_tetap_tdk_sesuai_jml_agenda)+'<small> AGENDA</small>');

        $('#total_saldo_akhir_single_agenda_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_single_agenda_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_single_agenda_jml_plg').html(Format.to(data.total_saldo_akhir_single_agenda_jml_plg)+'<small> PLG</small>');
        $('#total_saldo_akhir_multi_agenda_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_multi_agenda_rpts/1000000000)+'<small> M</small>');
        $('#total_saldo_akhir_multi_agenda_jml_plg').html(Format.to(data.total_saldo_akhir_multi_agenda_jml_plg)+'<small> PLG</small>');
        
        $('#progress_blocking').css('width', data.total_persen_blocking+'%').attr('aria-valuenow', data.total_persen_blocking);  
        $('#text_persen_blocking').html(data.total_persen_blocking+'%');
        $('#text_blocking').html(Format.to(data.total_jml_blocking)+' dari '+Format.to(data.total_jml_harus_diblock)+' plg');

        $('#total_sesuai').html(Format.to(data.total_sesuai)+'<small> PLG</small>');
        $('#rp_sesuai').html('Rp. '+Format.to(data.rp_sesuai/1000000000)+'<small> M</small>');
        $('#total_ba_penetapan_sph_sesuai').html(Format.to(data.total_ba_penetapan_sph_sesuai)+'<small> PLG</small>');
        $('#total_ba_penetapan_sesuai').html(Format.to(data.total_ba_penetapan_sesuai)+'<small> PLG</small>');
        $('#total_ba_sesuai').html(Format.to(data.total_ba_sesuai)+'<small> PLG</small>');
        $('#total_tidak_sesuai').html(Format.to(data.total_tidak_sesuai)+'<small> PLG</small>');
        $('#total_semua_tidak_sesuai').html(Format.to(data.total_semua_tidak_sesuai)+'<small> PLG</small>');
        $('#rp_semua_tidak_sesuai').html('Rp. '+Format.to(data.rp_semua_tidak_sesuai/1000000000)+'<small> M</small>');
        $('#jml_sesuai_prabayar').html(Format.to(data.jml_sesuai_prabayar)+'<small> PLG</small>');
        $('#rp_sesuai_prabayar').html('Rp. '+Format.to(data.rp_sesuai_prabayar/1000000000)+'<small> M</small>');
        $('#jml_sesuai_paskabayar').html(Format.to(data.jml_sesuai_paskabayar)+'<small> PLG</small>');
        $('#rp_sesuai_paskabayar').html('Rp. '+Format.to(data.rp_sesuai_paskabayar/1000000000)+'<small> M</small>');


        $('#breakdown_jml_plg').html(Format.to(data.total_saldo_akhir_jml_plg)+'<small> PLG</small>');
        $('#breakdown_jml_agenda').html(Format.to(data.total_saldo_akhir_jml_agenda)+'<small> AGENDA</small>');
        $('#breakdown_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_sesuai_jml_plg').html(Format.to(data.total_saldo_akhir_sesuai_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_jml_agenda').html(Format.to(data.total_saldo_akhir_sesuai_jml_agenda)+'<small> AGENDA</small>');
        $('#breakdown_sesuai_rpts').html('Rp. '+Format.to(data.total_saldo_akhir_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_sesuai_lancar_jml_plg').html(Format.to(data.breakdown_sesuai_lancar_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_lancar_jml_agenda').html(Format.to(data.breakdown_sesuai_lancar_jml_agenda)+'<small> AGENDA</small>');
        $('#breakdown_sesuai_lancar_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_lancar_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_sesuai_tdk_lancar_jml_plg').html(Format.to(data.breakdown_sesuai_tdk_lancar_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_tdk_lancar_jml_agenda').html(Format.to(data.breakdown_sesuai_tdk_lancar_jml_agenda)+'<small> AGENDA</small>');
        $('#breakdown_sesuai_tdk_lancar_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_tdk_lancar_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_sesuai_tdk_lancar_blocking_jml_plg').html(Format.to(data.breakdown_sesuai_tdk_lancar_blocking_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_tdk_lancar_blocking_jml_agenda').html(Format.to(data.breakdown_sesuai_tdk_lancar_blocking_jml_agenda)+'<small> AG</small>');
        $('#breakdown_sesuai_tdk_lancar_blocking_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_tdk_lancar_blocking_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_sesuai_tdk_lancar_blm_blocking_jml_plg').html(Format.to(data.breakdown_sesuai_tdk_lancar_blm_blocking_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_tdk_lancar_blm_blocking_jml_agenda').html(Format.to(data.breakdown_sesuai_tdk_lancar_blm_blocking_jml_agenda)+'<small> AG</small>');
        $('#breakdown_sesuai_tdk_lancar_blm_blocking_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_tdk_lancar_blm_blocking_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_jml_plg').html(Format.to(data.total_saldo_akhir_tdk_sesuai_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_jml_agenda').html(Format.to(data.total_saldo_akhir_tdk_sesuai_jml_agenda)+'<small> AGENDA</small>');
        $('#breakdown_tdk_sesuai_rpts').html('Rp.'+Format.to(data.total_saldo_akhir_tdk_sesuai_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_lancar_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_lancar_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_lancar_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_lancar_jml_agenda)+'<small> AGENDA</small>');
        $('#breakdown_tdk_sesuai_lancar_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_lancar_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_jml_agenda)+'<small> AGENDA</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_tdk_lancar_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blocking_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blocking_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blocking_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blocking_jml_agenda)+'<small> AG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blocking_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blocking_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blm_blocking_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blm_blocking_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blm_blocking_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blm_blocking_jml_agenda)+'<small> AG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blm_blocking_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blm_blocking_rpts/1000000000)+'<small> M</small>');


        $('#breakdown_sesuai_lancar_beli_token_jml_plg').html(Format.to(data.breakdown_sesuai_lancar_beli_token_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_lancar_beli_token_jml_agenda').html(Format.to(data.breakdown_sesuai_lancar_beli_token_jml_agenda)+'<small> AG</small>');
        $('#breakdown_sesuai_lancar_beli_token_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_lancar_beli_token_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_sesuai_lancar_tdk_beli_token_jml_plg').html(Format.to(data.breakdown_sesuai_lancar_tdk_beli_token_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_lancar_tdk_beli_token_jml_agenda').html(Format.to(data.breakdown_sesuai_lancar_tdk_beli_token_jml_agenda)+'<small> AG</small>');
        $('#breakdown_sesuai_lancar_tdk_beli_token_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_lancar_tdk_beli_token_rpts/1000000000)+'<small> M</small>');

        $('#breakdown_tdk_sesuai_lancar_beli_token_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_lancar_beli_token_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_lancar_beli_token_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_lancar_beli_token_jml_agenda)+'<small> AG</small>');
        $('#breakdown_tdk_sesuai_lancar_beli_token_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_lancar_beli_token_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_lancar_tdk_beli_token_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_lancar_tdk_beli_token_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_lancar_tdk_beli_token_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_lancar_tdk_beli_token_jml_agenda)+'<small> AG</small>');
        $('#breakdown_tdk_sesuai_lancar_tdk_beli_token_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_lancar_tdk_beli_token_rpts/1000000000.0)+'<small> M</small>');

        $('#breakdown_sesuai_lancar_beli_token_koordinat_jml_plg').html(Format.to(data.breakdown_sesuai_lancar_beli_token_koordinat_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_lancar_tdk_beli_token_koordinat_jml_plg').html(Format.to(data.breakdown_sesuai_lancar_tdk_beli_token_koordinat_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_lancar_beli_token_koordinat_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_lancar_beli_token_koordinat_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_jml_plg)+'<small> PLG</small>');

        $('#breakdown_sesuai_tdk_lancar_blocking_koordinat_jml_plg').html(Format.to(data.breakdown_sesuai_tdk_lancar_blocking_koordinat_jml_plg)+'<small> PLG</small>');
        $('#breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_jml_plg').html(Format.to(data.breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_jml_plg)+'<small> PLG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_jml_plg').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_jml_plg)+'<small> PLG</small>');
        
        $('#breakdown_sesuai_lancar_beli_token_koordinat_jml_agenda').html(Format.to(data.breakdown_sesuai_lancar_beli_token_koordinat_jml_agenda)+'<small> AG</small>');
        $('#breakdown_sesuai_lancar_tdk_beli_token_koordinat_jml_agenda').html(Format.to(data.breakdown_sesuai_lancar_tdk_beli_token_koordinat_jml_agenda)+'<small> AG</small>');
        $('#breakdown_tdk_sesuai_lancar_beli_token_koordinat_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_lancar_beli_token_koordinat_jml_agenda)+'<small> AG</small>');
        $('#breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_jml_agenda)+'<small> AG</small>');

        $('#breakdown_sesuai_tdk_lancar_blocking_koordinat_jml_agenda').html(Format.to(data.breakdown_sesuai_tdk_lancar_blocking_koordinat_jml_agenda)+'<small> AG</small>');
        $('#breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_jml_agenda').html(Format.to(data.breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_jml_agenda)+'<small> AG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_jml_agenda)+'<small> AG</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_jml_agenda').html(Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_jml_agenda)+'<small> AG</small>');

        $('#breakdown_sesuai_lancar_beli_token_koordinat_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_lancar_beli_token_koordinat_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_sesuai_lancar_tdk_beli_token_koordinat_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_lancar_tdk_beli_token_koordinat_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_lancar_beli_token_koordinat_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_lancar_beli_token_koordinat_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_rpts/1000000000)+'<small> M</small>');

        $('#breakdown_sesuai_tdk_lancar_blocking_koordinat_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_tdk_lancar_blocking_koordinat_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_rpts').html('Rp.'+Format.to(data.breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_rpts/1000000000)+'<small> M</small>');
        $('#breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_rpts').html('Rp.'+Format.to(data.breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_rpts/1000000000)+'<small> M</small>');
        

        $('div#card_saldo_awal').unblock();
        $('div#card_pengurangan').unblock();
        $('div#card_saldo_akhir').unblock();
        $('div#card_saldo_detail').unblock();
        $('div#card_saldo_akhir_tetap').unblock();
        $('div.card').unblock();

        var ctx = document.getElementById("chart_ts_p2tl_unit");
        ctx.height = 240;
        chart_unit = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "Prabayar",
                        type: "bar",
                        stack: 'TS P2TL',
                        backgroundColor: "#135470",
                        backgroundColorHover: "#135470",
                        data: data.jml_prabayar,
                    },
                    {
                        label: "Paskabayar",
                        type: "bar",
                        stack: 'TS P2TL',
                        backgroundColor: "#74BCA7",
                        backgroundColorHover: "#74BCA7",
                        data: data.jml_paskabayar,
                    },
                    {
                        label: "Agenda Sesuai",
                        type: "bar",
                        stack: 'TS P2TL per Kelengkapan',
                        backgroundColor: "#135450",
                        backgroundColorHover: "#135450",
                        data: data.sesuai_jml_agenda,
                    },
                    {
                        label: "Agenda Tidak Sesuai",
                        type: "bar",
                        stack: 'TS P2TL per Kelengkapan',
                        backgroundColor: "#EC5B43",
                        backgroundColorHover: "#EC5B43",
                        data: data.tdk_sesuai_jml_agenda,
                    },
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false, 
                barRadius: 2,
                title: {
                    display: false,
                    text: 'Rekap TS P2TL'
                },
                // tooltips: {
                //     mode: 'index',
                //     intersect: false,
                //     callbacks: {
                //     }
                // },
                tooltips: {
                   mode: 'label',
                   callbacks: {
                      label: function(t, d) {
                         var dstLabel = d.datasets[t.datasetIndex].label;
                         var yLabel = t.yLabel;
                         return dstLabel + ': ' + Format.to(yLabel) ;
                      }
                   }
                },
                legend: {
                    position: 'bottom',
                    display: true,
                    stacked: true,
                    labels: {
                        // fontFamily: 'CircularStdBook',
                    },
                },
                plugins: {
                    labels: []
                },
                scales: {
                    yAxes: [{
                        display: false,
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                    }]
                }
            }
        });

        $('div#card_ts_p2tl').unblock();

        var ctx2 = document.getElementById("chart_ts_p2tl_akhir_unit");
        ctx2.height = 240;
        chart_akhir_unit = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "Prabayar",
                        type: "bar",
                        stack: 'TS P2TL',
                        backgroundColor: "#135470",
                        backgroundColorHover: "#135470",
                        data: data.saldo_akhir_prabayar_jml_plg,
                    },
                    {
                        label: "Paskabayar",
                        type: "bar",
                        stack: 'TS P2TL',
                        backgroundColor: "#74BCA7",
                        backgroundColorHover: "#74BCA7",
                        data: data.saldo_akhir_paskabayar_jml_plg,
                    },
                    {
                        label: "Agenda Sesuai",
                        type: "bar",
                        stack: 'TS P2TL per Kelengkapan',
                        backgroundColor: "#135450",
                        backgroundColorHover: "#135450",
                        data: data.saldo_akhir_sesuai_jml_agenda,
                    },
                    {
                        label: "Agenda Tidak Sesuai",
                        type: "bar",
                        stack: 'TS P2TL per Kelengkapan',
                        backgroundColor: "#EC5B43",
                        backgroundColorHover: "#EC5B43",
                        data: data.saldo_akhir_tdk_sesuai_jml_agenda,
                    },
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false, 
                barRadius: 2,
                title: {
                    display: false,
                    text: 'Rekap TS P2TL'
                },
                // tooltips: {
                //     mode: 'index',
                //     intersect: false,
                //     callbacks: {
                //     }
                // },
                tooltips: {
                   mode: 'label',
                   callbacks: {
                      label: function(t, d) {
                         var dstLabel = d.datasets[t.datasetIndex].label;
                         var yLabel = t.yLabel;
                         return dstLabel + ': ' + Format.to(yLabel) ;
                      }
                   }
                },
                legend: {
                    position: 'bottom',
                    display: true,
                    stacked: true,
                    labels: {
                        // fontFamily: 'CircularStdBook',
                    },
                },
                plugins: {
                    labels: []
                },
                scales: {
                    yAxes: [{
                        display: false,
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                    }]
                }
            }
        });

        $('div#card_ts_p2tl_akhir').unblock();


        var ctx3 = document.getElementById("chart_ts_p2tl_akhir_tetap_unit");
        ctx3.height = 240;
        chart_akhir_tetap_unit = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "Agenda Sesuai",
                        type: "bar",
                        stack: 'TS P2TL per Kelengkapan',
                        backgroundColor: "#135450",
                        backgroundColorHover: "#135450",
                        data: data.saldo_akhir_tetap_sesuai_jml_agenda,
                    },
                    {
                        label: "Agenda Tidak Sesuai",
                        type: "bar",
                        stack: 'TS P2TL per Kelengkapan',
                        backgroundColor: "#EC5B43",
                        backgroundColorHover: "#EC5B43",
                        data: data.saldo_akhir_tetap_tdk_sesuai_jml_agenda,
                    },
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false, 
                barRadius: 2,
                title: {
                    display: false,
                    text: 'Rekap TS P2TL'
                },
                // tooltips: {
                //     mode: 'index',
                //     intersect: false,
                //     callbacks: {
                //     }
                // },
                tooltips: {
                   mode: 'label',
                   callbacks: {
                      label: function(t, d) {
                         var dstLabel = d.datasets[t.datasetIndex].label;
                         var yLabel = t.yLabel;
                         return dstLabel + ': ' + Format.to(yLabel) ;
                      }
                   }
                },
                legend: {
                    position: 'bottom',
                    display: true,
                    stacked: true,
                    labels: {
                        // fontFamily: 'CircularStdBook',
                    },
                },
                plugins: {
                    labels: []
                },
                scales: {
                    yAxes: [{
                        display: false,
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                    }]
                }
            }
        });

        $('div#card_ts_p2tl_akhir_tetap').unblock();


        var ctx4 = document.getElementById("chart_blocking_unit");
        ctx4.height = 240;
        chart_blocking_unit = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: data.singkatan,
                datasets: [
                    {
                        label: "Sudah Blocking Token",
                        type: "bar",
                        stack: 'Status Blocking',
                        backgroundColor: "#135450",
                        backgroundColorHover: "#135450",
                        data: data.jml_blocking,
                    },
                    {
                        label: "Belum Blocking Token",
                        type: "bar",
                        stack: 'Status Blocking',
                        backgroundColor: "#EC5B43",
                        backgroundColorHover: "#EC5B43",
                        data: data.jml_blm_blocking,
                    },
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false, 
                barRadius: 2,
                title: {
                    display: false,
                    text: 'Rekap TS P2TL'
                },
                // tooltips: {
                //     mode: 'index',
                //     intersect: false,
                //     callbacks: {
                //     }
                // },
                tooltips: {
                   mode: 'label',
                   callbacks: {
                      label: function(t, d) {
                         var dstLabel = d.datasets[t.datasetIndex].label;
                         var yLabel = t.yLabel;
                         return dstLabel + ': ' + Format.to(yLabel) ;
                      }
                   }
                },
                legend: {
                    position: 'bottom',
                    display: true,
                    stacked: true,
                    labels: {
                        // fontFamily: 'CircularStdBook',
                    },
                },
                plugins: {
                    labels: []
                },
                scales: {
                    yAxes: [{
                        display: false,
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                    }]
                }
            }
        });

        $('div#card_blocking_token').unblock();


        var tr = '';
        $.each(data.rows, function(k,v){
            tr += '<tr>';
            tr += '<td>'+v.unit+'</td>';
            tr += '<td>'+v.nama+'</td>';
            tr += '<td>'+v.jml_plg+'</td>';
            tr += '<td>'+v.jml_harus_diblock+'</td>';
            tr += '<td>'+v.jml_blocking+'</td>';
            tr += '<td>'+v.jml_blm_blocking+'</td>';
            tr += '<td>'+v.persen_blocking+'%</td>';
            tr += '</tr>';
        });

        tr += '<tr>';
        tr += '<td></td>';
        tr += '<td><strong>TOTAL</strong></td>';
        tr += '<td><strong>'+Format.to(data.total_jml_plg)+'</strong></td>';
        tr += '<td><strong>'+Format.to(data.total_jml_harus_diblock)+'</strong></td>';
        tr += '<td><strong>'+Format.to(data.total_jml_blocking)+'</strong></td>';
        tr += '<td><strong>'+Format.to(data.total_jml_blm_blocking)+'</strong></td>';
        tr += '<td><strong>'+data.total_persen_blocking+'%</strong></td>';
        tr += '</tr>';

        $('div#card_rekap_blocking table tbody').append(tr);
        $('div#card_rekap_blocking').unblock();




    });

    $('#sel_unit').change(function(){
        var unitap=this.value;

        $('div#card_ts_p2tl').block({ message: 'Mengambil data...' });
        $('div#card_ts_p2tl_akhir').block({ message: 'Mengambil data...' });
        $('div#card_blocking_token').block({ message: 'Mengambil data...' });
        $('div#card_saldo_awal').block({ message: 'Mengambil data...' });
        $('div#card_pengurangan').block({ message: 'Mengambil data...' });
        $('div#card_saldo_akhir').block({ message: 'Mengambil data...' });
        $('div#card_saldo_detail').block({ message: 'Mengambil data...' });
        $('div#card_rekap_blocking table tbody').empty();

        $.getJSON('../controller/getDashboardPermohonan.php?unitap='+unitap, function(data){
            $('div#card_permohonan').unblock();
            $('#total_agenda').html(data.total_agenda);
            $('#total_agenda_rab').html(data.total_agenda_rab);
            $('#total_proses').html(data.total_proses);
            $('#total_evaluasi').html(data.total_evaluasi);
            chart_unit.data.labels = data.singkatan;
            chart_unit.data.datasets[0].data = data.jml_proses;
            chart_unit.data.datasets[1].data = data.jml_evaluasi;
            chart_unit.data.datasets[2].data = data.jml_agenda_dalam_tmp;
            chart_unit.data.datasets[3].data = data.jml_agenda_mendekati_tmp;
            chart_unit.data.datasets[4].data = data.jml_agenda_melebihi_tmp;
            chart_unit.update();

            $.getJSON('../controller/getDashboardPermohonanTMP.php?unitap='+unitap, function(data){
                $('div#card_permohonan_tmp').unblock();
                chart_tmp.data.datasets[0].data = data.jml_permohonan;
                chart_tmp.data.labels = data.status_tmp;
                chart_tmp.update();

                $.getJSON('../controller/getDashboardPermohonanStatusProses.php?unitap='+unitap, function(data){
                    $('div#card_permohonan_status_proses').unblock();
                    chart_status_proses.data.datasets[0].data = data.jml_permohonan;
                    chart_status_proses.data.labels = data.status_proses;
                    chart_status_proses.update();

                    $.getJSON('../controller/getDashboardPermohonanAlasan.php?unitap='+unitap, function(data){
                        $('div#card_permohonan_alasan').unblock();
                        chart_alasan.data.datasets[0].data = data.jml_permohonan;
                        chart_alasan.data.labels = data.alasan_kriteria_tmp;
                        chart_alasan.update();

                        $.getJSON('../controller/getDashboardPermohonanJenis.php?unitap='+unitap, function(data){
                            $('div#card_permohonan_jenis').unblock();
                            chart_ket_transaksi.data.datasets[0].data = data.jml_permohonan;
                            chart_ket_transaksi.data.labels = data.ket_transaksi;
                            chart_ket_transaksi.update();

                            $.getJSON('../controller/getDashboardPermohonanTerbaru.php?unitap='+unitap, function(data){
                                var tr = '';
                                $.each(data.rows, function(k,v){
                                    tr += '<tr>';
                                    tr += '<td><a href="info-agenda.php?noagenda='+v.noagenda+'" target="_blank">'+v.noagenda+'</a></td>';
                                    tr += '<td>'+v.tglmohon+'</td>';
                                    tr += '<td>'+v.jenis_transaksi+'</td>';
                                    tr += '<td>'+v.tarif_daya_lama+'</td>';
                                    tr += '<td>'+v.tarif_daya_baru+'</td>';
                                    // tr += '<td>'+v.alasan_kriteria_tmp+'</td>';
                                    tr += '<td>'+v.rp_bp+'</td>';
                                    tr += '<td>'+v.rp_rab+'</td>';
                                    tr += '<td><span class="label '+v.label_status+'">'+v.status+'</span></td>';
                                    tr += '</tr>';
                                });
                                $('div#card_latest_agenda table tbody').append(tr);
                                $('div#card_latest_agenda').unblock();
                            });
                        });
                    });
                });
            });
        });
    });

    // draw background
    var backgroundColor = 'white';
    Chart.plugins.register({
        beforeDraw: function(c) {
            var ctx = c.chart.ctx;
            ctx.fillStyle = backgroundColor;
            ctx.fillRect(0, 0, c.chart.width, c.chart.height);
        }
    });

    $(".btn-download").click(function(){
        console.log('download');
        var canvas = $(this).closest( ".card" ).children('.card-body').children('canvas');

        canvas.get(0).toBlob(function(blob) {
            saveAs(blob, "Chart.png");
        });
    });

});
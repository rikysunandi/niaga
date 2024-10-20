(function($) {
    "use strict"

    var processing=false;
    var drEvent = $('.dropify').dropify();
    drEvent = drEvent.data('dropify');
    drEvent.resetPreview();
    drEvent.clearElement();

    $('#btn_upload').prop('disabled', true);
    $("input[type=file]").change(function(){
        console.log($(this).val());
        if($(this).val() != ''){
            $('#btn_upload').prop('disabled', false);
        }else{
            $('#btn_upload').prop('disabled', true);
        }
    });

    $(".dropify-clear").on('click', function(){
        $('#btn_upload').prop('disabled', true);
    });

    $('#btn_upload').click(function(){

        processing = true;
        $('div.content-body').block({ message: 'Mengupload data...' });
        $('div#result').html('');
        console.log('Upload...');

        $('.dropify').parse({
            config:{
                complete: function(results){
                    console.log("Result...", results);
                    var datas = results.data;

                    var startTime = new Date().getTime();
                    $('.progress-upload').removeClass('d-none');

                    // for(var i = 0; i < datas.length-1; i++) {
                    //     let data = datas[i];
                        
                    //     var valeur = Math.round((i/data.length)*100);
                    //     console.log('valeur', valeur);
                    //     console.log('data[i][7]', data[7]);
                    //     $('.progress-bar').css('width', valeur+'%').text(valeur + " %").attr('aria-valuenow', valeur);
                    //     $('.progress-upload .d-flex span').html('Mohon menunggu, mengupload Agenda '+data[7]+' ke Database...');              
                    //     $.post('../controller/pemasaran/simpanDaftung.php', {data: data[i]}, function(res){
                    //         console.log(res);
                    //     }, 'json' );

                    // }
                    var success_count=0;

                    uploadKeDB(datas, 1);

                    function uploadKeDB(data, idx){

                        var valeur = Math.round((idx/data.length)*100);
                        var now = new Date().getTime();
                        var duration = ( now - startTime ) / 1000;
                        var tf_rate = (idx) / (duration);
                        tf_rate = Math.floor(tf_rate);
                        var estimasi = Math.ceil(((data.length-idx)/tf_rate)/60);
                        //console.log('tf_rate', tf_rate);
                        //console.log('valeur', valeur);
                        console.log('data[idx][7]', data[idx][7]);
                        console.log(startTime);
                        $('.progress-bar').css('width', valeur+'%').text(valeur + " %").attr('aria-valuenow', valeur);

                        if(idx >= data.length - 1){
                            //$('.progress-upload').addClass('d-none');
                            $('.progress-upload .d-flex span.msg').html('Mohon menunggu, menghitung RAB Agenda Kolektif...');              
                            $('.progress-upload .d-flex span.info').html('...');              
                            
                            console.log('Hitung RAB Kolektif!');
                            $.post('../controller/pemasaran/hitungRABKolektif.php', {startTime: startTime}, function(res){
                                console.log(res);
                                var jml_agenda_kolektif = res.jml_agenda_kolektif;

                                if(res.success || res.success=='true'){
                                    $('.progress-upload .d-flex span.msg').html('Proses selesai');    
                                    $('.progress-upload .d-flex span.info').html('');  


                                    $('.progress-upload .d-flex span.msg').html('Mohon menunggu, memindahkan agenda yang sudah keluar dari Daftung...');              
                                    $('.progress-upload .d-flex span.info').html('...');              

                                    $.post('../controller/pemasaran/cleansingDaftung.php', {startTime: startTime}, function(res){
                                        console.log(res);

                                        if(res.success || res.success=='true'){
                                            $('.progress-upload .d-flex span.msg').html('Proses selesai');    
                                            $('.progress-upload .d-flex span.info').html('');   
                                            $('div#result').html($('div#result').html()+'<br/>'+'<span class="text-success">Update data selesai, '+success_count+' Agenda ('+jml_agenda_kolektif+' Agenda Kolektif) berhasil diupload</span>');
                                        }

                                        $('div.content-body').unblock();
                                        processing = false;

                                    }, 'json' );

                                }


                            }, 'json' );

                        }else{

                            $('.progress-upload .d-flex span.msg').html('Mohon menunggu, mengupload Agenda '+data[idx][7]+' ke Database...');              
                            $('.progress-upload .d-flex span.info').html('Estimasi: '+estimasi+' menit (Transfer rate: '+tf_rate+' record / detik)');              
                            $.post('../controller/pemasaran/simpanDaftung.php', {data: data[idx], startTime: startTime}, function(res){
                                console.log(res);

                                if(!res.success || res.success=='false'){
                                    $('div#result').html($('div#result').html()+'<br/>'+'<span class="text-danger">'+res.noagenda+'</span>');
                                }else{
                                    success_count++;
                                }

                                idx = idx+1;
                                uploadKeDB(data, idx);
                            }, 'json' );
                        }
                    }
                },
            },
            before: function(file, inputElem)
            {
                //start = now();
                console.log("Parsing file...", file);
            },
            error: function(err, file)
            {
                console.log("ERROR:", err, file);
                firstError = firstError || err;
                errorCount++;
            },
            complete: function()
            {
                //console.log("Result...", results);
                // end = now();
                // printStats("Done with all files");
            }
        });
    });

    $('iframe#daftung_ap2t').attr('src','blank.html');

    $('#btn_cari').click(function(){

        $('div.content-body').block({ message: 'Mengambil data...' });
        var unitupi = $('#sel_unitupi').val();
        var unitap = $('#sel_unitap').val();
        var unitup = $('#sel_unitup').val();
        var blth = $('#sel_blth').val();
        var url;
        if(unitup!='00') url = 'https://ap2t.pln.co.id/cube/laporan.aspx?jenis=rekap_pdl_up&parameter=%27'+unitup+'%27;%27'+blth+'%27';
        else if(unitap!='00') url = 'https://ap2t.pln.co.id/cube/laporan.aspx?jenis=rekap_pdl_ap&parameter=%27'+unitap+'%27;%27'+blth+'%27';
        else url = 'https://ap2t.pln.co.id/cube/laporan.aspx?jenis=rekap_pdl_upi&parameter=%27'+unitupi+'%27;%27'+blth+'%27';
        //https://ap2t.pln.co.id/cube/laporan.aspx?jenis=rekap_pdl_up&parameter=%2753551%27;%27202302%27
        //https://ap2t.pln.co.id/cube/laporan.aspx?jenis=rekap_pdl_ap&parameter=%2753BDG%27;%27202302%27
        //https://ap2t.pln.co.id/cube/laporan.aspx?jenis=rekap_pdl_upi&parameter=%2753%27;%27202302%27
        $('iframe#daftung_ap2t').attr('src',url);
    
        $('iframe#daftung_ap2t').on('load', function(){
            //$(this).show();
            $('div.content-body').unblock();
        });
    });

    window.onbeforeunload = confirmExit;
    function confirmExit() {
        if(processing)
            return "Anda masih memiliki proses upload yang belum selesai. Apakah anda yakin untuk keluar halaman ini?";
    }


})(jQuery);
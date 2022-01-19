(function($) {
    "use strict"

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: moment().subtract(1, 'months').format('DD/MM/YYYY'),
        // endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });

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

        $('.dropify').parse({
            config:{
                complete: function(results){
                    console.log("Result...", results);
                    var datas = results.data;

                    var startTime = new Date().getTime();
                    $('.progress-upload').removeClass('d-none');

                    var success_count=0;

                    uploadKeDB(datas, 1);

                    function uploadKeDB(data, idx){

                        var valeur = Math.round((idx/data.length)*100);
                        var now = new Date().getTime();
                        var duration = ( now - startTime ) / 1000;
                        var tf_rate = (idx) / (duration);
                        tf_rate = Math.floor(tf_rate);
                        var estimasi = Math.ceil(((data.length-idx)/tf_rate)/60);
                        console.log('tf_rate', tf_rate);
                        console.log('valeur', valeur);
                        console.log('data[idx][4]', data[idx][4]);
                        $('.progress-bar').css('width', valeur+'%').text(valeur + " %").attr('aria-valuenow', valeur);

                        if(idx >= data.length - 1){
                            //$('.progress-upload').addClass('d-none');
                            $('.progress-upload .d-flex span.msg').html('Mohon menunggu, memindahkan agenda yang sudah keluar dari Dapot...');              
                            $('.progress-upload .d-flex span.info').html('...');              
                            
                            $.post('../controller/pemasaran/cleansingDapot.php', {startTime: startTime}, function(res){
                                console.log(res);

                                if(res.success || res.success=='true'){
                                    $('.progress-upload .d-flex span.msg').html('Proses selesai');    
                                    $('.progress-upload .d-flex span.info').html('');   
                                    $('div#result').html($('div#result').html()+'<br/>'+'<span class="text-success">Update data selesai, '+success_count+' agenda berhasil diupload</span>');
                                }

                                $('div.content-body').unblock();
                                processing = false;

                            }, 'json' );

                        }else{

                            $('.progress-upload .d-flex span.msg').html('Mohon menunggu, mengupload Agenda '+data[idx][4]+' ke Database...');              
                            $('.progress-upload .d-flex span.info').html('Estimasi: '+estimasi+' menit (Transfer rate: '+tf_rate+' record / detik)');              
                            $.post('../controller/pemasaran/simpanDapot.php', {data: data[idx], startTime: startTime}, function(res){
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

    $('iframe#dapot_ap2t').attr('src','blank.html');

    $('#btn_cari').click(function(){
        $('div.content-body').block({ message: 'Mengambil data...' });

        var unitupi = $('#sel_unitupi').val();
        if(unitupi=='00') unitupi = 'SEMUA';
        var unitap = $('#sel_unitap').val();
        if(unitap=='00') unitap = 'SEMUA';

        var start_date = $('#tgl_mohon_range').data('daterangepicker').startDate.format('YYYYMMDD');
        var end_date = $('#tgl_mohon_range').data('daterangepicker').endDate.format('YYYYMMDD');
        
        $('iframe#dapot_ap2t').attr('src','https://ap2t.pln.co.id/cube/laporan.aspx?jenis=rekap_mohon_pbpd_baru&parameter=%27'+unitupi+'%27,%27'+unitap+'%27,%27SEMUA%27,%27'+start_date+'%27,%27'+end_date+'%27,%27SEMUA%20TRANSAKSI%27,%27BELUM%20BAYAR%27,%27%27,%27%27,%27SEMUA%20STATUS%27,%27%27,%27%27&piped=true');
    
        $('iframe#dapot_ap2t').on('load', function(){
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
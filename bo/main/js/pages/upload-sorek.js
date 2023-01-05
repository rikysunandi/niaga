(function($) {
    "use strict"

    var processing=false;
    // var drEvent = $('.dropify').dropify();
    // drEvent = drEvent.data('dropify');
    // drEvent.resetPreview();
    // drEvent.clearElement();
    $('#btn_upload').prop('disabled', true);
    var queueUpload = new Array();
    var finishUpload;

    function prosesUpload(idx){

        //var progress = $( ".progress-upload:first" ).clone().appendTo( ".container-fluid" );
        //console.log($(progress).find('.msg')[0]);

        if(idx<queueUpload.length){

            var progress = queueUpload[idx];
            var blth = $(progress).data('blth');
            var unitupi = $(progress).data('unitupi');
            var unitap = $(progress).data('unitap');
            var unitup = $(progress).data('unitup');
            var filename = $(progress).data('filename');
            var ori_filename = $(progress).data('ori_filename');
            var rowcount = $(progress).data('rowcount');
            console.log(progress);
            console.log('$(progress)', $(progress));
            console.log('filename', filename);

            $($(progress).find('.msg')[0]).html('Mengupdate Sorek dari File '+ori_filename+', mohon menunggu...');
            $($(progress).find('.progress-bar')[0]).removeClass('bg-light');
            $($(progress).find('.progress-bar')[0]).addClass('bg-warning');
            $($(progress).find('.progress-bar')[0]).addClass('progress-bar-striped');
            $($(progress).find('.progress-bar')[0]).addClass('progress-bar-animated');
            $($(progress).find('.progress-bar')[0]).css('width', '100%').attr('aria-valuenow', 100);

            $.post('../controller/sorek/prosesSorek.php', { 
                    blth: blth, 
                    unitupi: unitupi, 
                    unitap: unitap, 
                    unitup: unitup, 
                    filename: filename, 
                    ori_filename: ori_filename,
                    rowcount: rowcount
                }, function(res){
                //progress-bar progress-bar-striped progress-bar-animated bg-warning
               $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-striped');
               $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-animated');
               $($(progress).find('.progress-bar')[0]).removeClass('bg-warning');
               res = JSON.parse(res);
               console.log(res);
               if(res.success=='true' || res.success==true){
                    console.log('sukses', res.msg);
                    $($(progress).find('.progress-bar')[0]).addClass('bg-success');
                    $($(progress).find('.msg')[0]).html(res.msg+', silahkan cek di <a href="mon-upload-sorek.php" class="badge badge-primary" target="_blank">di sini</a> &nbsp;<i class="fa fa-check-circle text-success"></i>');
               }else{
                    $($(progress).find('.progress-bar')[0]).addClass('bg-danger');
                    $($(progress).find('.msg')[0]).html(res.msg);
               }
               queueUpload.splice(0, 1);
               //idx = idx+1;
               console.log('queueUpload after splice', queueUpload);
               prosesUpload(idx);

            });
        }

    }

    Dropzone.options.uploadSorek = {
        acceptedFiles: '.xls,.csv',
        addRemoveLinks: true,
        clickable: true,
        maxFiles: 5,
        timeout: 300000,
        maxFilesize: 40,
        parallelUploads: 2,
        autoProcessQueue: false,
        init: function() {

            this.on("addedfile", file => {
                $('#btn_upload').prop('disabled', false);
            });
            this.on("processing", function(file, xhr, formData) {
                console.log('processing');
                this.options.autoProcessQueue = true;
            });
            this.on("sending", function(file, xhr, formData) {
                console.log(file);
                console.log(this);
                var dz = this;

                formData.append("unitupi", $('#sel_unitupi').val()); 
                formData.append("unitap", $('#sel_unitap').val()); 
                formData.append("unitup", $('#sel_unitup').val()); 
                formData.append("blth", $('#sel_blth').val()); 

                xhr.ontimeout = function (e) {
                  if (file.status === Dropzone.UPLOADING) {
                      dz.cancelUpload(file);
                    }   
                  $(file.previewElement).find('.dz-error-message').text('Waktu upload sudah habis, silahkan periksa isi File!');
                  console.log("Argh I timed out")
                };
            });
            this.on('error', function(file, response) {
                console.log('error');
                $(file.previewElement).find('.dz-error-message').text(response);
            });
            // this.on("complete", function() {
            //     $('#btn_upload').prop('disabled', true);
            //     this.options.autoProcessQueue = false;
            // });

            this.on("success", function (file, response) {
                // console.log(file);
                // console.log(response);
                if (response === "") {
                    if (file.status === Dropzone.UPLOADING) {
                      this.cancelUpload(file);
                    }   
                    $(file.previewElement).find('.dz-error-message').text('Error, silahkan periksa isi File!');
                  
                }else{
                    this.removeFile(file);
                    var data = JSON.parse(response);
                    if(data.success){
                        var progress = $( ".progress-upload:first" ).clone().appendTo( ".container-fluid" );
                        //console.log($(progress).find('.msg')[0]);

                        $($(progress).find('.msg')[0]).html(file.name+', menunggu antrian...');
                        $(progress).removeClass('d-none');
                        $(progress).data('blth', data.blth);
                        $(progress).data('unitupi', data.unitupi);
                        $(progress).data('unitap', data.unitap);
                        $(progress).data('unitup', data.unitup);
                        $(progress).data('filename', data.filename);
                        $(progress).data('ori_filename', file.name);
                        $(progress).data('rowcount', data.rowcount);

                        if(queueUpload.length==0){
                            queueUpload.push(progress);
                            console.log('queueUpload', queueUpload);
                            prosesUpload(0);
                        }else{
                            queueUpload.push(progress);
                            console.log('queueUpload', queueUpload);
                        }
                    }else{
                        alert(response.msg);
                    }

                }
            });
        }

    };

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
        console.log($('#sel_unitupi').val());
        if(
            $('#sel_unitupi').val()!=null && 
            $('#sel_unitap').val()!=null && 
            $('#sel_unitup').val()!=null && 
            $('#sel_blth').val()!=null
        ){
            var myDropzone = Dropzone.forElement(".dropzone");
            myDropzone.processQueue();
        }else{
            alert('Silahkan pilih unit dan blth yang akan diupload!!'); //, 'warning');
        }
    });


    // $('#btn_upload').click(function(){

    //     processing = true;
    //     $('div.content-body').block({ message: 'Mengupload data...' });
    //     $('div#result').html('');
    //     console.log('Upload...');

    //     var file_data = $('#file_Sorek').prop('files')[0];
       //  var form_data = new FormData();
       //  form_data.append('unitupi', $('#sel_unitupi').val() );
       //  form_data.append('unitap', $('#sel_unitap').val() );
       //  form_data.append('unitup', $('#sel_unitup').val() );
       //  form_data.append('file', file_data);
       //  $.ajax({
       //      url: '../controller/Sorek/uploadFileSorek.php', // <-- point to server-side PHP script
       //      dataType: 'text',  // <-- what to expect back from the PHP script, if anything
       //      cache: false,
       //      contentType: false,
       //      processData: false,
       //      data: form_data,
       //      type: 'post',
       //      success: function(data){
    //             $('div.content-body').unblock();
    //             processing = false;
    //             data = JSON.parse(data);
       //          alert(data.msg); // <-- display response from the PHP script, if any
       //      }
       //   });

    //     // $('.dropify').parse({
    //     //     config:{
    //     //         complete: function(results){
    //     //             console.log("Result...", results);
    //     //             var datas = results.data;

    //     //             var startTime = new Date().getTime();
    //     //             $('.progress-upload').removeClass('d-none');

    //     //             // for(var i = 0; i < datas.length-1; i++) {
    //     //             //     let data = datas[i];

    //     //             //     var valeur = Math.round((i/data.length)*100);
    //     //             //     console.log('valeur', valeur);
    //     //             //     console.log('data[i][7]', data[7]);
    //     //             //     $('.progress-bar').css('width', valeur+'%').text(valeur + " %").attr('aria-valuenow', valeur);
    //     //             //     $('.progress-upload .d-flex span').html('Mohon menunggu, mengupload Agenda '+data[7]+' ke Database...');
    //     //             //     $.post('../controller/pemasaran/simpanDaftung.php', {data: data[i]}, function(res){
    //     //             //         console.log(res);
    //     //             //     }, 'json' );

    //     //             // }
    //     //             var success_count=0;

    //     //             uploadKeDB(datas, 1);

    //     //             function uploadKeDB(data, idx){

    //     //                 var valeur = Math.round((idx/data.length)*100);
    //     //                 var now = new Date().getTime();
    //     //                 var duration = ( now - startTime ) / 1000;
    //     //                 var tf_rate = (idx) / (duration);
    //     //                 tf_rate = Math.floor(tf_rate);
    //     //                 var estimasi = Math.ceil(((data.length-idx)/tf_rate)/60);
    //     //                 //console.log('tf_rate', tf_rate);
    //     //                 //console.log('valeur', valeur);
    //     //                 console.log('data[idx][7]', data[idx][7]);
    //     //                 console.log(startTime);
    //     //                 $('.progress-bar').css('width', valeur+'%').text(valeur + " %").attr('aria-valuenow', valeur);

    //     //                 if(idx >= data.length - 1){
    //     //                     //$('.progress-upload').addClass('d-none');
    //     //                     $('.progress-upload .d-flex span.msg').html('Mohon menunggu, menghitung RAB Agenda Kolektif...');
    //     //                     $('.progress-upload .d-flex span.info').html('...');

    //     //                     console.log('Hitung RAB Kolektif!');
    //     //                     $.post('../controller/pemasaran/hitungRABKolektif.php', {startTime: startTime}, function(res){
    //     //                         console.log(res);
    //     //                         var jml_agenda_kolektif = res.jml_agenda_kolektif;

    //     //                         if(res.success || res.success=='true'){
    //     //                             $('.progress-upload .d-flex span.msg').html('Proses selesai');
    //     //                             $('.progress-upload .d-flex span.info').html('');


    //     //                             $('.progress-upload .d-flex span.msg').html('Mohon menunggu, memindahkan agenda yang sudah keluar dari Daftung...');
    //     //                             $('.progress-upload .d-flex span.info').html('...');

    //     //                             $.post('../controller/pemasaran/cleansingDaftung.php', {startTime: startTime}, function(res){
    //     //                                 console.log(res);

    //     //                                 if(res.success || res.success=='true'){
    //     //                                     $('.progress-upload .d-flex span.msg').html('Proses selesai');
    //     //                                     $('.progress-upload .d-flex span.info').html('');
    //     //                                     $('div#result').html($('div#result').html()+'<br/>'+'<span class="text-success">Update data selesai, '+success_count+' Agenda ('+jml_agenda_kolektif+' Agenda Kolektif) berhasil diupload</span>');
    //     //                                 }

    //     //                                 $('div.content-body').unblock();
    //     //                                 processing = false;

    //     //                             }, 'json' );

    //     //                         }


    //     //                     }, 'json' );

    //     //                 }else{

    //     //                     $('.progress-upload .d-flex span.msg').html('Mohon menunggu, mengupload Agenda '+data[idx][7]+' ke Database...');
    //     //                     $('.progress-upload .d-flex span.info').html('Estimasi: '+estimasi+' menit (Transfer rate: '+tf_rate+' record / detik)');
    //     //                     $.post('../controller/pemasaran/simpanDaftung.php', {data: data[idx], startTime: startTime}, function(res){
    //     //                         console.log(res);

    //     //                         if(!res.success || res.success=='false'){
    //     //                             $('div#result').html($('div#result').html()+'<br/>'+'<span class="text-danger">'+res.noagenda+'</span>');
    //     //                         }else{
    //     //                             success_count++;
    //     //                         }

    //     //                         idx = idx+1;
    //     //                         uploadKeDB(data, idx);
    //     //                     }, 'json' );
    //     //                 }
    //     //             }
    //     //         },
    //     //     },
    //     //     before: function(file, inputElem)
    //     //     {
    //     //         //start = now();
    //     //         console.log("Parsing file...", file);
    //     //     },
    //     //     error: function(err, file)
    //     //     {
    //     //         console.log("ERROR:", err, file);
    //     //         firstError = firstError || err;
    //     //         errorCount++;
    //     //     },
    //     //     complete: function()
    //     //     {
    //     //         //console.log("Result...", results);
    //     //         // end = now();
    //     //         // printStats("Done with all files");
    //     //     }
    //     // });
    // });

    window.onbeforeunload = confirmExit;
    function confirmExit() {
        if(processing)
            return "Anda masih memiliki proses upload yang belum selesai. Apakah anda yakin untuk keluar halaman ini?";
    }


})(jQuery);
(function($) {
    "use strict"

    var processing=false;
    // var drEvent = $('.dropify').dropify();
    // drEvent = drEvent.data('dropify');
    // drEvent.resetPreview();
    // drEvent.clearElement();
    $('#btn_upload').prop('disabled', true);

    Dropzone.options.uploadPemeriksaanLpb = {
        acceptedFiles: '.zip',
        addRemoveLinks: true,
        clickable: true,
        maxFiles: 10,
        timeout: 180000,
        maxFilesize: 10,
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
                console.log(file);
                console.log(response);
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
                        $($(progress).find('.msg')[0]).html('Mengupdate pemeriksaan_lpb dari File '+file.name+', mohon menunggu...');
                        $(progress).removeClass('d-none');
                        $($(progress).find('a')[0]).click(function(){
                        	$($(progress).find('.collapse')[0]).toggle();
                        });
                        //console.log(data.rows);
                        var valeur=0;
                        var rows = JSON.parse(data.rows);
                        console.log(rows);
                        if(rows.length>0){
	                        prosesUpload(rows, 0, data.filepath, progress, file.name, data.zipfile);
	                    }
                        // $.post('../controller/pemeriksaan_lpb/prosespemeriksaan_lpb.php', { filename: data.filename, kodegerak: $('#sel_kodegerak').val() }, function(res){
                        //     //progress-bar progress-bar-striped progress-bar-animated bg-warning
                        //    $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-striped');
                        //    $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-animated');
                        //    $($(progress).find('.progress-bar')[0]).removeClass('bg-warning');
                        //    res = JSON.parse(res);
                        //    console.log(res);
                        //    if(res.success=='true' || res.success){
                        //         $($(progress).find('.progress-bar')[0]).addClass('bg-success');
                        //         $($(progress).find('.msg')[0]).html('Update data pemeriksaan_lpb sudah berhasil dari File '+file.name+', silahkan cek di <a href="rekap-tgl-bayar.php" class="badge badge-primary" target="_blank">di sini</a> &nbsp;<i class="fa fa-check-circle text-success"></i>');
                        //    }else{
                        //         $($(progress).find('.progress-bar')[0]).addClass('bg-danger');
                        //         $($(progress).find('.msg')[0]).html('Update gagal dari File '+file.name);
                        //    }

                        // });
                    }else{
                        alert(response.msg);
                    }

                }
            });
        }

    };

    function prosesUpload(datas, i, filepath, progress, uploadname, zipfile){

    	if(i<datas.length){

	    	var valeur = parseInt((i / datas.length)*100);
	    	var v = datas[i];
	    	console.log(valeur);
	    	// console.log(v);
	    	$($(progress).find('.progress-bar')[0]).css('width', valeur+'%').attr('aria-valuenow', valeur);
	    	$($(progress).find('.msg')[0]).html('Memproses data idpel '+v.idpel+', mohon menunggu...');

	    	$.post('../controller/pemeriksaan_lpb/prosesPemeriksaanLpb.php', 
	    	{ filepath: filepath, uploadname:uploadname, zipfile:zipfile, row: v }, 
	    	function(res){
	    		res = JSON.parse(res);
               	console.log(res);
               	if(res.success=='true' || res.success){
                	$($(progress).find('ul')[0]).append('<li class="text-success">'+res.msg+'</li>');
               	}else{
                    $($(progress).find('ul')[0]).append('<li class="text-danger">'+res.msg+'</li>');
               	}
	        	prosesUpload(datas, i+1, filepath, progress, uploadname, zipfile);

	        });

	    }else{

            $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-striped');
            $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-animated');
            $($(progress).find('.progress-bar')[0]).removeClass('bg-warning');

            $($(progress).find('.progress-bar')[0]).css('width', '100%').attr('aria-valuenow', 100);
            $($(progress).find('.progress-bar')[0]).addClass('bg-success');
            $($(progress).find('.msg')[0]).html('Update data Pemeriksaan LPB sudah berhasil dari File '+uploadname+', silahkan cek Log Upload');
	    }

    }

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
        var myDropzone = Dropzone.forElement(".dropzone");
        myDropzone.processQueue();
    });


    // $('#btn_upload').click(function(){

    //     processing = true;
    //     $('div.content-body').block({ message: 'Mengupload data...' });
    //     $('div#result').html('');
    //     console.log('Upload...');

    //     var file_data = $('#file_pemeriksaan_lpb').prop('files')[0];
	   //  var form_data = new FormData();
	   //  form_data.append('unitupi', $('#sel_unitupi').val() );
	   //  form_data.append('unitap', $('#sel_unitap').val() );
	   //  form_data.append('unitup', $('#sel_unitup').val() );
	   //  form_data.append('file', file_data);
	   //  $.ajax({
	   //      url: '../controller/pemeriksaan_lpb/uploadFilepemeriksaan_lpb.php', // <-- point to server-side PHP script
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
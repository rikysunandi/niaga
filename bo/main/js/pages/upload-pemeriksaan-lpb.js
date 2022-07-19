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


    function prosesUploadZIP(datas, i, filepath, progress, uploadname, zipfile){

        console.log("Memproses ZIP file "+uploadname);
        if(i<datas.length){

            var valeur = parseInt((i / datas.length)*100);
            var v = datas[i];
            console.log(valeur);
            // console.log(v);
            $($(progress).find('.progress-bar')[0]).css('width', valeur+'%').attr('aria-valuenow', valeur);
            $($(progress).find('.msg')[0]).html('Memproses data idpel '+v.idpel+' dari File '+uploadname+', mohon menunggu...');

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
                $(progress).data('processing', true);
                prosesUploadZIP(datas, i+1, filepath, progress, uploadname, zipfile);

            });

        }else{


            $($(progress).find('.progress-bar')[0]).css('width', '99%').attr('aria-valuenow', 99);
            $($(progress).find('.msg')[0]).html('Membersihkan File hasil Upload, mohon menunggu...');

            $.post('../controller/pemeriksaan_lpb/clearFilePemeriksaanLpb.php', 
            { filepath: filepath, uploadname:uploadname, zipfile:zipfile }, 
            function(res){
                res = JSON.parse(res);
                console.log(res);
                
                $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-striped');
                $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-animated');
                $($(progress).find('.progress-bar')[0]).removeClass('bg-warning');

                $($(progress).find('.progress-bar')[0]).css('width', '100%').attr('aria-valuenow', 100);
                $($(progress).find('.progress-bar')[0]).addClass('bg-success');
                $($(progress).find('.msg')[0]).html('Update data Pemeriksaan LPB sudah berhasil dari File '+uploadname+', silahkan cek Log Upload');
                $(progress).data('processing', false);

            });


        }

    }



    function prosesUpload(idx){

        //var progress = $( ".progress-upload:first" ).clone().appendTo( ".container-fluid" );
        //console.log($(progress).find('.msg')[0]);
        console.log("Memproses Urutan file ke "+idx);

        if(idx<queueUpload.length){

            var progress = queueUpload[idx];

            var filepath = $(progress).data('filepath');
            var zipfile = $(progress).data('zipfile');
            var filename = $(progress).data('filename');
            var rows = $(progress).data('rows');

            console.log(progress);
            console.log('$(progress)', $(progress));
            console.log('filename', filename);

            $($(progress).find('.msg')[0]).html('Mengupdate pemeriksaan_lpb dari File '+filename+', mohon menunggu...');
            $($(progress).find('a')[0]).click(function(){
                $($(progress).find('.collapse')[0]).toggle();
            });
            //$($(progress).find('.msg')[0]).html('Mengupdate Sorek dari File '+ori_filename+', mohon menunggu...');
            $($(progress).find('.progress-bar')[0]).removeClass('bg-light');
            $($(progress).find('.progress-bar')[0]).addClass('bg-success');
            $($(progress).find('.progress-bar')[0]).addClass('progress-bar-striped');
            $($(progress).find('.progress-bar')[0]).addClass('progress-bar-animated');
            $($(progress).find('.progress-bar')[0]).css('width', '100%').attr('aria-valuenow', 100);
            
            if(rows.length>0){
                $(progress).data('processing', true);
                prosesUploadZIP(rows, 0, filepath, progress, filename, zipfile);
            }

            function wait(time, limit, fn) {
                //console.log('value >> ' + limit)
                if (!$(progress).data('processing')) return fn();
                setTimeout(function () {
                    wait(time, --limit, fn);
                }, time)
            }

            function next() { 
                queueUpload.splice(0, 1);
                console.log('queueUpload after splice', queueUpload);
                prosesUpload(idx);
            }

            wait(100, 30, next); 

            

            
        }

    }

    Dropzone.options.uploadPemeriksaanLpb = {
        acceptedFiles: '.zip',
        addRemoveLinks: true,
        clickable: true,
        maxFiles: 10,
        timeout: 180000,
        maxFilesize: 15,
        parallelUploads: 2,
        autoProcessQueue: true,
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
            this.on("complete", function() {
                $('#btn_upload').prop('disabled', true);
                //this.options.autoProcessQueue = false;
            });

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

                        $($(progress).find('.msg')[0]).html(file.name+', menunggu antrian...');
                        $(progress).removeClass('d-none');
                        var rows = JSON.parse(data.rows);
                        $(progress).data('filepath', data.filepath);
                        $(progress).data('zipfile', data.zipfile);
                        $(progress).data('filename', file.name);
                        $(progress).data('rows', rows);
                        // $(progress).data('rowcount', data.rowcount);

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
        var myDropzone = Dropzone.forElement(".dropzone");
        myDropzone.processQueue();
    });

    document.onkeydown = keydown;

	function keydown(evt){
	  if (!evt) evt = event;
	  if (evt.ctrlKey && evt.altKey && evt.keyCode==115){ //CTRL+ALT+F4
	  		window.location.href = '../template/upload-pemeriksaan-lpb-large.php';
	  }
	  // else if (evt.shiftKey && evt.keyCode == 9){ //Shif+TAB
	  //   alert("Shift+TAB");
	  // }
	}

    window.onbeforeunload = confirmExit;
    function confirmExit() {
        if(processing)
            return "Anda masih memiliki proses upload yang belum selesai. Apakah anda yakin untuk keluar halaman ini?";
    }


})(jQuery);
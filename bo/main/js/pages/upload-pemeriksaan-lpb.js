(function($) {
    "use strict"

    $('.progress-box').slideUp();

    Dropzone.options.filePemeriksaanLpb = {
        maxFilesize: 120,
        acceptedFiles: ".zip",
        // uploadMultiple: false,
        // parallelUploads: 1,
        //maxFiles: 3,
        timeout: 50000,
        success: function(file, response){
            console.log('response', response);

            var count = response.count;
            var filename = response.filename;
            var filepath = response.filepath;

            if(response.count>0){

	            var progress_box = $('.progress-box:last')
	        						.clone()
	        						//.removeClass('progress-box')
	        						.insertBefore('.progress-box:first')
	        						.slideDown();

	            $(progress_box).find('h5.pull-left').html('Proses Update Data dari File: '+filename);

	            function simpan(idx, data){
		            var progress = (parseInt(idx)/parseInt(count))*100;
		            $(progress_box).find('h6.text-muted').html('Menyimpan data Idpel: '+data.idpel);
		            $.ajax({
					  type: "POST",
					  url: '../controller/pemeriksaan_lpb/simpanPemeriksaanLPB.php',
					  data: {
			  			idx: idx, 
			  			data: data, 
			  			filepath: filepath,
			  			filename: filename,
					  },
					  success: function(res){

					  	if(res.data.success){
							$(progress_box).find('.data').html(idx);
					    }
					  	if(res.foto.success){
							$(progress_box).find('.foto').html(idx);
					    }

					  	if(progress<=30){
						  	$(progress_box).find('.progress-bar')
						  		.removeClass('bg-warning bg-primary')
						  		.addClass('bg-danger')
						  		.css('width', progress+'%')
						  		.attr('aria-valuenow', progress); 
					  	}else if(progress>30 && progress<=70){
						  	$(progress_box).find('.progress-bar')
						  		.removeClass('bg-danger bg-primary')
						  		.addClass('bg-warning')
						  		.css('width', progress+'%')
						  		.attr('aria-valuenow', progress); 
					  	}else{
						  	$(progress_box).find('.progress-bar')
						  		.removeClass('bg-danger bg-warning')
						  		.addClass('bg-primary')
						  		.css('width', progress+'%')
						  		.attr('aria-valuenow', progress); 	
					  	}

					  	if(res.next){
					  		simpan(res.idx, res.rec);
					  	}else{
						  	$(progress_box).find('.progress-bar')
						  		.removeClass('bg-danger bg-warning progress-bar-striped progress-bar-animated')
						  		.addClass('bg-primary'); 	
		            		$(progress_box).find('h6.text-muted').html('Proses selesai!');
					    }

					  },
					  dataType: 'json'
					});
		        }

		        simpan(response.next_idx, response.next_rec);

		    }else{
		    	alert('Format tidak dikenali');
		    }

        },
        error: function(file, response){
            console.log('response', response);
            alert('Error Upload, cek koneksi anda atau format file yang diupload, lalu refresh Halaman');
        }
    };



})(jQuery);
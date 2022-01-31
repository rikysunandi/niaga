(function($) {
    "use strict"

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    $("input, select").val('');

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        opens: 'left',
        startDate: moment(), //.subtract(1, 'months').format('DD/MM/YYYY'),
        endDate: moment(),
        locale: {
          format: 'DD/MM/YYYY'
        }
    });
    
    $('#btn_upload').prop('disabled', true);

    Dropzone.options.uploadPelunasan = {
        acceptedFiles: '.xlsx',
        addRemoveLinks: true,
        clickable: true,
        maxFiles: 5,
        timeout: 180000,
        maxFilesize: 20,
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
                formData.append("kodegerak", $('#sel_kodegerak').val());
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
                        console.log($(progress).find('.msg')[0]);
                        $($(progress).find('.msg')[0]).html('Mengupdate Pelunasan dari File '+file.name+', mohon menunggu...');
                        $(progress).removeClass('d-none');
                        $.post('../controller/pelunasan/prosesPelunasan.php', { filename: data.filename, kodegerak: $('#sel_kodegerak').val() }, function(res){
                            //progress-bar progress-bar-striped progress-bar-animated bg-warning
                           $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-striped');
                           $($(progress).find('.progress-bar')[0]).removeClass('progress-bar-animated');
                           $($(progress).find('.progress-bar')[0]).removeClass('bg-warning');
                           res = JSON.parse(res);
                           console.log(res);
                           if(res.success=='true' || res.success){
                                $($(progress).find('.progress-bar')[0]).addClass('bg-success');
                                $($(progress).find('.msg')[0]).html('Update data pelunasan sudah berhasil dari File '+file.name+', silahkan cek di <a href="rekap-tgl-bayar.php" class="badge badge-primary" target="_blank">di sini</a> &nbsp;<i class="fa fa-check-circle text-success"></i>');
                           }else{
                                $($(progress).find('.progress-bar')[0]).addClass('bg-danger');
                                $($(progress).find('.msg')[0]).html('Update gagal dari File '+file.name);
                           }

                        });
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

    $('#bidang').change(function(){

	    $('#nama_wig').empty();

	    $.getJSON('../controller/referensi/getWIG.php?bidang='+$('#bidang').val(), function(data){
	    	$.each(data.rows,function(i,v){

	        	$('#nama_wig').append('<option value="'+v.kode+'">'+v.nama+'</option>');
	    	});

            //$('#nama_wig').selectpicker('val', unitup);
            $('#nama_wig').selectpicker('refresh');
	    });

    });

    $('#nama_wig').change(function(){

	    $('#nama_lag').empty();
	    $('#satuan_lag').empty();

	    $.getJSON('../controller/4dx/getWIG.php?id='+$('#nama_wig').val(), function(data){

		    $('#nama_lag').val(data.row.NAMA_LAG);
		    $('#satuan_lag').val(data.row.SATUAN_LAG);
	    });

    });

    $('#btn_simpan').click(function(){

    	
	    $(".needs-validation").validate({
	        //ignore: ':not(select:hidden, input:visible, textarea:visible)',
		    rules: {
		        "nomor_va": {
		            required: !0,
		        },
		        "bank": {
		            required: !0,
		        },
		        "unitupi": {
		            required: !0,
		        },
		        "unitap": {
		            required: !0,
		        },
		    },
		    messages: {
		        "nomor_va": "Mohon masukan Nomor Virtual Account yang Valid",
		        "bank": "Silahkan pilih Bank",
		        "unitupi": "Silahkan pilih Unit Induk",
		        "unitap": "Silahkan pilih Unit Pelaksana",
		    },
		    errorClass: "invalid-feedback animated fadeInUp",
		    errorElement: "div",
		    errorPlacement: function(e, a) {
		        jQuery(a).parents(".form-group > div").append(e)
		    },
		    highlight: function(e) {
		        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
		    },
		    success: function(e) {
		        jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
		    },
		});

		if (!$(".needs-validation").valid()) {
			console.log('tidak valid!!');
			event.preventDefault();
			event.stopPropagation();
		}else{
			
			console.log('valid!!');

	    	$('div.content-body').block({ message: 'Menyimpan data...' });
	    	$.post('../controller/pelunasan/simpanVA.php', $( "#input-va" ).serialize()).done(function(data) {
				$.notify({
		            message: data.msg 
		        },{
		            // settings
		            type: (data.success)?'success':'warning', 
		            offset: {
		                y: 20, 
		                x: 320
		            },
		            spacing: 5,
		            z_index: 1031,
		            delay: 5000,
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

		        if(data.success){

					//$('.card-title').html('Form Edit Virtual Account');
					$('#nomor_va').val(data.nomor_va).prop('readonly', true);
					$('#btn_hapus').prop('disabled', false);

		        }

	  		}).fail(function(data) {
	  			$.notify({
		            message: 'Data gagal disimpan!' 
		        },{
		            // settings
		            type: 'warning', 
		            offset: {
		                y: 20, 
		                x: 320
		            },
		            spacing: 5,
		            z_index: 1031,
		            delay: 5000,
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
	  		}).always(function() {
		    	$('div.content-body').unblock();
			});

		}

    });


    $('#btn_dohapus').click(function(){

    	$('div.content-body').block({ message: 'Menghapus data...' });
    	$.post('../controller/pelunasan/hapusVA.php', $( "#input-va" ).serialize()).done(function(data) {
			$.notify({
	            message: data.msg 
	        },{
	            // settings
	            type: (data.success)?'success':'warning', 
	            offset: {
	                y: 20, 
	                x: 320
	            },
	            spacing: 5,
	            z_index: 1031,
	            delay: 5000,
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

	        if(data.success){

				//$('.card-title').html('Form Edit Virtual Account');
				$('#nomor_va').val(data.nomor_va).prop('readonly', true);
				$('#btn_hapus').prop('disabled', false);

	        }

  		}).fail(function(data) {
  			$.notify({
	            message: 'Data gagal disimpan!' 
	        },{
	            // settings
	            type: 'warning', 
	            offset: {
	                y: 20, 
	                x: 320
	            },
	            spacing: 5,
	            z_index: 1031,
	            delay: 5000,
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
  		}).always(function() {
	    	$('div.content-body').unblock();
		});
    });

	if(params_url[1].length>0){
		$('#nomor_va').val(params_url[1]);
		$.getJSON('../controller/pelunasan/getVA.php?nomor_va='+params_url[1], function(data){
			console.log('data',data);
			//$('.card-title').html('Form Edit Virtual Account');
			$('#nomor_va').val(data.nomor_va).prop('readonly', true);
			$('#bank').val(data.bank);

		    $('#sel_unitupi').empty();
		    $('#sel_unitap').empty();

			$.getJSON('../controller/referensi/getUnitupi.php', function(res){

		    	$.each(res.rows,function(i,v){
		        	$('#sel_unitupi').append('<option value="'+v.kode+'">'+v.nama+'</option>');
		    	});
				$('#sel_unitupi').val(data.unitupi);
				$('.selectpicker').selectpicker('refresh');

		    });


			$.getJSON('../controller/referensi/getUnitap.php?unitupi='+data.unitupi, function(res){
		    	$.each(res.rows,function(i,v){
		        	$('#sel_unitap').append('<option value="'+v.kode+'">'+v.nama+'</option>');
		    	});
				$('#sel_unitap').val(data.unitap);
				$('.selectpicker').selectpicker('refresh');
		    });

			$('#keterangan').val(data.keterangan);
			$('#btn_hapus').prop('disabled', false);
			$('.selectpicker').selectpicker('refresh');
		});
	}



})(jQuery);
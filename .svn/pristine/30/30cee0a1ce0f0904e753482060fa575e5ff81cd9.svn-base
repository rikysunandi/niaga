(function($) {
    "use strict"

    var params_url = location.search.replace('?', '').split('=');

    $("input").val('');

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

					$('.card-title').html('Form Edit Virtual Account');
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

				$('.card-title').html('Form Edit Virtual Account');
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
			$('.card-title').html('Form Edit Virtual Account');
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
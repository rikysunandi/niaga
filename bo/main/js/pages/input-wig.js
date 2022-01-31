(function($) {
    "use strict"

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    function populate(frm, data) {   
	    $.each(data, function(key, value) {  
	        var ctrl = $('[name='+key.toLowerCase()+']', frm);  
	        switch(ctrl.prop("type")) { 
	            case "radio": case "checkbox":   
	                ctrl.each(function() {
	                    if($(this).attr('value') == value.toLowerCase()) $(this).attr("checked",value.toLowerCase());
	                });   
	                break;  
	            default:
	                ctrl.val(value); 
	        }  
	    });  
	}

    if(urlParams.has('id')){
    	$('div.content-body').block({ message: 'Mengambil data...' });
    	$.get('../controller/4dx/getWIG.php?id='+urlParams.get('id'), function(data){
    		//console.log(data);
    		data = JSON.parse(data);
    		if(data.success){
    			populate($('#form-input-wig'), data.row);
    			$('#col-id').removeClass('d-none');
    			$('#bottom-link').removeClass('d-none');
    			$('#input-target-lag-link').attr('href','input-target-lag.php?wig_id='+data.row.ID);
    			$('#input-target-lm-link').attr('href','input-target-lm.php?wig_id='+data.row.ID);
    		}
    		$('#input-wig-link').attr('href','input-wig.php');
    		$('div.content-body').unblock();
    	});
    }

    var form = $('#form-input-wig');
    form.children('div').steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical" ,
        onStepChanging: function (event, currentIndex, newIndex)
        {
        	if(currentIndex < newIndex){
            	form.validate().settings.ignore = ":disabled,:hidden";
            	return form.valid();
            }else{
            	return true;
            }
        },
        onFinished: function (event, currentIndex) {
	        // alert('finish!');
	        // console.log('form data', form.serializeArray());


	    	$('div.content-body').block({ message: 'Menyimpan data...' });
	    	$.post('../controller/4dx/simpanWIG.php', form.serializeArray()).done(function(data) {
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
			        setTimeout(function(){
			        	window.location.href = window.location.href.split('?')[0] + '?id=' + data.row.ID;
			        } , 2500);  
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


})(jQuery);
$(document).ready(function () {

    "use strict";

    $('#btn_download').click(function(btn){

    	$.ajax({
            // a tipycal url would be /{id} with type='POST'
            url: "../controller/pemeriksaan_lpb/downloadDIL.php",
            type: 'GET',
            data: {
            	unitupi: $('#sel_unitupi').val(),
            	unitap: $('#sel_unitap').val(),
            	unitup: $('#sel_unitup').val(),
            	sisa: $('#check_sisa').is(":checked"),
            },
            success: function(data){ 
            	
            },
        });
    });

})
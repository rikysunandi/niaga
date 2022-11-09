(function($) {
    "use strict"

    console.log($('.card'));

    $('head').append(`

    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/icon/favicon-16x16.png">
   
    <link rel="manifest" href="../../assets/images/icon/site.webmanifest">

        `);
  

 //    $("#sel_unitupi").selectpicker({
	//     style: "btn-default btn-sm"
	// });

 //    $("#sel_unitap").selectpicker({
	//     style: "btn-default btn-sm"
	// });
	
 //    $("#sel_unitup").selectpicker({
	//     style: "btn-default btn-sm"
	// });
    // $.fn.serializeObject = function() {
    //     var o = {};
    //     var a = this.serializeArray();
    //     $.each(a, function() {
    //         if (o[this.name] === undefined) {
    //             if (!o[this.name].push) {
    //                 o[this.name] = [o[this.name]];
    //             }
    //             o[this.name].push(this.value || '');
    //         } else {
    //             alert(this.name);
    //             o[this.name] = this.value || '';
    //         }
    //     });
    //     return o;
    // };
    if($('div.page-titles h4').html().length>0){
        $(document).prop('title', 'ROC Jabar | '+$('div.page-titles h4').html() );
    
        $.post( "../controller/logAkses.php", { page: $('div.page-titles h4').html() } );
    }
    
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var unitupi = urlParams.get('unitupi'),
        unitap = urlParams.get('unitap'),
        unitup = urlParams.get('unitup');

    $.getJSON('../controller/referensi/getUnitupi.php', function(data){

        console.log('data', data);
    	
	    $('#sel_unitupi').empty();
	    $('#sel_unitap').empty();
	    $('#sel_unitup').empty();

    	$.each(data.rows,function(i,v){
            console.log('opsi', v.nama);
        	$('#sel_unitupi').append('<option value="'+v.kode+'">'+v.nama+'</option>');
    	});

    	if($('#sel_unitupi').data('inc-semua')!='T')
			$('#sel_unitupi').append('<option value="00" selected>SEMUA UNIT</option>');
    	if($('#sel_unitap').data('inc-semua')!='T')
			$('#sel_unitap').append('<option value="00">SEMUA UNIT</option>');
    	if($('#sel_unitup').data('inc-semua')!='T')
			$('#sel_unitup').append('<option value="00">SEMUA UNIT</option>');

        // if(!unitupi){
        //     unitupi = data.rows[0].kode;
        // }
        console.log('set UNITUPI', unitupi);
        $('#sel_unitupi').selectpicker('refresh');
        $('#sel_unitupi').selectpicker('val', unitupi);
        // $('#sel_unitap').selectpicker('refresh');
        // $('#sel_unitup').selectpicker('refresh');

     	console.log('unit: '+unitupi+' - '+unitap+' - '+unitup);
    });

    $('#sel_unitupi').change(function(){

        console.log('sel_unitupi changed', $('#sel_unitupi').val());
        if($('#sel_unitupi').val()!=null){

    	    $('#sel_unitap').empty();
    	    $('#sel_unitup').empty();

    	    $.getJSON('../controller/referensi/getUnitap.php?unitupi='+$('#sel_unitupi').val(), function(data){
    	    	console.log('rows', data.rows);
                $.each(data.rows,function(i,v){
    	        	$('#sel_unitap').append('<option value="'+v.kode+'">'+v.nama+'</option>');
    	    	});
                //console.log('unitap1', unitap);
    	    	if($('#sel_unitap').data('inc-semua')!='T')
    				$('#sel_unitap').append('<option value="00">SEMUA UNIT</option>');
    	    	if($('#sel_unitup').data('inc-semua')!='T')
    				$('#sel_unitup').append('<option value="00">SEMUA UNIT</option>');

                // if(!unitap){
                //     unitap = data.rows[0].kode;
                // }
                $('#sel_unitap').selectpicker('refresh');
                $('#sel_unitap').selectpicker('val', unitap);
    			//$('#sel_unitup').selectpicker('refresh');
    			
    			console.log('unitap', unitap);
    	    });
        }

    });

    $('#sel_unitap').change(function(){
        console.log('sel_unitap changed', $('#sel_unitap').val());
        if($('#sel_unitupi').val()!=null){

    	    $('#sel_unitup').empty();

    	    $.getJSON('../controller/referensi/getUnitup.php?unitap='+$('#sel_unitap').val(), function(data){
    	    	$.each(data.rows,function(i,v){

    	        	$('#sel_unitup').append('<option value="'+v.kode+'">'+v.nama+'</option>');
    	    	});
    	    	if($('#sel_unitup').data('inc-semua')!='T')
    				$('#sel_unitup').append('<option value="00">SEMUA UNIT</option>');

                // if(!unitup){
                //     unitup = data.rows[0].kode;
                // }
                $('#sel_unitup').selectpicker('refresh');
                $('#sel_unitup').selectpicker('val', unitup);
    	    });
        }

    });


	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		    return false;
		return true;
	}

    $('.shouldNumber').on('keypress', function() {
        return isNumberKey(event)
    });

    var nFormatter = function nFormatter(num, digits) {
      const lookup = [
        { value: 1, symbol: "" },
        { value: 1e3, symbol: "Rb" },
        { value: 1e6, symbol: "Jt" },
        { value: 1e9, symbol: "M" },
        { value: 1e12, symbol: "T" }
      ];
      const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
      var item = lookup.slice().reverse().find(function(item) {
        return num >= item.value;
      });
      return item ? (num / item.value).toFixed(digits).replace(rx, "Rp1") + item.symbol : "0";
    };

    window.showMsg = function(msg, status){

        $.notify({
            message: msg
        },{
            type: status, 
            offset: {
                y: 20, 
                x: 320
            },
            spacing: 5,
            z_index: 1031,
            delay: 4000,
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

    };





})(jQuery);
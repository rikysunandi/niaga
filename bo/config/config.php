<?php

ini_set('memory_limit', '128M');
ini_set('date.timezone', 'Asia/Jakarta');
ini_set('max_execution_time', 1200);
set_time_limit(1200);
ini_set('upload_max_filesize', '15M');
ini_set('post_max_size', '15M');
ini_set('allow_call_time_pass_reference', 'On');

// Development setting
ini_set('error_reporting', 'E_ERROR | E_PARSE');
ini_set('display_errors', 'On');
ini_set('session.gc_maxlifetime', 8*60*60);
error_reporting(E_ERROR | E_PARSE);


FUNCTION format_unit($unit) {
    // strip any commas 
    $unit = (0 + STR_REPLACE(',', '', $unit));
 
    // make sure it's a number...
    IF(!IS_NUMERIC($unit)){ RETURN FALSE;}
 
    // filter and format it 
    IF($unit>1000000000000){ 
        RETURN ROUND(($unit/1000000000000),1).' T';
    }ELSEIF($unit>1000000000){ 
        RETURN ROUND(($unit/1000000000),1).' G';
    }ELSEIF($unit>1000000){ 
        RETURN ROUND(($unit/1000000),1).' M';
    }ELSEIF($unit>1000){ 
        RETURN ROUND(($unit/1000),0).' K';
    }
 //    ELSEIF($cash>1000){ 
    //  RETURN ROUND(($cash/1000),2).' thousand';
    // }
 
    RETURN NUMBER_FORMAT($unit);
}

FUNCTION format_cash($cash) {
    // strip any commas 
    $cash = (0 + STR_REPLACE(',', '', $cash));
 
    // make sure it's a number...
    IF(!IS_NUMERIC($cash)){ RETURN FALSE;}
 
    // filter and format it 
    IF($cash>1000000000000){ 
		RETURN ROUND(($cash/1000000000000),1).' T';
    }ELSEIF($cash>1000000000){ 
		RETURN ROUND(($cash/1000000000),1).' M';
    }ELSEIF($cash>1000000){ 
		RETURN ROUND(($cash/1000000),1).' Jt';
    }ELSEIF($cash>1000){ 
        RETURN ROUND(($cash/1000),0).' Rb';
    }
 //    ELSEIF($cash>1000){ 
	// 	RETURN ROUND(($cash/1000),2).' thousand';
	// }
 
    RETURN NUMBER_FORMAT($cash);
}

FUNCTION format_cash_long($cash) {
    // strip any commas 
    $cash = (0 + STR_REPLACE(',', '', $cash));
 
    // make sure it's a number...
    IF(!IS_NUMERIC($cash)){ RETURN FALSE;}
 
    // filter and format it 
    IF($cash>1000000000000){ 
        RETURN ROUND(($cash/1000000000000),2).' Triliun';
    }ELSEIF($cash>1000000000){ 
        RETURN ROUND(($cash/1000000000),2).' Miliar';
    }ELSEIF($cash>1000000){ 
        RETURN ROUND(($cash/1000000),2).' Juta';
    }ELSEIF($cash>1000){ 
        RETURN ROUND(($cash/1000),0).' Ribu';
    }
 //    ELSEIF($cash>1000){ 
    //  RETURN ROUND(($cash/1000),2).' thousand';
    // }
 
    RETURN NUMBER_FORMAT($cash);
}
?>
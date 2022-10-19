<?php

ini_set('memory_limit', '128M');
ini_set('date.timezone', 'Asia/Jakarta');
ini_set('max_execution_time', 300);
set_time_limit(300);
ini_set('upload_max_filesize', '15M');
ini_set('post_max_size', '15M');
ini_set('allow_call_time_pass_reference', 'On');

// Development setting
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'On');
ini_set('session.gc_maxlifetime', 8*60*60);
error_reporting(E_ALL);

//LDAP Pusat
$AD_Server     = "10.1.8.20";
//$AD_Server     = "10.1.8.22";
//$AD_Server     = "10.1.8.190";
//$AD_Server     = '10.2.1.52';

$AD_DomainName = 'DC=pusat,DC=corp,DC=pln,DC=co,DC=id';           // Domain DN
$AD_UsnPostfix = '@pusat.corp.pln.co.id';                         // username with read access
//$AD_DomainName = 'DC=jabar,DC=corp,DC=pln,DC=co,DC=id';
//$AD_UsnPostfix = '@jabar.corp.pln.co.id';

$ldapconn = ldap_connect($AD_Server);
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

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

$unitups = array(
    array('unitup'=>'53551', 'unitap'=>'53BDG'),
    array('unitup'=>'53555', 'unitap'=>'53BDG'),
    array('unitup'=>'53559', 'unitap'=>'53BDG'),
    array('unitup'=>'53563', 'unitap'=>'53BDG'),
    array('unitup'=>'53567', 'unitap'=>'53BDG'),
    array('unitup'=>'53571', 'unitap'=>'53BDG'),
    array('unitup'=>'53575', 'unitap'=>'53BDG'),
    array('unitup'=>'53577', 'unitap'=>'53BDG'),
    array('unitup'=>'53811', 'unitap'=>'53BGR'),
    array('unitup'=>'53821', 'unitap'=>'53BGR'),
    array('unitup'=>'53825', 'unitap'=>'53BGR'),
    array('unitup'=>'53831', 'unitap'=>'53BGR'),
    array('unitup'=>'53841', 'unitap'=>'53BGR'),
    array('unitup'=>'53851', 'unitap'=>'53BGR'),
    array('unitup'=>'53853', 'unitap'=>'53BGR'),
    array('unitup'=>'53711', 'unitap'=>'53BKS'),
    array('unitup'=>'53731', 'unitap'=>'53BKS'),
    array('unitup'=>'53732', 'unitap'=>'53BKS'),
    array('unitup'=>'53741', 'unitap'=>'53BKS'),
    array('unitup'=>'53742', 'unitap'=>'53BKS'),
    array('unitup'=>'53771', 'unitap'=>'53BKS'),
    array('unitup'=>'53661', 'unitap'=>'53CJR'),
    array('unitup'=>'53671', 'unitap'=>'53CJR'),
    array('unitup'=>'53681', 'unitap'=>'53CJR'),
    array('unitup'=>'53691', 'unitap'=>'53CJR'),
    array('unitup'=>'53695', 'unitap'=>'53CJR'),
    array('unitup'=>'53701', 'unitap'=>'53CKG'),
    array('unitup'=>'53702', 'unitap'=>'53CKG'),
    array('unitup'=>'53703', 'unitap'=>'53CKG'),
    array('unitup'=>'53704', 'unitap'=>'53CKG'),
    array('unitup'=>'53581', 'unitap'=>'53CMI'),
    array('unitup'=>'53585', 'unitap'=>'53CMI'),
    array('unitup'=>'53589', 'unitap'=>'53CMI'),
    array('unitup'=>'53592', 'unitap'=>'53CMI'),
    array('unitup'=>'53595', 'unitap'=>'53CMI'),
    array('unitup'=>'53598', 'unitap'=>'53CMI'),
    array('unitup'=>'53599', 'unitap'=>'53CMI'),
    array('unitup'=>'53311', 'unitap'=>'53CRB'),
    array('unitup'=>'53321', 'unitap'=>'53CRB'),
    array('unitup'=>'53331', 'unitap'=>'53CRB'),
    array('unitup'=>'53351', 'unitap'=>'53CRB'),
    array('unitup'=>'53371', 'unitap'=>'53CRB'),
    array('unitup'=>'53871', 'unitap'=>'53DPK'),
    array('unitup'=>'53872', 'unitap'=>'53DPK'),
    array('unitup'=>'53873', 'unitap'=>'53DPK'),
    array('unitup'=>'53874', 'unitap'=>'53DPK'),
    array('unitup'=>'53875', 'unitap'=>'53DPK'),
    array('unitup'=>'53861', 'unitap'=>'53GPI'),
    array('unitup'=>'53865', 'unitap'=>'53GPI'),
    array('unitup'=>'53867', 'unitap'=>'53GPI'),
    array('unitup'=>'53271', 'unitap'=>'53GRT'),
    array('unitup'=>'53276', 'unitap'=>'53GRT'),
    array('unitup'=>'53277', 'unitap'=>'53GRT'),
    array('unitup'=>'53286', 'unitap'=>'53GRT'),
    array('unitup'=>'53293', 'unitap'=>'53GRT'),
    array('unitup'=>'53401', 'unitap'=>'53IDM'),
    array('unitup'=>'53402', 'unitap'=>'53IDM'),
    array('unitup'=>'53403', 'unitap'=>'53IDM'),
    array('unitup'=>'53404', 'unitap'=>'53IDM'),
    array('unitup'=>'53461', 'unitap'=>'53KRW'),
    array('unitup'=>'53468', 'unitap'=>'53KRW'),
    array('unitup'=>'53475', 'unitap'=>'53KRW'),
    array('unitup'=>'53476', 'unitap'=>'53KRW'),
    array('unitup'=>'53482', 'unitap'=>'53KRW'),
    array('unitup'=>'53531', 'unitap'=>'53MJA'),
    array('unitup'=>'53532', 'unitap'=>'53MJA'),
    array('unitup'=>'53533', 'unitap'=>'53MJA'),
    array('unitup'=>'53534', 'unitap'=>'53MJA'),
    array('unitup'=>'53535', 'unitap'=>'53MJA'),
    array('unitup'=>'53536', 'unitap'=>'53MJA'),
    array('unitup'=>'53411', 'unitap'=>'53PWK'),
    array('unitup'=>'53421', 'unitap'=>'53PWK'),
    array('unitup'=>'53425', 'unitap'=>'53PWK'),
    array('unitup'=>'53431', 'unitap'=>'53PWK'),
    array('unitup'=>'53444', 'unitap'=>'53PWK'),
    array('unitup'=>'53611', 'unitap'=>'53SKI'),
    array('unitup'=>'53621', 'unitap'=>'53SKI'),
    array('unitup'=>'53631', 'unitap'=>'53SKI'),
    array('unitup'=>'53641', 'unitap'=>'53SKI'),
    array('unitup'=>'53651', 'unitap'=>'53SKI'),
    array('unitup'=>'53659', 'unitap'=>'53SKI'),
    array('unitup'=>'53511', 'unitap'=>'53SMD'),
    array('unitup'=>'53517', 'unitap'=>'53SMD'),
    array('unitup'=>'53521', 'unitap'=>'53SMD'),
    array('unitup'=>'53527', 'unitap'=>'53SMD'),
    array('unitup'=>'53211', 'unitap'=>'53TSK'),
    array('unitup'=>'53221', 'unitap'=>'53TSK'),
    array('unitup'=>'53231', 'unitap'=>'53TSK'),
    array('unitup'=>'53241', 'unitap'=>'53TSK'),
    array('unitup'=>'53251', 'unitap'=>'53TSK'),
    array('unitup'=>'53261', 'unitap'=>'53TSK'),
    array('unitup'=>'53265', 'unitap'=>'53TSK')
);



?>
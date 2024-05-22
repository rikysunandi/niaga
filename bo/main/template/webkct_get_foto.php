<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="900" />
	<title>WEBKCT</title>
</head>
<body>

<?php
ini_set('MAX_EXECUTION_TIME', '-1');

set_time_limit(-1);
//require_once '../../config/config.php';
require_once '../../config/database.php';


// $conn2 = sqlsrv_connect($serverName, $connectionOptions);
// if ($conn2 === false) {
//     die(print_r(sqlsrv_errors()));
// }

$params = array();
//SELECT * FROM m_kct_suspect_foto
$sql = "EXEC SP_GET_KCT_SUSPECT ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

echo (sqlsrv_execute($stmt))?'Status get berhasil<br/>':'Status get gagal<br/>';
$idpels = array();

if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		array_push($idpels, $row['IDPEL']);
	}
}else{
	echo 'Gagal melakukan Query SP_GET_KCT_SUSPECT ke Database';
}

sqlsrv_free_stmt($stmt);

foreach($idpels as $idpel){
		sleep(rand(1,5));
	  //$idpel = $row['IDPEL'];
		$fotourl = getWebKCTFoto($idpel);
		//echo $fotourl;

		if($fotourl<>''){

			$params = array(
		        array($idpel, SQLSRV_PARAM_IN),
		        array($fotourl, SQLSRV_PARAM_IN)
		    );
			$sql = "EXEC SP_UPDATE_KCT_SUSPECT_FOTO '".($idpel)."', '".($fotourl)."' ";
			$stmt = sqlsrv_prepare($conn, $sql, $params);

			if(!sqlsrv_execute($stmt)){
				echo 'Gagal '.$idpel.'<br/>'.$sql;

			}else{

				$folder = '../../assets/uploads/foto_kct/';
		    $file_name = $idpel.'.jpeg'; 
				$success = downloadFile($folder, $file_name, $fotourl);

			}

			sqlsrv_free_stmt($stmt);
		}

	}




function downloadFile($folder, $filename, $url){

	if (!file_exists($folder)) {
	    mkdir($folder, 0777, true);
	}
      
    // Use file_get_contents() function to get the file 
    // from url and use file_put_contents() function to 
    // save the file by using base name 
    //echo $filename.': '.file_get_contents($url);
    if (strlen(file_get_contents($url))>0){
	    if (file_put_contents($folder.'/'.$filename, file_get_contents($url))) 
		    return 1;
		else
			return 0;
	}else{
		return 0;
	}
}

function getWebKCTFoto($idpel){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://10.68.35.74:8080/kct-web/ap2t/springGwtServices/gwtTransService',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_TIMEOUT_MS => 2000,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'7|0|7|http://10.68.35.74:8080/kct-web/ap2t/|D6F5DCF2A7FFAB7D396D6E6B510C4BA6|id.co.iconpln.ap2t.client.service.GwtTransService|getDataInfoKCT|java.lang.String/2004016611|'.$idpel.'|8810496Z|1|2|3|4|2|5|5|6|7|',
	  CURLOPT_HTTPHEADER => array(
	    'Cookie: JSESSIONID=09B4F26DE75186C605C5BA1ADD0B028E',
	    'Origin: http://10.68.35.74:8080',
	    'X-GWT-Module-Base: http://10.68.35.74:8080/kct-web/ap2t/',
	    'X-GWT-Permutation: 32AEE8563B920F07641BD36B7E2776F0',
	    'Content-Type: text/x-gwt-rpc; charset=utf-8'
	  ),
	));

	$response = curl_exec($curl);

	$res = explode(',', $response);

	curl_close($curl);

	if(sizeof($res)>=45)
		return str_replace('"', '', $res['45']);
	else 
		return '';
}

?>
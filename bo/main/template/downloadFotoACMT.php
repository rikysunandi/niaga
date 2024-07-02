<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <meta http-equiv="refresh" content="250" /> -->
	<title>Download Foto ACMT</title>
</head>
<body>

<?php
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../config/router.php';
ini_set('MAX_EXECUTION_TIME', '-1');
set_time_limit(-1);


$params = array();
//SELECT * FROM m_kct_suspect_foto
$sql = "SELECT UNITAP, UNITUP, IDPEL FROM WO_FOTO_DTKS WHERE STATUS_DIL='AKTIF' ";

$sql = "EXEC SP_GET_FOTO_RUMAH_DTKS ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//echo (sqlsrv_execute($stmt))?'Status get berhasil<br/>':'Status get gagal<br/>';

if(sqlsrv_execute($stmt)){
	//echo '1';
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		
	//echo '2';
		if($unitap<>$row['UNITAP'])
	  		echo $unitap.'<br/>';

	  	$idpel = $row['IDPEL'];
	  	$unitap = $row['UNITAP'];
	  	$unitup = $row['UNITUP'];


		$folder = '../../assets/uploads/foto_rumah_sisa2/'.$unitap.'/';
	    $file_name = $idpel.'.jpeg'; 
	    $file_name2 = $idpel.'_2.jpeg'; 
		$success = downloadFile($folder, $file_name, 'https://portalapp.iconpln.co.id/acmt/DisplayBlobServlet1?idpel='.$idpel.'&blth=202403');
		$success2 = downloadFile($folder, $file_name2, 'https://portalapp.iconpln.co.id/acmt/DisplayBlobServlet5?idpel='.$idpel.'&blth=202405');

		if($success){

	//echo '3';
			$params2 = array(
		        array($idpel, SQLSRV_PARAM_IN),
		        array($success, SQLSRV_PARAM_IN),
		        array($success2, SQLSRV_PARAM_IN),
		    );
			$sql2 = "EXEC SP_UPDATE_DOWNLOAD_FOTO_RUMAH_DTKS @IDPEL = ?, @FOTO_ACMT = ?, @FOTO_ACMT2 = ? ";
			$stmt2 = sqlsrv_prepare($conn, $sql2, $params2);

			if(!sqlsrv_execute($stmt2)){
				echo 'Gagal '.$idpel.'<br/>';
			}
		}

		$i++;
	}
}else{
	echo 'Gagal melakukan Query SP_GET_FOTO_RUMAH_DTKS ke Database';
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
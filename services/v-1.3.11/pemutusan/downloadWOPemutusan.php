<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';

$menu = explode("_", $_GET['l']);
$unitup = $menu[2];
$kodepetugas = str_replace('-', '.', $menu[1]);
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($kodepetugas, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_WS_Download_WO_Pemutusan @UserID = ?, @Unitup = ?, @KODEPETUGAS = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

$response = array();
//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    //die(print_r( sqlsrv_errors(), true));
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database '.$sql;
}else{

	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$thbl = date('mY');
		$response['rbm'][$i]['i'] = $row['IDPEL']; 
		$response['rbm'][$i]['idpiu'] = $row['THBL'].$row['IDPEL']; 
		$response['rbm'][$i]['idpel'] = $row['IDPEL']; 
		$response['rbm'][$i]['nama'] = $row['NAMA']; 
		$response['rbm'][$i]['alamat'] = $row['ALAMAT']; 
		$response['rbm'][$i]['tarif'] = $row['TARIF']; 
		$response['rbm'][$i]['daya'] = $row['DAYA']; 
		$response['rbm'][$i]['gardu'] = $row['GARDU']; 
		$response['rbm'][$i]['tiang'] = $row['TIANG']; 
		$response['rbm'][$i]['rbm'] = $row['RBM']; 
		$response['rbm'][$i]['langkah'] = $row['LANGKAH']; 
		$response['rbm'][$i]['nomet'] = $row['NOMET']; 
		$response['rbm'][$i]['lbr'] = $row['LBR']; 
		$response['rbm'][$i]['tag'] = $row['TAG']; 
		$response['rbm'][$i]['bk'] = $row['BK']; 
		$response['rbm'][$i]['blth'] = $thbl; 
		$response['rbm'][$i]['nope'] = $row['NOPE']; 
		$response['rbm'][$i]['latitude'] = $row['LATITUDE']; 
		$response['rbm'][$i]['longitude'] = $row['LONGITUDE'];
		$response['rbm'][$i]['status'] = $row['STATUS']; 

		$i++;
	}

	$response['success'] = true;

}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);
fastcgi_finish_request();

?>
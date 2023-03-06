<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';

$kodepetugas = $_GET['kodepetugas'];
$unitup = $_GET['unitup'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($kodepetugas, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_WS_Download_WO_KCT @UserID = ?, @Unitup = ?, @KODEPETUGAS = ? ";
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
		$response['wo'][$i]['unitap'] = $row['unitap']; 
		$response['wo'][$i]['unitup'] = $row['unitup']; 
		$response['wo'][$i]['idpel'] = $row['idpel']; 
		$response['wo'][$i]['nama'] = $row['nama']; 
		//$response['wo'][$i]['alamat'] = $row['ALAMAT']; 
		$response['wo'][$i]['tarif'] = $row['tarif']; 
		$response['wo'][$i]['daya'] = $row['daya']; 
		$response['wo'][$i]['nama_gardu'] = $row['nama_gardu']; 
		$response['wo'][$i]['nomor_jurusan_tiang'] = $row['nomor_jurusan_tiang']; 
		$response['wo'][$i]['nomor_meter_kwh'] = $row['nomor_meter_kwh']; 
		$response['wo'][$i]['rpp'] = $row['rpp']; 
		$response['wo'][$i]['krn'] = $row['krn']; 
		$response['wo'][$i]['vkrn'] = $row['vkrn']; 
		$response['wo'][$i]['latitude'] = $row['latitude']; 
		$response['wo'][$i]['longitude'] = $row['longitude'];

		$i++;
	}

	$response['success'] = true;

}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
//fastcgi_finish_request();

?>
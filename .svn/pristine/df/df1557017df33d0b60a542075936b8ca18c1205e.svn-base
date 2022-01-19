<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_Rekap_Agenda_Evaluasi_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(sqlsrv_execute($stmt)){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['segmen_tegangan']['label'][$i] = $row['LABEL']; 
		$response['segmen_tegangan']['jumlah'][$i] = intval($row['JUMLAH']); 

		$i++;
	}

	sqlsrv_next_result($stmt);
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['alasan']['label'][$i] = $row['LABEL']; 
		$response['alasan']['jumlah'][$i] = intval($row['JUMLAH']); 

		$i++;
	}

	sqlsrv_next_result($stmt);
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['tanpa_perluasan']['label'][$i] = $row['LABEL']; 
		$response['tanpa_perluasan']['jumlah'][$i] = intval($row['JUMLAH']); 

		$i++;
	}

	sqlsrv_next_result($stmt);
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['perluasan_jtr']['label'][$i] = $row['LABEL']; 
		$response['perluasan_jtr']['jumlah'][$i] = intval($row['JUMLAH']); 

		$i++;
	}

	sqlsrv_next_result($stmt);
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['perluasan_jtm']['label'][$i] = $row['LABEL']; 
		$response['perluasan_jtm']['jumlah'][$i] = intval($row['JUMLAH']); 

		$i++;
	}

	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


echo json_encode($response);

?>
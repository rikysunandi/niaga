<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

ini_set("memory_limit", "512M");
ini_set('max_execution_time', 900);
set_time_limit(900);

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
//$petugas = $_GET['petugas'];
//$tgl_pemeriksaan_from = $_GET['tgl_pemeriksaan_from'];
//$tgl_pemeriksaan_to = $_GET['tgl_pemeriksaan_to'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        //array($petugas, SQLSRV_PARAM_IN),
        //array($tgl_pemeriksaan_from, SQLSRV_PARAM_IN),
        //array($tgl_pemeriksaan_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Kompor @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);


//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// $stmt = sqlsrv_query($conn, "select * from vw_Create_Pemeriksaan_LPB_Unit_".$unitup." Where LEN(Latitude)>4 AND LEN(Longitude)>4 Order By Tgl_Input ");

if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['plg'][$i]['idpel'] = $row['IDPEL']; 
		$response['plg'][$i]['nama'] = $row['NAMA']; 
		// $response['plg'][$i]['tarif'] = $row['TARIF']; 
		// $response['plg'][$i]['daya'] = intval($row['DAYA']);
		$response['plg'][$i]['latitude'] = ($row['KOORDINAT_X']); 
		$response['plg'][$i]['longitude'] = ($row['KOORDINAT_Y']); 
		$response['plg'][$i]['tarif'] = ($row['TARIF']); 
		$response['plg'][$i]['nama_kelurahan'] = ($row['NAMA_KELURAHAN']); 
		$response['plg'][$i]['gardu'] = ($row['NAMA_GARDU']); 
		$response['plg'][$i]['rbm'] = ($row['RBM']); 
		// $response['plg'][$i]['foto'] = ($row['FOTO']); 

		$i++;
	}
	// sqlsrv_next_result($stmt);

	// $i=0;
	// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	// 	$response['gardu'][$i]['nama_gardu'] = $row['NAMA_GARDU']; 
	// 	$response['gardu'][$i]['kapasitas_trafo'] = $row['KAPASITAS_TRAFO']; 
	// 	// $response['gardu'][$i]['tarif'] = $row['TARIF']; 
	// 	// $response['gardu'][$i]['daya'] = intval($row['DAYA']);
	// 	$response['gardu'][$i]['latitude'] = ($row['LATITUDE']); 
	// 	$response['gardu'][$i]['longitude'] = ($row['LONGITUDE']); 
	// 	$response['gardu'][$i]['nomor_gardu'] = ($row['NOMOR_GARDU']); 
	// 	// $response['gardu'][$i]['foto'] = ($row['FOTO']); 

	// 	$i++;
	// }

	// sqlsrv_next_result($stmt);

	// $i=0;
	// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	// 	$response['wil'][$i]['kodepetugas'] = $row['KODEPETUGAS']; 
	// 	$response['wil'][$i]['rbm'] = $row['RBM']; 

	// 	$i++;
	// }

	//$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


header('Content-Type: application/json');
echo json_encode($response);
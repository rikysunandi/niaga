<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

ini_set("memory_limit", "128M");

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$rpp = $_GET['rpp'];
//$tgl_pemeriksaan_from = $_GET['tgl_pemeriksaan_from'];
//$tgl_pemeriksaan_to = $_GET['tgl_pemeriksaan_to'];
$user = 'SYSTEM';

$response = array();

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($rpp, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_RPP_Final_Get_List @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Petugas = ?, @RPP = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);


//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// $stmt = sqlsrv_query($conn, "select * from vw_Create_Pemeriksaan_LPB_Unit_".$unitup." Where LEN(Latitude)>4 AND LEN(Longitude)>4 Order By Tgl_Input ");

if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rpp'][$i]['idpel'] = $row['IDPEL']; 
		$response['rpp'][$i]['nama'] = $row['NAMA']; 
		// $response['rpp'][$i]['tarif'] = $row['TARIF']; 
		// $response['rpp'][$i]['daya'] = intval($row['DAYA']);
		$response['rpp'][$i]['latitude'] = ($row['LATITUDE']); 
		$response['rpp'][$i]['longitude'] = ($row['LONGITUDE']); 
		$response['rpp'][$i]['petugas'] = ($row['RPP_PETUGAS']); 
		$response['rpp'][$i]['rpp_kddk'] = ($row['RPP_KDDK']); 
		$response['rpp'][$i]['rpp'] = ($row['RPP']); 
		$response['rpp'][$i]['nama_gardu'] = ($row['NAMA_GARDU']); 
		$response['rpp'][$i]['nomor_jurusan_tiang'] = ($row['NOMOR_JURUSAN_TIANG']); 
		$response['rpp'][$i]['petugas_priangan'] = ($row['PETUGAS_PRIANGAN']); 
		$response['rpp'][$i]['tgl_tagging'] = ($row['TGL_TAGGING']); 
		if(strlen($row['TGL_TAGGING'])==19)
			$tgl_tagging=$row['TGL_TAGGING'];
		else
			$tgl_tagging="9999-12-31 23:59:59";
		$response['rpp'][$i]['tgl_tagging_time'] = strtotime($tgl_tagging); 
		$response['rpp'][$i]['urutan'] = intval($row['URUTAN']); 
		// $response['rpp'][$i]['foto'] = ($row['FOTO']); 

		$i++;
	}

	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


header('Content-Type: application/json');
echo json_encode($response);
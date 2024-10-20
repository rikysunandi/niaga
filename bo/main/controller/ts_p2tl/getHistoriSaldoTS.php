<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$response = array();
$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$jenis_plg = $_GET['jenis_plg'];
$tgl_kategori = $_GET['tgl_kategori'];
$tgl_saldo = $_GET['tgl_saldo'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($jenis_plg, SQLSRV_PARAM_IN),
        array($tgl_kategori, SQLSRV_PARAM_IN),
        array($tgl_saldo, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Histori_Saldo_TS @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?,  @Jenis_Plg = ?, @Tgl_Kategori = ?, @Tgl_Saldo = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

if($stmt){
	$i=0;
	$response['total_jml_plg'] = 0;
	$response['total_jml_agenda'] = 0;
	$response['total_rpts'] = 0;
	$response['total_rpts_miliyar'] = 0;

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		$response['data'][strtolower($row['KATEGORI']).'_jml_plg'] = $row['JML_PLG']; 
		$response['data'][strtolower($row['KATEGORI']).'_jml_agenda'] = $row['JML_AGENDA']; 
		$response['data'][strtolower($row['KATEGORI']).'_rpts'] = floatval($row['RPTS']); 
		$response['data'][strtolower($row['KATEGORI']).'_rpts_miliyar'] = floatval($row['RPTS_MILIYAR']); 
		$response['data']['total_jml_plg'] += $row['JML_PLG']; 
		$response['data']['total_jml_agenda'] += $row['JML_AGENDA']; 
		$response['data']['total_rpts'] += floatval($row['RPTS']); 
		$response['data']['total_rpts_miliyar'] += floatval($row['RPTS_MILIYAR']); 

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
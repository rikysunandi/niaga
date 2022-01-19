<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];
$jenis_transaksi = strtoupper($_GET['jenis_transaksi']);

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_dapot_jenis_transaksi_ap where JENIS_TRANSAKSI='$jenis_transaksi' AND UNITAP='$unitap'");
else
	$stmt = sqlsrv_query($conn, "select * from vw_dapot_jenis_transaksi_ui where JENIS_TRANSAKSI='$jenis_transaksi'");

if($stmt){
	$i=0;
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$response['jml_agenda'][$i] =  number_format($row['JML_AGENDA']); 
	$response['jml_daya'][$i] =  format_unit($row['JML_DAYA']).'VA'; 
	$response['jml_rpbp'][$i] =  format_cash($row['JML_RPBP']); 
	$response['jml_rpujl'][$i] = format_cash($row['JML_RPUJL']); 
	$response['jml_rprab'][$i] = format_cash($row['JML_RPRAB']); 

	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


echo json_encode($response);

?>
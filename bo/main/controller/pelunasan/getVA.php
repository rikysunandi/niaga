<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$nomor_va = $_GET['nomor_va'];

$stmt = sqlsrv_query($conn, "select * from m_virtual_account where nomor_va = '$nomor_va' ");
if($stmt){
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$response['nomor_va'] = $row['nomor_va']; 
	$response['bank'] = ($row['bank']); 
	$response['unitupi'] = ($row['unitupi']); 
	$response['unitap'] = ($row['unitap']); 
	$response['keterangan'] = ($row['keterangan']); 

	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


echo json_encode($response);

?>
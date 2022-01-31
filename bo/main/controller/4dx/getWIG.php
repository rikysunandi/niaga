<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$id = $_GET['id'];

$stmt = sqlsrv_query($conn, "select TOP 1 * from m_wig where ID='$id' ");
if($stmt){
	$response['row'] = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	if($response['row']){
		$response['success'] = true;
	}
	else{
		$response['success'] = false;
	}


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);

?>
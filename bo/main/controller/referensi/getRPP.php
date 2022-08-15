<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$petugas = $_GET['petugas'];

$stmt = sqlsrv_query($conn, "select RPP from vw_petugas_rpp where PETUGAS='$petugas' ORDER BY RPP ");
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['kode'] = $row['RPP']; 
		$response['rows'][$i]['nama'] = $row['RPP']; 

		$i++;
	}

	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);

?>
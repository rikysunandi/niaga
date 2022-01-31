<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$bidang = $_GET['bidang'];

$stmt = sqlsrv_query($conn, "select * from m_wig where bidang='$bidang' order by NAMA_WIG");
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['kode'] = $row['ID']; 
		$response['rows'][$i]['nama'] = $row['NAMA_WIG']; 

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
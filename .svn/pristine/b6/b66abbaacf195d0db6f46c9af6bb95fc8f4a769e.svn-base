<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$unitap = $_GET['unitap'];

$stmt = sqlsrv_query($conn, "select * from m_unitup where unitap='$unitap' order by NAMA");
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['kode'] = $row['UNITUP']; 
		$response['rows'][$i]['nama'] = $row['NAMA']; 

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
<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$unitup = $_GET['unitup'];

$stmt = sqlsrv_query($conn, "select DISTINCT UPPER(USERNAME) KODEPETUGAS from m_user_priangan where unitup='$unitup' AND USERNAME IS NOT NULL AND USERNAME NOT LIKE '%.PLN%' order by USERNAME");
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['kode'] = $row['KODEPETUGAS']; 
		$response['rows'][$i]['nama'] = $row['KODEPETUGAS']; 

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
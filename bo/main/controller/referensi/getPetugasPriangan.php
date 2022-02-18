<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$unitup = $_GET['unitup'];

$stmt = sqlsrv_query($conn, "select DISTINCT UPPER(KODEPETUGAS) KODEPETUGAS from m_rbm_priangan where unitup='$unitup' AND KODEPETUGAS IS NOT NULL order by KODEPETUGAS");
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
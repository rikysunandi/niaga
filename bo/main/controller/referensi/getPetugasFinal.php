<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$unitup = $_GET['unitup'];

$stmt = sqlsrv_query($conn, "select UPPER(RPP_PETUGAS) RPP_PETUGAS from m_dil_rpp_final where unitup='$unitup' AND RPP_PETUGAS IS NOT NULL GROUP BY RPP_PETUGAS order by RPP_PETUGAS");
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['kode'] = $row['RPP_PETUGAS']; 
		$response['rows'][$i]['nama'] = $row['RPP_PETUGAS']; 

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
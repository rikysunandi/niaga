<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_dapot_ap where UNITAP='$unitap'");
else
	$stmt = sqlsrv_query($conn, "select * from vw_dapot_ui ");

if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['klp_plg'][$i] = $row['KLP_PLG']; 
		$response['jml_daya'][$i] = ROUND($row['JML_DAYA']/1000000,1); 

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
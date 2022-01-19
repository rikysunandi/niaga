<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_dapot_rab_up where UNITAP='$unitap' order by JML_RPRAB_TOTAL DESC");
else
	$stmt = sqlsrv_query($conn, "select * from vw_dapot_rab_ap order by JML_RPRAB_TOTAL DESC");

if($stmt){
	$i=0;
	$response['total_agenda'] = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['nama'][$i] = $row['NAMA']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['jml_rprab_non_ge'][$i] = ROUND($row['JML_RPRAB_NON_GE']/1000000000,2); 
		$response['jml_rprab_ge'][$i] = ROUND($row['JML_RPRAB_GE']/1000000000,2); 
		$response['jml_rprab_tm'][$i] = ROUND($row['JML_RPRAB_TM']/1000000000,2); 

		$i++;
	}

	$response['total_agenda'] = number_format($response['total_agenda']);
	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


echo json_encode($response);

?>
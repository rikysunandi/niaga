<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_dapot_daya_up where UNITAP='$unitap' order by JML_DAYA_TOTAL DESC");
else
	$stmt = sqlsrv_query($conn, "select * from vw_dapot_daya_ap order by JML_DAYA_TOTAL DESC");

if($stmt){
	$i=0;
	$response['total_agenda'] = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['nama'][$i] = $row['NAMA']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['jml_daya_non_ge'][$i] = ROUND($row['JML_DAYA_NON_GE']/1000000,2); 
		$response['jml_daya_ge'][$i] = ROUND($row['JML_DAYA_GE']/1000000,2); 
		$response['jml_daya_tm'][$i] = ROUND($row['JML_DAYA_TM']/1000000,2); 

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
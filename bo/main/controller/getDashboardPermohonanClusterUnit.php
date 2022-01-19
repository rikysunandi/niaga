<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_daftung_cluster_up where UNITAP='$unitap' order by SELISIH ASC");
else
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_daftung_cluster_ap order by SELISIH ASC");

if($stmt){
	$i=0;
	$response['total_bp'] = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['nama'][$i] = $row['NAMA']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['rp_bp'][$i] = ROUND($row['RP_BP']/1000000000,2); 
		$response['rp_rab'][$i] = ROUND($row['RP_RAB']/1000000000,2); 
		$response['selisih'][$i] = ROUND($row['SELISIH']/1000000000,2); 
		$response['kurang_bp'][$i] = ROUND($row['KURANG_BP']/1000000000,2);  
		$response['lebih_bp'][$i] = ROUND($row['LEBIH_BP']/1000000000,2);  
		$response['total_bp'] += intval($row['RP_BP']);

		$i++;
	}

	$response['total_bp'] = number_format($response['total_bp']);
	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


echo json_encode($response);

?>
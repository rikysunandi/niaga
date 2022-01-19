<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_daftung_status_tmp_up where UNITAP='$unitap' order by JML_AGENDA_MELEBIHI_TMP ASC");
else
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_daftung_status_tmp_ap order by JML_AGENDA_MELEBIHI_TMP ASC");

if($stmt){
	$i=0;
	$response['total_agenda'] = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['nama'][$i] = $row['NAMA']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['jml_agenda_melebihi_tmp'][$i] = intval($row['JML_AGENDA_MELEBIHI_TMP']); 
		$response['jml_agenda_dalam_tmp'][$i] = intval($row['JML_AGENDA_DALAM_TMP']); 
		$response['jml_agenda_mendekati_tmp'][$i] = intval($row['JML_AGENDA_MENDEKATI_TMP']); 
		$response['total_agenda'] += intval($row['JML_AGENDA']);

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
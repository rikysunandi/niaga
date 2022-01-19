<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_daftung_alasan_up where UNITAP='$unitap' order by JML_AGENDA DESC");
else
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_daftung_alasan_ap order by JML_AGENDA DESC");

if($stmt){
	$i=0;
	$response['total_agenda'] = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['nama'][$i] = $row['NAMA']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['jml_agenda_alasan_lain'][$i] = intval($row['JML_AGENDA_ALASAN_LAIN']); 
		$response['jml_agenda_alasan_perluasan_jtm'][$i] = intval($row['JML_AGENDA_ALASAN_PERLUASAN_JTM']); 
		$response['jml_agenda_alasan_perluasan_jtr'][$i] = intval($row['JML_AGENDA_ALASAN_PERLUASAN_JTR']); 
		$response['jml_agenda_alasan_tanpa_perluasan'][$i] = intval($row['JML_AGENDA_ALASAN_TANPA_PERLUASAN']); 
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
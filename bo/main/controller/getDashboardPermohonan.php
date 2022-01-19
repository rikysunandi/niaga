<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_daftung_up where UNITAP='$unitap' order by JML_AGENDA_MELEBIHI_TMP ASC");
else
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_daftung_ap order by JML_AGENDA_MELEBIHI_TMP ASC");

if($stmt){
	$i=0;
	$response['total_agenda'] = 0;
	$response['total_agenda_rab'] = 0;
	$response['total_agenda_non_rab'] = 0;
	$response['total_proses'] = 0;
	$response['total_evaluasi'] = 0;
	$response['total_klasifikasi_rab_1'] = 0;
	$response['total_klasifikasi_rab_2'] = 0;
	$response['total_klasifikasi_rab_3'] = 0;
	$response['total_klasifikasi_rab_4'] = 0;
	$response['total_klasifikasi_rab_5'] = 0;
	$response['total_klasifikasi_rab_6'] = 0;
	$response['total_klasifikasi_rab_7'] = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['nama'][$i] = $row['NAMA']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['jml_agenda'][$i] = intval($row['JML_AGENDA']); 
		$response['jml_agenda_rab'][$i] = intval($row['JML_AGENDA_RAB']); 
		$response['jml_agenda_non_rab'][$i] = intval($row['JML_AGENDA_NON_RAB']); 
		$response['jml_proses'][$i] = intval($row['JML_PROSES']); 
		$response['jml_evaluasi'][$i] = intval($row['JML_EVALUASI']); 
		$response['jml_klasifikasi_rab_1'][$i] = intval($row['JML_AGENDA_KLASIFIKASI_RAB_1']); 
		$response['jml_klasifikasi_rab_2'][$i] = intval($row['JML_AGENDA_KLASIFIKASI_RAB_2']); 
		$response['jml_klasifikasi_rab_3'][$i] = intval($row['JML_AGENDA_KLASIFIKASI_RAB_3']); 
		$response['jml_klasifikasi_rab_4'][$i] = intval($row['JML_AGENDA_KLASIFIKASI_RAB_4']); 
		$response['jml_klasifikasi_rab_5'][$i] = intval($row['JML_AGENDA_KLASIFIKASI_RAB_5']); 
		$response['jml_klasifikasi_rab_6'][$i] = intval($row['JML_AGENDA_KLASIFIKASI_RAB_6']); 
		$response['jml_klasifikasi_rab_7'][$i] = intval($row['JML_AGENDA_KLASIFIKASI_RAB_7']); 
		$response['total_agenda'] += intval($row['JML_AGENDA']); 
		$response['total_agenda_rab'] += intval($row['JML_AGENDA_RAB']); 
		$response['total_agenda_non_rab'] += intval($row['JML_AGENDA_NON_RAB']); 
		$response['total_proses'] += intval($row['JML_PROSES']); 
		$response['total_evaluasi'] += intval($row['JML_EVALUASI']); 
		$response['total_klasifikasi_rab_1'] += intval($row['JML_AGENDA_KLASIFIKASI_RAB_1']); 
		$response['total_klasifikasi_rab_2'] += intval($row['JML_AGENDA_KLASIFIKASI_RAB_2']); 
		$response['total_klasifikasi_rab_3'] += intval($row['JML_AGENDA_KLASIFIKASI_RAB_3']); 
		$response['total_klasifikasi_rab_4'] += intval($row['JML_AGENDA_KLASIFIKASI_RAB_4']); 
		$response['total_klasifikasi_rab_5'] += intval($row['JML_AGENDA_KLASIFIKASI_RAB_5']); 
		$response['total_klasifikasi_rab_6'] += intval($row['JML_AGENDA_KLASIFIKASI_RAB_6']); 
		$response['total_klasifikasi_rab_7'] += intval($row['JML_AGENDA_KLASIFIKASI_RAB_7']); 
		$response['jml_agenda_dalam_tmp'][$i] = intval($row['JML_AGENDA_DALAM_TMP']); 
		$response['jml_agenda_mendekati_tmp'][$i] = intval($row['JML_AGENDA_MENDEKATI_TMP']); 
		$response['jml_agenda_melebihi_tmp'][$i] = intval($row['JML_AGENDA_MELEBIHI_TMP']);
		
		$response['jam_upload_daftung'] = date('d/m/Y h:i', intval($row['JAM_UPLOAD'])/1000);  

		$i++;
	}

	$response['total_agenda'] = number_format($response['total_agenda']);
	$response['total_agenda_rab'] = number_format($response['total_agenda_rab']);
	$response['total_agenda_non_rab'] = number_format($response['total_agenda_non_rab']);
	$response['total_proses'] = number_format($response['total_proses']);
	$response['total_evaluasi'] = number_format($response['total_evaluasi']);
	$response['total_klasifikasi_rab_1'] = number_format($response['total_klasifikasi_rab_1']);
	$response['total_klasifikasi_rab_2'] = number_format($response['total_klasifikasi_rab_2']);
	$response['total_klasifikasi_rab_3'] = number_format($response['total_klasifikasi_rab_3']);
	$response['total_klasifikasi_rab_4'] = number_format($response['total_klasifikasi_rab_4']);
	$response['total_klasifikasi_rab_5'] = number_format($response['total_klasifikasi_rab_5']);
	$response['total_klasifikasi_rab_6'] = number_format($response['total_klasifikasi_rab_6']);
	$response['total_klasifikasi_rab_7'] = number_format($response['total_klasifikasi_rab_7']);
	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


echo json_encode($response);

?>
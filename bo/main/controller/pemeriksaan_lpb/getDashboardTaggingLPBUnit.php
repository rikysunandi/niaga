<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$response = array();
$unitap = $_GET['unitap'];

if($unitap <> '00' AND strlen($unitap)==5)
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_pemeriksaan_lpb_up where UNITAP='$unitap' order by PERSENTASE DESC");
else
	$stmt = sqlsrv_query($conn, "select * from vw_rekap_pemeriksaan_lpb_ap order by PERSENTASE DESC");

if($stmt){
	$i=0;

	$response['total_plg'] = 0;
	$response['total_sdh_tagging'] = 0;
	$response['total_blm_tagging'] = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['nama'][$i] = $row['NAMA']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['jml_plg'][$i] = intval($row['JML_PLG']); 
		$response['jml_sdh_tagging'][$i] = intval($row['JML_SDH_TAGGING']); 
		$response['jml_blm_tagging'][$i] = intval($row['JML_BLM_TAGGING']); 
		$response['persentase_sdh'][$i] = floatval($row['PERSENTASE']); 
		$response['persentase_blm'][$i] = floatval(100 - $row['PERSENTASE']); 


		$response['rows'][$i]['unit'] = $row['UNIT']; 
		$response['rows'][$i]['nama'] = $row['NAMA']; 
		$response['rows'][$i]['jml_plg'] = number_format($row['JML_PLG']); 
		$response['rows'][$i]['jml_sdh_tagging'] = number_format($row['JML_SDH_TAGGING']); 
		$response['rows'][$i]['jml_blm_tagging'] = number_format($row['JML_BLM_TAGGING']); 
		$response['rows'][$i]['persentase'] = number_format($row['PERSENTASE'], 2, '.', ',').' %'; 
		
		$response['total_plg'] += intval($row['JML_PLG']); 
		$response['total_sdh_tagging'] += intval($row['JML_SDH_TAGGING']); 
		$response['total_blm_tagging'] += intval($row['JML_BLM_TAGGING']); 

		$i++;
	}
	$response['total_persentase'] = number_format(($response['total_sdh_tagging']/$response['total_plg'])*100, 2, '.', ',').' %';


	if($unitap <> '00' AND strlen($unitap)==5)
		$stmt = sqlsrv_query($conn, "select * from vw_rekap_pemeriksaan_lpb_up where UNITAP='$unitap' order by PERSENTASE DESC");
	else
		$stmt = sqlsrv_query($conn, "select * from vw_rekap_pemeriksaan_lpb_up order by PERSENTASE DESC");

	if($stmt){
		$i=0;

		$response['ulp_total_plg'] = 0;
		$response['ulp_total_sdh_tagging'] = 0;
		$response['ulp_total_blm_tagging'] = 0;
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

			$response['ulp'][$i]['unit'] = $row['UNIT']; 
			$response['ulp'][$i]['nama'] = $row['NAMA']; 
			$response['ulp'][$i]['jml_plg'] = number_format($row['JML_PLG']); 
			$response['ulp'][$i]['jml_sdh_tagging'] = number_format($row['JML_SDH_TAGGING']); 
			$response['ulp'][$i]['jml_blm_tagging'] = number_format($row['JML_BLM_TAGGING']); 
			$response['ulp'][$i]['persentase'] = number_format($row['PERSENTASE'], 2, '.', ',').' %'; 
			
			$response['ulp_total_plg'] += intval($row['JML_PLG']); 
			$response['ulp_total_sdh_tagging'] += intval($row['JML_SDH_TAGGING']); 
			$response['ulp_total_blm_tagging'] += intval($row['JML_BLM_TAGGING']); 

			$i++;
		}
		$response['ulp_total_persentase'] = number_format(($response['ulp_total_sdh_tagging']/$response['ulp_total_plg'])*100, 2, '.', ',').' %';

		$response['success'] = true;
		sqlsrv_free_stmt($stmt);


	}else{
		$response['success'] = false;
		$response['msg'] = 'Gagal melakukan Query ke Database';
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
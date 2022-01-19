<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$query = $_GET['query'];

$stmt = sqlsrv_query($conn, "select TOP 1 * from vw_pemeriksaan_lpb_latest where IDPEL = '$query' OR NOMOR_METER_KWH = '$query' ");
if($stmt){
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$response['idpel'] = $row['IDPEL']; 
	$response['tgl_pemeriksaan'] = date_format($row['TGL_PEMERIKSAAN'],"d/m/Y"); 
	$response['nomor_meter_kwh'] = ($row['NOMOR_METER_KWH']); 
	$response['nama'] = ($row['NAMA']); 
	$response['tarif'] = ($row['TARIF']); 
	$response['daya'] = ($row['DAYA']); 
	$response['unitap'] = ($row['UNITAP']); 
	$response['unitup'] = ($row['UNITUP']); 
	$response['latitude'] = ($row['LATITUDE']); 
	$response['longitude'] = ($row['LONGITUDE']); 
	$response['akurasi_koordinat'] = ($row['AKURASI_KOORDINAT']); 
	$response['user_input'] = ($row['USER_INPUT']); 
	$response['foto'] = ($row['FOTOPATH']); 

	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


echo json_encode($response);

?>
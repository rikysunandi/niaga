<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/database.php';


$response = array();
$query = $_GET['query'];

$stmt = sqlsrv_query($conn, "select TOP 1 * from vw_dil where IDPEL = '$query' OR NOMOR_METER_KWH = '$query' ");
if($stmt){
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	if($row['IDPEL']<>''){
		$response['unitupi'] = $row['UNITUPI']; 
		$response['unitap'] = $row['UNITAP']; 
		$response['unitup'] = $row['UNITUP']; 
		$response['idpel'] = ($row['IDPEL']); 
		$response['nama'] = ($row['NAMA']); 
		$response['tarif'] = ($row['TARIF']); 
		$response['daya'] = ($row['DAYA']); 
		$response['kogol'] = ($row['KOGOL']); 
		$response['kddk'] = ($row['XKDDK']); 
		$response['status_dil'] = ($row['STATUS_DIL']); 
		$response['nama_gardu'] = ($row['NAMA_GARDU']); 
		$response['nomor_jurusan_tiang'] = ($row['NOMOR_JURUSAN_TIANG']); 
		$response['koordinat_x'] = ($row['KOORDINAT_X']); 
		$response['koordinat_y'] = ($row['KOORDINAT_Y']); 
		$response['v_bulan_rekap'] = ($row['V_BULAN_REKAP']); 
		$response['alamat'] = ($row['ALAMAT']); 
		$response['nohp'] = ($row['NOHP']); 
		$response['merk_meter_kwh'] = ($row['MERK_METER_KWH']); 
		$response['rpujl_real'] = number_format($row['RPUJL_REAL']); 
		$response['success'] = true;
	}else{
		$response['success'] = false;
		$response['msg'] = 'Pelanggan tidak ditemukan';
	}

	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}

header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
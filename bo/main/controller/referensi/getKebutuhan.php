<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$jenis = $_GET['jenis'];
$ket_transaksi = $_GET['ket_transaksi'];
$daya_baru = $_GET['daya_baru'];
$alasan_kriteria_tmp = $_GET['alasan_kriteria_tmp'];

if($jenis=='MDU')
	$stmt = sqlsrv_query($conn, "select MATERIAL ID_MATERIAL, MATERIAL NAMA, HARGA_SATUAN from vw_material where JENIS='MDU' order by MATERIAL");
else if($jenis=='NON-MDU')
	$stmt = sqlsrv_query($conn, "select MATERIAL ID_MATERIAL, MATERIAL NAMA, HARGA_SATUAN from vw_material where JENIS='NON-MDU' order by MATERIAL");
else if($jenis=='JASA'){
	if($alasan_kriteria_tmp<>'TANPA PERLUASAN')
		$pekerjaan = $alasan_kriteria_tmp;
	else
		$pekerjaan = $ket_transaksi;
	$stmt = sqlsrv_query($conn, "select ID KODE, 'JASA ".$pekerjaan."' NAMA, HARGA_TOTAL HARGA_SATUAN from m_jasa_aksesoris where PEKERJAAN LIKE '%".$pekerjaan."%' AND ".$daya_baru." BETWEEN DAYA_BARU_FROM AND DAYA_BARU_TO order by PEKERJAAN");
}

if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['kode'] = $row['KODE']; 
		$response['rows'][$i]['nama'] = ($row['NAMA']); 
		$response['rows'][$i]['harga_satuan'] = ($row['HARGA_SATUAN']); 

		$i++;
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
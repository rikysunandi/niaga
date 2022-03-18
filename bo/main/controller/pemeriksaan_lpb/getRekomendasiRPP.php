<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

$stmt = sqlsrv_query($conn, "select dbo.fn_getRekomendasiRPP('$latitude', '$longitude', '$petugas') as REKOMENDASI");
if($stmt){
	$i=0;
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$response['rekomendasi'] = $row['REKOMENDASI']; 

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
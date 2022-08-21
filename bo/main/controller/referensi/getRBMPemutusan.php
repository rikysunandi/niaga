<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$blth = $_GET['blth'];

if($petugas=='_BLM_ADA_PETUGAS')
	$stmt = sqlsrv_query($conn, "select RBM from t_wo_pemutusan where blth='$blth' AND unitup='$unitup' AND kodepetugas is null group by RBM order by RBM");
else
	$stmt = sqlsrv_query($conn, "select RBM from t_wo_pemutusan where blth='$blth' AND unitup='$unitup' AND kodepetugas='$petugas' group by RBM order by RBM");
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['kode'] = $row['RBM']; 
		$response['rows'][$i]['nama'] = $row['RBM']; 

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
<?php
session_start();
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$show_all = isset($_GET['show_all'])? $_GET['show_all']:'T';
$unitap=$_SESSION['unitap'];
$response = array();

if($show_all=='Y')
	$stmt = sqlsrv_query($conn, "select * from m_unitap where unitupi='$unitupi' order by NAMA");
else{
	if($unitap!='')
		$stmt = sqlsrv_query($conn, "select * from m_unitap where unitupi='$unitupi' and unitap='$unitap' order by NAMA");
	else
		$stmt = sqlsrv_query($conn, "select * from m_unitap where unitupi='$unitupi' order by NAMA");
}
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['kode'] = $row['UNITAP']; 
		$response['rows'][$i]['nama'] = ($row['NAMA']); 

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
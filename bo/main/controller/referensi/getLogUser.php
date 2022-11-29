<?php
session_start();
require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$username = $_SESSION['username'];

$stmt = sqlsrv_query($conn, "SELECT TOP 10 * FROM (
	select tgl_log tgl, convert(varchar, tgl_log, 0) tanggal, 'Login dengan IP '+ip+' menggunakan '+browser aktivitas from t_log_auth where username='$username' 
	union all select tgl_akses tgl, convert(varchar, tgl_akses, 0) tanggal, 'Akses menu '+page aktivitas from t_log_akses where username='$username' 
	) x ORDER BY tgl desc ");
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['tanggal'] = $row['tanggal']; 
		$response['rows'][$i]['aktivitas'] = $row['aktivitas']; 

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
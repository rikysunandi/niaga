<?php

ini_set('upload_max_filesize', '30M');
ini_set('post_max_size', '30M');
ini_set('max_execution_time', 0);
ini_set('memory_limit',-1);
ini_set('sqlsrv.timeout', 10000000);
ini_set('sqlsrv.connect_timeout', 10000000);

require_once '../../../config/database.php';
require_once '../../../config/ftp.php';

$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_Generate_Rekap_Pelunasan @UserID = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
	$response['success'] = false;
	$response['msg'] = 'Rekap pelunasan gagal';
}else{
	$response['success'] = true;
	$response['msg'] = 'Rekap pelunasan berhasil';
}



sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);
?>

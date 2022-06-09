<?php

ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '128M');
ini_set('sqlsrv.timeout', 1200);
ini_set('sqlsrv.connect_timeout', 1200);

require_once '../../../config/database.php';
//require_once '../../../config/ftp.php';

// $unitupi = $_POST['unitupi'];
// $unitap = $_POST['unitap'];

$unitupi = $_POST['unitupi'];
$unitap = $_POST['unitap'];
$unitup = $_POST['unitup'];
$filename = $_POST['filename'];
$kodegerak = $_POST['kodegerak'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($kodegerak, SQLSRV_PARAM_IN),
        array($filename, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_Upload_Pelunasan_Dev @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @KDGERAKKELUAR = ?, @Filename = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
	$response['success'] = false;
	$response['msg'] = 'Upload pelunasan gagal';
}
// else{
// 	$response['success'] = true;
// 	$response['msg'] = 'Upload pelunasan berhasil';
// }

while(sqlsrv_next_result($stmt))
{ 
    $response['success'] = true;
    $response['msg'] = 'Update data Pelunasan telah selesai';
}


// $response['success'] = true;
// $response['msg'] = 'Upload pelunasan berhasil';

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);
?>

<?php


require_once '../../../config/database.php';
require_once '../../../config/config.php';
//require_once '../../../config/ftp.php';

$blth = $_POST['blth'];
$unitupi = $_POST['unitupi'];
$unitap = $_POST['unitap'];
$unitup = $_POST['unitup'];
$user = 'SYSTEM';

$params = array(
        array($blth, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($user, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_WO_Intimasi_Simpan @BLTH = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @UserID = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
	$response['success'] = false;
	$response['msg'] = 'Proses WO Intimasi gagal';
}else{
	$response['success'] = true;
	$response['msg'] = 'Proses WO Intimasi berhasil, silahkan download WO di HP P3';
}


// $response['success'] = true;
// $response['msg'] = 'Upload pelunasan berhasil';

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);
?>

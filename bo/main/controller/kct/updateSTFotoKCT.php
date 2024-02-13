<?php

session_start();
require_once '../../../config/database.php';
require_once '../../../config/config.php';

$idpel = $_POST['idpel'];
$st_foto = $_POST['st_foto'];
$user = 'SYSTEM';

$params = array(
        array($idpel, SQLSRV_PARAM_IN),
        array($st_foto, SQLSRV_PARAM_IN),
        array($user, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_UPDATE_ST_FOTO_KCT @IDPEL = ?, @ST_FOTO = ?, @UserID = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
	$response['success'] = false;
	$response['msg'] = 'Proses update gagal';
}else{
	$response['success'] = true;
	$response['msg'] = 'Proses update berhasil';
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);
?>

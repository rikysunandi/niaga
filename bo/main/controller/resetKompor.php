<?php

require_once '../../config/database.php';


$unitupi = $_POST['unitupi'];
$unitap = $_POST['unitap'];
$unitup = $_POST['unitup'];
$user = 'SYSTEM';

$params = array(
    array($unitupi, SQLSRV_PARAM_IN),
    array($unitap, SQLSRV_PARAM_IN),
    array($unitup, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_KOMPOR_RESET @UNITUPI = ?, @UNITAP = ?, @UNITUP= ?, @USER_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
	$response['success'] = true;
  $response['msg'] = 'Data target berhasil direset';
}else{
	$response['success'] = false;
  $response['msg'] = 'Reset data target gagal';

}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);


//if($fp)fclose($fp);


header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
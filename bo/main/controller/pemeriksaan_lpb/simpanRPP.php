<?php

require_once '../../../config/database.php';

$petugas = $_POST['petugas'];
$rpp = $_POST['rpp'];
$idpel = $_POST['idpel'];
$user = 'SYSTEM';

$params = array(
    array($petugas, SQLSRV_PARAM_IN),
    array($rpp, SQLSRV_PARAM_IN),
    array($idpel, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_PLG_RPP_SIMPAN @PETUGAS = ?, @RPP = ?, @IDPEL = ?, @USER_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
  
  if(sqlsrv_rows_affected( $stmt ) > 0){
  	$response['success'] = true;
  }else
  	$response['success'] = false;

}else{
  $response['success'] = false;
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);


//if($fp)fclose($fp);


header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
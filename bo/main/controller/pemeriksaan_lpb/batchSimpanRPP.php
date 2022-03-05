<?php

require_once '../../../config/database.php';

$petugas = $_POST['petugas'];
$rpp = $_POST['rpp'];
$idpels = $_POST['idpels'];
$user = 'SYSTEM';

$params = array(
    array($petugas, SQLSRV_PARAM_IN),
    array($rpp, SQLSRV_PARAM_IN),
    array($idpels, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_BATCH_RPP_SIMPAN @PETUGAS = ?, @RPP = ?, @IDPELS = ?, @USER_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
  sqlsrv_next_result($stmt);
  $i=0;
  while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
    $response['idpels'][$i] = $row['IDPEL'];
    $i++;
  }
  
  if(count($response['idpels'])>0){
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
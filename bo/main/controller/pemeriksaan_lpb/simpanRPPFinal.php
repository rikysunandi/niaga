<?php

require_once '../../../config/database.php';

$petugas = $_POST['petugas'];
$rpp = $_POST['rpp'];
$urutan = str_pad($_POST['urutan'], 4, "0", STR_PAD_LEFT);
$idpel = $_POST['idpel'];
$user = 'SYSTEM';

$params = array(
    array($petugas, SQLSRV_PARAM_IN),
    array($rpp, SQLSRV_PARAM_IN),
    array($urutan, SQLSRV_PARAM_IN),
    array($idpel, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_RPP_FINAL_SIMPAN @PETUGAS = ?, @RPP = ?, @URUTAN = ?, @IDPEL = ?, @USER_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
  sqlsrv_next_result($stmt);
  $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  
  if($row['RPP']==$rpp && $row['URUTAN']==$urutan){
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
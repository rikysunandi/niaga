<?php

require_once '../../config/database.php';


$idpels = $_POST['idpels'];
$user = 'SYSTEM';

$params = array(
    array($idpels, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_BATCH_KOMPOR_SIMPAN @IDPELS = ?, @USER_INPUT = ? ";
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
    $response['msg'] = 'Data Pelanggan berhasil disimpan';
  }else
  	$response['success'] = false;
    $response['msg'] = 'Tidak ada data Pelanggan yang disimpan';

}else{
  $response['success'] = false;
  $response['msg'] = 'Gagal mengeksekusi procedure di Database!';
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);


//if($fp)fclose($fp);


header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
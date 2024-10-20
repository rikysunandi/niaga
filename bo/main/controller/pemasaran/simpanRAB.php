<?php

require_once '../../../config/database.php';

$noagenda = $_POST['noagenda'];
$rab_material = str_replace(',','',$_POST['rab_material']);
$rab_jasa = str_replace(',','',$_POST['rab_jasa']);
$rp_rab = str_replace(',','',$_POST['rp_rab']);
$user = 'SYSTEM';

$params = array(
    array($noagenda, SQLSRV_PARAM_IN),
    array($rab_material, SQLSRV_PARAM_IN),
    array($rab_jasa, SQLSRV_PARAM_IN),
    array($rp_rab, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_RAB_SIMPAN @NOAGENDA_INDIVIDU = ?, @RAB_MATERIAL = ?, @RAB_JASA = ?, @RP_RAB = ?, @USER_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
  
  if(sqlsrv_rows_affected( $stmt ) >= 0){
  	$response['success'] = true;
    $response['msg'] = 'Data berhasil disimpan';
  }else{
  	$response['success'] = false;
    $response['msg'] = 'Data gagal disimpan';
  }

}else{
  $response['success'] = false;
  $response['msg'] = 'Gagal eksekusi Procedure di Database';
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);


header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
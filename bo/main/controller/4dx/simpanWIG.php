<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$id = $_POST['id'];
$bidang = $_POST['bidang'];
$nama_wig = $_POST['nama_wig'];
$keterangan = $_POST['keterangan'];
$nama_lag = $_POST['nama_lag'];
$satuan_lag = $_POST['satuan_lag'];
$nama_lm_1 = $_POST['nama_lm_1'];
$satuan_lm_1 = $_POST['satuan_lm_1'];
$polaritas_lm_1 = $_POST['polaritas_lm_1'];
$tipe_target_lm_1 = $_POST['tipe_target_lm_1'];
$nama_lm_2 = $_POST['nama_lm_2'];
$satuan_lm_2 = $_POST['satuan_lm_2'];
$polaritas_lm_2 = $_POST['polaritas_lm_2'];
$tipe_target_lm_2 = $_POST['tipe_target_lm_2'];
$nama_lm_3 = $_POST['nama_lm_3'];
$satuan_lm_3 = $_POST['satuan_lm_3'];
$polaritas_lm_3 = $_POST['polaritas_lm_3'];
$tipe_target_lm_3 = $_POST['tipe_target_lm_3'];
$user = 'SYSTEM';

$params = array(
    array($id, SQLSRV_PARAM_IN),
    array($bidang, SQLSRV_PARAM_IN),
    array($nama_wig, SQLSRV_PARAM_IN),
    array($keterangan, SQLSRV_PARAM_IN),
    array($nama_lag, SQLSRV_PARAM_IN),
    array($satuan_lag, SQLSRV_PARAM_IN),
    array($nama_lm_1, SQLSRV_PARAM_IN),
    array($satuan_lm_1, SQLSRV_PARAM_IN),
    array($polaritas_lm_1, SQLSRV_PARAM_IN),
    array($tipe_target_lm_1, SQLSRV_PARAM_IN),
    array($nama_lm_2, SQLSRV_PARAM_IN),
    array($satuan_lm_2, SQLSRV_PARAM_IN),
    array($polaritas_lm_2, SQLSRV_PARAM_IN),
    array($tipe_target_lm_2, SQLSRV_PARAM_IN),
    array($nama_lm_3, SQLSRV_PARAM_IN),
    array($satuan_lm_3, SQLSRV_PARAM_IN),
    array($polaritas_lm_3, SQLSRV_PARAM_IN),
    array($tipe_target_lm_3, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_WIG_SIMPAN @ID = ?, @BIDANG = ?, @NAMA_WIG = ?, @KETERANGAN = ?, @NAMA_LAG = ?, @SATUAN_LAG = ?, @NAMA_LM_1 = ?, @SATUAN_LM_1 = ?, @POLARITAS_LM_1 = ?, @TIPE_TARGET_LM_1 = ?, @NAMA_LM_2 = ?, @SATUAN_LM_2 = ?, @POLARITAS_LM_2 = ?, @TIPE_TARGET_LM_2 = ?, @NAMA_LM_3 = ?, @SATUAN_LM_3 = ?, @POLARITAS_LM_3 = ?, @TIPE_TARGET_LM_3 = ?, @USERID = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
  
  if($response['row'] = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
  	$response['success'] = true;
    $response['msg'] = 'Data berhasil disimpan';
    //$response['row'] = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
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
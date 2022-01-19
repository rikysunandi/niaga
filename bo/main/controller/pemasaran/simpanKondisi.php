<?php

require_once '../../../config/database.php';

$noagenda = $_POST['noagenda'];
$status_kelayakan = strtoupper($_POST['status_kelayakan']);
$keterangan_kelayakan = strtoupper($_POST['keterangan_kelayakan']);
$kendala_pln = strtoupper($_POST['kendala_pln']);
$kendala_plg = strtoupper($_POST['kendala_plg']);
$sudah_spb = strtoupper($_POST['sudah_spb']);
$belum_spb = strtoupper($_POST['belum_spb']);
$prosentase_pekerjaan = strtoupper($_POST['prosentase_pekerjaan']);
$tgl_estimasi_nyala = strtoupper($_POST['tgl_estimasi_nyala']);
$solusi_percepatan = strtoupper($_POST['solusi_percepatan']);
$keterangan = strtoupper($_POST['keterangan']);
$user = 'SYSTEM';

$params = array(
    array($noagenda, SQLSRV_PARAM_IN),
    array($status_kelayakan, SQLSRV_PARAM_IN),
    array($keterangan_kelayakan, SQLSRV_PARAM_IN),
    array($kendala_pln, SQLSRV_PARAM_IN),
    array($kendala_plg, SQLSRV_PARAM_IN),
    array($sudah_spb, SQLSRV_PARAM_IN),
    array($belum_spb, SQLSRV_PARAM_IN),
    array($prosentase_pekerjaan, SQLSRV_PARAM_IN),
    array($tgl_estimasi_nyala, SQLSRV_PARAM_IN),
    array($solusi_percepatan, SQLSRV_PARAM_IN),
    array($keterangan, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_DAFTUNG_KONDISI_SIMPAN @NOAGENDA_INDIVIDU = ?, @STATUS_KELAYAKAN = ?, @KETERANGAN_KELAYAKAN = ?, @KENDALA_PLN = ?, @KENDALA_PLG = ?, @SUDAH_SPB = ?, @BELUM_SPB = ?, @PROSENTASE_PEKERJAAN = ?, @TGL_ESTIMASI_NYALA = ?, @SOLUSI_PERCEPATAN = ?, @KETERANGAN = ?, @USER_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
  
  if(sqlsrv_rows_affected( $stmt ) >= 0){
  	$response['success'] = true;
    $response['msg'] = 'Data berhasil disimpan';
  }else{
  	$response['success'] = false;
    $response['msg'] = 'Data gagal disimpan';
    $response['sql'] = $sql ;

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
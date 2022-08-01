<?php

require_once '../bo/config/config.php';
require_once '../bo/config/database.php';

$data = file_get_contents("php://input");
$decode = json_decode($data,true);

$now = date("Y-m-d");
$username = $decode['data']['username'];
$suhu = $decode['data']['suhu'];
$masker = $decode['data']['masker'];
$sartang = $decode['data']['sartang'];
$tgl = $decode['data']['tgl'];
$latitude = $decode['data']['latitude'];
$longitude = $decode['data']['longitude'];
//$tgl = date("Y-m-d H:i:s", strtotime($tgl));
$blth = date("Ym", strtotime($tgl));

$unitupi = substr($area,0,2);
$unitap = $area;
$unitup = substr($username,0,5);

$params = array(
        array($unitup, SQLSRV_PARAM_IN),
        array($username, SQLSRV_PARAM_IN),
        array($tgl, SQLSRV_PARAM_IN),
        array($suhu, SQLSRV_PARAM_IN),
        array($masker, SQLSRV_PARAM_IN),
        array($sartang, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($latitude, SQLSRV_PARAM_IN),
        array($longitude, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_WS_CLOCKIN_SIMPAN @UNITUP = ?, @USERNAME = ?, @TGL_CLOCKIN = ?, @SUHU = ?, @MASKER = ?, @SARUNG_TANGAN = ?, @BLTH = ?, @LATITUDE = ?, @LONGITUDE = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
    $response['success'] = true;
    $response['msg'] = 'Data berhasil disimpan';

}else{
    $response['success'] = false;
    $response['msg'] = 'Data gagal disimpan';
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);
fastcgi_finish_request();

?>
<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';

ini_set('max_execution_time', 60);
set_time_limit(60);

$id_device = $_GET['id_device'];
$nohp = $_GET['nohp'];
$tegangan = $_GET['tegangan'];
$arus = $_GET['arus'];
$power_factor = $_GET['power_factor'];
$power = $_GET['power'];
$energi = $_GET['energi'];
$frekuensi = $_GET['frekuensi'];
$indikator = $_GET['indikator'];
$tgl_kirim_device = $_GET['tgl_kirim_device'];
$user = 'SYSTEM';

$response = array();


$params = array(
        array($id_device, SQLSRV_PARAM_IN),
        array($nohp, SQLSRV_PARAM_IN),
        array($tegangan, SQLSRV_PARAM_IN),
        array($arus, SQLSRV_PARAM_IN),
        array($power_factor, SQLSRV_PARAM_IN),
        array($power, SQLSRV_PARAM_IN),
        array($energi, SQLSRV_PARAM_IN),
        array($frekuensi, SQLSRV_PARAM_IN),
        array($indikator, SQLSRV_PARAM_IN),
        array($tgl_kirim_device, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_WS_SHUNTRIP_LOG_SIMPAN @id_device = ?, @nohp = ?, @tegangan = ?, @arus = ?, @power_factor = ?, @vpower = ?, @energi = ?, @frekuensi = ?, @indikator = ?, @tgl_kirim_device = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
    $response['success'] = true;
    $msg = '#1#Data berhasil disimpan';

}else{
    $response['success'] = false;
    $msg = '#0#Data gagal disimpan';
}


//header('Content-Type: application/json; charset=utf-8');
echo (utf8ize($msg));

//fastcgi_finish_request();

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

?>
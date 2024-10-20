<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';

ini_set('max_execution_time', 60);
set_time_limit(60);

$id_device = $_REQUEST['id_device'];
$nohp = $_REQUEST['nohp'];
$tegangan = $_REQUEST['tegangan'];
$arus = $_REQUEST['arus'];
$power_factor = $_REQUEST['power_factor'];
$power = $_REQUEST['power'];
$energi = $_REQUEST['energi'];
$frekuensi = $_REQUEST['frekuensi'];
$indikator = $_REQUEST['indikator'];
$tgl_kirim_device = $_REQUEST['tgl_kirim_device'];
$key = $_REQUEST['key'];
$user = 'SYSTEM';

$response = array();

if($key=='338ef7d4-0368-5aa0-9c0b-4aae493f7eb7' || 1==1){

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
}else{
    $response['success'] = false;
    $msg = '#0#Api key tidak valid! key yang dikirim='.$key;
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
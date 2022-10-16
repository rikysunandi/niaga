<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';

ini_set('max_execution_time', 60);
set_time_limit(60);

$nama = isset($_GET['nama'])?$_GET['nama']:'FULAN';
$umur = isset($_GET['umur'])?$_GET['umur']:30;
$user = 'SYSTEM';

$response = array();

$response['success'] = false;
$response['msg'] = 'HALLO '.$nama.'! anda berusia '.$umur.' tahun';


header('Content-Type: application/json; charset=utf-8');
echo json_encode(utf8ize($response));

fastcgi_finish_request();

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
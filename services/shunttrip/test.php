<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';

ini_set('max_execution_time', 60);
set_time_limit(60);

$id = isset($_GET['id'])?$_GET['id']:'53671*****';
$user = 'SYSTEM';

$response = array();

$response['success'] = true;
$msg = '#PADAMKAN#'.$id.'#';


//header('Content-Type: application/json; charset=utf-8');
echo (utf8ize($msg));

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
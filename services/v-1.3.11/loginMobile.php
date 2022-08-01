<?php

require_once '../bo/config/config.php';
require_once '../bo/config/database.php';

$data = file_get_contents("php://input");
$decode = json_decode($data,true);

$now = date("Y-m-d");
$username = $decode['data']['username'];
$password = $decode['data']['password'];
$versi = $decode['data']['versi'];
$imei = $decode['data']['imei'];
$latitude = $decode['data']['latitude'];
$longitude = $decode['data']['longitude'];
$jam_client = $decode['data']['jam_client'];
//$jam_client = date("Y-m-d H:i:s", strtotime($jam_client));

// $username = $_REQUEST['username'];
// $password = $_REQUEST['password'];
// $versi = $_REQUEST['versi'];
// $imei = $_REQUEST['imei'];
// $latitude = $_REQUEST['latitude'];
// $longitude = $_REQUEST['longitude'];
// $jam_client = $_REQUEST['jam_client'];
//$jam_client = date("Y-m-d h:i:s", strtotime($jam_client));

$params = array(
        array($username, SQLSRV_PARAM_IN),
        array($password, SQLSRV_PARAM_IN),
        array($versi, SQLSRV_PARAM_IN),
        array($imei, SQLSRV_PARAM_IN),
        array($latitude, SQLSRV_PARAM_IN),
        array($longitude, SQLSRV_PARAM_IN),
        array($jam_client, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_WS_LOGIN @USERNAME = ?, @PASSWORD = ?, @VERSI = ?, @IMEI = ?, @LATITUDE = ?, @LONGITUDE = ?, @JAM_CLIENT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $response = $row;
}else{
    $response['success'] = false;
    $response['msg'] = 'Eksekusi Procedure Database gagal: '.print_r( sqlsrv_errors(), true);
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);

?>
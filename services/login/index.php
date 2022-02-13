<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$device_id = $_REQUEST['device_id'];
$device_name = $_REQUEST['device_name'];
$os_version = $_REQUEST['os_version'];
$app_version = $_REQUEST['app_version'];
$jam_client = $_REQUEST['jam_client'];

$response = array();

$params = array(
        array($username, SQLSRV_PARAM_IN),
        array($password, SQLSRV_PARAM_IN),
        array($device_id, SQLSRV_PARAM_IN),
        array($device_name, SQLSRV_PARAM_IN),
        array($os_version, SQLSRV_PARAM_IN),
        array($app_version, SQLSRV_PARAM_IN),
        array($jam_client, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_WS_LOGIN_PRIANGAN @USERNAME = ?, @PASSWORD = ?, @DEVICE_ID = ?, @DEVICE_NAME = ?, @OS_VERSION = ?, @APP_VERSION = ?, @JAM_CLIENT = ?  ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
    if(!isset($row['msg'])){
      $response['user']['unitupi'] = $row['UNITUPI']; 
      $response['user']['unitap'] = $row['UNITAP']; 
      $response['user']['unitup'] = $row['UNITUP']; 
      $response['user']['username'] = $row['username']; 
      $response['user']['nama'] = $row['NAMA']; 
      $response['user']['password'] = $row['password']; 

      $response['success'] = true;
      $response['msg'] = 'Login berhasil';
    }else{
      $response['success'] = false;
      $response['user'] = null;
      $response['msg'] = $row['msg'];
    }

    sqlsrv_free_stmt($stmt);

}else{
    $response['success'] = false;
    $response['msg'] = 'Login gagal';
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);  


header('Content-Type: application/json');
echo json_encode(utf8ize($response));

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
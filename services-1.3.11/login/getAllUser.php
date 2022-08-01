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

// $params = array(
//         array($username, SQLSRV_PARAM_IN),
//         array($password, SQLSRV_PARAM_IN),
//         array($device_id, SQLSRV_PARAM_IN),
//         array($device_name, SQLSRV_PARAM_IN),
//         array($os_version, SQLSRV_PARAM_IN),
//         array($app_version, SQLSRV_PARAM_IN),
//         array($jam_client, SQLSRV_PARAM_IN),
//     );

$sql = "SELECT a.*, dbo.fn_getRBMPriangan(USERNAME) RBM FROM m_user_priangan a ORDER BY UNITUPI, UNITAP, UNITUP ";
$stmt = sqlsrv_query( $conn, $sql, $params);

if(($stmt)){
    $i = 0;
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){

      $response['users'][$i]['unitupi'] = $row['UNITUPI']; 
      $response['users'][$i]['unitap'] = $row['UNITAP']; 
      $response['users'][$i]['unitup'] = $row['UNITUP']; 
      $response['users'][$i]['username'] = $row['USERNAME']; 
      $response['users'][$i]['nama'] = $row['NAMA']; 
      $response['users'][$i]['password'] = $row['PASSWORD']; 
      $response['users'][$i]['rbm'] = $row['RBM'];
      $i++;

    }

    sqlsrv_free_stmt($stmt);

}else{
    $response['success'] = false;
    $response['msg'] = 'Login gagal ';
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
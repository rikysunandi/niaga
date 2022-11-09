<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/database.php';

$page = $_POST['page'];
$username = $_SESSION['username'];
$param = $_POST['param'];
$response = array();

$params = array(
        array($username, SQLSRV_PARAM_IN),
        array($page, SQLSRV_PARAM_IN),
        array($param, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_LOG_AKSES_SIMPAN @username = ?, @page = ?, @param = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
    $response['success'] = true;
    $response['msg'] = 'Data berhasil disimpan';

}else{
    $response['success'] = false;
    $response['msg'] = 'Data gagal disimpan';
}

// $Result = ldap_search($ldapconn, AD_DomainName, "(samaccountname=$username)", array("dn"));
// $data = ldap_get_entries($ldapconn, $Result);

// $response['data']=$data;

echo json_encode($response);
?>
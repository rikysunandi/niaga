<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$nomor_va = $_POST['nomor_va'];
$bank = $_POST['bank'];
$unitupi = $_POST['unitupi'];
$unitap = $_POST['unitap'];
$keterangan = $_POST['keterangan'];
$user = 'SYSTEM';
$response = array();

$params = array(
        array($nomor_va, SQLSRV_PARAM_IN),
        array($bank, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($keterangan, SQLSRV_PARAM_IN),
        array($user, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_VIRTUAL_ACCOUNT_SIMPAN @nomor_va = ?, @bank = ?, @unitupi = ?, @unitap = ?, @keterangan = ?, @user = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

    if(sqlsrv_rows_affected($stmt)>=0){
        $response['success'] = true;
        $response['msg'] = 'Data berhasil disimpan';
    }else{
        $response['success'] = false;
        $response['msg'] = 'Data gagal disimpan! '.sqlsrv_rows_affected($stmt);
    }

}else{
    $response['success'] = false;
    $response['msg'] = 'Gagal Eksekusi Procedure DB!';

    if (($errors = sqlsrv_errors()) != null) {
        foreach ($errors as $error) {
            $response['msg'] .= '<br/>'.$error['message'];
        }
    }
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);  

header('Content-Type: application/json');
echo json_encode($response);

?>
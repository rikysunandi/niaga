<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$id = $_GET['ID'];


$response = array();

$params = array(
        array($id, SQLSRV_PARAM_IN)
    );

$sql = "EXEC SP_KEBUTUHAN_MATERIAL_HAPUS @ID = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    $response = $row;

    //$response['success'] = true;

}else{
    $response['success'] = false;
    $response['msg'] = 'Data gagal disimpan';

    if (($errors = sqlsrv_errors()) != null) {
        foreach ($errors as $error) {
            $response['msg'] .= '<br/>'.$error['message'];
        }
    }
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);  

echo json_encode($response);
// echo '{"ID":"99", "KATEGORI": "KABEL BARU", "DAYA_BARU_FROM": "0", "DAYA_BARU_TO": "220", "MATERIAL": "SR 2X10", "JUMLAH": "20", "HARGA_SATUAN": "213123", "HARGA_TOTAL": "12312"}';

?>
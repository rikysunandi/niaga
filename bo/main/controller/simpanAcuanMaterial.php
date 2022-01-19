<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$id = $_GET['ID'];
$kategori = $_GET['KATEGORI'];
$daya_baru_from = $_GET['DAYA_BARU_FROM'];
$daya_baru_to = $_GET['DAYA_BARU_TO'];
$material = $_GET['MATERIAL'];
$jumlah = $_GET['JUMLAH'];
$harga_satuan = $_GET['HARGA_SATUAN'];
$harga_total = $_GET['HARGA_TOTAL'];

$response = array();

$params = array(
        array($id, SQLSRV_PARAM_IN),
        array($kategori, SQLSRV_PARAM_IN),
        array($daya_baru_from, SQLSRV_PARAM_IN),
        array($daya_baru_to, SQLSRV_PARAM_IN),
        array($material, SQLSRV_PARAM_IN),
        array($jumlah, SQLSRV_PARAM_IN),
        array($harga_satuan, SQLSRV_PARAM_IN),
        array($harga_total, SQLSRV_PARAM_IN),
        //array(&$return, SQLSRV_PARAM_OUT),
    );

$sql = "EXEC SP_KEBUTUHAN_MATERIAL_SIMPAN @ID = ?, @KATEGORI = ?, @DAYA_BARU_FROM = ?, @DAYA_BARU_TO = ?, @MATERIAL = ?, @JUMLAH = ?, @HARGA_SATUAN = ?, @HARGA_TOTAL = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if(!$row){
        sqlsrv_next_result($stmt);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

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
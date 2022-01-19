<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$NOAGENDA_INDIVIDU = $_GET['NOAGENDA_INDIVIDU'];
$JENIS = $_GET['JENIS'];
$ID_KEBUTUHAN = $_GET['ID_KEBUTUHAN'];
$KEBUTUHAN = $_GET['KEBUTUHAN'];
$HARGA_SATUAN = $_GET['HARGA_SATUAN'];
$VOLUME = $_GET['VOLUME'];

$response = array();

$params = array(
        array($NOAGENDA_INDIVIDU, SQLSRV_PARAM_IN),
        array($JENIS, SQLSRV_PARAM_IN),
        array($ID_KEBUTUHAN, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_KEBUTUHAN_AGENDA_HAPUS @NOAGENDA_INDIVIDU = ?, @JENIS = ?, @ID_KEBUTUHAN = ? ";
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
// echo '{"NOAGENDA_INDIVIDU":"99", "JENIS": "KABEL BARU", "KEBUTUHAN": "0", "ID_KEBUTUHAN": "220", "HARGA_SATUAN": "SR 2X10", "VOLUME": "20", "HARGA_SATUAN": "213123", "HARGA_TOTAL": "12312"}';

?>
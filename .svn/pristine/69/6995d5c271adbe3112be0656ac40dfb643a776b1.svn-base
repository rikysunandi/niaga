<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$startTime = $_POST['startTime'];
$user = 'SYSTEM';
$response = array();

$params = array(
        array($startTime, SQLSRV_PARAM_IN),
        array($user, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_DAFTUNG_CLEANSING
			@JAM_UPLOAD = ?, 
			@USER_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

    if(sqlsrv_rows_affected($stmt)>=0){
        $response['success'] = true;
        $response['msg'] = 'Data berhasil disimpan';
    }else{
        $response['success'] = false;
        $response['msg'] = 'Data gagal disimpan! '.sqlsrv_rows_affected($stmt);
        $response['noagenda'] = $data[6];
    }

}else{
    $response['success'] = false;
    $response['noagenda'] = $data[6];
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
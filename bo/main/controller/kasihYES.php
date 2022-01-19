<?php

require_once '../../config/database.php';

$response = array();

$kata='PLN';
$kataYES='';

$params = array(
        array($kata, SQLSRV_PARAM_IN),
        array(&$kataYES, SQLSRV_PARAM_OUT),
    );

$sql = "EXEC SP_KASIH_YES @kata = ?, @kataYES = ?  ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

    echo 'OUTPUT: '.$kataYES;
    // OUTPUT: PLN YES

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

?>
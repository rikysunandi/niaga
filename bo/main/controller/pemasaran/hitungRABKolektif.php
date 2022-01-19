<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$startTime = $_REQUEST['startTime'];
$user = 'SYSTEM';
$response = array();

$ROWS_AFFECTED = 0;

$params = array(
        array($startTime, SQLSRV_PARAM_IN),
        array($user, SQLSRV_PARAM_IN),
        array(&$ROWS_AFFECTED, SQLSRV_PARAM_OUT),
    );

$sql = "EXEC SP_HITUNG_RAB_KOLEKTIF
			@JAM_UPLOAD = ?, 
			@USER = ?,
            @ROWS_AFFECTED = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

    if($ROWS_AFFECTED >= 0){
        $response['success'] = true;
        $response['jml_agenda_kolektif'] = $ROWS_AFFECTED;
        $response['msg'] = $ROWS_AFFECTED.' Agenda Kolektif berhasil disimpan';
    }else{
        $response['success'] = false;
        $response['msg'] = 'Data gagal disimpan! '.$ROWS_AFFECTED;
        // echo print_r(sqlsrv_errors()); die();
        $response['noagenda'] = $data[6];
        if( ($errors = sqlsrv_errors() ) != null)  
          {  
             foreach( $errors as $error)  
             {  
                $response['SQLSTATE'] = $error[ 'SQLSTATE'];
                $response['code'] = $error[ 'code'];
                $response['message'] = $error[ 'message'];
             }  
          }  
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
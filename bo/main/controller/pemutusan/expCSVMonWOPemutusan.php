<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$petugas = $_REQUEST['petugas'];
$status = $_REQUEST['status'];
$rbm = '00';
$user = rand(0,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($rbm, SQLSRV_PARAM_IN),
        array($status, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Mon_WO_Pemutusan @UserID = ?, @BLTH = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @KODEPETUGAS = ?, @RBM = ?, @Status = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITAP, UNITUP, IDPEL, NAMA, TARIF, DAYA, RPTAG, RPBK, STATUS, KODEPETUGAS, RBM, LANGKAH, GARDU, TIANG, CONVERT(VARCHAR,TGL_PEMUTUSAN,120), KET from vw_Create_Mon_WO_Pemutusan_".$user." Order by  KODEPETUGAS, RBM, LANGKAH ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="DATA_WO_PEMUTUSAN_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("UNITAP", "UNITUP", "IDPEL", "NAMA", "TARIF", "DAYA", "RPTAG", "RPBK", "STATUS", "KODEPETUGAS", "RBM", "LANGKAH", "GARDU", "TIANG", "TGL PUTUS", "KET");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


<?php

session_start();
set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$status = strtoupper($_REQUEST['status']);
$id = $_SESSION['userid']%5;
$user = $_SESSION['username'];

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($status, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Saldo_WO_Intimasi @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ?, @Status = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select BLTH, UNITUPI, UNITAP, UNITUP, IDPEL, NAMA, ALAMAT, KOGOL, TARIF, DAYA, KODEPETUGAS, RBM, LANGKAH, GARDU, TIANG, RPTAG, RPBK, STATUS, JML_TUNGGAKAN from vw_Create_Saldo_WO_Intimasi Order by JML_TUNGGAKAN DESC ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="SALDO_WO_INTIMASI_'.$status.'_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("BLTH", "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "NAMA", "ALAMAT", "KOGOL", "TARIF", "DAYA", "KODEPETUGAS", "RBM", "LANGKAH", "GARDU", "TIANG", "RPTAG", "RPBK", "STATUS", "JML_TUNGGAKAN");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


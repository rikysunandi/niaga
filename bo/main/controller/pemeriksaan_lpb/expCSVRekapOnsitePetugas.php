<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$tgl_upload_from = $_GET['tgl_upload_from'];
$tgl_upload_to = $_GET['tgl_upload_to'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($tgl_upload_from, SQLSRV_PARAM_IN),
        array($tgl_upload_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_RPP_On_Site_Petugas @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Tgl_Input_From = ?, @Tgl_Input_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITAP, UNITUP, ULP, USER_INPUT, TGL_INPUT, RPP, JML_ON_DESK, JML_ON_SITE from vw_Create_Rekap_RPP_On_Site_Petugas ORDER BY UNITAP, UNITUP, USER_INPUT, TGL_INPUT DESC ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="REKAP_ONSITE_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array(  "UNITAP", "UNITUP", "ULP", "PETUGAS", "TGL INPUT", "RPP", "JML ON DESK", "JML ON SITE");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


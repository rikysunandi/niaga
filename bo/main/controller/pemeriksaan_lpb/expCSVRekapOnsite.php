<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$user = rand (1,10);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_RPP_On_Site @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITAP, UNITUP, ULP, RPP_PETUGAS, RPP, RANGE_TGL_INPUT, JML_ON_DESK, JML_SESUAI_WO, JML_SISIPAN,  JML_PAGAR_KUNCI, JML_TIDAK_DITEMUKAN, JML_DOUBLE, JML_SISIPAN_RPP_LAIN, REAL_PETUGAS, REAL_RPP, SISA_WO from vw_Create_Rekap_RPP_On_Site_".$user." ORDER BY UNITAP, UNITUP, RPP_PETUGAS, RPP ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="REKAP_ONSITE_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array(  "UNITAP", "UNITUP", "ULP", "PETUGAS", "RPP", "WAKTU PEKERJAAN", "JML ON DESK", "SESUAI WO", "SISIPAN", "PAGAR KUNCI", "TIDAK DITEMUKAN", "DOUBLE", "SISIPAN RPP LAIN", "REALISASI PETUGAS", "REALISASI RPP", "SISA WO");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


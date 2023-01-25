<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$status = $_REQUEST['status'];
$status_migrasi = $_REQUEST['status_migrasi'];
$rbm = '00';
$user = rand(0,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($status, SQLSRV_PARAM_IN),
        array($status_migrasi, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_WO_Migrasi @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Status = ?, @Status_Migrasi = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITAP, UNITUP, IDPEL, NAMA, KOGOL, TARIF, DAYA, KDDK, KODEPETUGAS, MENUNGGAK_3BLN_BERTURUT2, MENUNGGAK_6BLN_BERTURUT2, MENUNGGAK_9BLN_BERTURUT2, MENUNGGAK_12BLN_BERTURUT2, JML_MENUNGGAK, BLTH_MENUNGGAK, TGLBAYAR_RATA2, NOAGENDA from vw_Create_WO_Migrasi_".$user." Order by MENUNGGAK_12BLN_BERTURUT2 DESC, MENUNGGAK_9BLN_BERTURUT2 DESC, MENUNGGAK_6BLN_BERTURUT2 DESC, MENUNGGAK_3BLN_BERTURUT2 DESC, TGLBAYAR_RATA2 DESC, UNITUP, KDDK ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="DATA_WO_MIGRASI_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("UNITAP", "UNITUP", "IDPEL", "NAMA", "KOGOL", "TARIF", "DAYA", "KDDK", "PETUGAS", "MENUNGGAK_3BLN_BERTURUT2", "MENUNGGAK_6BLN_BERTURUT2", "MENUNGGAK_9BLN_BERTURUT2", "MENUNGGAK_12BLN_BERTURUT2", "JML_MENUNGGAK", "BLTH_MENUNGGAK", "TGLBAYAR_RATA2", "NOAGENDA");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


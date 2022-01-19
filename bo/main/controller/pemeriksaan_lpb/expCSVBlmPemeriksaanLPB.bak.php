<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$koordinat = $_GET['koordinat'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($koordinat, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Blm_Pemeriksaan_LPB_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Koordinat = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITUPI, UNITAP, UNITUP, IDPEL, NAMA, TARIF, DAYA, KOGOL, RBM, KOORDINAT_X, KOORDINAT_Y, NOMOR_METER_KWH from vw_Exp_CSV_Blm_Pemeriksaan_LPB_Unit ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="DIL_PRIANGAN_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("UNITUPI","UNITAP","UNITUP","IDPEL","NAMA","TARIF","DAYA","KOGOL","RBM","KOORDINAT_X","KOORDINAT_Y","NOMOR_METER_KWH");
        fputcsv($fp, $columns);
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }


}


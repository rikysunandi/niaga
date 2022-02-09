<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$koordinat = $_GET['koordinat'];
$tagging = $_GET['tagging'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($koordinat, SQLSRV_PARAM_IN),
        array($tagging, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Blm_Pemeriksaan_LPB_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Koordinat = ?, @Tagging = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITUPI,UNITAP,UNITUP,IDPEL,NAMA,TARIF,DAYA,KOGOL, RBM, KOORDINAT_X, KOORDINAT_Y,NOMOR_METER_KWH, TELEPON, ALAMAT, THBLMUT, JENIS_MK, NAMA_GARDU,'' JENIS,'' INFO,'' KETERANGAN,'' STRING_1,'' STRING_2,'' STRING_3 from vw_Exp_CSV_Blm_Pemeriksaan_LPB_Unit ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="DIL_PRIANGAN_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("UNITUPI","UNITAP","UNITUP","IDPEL","NAMA","TARIF","DAYA","KOGOL","KDDK","LATITUDE","LONGITUDE","NOMOR_METER_KWH","TELEPON","ALAMAT","BLTH_MUTASI","JENIS_MUTASI","GARDU","JENIS","INFO","KETERANGAN","STRING_1","STRING_2","STRING_3");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


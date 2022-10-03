<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$rpp = $_GET['rpp'];
$status = $_GET['status'];
$user = rand(1,10);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($rpp, SQLSRV_PARAM_IN),
        array($status, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Detail_RPP_Onsite @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Kodepetugas = ?, @RPP = ?, @STATUS = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITUPI, UNITAP, UNITUP, IDPEL, NAMA, TARIF, DAYA, NIK, CONVERT(VARCHAR, TGL_PEMERIKSAAN, 120), PETUGAS_ONDESK, KDDK_ONDESK, RPP_ONSITE, STATUS_ONSITE, KODEBACA, SISA_KWH, CONVERT(VARCHAR, TGL_INPUT, 120), LATITUDE, LONGITUDE, AKURASI_KOORDINAT, ADA_FOTO_METER, ADA_FOTO_RUMAH, USER_INPUT from vw_Create_Detail_RPP_Onsite_".$user." ORDER BY TGL_INPUT ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="RPP_ONSITE_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array( "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "NAMA", "TARIF", "DAYA", "NIK", "TGL_PEMERIKSAAN", "PETUGAS_ONDESK", "KDDK_ONDESK", "RPP_ONSITE", "STATUS_ONSITE", "KONDISI METER", "SISA_KWH", "JAM INPUT", "LATITUDE", "LONGITUDE", "AKURASI_KOORDINAT", "FOTO METER", "FOTO RUMAH", "USER_INPUT");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


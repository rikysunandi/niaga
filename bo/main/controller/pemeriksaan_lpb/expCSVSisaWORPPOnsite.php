<?php
session_start();
set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$rpp = $_GET['rpp'];
$user = rand(1,10);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($rpp, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Sisa_WO_RPP_Onsite @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Kodepetugas = ?, @RPP = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITUPI, UNITAP, UNITUP, IDPEL, NOMOR_METER_KWH, NAMA, TARIF, DAYA, RPP_PETUGAS, RPP_KDDK, LATITUDE, LONGITUDE, NAMA_GARDU, NOMOR_JURUSAN_TIANG from vw_Create_Sisa_WO_RPP_Onsite_".$user." ORDER BY RPP_PETUGAS, RPP_KDDK ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="SISA_WO_RPP_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array( "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "NOMOR METER", "NAMA", "TARIF", "DAYA", "RPP_PETUGAS", "RPP_KDDK", "LATITUDE", "LONGITUDE", "GARDU", "NO JURUSAN TIANG");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


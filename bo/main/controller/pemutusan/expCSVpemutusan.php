<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$petugas = $_REQUEST['petugas'];
$blth = $_REQUEST['blth'];
$tgl_pemutusan_from = $_REQUEST['tgl_pemutusan_from'];
$tgl_pemutusan_to = $_REQUEST['tgl_pemutusan_to'];
$user = rand (1,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($tgl_pemutusan_from, SQLSRV_PARAM_IN),
        array($tgl_pemutusan_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Data_Pemutusan @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @KODEPETUGAS = ?, @BLTH = ?, @Tgl_Pemutusan_From = ?, @Tgl_Pemutusan_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);


//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select BLTH, UNITUPI, UNITAP, UNITUP, IDPEL, CONVERT(VARCHAR, TGL_PUTUS, 120), KET, NOHP, LATITUDE, LONGITUDE, USER_APP from vw_Create_Data_Pemutusan_".$user." Order by TGL_PUTUS DESC ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="PEMUTUSAN_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("BLTH", "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "TGL_EKSEKUSI", "KET", "NOHP", "LATITUDE", "LONGITUDE", "USER");
        fputcsv($fp, $columns);
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }


}


<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$petugas = $_REQUEST['petugas'];
$keterangan = $_REQUEST['keterangan'];
$blth = $_REQUEST['blth'];
$tgl_intimasi_from = $_REQUEST['tgl_intimasi_from'];
$tgl_intimasi_to = $_REQUEST['tgl_intimasi_to'];
$user = rand (1,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($keterangan, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($tgl_intimasi_from, SQLSRV_PARAM_IN),
        array($tgl_intimasi_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Data_Intimasi @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @KODEPETUGAS = ?, @KETERANGAN = ?, @BLTH = ?, @Tgl_Intimasi_From = ?, @Tgl_Intimasi_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);


//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select BLTH, UNITUPI, UNITAP, UNITUP, IDPEL, PIC, STATUS_LALU, CONVERT(VARCHAR, TGL_INTIMASI, 120), KET, CONVERT(VARCHAR, TGL_JANJI, 120), NOHP, EMAIL, PAHAM, PUTUS, LATITUDE, LONGITUDE, USER_APP from vw_Create_Data_Intimasi_".$user." Order by TGL_INTIMASI DESC ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="DETAIL_INTIMASI_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("BLTH", "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "PIC", "STATUS", "TGL_INTIMASI", "KET", "TGL_JANJI", "NOHP", "EMAIL", "PAHAM", "PUTUS", "LATITUDE", "LONGITUDE", "USER");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}


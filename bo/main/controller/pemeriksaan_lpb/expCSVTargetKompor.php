<?php

set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Target_Kompor @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITUPI, UNITAP, UNITUP, IDPEL, NAMA, KOGOL, TARIF, DAYA, GARDU, NOMOR_JURUSAN_TIANG, NAMA_KECAMATAN, NAMA_KELURAHAN, KDDK, JENIS_SUBSIDI, LATITUDE, LONGITUDE from vw_Create_Target_Kompor_".$unitup;
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="TARGET_KOMPOR_'.$petugas.'_'.$rpp.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array( "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "NAMA", "KOGOL", "TARIF", "DAYA", "GARDU", "TIANG", "KECAMATAN", "DESA", "KDDK", "SUBSIDI", "LATITUDE", "LONGITUDE");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


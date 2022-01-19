<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$jenis_plg = $_GET['jenis_plg'];
$kategori = $_GET['kategori'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($jenis_plg, SQLSRV_PARAM_IN),
        array($kategori, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_TS_P2TL_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Jenis_Plg = ?, @Kategori = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITUPI, UNITAP, UNITUP, NOAGENDA, IDPEL, NAMA, TARIF_DIL, DAYA_DIL, KATEGORI, BL_ANG_AW, BL_ANG_AK, RPTS, BA_SESUAI, TS_SESUAI, SPH_SESUAI, CEKLOK_SESUAI, NAMA_GARDU, NOMOR_GARDU, NOMOR_TIANG, KOORDINAT_X, KOORDINAT_Y, AKURASI_KOORDINAT, SUMBER_KOORDINAT from vw_Create_TS_P2TL_Unit ORDER BY RPTS DESC ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="TS_P2TL_ANOMALI_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("UNITUPI","UNITAP","UNITUP","NOAGENDA","IDPEL","NAMA","TARIF","DAYA","KATEGORI","BL_ANG_AW","BL_ANG_AK","RPTS","BA_SESUAI","TS_SESUAI","SPH_SESUAI","CEKLOK_SESUAI","NAMA_GARDU","NOMOR_GARDU","NOMOR_TIANG","KOORDINAT_X","KOORDINAT_Y","AKURASI_KOORDINAT","SUMBER_KOORDINAT");
        fputcsv($fp, $columns);
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }


}


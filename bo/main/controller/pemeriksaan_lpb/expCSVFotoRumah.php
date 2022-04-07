<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$foto_rumah = $_GET['foto_rumah'];
$tgl_pemeriksaan_from = $_GET['tgl_pemeriksaan_from'];
$tgl_pemeriksaan_to = $_GET['tgl_pemeriksaan_to'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($foto_rumah, SQLSRV_PARAM_IN),
        array($tgl_pemeriksaan_from, SQLSRV_PARAM_IN),
        array($tgl_pemeriksaan_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Foto_Rumah_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @User_Input = ?, @Ada_Foto_Rumah = ?, @Tgl_Pemeriksaan_From = ?, @Tgl_Pemeriksaan_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select UNITUPI, UNITAP, UNITUP, IDPEL, NAMA, TARIF, DAYA, NOMOR_METER_KWH, CONVERT(VARCHAR, TGL_PEMERIKSAAN, 120), NIK, EMAIL, SISA_KWH, LATITUDE, LONGITUDE, AKURASI_KOORDINAT, ADA_FOTO_METER, ADA_FOTO_RUMAH, USER_INPUT from vw_Create_Foto_Rumah_Unit_".$unitup;
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="SURVEY_FOTO_RUMAH_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array( "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "NAMA", "TARIF", "DAYA", "NOMETER", "TGL_PEMERIKSAAN", "NIK", "KONDISI METER", "SISA_KWH", "LATITUDE", "LONGITUDE", "AKURASI_KOORDINAT", "FOTO METER", "FOTO RUMAH", "USER_INPUT");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$tgl_pemeriksaan_from = $_GET['tgl_pemeriksaan_from'];
$tgl_pemeriksaan_to = $_GET['tgl_pemeriksaan_to'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($tgl_pemeriksaan_from, SQLSRV_PARAM_IN),
        array($tgl_pemeriksaan_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Pemeriksaan_LPB_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @User_Input=?, @Tgl_Pemeriksaan_From = ?, @Tgl_Pemeriksaan_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select NO, UNITUPI, UNITAP, UNITUP, IDPEL, NAMA, TARIF, DAYA, NIK, CONVERT(VARCHAR, TGL_PEMERIKSAAN, 120), PERUNTUKAN, EMAIL, SISA_KWH,  CONVERT(VARCHAR, TGL_INPUT, 120), LATITUDE, LONGITUDE, AKURASI_KOORDINAT, ADA_FOTO_METER, ADA_FOTO_RUMAH, USER_INPUT from vw_Create_Pemeriksaan_LPB_Unit_".$unitup." ORDER BY TGL_INPUT ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="PEMERIKSAAN_LPB_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array( "NO", "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "NAMA", "TARIF", "DAYA", "NIK", "TGL_PEMERIKSAAN", "RPP_DIPILIH", "KONDISI METER", "SISA_KWH", "JAM INPUT", "LATITUDE", "LONGITUDE", "AKURASI_KOORDINAT", "FOTO METER", "FOTO RUMAH", "USER_INPUT");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


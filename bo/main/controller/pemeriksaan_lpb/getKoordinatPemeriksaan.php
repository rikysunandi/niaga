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

$sql = "EXEC sp_vw_Create_Pemeriksaan_LPB_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @User_Input = ?, @Tgl_Pemeriksaan_From = ?, @Tgl_Pemeriksaan_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select unitup, idpel, convert(varchar(10), tgl_pemeriksaan, 120) tgl_pemeriksaan, latitude, longitude, user_input, nomor_meter_kwh, fotopath from vw_Create_Pemeriksaan_LPB_Unit_".$unitup." Where LEN(Latitude)>4 AND LEN(Longitude)>4 Order By Tgl_Input ";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{

        $i = 0;
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $response['rows'][$i] = $row;
            $i++;
        }

        $response['success'] = true;
        sqlsrv_free_stmt($stmt);

    }


}

echo json_encode($response);

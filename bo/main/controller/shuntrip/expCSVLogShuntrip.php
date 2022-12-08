<?php

session_start();
set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

// $unitupi = $_REQUEST['unitupi'];
// $unitap = $_REQUEST['unitap'];
// $unitup = $_REQUEST['unitup'];
// $rbm = $_REQUEST['rbm'];
// $blth = $_REQUEST['blth'];
// $status_lalu = $_REQUEST['status_lalu'];
// $pic = $_REQUEST['pic'];
// $status_bayar = $_REQUEST['status_bayar'];
// $user = $_SESSION['username'];
// $id = $_SESSION['userid']%5;

// $params = array(
//         array($user, SQLSRV_PARAM_IN),
//         array($unitupi, SQLSRV_PARAM_IN),
//         array($unitap, SQLSRV_PARAM_IN),
//         array($unitup, SQLSRV_PARAM_IN),
//         array($rbm, SQLSRV_PARAM_IN),
//         array($blth, SQLSRV_PARAM_IN),
//         array($status_lalu, SQLSRV_PARAM_IN),
//         array($pic, SQLSRV_PARAM_IN),
//         array($status_bayar, SQLSRV_PARAM_IN),
//     );

// $sql = "EXEC sp_vw_Create_DPP @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @RBM = ?, @BLTH = ?, @Status_Lalu = ?, @PIC = ?, @Status_Bayar = ? ";
// $stmt = sqlsrv_prepare($conn, $sql, $params);

// //sqlsrv_execute($stmt);
// if(!sqlsrv_execute($stmt)){
//     die(print_r( sqlsrv_errors(), true));
// }else{

    $sql = "select id_device, nohp, convert(varchar,tegangan), convert(varchar,arus), convert(varchar,power_factor), convert(varchar,vpower), convert(varchar,energi), convert(varchar,frekuensi), indikator, convert(varchar,tgl_kirim_device,120), convert(varchar,tgl_log,120), convert(varchar,tgl_insert,120) from t_shuntrip_log Order by tgl_kirim_device DESC";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="LOG_SHUNTRIP_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("id_device", "nohp", "tegangan", "arus", "power_factor", "vpower", "energi", "frekuensi", "indikator", "tgl_kirim_device", "tgl_log",  "tgl_insert");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


// }

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


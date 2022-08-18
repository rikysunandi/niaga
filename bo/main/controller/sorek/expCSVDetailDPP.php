<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$rbm = $_REQUEST['rbm'];
$blth = $_REQUEST['blth'];
$status_lalu = $_REQUEST['status_lalu'];
$pic = $_REQUEST['pic'];
$status_bayar = $_REQUEST['status_bayar'];
$user = rand (1,10);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($rbm, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($status_lalu, SQLSRV_PARAM_IN),
        array($pic, SQLSRV_PARAM_IN),
        array($status_bayar, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_DPP @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @RBM = ?, @BLTH = ?, @Status_Lalu = ?, @PIC = ?, @Status_Bayar = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select BLTH, UNITUPI, UNITAP, UNITUP, IDPEL, NAMA, KOGOL, TARIF, DAYA, PIC, KODEPETUGAS, RBM, STATUS_LALU, PEMKWH, RPPTL, TGLBAYAR, UMUR_PIUTANG, PERCEPATAN, JML_TUNGGAKAN, STATUS_BAYAR, KDPP, KDPEMBAYAR, KODESTATUS, CONVERT(VARCHAR,TGL_INPUT,112), CONVERT(VARCHAR,TGL_UPDATE,112) from vw_Create_DPP_".$user." Order by IDPEL ASC";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="DPP_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("BLTH", "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "NAMA", "KOGOL", "TARIF", "DAYA", "PIC",  "KODEPETUGAS", "RBM", "STATUS_LALU", "PEMKWH", "RPPTL", "TGLBAYAR", "UMUR_PIUTANG", "PERCEPATAN", "JML_TUNGGAKAN", "STATUS BLN INI", "KDPP", "KDPEMBAYAR", "KODESTATUS","TGL UPLOAD SOREK", "TGL UPDATE");
        fputcsv($fp, $columns, chr(9));
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row, chr(9));
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$rbm = $_REQUEST['rbm'];
$blth = $_REQUEST['blth'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($rbm, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Detail_DPP @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @RBM = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select BLTH, UNITUPI, UNITAP, UNITUP, IDPEL, NAMA, KOGOL, TARIF, DAYA, PIC, KODEPETUGAS, RBM, PEMKWH, RPPTL, TGLBAYAR, UMUR_PIUTANG, PERCEPATAN, JML_TUNGGAKAN, STATUS_BAYAR, KDPP, KDPEMBAYAR, KODESTATUS from vw_Create_Detail_DPP Order by IDPEL ASC";
    $stmt = sqlsrv_prepare($conn, $sql);

    if(!sqlsrv_execute($stmt)){
        die(print_r( sqlsrv_errors(), true));
    }else{
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="DPP_'.$unitap.'_'.$unitup.'_'.date('Ymdhis').'.csv"');

        $fp = fopen('php://output', 'wb');
        $columns = array("BLTH", "UNITUPI", "UNITAP", "UNITUP", "IDPEL", "NAMA", "KOGOL", "TARIF", "DAYA", "PIC",  "KODEPETUGAS", "RBM", "PEMKWH", "RPPTL", "TGLBAYAR", "UMUR_PIUTANG", "PERCEPATAN", "JML_TUNGGAKAN", "STATUS", "KDPP", "KDPEMBAYAR", "KODESTATUS");
        fputcsv($fp, $columns);
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }


}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


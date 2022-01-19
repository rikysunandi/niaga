<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$koordinat = $_GET['koordinat'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($koordinat, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Blm_Pemeriksaan_LPB_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Koordinat = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}else{

    $sql = "select unitup, idpel, nama, tarif+' / '+convert(varchar, daya)+' VA' as tarif_daya, koordinat_x, koordinat_y from vw_Create_Blm_Pemeriksaan_LPB_Unit Where LEFT(KOORDINAT_X,3) IN ('-5.', '-6.', '-7.') AND LEFT(KOORDINAT_Y,4) IN ('105.', '106.', '107.') ";
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
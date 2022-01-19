<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$user = 'SYSTEM';

$stmt = sqlsrv_query($conn, "select * from vw_dil_gardu_tiang_koordinat where UNITUP='$unitup' order by NAMA_GARDU, NOMOR_JURUSAN_TIANG ");

if($stmt){
    $i=0;
    $last_gardu='';
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $response['rows'][$i]['nama_gardu'] = $row['NAMA_GARDU']; 
        $response['rows'][$i]['nomor_jurusan_tiang'] = trim($row['NOMOR_JURUSAN_TIANG']); 
        $response['rows'][$i]['jml_plg'] = ($row['JML_PLG']); 
        $response['rows'][$i]['jml_koordinat'] = ($row['JML_KOORDINAT']); 

        $i++;
    }

    $response['success'] = true;
    sqlsrv_free_stmt($stmt);


}else{
    $response['success'] = false;
    $response['msg'] = 'Gagal melakukan Query ke Database';
}


header('Content-Type: application/json');
echo json_encode($response);
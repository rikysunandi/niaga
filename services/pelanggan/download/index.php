<?php

require_once '../../../bo/config/config.php';
require_once '../../../bo/config/database.php';

ini_set('memory_limit', '-1');

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

$sql = "EXEC sp_WS_Get_DIL_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(sqlsrv_execute($stmt)){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['pelanggan'][$i]['unitupi'] = $row['UNITUPI']; 
		$response['pelanggan'][$i]['unitap'] = $row['UNITAP']; 
		$response['pelanggan'][$i]['unitup'] = $row['UNITUP']; 
		$response['pelanggan'][$i]['idpel'] = $row['IDPEL']; 
		$response['pelanggan'][$i]['nama'] = $row['NAMA']; 
		$response['pelanggan'][$i]['tarif'] = $row['TARIF']; 
		$response['pelanggan'][$i]['daya'] = $row['DAYA'];
		$response['pelanggan'][$i]['gardu'] = $row['NAMA_GARDU'];
		$response['pelanggan'][$i]['string_1'] = $row['NOMOR_JURUSAN_TIANG'];
		$response['pelanggan'][$i]['kddk'] = $row['KDDK'];
		$response['pelanggan'][$i]['nomorMeterKwh'] = $row['NOMOR_METER_KWH'];
		$response['pelanggan'][$i]['notelp'] = $row['NOTELP'];
		$response['pelanggan'][$i]['latitude'] = $row['LATITUDE'];
		$response['pelanggan'][$i]['longitude'] = $row['LONGITUDE'];

		$i++;
	}

	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode(utf8ize($response));

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

?>
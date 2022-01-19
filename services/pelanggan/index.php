<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
		$response['pelanggan'][$i]['kddk'] = $row['NOMOR_METER_KWH'];

		$i++;
	}

	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}

header('Content-Type: application/json');
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
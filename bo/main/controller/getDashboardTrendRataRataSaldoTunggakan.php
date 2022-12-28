<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/database.php';

$unitap = $_GET['unitap'];
//$kogol = $_GET['kogol'];
$blth = $_GET['blth'];
$id = $_SESSION['userid']%5;
$user = $_SESSION['username'];

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        // array($kogol, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_Dashboard_Trend_Rata_Rata_Saldo_Tunggakan @UserID = ?, @Unitap = ?, @Blth = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

$response = array();

// $stmt = sqlsrv_query($conn, "select * from vw_Create_Percepatan_Unit order by PERCEPATAN DESC");
if($stmt){
	if($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
		$target = $row['TARGET'];
	else
		$target = 0;

	sqlsrv_next_result($stmt);

	$i=0;
	$rata2_saldo_tunggakan=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['blth'][$i] = $bulan[intval(substr($row['MonthNumber'],-2))]; 

		if($row['MonthNumber'] <= substr($blth,-2) && date('Ym')>substr($blth,0,4).$row['MonthNumber'] ){
			$response['target'][$i]=intval($target);
			$response['pal_tagsus'][$i]=($row['PAL_TAGSUS']<>'')? intval($row['PAL_TAGSUS']):0;
			$saldo_tunggakan += ($row['PAL_TAGSUS']<>'')? intval($row['PAL_TAGSUS']):0;
			$response['rata2_saldo_tunggakan'][$i] = round($saldo_tunggakan/intval(substr($row['MonthNumber'],-2)));
			$response['realisasi'][$i]=($row['REALISASI']<>'')? floatval($row['REALISASI']):floatval((2-($response['rata2_saldo_tunggakan'][$i]/$target))*100);
		}else{
			$response['target'][$i]=null;
			$response['pal_tagsus'][$i]=null;
			$response['rata2_saldo_tunggakan'][$i]=null;
			$response['realisasi'][$i]=null;
		}

		$i++;
	}

	// $response['blth'] = $blth;
	// $response['blth_n1'] = date("Ym", strtotime("-1 month", strtotime($blth.'01')));
	$response['success'] = true;
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


echo json_encode($response);

?>
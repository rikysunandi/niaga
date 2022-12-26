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
	$i=0;
	$jml_plg=0;
	$jml_plg_n1=0;
	$rpptl=0;
	$rpptl_n1=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['blth'][$i] = $bulan[intval(substr($row['MonthNumber'],-2))]; 

		if($row['MonthNumber'] <= substr($blth,-2) && date('Ym')>substr($blth,0,4).$row['MonthNumber'] ){
			$response['pal_tagsus'][$i]=($row['PAL_TAGSUS']<>'')? $row['PAL_TAGSUS']:0;
			$response['rata2_saldo_tunggakan'][$i]=($row['RATA2_SALDO_TUNGGAKAN']<>'')? $row['RATA2_SALDO_TUNGGAKAN']:0;
		}else{
			$response['pal_tagsus'][$i]=null;
			$response['rata2_saldo_tunggakan'][$i]=null;
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
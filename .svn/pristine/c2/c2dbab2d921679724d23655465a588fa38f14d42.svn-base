<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$unitap = $_GET['unitap'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Trend_Percepatan_PIC @UserID = ?, @Unitap = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

$response = array();

// $stmt = sqlsrv_query($conn, "select * from vw_Create_Percepatan_Unit order by PERCEPATAN DESC");
if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['blth'][$i] = $row['BLTH_NM']; 
		$response['mup3'][$i] = number_format($row['PERCEPATAN_MUP3'], 2, '.', ','); 
		$response['mbsar'][$i] = number_format($row['PERCEPATAN_MBSAR'], 2, '.', ','); 
		$response['mulp'][$i] = number_format($row['PERCEPATAN_MULP'], 2, '.', ','); 
		$response['biller'][$i] = number_format($row['PERCEPATAN_BILLER'], 2, '.', ','); 

		$i++;
	}

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
<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$unitap = $_GET['unitap'];
$blth = $_GET['blth'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_RBM_Irisan_Terbanyak @UserID = ?, @Unitap = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

$response = array();

if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['rows'][$i]['unitupi'] = $row['UNITUPI']; 
		$response['rows'][$i]['unitap'] = $row['UNITAP']; 
		$response['rows'][$i]['unitup'] = $row['UNITUP']; 
		$response['rows'][$i]['ulp'] = $row['ULP']; 
		$response['rows'][$i]['petugas'] = $row['PETUGAS']; 
		$response['rows'][$i]['blth'] = $row['BLTH'];
		$response['rows'][$i]['rbm'] = $row['RBM'];
		$response['rows'][$i]['jml_lancar'] = number_format($row['JML_LANCAR']); 
		$response['rows'][$i]['jml_baru'] = number_format($row['JML_BARU']); 
		$response['rows'][$i]['jml_irisan'] = number_format($row['JML_IRISAN']); 

		$i++;
	}

	$response['blth'] = $blth;
	if($i>0)
		$response['success'] = true;
	else
		$response['success'] = false;
	
	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);

?>
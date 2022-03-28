<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$unitap = $_GET['unitap'];
$blth = $_GET['blth'];
$kogol = $_GET['kogol'];
$pic = $_GET['pic'];
$rata = $_GET['rata'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($kogol, SQLSRV_PARAM_IN),
        array($pic, SQLSRV_PARAM_IN),
        array($rata, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Percepatan_Irisan_Unit @UserID = ?, @Unitap = ?, @BLTH = ?, @KOGOL = ?, @PIC = ?, @RATA = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

$response = array();

if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['percepatan'][$i] = number_format($row['PERCEPATAN'], 2, '.', ','); 

		$i++;
	}

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
<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$unitap = $_GET['unitap'];
$blth = $_GET['blth'];
$pic = $_GET['pic'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Pola_Bayar_Unit @UserID = ?, @Unitap = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

$response = array();

// $stmt = sqlsrv_query($conn, "select * from vw_Create_Percepatan_Unit order by PERCEPATAN DESC");
if($stmt){
	$i=0;
	$response['total_plg']=0;
	$response['total_lancar']=0;
	$response['total_baru']=0;
	$response['total_irisan']=0;
	$response['total_blm_upload']=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$response['unit'][$i] = $row['UNIT']; 
		$response['singkatan'][$i] = $row['SINGKATAN']; 
		$response['jml_plg'][$i] = intval($row['JML_PLG']); 
		$response['jml_lancar'][$i] = intval($row['JML_LANCAR']); 
		$response['jml_baru'][$i] = intval($row['JML_BARU']); 
		$response['jml_irisan'][$i] = intval($row['JML_IRISAN']); 
		$response['jml_blm_upload'][$i] = intval($row['JML_BLM_UPLOAD']); 
		$response['total_plg']+= intval($row['JML_PLG']); 
		$response['total_lancar']+= intval($row['JML_LANCAR']); 
		$response['total_baru']+= intval($row['JML_BARU']); 
		$response['total_irisan']+= intval($row['JML_IRISAN']); 
		$response['total_blm_upload']+= intval($row['JML_BLM_UPLOAD']); 

		$i++;
	}

	$response['blth'] = $blth;
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
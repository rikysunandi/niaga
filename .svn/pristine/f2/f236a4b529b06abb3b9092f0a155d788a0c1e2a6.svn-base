<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$unitap = $_GET['unitap'];
$kogol = $_GET['kogol'];
$blth = $_GET['blth'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($kogol, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_MOM_Tgl_Bayar @UserID = ?, @Unitap = ?, @Kogol = ?, @Blth = ? ";
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
		$response['tanggal'][$i] = str_replace('99', 'N+', $row['TANGGAL']); 
		$response['jml_plg'][$i] = ($row['JML_PLG']<>'')? number_format($row['JML_PLG']/10000, 2, '.', ','):null; 
		$response['jml_plg_n1'][$i] = ($row['JML_PLG_N1'])? number_format($row['JML_PLG_N1']/10000, 2, '.', ','):null; 


		$i++;
	}

	$response['blth'] = $blth;
	$response['blth_n1'] = date("Ym", strtotime("-1 month", strtotime($blth.'01')));
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
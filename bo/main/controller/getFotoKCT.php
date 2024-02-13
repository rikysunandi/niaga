<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$unitup = $_GET['unitup'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Foto_KCT @UserID = ?, @Unitup = ? ";
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
		$response['rows'][$i]['idpel'] = $row['IDPEL']; 
		$response['rows'][$i]['nomor_meter'] = $row['NOMOR_METER']; 
		$response['rows'][$i]['merk_meter'] = $row['MERK_METER']; 
		$response['rows'][$i]['petugasbaca'] = $row['PETUGASBACA']; 
		$response['rows'][$i]['tglstatus'] = $row['TGLSTATUS']; 
		$response['rows'][$i]['fotourl'] = $row['FOTOURL']; 
		$response['rows'][$i]['st_foto'] = ($row['ST_FOTO']=='')?'Foto Jelas':$row['ST_FOTO']; 
		$response['rows'][$i]['rotation'] = 0; 
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
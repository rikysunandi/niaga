<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/database.php';


$response = array();
$param = $_GET['q'];
$user = $_SESSION['username'];
$id = $_SESSION['userid']%5;

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($param, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_Cari_Pelanggan @UserID = ?, @Param = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		array_push($response, array(
			'value' => $row['IDPEL'],
			'text' => $row['IDPEL'].' - '.trim($row['NAMA'])
		));
	}

	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}

header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
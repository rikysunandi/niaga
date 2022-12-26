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
        //array($kogol, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_Dashboard_Rata_Rata_Saldo_Tunggakan @UserID = ?, @Unitap = ?, @Blth = ? ";
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

		$response['rows'][$i]['blth'] = $row['BLTH'];
		$response['rows'][$i]['unitap'] = $row['UNITAP'];
		$response['rows'][$i]['nama'] = $row['NAMA'];
		$response['rows'][$i]['pal'] = $row['PAL'];
		$response['rows'][$i]['tagsus'] = $row['TAGSUS'];
		$response['rows'][$i]['pal_tagsus'] = number_format($row['PAL_TAGSUS'],0,'.',',');
		$response['rows'][$i]['rata2_saldo_tunggakan'] = number_format($row['RATA2_SALDO_TUNGGAKAN'],0,'.',',');
		$response['rows'][$i]['target'] = number_format($row['TARGET'],0,'.',',');
		$response['rows'][$i]['realisasi'] = number_format($row['REALISASI'],2,'.',',');
		$response['rows'][$i]['kali_nihil'] = number_format($row['KALI_NIHIL'],0,'.',',');
		$response['rows'][$i]['batas_saldo_bulan_depan'] = number_format($row['BATAS_SALDO_BULAN_DEPAN'],0,'.',',');
		$response['rows'][$i]['max_realisasi_bulan_depan'] = number_format($row['MAX_REALISASI_BULAN_DEPAN'],2,'.',',');
		$response['rows'][$i]['batas_saldo_bulan_sisa'] = number_format($row['BATAS_SALDO_BULAN_SISA'],0,'.',',');
		$response['rows'][$i]['max_realisasi_bulan_sisa'] = number_format($row['MAX_REALISASI_BULAN_SISA'],2,'.',',');

		$i++;
	}

	sqlsrv_next_result($stmt);
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$response['uid']['blth'] = $row['BLTH'];
	$response['uid']['unitap'] = $row['UNITAP'];
	$response['uid']['nama'] = $row['NAMA'];
	$response['uid']['pal'] = $row['PAL'];
	$response['uid']['tagsus'] = $row['TAGSUS'];
	$response['uid']['pal_tagsus'] = number_format($row['PAL_TAGSUS'],0,'.',',');
	$response['uid']['rata2_saldo_tunggakan'] = number_format($row['RATA2_SALDO_TUNGGAKAN'],0,'.',',');
	$response['uid']['target'] = number_format($row['TARGET'],0,'.',',');
	$response['uid']['realisasi'] = number_format($row['REALISASI'],2,'.',',');
	$response['uid']['kali_nihil'] = number_format($row['KALI_NIHIL'],0,'.',',');
	$response['uid']['batas_saldo_bulan_depan'] = number_format($row['BATAS_SALDO_BULAN_DEPAN'],0,'.',',');
	$response['uid']['max_realisasi_bulan_depan'] = number_format($row['MAX_REALISASI_BULAN_DEPAN'],2,'.',',');
	$response['uid']['batas_saldo_bulan_sisa'] = number_format($row['BATAS_SALDO_BULAN_SISA'],0,'.',',');
	$response['uid']['max_realisasi_bulan_sisa'] = number_format($row['MAX_REALISASI_BULAN_SISA'],2,'.',',');


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
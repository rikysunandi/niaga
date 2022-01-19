<?php

require_once '../../../config/database.php';

$idx = $_POST['idx'];
$data = $_POST['data'];
$filepath = $_POST['filepath'];
$filename = $_POST['filename'];

$idpel = $data['idpel'];
$tgl_pemeriksaan = $data['tgl_pemeriksaan'];
$nama = $data['nama'];
$tarif = $data['tarif'];
$daya = $data['daya'];
$nik = $data['nik'];
$kk = $data['kk'];
$nohp = $data['nohp'];
$email = $data['email'];
$peruntukan = $data['peruntukan'];
$sisa_kwh = $data['sisa_kwh'];
$latitude = $data['latitude'];
$longitude = $data['longitude'];
$user = $data['user'];
$tgl_insert = $data['tgl_insert'];
$input_type = 'UPLOAD_BO';

$foto = '';
if(file_exists($filepath.'/'.$idpel.'_'.$tgl_pemeriksaan.'.jpg')){
	$folder_to = '../../../assets/uploads/photos/pemeriksaan_lpb/'.$tgl_pemeriksaan;
	if(!file_exists($folder_to))
	  mkdir($folder_to);

	$copy_to = $folder_to.'/'.$idpel.'_'.$tgl_pemeriksaan.'.jpg';

	if(copy($filepath.'/'.$idpel.'_'.$tgl_pemeriksaan.'.jpg', $copy_to)){
	  
	  $foto = $tgl_pemeriksaan.'/'.$idpel.'_'.$tgl_pemeriksaan.'.jpg';
	  $response['foto']['success']=true;

	}else{
		$response['foto']['success']=false;
	}
}else{
	$response['foto']['success']=false;
}

$params = array(
    array($tgl_pemeriksaan, SQLSRV_PARAM_IN),
    array($idpel, SQLSRV_PARAM_IN),
    array($nama, SQLSRV_PARAM_IN),
    array($tarif, SQLSRV_PARAM_IN),
    array($daya, SQLSRV_PARAM_IN),
    array($nik, SQLSRV_PARAM_IN),
    array($kk, SQLSRV_PARAM_IN),
    array($nohp, SQLSRV_PARAM_IN),
    array($email, SQLSRV_PARAM_IN),
    array($peruntukan, SQLSRV_PARAM_IN),
    array($sisa_kwh, SQLSRV_PARAM_IN),
    array($foto, SQLSRV_PARAM_IN),
    array($filename, SQLSRV_PARAM_IN),
    array($input_type, SQLSRV_PARAM_IN),
    array($latitude, SQLSRV_PARAM_IN),
    array($longitude, SQLSRV_PARAM_IN),
    array($user, SQLSRV_PARAM_IN),
    array($tgl_insert, SQLSRV_PARAM_IN),
);

$sql = "EXEC SP_PEMERIKSAAN_LPB_SIMPAN @TGL_PEMERIKSAAN = ?, @IDPEL = ?,     @NAMA = ?, @TARIF = ?, @DAYA = ?, @NIK = ?, @KK = ?, @NOHP = ?, @EMAIL = ?, @PERUNTUKAN = ?, @SISA_KWH = ?, @FOTO = ?, @FILENAME = ?, @INPUT_TYPE = ?, @LATITUDE = ?, @LONGITUDE = ?, @USER_INPUT = ?, @TGL_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
  
  if(sqlsrv_rows_affected( $stmt ) > 0){
  	$response['data']['success'] = true;
  }else
  	$response['data']['success'] = false;

}else{
  $response['data']['success'] = false;
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);

$fp = file($filepath.'/data.csv', FILE_SKIP_EMPTY_LINES);
if($idx<count($fp)-1){
	$columns = str_replace("\r", "", $fp[0]);
	$columns = str_replace("\n", "", $fp[0]);
	$rec = str_replace("\r", "", $fp[$idx+1]);
	$rec = str_replace("\n", "", $fp[$idx+1]);
	$response['rec'] = (object) array_combine( explode(',', $columns), explode(',', $rec) );
	$response['idx'] = $idx+1;
	$response['next'] = true;
}else{
	$response['next'] = false;
	$response['msg'] = 'Proses selesai';
}

//if($fp)fclose($fp);


header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
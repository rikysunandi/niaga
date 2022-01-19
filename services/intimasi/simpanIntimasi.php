<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';
require_once '../../bo/config/router.php';

$data = file_get_contents("php://input");
$decode = json_decode($data,true);

$now = date("Y-m-d");
$survey = $decode['data']['survey'];

$area = $decode['data']['area'];
$idpiu = $decode['data']['idpiu'];
$idpel = $decode['data']['idpel'];
$ket = $decode['data']['ket'];
$tgljanji = $decode['data']['tgl'];
$kolektor = strtoupper($decode['data']['kolektor']);
$latitude = $decode['data']['latitude'];
$longitude = $decode['data']['longitude'];
$tgl_kunjungan = $decode['data']['tgl_kunjungan'];
$nope = $decode['data']['nope'];
$username = $decode['data']['username'];
$paham = strtoupper($decode['data']['paham']);
$putus = strtoupper($decode['data']['putus']);
$alasan = strtoupper($decode['data']['alasan']);
if(strlen($idpiu)==17)
    $idpiu = '0'.$idpiu;
$blth = substr($idpiu,0,6);
$blth = substr($blth,2,4).substr($blth,0,2);
$email = '';
// 120225

//$foto = ($foto=='')? $idpel.'-'.substr($idpiu,0,6).'.jpeg':$foto;

$unitupi = substr($area,0,2);
$unitap = $area;
$unitup = substr($username,0,5);

$akurasi = 0;

$foto = $decode['data']['foto'];
$nama_foto = $decode['data']['nama_foto'];

define("PATH_UPLOAD_PHOTOS_INTIMASI", "../bo/assets/uploads/photos/intimasi/");
$path = PATH_UPLOAD_PHOTOS_INTIMASI.$blth."/".$area."/".$nama_foto;
$dir = PATH_UPLOAD_PHOTOS_INTIMASI.$blth."/".$area."/";

if(!file_exists($path)){
    if(!file_exists($dir)){ mkdir($dir, 0777, true); }
    //$fotoGet = $foto;
    $bin =base64_decode($foto);
    $im = imageCreateFromString($bin);
    if (!$im) {
        $response['success'] = false;
        $response['msg'] = 'Gagal menyimpan Foto '.$nama_foto.' foto: '.substr($foto,0,10);
    }else{
        $img_file = $path;
        imagepng($im, $img_file, 0);
        $response['success'] = true;
        $response['msg'] = 'Berhasil menyimpan Foto';
    }
}else {
    $response['success'] = true;
    $response['msg'] = 'Foto sudah ada di Server';
}


$params = array(
        array($blth, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($idpel, SQLSRV_PARAM_IN),
        array($tgl_kunjungan, SQLSRV_PARAM_IN),
        array($ket, SQLSRV_PARAM_IN),
        array($tgljanji, SQLSRV_PARAM_IN),
        array($kolektor, SQLSRV_PARAM_IN),
        array($nope, SQLSRV_PARAM_IN),
        array($email, SQLSRV_PARAM_IN),
        array($paham, SQLSRV_PARAM_IN),
        array($putus, SQLSRV_PARAM_IN),
        array($alasan, SQLSRV_PARAM_IN),
        array($latitude, SQLSRV_PARAM_IN),
        array($longitude, SQLSRV_PARAM_IN),
        array($akurasi, SQLSRV_PARAM_IN),
        array($nama_foto, SQLSRV_PARAM_IN),
        array($username, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_WS_INTIMASI_SIMPAN @BLTH = ?, @UNITUPI = ?, @UNITAP = ?, @UNITUP = ?, @IDPEL = ?, @TGL_INTIMASI = ?, @KET = ?, @TGL_JANJI = ?, @KOLEKTOR = ?, @NOHP = ?, @EMAIL = ?, @PAHAM = ?, @PUTUS = ?, @ALASAN = ?, @LATITUDE = ?, @LONGITUDE = ?, @AKURASI = ?, @FOTO = ?, @USERID = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
    $response['success'] = true;
    $response['msg'] = 'Data berhasil disimpan';

}else{
    $response['success'] = false;
    $response['msg'] = 'Data gagal disimpan';
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);

?>
<?php

require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';

$data = file_get_contents("php://input");
$decode = json_decode($data,true);

$now = date("Y-m-d");

$area = $decode['data']['area'];
$idpiu = $decode['data']['idpiu'];
$idpel = $decode['data']['idpel'];
$ket = $decode['data']['ket'];
$tgl = $decode['data']['tgl'];
$nope = $decode['data']['nope'];
$catatan = strtoupper($decode['data']['catatan']);
//$foto = $decode['data']['nama_foto'];
$username = $decode['data']['username'];
$latitude = $decode['data']['latitude'];
$longitude = $decode['data']['longitude'];
$blth = substr($idpiu,0,6);
$blth = substr($blth,2,4).substr($blth,0,2);
$email = '';

//$foto = $idpel.'-'.substr($idpiu,0,6).'-PEMUTUSAN.jpeg';

$unitupi = substr($area,0,2);
$unitap = $area;
$unitup = substr($username,0,5);


$foto = $decode['data']['foto'];
$nama_foto = $decode['data']['nama_foto'];

$path = "/media/nas/uploads/PEMUTUSAN/".$blth."/".$area."/".$nama_foto;
$dir = "/media/nas/uploads/PEMUTUSAN/".$blth."/".$area."/";

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


$akurasi = 0;

$params = array(
        array($blth, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($idpel, SQLSRV_PARAM_IN),
        array($tgl, SQLSRV_PARAM_IN),
        array($ket, SQLSRV_PARAM_IN),
        array($nope, SQLSRV_PARAM_IN),
        array($catatan, SQLSRV_PARAM_IN),
        array($latitude, SQLSRV_PARAM_IN),
        array($longitude, SQLSRV_PARAM_IN),
        array($akurasi, SQLSRV_PARAM_IN),
        array($nama_foto, SQLSRV_PARAM_IN),
        array($username, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_WS_PEMUTUSAN_SIMPAN @BLTH = ?, @UNITUPI = ?, @UNITAP = ?, @UNITUP = ?, @IDPEL = ?, @TGL_PUTUS = ?, @KET = ?, @NOHP = ?, @CATATAN = ?, @LATITUDE = ?, @LONGITUDE = ?, @AKURASI = ?, @FOTO = ?, @USERID = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){
    $response['success'] = true;
    $response['msg'] = 'Data berhasil disimpan';
    $response['debug'] = $foto;

}else{
    $response['success'] = false;
    $response['msg'] = 'Data gagal disimpan';
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);

?>
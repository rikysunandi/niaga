<?php
require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';
require_once '../../bo/config/router.php';


system('net use Z: "\\\\172.16.1.2\\public" ');

$data = file_get_contents("php://input");
$decode = json_decode($data,true);
 
date_default_timezone_set("Asia/Jakarta");

$area = $decode['data']['area'];
$foto = $decode['data']['foto'];
$nama_foto = $decode['data']['nama_foto'];
$idpel = $decode['data']['idpel'];
$blth = date("Ym");


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


echo json_encode($response);
fastcgi_finish_request();
?>


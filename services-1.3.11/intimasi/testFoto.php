<?php
require_once '../../bo/config/config.php';
require_once '../../bo/config/database.php';
require_once '../../bo/config/router.php';


$btlh='122021';
$area='53GRT';


$to_path = PATH_UPLOAD_PHOTOS_INTIMASI.$blth."/".$area."/".$idpel."-".$blth.".jpeg";
$to_dir = PATH_UPLOAD_PHOTOS_INTIMASI.$blth."/".$area;
$path = "D:/P3_TEMP/122021/53GRT/532710156955-122021.jpeg";

if(!file_exists($to_dir)){ mkdir($to_dir, 0777, true); }

if (!copy($path, $to_path)) {
    $response['success'] = false;
    $response['msg'] = 'Gagal Copy Foto ke NAS';
}else{
    unlink($path);
    $response['success'] = true;
    $response['msg'] = 'Berhasil menyimpan Foto';
}


echo json_encode($response);
?>


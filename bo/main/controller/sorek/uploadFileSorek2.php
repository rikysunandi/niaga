<?php


ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_execution_time', -1);
ini_set('memory_limit',-1);
ini_set('sqlsrv.timeout', 3600);
ini_set('sqlsrv.connect_timeout', 3600);
ini_set('date.timezone', 'Asia/Jakarta');

//require_once '../../../config/database.php';
require_once '../../../config/ftp.php';
// require_once '../../../libs/excel_reader2.php';

// header("HTTP/1.0 400 Bad Request");
// echo 'Pemeliharaan Sistem, mohon menunggu!';
// exit();
//error_reporting(E_ERROR);
set_time_limit(180);




$user = 'SYSTEM';

$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ( 0 < $_FILES['file']['error'] ) {
	$response['success'] = false;
	$response['msg'] = $_FILES['file']['error'];
}else if ( $ext <> 'xls' AND $ext <> 'csv' ) {
	$response['success'] = false;
	$response['msg'] = 'Silahkan upload File Excel (.xls) atau .csv, file anda berekstensi '.$ext.' '.$_FILES['file']['tmp_name'].' UP:'.$unitup;
	header("HTTP/1.0 400 Bad Request");
	echo 'Silahkan upload File Excel (.xls) atau .csv, file anda berekstensi '.$ext.' '.$_FILES['file']['tmp_name'].' UP:'.$unitup;
}
else {
	$filesize = $_FILES['file']['size'];

	$filename = 'SOREK_'.substr(bin2hex( random_bytes(12) ), 0, 10).'.xls';
	$targetPath = '../../../assets/uploads/'.$filename;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)){

		$response['success'] = true;
		$response['msg'] = 'Upload Sorek berhasil';
		$response['filename'] = $filename;
		
		echo json_encode($response);
    }
	else{
		$response['success'] = false;
		$response['msg'] = 'Upload Sorek gagal';
		header("HTTP/1.0 400 Bad Request");
		echo 'Upload Sorek gagal';
	 }

}


//echo json_encode($response);
?>

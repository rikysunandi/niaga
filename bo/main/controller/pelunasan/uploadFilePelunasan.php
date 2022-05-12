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
require_once '../../../libs/excel_reader2.php';

//error_reporting(E_ERROR);
set_time_limit(180);


$user = 'SYSTEM';
$kodegerak = $_REQUEST['kodegerak'];

$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ( 0 < $_FILES['file']['error'] ) {
	$response['success'] = false;
	$response['msg'] = $_FILES['file']['error'];
}else if ( $ext <> 'xls' ) {
	$response['success'] = false;
	$response['msg'] = 'Silahkan upload File Excel (.xls), file anda berekstensi '.$ext.' '.$_FILES['file']['tmp_name'].' UP:'.$unitup;
	header("HTTP/1.0 400 Bad Request");
	echo 'Silahkan upload File Excel (.xls), file anda berekstensi '.$ext.' '.$_FILES['file']['tmp_name'].' UP:'.$unitup;
}
else {

// $filename = date('mdHi').preg_replace("/[^a-zA-Z0-9]+/", "", $_FILES['file']['name']).bin2hex( random_bytes(12) ).'.xls';
// 			// upload file
// if (ftp_put($ftp_conn, '/uploads/'.$filename, $_FILES['file']['tmp_name'])){

// 	$response['success'] = true;
// 	$response['msg'] = 'Upload pelunasan berhasil';
// 	$response['filename'] = $filename;

// 	echo json_encode($response);
// }
// else{
// 	$response['success'] = false;
// 	$response['msg'] = 'Upload pelunasan gagal';
// 	header("HTTP/1.0 400 Bad Request");
// 	echo 'Upload pelunasan gagal';
//  }

// ftp_close($ftp_conn);

    
	if ( $xls = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name'],false) ) {

		if($xls->val(1,1)=='TglTransaksi'){


			$filename = date('mdHi').'_'.$kodegerak.'_'.preg_replace("/[^a-zA-Z0-9]+/", "", $_FILES['file']['name']).'_'.substr(bin2hex( random_bytes(12) ), 0, 6).'.xls';
			// upload file
			if (ftp_put($ftp_conn, '/uploads/'.$filename, $_FILES['file']['tmp_name'])){

				$response['success'] = true;
				$response['msg'] = 'Upload pelunasan berhasil';
				$response['filename'] = $filename;

				echo json_encode($response);
			}
			else{
				$response['success'] = false;
				$response['msg'] = 'Upload pelunasan gagal';
				header("HTTP/1.0 400 Bad Request");
				echo 'Upload pelunasan gagal';
			 }

			// close connection
			ftp_close($ftp_conn);
		}else{
			$response['success'] = false;
			$response['msg'] = 'Format File yang diupload tidak dikenali, pastikan download xls (DATA ONLY)';
			header("HTTP/1.0 400 Bad Request");
			echo 'Format File yang diupload tidak dikenali, pastikan download xls (DATA ONLY)';
		}
	} else {
		$response['success'] = false;
		$response['msg'] = 'Gagal membaca file yang diupload';
		header("HTTP/1.0 400 Bad Request");
		echo 'Gagal membaca file yang diupload';
	}

}


//echo json_encode($response);
?>

<?php


ini_set('upload_max_filesize', '30M');
ini_set('post_max_size', '30M');
ini_set('max_execution_time', 0);
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

$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ( 0 < $_FILES['file']['error'] ) {
	$response['success'] = false;
	$response['msg'] = $_FILES['file']['error'];
}else if ( $ext <> 'xls' ) {
	$response['success'] = false;
	$response['msg'] = 'Silahkan upload File Excel (.xlsx), file anda berekstensi '.$ext.' '.$_FILES['file']['tmp_name'].' UP:'.$unitup;
	header("HTTP/1.0 400 Bad Request");
	echo 'Silahkan upload File Excel (.xlsx), file anda berekstensi '.$ext.' '.$_FILES['file']['tmp_name'].' UP:'.$unitup;
}
else {
	$filesize = $_FILES['file']['size'];
    
	if ( $xls = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name'],false) ) {
		
		if(substr(preg_replace("/[^a-zA-Z0-9]+/", "", $xls->val(1,1,0)),0,3)=='THB' && $xls->colcount($sheet_index=0)==73){


			$filename = 'SOREK_'.date('mdHi').'_'.preg_replace("/[^a-zA-Z0-9]+/", "", $_FILES['file']['name']).'_'.substr(bin2hex( random_bytes(12) ), 0, 6).'.xls';
			// upload file
			if (ftp_put($ftp_conn, '/uploads_sorek/'.$filename, $_FILES['file']['tmp_name'])){

				$response['success'] = true;
				$response['msg'] = 'Upload Sorek berhasil';
				$response['filename'] = $filename;
				$response['filesize'] = $filesize;
				$response['rowcount'] = $xls->rowcount($sheet_index=0);
				$response['colcount'] = $xls->colcount($sheet_index=0);

				echo json_encode($response);
			}
			else{
				$response['success'] = false;
				$response['msg'] = 'Upload Sorek gagal';
				header("HTTP/1.0 400 Bad Request");
				echo 'Upload Sorek gagal';
			 }

			// close connection
			ftp_close($ftp_conn);
		}else{
			$response['success'] = false;
			$response['msg'] = 'Format File yang diupload tidak dikenali, pastikan download xls';
			header("HTTP/1.0 400 Bad Request");
			echo 'Format File yang diupload tidak dikenali, pastikan download xls dari AP2T - '.$xls->val(1,1);
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

<?php


ini_set('upload_max_filesize', '30M');
ini_set('post_max_size', '30M');
ini_set('max_execution_time', 0);
ini_set('memory_limit',-1);
ini_set('sqlsrv.timeout', 10000000);
ini_set('sqlsrv.connect_timeout', 10000000);
ini_set('date.timezone', 'Asia/Jakarta');

require_once '../../../config/ftp.php';

//error_reporting(E_ERROR);
set_time_limit(180);
$user = 'SYSTEM';

$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ( 0 < $_FILES['file']['error'] ) {
	$response['success'] = false;
	$response['msg'] = $_FILES['file']['error'];
}else if ( $ext <> 'zip' ) {
	$response['success'] = false;
	$response['msg'] = 'Silahkan upload File Zip (.zip), file anda berekstensi '.$ext.' '.$_FILES['file']['tmp_name'].' UP:'.$unitup;
	header("HTTP/1.0 400 Bad Request");
	echo 'Silahkan upload File Zip (.zip), file anda berekstensi '.$ext.' '.$_FILES['file']['tmp_name'].' UP:'.$unitup;
}
else {

	$filename = date('mdHi').'_'.preg_replace("/[^a-zA-Z0-9]_+/", "", $_FILES['file']['name']).'_'.substr(bin2hex( random_bytes(12) ), 0, 6).'.zip';
	// upload file
	$folder = '../../../assets/uploads/';
	$filepath = $folder.$filename;
	if (move_uploaded_file($_FILES['file']['tmp_name'], $filepath)){


		$zip = new ZipArchive;
		$res = $zip->open($filepath);
		if ($res === TRUE) {

		  	$path = '../../../assets/uploads/';
		  	$dir = trim($zip->getNameIndex(0), '/');
		  	$dir = str_replace(' ', '_', $dir);
		  	//$zip->extractTo($path);
		  	$zip->close();

		  	$output=null;
			$retval=null;
			chdir("D:/wamp64/www/niaga/bo/assets/uploads/");
			exec('"C:/Program Files/7-Zip/7z" x "D:/wamp64/www/niaga/bo/assets/uploads/'.$filename.'"', $output, $retval);

			if(file_exists(dirname("D:/wamp64/www/niaga/bo/assets/uploads/".$dir).'/data.csv')){
				$response['success'] = true;
				$response['filename'] = $filename;
				$response['zipfile'] = $filepath;
				$response['filepath'] = "D:/wamp64/www/niaga/bo/assets/uploads/".$dir;
				$response['rows'] = csvToJson(dirname("D:/wamp64/www/niaga/bo/assets/uploads/".$dir).'/data.csv');
				echo json_encode($response);
			}
			else{
				header("HTTP/1.0 400 Bad Request");
				//echo dirname($folder.$dir).'/data.csv';
				echo 'File '.dirname("D:/wamp64/www/niaga/bo/assets/uploads/".$dir).'/data.csv'.' tidak ditemukan!';	
			}
		} else {
			header("HTTP/1.0 400 Bad Request");
			echo 'Gagal mengekstrak file ZIP!';
		}

	}
	else{
		$response['success'] = false;
		$response['msg'] = 'Upload Pemeriksaan gagal';
		header("HTTP/1.0 400 Bad Request");
		echo 'Upload Pemeriksaan gagal';
	 }

	// close connection
	//ftp_close($ftp_conn);

}

function csvToJson($fname) {
    // open csv file
    if (!($fp = fopen($fname, 'r'))) {
        die("Can't open file...");
    }
    
    //read csv headers
    $key = fgetcsv($fp,"1024",",");
    
    // parse csv rows into array
    $json = array();
        while ($row = fgetcsv($fp,"1024",",")) {
        $json[] = array_combine($key, $row);
    }
    
    // release file handle
    fclose($fp);
    
    // encode array to json
    return json_encode($json);
}

//echo json_encode($response);
?>

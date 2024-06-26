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
		  	$dir = trim($zip->getNameIndex(1), '/');
		  	$dir = dirname($dir);

		  	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' && substr($dir, -1)==' ') {
		  		//if(substr($dir, -1)==' ')
		  		$dir = substr($dir, 0, -1).'_';
		  		$uploads_dir = "D:/wamp64/www/niaga/bo/assets/uploads/";
			  	$output=null;
				$retval=null;
				chdir($uploads_dir);
				// exec('"C:/Program Files/7-Zip/7z" x "'.$uploads_dir.$filename.'"', $output, $retval);
				shell_exec('"C:/Program Files/7-Zip/7z" x "'.$uploads_dir.$filename.'"');
				$task_completed=false;
				while(!$task_completed){
				    if(connection_aborted()==1){
				        kill_the_process();//this will kill the running process launched by script
				        die();
				    }
				    $task_completed=true;//true if the task completed
				    sleep(1);
				}
			}else{
				$zip->extractTo($path);
				$uploads_dir = $folder;
			}
			$zip->close();


			if(file_exists(($uploads_dir.$dir).'/data.csv')){
				$response['success'] = true;
				$response['filename'] = $filename;
				$response['zipfile'] = $uploads_dir.basename($filepath);
				$response['filepath'] = $uploads_dir.$dir;
				$response['rows'] = csvToJson(($uploads_dir.$dir).'/data.csv');
				echo json_encode($response);
			}
			else{
				header("HTTP/1.0 400 Bad Request");
				//echo dirname($folder.$dir).'/data.csv';
				echo 'File '.($folder.$dir).'/data.csv'.' tidak ditemukan!';	
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

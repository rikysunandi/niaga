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

		  	// $dir = date('Ymdhis').rand(0,100);
		  	// $home_folder = '../../../assets/uploads/'.$dir;
		   //  for($i = 0; $i < $zip->numFiles; $i++) 
		   //  { 
		   //      $OnlyFileName = $zip->getNameIndex($i);
		   //      $FullFileName = $zip->statIndex($i);    
		   //      if ($FullFileName['name'][strlen($FullFileName['name'])-1] =="/")
		   //      {
		   //          @mkdir($home_folder."/".$FullFileName['name'],0700,true);
		   //      }
		   //  }

		   //  //unzip into the folders
		   //  for($i = 0; $i < $zip->numFiles; $i++) 
		   //  { 
		   //      $OnlyFileName = $zip->getNameIndex($i);
		   //      $FullFileName = $zip->statIndex($i);    

		   //      if (!($FullFileName['name'][strlen($FullFileName['name'])-1] =="/"))
		   //      {
		   //          if (preg_match('#\.(jpg|jpeg|gif|png)$#i', $OnlyFileName))
		   //          {
		   //              copy('zip://'. $ZipFileName .'#'. $OnlyFileName , $home_folder."/".$FullFileName['name'] ); 
		   //          } 
		   //      }
		   //  }
		  	for ($i = 0; $i < $zip->numFiles; $i++)
			{
				$filename = $zip->getNameIndex($i);
				// $newname;
				// $arr=explode('.',$file );
				// if(substr_count($arr[0],"_")==2)
				// {
				// 	$underscorearr=explode('_',$arr[0] );
				// 	$newname=$underscorearr[1].'_'.$underscorearr[2];
				// }
				// else
				// {
				// 	$newname=$arr[0];
				// }
				// $nameindex=$i+1;
				// $newname.='.00'.$nameindex;
				$zip->renameName($filename,str_replace(" ", "", $filename));
			}
		  	$zip->extractTo($path);
		  	//make all the folders

		  	$zip->close();

			$response['success'] = true;
			$response['filename'] = $filename;
			$response['zipfile'] = $filepath;
			$response['filepath'] = $folder.$dir;
			if(file_exists(dirname($folder.$dir).'/data.csv')){
				$response['rows'] = csvToJson(dirname($folder.$dir).'/data.csv');
			}
			else{
				header("HTTP/1.0 400 Bad Request");
				echo 'File csv tidak ditemukan!';	
			}
			echo json_encode($response);
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
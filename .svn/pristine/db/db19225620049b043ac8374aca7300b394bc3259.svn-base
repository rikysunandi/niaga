<?php
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$ds = DIRECTORY_SEPARATOR;  //1
$storeFolder = '../../../assets/uploads';   //2
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    
    $filename = 'DAFTUNG_'.date('Ymdhis').'.csv';
    $targetFile =  $targetPath. $filename;  //5
 
    move_uploaded_file($tempFile,$targetFile); //6

    if(file_exists($targetFile)){
    	$response['success'] = true;
    	$response['msg'] = 'File CSV berhasil diupload';
    	$response['csv_file'] = $_FILES['file']['name'];


		if (($handle = fopen($targetFile, "r")) !== FALSE) {
		   	fgetcsv($handle);   

		   	if (($data = fgetcsv($handle, 50000, ",")) !== FALSE) {
		   		$response['noagenda'] = $data[5];
		   		$response['idx'] = 0;
		   		$response['count'] = count(file($targetFile));
		   	}
		}

		fclose($handle);

    }else{
    	$response['success'] = false;
    	$response['msg'] = 'File CSV gagal diupload';
    }
     
}


header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>      
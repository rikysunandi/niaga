<?php

ini_set('upload_max_filesize', '30M');
ini_set('post_max_size', '30M');

require_once '../../config/database.php';
 
if (!empty($_FILES)) {

    $file_name = 'data_pelunasan_'.date('Ymdhis').'.txt';
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);  
    $tempFile = $_FILES['file']['tmp_name'];    

    if($ext == 'zip'){
        $zip = new ZipArchive;
        $res = $zip->open($tempFile);
        if ($res === TRUE) {
          $zip->renameName($zip->getNameIndex(0),$file_name);
          $uploads_dir = '../../assets/uploads/';
          $zip->extractTo($uploads_dir, $file_name);
          $zip->close();
          $tempFile = $uploads_dir.$file_name;
        } else {
            $response['success'] = false;  
        }
    }

    $fp = fopen($tempFile, 'rb');
	$file_content = fread($fp, filesize($tempFile));
	fclose($fp);          

    $tsql_callSP = "{call SP_UPLOAD_FILES(?,?)}";

    $params = array(
        array($file_name, SQLSRV_PARAM_IN),
        array($file_content, SQLSRV_PARAM_IN)
    );

    /* Execute the query. */
    $stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
    if( $stmt === false )
    {
        echo "Error in executing statement 3.\n";
        die( print_r( sqlsrv_errors(), true));
    }

    /*Free the statement and connection resources. */
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    
    $response['success'] = true;  

}else{
    $response['success'] = false;  
}

echo json_encode($response);

?>      
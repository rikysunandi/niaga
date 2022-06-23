<?php

ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '128M');
ini_set('sqlsrv.timeout', 1200);
ini_set('sqlsrv.connect_timeout', 1200);

require_once '../../../config/database.php';
//require_once '../../../config/ftp.php';

// $unitupi = $_POST['unitupi'];
// $unitap = $_POST['unitap'];

$unitupi = $_POST['unitupi'];
$unitap = $_POST['unitap'];
$unitup = $_POST['unitup'];
$ori_filename = $_POST['ori_filename'];
$filename = $_POST['filename'];
$kodegerak = $_POST['kodegerak'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        // array($unitupi, SQLSRV_PARAM_IN),
        // array($unitap, SQLSRV_PARAM_IN),
        // array($unitup, SQLSRV_PARAM_IN),
        array($kodegerak, SQLSRV_PARAM_IN),
        array($filename, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_Upload_Pelunasan @UserID = ?, @KDGERAKKELUAR = ?, @Filename = ? ";
//$sql = "EXEC sp_Upload_Pelunasan_Dev @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @KDGERAKKELUAR = ?, @Filename = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(sqlsrv_execute($stmt)){

    $i=0;    
    do{ 
        $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
        $i++;
    }while(sqlsrv_next_result($stmt));

    if($row['MSG']=='SUKSES'){
        $response['success'] = true;
        $response['msg'] = 'Update data Pelunasan dari File '.$ori_filename.' telah berhasil';
    }else{
        $response['success'] = false;
        $response['msg'] = 'Upload File '.$ori_filename.' gagal, '.$row['MSG'];
    }

	
}
else{
	$response['success'] = false;
	$response['msg'] = 'Upload File '.$ori_filename.' gagal, '.' gagal eksekusi procedure simpan!';
}




// $response['success'] = true;
// $response['msg'] = 'Upload pelunasan berhasil';

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);
?>

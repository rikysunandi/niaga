<?php

ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '128M');
ini_set('sqlsrv.timeout', 3600);
ini_set('sqlsrv.connect_timeout', 3600);

require_once '../../../config/database.php';
require_once '../../../config/ftp.php';

$unitupi = $_POST['unitupi'];
$unitap = $_POST['unitap'];
$unitup = $_POST['unitup'];
$blth = $_POST['blth'];

$filename = $_POST['filename'];
$ori_filename = $_POST['ori_filename'];
// $filesize = $_POST['filesize'];
$rowcount = $_POST['rowcount'];
//$colcount = $_POST['colcount'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($filename, SQLSRV_PARAM_IN),
        array($ori_filename, SQLSRV_PARAM_IN),
        // array($blth, SQLSRV_PARAM_IN),
        // array($unitupi, SQLSRV_PARAM_IN),
        // array($unitap, SQLSRV_PARAM_IN),
        // array($unitup, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_Upload_Sorek_Live @UserID = ?, @Filename = ?, @Ori_Filename = ? ";
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
        $response['msg'] = 'Update data Sorek dari File '.$ori_filename.' telah berhasil';
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

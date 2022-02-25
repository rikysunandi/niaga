<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

ini_set('max_execution_time', 300);
set_time_limit(300);

$filepath = $_REQUEST['filepath'];
$zipfile = $_REQUEST['zipfile'];
$uploadname = $_REQUEST['uploadname'];

$response = array();


function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

delete_files(($filepath));
delete_files($zipfile);

$response['msg'] .= 'Clear File berhasil';
$response['success'] = true;


//header('Content-Type: application/json');
echo json_encode(utf8ize($response));

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}



?>
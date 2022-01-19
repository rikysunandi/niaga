<?php

ini_set('memory_limit', '512M');
ini_set('upload_max_filesize', '120M');
ini_set('post_max_size', '120M');
ini_set('max_input_time', 100);
ini_set('max_execution_time', 100);


require_once '../../../config/database.php';

$response['dbg-1'] = '-1';
if (!empty($_FILES)) {

  if($_FILES['file']['size'] <= 50000000){
    //$file_name = 'pemeriksaan_lpb_'.date('Ymdhis').'.zip';
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $tempFile = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];

    $response['dbg1'] = '1';
    if(strtolower($ext) == 'zip'){
        $zip = new ZipArchive;
        $res = $zip->open($tempFile);
        $response['dbg2'] = '2';
        if ($res === TRUE) {
          $uploads_dir = '../../../assets/uploads/upload-'.date('Ymdhis');
          if(!file_exists($uploads_dir)) mkdir($uploads_dir);

          for($i = 0; $i < $zip->numFiles; $i++) 
          { 
              $OnlyFileName = $zip->getNameIndex($i);
              $FullFileName = $zip->statIndex($i);    

              if (!($FullFileName['name'][strlen($FullFileName['name'])-1] =="/"))
              {
                  if (preg_match('#\.(jpg|jpeg|png|csv)$#i', $OnlyFileName))
                  {
                      copy('zip://'. $tempFile .'#'. $OnlyFileName , $uploads_dir."/".basename($OnlyFileName)); 
                  } 
              }
          }

          $zip->close();
          $response['success'] = true;
          $response['filepath'] = ($uploads_dir.'/');
          $response['filename'] = $file_name;

          $fp = file(($uploads_dir).'/data.csv', FILE_SKIP_EMPTY_LINES);
          $response['count'] = count($fp)-1;

          $file = fopen(($uploads_dir).'/data.csv', 'r');
          $columns = fgetcsv($file);
          $data = fgetcsv($file);
          $response['next_rec'] = (object) array_combine( $columns, $data );
          $response['next_idx'] = 1;
          fclose($file);

        }else {
          $response['success'] = false;
          $response['error'] = "Gagal export Zip";
        }

    }else {
        $response['success'] = false;
        $response['error'] = "File yang diupload harus Zip";
    }
    $response['dbg12'] = '12';
  }else{
      $response['success'] = false;
      $response['error'] = "Ukuran maksimal File yang dapat diupload 50M";
  }


}else{
    $response['success'] = false;
}

if( isset($response['error']) ){
    http_response_code (401);
}
else{
    http_response_code (200);
}

header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
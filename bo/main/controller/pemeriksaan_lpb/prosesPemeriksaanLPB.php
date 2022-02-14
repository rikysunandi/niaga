<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';
require_once '../../../config/ftp103.php';

ini_set('max_execution_time', 60);
set_time_limit(60);

$filepath = $_REQUEST['filepath'];
$zipfile = $_REQUEST['zipfile'];
$uploadname = $_REQUEST['uploadname'];
$data = $_REQUEST['row'];
//$json_data = json_decode($data , true);

$tgl_pemeriksaan = $data['tgl_pemeriksaan'];
$unitupi = $data['unitupi'];
$unitap = $data['unitap'];
$unitup = $data['unitup'];
$idpel = $data['idpel'];
$nama = $data['nama'];
$tarif = $data['tarif'];
$daya = $data['daya'];
$nik = $data['nik'];
$kk = $data['kk'];
$nohp = $data['nohp'];
$email = $data['email'];
$peruntukan = $data['peruntukan'];
$sisa_kwh = $data['sisa_kwh'];
// $foto = $data['foto'];
$latitude = $data['latitude'];
$longitude = $data['longitude'];
$akurasi_koordinat = $data['akurasi_koordinat'];
$user_input = $data['user'];
$tgl_input = $data['tgl_insert'];

$response = array();

//$sql = 'SELECT * FROM m_pemeriksaan_lpb WHERE LEFT(IDPEL,11) = \''.substr($idpel,0,11).'\' ';
$sql = 'SELECT * FROM m_pemeriksaan_lpb WHERE IDPEL = \''.$idpel.'\' ';
//$params = array(1, substr($idpel,0,11));

$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false ) {
    $response['success'] = false;
    $response['msg'] = 'Gagal query ke Database';
}else{
  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  if(strlen($row['IDPEL'])>=11){
    $response['success'] = false;
    $response['msg'] = 'Data Idpel '.$idpel.' tidak disimpan karena sudah pernah ditagging oleh '.$row['USER_INPUT'].' !';
  }else{
    $response['msg'] = $idpel.': ';

    //if (ftp_put($ftp_conn, '/uploads_sorek/'.$filename, $_FILES['file']['tmp_name']))
    $dir = dirname($filepath);
    //$dir = str_replace(" ", "", $dir);
    $zip = new ZipArchive;
    $res = $zip->open($zipfile);

    $file_name = $idpel.'_'.$tgl_pemeriksaan.'.jpg';


    //if($zip->extractTo($dir."/".$file_name, $file_name)){
    //if(copy('zip://'. $zipfile .'#'. $file_name , $dir."/".$file_name)){

    if(file_exists($dir.'/'.$file_name)){

        if(strlen($unitap)==5)
          $file_path = "tagging/".$unitap."/".$unitup."/";
        else
          $file_path = "tagging/53XXX/";

        if(ftp_chdir($ftp_conn, $file_path)){

          ftp_pasv ( $ftp_conn, true ) ;
          if(ftp_put($ftp_conn, $file_name, $dir.'/'.$file_name)){
            $foto = $file_name;
            $response['msg'] .= 'Berhasil upload file foto meter, '; 
          }else{
            $response['msg'] .= 'gagal menyalin file foto meter, '; 
          }

        }else{
          $response['msg'] .= 'gagal menyalin file foto meter, '; 
        }

    }

    $file_name = $kk.'.jpg';

    //if($zip->extractTo($dir."/".$file_name, $file_name)){
    //if(copy('zip://'. $zipfile .'#'. $file_name , $dir."/".$file_name)){
    if(file_exists($dir.'/'.$file_name)){
        if(strlen($unitap)==5)
          $file_path = "/rumah/".$unitap."/".$unitup;
        else
          $file_path = "/rumah/53XXX";

        
        if(ftp_chdir($ftp_conn, $file_path)){

          ftp_pasv ( $ftp_conn, true ) ;
          if(ftp_put($ftp_conn, $file_name, $dir.'/'.$file_name)){
            $foto_rumah = $file_name;
            $response['msg'] .= 'Berhasil upload file foto rumah, '; 
          }else{
            $response['msg'] .= 'gagal menyalin file foto rumah, '; 
          }

        }else{
          $response['msg'] .= 'gagal menyalin file foto rumah, '; 
        }
    }

    ftp_close($ftp_conn);

    sqlsrv_free_stmt($stmt);

    $params = array(
            array($tgl_pemeriksaan, SQLSRV_PARAM_IN),
            array($unitupi, SQLSRV_PARAM_IN),
            array($unitap, SQLSRV_PARAM_IN),
            array($unitup, SQLSRV_PARAM_IN),
            array($idpel, SQLSRV_PARAM_IN),
            array($nama, SQLSRV_PARAM_IN),
            array($tarif, SQLSRV_PARAM_IN),
            array($daya, SQLSRV_PARAM_IN),
            array($nik, SQLSRV_PARAM_IN),
            array($kk, SQLSRV_PARAM_IN),
            array($nohp, SQLSRV_PARAM_IN),
            array($email, SQLSRV_PARAM_IN),
            array($peruntukan, SQLSRV_PARAM_IN),
            array($sisa_kwh, SQLSRV_PARAM_IN),
            array($foto, SQLSRV_PARAM_IN),
            array($foto_rumah, SQLSRV_PARAM_IN),
            array($latitude, SQLSRV_PARAM_IN),
            array($longitude, SQLSRV_PARAM_IN),
            array($akurasi_koordinat, SQLSRV_PARAM_IN),
            array($user_input, SQLSRV_PARAM_IN),
            array($tgl_input, SQLSRV_PARAM_IN),
            array($uploadname, SQLSRV_PARAM_IN),
        );

    $sql = "EXEC SP_PEMERIKSAAN_LPB_CSV_SIMPAN @TGL_PEMERIKSAAN = ?, @UNITUPI = ?, @UNITAP = ?, @UNITUP = ?, @IDPEL = ?, @NAMA = ?, @TARIF = ?, @DAYA = ?, @NIK = ?, @KK = ?, @NOHP = ?, @EMAIL = ?, @PERUNTUKAN = ?, @SISA_KWH = ?, @FOTO = ?, @FOTO_RUMAH = ?, @LATITUDE = ?, @LONGITUDE = ?, @AKURASI_KOORDINAT = ?, @USER_INPUT = ?, @TGL_INPUT = ? , @FILENAME = ? ";
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if(sqlsrv_execute($stmt)){
        //sqlsrv_next_result($stmt);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if($row['IDPEL']==''){
            sqlsrv_next_result($stmt);
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        }

        $response['pemeriksaan_lpb'] = $row;

        // sqlsrv_next_result($stmt);
        // $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $response['msg'] .= 'Data berhasil disimpan';
        $response['success'] = true;

    }else{
        $response['success'] = false;
        //$response['row'] = print_r($data);
        $response['msg'] .= 'Data gagal disimpan';
    }

  }
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


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
<?php

require_once '../../../bo/config/config.php';
require_once '../../../bo/config/database.php';

ini_set('max_execution_time', 600);
set_time_limit(600);

$file = $_FILES['image']['tmp_name'];
$foto_rumah = $_FILES['image2']['tmp_name'];
$data = $_REQUEST['params'];
$json_data = json_decode($data , true);

$tgl_pemeriksaan = $json_data['tglPemeriksaan'];
$unitupi = $json_data['unitupi'];
$unitap = $json_data['unitap'];
$unitup = $json_data['unitup'];
$idpel = $json_data['idpel'];
$nama = $json_data['nama'];
$tarif = $json_data['tarif'];
$daya = $json_data['daya'];
$nik = $json_data['nik'];
$kk = $json_data['kk'];
$nohp = $json_data['nohp'];
$email = $json_data['email'];
$peruntukan = $json_data['peruntukan'];
$sisa_kwh = $json_data['sisa_kwh'];
// $foto = $json_data['foto'];
$latitude = $json_data['latitude'];
$longitude = $json_data['longitude'];
$akurasi_koordinat = $json_data['akurasiKoordinat'];
$user_input = $json_data['user'];
$tgl_input = $json_data['tglInsert'];

$response = array();

$sql = 'SELECT TOP 1 * FROM m_pemeriksaan_lpb WHERE LEFT(IDPEL,11) = \''.substr($idpel,0,11).'\' ';
//$params = array(1, substr($idpel,0,11));

$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false ) {
    $response['success'] = false;
    $response['msg'] = 'Data gagal disimpan karena sudah pernah ditagging';
}else{

  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  if($row['IDPEL']==''){

    if(isset($_FILES['image'])){
      $file_name = $idpel.'_'.$tgl_pemeriksaan.'.jpg';
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

      $extensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$extensions)=== false){
         $response['error'][]="extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 2097152){
         $response['error'][]='File size must be excately 2 MB';
      }

      if(empty($response['error'])==true){
        if(strlen($unitup)==5)
          $file_path = "../../uploads/tagging/".$unitap."/".$unitup;
        else
          $file_path = "../../uploads/tagging/53XXX";
        if (!file_exists($file_path)) {
            mkdir($file_path, 0777, true);
        }
        if(move_uploaded_file($file_tmp, $file_path."/".$file_name))
          $foto = $file_name;
      }
    }

    if(isset($_FILES['image2'])){
      $file_name = $kk.'.jpg';
      $file_size =$_FILES['image2']['size'];
      $file_tmp =$_FILES['image2']['tmp_name'];
      $file_type=$_FILES['image2']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image2']['name'])));

      $extensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$extensions)=== false){
         $response['error'][]="extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 2097152){
         $response['error'][]='File size must be excately 2 MB';
      }

      if(empty($response['error'])==true){
        if(strlen($unitup)==5)
          $file_path = "../../uploads/rumah/".$unitap."/".$unitup;
        else
          $file_path = "../../uploads/rumah/53XXX";
        if (!file_exists($file_path)) {
            mkdir($file_path, 0777, true);
        }
        if(move_uploaded_file($file_tmp, $file_path."/".$file_name))
          $foto_rumah = $file_name;
      }
    }


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
        );

    $sql = "EXEC SP_WS_PEMERIKSAAN_LPB_SIMPAN @TGL_PEMERIKSAAN = ?, @UNITUPI = ?, @UNITAP = ?, @UNITUP = ?, @IDPEL = ?, @NAMA = ?, @TARIF = ?, @DAYA = ?, @NIK = ?, @KK = ?, @NOHP = ?, @EMAIL = ?, @PERUNTUKAN = ?, @SISA_KWH = ?, @FOTO = ?, @FOTO_RUMAH = ?, @LATITUDE = ?, @LONGITUDE = ?, @AKURASI_KOORDINAT = ?, @USER_INPUT = ?, @TGL_INPUT = ? ";
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if(sqlsrv_execute($stmt)){
        //sqlsrv_next_result($stmt);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if($row['IDPEL']==''){
            sqlsrv_next_result($stmt);
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        }

        $response = $row;

        // sqlsrv_next_result($stmt);
        // $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);


        //$response['success'] = true;

    }else{
        $response['success'] = false;
        $response['msg'] = 'Data Idpel '.$idpel.'gagal disimpan';
    }

  }else{
    $response = $row;
  }
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


header('Content-Type: application/json');
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
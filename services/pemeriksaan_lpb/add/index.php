<?php

require_once '../../../bo/config/config.php';
require_once '../../../bo/config/database.php';

ini_set('max_execution_time', 60);
set_time_limit(60);

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
$sisa_kwh = $json_data['sisaKwh'];
// $foto = $json_data['foto'];
$latitude = $json_data['latitude'];
$longitude = $json_data['longitude'];
$akurasi_koordinat = $json_data['akurasiKoordinat'];
$user_input = $json_data['user'];
$tgl_input = $json_data['tglInsert'];

$response = array();

if(strlen($unitap)<>5){
  $key = array_search($unitup, array_column($unitups, 'unitup'));
  $unitap = $unitups[$key]['unitap'];
}

if(substr($idpel, 0, 11)=='99999999999'){
  // if(strlen($latitude)>5)
  //   $idpel = '99'.substr($user_input, 0, 5).substr($latitude, -2).substr($longitude, -3);
  // else
  //   $idpel = '99'.substr($user_input, 0, 5).substr($latitude, -2).substr($longitude, -3);
  $idpel = '99'.substr($user_input, 0, 5).substr(str_replace(':','',substr($tgl_input, -8)),0,5);
  //210429
}

// $sql = 'SELECT * FROM m_pemeriksaan_lpb WHERE IDPEL = \''.$idpel.'\' AND FOTO_RUMAH IS NOT NULL ';
// //$params = array(1, substr($idpel,0,11));

// $stmt = sqlsrv_query( $conn, $sql );
// if( $stmt === false ) {
//     $response['success'] = false;
//     $response['msg'] = 'Gagal query ke Database';
// }else{
//   $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
//   if(1==0 && strlen($row['IDPEL'])>=11  && $row['USER_INPUT']!=$user_input){
//     $response['success'] = true;
//     $response['msg'] = 'Data Idpel '.$idpel.' tidak disimpan karena sudah pernah ditagging sebelumnya!';
//   }else{

//     if(isset($_FILES['image'])){
//       $file_name = $idpel.'_'.$tgl_pemeriksaan.'.jpg';
//       $file_size =$_FILES['image']['size'];
//       $file_tmp =$_FILES['image']['tmp_name'];
//       $file_type=$_FILES['image']['type'];
//       $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

//       $extensions= array("jpeg","jpg","png");

//       if(in_array($file_ext,$extensions)=== false){
//          $response['error'][]="extension not allowed, please choose a JPEG or PNG file.";
//       }

//       if($file_size > 2097152){
//          $response['error'][]='File size must be excately 2 MB';
//       }

//       if(empty($response['error'])==true){
//         if(strlen($unitup)==5)
//           $file_path = "/media/nas/uploads/PRIANGAN/tagging/".$unitap."/".$unitup;
//         else
//           $file_path = "/media/nas/uploads/PRIANGAN/tagging/53XXX";
//         if (!file_exists($file_path)) {
//             mkdir($file_path, 0777, true);
//         }
//         if(move_uploaded_file($file_tmp, $file_path."/".$file_name))
//           $foto = $file_name;
//       }
//     }

//     if(isset($_FILES['image2'])){
//       $file_name = $kk.'.jpg';
//       $file_size =$_FILES['image2']['size'];
//       $file_tmp =$_FILES['image2']['tmp_name'];
//       $file_type=$_FILES['image2']['type'];
//       $file_ext=strtolower(end(explode('.',$_FILES['image2']['name'])));

//       $extensions= array("jpeg","jpg","png");

//       if(in_array($file_ext,$extensions)=== false){
//          $response['error'][]="extension not allowed, please choose a JPEG or PNG file.";
//       }

//       if($file_size > 2097152){
//          $response['error'][]='File size must be excately 2 MB';
//       }

//       if(empty($response['error'])==true){
//         if(strlen($unitup)==5)
//           $file_path = "/media/nas/uploads/PRIANGAN/rumah/".$unitap."/".$unitup;
//         else
//           $file_path = "/media/nas/uploads/PRIANGAN/rumah/53XXX";
//         if (!file_exists($file_path)) {
//             mkdir($file_path, 0777, true);
//         }
//         if(move_uploaded_file($file_tmp, $file_path."/".$file_name))
//           $foto_rumah = $file_name;
//       }
//     }

//     sqlsrv_free_stmt($stmt);

//     $params = array(
//             array($tgl_pemeriksaan, SQLSRV_PARAM_IN),
//             array($unitupi, SQLSRV_PARAM_IN),
//             array($unitap, SQLSRV_PARAM_IN),
//             array($unitup, SQLSRV_PARAM_IN),
//             array($idpel, SQLSRV_PARAM_IN),
//             array($nama, SQLSRV_PARAM_IN),
//             array($tarif, SQLSRV_PARAM_IN),
//             array($daya, SQLSRV_PARAM_IN),
//             array($nik, SQLSRV_PARAM_IN),
//             array($kk, SQLSRV_PARAM_IN),
//             array($nohp, SQLSRV_PARAM_IN),
//             array($email, SQLSRV_PARAM_IN),
//             array($peruntukan, SQLSRV_PARAM_IN),
//             array($sisa_kwh, SQLSRV_PARAM_IN),
//             array($foto, SQLSRV_PARAM_IN),
//             array($foto_rumah, SQLSRV_PARAM_IN),
//             array($latitude, SQLSRV_PARAM_IN),
//             array($longitude, SQLSRV_PARAM_IN),
//             array($akurasi_koordinat, SQLSRV_PARAM_IN),
//             array($user_input, SQLSRV_PARAM_IN),
//             array($tgl_input, SQLSRV_PARAM_IN),
//         );

//     $sql = "EXEC SP_WS_PEMERIKSAAN_LPB_SIMPAN @TGL_PEMERIKSAAN = ?, @UNITUPI = ?, @UNITAP = ?, @UNITUP = ?, @IDPEL = ?, @NAMA = ?, @TARIF = ?, @DAYA = ?, @NIK = ?, @KK = ?, @NOHP = ?, @EMAIL = ?, @PERUNTUKAN = ?, @SISA_KWH = ?, @FOTO = ?, @FOTO_RUMAH = ?, @LATITUDE = ?, @LONGITUDE = ?, @AKURASI_KOORDINAT = ?, @USER_INPUT = ?, @TGL_INPUT = ? ";
//     $stmt = sqlsrv_prepare($conn, $sql, $params);

//     if(sqlsrv_execute($stmt)){
//         //sqlsrv_next_result($stmt);
//         $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
//         if($row['IDPEL']==''){
//             sqlsrv_next_result($stmt);
//             $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
//         }

//         $response['pemeriksaan_lpb'] = $row;

//         // sqlsrv_next_result($stmt);
//         // $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

//         $response['msg'] = 'Data Idpel '.$idpel.' berhasil disimpan';
//         $response['success'] = true;

//     }else{
//         $response['success'] = false;
//         $response['msg'] = 'Data Idpel '.$idpel.' gagal disimpan';
//     }

//   }
// }

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
  $blth_folder=date('Ym');

  if(empty($response['error'])==true){
    if(strlen($unitup)==5)
      $file_path = "/media/nas/uploads/PRIANGAN/tagging/".$blth_folder."/".$unitap."/".$unitup;
    else
      $file_path = "/media/nas/uploads/PRIANGAN/tagging/".$blth_folder."/53XXX";
    if (!file_exists($file_path)) {
        $old_umask = umask(0);
        mkdir($file_path, 0777, true);
        umask($old_umask);
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
      $file_path = "/media/nas/uploads/PRIANGAN/rumah/".$blth_folder."/".$unitap."/".$unitup;
    else
      $file_path = "/media/nas/uploads/PRIANGAN/rumah/".$blth_folder."/53XXX";
    if (!file_exists($file_path)) {
        $old_umask = umask(0);
        mkdir($file_path, 0777, true);
        umask($old_umask);
    }
    if(move_uploaded_file($file_tmp, $file_path."/".$file_name))
      $foto_rumah = $file_name;
  }
}

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

    $response['pemeriksaan_lpb'] = $row;

    // sqlsrv_next_result($stmt);
    // $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    $response['msg'] = 'Data Idpel '.$idpel.' berhasil disimpan';
    $response['success'] = true;

}else{
    $response['success'] = false;
    $response['msg'] = 'Data Idpel '.$idpel.' gagal disimpan';
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
fastcgi_finish_request();



?>
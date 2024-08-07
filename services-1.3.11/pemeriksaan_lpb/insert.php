<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$tgl_pemeriksaan = $_POST['tgl_pemeriksaan'];
$idpel = $_POST['idpel'];
$nama = $_POST['nama'];
$tarif = $_POST['tarif'];
$daya = $_POST['daya'];
$nik = $_POST['nik'];
$kk = $_POST['kk'];
$nohp = $_POST['nohp'];
$email = $_POST['email'];
$peruntukan = $_POST['peruntukan'];
$sisa_kwh = $_POST['sisa_kwh'];
$foto = $_POST['foto'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$user_input = $_POST['user_input'];
$tgl_input = $_POST['tgl_input'];

$response = array();

$params = array(
        array($tgl_pemeriksaan, SQLSRV_PARAM_IN),
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
        array($latitude, SQLSRV_PARAM_IN),
        array($longitude, SQLSRV_PARAM_IN),
        array($user_input, SQLSRV_PARAM_IN),
        array($tgl_input, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_WS_PEMERIKSAAN_LPB_SIMPAN 
            @TGL_PEMERIKSAAN = ?, 
            @IDPEL = ?,     
            @NAMA = ?, 
            @TARIF = ?, 
            @DAYA = ?, 
            @NIK = ?, 
            @KK = ?, 
            @NOHP = ?, 
            @EMAIL = ?, 
            @PERUNTUKAN = ?, 
            @SISA_KWH = ?, 
            @FOTO = ?, 
            @LATITUDE = ?, 
            @LONGITUDE = ?, 
            @USER_INPUT = ?, 
            @TGL_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

    $response['success'] = true;

}else{
    $response['success'] = false;
    $response['msg'] = 'Data gagal disimpan';
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);  

header('Content-Type: application/json');
echo json_encode($response);
fastcgi_finish_request();
// echo '{"NOAGENDA_INDIVIDU":"99", "JENIS": "KABEL BARU", "KEBUTUHAN": "0", "ID_KEBUTUHAN": "220", "HARGA_SATUAN": "SR 2X10", "VOLUME": "20", "HARGA_SATUAN": "213123", "HARGA_TOTAL": "12312"}';

?>
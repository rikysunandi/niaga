<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$data = $_POST['data'];
$startTime = $_POST['startTime'];
$user = 'SYSTEM';
$response = array();

$params = array(
        array($data[0], SQLSRV_PARAM_IN),
        array($data[1], SQLSRV_PARAM_IN),
        array($data[2], SQLSRV_PARAM_IN),
        array($data[3], SQLSRV_PARAM_IN),
        array($data[4], SQLSRV_PARAM_IN),
        array($data[5], SQLSRV_PARAM_IN),
        array($data[6], SQLSRV_PARAM_IN),
        array($data[7], SQLSRV_PARAM_IN),
        array($data[8], SQLSRV_PARAM_IN),
        array($data[9], SQLSRV_PARAM_IN),
        array($data[10], SQLSRV_PARAM_IN),
        array($data[11], SQLSRV_PARAM_IN),
        array($data[12], SQLSRV_PARAM_IN),
        array($data[13], SQLSRV_PARAM_IN),
        array($data[14], SQLSRV_PARAM_IN),
        array($data[15], SQLSRV_PARAM_IN),
        array($data[16], SQLSRV_PARAM_IN),
        array($data[17], SQLSRV_PARAM_IN),
        array($data[18], SQLSRV_PARAM_IN),
        array($data[19], SQLSRV_PARAM_IN),
        array($data[20], SQLSRV_PARAM_IN),
        array($data[21], SQLSRV_PARAM_IN),
        array($data[22], SQLSRV_PARAM_IN),
        array($data[23], SQLSRV_PARAM_IN),
        array($data[24], SQLSRV_PARAM_IN),
        array($data[25], SQLSRV_PARAM_IN),
        array($data[26], SQLSRV_PARAM_IN),
        array($data[27], SQLSRV_PARAM_IN),
        array($data[28], SQLSRV_PARAM_IN),
        array($data[29], SQLSRV_PARAM_IN),
        array($data[30], SQLSRV_PARAM_IN),
        array($data[31], SQLSRV_PARAM_IN),
        array($data[32], SQLSRV_PARAM_IN),
        array($data[33], SQLSRV_PARAM_IN),
        array($data[34], SQLSRV_PARAM_IN),
        array($data[35], SQLSRV_PARAM_IN),
        array($data[36], SQLSRV_PARAM_IN),
        array($data[37], SQLSRV_PARAM_IN),
        array($data[38], SQLSRV_PARAM_IN),
        array($data[39], SQLSRV_PARAM_IN),
        array($data[40], SQLSRV_PARAM_IN),
        array($data[41], SQLSRV_PARAM_IN),
        array($data[42], SQLSRV_PARAM_IN),
        array($data[43], SQLSRV_PARAM_IN),
        array($data[44], SQLSRV_PARAM_IN),
        array($data[45], SQLSRV_PARAM_IN),
        array($data[46], SQLSRV_PARAM_IN),
        array($data[47], SQLSRV_PARAM_IN),
        array($data[48], SQLSRV_PARAM_IN),
        array($data[49], SQLSRV_PARAM_IN),
        array($data[50], SQLSRV_PARAM_IN),
        array($data[51], SQLSRV_PARAM_IN),
        array($data[52], SQLSRV_PARAM_IN),
        array($data[53], SQLSRV_PARAM_IN),
        array($startTime, SQLSRV_PARAM_IN),
        array($user, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_DAPOT_SIMPAN 
			@UNITUPI = ?,
            @UNITAP = ?,
            @UNITUP = ?,
            @TGLMOHON = ?,
            @NOAGENDA = ?,
            @NOREGISTER = ?,
            @IDPEL = ?,
            @NAMA = ?,
            @NAMA_PEMOHON = ?,
            @ALAMAT = ?,
            @ALAMAT_PEMOHON = ?,
            @KOORDINAT_X = ?,
            @KOORDINAT_Y = ?,
            @NOTELP = ?,
            @NOTELP_HP = ?,
            @JENIS_TRANSAKSI = ?,
            @TARIF_LAMA = ?,
            @DAYA_LAMA = ?,
            @TARIF = ?,
            @DAYA = ?,
            @ASAL_MOHON = ?,
            @JENIS_MK = ?,
            @RPUJL = ?,
            @RPBP = ?,
            @RPSTROOM_AWAL = ?,
            @JENIS_BAYAR = ?,
            @TGLBAYAR = ?,
            @STATUSPERMOHONAN = ?,
            @STATUSPDL = ?,
            @TGL_SIP = ?,
            @TGLPK = ?,
            @UNITPK = ?,
            @TGLPEREMAJAAN = ?,
            @TGLRUBAHMK = ?,
            @THBLMUT = ?,
            @TGLPDL = ?,
            @NOMORPDL = ?,
            @TGLPENANGGUHAN = ?,
            @TGLSIAPSAMBUNG = ?,
            @TGLRESTITUSI = ?,
            @TGLBPTITIPAN = ?,
            @TGLPENGESAHAN = ?,
            @DURASI_HARI_KERJA = ?,
            @DURASI_HARI_KALENDER = ?,
            @KRITERIA_TMP = ?,
            @ALASAN_KRITERIA_TMP = ?,
            @KETERANGAN_ALASAN_KRITERIA_TMP = ?,
            @ESTIMASI_DURASI_HARI_LAYANAN = ?,
            @STATUS_PENANGGUHAN = ?,
            @ALASAN_PENANGGUHAN = ?,
            @KETERANGAN_ALASAN_PENANGGUHAN = ?,
            @STATUS_RESTITUSI_ATAU_TITIPAN = ?,
            @PAKETSLO = ?,
            @PLTS_ATAP = ?,
			@JAM_UPLOAD = ?, 
			@USER_INPUT = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if(sqlsrv_execute($stmt)){

    if(sqlsrv_rows_affected($stmt)>=0){
        $response['success'] = true;
        $response['msg'] = 'Data berhasil disimpan';
    }else{
        $response['success'] = false;
        $response['msg'] = 'Data gagal disimpan! ';
        $response['noagenda'] = $data[4].' ('.$data[15].') gagal disimpan!';
    }

}else{
    $response['success'] = false;
    $response['noagenda'] = $data[4].' ('.$data[15].') gagal disimpan!';
    $response['msg'] = 'Gagal Eksekusi Procedure DB!';

    if (($errors = sqlsrv_errors()) != null) {
        foreach ($errors as $error) {
            $response['msg'] .= '<br/>'.$error['message'];
        }
    }
}

sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);  

header('Content-Type: application/json');
echo json_encode($response);

?>
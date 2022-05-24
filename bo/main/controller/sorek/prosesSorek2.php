<?php

ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
ini_set('sqlsrv.timeout', 3600);
ini_set('sqlsrv.connect_timeout', 3600);

require_once '../../../config/database.php';
require_once '../../../libs/SimpleXLS.php';
//require_once '../../../config/ftp.php';

// $unitupi = $_POST['unitupi'];
// $unitap = $_POST['unitap'];

$filename = $_POST['filename'];
$ori_filename = $_POST['ori_filename'];
$user = 'SYSTEM';

if ( $xls = SimpleXLS::parse('../../../assets/uploads/'.$filename) ) {
    $i = 0;
    $sukses = 0;
    $gagal = 0;
    // $blth, $unitupi, $unitap, $unitup;
    foreach( $xls->rows() as $r ) {
        if($i==1){
            $blth=$r[0];
            $unitupi=substr($r[14],0,2);
            $unitap=$r[14];
            $unitup=$r[15];
        }
        if($i>0 && strlen($r[1])==12){
            $params = array(
                    array($r[0], SQLSRV_PARAM_IN),
                    array(substr($r[14],0,2), SQLSRV_PARAM_IN),
                    array($r[14], SQLSRV_PARAM_IN),
                    array($r[15], SQLSRV_PARAM_IN),
                    array($r[1], SQLSRV_PARAM_IN),
                    array($r[57], SQLSRV_PARAM_IN),
                    array($r[2], SQLSRV_PARAM_IN),
                    array($r[16], SQLSRV_PARAM_IN),
                    array($r[19], SQLSRV_PARAM_IN),
                    array($r[17], SQLSRV_PARAM_IN),
                    array($r[18], SQLSRV_PARAM_IN),
                    array($r[58], SQLSRV_PARAM_IN),
                    array($r[13], SQLSRV_PARAM_IN),
                    array($r[39], SQLSRV_PARAM_IN),
                    array($r[42], SQLSRV_PARAM_IN),
                    array($r[43], SQLSRV_PARAM_IN),
                    array($r[46], SQLSRV_PARAM_IN),
                    array($r[47], SQLSRV_PARAM_IN),
                    array($r[50], SQLSRV_PARAM_IN),
                    array($r[55], SQLSRV_PARAM_IN),
                    array($r[52], SQLSRV_PARAM_IN),
                    array($r[40], SQLSRV_PARAM_IN),
                    array($r[41], SQLSRV_PARAM_IN),
                    array($r[44], SQLSRV_PARAM_IN),
                    array($r[45], SQLSRV_PARAM_IN),
                    array($r[49], SQLSRV_PARAM_IN),
                    array($r[48], SQLSRV_PARAM_IN),
                    array($r[60], SQLSRV_PARAM_IN),
                    array($r[61], SQLSRV_PARAM_IN),
                    array($r[51], SQLSRV_PARAM_IN),
                    array($r[23], SQLSRV_PARAM_IN),
                    array($r[24], SQLSRV_PARAM_IN),
                    array($r[25], SQLSRV_PARAM_IN),
                    array($r[26], SQLSRV_PARAM_IN),
                    array($r[28], SQLSRV_PARAM_IN),
                    array($r[29], SQLSRV_PARAM_IN),
                    array($r[30], SQLSRV_PARAM_IN),
                    array($r[31], SQLSRV_PARAM_IN),
                    array($r[32], SQLSRV_PARAM_IN),
                    array($r[33], SQLSRV_PARAM_IN),
                    array($r[34], SQLSRV_PARAM_IN),
                    array($r[35], SQLSRV_PARAM_IN),
                    array($r[36], SQLSRV_PARAM_IN),
                    array($r[37], SQLSRV_PARAM_IN),
                    array($r[38], SQLSRV_PARAM_IN),
                    array($r[4], SQLSRV_PARAM_IN),
                    array($r[5], SQLSRV_PARAM_IN),
                    array($r[6], SQLSRV_PARAM_IN),
                    array($r[9], SQLSRV_PARAM_IN),
                    array($r[11], SQLSRV_PARAM_IN),
                    array($r[12], SQLSRV_PARAM_IN),
                    array($r[20], SQLSRV_PARAM_IN),
                    array($r[21], SQLSRV_PARAM_IN),
                    array($r[22], SQLSRV_PARAM_IN),
                    array($r[54], SQLSRV_PARAM_IN),
                    array($r[56], SQLSRV_PARAM_IN),
                    array($r[59], SQLSRV_PARAM_IN),
                    array($r[62], SQLSRV_PARAM_IN),
                    array($r[63], SQLSRV_PARAM_IN),
                    array($r[64], SQLSRV_PARAM_IN),
                    array($r[65], SQLSRV_PARAM_IN),
                    array($r[66], SQLSRV_PARAM_IN),
                    array($r[67], SQLSRV_PARAM_IN),
                    array($r[68], SQLSRV_PARAM_IN),
                    array($r[69], SQLSRV_PARAM_IN),
                    array($r[70], SQLSRV_PARAM_IN),
                    array($r[71], SQLSRV_PARAM_IN),
                    array($r[72], SQLSRV_PARAM_IN),
                    array($r[3], SQLSRV_PARAM_IN),
                    array($ori_filename , SQLSRV_PARAM_IN),
                    array($user, SQLSRV_PARAM_IN),
                );

            $sql = "EXEC SP_SOREK_SIMPAN
                        @THBLREK = ?,
                        @UNITUPI = ?,
                        @UNITAP = ?,
                        @UNITUP = ?,
                        @IDPEL = ?,
                        @PEMDA = ?,
                        @NAMA = ?,
                        @TARIF = ?,
                        @DAYA = ?,
                        @KDPT = ?,
                        @KDPT_2 = ?,
                        @KOGOL = ?,
                        @KDDK = ?,
                        @SLALWBP = ?,
                        @SAHLWBP = ?,
                        @SLAWBP = ?,
                        @SAHWBP = ?,
                        @SLAKVARH = ?,
                        @SAHKVARH = ?,
                        @DAYAMAKS = ?,
                        @JAMNYALA = ?,
                        @SAHLWBP_CABUT = ?,
                        @SLALWBP_PASANG = ?,
                        @SAHWBP_CABUT = ?,
                        @SLAWBP_PASANG = ?,
                        @SLAKVARH_PASANG = ?,
                        @SAHKVARH_CABUT = ?,
                        @FAKM = ?,
                        @FAKMKVARH = ?,
                        @PEMKWH = ?,
                        @RPPTL = ?,
                        @RPTB = ?,
                        @RPPPN = ?,
                        @RPBPJU = ?,
                        @RPSEWATRAFO = ?,
                        @RPSEWAKAP = ?,
                        @RPANGSA = ?,
                        @RPANGSB = ?,
                        @RPANGSC = ?,
                        @RPMAT = ?,
                        @RPPLN = ?,
                        @RPTAG = ?,
                        @RPBK1 = ?,
                        @RPBK2 = ?,
                        @RPBK3 = ?,
                        @NOBANG = ?,
                        @KETNOBANG = ?,
                        @RT = ?,
                        @RW = ?,
                        @KDGARDU = ?,
                        @NAMAGARDU = ?,
                        @KDPROSESKLP = ?,
                        @POSTINGBILLING = ?,
                        @MSG = ?,
                        @KELBKVARH = ?,
                        @DAYAMAX_WBP = ?,
                        @SUBKOGOL = ?,
                        @TGLCABUTPASANG = ?,
                        @DLPD = ?,
                        @DLPD_LM = ?,
                        @DLPD_FKM = ?,
                        @DLPD_KVARH = ?,
                        @DLPD_3BLN = ?,
                        @DLPD_JNSMUTASI = ?,
                        @DLPD_TGLBACA = ?,
                        @ALASAN_KOREKSI = ?,
                        @JAMNYALA600 = ?,
                        @JAMNYALA400 = ?,
                        @ALAMAT = ?,
                        @FILENAME = ?, 
                        @USERID = ? ";
            $stmt = sqlsrv_prepare($conn, $sql, $params);

            if(sqlsrv_execute($stmt)){
                $sukses++;
            }else{
                $gagal++;
            }
        }

        $i++;
    }

    $params = array(
                    array($blth, SQLSRV_PARAM_IN),
                    array($unitupi, SQLSRV_PARAM_IN),
                    array($unitap, SQLSRV_PARAM_IN),
                    array($unitup, SQLSRV_PARAM_IN),
                    array($user, SQLSRV_PARAM_IN),
                );

            $sql = "EXEC SP_REKAP_SOREK_GENERATE
                        @BLTH = ?,
                        @UNITUPI = ?,
                        @UNITAP = ?,
                        @UNITUP = ?, 
                        @USERID = ? ";
            $stmt = sqlsrv_prepare($conn, $sql, $params);

            if(sqlsrv_execute($stmt)){
                $response['rekap'] = 'BERHASIL';
            }else{
                $response['rekap'] = 'GAGAL';
            }

    $response['success'] = true;
    $response['sukses'] = $sukses;
    $response['gagal'] = $gagal;
}else {
    $response['success'] = false;
    $response['msg'] = SimpleXLS::parseError();
}

unlink('../../../assets/uploads/'.$filename);

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);
?>

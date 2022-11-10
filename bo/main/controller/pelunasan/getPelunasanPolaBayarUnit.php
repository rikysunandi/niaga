<?php

session_start();
set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$id = $_SESSION['userid']%5;
$user = $_SESSION['username'];

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC SP_VW_CREATE_PELUNASAN_POLA_BAYAR @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

$response = array();

// $stmt = sqlsrv_query($conn, "select * from vw_Create_Percepatan_Unit order by PERCEPATAN DESC");
if($stmt){
    $i=0;
    $j=0;
    $response['total_plg']=0;
    $awal_lancar;
    $awal_baru;
    $awal_irisan;
    $akum_lancar=0;
    $akum_baru=0;
    $akum_irisan=0;
    $saldo_lancar=0;
    $saldo_baru=0;
    $saldo_irisan=0;
    $response['rows'] = array();

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

        if($i==0){
            $awal_lancar = $row['TARGET_LANCAR'];
            $awal_baru = $row['TARGET_BARU'];
            $awal_irisan = $row['TARGET_IRISAN'];
        }

        $akum_lancar += ($row['JML_LANCAR'])?$row['JML_LANCAR']:0;
        $akum_baru += ($row['JML_BARU'])?$row['JML_BARU']:0;
        $akum_irisan += ($row['JML_IRISAN'])?$row['JML_IRISAN']:0;

        
        $saldo_lancar = $awal_lancar - $akum_lancar ;
        $saldo_baru = $awal_baru - $akum_baru ;
        $saldo_irisan = $awal_irisan - $akum_irisan ;
        
        $response['awal_baru'][$i] = $awal_baru;
        if(substr($row['TANGGAL'],0,6)==$blth)
            $response['tanggal'][$i] = str_replace('99', 'N+', substr($row['TANGGAL'],-2)); 
        else
            $response['tanggal'][$i] = str_replace('99', 'N+', substr($row['TANGGAL'],-4));
        $response['target_lancar'][$i] = $row['TARGET_LANCAR'];
        $response['target_baru'][$i] = $row['TARGET_BARU'];
        $response['target_irisan'][$i] = $row['TARGET_IRISAN'];
        $response['jml_lancar'][$i] = ($row['JML_LANCAR'])? $saldo_lancar: NULL;
        $response['jml_baru'][$i] = ($row['JML_BARU'])? $saldo_baru: NULL;
        $response['jml_irisan'][$i] = ($row['JML_IRISAN'])? $saldo_irisan: NULL;

        if($i>0){

            if(substr($row['TANGGAL'],0,6)==$blth)
                $response['rows'][$j]['TANGGAL'] = str_replace('00', 'N-1', substr($row['TANGGAL'],-2));
            else
                $response['rows'][$j]['TANGGAL'] = str_replace('00', 'N-1', substr($row['TANGGAL'],-4));
            $response['rows'][$j]['TARGET_LANCAR'] = ($row['TARGET_LANCAR']>=0)?($row['TARGET_LANCAR']):'';
            $response['rows'][$j]['TARGET_BARU'] = ($row['TARGET_BARU']>=0)?($row['TARGET_BARU']):'';
            $response['rows'][$j]['TARGET_IRISAN'] = ($row['TARGET_IRISAN']>=0)?($row['TARGET_IRISAN']):'';
            $response['rows'][$j]['TARGET_TOTAL'] = '';

            //($row['TARGET_LANCAR']+$row['TARGET_BARU']+$row['TARGET_IRISAN']);

            if($row['TANGGAL']<=date('Ymd')){
                $response['rows'][$j]['AWAL_LANCAR'] = ($sal_lancar_lalu)? ($sal_lancar_lalu): '';
                $response['rows'][$j]['AWAL_BARU'] = ($sal_baru_lalu)? ($sal_baru_lalu): '';
                $response['rows'][$j]['AWAL_IRISAN'] = ($sal_irisan_lalu)? ($sal_irisan_lalu): '';
                $response['rows'][$j]['AWAL_TOTAL'] = ($sal_lancar_lalu+$sal_baru_lalu+$sal_irisan_lalu);
                $response['rows'][$j]['JML_LANCAR'] = ($row['JML_LANCAR']>=0)?($row['JML_LANCAR']):'';
                $response['rows'][$j]['JML_BARU'] = ($row['JML_BARU']>=0)?($row['JML_BARU']):'';
                $response['rows'][$j]['JML_IRISAN'] = ($row['JML_IRISAN']>=0)?($row['JML_IRISAN']):'';
                $response['rows'][$j]['JML_TOTAL'] = ($row['JML_LANCAR']+$row['JML_BARU']+$row['JML_IRISAN']);
                $response['rows'][$j]['SALDO_LANCAR'] = ($row['JML_LANCAR']>=0)? ($saldo_lancar): '';
                $response['rows'][$j]['SALDO_BARU'] = ($row['JML_BARU']>=0)? ($saldo_baru): '';
                $response['rows'][$j]['SALDO_IRISAN'] = ($row['JML_IRISAN']>=0)? ($saldo_irisan): '';
                $response['rows'][$j]['SALDO_TOTAL'] = ($saldo_lancar+$saldo_baru+$saldo_irisan);

                $real_lancar = (2-(max(1,$saldo_lancar)/max(1,$row['TARGET_LANCAR'])));
                $real_baru = (2-(max(1,$saldo_baru)/max(1,$row['TARGET_BARU'])));
                $real_irisan = (2-(max(1,$saldo_irisan)/max(1,$row['TARGET_IRISAN'])));
                $real_total = (2-(max(1,($saldo_lancar+$saldo_baru+$saldo_irisan))/max(1,($row['TARGET_LANCAR']+$row['TARGET_BARU']+$row['TARGET_IRISAN'])) ));
                $real_lancar = max(0, $real_lancar);
                $real_baru = max(0, $real_baru);
                $real_irisan = max(0, $real_irisan);
                $real_total = max(0, $real_total);

                $response['rows'][$j]['REAL_LANCAR']=($row['TARGET_LANCAR']<>'')? ($real_lancar*100): '';
                $response['rows'][$j]['REAL_BARU']=($row['TARGET_BARU']<>'')? ($real_baru*100): '';
                $response['rows'][$j]['REAL_IRISAN']=($row['TARGET_IRISAN']<>'')? ($real_irisan*100): '';
                $response['rows'][$j]['REAL_TOTAL']=($row['TARGET_TOTAL']<>'')?($real_total*100):'';

            }else{
                $response['rows'][$j]['AWAL_LANCAR'] = '';
                $response['rows'][$j]['AWAL_BARU'] = '';
                $response['rows'][$j]['AWAL_IRISAN'] = '';
                $response['rows'][$j]['AWAL_TOTAL'] = '';
                $response['rows'][$j]['JML_LANCAR'] = '';
                $response['rows'][$j]['JML_BARU'] = '';
                $response['rows'][$j]['JML_IRISAN'] = '';
                $response['rows'][$j]['JML_TOTAL'] = '';
                $response['rows'][$j]['SALDO_LANCAR'] = '';
                $response['rows'][$j]['SALDO_BARU'] ='';
                $response['rows'][$j]['SALDO_IRISAN'] = '';
                $response['rows'][$j]['SALDO_TOTAL'] = '';
                $response['rows'][$j]['REAL_LANCAR'] = '';
                $response['rows'][$j]['REAL_BARU'] ='';
                $response['rows'][$j]['REAL_IRISAN'] = '';
                $response['rows'][$j]['REAL_TOTAL'] = '';

            }

            $j++;
        }

        $sal_irisan_lalu = $saldo_irisan;
        $sal_baru_lalu = $saldo_baru;
        $sal_lancar_lalu = $saldo_lancar;
        $sal_total_lalu = $saldo_total;

        //$response['jml_irisan'][$i] = ($row['JML_IRISAN'] || $row['TANGGAL']<=date('d'))? $saldo_irisan: NULL;
        // $response['jml_lancar'][$i] = $row['JML_LANCAR'];
        // $response['jml_baru'][$i] = $row['JML_BARU'];
        // $response['jml_irisan'][$i] = $row['JML_IRISAN'];


        $i++;
    }

    $response['blth'] = $blth;
    $response['success'] = true;
    sqlsrv_free_stmt($stmt);


}else{
    $response['success'] = false;
    $response['msg'] = 'Gagal melakukan Query ke Database';
}



sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($response);

?>
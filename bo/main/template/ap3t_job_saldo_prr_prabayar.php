<?php


set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once 'ap3t_login.php';

echo '<span class="text-success">Job Saldo PRR Prabayar '.date('Y-m-d H:i:s').'</span><br/>';
echo '<span class="text-success">Berhasil Login AP3T..</span><br/>';

$authorization = $token;

$context = stream_context_create(array(
    'http' => array(
        'header' => "Authorization: " . $authorization,
    ),
));
$stmt = sqlsrv_query($conn, "TRUNCATE TABLE AP3T_SALDO_PRR ");
if(!$stmt){
	echo '<span class="text-warning">Gagal mereset Saldo PRR di ROC..</span><br/>'; die();
}

sqlsrv_free_stmt($stmt);

echo '<span class="text-success">Berhasil mereset Saldo PRR di ROC..</span><br/>';

$stmt = sqlsrv_query($conn, "select UNITUPI, UNITAP, UNITUP, NAMA from m_unitup order by UNITAP, UNITUP ");

if($stmt){

	echo '<span class="text-success">Berhasil mengambil data unit..</span><br/>';

	$i=0;

	while( $unit = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		echo '<hr/>';
		echo '<span class="text-success">Mengambil Saldo ULP '.$unit['NAMA'].'..</span><br/>';
		$j=0;
		do{
			$api_url = 'http://10.68.35.105:8081/monitoring-saldo-prr/get-detil-saldo-prr-pra?unit-upi=53&unit-ap='.$unit['UNITAP'].'&unit-up='.$unit['UNITUP'].'&id-user=8810496Z&sort-by=idPel&sort-dir=asc&page='.($j+1).'&limit=50';
			//echo $api_url;
			$result = file_get_contents($api_url, false, $context);
			//echo $result;die();
			$data =  json_decode($result);
		// print_r($data);

		    if (count($data->data)) {

		        // Cycle through the array
		        foreach ($data->data as $idx => $row) {

					$params = array(
					        array($row->noagenda, SQLSRV_PARAM_IN),
							array($row->noregister, SQLSRV_PARAM_IN),
							array($row->idpel, SQLSRV_PARAM_IN),
							array($row->nama, SQLSRV_PARAM_IN),
							array($row->jenisPiutang, SQLSRV_PARAM_IN),
							array($row->rptagPrr, SQLSRV_PARAM_IN),
							array($row->tglmasukPrr, SQLSRV_PARAM_IN),
							array($row->tgkoreksi, SQLSRV_PARAM_IN),
							array($row->kdgerakmasukPrr, SQLSRV_PARAM_IN),
							array($row->unitUp, SQLSRV_PARAM_IN),
							array($row->tarif, SQLSRV_PARAM_IN),
							array($row->daya, SQLSRV_PARAM_IN),
							array($row->rpptlPrr, SQLSRV_PARAM_IN),
							array($row->rpbptrafoPrr, SQLSRV_PARAM_IN),
							array($row->rpsewatrafoPrr, SQLSRV_PARAM_IN),
							array($row->rpsewakapPrr, SQLSRV_PARAM_IN),
							array($row->rpangsuranbpPrr, SQLSRV_PARAM_IN),
							array($row->rpangsuranp2tlPrr, SQLSRV_PARAM_IN),
							array($row->rpangsurankwhPrr, SQLSRV_PARAM_IN),
							array($row->rpangsuranprrPrr, SQLSRV_PARAM_IN),
							array($row->rpangsuranprrhapusPrr, SQLSRV_PARAM_IN),
							array($row->rpbkPrr, SQLSRV_PARAM_IN),
							array($row->rpadministrasiPrr, SQLSRV_PARAM_IN),
							array($row->rpmaterialPrr, SQLSRV_PARAM_IN),
							array($row->rpsegelPrr, SQLSRV_PARAM_IN),
							array($row->rpsambungPrr, SQLSRV_PARAM_IN),
							array($row->ketStatuspenetapan, SQLSRV_PARAM_IN),
							array($unit['UNITUPI'], SQLSRV_PARAM_IN),
							array($unit['UNITAP'], SQLSRV_PARAM_IN),
					    );

					$sql_insert = "EXEC SP_AP3T_SALDO_PRR_SIMPAN @noagenda=?, @noregister=?, @idpel=?, @nama=?, @jenisPiutang=?, @rptagPrr=?, @tglmasukPrr=?, @tgkoreksi=?, @kdgerakmasukPrr=?, @unitUp=?, @tarif=?, @daya=?, @rpptlPrr=?, @rpbptrafoPrr=?, @rpsewatrafoPrr=?, @rpsewakapPrr=?, @rpangsuranbpPrr=?, @rpangsuranp2tlPrr=?, @rpangsurankwhPrr=?, @rpangsuranprrPrr=?, @rpangsuranprrhapusPrr=?, @rpbkPrr=?, @rpadministrasiPrr=?, @rpmaterialPrr=?, @rpsegelPrr=?, @rpsambungPrr=?, @ketStatuspenetapan=?, @unitupi=?, @unitap=? ";

					$stmt_insert = sqlsrv_prepare($conn, $sql_insert, $params);

					if(sqlsrv_execute($stmt_insert)){
						echo '<span class="text-success">Noagenda '.$row->noagenda.' berhasil disimpan..</span><br/>';

					}else{
						echo '<span class="text-warning">Noagenda '.$row->noagenda.' gagal disimpan:..</span><br/>';
						if( ($errors = sqlsrv_errors() ) != null) {
					        foreach( $errors as $error ) {
					            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					            echo "code: ".$error[ 'code']."<br />";
					            echo "message: ".$error[ 'message']."<br />";
					        }
					    }
					}
		        }

		    }
		    $j++;
		}while($j<ceil($data->rows/50));

		$i++;
	}



}else{
	echo '<span class="text-warning">Gagal melakukan Query ke Database..</span>';
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


?>
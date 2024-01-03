<?php


set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once 'ap3t_login.php';

$tgl_job = date('Y-m-d H:i:s');
echo '<span class="text-success">Job Saldo Piutang Prabayar '.$tgl_job.'</span><br/>';
echo '<span class="text-success">Berhasil Login AP3T..</span><br/>';

$authorization = $token;

$context = stream_context_create(array(
    'http' => array(
        'header' => "Authorization: " . $authorization,
    ),
));

$stmt = sqlsrv_query($conn, "select UNITUPI, UNITAP, UNITUP, NAMA from m_unitup WHERE UNITAP IN ('53BKS','53CKG') order by UNITAP, UNITUP ");

if($stmt){

	echo '<span class="text-success">Berhasil mengambil data unit..</span><br/>';

	$i=0;

	while( $unit = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		require 'ap3t_login.php';

		$authorization = $token;

		$context = stream_context_create(array(
		    'http' => array(
		        'header' => "Authorization: " . $authorization,
		    ),
		));
		
		echo '<hr/>';
		echo '<span class="text-success">Mengambil Saldo ULP '.$unit['NAMA'].'..</span><br/>';
		$j=0;
		do{
			
			$api_url = 'http://10.68.35.105:8081/monitoring-saldo-piutang-pra/get-detil-saldo-piutang-pss?sort-dir=ASC&sort-by=IDPEL&unit-ap='.$unit['UNITAP'].'&unit-up='.$unit['UNITUP'].'&unit-upi=53&skema-bayar=NO%20REGISTER&id-user=8810496Z&limit=50&page='.($j+1).'&limit=50';
			//echo $api_url;
			$result = file_get_contents($api_url, false, $context);
			//echo $result;die();
			$data =  json_decode($result);
		// print_r($data);

		    if (count($data->data)) {

		        // Cycle through the array
		        foreach ($data->data as $idx => $row) {

					$params = array(
					        array($row->noAgenda, SQLSRV_PARAM_IN),
							array($row->noRegister, SQLSRV_PARAM_IN),
							array($row->idPel, SQLSRV_PARAM_IN),
							array($row->nama, SQLSRV_PARAM_IN),
							array($row->jenisPiutang, SQLSRV_PARAM_IN),
							array($row->rpTag, SQLSRV_PARAM_IN),
							array($row->tglJatuhTempo, SQLSRV_PARAM_IN),
							array($row->tglEntri, SQLSRV_PARAM_IN),
							array($row->kdGerakMasuk, SQLSRV_PARAM_IN),
							array($row->unitUp, SQLSRV_PARAM_IN),
							array($row->tarif, SQLSRV_PARAM_IN),
							array($row->daya, SQLSRV_PARAM_IN),
							array($row->rpPtl, SQLSRV_PARAM_IN),
							array($row->rpBpTrafo, SQLSRV_PARAM_IN),
							array($row->rpSewaTrafo, SQLSRV_PARAM_IN),
							array($row->rpSewaKap, SQLSRV_PARAM_IN),
							array($row->rpAngsuranBp, SQLSRV_PARAM_IN),
							array($row->rpAngsuranP2tl, SQLSRV_PARAM_IN),
							array($row->rpAngsuranKwh, SQLSRV_PARAM_IN),
							array($row->rpAngsuranPrr, SQLSRV_PARAM_IN),
							array($row->rpAngsuranPrrHapus, SQLSRV_PARAM_IN),
							array($row->rpBk, SQLSRV_PARAM_IN),
							array($row->rpMaterai, SQLSRV_PARAM_IN),
							array($row->rpMaterial, SQLSRV_PARAM_IN),
							array($row->rpPpn, SQLSRV_PARAM_IN),
							array($row->rpPpju, SQLSRV_PARAM_IN),
							array($row->ketStatuspenetapan, SQLSRV_PARAM_IN),
							array($row->skemaBayar, SQLSRV_PARAM_IN),
							array($unit['UNITUPI'], SQLSRV_PARAM_IN),
							array($unit['UNITAP'], SQLSRV_PARAM_IN),
							array($tgl_job, SQLSRV_PARAM_IN),
					    );

					$sql_insert = "EXEC SP_AP3T_SALDO_PRABAYAR_SIMPAN @noagenda=?, @noregister=?, @idpel=?, @nama=?, @jenisPiutang=?, @rptag=?, @tglJatuhTempo=?, @tglEntri=?, @kdgerakmasuk=?, @unitUp=?, @tarif=?, @daya=?, @rpptl=?, @rpbptrafo=?, @rpsewatrafo=?, @rpsewakap=?, @rpangsuranbp=?, @rpangsuranp2tl=?, @rpangsurankwh=?, @rpangsuranPrr=?, @rpangsuranprrhapus=?, @rpbk=?, @rpMaterai=?, @rpmaterial=?, @rpPpn=?, @rpPpju=?, @ketStatuspenetapan=?, @skemaBayar=?, @unitupi=?, @unitap=?, @tgl_job=? ";

					$stmt_insert = sqlsrv_prepare($conn, $sql_insert, $params);

					if(sqlsrv_execute($stmt_insert)){
						echo '<span class="text-success">Noagenda '.$row->noAgenda.' berhasil disimpan..</span><br/>';

					}else{
						echo '<span class="text-warning">Noagenda '.$row->noAgenda.' gagal disimpan:..</span><br/>';
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


		echo '<span class="text-success">Selesai mengambil Saldo ULP '.$unit['NAMA'].'..</span><br/>';

		$i++;
	}


	$stmt = sqlsrv_query($conn, "DELETE AP3T_SALDO_PRABAYAR WHERE tgl_job < '".$tgl_job."'");
	if($stmt){
		echo '<span class="text-success">Berhasil mereset Saldo PRABAYAR sebelumnya di ROC..</span><br/>';
	}else{
		echo '<span class="text-warning">Gagal mereset Saldo PRABAYAR di ROC..</span><br/>';
	}

}else{
	echo '<span class="text-warning">Gagal melakukan Query ke Database..</span>';
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


?>
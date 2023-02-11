<?php


set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once 'ap3t_login.php';

$tgl_awal = '01/02/2023';
$tgl_akhir = '06/02/2023';

$tgl_job = date('Y-m-d H:i:s');
echo '<span class="text-success">Job Saldo Pelunasan Prabayar '.$tgl_awal.' sd '.$tgl_akhir.' per '.$tgl_job.'</span><br/>';
echo '<span class="text-success">Berhasil Login AP3T..</span><br/>';

$authorization = $token;

$context = stream_context_create(array(
    'http' => array(
        'header' => "Authorization: " . $authorization,
    ),
));

$stmt = sqlsrv_query($conn, "select UNITUPI, UNITAP, UNITUP, NAMA from m_unitup order by UNITAP, UNITUP ");

if($stmt){

	echo '<span class="text-success">Berhasil mengambil data unit..</span><br/>';

	$i=0;

	while( $unit = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		echo '<hr/>';
		echo '<span class="text-success">Mengambil Pelunasan Prabayar ULP '.$unit['NAMA'].'..</span><br/>';
		$j=0;
		do{
			$api_url = 'http://10.68.35.105:8081/monitoring-pelunasan/get-detil-lunas-piutang-pss?unit-upi=53&unit-ap='.$unit['UNITAP'].'&unit-up='.$unit['UNITUP'].'&skema-bayar=NO+REGISTER&kd-gerak-keluar=SEMUA&tgl-awal='.$tgl_awal.'&tgl-akhir='.$tgl_akhir.'&sort-by=idPel&sort-dir=asc&page='.($j+1).'&limit=50&id-user=8810496Z';
			//echo $api_url;
			$result = file_get_contents($api_url, false, $context);
			//echo $result;die();
			$data =  json_decode($result);
		// print_r($data);

		    if (count($data->data)) {

		        // Cycle through the array
		        foreach ($data->data as $idx => $row) {
					$params = array(
					        array($row->skemaBayar, SQLSRV_PARAM_IN),
							array($row->noAgenda, SQLSRV_PARAM_IN),
							array($row->noRegister, SQLSRV_PARAM_IN),
							array($row->idPel, SQLSRV_PARAM_IN),
							array($row->nama, SQLSRV_PARAM_IN),
							array($row->unitUp, SQLSRV_PARAM_IN),
							array($row->tarif, SQLSRV_PARAM_IN),
							array($row->daya, SQLSRV_PARAM_IN),
							array($row->jenisPiutang, SQLSRV_PARAM_IN),
							array($row->kdGerakMasuk, SQLSRV_PARAM_IN),
							array($row->kdGerakKeluar, SQLSRV_PARAM_IN),
							array($row->tglBayar, SQLSRV_PARAM_IN),
							array($row->wktBayar, SQLSRV_PARAM_IN),
							array($row->tglTransaksi, SQLSRV_PARAM_IN),
							array($row->rpTag, SQLSRV_PARAM_IN),
							array($row->rpPtl, SQLSRV_PARAM_IN),
							array($row->rpBpTrafo, SQLSRV_PARAM_IN),
							array($row->rpSewaTrafo, SQLSRV_PARAM_IN),
							array($row->rpSewaKap, SQLSRV_PARAM_IN),
							array($row->rpAngsuranBp, SQLSRV_PARAM_IN),
							array($row->rpAngsuranP2Tl, SQLSRV_PARAM_IN),
							array($row->rpAngsuranKwh, SQLSRV_PARAM_IN),
							array($row->rpAngsuranPrr, SQLSRV_PARAM_IN),
							array($row->rpAngsuranPrrHapus, SQLSRV_PARAM_IN),
							array($row->rpPpn, SQLSRV_PARAM_IN),
							array($row->rpPpju, SQLSRV_PARAM_IN),
							array($row->rpMaterai, SQLSRV_PARAM_IN),
							array($row->rpBk, SQLSRV_PARAM_IN),
							array($row->rpMaterial, SQLSRV_PARAM_IN),
							array($row->rpSegel, SQLSRV_PARAM_IN),
							array($row->rpSambung, SQLSRV_PARAM_IN),
							array($row->rpSewaTrafoRpSewaTrafo, SQLSRV_PARAM_IN),
							array($unit['UNITUPI'], SQLSRV_PARAM_IN),
							array($unit['UNITAP'], SQLSRV_PARAM_IN),
							array($tgl_job, SQLSRV_PARAM_IN),
					    );

					$sql_insert = "EXEC SP_AP3T_PELUNASAN_SIMPAN @skemaBayar=?, @noAgenda=?, @noRegister=?, @idPel=?, @nama=?, @unitUp=?, @tarif=?, @daya=?, @jenisPiutang=?, @kdGerakMasuk=?, @kdGerakKeluar=?, @tglBayar=?, @wktBayar=?, @tglTransaksi=?, @rpTag=?, @rpPtl=?, @rpBpTrafo=?, @rpSewaTrafo=?, @rpSewaKap=?, @rpAngsuranBp=?, @rpAngsuranP2Tl=?, @rpAngsuranKwh=?, @rpAngsuranPrr=?, @rpAngsuranPrrHapus=?, @rpPpn=?, @rpPpju=?, @rpMaterai=?, @rpBk=?, @rpMaterial=?, @rpSegel=?, @rpSambung=?, @rpSewaTrafoRpSewaTrafo=?, @unitupi=?, @unitap=?, @tgl_job=? ";

					$stmt_insert = sqlsrv_prepare($conn, $sql_insert, $params);

					if(sqlsrv_execute($stmt_insert)){
						echo '<span class="text-success">Pelunasan Noregister '.$row->noRegister.' berhasil disimpan..</span><br/>';

					}else{
						echo '<span class="text-warning">Pelunasan Noregister '.$row->noRegister.' gagal disimpan:..</span><br/>';
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

		echo '<span class="text-success">Selesai mengambil Pelunasan Prabayar ULP '.$unit['NAMA'].'..</span><br/>';
		$i++;
	}

    // Close the table
    echo "</table>";


}else{
	echo'Gagal melakukan Query ke Database';
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


?>
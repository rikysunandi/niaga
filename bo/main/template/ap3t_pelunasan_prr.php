<?php


set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once 'ap3t_login.php';

$authorization = $token;

$context = stream_context_create(array(
    'http' => array(
        'header' => "Authorization: " . $authorization,
    ),
));

$stmt = sqlsrv_query($conn, "select UNITUPI, UNITAP, UNITUP, NAMA from m_unitup order by UNITAP, UNITUP ");

if($stmt){

	// Open the table
	echo "<table border='1'>";
	echo "<thead>";
		echo "<tr>";
			echo "<td>unitAp</td>";
			echo "<td>unitUp</td>";
			echo "<td>noagenda</td>";
			echo "<td>noregister</td>";
			echo "<td>idpel</td>";
            echo "<td>nama</td>";
            echo "<td>tarif</td>";
            echo "<td>daya</td>";
            echo "<td>jenisPiutang</td>";
            echo "<td>kdGerakMasuk</td>";
            echo "<td>kdGerakKeluar</td>";
            echo "<td>tglBayar</td>";
            echo "<td>wktBayar</td>";
            echo "<td>tglTransaksi</td>";
            echo "<td>rpTag</td>";
            echo "<td>rpPtl</td>";
            echo "<td>rpAngsuranBp</td>";
            echo "<td>rpAngsuranP2Tl</td>";
            echo "<td>rpAngsuranKwh</td>";
            echo "<td>rpAngsuranPrr</td>";
            echo "<td>rpAngsuranPrrHapus</td>";
            echo "<td>rpPpju</td>";
		echo "</tr>";
	echo "</thead>";

	flush();
	ob_flush();

	$i=0;

	while( $unit = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		echo $unit['UNITAP'].'-'.$unit['UNITUP'].'-'.$unit['NAMA'].'<br/>';
		$j=0;
		do{
			$api_url = 'http://10.68.35.105:8081/monitoring-pelunasan/get-detil-lunas-prr-pra?unit-upi=53&unit-ap='.$unit['UNITAP'].'&unit-up='.$unit['UNITUP'].'&id-user=8810496Z&tgl-awal=01%2F01%2F2023&tgl-akhir=31%2F01%2F2023&sort-by=idPel&sort-dir=asc&page='.($j+1).'&limit=50';
			//echo $api_url;
			$result = file_get_contents($api_url, false, $context);
			//echo $result;die();
			$data =  json_decode($result);
		// print_r($data);

		    if (count($data->data)) {

		        // Cycle through the array
		        foreach ($data->data as $idx => $row) {

		            // Output a row
		            echo "<tr>";
		            echo "<td>".$unit['UNITAP']."</td>";
		            echo "<td>".$unit['UNITUP']."</td>";
		            echo "<td>$row->noAgenda</td>";
		            echo "<td>$row->noRegister</td>";
		            echo "<td>$row->idPel</td>";
		            echo "<td>$row->nama</td>";
		            echo "<td>$row->tarif</td>";
		            echo "<td>$row->daya</td>";
		            echo "<td>$row->jenisPiutang</td>";
		            echo "<td>$row->kdGerakMasukPrr</td>";
		            echo "<td>$row->kdGerakKeluarPrr</td>";
		            echo "<td>$row->tglBayarPrr</td>";
		            echo "<td>$row->wktBayarPrr</td>";
		            echo "<td>$row->tglTransaksiPrr</td>";
		            echo "<td>$row->rpTagPrr</td>";
		            echo "<td>$row->rpPtlPrr</td>";
		            echo "<td>$row->rpAngsuranBpPrr</td>";
		            echo "<td>$row->rpAngsuranP2TlPrr</td>";
		            echo "<td>$row->rpAngsuranKwhPrr</td>";
		            echo "<td>$row->rpAngsuranPrrPrr</td>";
		            echo "<td>$row->rpAngsuranPrrHapusPrr</td>";
		            echo "<td>$row->rpPpjuPrr</td>";
		            echo "</tr>";

					flush();
					ob_flush();
		        }

		    }
		    $j++;
		}while($j<ceil($data->rows/50));

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
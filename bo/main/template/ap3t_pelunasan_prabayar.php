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

$stmt = sqlsrv_query($conn, "select UNITAP, UNITUP from m_unitup order by UNITAP, UNITUP ");

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

		$j=0;
		do{
			$api_url = 'http://10.68.35.105:8081/monitoring-pelunasan/get-detil-lunas-piutang-pss?unit-upi=53&unit-ap='.$unit['UNITAP'].'&unit-up='.$unit['UNITUP'].'&skema-bayar=NO+REGISTER&kd-gerak-keluar=SEMUA&tgl-awal=01%2F05%2F2023&tgl-akhir=29%2F05%2F2023&sort-by=idPel&sort-dir=asc&page='.($j+1).'&limit=50&id-user=8810496Z';
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
		            echo "<td>$row->kdGerakMasuk</td>";
		            echo "<td>$row->kdGerakKeluar</td>";
		            echo "<td>$row->tglBayar</td>";
		            echo "<td>$row->wktBayar</td>";
		            echo "<td>$row->tglTransaksi</td>";
		            echo "<td>$row->rpTag</td>";
		            echo "<td>$row->rpPtl</td>";
		            echo "<td>$row->rpAngsuranBp</td>";
		            echo "<td>$row->rpAngsuranP2Tl</td>";
		            echo "<td>$row->rpAngsuranKwh</td>";
		            echo "<td>$row->rpAngsuranPrr</td>";
		            echo "<td>$row->rpAngsuranPrrHapus</td>";
		            echo "<td>$row->rpPpju</td>";
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
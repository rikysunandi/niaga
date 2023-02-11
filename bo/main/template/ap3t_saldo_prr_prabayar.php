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
			echo "<td>jenisPiutang</td>";
			echo "<td>rptagPrr</td>";
			echo "<td>tglmasukPrr</td>";
			echo "<td>tgkoreksi</td>";
			echo "<td>kdgerakmasukPrr</td>";
			echo "<td>tarif</td>";
			echo "<td>daya</td>";
			echo "<td>rpptlPrr</td>";
			echo "<td>rpangsuranbpPrr</td>";
			echo "<td>rpangsuranp2tlPrr</td>";
			echo "<td>rpangsurankwhPrr</td>";
			echo "<td>rpangsuranprrPrr</td>";
			echo "<td>rpangsuranprrhapusPrr</td>";
			echo "<td>rpbkPrr</td>";
		echo "</tr>";
	echo "</thead>";

	flush();
	ob_flush();

	$i=0;

	while( $unit = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

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

		            // Output a row
		            echo "<tr>";
		            echo "<td>".$unit['UNITAP']."</td>";
		            echo "<td>".$unit['UNITUP']."</td>";
		            echo "<td>$row->noagenda</td>";
		            echo "<td>$row->noregister</td>";
		            echo "<td>$row->idpel</td>";
		            echo "<td>$row->nama</td>";
		            echo "<td>$row->jenisPiutang</td>";
		            echo "<td>$row->rptagPrr</td>";
		            echo "<td>$row->tglmasukPrr</td>";
		            echo "<td>$row->tgkoreksi</td>";
		            echo "<td>$row->kdgerakmasukPrr</td>";
		            echo "<td>$row->tarif</td>";
		            echo "<td>$row->daya</td>";
		            echo "<td>$row->rpptlPrr</td>";
		            echo "<td>$row->rpangsuranbpPrr</td>";
		            echo "<td>$row->rpangsuranp2tlPrr</td>";
		            echo "<td>$row->rpangsurankwhPrr</td>";
		            echo "<td>$row->rpangsuranprrPrr</td>";
		            echo "<td>$row->rpangsuranprrhapusPrr</td>";
		            echo "<td>$row->rpbkPrr</td>";
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
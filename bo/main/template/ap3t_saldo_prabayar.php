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
			echo "<td>koGol</td>";
			echo "<td>jenisTransaksi</td>";
			echo "<td>ketStatusPenetapan</td>";
			echo "<td>rpTag</td>";
			echo "<td>rpPtl</td>";
			echo "<td>rpAngsuranBp</td>";
			echo "<td>rpAngsuranP2tl</td>";
			echo "<td>rpAngsuranKwh</td>";
			echo "<td>rpAngsuranPrr</td>";
			echo "<td>rpAngsuranPrrHapus</td>";
			echo "<td>rpPpn</td>";
			echo "<td>rpPpju</td>";
			echo "<td>rpMaterai</td>";
			echo "<td>rpBk</td>";
		echo "</tr>";
	echo "</thead>";

	$i=0;

	while( $unit = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		$api_url = 'http://10.68.35.105:8081/monitoring-saldo-piutang-pra/get-rekap-saldo-piutang-pss?sort-dir=ASC&sort-by=IDPEL&unit-ap='.$unit['UNITAP'].'&unit-up='.$unit['UNITUP'].'&unit-upi=53&skema-bayar=NO%20REGISTER&id-user=8810496Z&limit=50&page=1';
		//echo $api_url;
		$result = file_get_contents($api_url, false, $context);

		$data =  json_decode($result);
		//print_r($data);

		    if (count($data->data)) {

		        // Cycle through the array
		        foreach ($data->data as $idx => $row) {

		            // Output a row
		            echo "<tr>";
		            echo "<td>".$unit['UNITAP']."</td>";
		            echo "<td>$row->unitUp</td>";
		            echo "<td>$row->koGol</td>";
		            echo "<td>$row->jenisTransaksi</td>";
		            echo "<td>$row->ketStatusPenetapan</td>";
		            echo "<td>$row->rpTag</td>";
		            echo "<td>$row->rpPtl</td>";
		            echo "<td>$row->rpAngsuranBp</td>";
		            echo "<td>$row->rpAngsuranP2tl</td>";
		            echo "<td>$row->rpAngsuranKwh</td>";
		            echo "<td>$row->rpAngsuranPrr</td>";
		            echo "<td>$row->rpAngsuranPrrHapus</td>";
		            echo "<td>$row->rpPpn</td>";
		            echo "<td>$row->rpPpju</td>";
		            echo "<td>$row->rpMaterai</td>";
		            echo "<td>$row->rpBk</td>";
		            echo "</tr>";
		        }

		    }

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
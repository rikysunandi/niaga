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

$j=0;
do{
	$api_url = 'http://10.68.35.105:8081/koreksi-piutang/get-koreksi-piutang-kddkrp-pss?page='.($j+1).'&limit=50';
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
            echo "<td>$row->transactionId</td>";
            echo "<td>$row->idPel</td>";
            echo "<td>$row->noRegister</td>";
            echo "<td>$row->jenisKoreksi</td>";
            echo "<td>$row->tglJatuhTempoLama</td>";
            echo "<td>$row->tglJatuhTempoBaru</td>";
            echo "<td>$row->unitUp</td>";
            echo "</tr>";

			flush();
			ob_flush();
        }

    }
    $j++;
}while($j<ceil($data->rows/50));

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


?>
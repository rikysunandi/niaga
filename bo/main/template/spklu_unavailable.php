<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="60" />
	<title>Update SPKLU Unavailable</title>
</head>
<body>

<?php

set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';
//require_once 'ap3t_login.php';

$authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyNzIiLCJpYXQiOjE3MDQwMzEyNjJ9.jKq2jb4nUR9LWt3TQSLntdzXpp1CzRPsnWXBzGuUlpw";

$context = stream_context_create(array(
    'http' => array(
        'header' => array(
        		"Authorization: " . $authorization,
        		"Origin: https://g20.pln.co.id",
        		"Referer: https://g20.pln.co.id/",
        		"Sec-Fetch-Mode: cors",
        		"Sec-Fetch-Site: same-site",
        		"Connection: keep-alive",
        	)
    ),
));


$api_url = 'https://dashspkluapi.pln.co.id/dashboardSpklu/detail-unavailable?q=jawa%20barat&sort=&page=0&size=20';
//echo $api_url;
$result = file_get_contents($api_url, false, $context);

$data =  json_decode($result);
//print_r($data);

	echo $data->message." - tgl update: ".$data->time." ".strtotime($data->time);
	echo "<hr/>";

    if (count($data->data->content)) {


    		echo "<table border='1'>";
			echo "<thead>";
				echo "<tr>";
					echo "<td>unit</td>";
					echo "<td>charger</td>";
					echo "<td>statusDateSecondAgo</td>";
					echo "<td>statusName</td>";
					echo "<td>kapasitas</td>";
					echo "<td>spkluName</td>";
					echo "<td>merek</td>";
					echo "<td>keterangan</td>";
				echo "</tr>";
			echo "</thead>";

        // Cycle through the array
        foreach ($data->data->content as $idx => $row) {

            // Output a row
            echo "<tr>";
            echo "<td>$row->unit</td>";
            echo "<td>$row->charger</td>";
            echo "<td>$row->statusDateSecondAgo</td>";
            echo "<td>$row->statusName</td>";
            echo "<td>$row->kapasitas</td>";
            echo "<td>$row->spkluName</td>";
            echo "<td>$row->merek</td>";
            echo "<td>";

			$params = array(
			        array(strtotime($data->time), SQLSRV_PARAM_IN),
			        array($data->time, SQLSRV_PARAM_IN),
			        array($row->unit, SQLSRV_PARAM_IN),
			        array($row->charger, SQLSRV_PARAM_IN),
			        array($row->statusDateSecondAgo, SQLSRV_PARAM_IN),
			        array($row->statusName, SQLSRV_PARAM_IN),
			        array($row->kapasitas, SQLSRV_PARAM_IN),
			        array($row->spkluName, SQLSRV_PARAM_IN),
			        array($row->merek, SQLSRV_PARAM_IN),
			        array($row->unit, SQLSRV_PARAM_IN),
			        array($row->unit, SQLSRV_PARAM_IN),
			    );

			$sql = "EXEC SP_JOB_SPKLU_UNAVAILABLE @timestamp_csms = ?, @waktu_csms = ?, @unit = ?, @charger = ?, @statusDateSecondAgo = ?, @statusName = ?, @kapasitas = ?, @spkluName = ?, @merek = ? ";
			$stmt = sqlsrv_prepare($conn, $sql, $params);

		    echo (sqlsrv_execute($stmt))?'Data berhasil disimpan</td>':'Data gagal disimpan</td>';
            echo "</tr>";

            // $userkey = 'd405db91fb71';
			// $passkey = 'ab16be0dad1eaab68a718564';
			// $telepon = '082186777723';
			// $message = 'Monitoring SPKLU Unavailable. '.$row->spkluName.' - Charger: '.$row->charger.' - Status:'.$row->statusName.' - Kapasitas'.$row->kapasitas.' - Waktu: '.$row->statusDateSecondAgo;
			// $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
			// $curlHandle = curl_init();
			// curl_setopt($curlHandle, CURLOPT_URL, $url);
			// curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			// curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			// curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
			// curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			// curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
			// curl_setopt($curlHandle, CURLOPT_POST, 1);
			// curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
			//     'userkey' => $userkey,
			//     'passkey' => $passkey,
			//     'to' => $telepon,
			//     'message' => $message
			// ));
			// $results = json_decode(curl_exec($curlHandle), true);
			// curl_close($curlHandle);

			sqlsrv_free_stmt($stmt);

        }

    }

	$params = array(
	        array(strtotime($data->time), SQLSRV_PARAM_IN)
	    );

	$sql = "EXEC SP_UPDATE_OK_SPKLU_UNAVAILABLE @timestamp_csms = ? ";
	$stmt = sqlsrv_prepare($conn, $sql, $params);

    echo (sqlsrv_execute($stmt))?'Status OK berhasil diupdate</td>':'Status OK gagal diupdate</td>';
	sqlsrv_free_stmt($stmt);

sqlsrv_close($conn);


            
?>

</body>
</html>

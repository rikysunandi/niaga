<?php session_start(); ?>
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

$authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyNzIiLCJpYXQiOjE3MDYzNjY4MDB9.oL7QwVuPj4s5ZXbx1CU_XyR5oI0rjQba_PlcSPs4HoA";

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


$api_url = 'https://dashspkluapi.pln.co.id/dashboardSpklu/detail-unavailable?q=jawa%20barat&sort=statusDateSecondAgo,asc&page=0&size=50';
//echo $api_url;
$result = file_get_contents($api_url, false, $context);

$data =  json_decode($result);
$waktu_notifikasi = str_replace('T',' ',substr($data->time,0,strlen($data->time)-10));
//print_r($data);

if($data->message=='success'){
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
		echo "<tbody>";
        foreach ($data->data->content as $idx => $row) {

            // Output a row
            echo "<tr>";
            echo "<td>$row->unit</td>";
            echo "<td>$row->charger</td>";
            echo "<td>".time_elapsed_string('@'.(strtotime($data->time) - $row->statusDateSecondAgo), true)."</td>";
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

            sqlsrv_free_stmt($stmt);

        }

        echo "</tbody>";
        echo "</table>";

    }

	$params = array(
	        array(strtotime($data->time), SQLSRV_PARAM_IN)
	    );

	$sql = "EXEC SP_UPDATE_OK_SPKLU_UNAVAILABLE @timestamp_csms = ? ";
	$stmt = sqlsrv_prepare($conn, $sql, $params);

    echo (sqlsrv_execute($stmt))?'Status OK berhasil diupdate<br/>':'Status OK gagal diupdate<br/>';

	if($stmt){
		$i=0;
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			
            $txt = generate_notif_ok($data, $row);
            $response = send_wa_message($txt, '6282186777723');

			if($response['message']="Successfully")
				echo "Berhasil kirim notif OK<br/>";
			else
				echo "Gagal kirim notif OK<br/>";

			$response = send_wa_group_message($txt, '120363195657916590@g.us');
			$i++;
		}


	}else{
		echo 'Gagal melakukan Query SP_UPDATE_OK_SPKLU_UNAVAILABLE ke Database';
	}


	$sql = "EXEC SP_UPDATE_NOTIF_SPKLU_UNAVAILABLE @timestamp_csms = ? ";
	$stmt = sqlsrv_prepare($conn, $sql, $params);

    echo (sqlsrv_execute($stmt))?'Status Notif berhasil diupdate<br/>':'Status Notif gagal diupdate<br/>';

	if($stmt){
		$i=0;
		$break = "\n\r";
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

			$txt = '*Monitoring SPKLU Unavailable*.'.$break.$break;
			$txt .= '* Waktu Notifikasi : '.$waktu_notifikasi.$break;
			$txt .= generate_notif_unavailable($data, $row);
			$txt .= 'Ini adalah pesan satu arah, mohon untuk tidak membalas. ';

            $response = send_wa_message($txt, '6282186777723');
			if($response['message']="Successfully")
				echo "Berhasil kirim notif WA<br/>";
			else
				echo "Gagal kirim notif WA<br/>";

			if($row['statusNotif']==0)
				$response = send_wa_group_message($txt, '120363195657916590@g.us');

			$i++;
		}


	}else{
		echo 'Gagal melakukan Query SP_UPDATE_NOTIF_SPKLU_UNAVAILABLE ke Database';
	}


	sqlsrv_free_stmt($stmt);

	$tgl_jam=substr($waktu_notifikasi,0,13);
	$jam=substr(substr($waktu_notifikasi, -8),0,2);
	$waktu_notifikasi_group = array('12','13','14','15','16','20','22');

	if( in_array($jam, $waktu_notifikasi_group ) && $_SESSION['last_notif_group']<>$tgl_jam ){

		$_SESSION['last_notif_group'] = $tgl_jam;

		$sql = "EXEC SP_UPDATE_GROUP_NOTIF_SPKLU_UNAVAILABLE @timestamp_csms = ? ";
		$stmt = sqlsrv_prepare($conn, $sql, $params);

	    echo (sqlsrv_execute($stmt))?'Status Group Notif berhasil diupdate<br/>':'Status Group Notif gagal diupdate<br/>';

		if($stmt){
			$i=0;
			$break = "\n\r";
			$txt_group = '*Monitoring SPKLU Unavailable*.'.$break;
			$txt_group .= 'Waktu Notifikasi : '.$waktu_notifikasi.$break;
			$txt_group .= '------------------------- '.$break.$break;

			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$txt_group .= 'No.'.($i+1).$break.generate_notif_unavailable($data, $row);

				$i++;
			}

			if($i==0){
				$txt_group .= 'Semua SPKLU Available (Online). '.$break.$break;
			}

			$txt_group .= 'Ini adalah pesan satu arah, mohon untuk tidak membalas. ';
			$response = send_wa_group_message($txt_group, '120363195657916590@g.us');


		}else{
			echo 'Gagal melakukan Query SP_UPDATE_GROUP_NOTIF_SPKLU_UNAVAILABLE ke Database';
		}


		sqlsrv_free_stmt($stmt);

	}

	/*
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => json_encode($dataSending),
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json'
	  ),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	var_dump($response);
	*/

}else{

    /*
    	PENGIRIMAN NOTIF WHATSAPP
	*/
    print_r($result);
	$dataSending = Array();
	$dataSending["api_key"] = "DXULXKRCGZLFWQOJ";
	$dataSending["number_key"] = "PZzhqp9JXYwMA3Ta";
	$dataSending["phone_no"] = "6282186777723";

	$kategori = ($row->statusName=='DISCONNECTED')?'Media Komunikasi':'SPKLU';
	$gangguan = ($row->statusName=='DISCONNECTED')?'Jaringan':'SPKLU';
	$break = "\n\r";

	$txt = '*Status Monitoring SPKLU Unavailable*.'.$break.$break;
	$txt .= 'Mohon lakukan pengecekan job Monitoring SPKLU Unavailable';

	$dataSending["message"] = $txt;
	$url = 'https://api.watzap.id/v1/send_message';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_TIMEOUT,30);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataSending));
	$response = json_decode(curl_exec($curl), true);
	curl_close($curl);
}


sqlsrv_close($conn);

function generate_notif_unavailable($data, $row){

    $kategori = ($row['statusName']=='DISCONNECTED')?'Media Komunikasi':'SPKLU';
	$gangguan = ($row['statusName']=='DISCONNECTED')?'Jaringan':'SPKLU';
	$penyebab = ($row['statusName']=='DISCONNECTED')?'Jaringan Tidak Stabil':$row['statusName'];
	$break = "\n\r";

	$txt = '';
	$txt .= '* Lokasi : '.$row['spkluName'].$break;
	$txt .= '* Charger : '.$row['charger'].$break;
	$txt .= '* Status : '.$row['statusName'].$break;
	$txt .= '* Durasi : *'.time_elapsed_string('@'.(strtotime($data->time) - intval($row['statusDateSecondAgo'])), true).'*'.$break;
	$txt .= '* Kategori Penyebab Gangguan : '.$kategori.$break;
	$txt .= '* Gangguan : '.$gangguan.$break;
	$txt .= '* Keterangan Penyebab Gangguan : '.$row['errorDesc'].$break;
	$txt .= '* Penanganan Gangguan : '.$break;
	$txt .= '** Action: '.$row['action_1'].$break;
	$txt .= '** Action Lanjutan: '.$row['action_2'].$break.$break;

	return $txt;
}

function generate_notif_ok($data, $row){

    $kategori = ($row['statusName']=='DISCONNECTED')?'Media Komunikasi':'SPKLU';
	$break = "\n\r";

	$txt = '*'.$row['spkluName'].' sudah kembali Normal*.'.$break.$break;
	$txt .= '* Waktu Notifikasi : '.$waktu_notifikasi.$break;
	$txt .= '* Charger : '.$row['charger'].$break;
	$txt .= '* Durasi Gangguan : *'.time_string('@'.(intval($row['timestamp_insert'])+1), true).'*'.$break;
	$txt .= '* Kategori Penyebab Gangguan : '.$kategori.$break.$break;
	$txt .= 'Terima kasih atas perhatian dan kerjasamanya.'.$break.$break;
	//$txt .= 'Ini adalah pesan satu arah, mohon untuk tidak membalas. ';

	return $txt;
}

function send_wa_message($text, $nohp){

	/*
    	PENGIRIMAN NOTIF WHATSAPP
	*/
	$dataSending = Array();
	$dataSending["api_key"] = "DXULXKRCGZLFWQOJ";
	$dataSending["number_key"] = "PZzhqp9JXYwMA3Ta";
	$dataSending["phone_no"] = $nohp;

	$dataSending["message"] = $text;
	$url = 'https://api.watzap.id/v1/send_message';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_TIMEOUT,30);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataSending));
	$response = json_decode(curl_exec($curl), true);
	curl_close($curl);

	return $response;
}

function send_wa_group_message($text, $group_id){

	/*
    	PENGIRIMAN NOTIF WHATSAPP
	*/
	$dataSending = Array();
	$dataSending["api_key"] = "DXULXKRCGZLFWQOJ";
	$dataSending["number_key"] = "PZzhqp9JXYwMA3Ta";
	$dataSending["group_id"] = $group_id;

	$dataSending["message"] = $text;
	$url = 'https://api.watzap.id/v1/send_message_group';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_TIMEOUT,30);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataSending));
	$response = json_decode(curl_exec($curl), true);
	curl_close($curl);

	return $response;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    /*
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    */
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'saat ini';
    //return $string ? implode(', ', $string) . ' ago' : 'just now';
}
     

function time_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    /*
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    */
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return implode(', ', $string) ; //? implode(', ', $string) . ' yang lalu' : 'saat ini';
    //return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>

</body>
</html>

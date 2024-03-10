<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="90" />
	<title>Update SPKLU Unavailable</title>
</head>
<body>

<?php
set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';

$authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyNzIiLCJpYXQiOjE3MTAwNDM2NTN9.UqnuQfn5qiDViiLTH4Tb39uWAIv4x--9OIBG_5UOqCk";

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
			    );

			$sql = "EXEC SP_JOB_SPKLU_UNAVAILABLE '".strtotime($data->time)."', '".($data->time)."', '".$row->unit."', '".$row->charger."', '".$row->statusDateSecondAgo."', '".$row->statusName."', '".$row->kapasitas."', '".$row->spkluName."', '".$row->merek."' ";
			$stmt = sqlsrv_prepare($conn, $sql, $params);

		    if (sqlsrv_execute($stmt))
		    	echo 'Data berhasil disimpan</td>';
		    else{
		    	echo 'Data gagal disimpan: ' .$sql.'</td>';
		    }
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
            $response = send_wa_message($txt, $row['TL_TE_WA']);
            sleep(rand(1,3));
            $response = send_wa_message($txt, $row['MULP_WA']);
            sleep(rand(1,3));
            $response = send_wa_message($txt, $row['CC_WA1']);
            //sleep(rand(1,3));
            $response = send_wa_message($txt, $row['CC_WA2']);

			if($response['ack']=="successfully")
				echo "Berhasil kirim notif OK<br/>";
			else
				echo "Gagal kirim notif OK<br/>";
			//120363195657916590@g.us SPKLU Jabar?  120363045309946688@g.us
			if($row['statusNotif']>=1){
	            sleep(rand(1,3));
				$response2 = send_wa_group_message($txt, '120363045309946688@g.us');			
				if($response2['ack']=="successfully")
					echo "Berhasil kirim notif OK WA Group<br/>";
				else
					echo "Gagal kirim notif OK WA Group<br/>";
			}
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
            
            $response = send_wa_message($txt, $row['TL_TE_WA']);
            sleep(rand(1,3));
            $response = send_wa_message($txt, $row['MULP_WA']);
            sleep(rand(1,3));
            $response = send_wa_message($txt, $row['CC_WA1']);
            //sleep(rand(1,3));
            $response = send_wa_message($txt, $row['CC_WA2']);
			// if($row['statusNotif']>3){
            // 	$response = send_wa_message($txt, $row['ASMAN_UP3_WA']);
			// }

			if($response['ack']=="successfully")
				echo "Berhasil kirim notif WA<br/>";
			else
				echo "Gagal kirim notif WA<br/>";

			if($row['statusNotif']==1){
				$txt = str_replace('Ini adalah pesan satu arah, mohon untuk tidak membalas. ', '', $txt);
				sleep(rand(1,3));
				$response2 = send_wa_group_message($txt, '120363045309946688@g.us');				
				if($response2['ack']=="successfully")
					echo "Berhasil kirim notif WA Group<br/>";
				else
					echo "Gagal kirim notif WA Group<br/>";
			}

			$i++;
		}


	}else{
		echo 'Gagal melakukan Query SP_UPDATE_NOTIF_SPKLU_UNAVAILABLE ke Database';
	}


	sqlsrv_free_stmt($stmt);

	$tgl_jam=substr($waktu_notifikasi,0,13);
	$jam=substr(substr($waktu_notifikasi, -8),0,2);
	$waktu_notifikasi_group = array('08','12','16','20');

	if( in_array($jam, $waktu_notifikasi_group ) && $_SESSION['notif_group']<>$jam ){

		$_SESSION['notif_group'] = $jam;

		$sql = "EXEC SP_UPDATE_GROUP_NOTIF_SPKLU_UNAVAILABLE @timestamp_csms = ? ";
		$stmt = sqlsrv_prepare($conn, $sql, $params);

	    echo (sqlsrv_execute($stmt))?'Status Group Notif berhasil diupdate<br/>':'Status Group Notif gagal diupdate<br/>';

		if($stmt){
			$i=0;
			$break = "\n\r";
			$txt_group = '*Rekap Monitoring SPKLU Unavailable*.'.$break;
			$txt_group .= 'Waktu Notifikasi : '.$waktu_notifikasi.$break;
			$txt_group .= '-------------------------------------- '.$break.$break;

			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$txt_group .= 'No.'.($i+1).$break.generate_notif_unavailable($data, $row);

				$i++;
			}

			if($i==0){
				$txt_group .= 'Semua Charger SPKLU Available (Online). '.$break;
			}

			$txt_group .= $break.'Terima kasih atas perhatian dan kerjasamanya.'.$break.$break;

			//$txt_group .= 'Ini adalah pesan satu arah, mohon untuk tidak membalas. ';
			sleep(rand(1,3));
			$response = send_wa_group_message($txt_group, '120363045309946688@g.us');				
			if($response['ack']=="successfully")
				echo "Berhasil kirim Rekap notif WA Group<br/>";
			else
				echo "Gagal kirim Rekap notif WA Group<br/>";


		}else{
			echo 'Gagal melakukan Query SP_UPDATE_GROUP_NOTIF_SPKLU_UNAVAILABLE ke Database';
		}


		sqlsrv_free_stmt($stmt);

	}else{
		echo 'Status Group Notif pada periode terakhir sudah dikirim sebelumnya<br/>';
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
	$dataSending["number_key"] = "qMr51iAQwjCjaqZc";
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
	$txt .= '* Penanganan Gangguan : '.$row['action_1'].$break;
	//$txt .= '** Action: '.$row['action_1'].$break;
	$txt .= '* Penanganan Lanjutan: '.$row['action_2'].$break;
	if(strlen($row['KETERANGAN'])>0)
		$txt .= '* Keterangan: '.$row['KETERANGAN'].$break;
		
	$txt .=$break;

	return $txt;
}

function generate_notif_ok($data, $row){

	$waktu_notifikasi=str_replace('T',' ',substr($data->time,0,strlen($data->time)-10));
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
	$dataSending["number_key"] = "qMr51iAQwjCjaqZc";
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
	$dataSending["number_key"] = "qMr51iAQwjCjaqZc";
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

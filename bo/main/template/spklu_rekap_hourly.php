<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="300" />
	<title>Update SPKLU Unavailable</title>
</head>
<body>

<?php
set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';

$waktu_notifikasi	= date('Y-m-d H:i');
$tgl_jam=substr($waktu_notifikasi,0,13);
$jam= date('H'); //substr(substr($waktu_notifikasi, -8),0,2);
$waktu_notifikasi_group = array('08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23');

if( in_array($jam, $waktu_notifikasi_group ) && $_SESSION['notif_group_job']<>$jam ){

	$_SESSION['notif_group_job'] = $jam;

	$sql = "EXEC SP_UPDATE_GROUP_NOTIF_SPKLU_UNAVAILABLE @timestamp_csms = ? ";
	$stmt = sqlsrv_prepare($conn, $sql, $params);

    echo (sqlsrv_execute($stmt))?'Status Group Notif berhasil diupdate<br/>':'Status Group Notif gagal diupdate<br/>';

	if($stmt){
		$i=0;
		$break = "\n\r";
		$txt_group = '*JOB Rekap Monitoring SPKLU Unavailable*.'.$break;
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
		$response = send_wa_message	($txt_group, '6282186777723');				
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

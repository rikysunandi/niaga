<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="120" />
	<title>VCC Mon Keluhan</title>
</head>
<body>

<?php
set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';

$waktu_notifikasi = date('Y-m-d H:i:s');

function parseTanggal($tanggal){
	setlocale(LC_TIME, 'id_ID');

	if($tanggal=='-')
		$tanggal='';
	else
		//	26 Apr 2024 14:25:50 WIB
		$tanggal = date('Y-m-d H:i:s', strtotime(substr($tanggal,0,20)));

	return $tanggal;
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://10.1.88.236/api/outage/table',
  CURLOPT_RETURNTRANSFER => true,
  //CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //CURLOPT_SSL_VERIFYPEER => true,
  CURLOPT_POST => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_SSL_VERIFYHOST => 0,
	CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_POSTFIELDS => array('order[0][column]' => '7', 'order[0][dir]' => 'asc', 'start' => '0','length' => '100','id_unit' => '0','id_area' => '0','id_induk' => '53','id_pusat' => '','type' => 'kl','data' => 'y','tab' => 'keluhan','token' => 'iQkXZ5Iox46K64bDTnxbOtBJZmNJDa3g5PVnwcOLeFKsijycECodFbNdHwYY'),
  // CURLOPT_HTTPHEADER => array(
  //   'Cookie: f5avraaaaaaaaaaaaaaaa_session_=JEHFGEKMMBFFGNAFDIFDCCGHECMBGADBIONNJOKAKBLFBOCCNPILKMLAKNKNMAIHLHIDNFIDGKAAOLNJNFNAFEDCEPIACCDADAKNCPININELHMBJLINCBELCGBKHPEPA; f5avraaaaaaaaaaaaaaaa_session_=ILKKLOCOIPJANJNNKEKPIJPJPGGGFIKIOCBIOJBKGHELGDBPJGKEOEEHJEJDKPGOECDDFNNCONAGEJKAKMHADLEDLPJLFPJMILMDAGGGOGMPINHECGCHCPBIBFBPFACJ; XSRF-TOKEN=eyJpdiI6Ino0VjdLWjRwUzRjY1htZFVuVnFkOFE9PSIsInZhbHVlIjoiOVVjVnVIcXpva2FoMkdaelZDb0FyUTFIdnBwdzVXSlN2RVFJU1JCTDBodkkzVGVha1BlYllDY3JKS3RnT1RrdEZjTTJDK3hhZmdsclhudkh6eHovRTVGOXFlYnZ…VlIjoiZWxJVzdkUUlRRVM5c2Q1eVUzOTJBUmh3WlcvQlUrcVljY29PbEZFV3Q5SXpicGVncVhTVEFQZFdrL0JmRWtZNDN2dDd1YjJKVnFJOVBjTm5UMFhGemQvdmh2UitKYXQ1ZVM0a2hkUnBrT0Juam1Ecmxhbng0NGF2cnBlWVpjQXNReS9iZFZFblZMNHlDSFc1OVZOL1dWTWxBVDVKdGxGVE00dGR1QndWWlY3cnJKV2g1cnRvM2pjZzUzSm5jTEl2dmtLR2tQN01CYUlDM0FDLzRobU9PN0s4Y1NjVWlCakpVb1djVVZ3VnBPZz0iLCJtYWMiOiJlNDc0NDBkMzI5MDNjZjliZDAzMTlhZDliMGJjNjVkNTgzNTI5YWNlZWZjODkxOGY5MTJmN2IyYzc1ZDYzZTU1In0%3D; _ga_929N09011N=GS1.1.1714026528.2.1.1714028060.0.0.0; _ga=GA1.1.1098061170.1713869875',
  //  'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
  //  'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:125.0) Gecko/20100101 Firefox/125.0',
// 	'Accept-Language:en-US,en;q=0.5',
// 	'Host:10.1.88.236',
// 	'Origin:https://10.1.88.236',
// 	'Referer:https://10.1.88.236/outage?type=kl&data=y&tab=keluhan',
// 	'X-Requested-With:XMLHttpRequest',
// 	'Sec-Fetch-Dest:empty',
// 	'Sec-Fetch-Mode:cors',
// 	'Sec-Fetch-Site:same-origin'
  // ),
));

$data = json_decode(curl_exec($curl));
// $status = curl_getinfo($curl);
// echo json_encode($status, JSON_PRETTY_PRINT);
curl_close($curl);
// echo $data->recordsTotal;
// var_dump($data); die();
if($data->recordsTotal>0){
	echo 'recordsTotal: '.$data->recordsTotal." - tgl update: ".date('Y-m-d H:i:s');
	echo "<hr/>";

	echo "<table border='1'>";
	echo "<thead>";
		echo "<tr>";
			echo "<td>No</td>";
			echo "<td>summary</td>";
			echo "<td>customernumber</td>";
			echo "<td>nama_unit</td>";
			echo "<td>reportnumber</td>";
			echo "<td>createdate</td>";
			echo "<td>petugas</td>";
			echo "<td>create_by</td>";
			echo "<td>unit</td>";
			echo "<td>jenis</td>";
			echo "<td>reporteraddress</td>";
			echo "<td>laststatus</td>";
			echo "<td>reportername</td>";
			echo "<td>subjenis</td>";
			echo "<td>reporterphone</td>";
			echo "<td>mobilenumberpetugas</td>";
			echo "<td>walink</td>";
			echo "<td>walink_petugas</td>";
			echo "<td>tglcatat</td>";
			echo "<td>tgl_padam</td>";
			echo "<td>Keterangan</td>";
		echo "</tr>";
	echo "</thead>";

	echo "<tbody>";

	$reportnumbers='';
    foreach ($data->data as $idx => $row) {
    	$reportnumbers .= $row->reportnumber.',';
        // Output a row
        echo "<tr>";
		echo "<td>$row->DT_RowIndex</td>";
        echo "<td>$row->summary</td>";
		echo "<td>$row->customernumber</td>";
		echo "<td>$row->nama_unit</td>";
		echo "<td>$row->reportnumber</td>";
		echo "<td>".parseTanggal($row->createdate)."</td>";
		echo "<td>$row->petugas</td>";
		echo "<td>$row->create_by</td>";
		echo "<td>$row->unit</td>";
		echo "<td>$row->jenis</td>";
		echo "<td>$row->reporteraddress</td>";
		echo "<td>$row->laststatus</td>";
		echo "<td>$row->reportername</td>";
		echo "<td>$row->subjenis</td>";
		echo "<td>$row->reporterphone</td>";
		echo "<td>$row->mobilenumberpetugas</td>";
		echo "<td>$row->walink</td>";
		echo "<td>$row->walink_petugas</td>";
		echo "<td>".parseTanggal($row->tglcatat)."</td>";
		echo "<td>".parseTanggal($row->tgl_padam)."</td>";
        echo "<td>";

		$params = array(
				array($row->summary, SQLSRV_PARAM_IN),
				array($row->customernumber, SQLSRV_PARAM_IN),
				array($row->nama_unit, SQLSRV_PARAM_IN),
				array($row->reportnumber, SQLSRV_PARAM_IN),
				array(parseTanggal($row->createdate), SQLSRV_PARAM_IN),
				array($row->petugas, SQLSRV_PARAM_IN),
				array($row->create_by, SQLSRV_PARAM_IN),
				array($row->unit, SQLSRV_PARAM_IN),
				array($row->jenis, SQLSRV_PARAM_IN),
				array($row->reporteraddress, SQLSRV_PARAM_IN),
				array($row->laststatus, SQLSRV_PARAM_IN),
				array($row->reportername, SQLSRV_PARAM_IN),
				array($row->subjenis, SQLSRV_PARAM_IN),
				array($row->reporterphone, SQLSRV_PARAM_IN),
				array($row->mobilenumberpetugas, SQLSRV_PARAM_IN),
				array($row->walink, SQLSRV_PARAM_IN),
				array($row->walink_petugas, SQLSRV_PARAM_IN),
				array(parseTanggal($row->tglcatat), SQLSRV_PARAM_IN),
				array(parseTanggal($row->tgl_padam), SQLSRV_PARAM_IN),
		    );

		$sql = "EXEC SP_JOB_KELUHAN_APKT '".($row->summary)."', '".($row->customernumber)."', '".$row->nama_unit."', '".$row->reportnumber."', '".parseTanggal($row->createdate)."', '".$row->petugas."', '".$row->create_by."', '".$row->unit."', '".$row->jenis."', '".$row->reporteraddress."', '".$row->laststatus."', '".$row->reportername."', '".$row->subjenis."', '".$row->reporterphone."', '".$row->mobilenumberpetugas."', '".$row->walink."', '".$row->walink_petugas."', '".parseTanggal($row->tglcatat)."', '".parseTanggal($row->tgl_padam)."' ";
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



	$sql = "EXEC SP_UPDATE_NOTIF_KELUHAN_APKT  ";
	$stmt = sqlsrv_prepare($conn, $sql, $params);

    echo (sqlsrv_execute($stmt))?'Status Notif berhasil diupdate<br/>':'Status Notif gagal diupdate<br/>';

	if($stmt){
		$i=0;
		$break = "\n\r";
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

			$txt = '*Notifikasi Keluhan*.'.$break.$break;
			if($row['statusNotif']==0){
				$txt .= '* Waktu Notifikasi : '.$waktu_notifikasi.$break;
				$txt .= generate_notif_keluhan($waktu_notifikasi, $row);
			}else{
				$txt .= 'Laporan No '.$row['reportnumber'].' masih belum ditindaklanjuti sejak *'.time_elapsed_string('@'.(strtotime($row['createdate']->format('Y-m-d H:i:s'))), true).'*. Mohon bantuan untuk segera melakukan tindaklanjut.'.$break.$break;
			}
            sleep(rand(1,3));
            $response = send_wa_message($txt, $row['MULP_WA']);

			if($row['statusNotif']>=1){
				$txt = '*Notifikasi Keluhan belum ditindaklanjuti*.'.$break.$break;

				if($row['statusNotif']==1){
					$txt .= '* Waktu Notifikasi : '.$waktu_notifikasi.$break;
					$txt .= generate_notif_keluhan($waktu_notifikasi, $row);
				}else{
					$txt .= 'Laporan No '.$row['reportnumber'].' masih belum ditindaklanjuti sejak *'.time_elapsed_string('@'.(strtotime($row['createdate']->format('Y-m-d H:i:s'))), true).'*. Mohon bantuan untuk segera melakukan tindaklanjut.'.$break.$break;
				}

				$txt .= 'Ini adalah pesan satu arah, mohon untuk tidak membalas. ';

	            sleep(rand(1,3));
	            $response = send_wa_message($txt, $row['ASMAN_UP3_WA']);
	            // sleep(rand(1,2));
	            // $response = send_wa_message($txt, $row['CC_WA1']);
			}
            
            // $response = send_wa_message($txt, $row['TL_TE_WA']);
            // sleep(rand(1,3));
            // $response = send_wa_message($txt, $row['MULP_WA']);
            //echo 'response: '.$response;
            //sleep(rand(1,3));
            //$response = send_wa_message($txt, $row['CC_WA2']);
			// if($row['statusNotif']>3){
            // 	$response = send_wa_message($txt, $row['ASMAN_UP3_WA']);
			// }

			if($response['ack']=="successfully")
				echo "Berhasil kirim notif WA<br/>";
			else
				echo "Gagal kirim notif WA<br/>";

			// if($row['statusNotif']==0){
			// 	$txt = str_replace('Ini adalah pesan satu arah, mohon untuk tidak membalas. ', '', $txt);
			// 	sleep(rand(1,3));
			// 	$response2 = send_wa_group_message($txt, '120363045309946688@g.us');				
			// 	if($response2['ack']=="successfully")
			// 		echo "Berhasil kirim notif WA Group<br/>";
			// 	else
			// 		echo "Gagal kirim notif WA Group<br/>";
			// }

			$i++;
		}


	}else{
		echo 'Gagal melakukan Query SP_UPDATE_NOTIF_SPKLU_UNAVAILABLE ke Database';
	}

	sqlsrv_free_stmt($stmt);


	$params = array(
	        array($reportnumbers, SQLSRV_PARAM_IN)
	    );

	$sql = "EXEC SP_UPDATE_OK_KELUHAN_APKT '".$reportnumbers."' ";
	$stmt = sqlsrv_prepare($conn, $sql, $params);

    echo (sqlsrv_execute($stmt))?'Status OK berhasil diupdate<br/>':'Status OK gagal diupdate<br/>';

	if($stmt){
		$i=0;

		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			
            $txt = generate_notif_ok($waktu_notifikasi, $row);
            // $response = send_wa_message($txt, $row['TL_TE_WA']);
            sleep(rand(1,3));
            $response = send_wa_message($txt, $row['MULP_WA']);
			if($row['statusNotif']>=1){
	            sleep(rand(1,3));
	            $response = send_wa_message($txt, $row['ASMAN_UP3_WA']);
	            // sleep(rand(1,2));
	            // $response = send_wa_message($txt, $row['CC_WA1']);
	        }
            //echo 'response: '.$response;
            //sleep(rand(1,3));
            //$response = send_wa_message($txt, $row['CC_WA2']);

			if($response['ack']=="successfully")
				echo "Berhasil kirim notif OK<br/>";
			else
				echo "Gagal kirim notif OK<br/>";
			//120363195657916590@g.us SPKLU Jabar?  120363045309946688@g.us
            // sleep(rand(1,3));
			// $response2 = send_wa_group_message($txt, '120363045309946688@g.us');			
			// if($response2['ack']=="successfully")
			// 	echo "Berhasil kirim notif OK WA Group<br/>";
			// else
			// 	echo "Gagal kirim notif OK WA Group<br/>";
			$i++;
		}


	}else{
		echo 'Gagal melakukan Query SP_UPDATE_OK_SPKLU_UNAVAILABLE ke Database';
	}

die();


	$tgl_jam=substr($waktu_notifikasi,0,13);
	$jam=substr(substr($waktu_notifikasi, -8),0,2);
	$waktu_notifikasi_group = array('08','12','16','20','23');

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
				$txt_group .= 'No.'.($i+1).$break.generate_notif_keluhan($data, $row);

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
	$dataSending["number_key"] = "PfGCpsUg3041T3Tz";
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

function generate_notif_keluhan($waktu_notifikasi, $row){
	// echo 'waktu: '.strtotime($waktu_notifikasi).' '.strtotime($row['createdate']->format('Y-m-d H:i:s')).'<br/>';
	$break = "\n\r";

	$txt = '';
	$txt .= '* No : '.$row['reportnumber'].$break;
	$txt .= '* Idpel : '.$row['customernumber'].$break;
	$txt .= '* Unit : '.$row['nama_unit'].$break;
	$txt .= '* Create Date : '.$row['createdate']->format('Y-m-d H:i:s').$break;
	$txt .= '* Create By : '.$row['create_by'].$break;
	$txt .= '* Durasi : *'.time_elapsed_string('@'.(strtotime($row['createdate']->format('Y-m-d H:i:s'))), true).'*'.$break;
	$txt .= '* Reporter : '.$row['reportername'].$break;
	$txt .= '* Phone : '.$row['reporterphone'].$break;
	$txt .= '* Summary : '.$row['summary'].$break;
	$txt .= '* Alamat : '.$row['reporteraddress'].$break;
		
	$txt .=$break;

	return $txt;
}

function generate_notif_ok($waktu_notifikasi, $row){

	//$waktu_notifikasi=str_replace('T',' ',substr($data->time,0,strlen($data->time)-10));
	$break = "\n\r";

	$txt = '*Laporan No '.$row['reportnumber'].' sudah ditindaklanjuti*.'.$break.$break;
	$txt .= '* Idpel : '.$row['customernumber'].$break;
	$txt .= '* Reporter : '.$row['reportername'].$break;
	$txt .= '* Durasi : *'.time_elapsed_string('@'.(strtotime($row['createdate']->format('Y-m-d H:i:s'))), true).'*'.$break;
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
	$dataSending["number_key"] = "PfGCpsUg3041T3Tz";
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
	$dataSending["number_key"] = "PfGCpsUg3041T3Tz";
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

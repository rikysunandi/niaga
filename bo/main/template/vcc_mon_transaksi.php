<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="12000" />
	<title>VCC Mon Transaksi</title>
</head>
<body>

<?php
set_time_limit(-1);
//require_once '../../config/config.php';
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
  CURLOPT_URL => 'https://vcc.pln.co.id/api/rekap/transaksi/table',
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
  CURLOPT_POSTFIELDS => array('start' => '0','length' => '1000','unit_code' => '53461','status' => 'paid','date_start' => '11 May 2024','date_end' => '14 May 2024','token' => 'ulMU4xndYO2p2fcB2qWwOtyRu3KwpnNPImMSkpM5SvshXFu0mPx5S47YjTKD'),
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
//var_dump($data); die();
if($data->recordsTotal>0){
	echo 'recordsTotal: '.$data->recordsTotal." - tgl update: ".date('Y-m-d H:i:s');
	echo "<hr/>";

	echo "<table border='1'>";
	echo "<thead>";
		echo "<tr>";
			echo "<td>No</td>";
			echo "<td>id</td>";
			echo "<td>type</td>";
			echo "<td>title</td>";
			echo "<td>amount</td>";
			echo "<td>status_code</td>";
			echo "<td>name</td>";
			echo "<td>consumer_name</td>";
			echo "<td>meter_id</td>";
			echo "<td>payment_gateway</td>";
			echo "<td>unit_up</td>";
			echo "<td>unit_ap</td>";
			echo "<td>unit_upi</td>";
			echo "<td>created_at</td>";
			echo "<td>user_id</td>";
			echo "<td>meter_account_id</td>";
			echo "<td>token</td>";
			echo "<td>id_pel</td>";
			echo "<td>Keterangan</td>";
		echo "</tr>";
	echo "</thead>";

	echo "<tbody>";

	$ids='';
    foreach ($data->data as $idx => $row) {
    	$ids .= $row->id.',';
        // Output a row
        echo "<tr>";
		echo "<td>$row->DT_RowIndex</td>";
			echo "<td>$row->id</td>";
			echo "<td>$row->type</td>";
			echo "<td>$row->title</td>";
			echo "<td>$row->amount</td>";
			echo "<td>$row->status_code</td>";
			echo "<td>$row->name</td>";
			echo "<td>$row->consumer_name</td>";
			echo "<td>$row->meter_id</td>";
			echo "<td>$row->payment_gateway</td>";
			echo "<td>$row->unit_up</td>";
			echo "<td>$row->unit_ap</td>";
			echo "<td>$row->unit_upi</td>";
			echo "<td>$row->created_at</td>";
			echo "<td>$row->user_id</td>";
			echo "<td>$row->meter_account_id</td>";
			echo "<td>$row->token</td>";
			echo "<td>$row->id_pel</td>";
        echo "<td>";

		$params = array(
				array($row->id, SQLSRV_PARAM_IN),
				array($row->type, SQLSRV_PARAM_IN),
				array($row->title, SQLSRV_PARAM_IN),
				array($row->amount, SQLSRV_PARAM_IN),
				array($row->status_code, SQLSRV_PARAM_IN),
				array($row->name, SQLSRV_PARAM_IN),
				array($row->consumer_name, SQLSRV_PARAM_IN),
				array($row->meter_id, SQLSRV_PARAM_IN),
				array($row->payment_gateway, SQLSRV_PARAM_IN),
				array($row->unit_up, SQLSRV_PARAM_IN),
				array($row->unit_ap, SQLSRV_PARAM_IN),
				array($row->unit_upi, SQLSRV_PARAM_IN),
				array($row->created_at, SQLSRV_PARAM_IN),
				array($row->user_id, SQLSRV_PARAM_IN),
				array($row->meter_account_id, SQLSRV_PARAM_IN),
				array($row->token, SQLSRV_PARAM_IN),
				array($row->id_pel, SQLSRV_PARAM_IN),				
		    );

		$sql = "EXEC SP_JOB_TRANSAKSI_PLNMOBILE  '".($row->id)."', '".($row->type)."', '".($row->title)."', '".($row->amount)."', '".($row->status_code)."', '".($row->name)."', '".($row->consumer_name)."', '".($row->meter_id)."', '".($row->payment_gateway)."', '".($row->unit_up)."', '".($row->unit_ap)."', '".($row->unit_upi)."', '".($row->created_at)."', '".($row->user_id)."', '".($row->meter_account_id)."', '".($row->token)."', '".($row->id_pel)."' ";
		$stmt = sqlsrv_prepare($conn, $sql, $params);

	    if (sqlsrv_execute($stmt))
	    	echo 'Data berhasil disimpan</td>';
	    else{
	    	echo 'Data gagal disimpan: ' .$sql.'</td>';
	    }
        echo "</td></tr>";

        sqlsrv_free_stmt($stmt);

    }

    echo "</tbody>";
    echo "</table>";
    die();


	$sql = "EXEC SP_UPDATE_NOTIF_KELUHAN_APKT  ";
	$stmt = sqlsrv_prepare($conn, $sql, $params);

    echo (sqlsrv_execute($stmt))?'Status Notif berhasil diupdate<br/>':'Status Notif gagal diupdate<br/>';

	if($stmt){
		$i=0;
		$break = "\n\r";
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

			$txt = '*Notifikasi Keluhan*.'.$break.$break;
			if($row['statusNotif']==0){
				$txt .= '- Waktu Notifikasi : '.$waktu_notifikasi.$break;
				$txt .= generate_notif_keluhan($waktu_notifikasi, $row);
			}else{
				$txt .= 'Laporan Keluhan di '.$row['nama_unit'].' No '.$row['reportnumber'].' masih belum ditindaklanjuti sejak *'.time_elapsed_string('@'.(strtotime($waktu_notifikasi)), '@'.(strtotime($row['createdate']->format('Y-m-d H:i:s'))), true).'*. Mohon bantuan untuk segera melakukan tindaklanjut.'.$break.$break;
			}
			
			$txt .= '_Ini adalah pesan satu arah, mohon untuk tidak membalas._';

            sleep(rand(1,3));
            $response = send_wa_message($txt, $row['MULP_WA']);

			if($row['statusNotif']>=1){
				$txt = '*Notifikasi Keluhan belum ditindaklanjuti*.'.$break.$break;

				if($row['statusNotif']==1){
					$txt .= '- Waktu Notifikasi : '.$waktu_notifikasi.$break;
					$txt .= generate_notif_keluhan($waktu_notifikasi, $row);
				}else{
					$txt .= 'Laporan Keluhan di '.$row['nama_unit'].' No '.$row['reportnumber'].' masih belum ditindaklanjuti sejak *'.time_elapsed_string('@'.(strtotime($waktu_notifikasi)), '@'.(strtotime($row['createdate']->format('Y-m-d H:i:s'))), true).'*. Mohon bantuan untuk segera melakukan tindaklanjut.'.$break.$break;
				}

				$txt .= '_Ini adalah pesan satu arah, mohon untuk tidak membalas._';

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
            $txt .= '_Ini adalah pesan satu arah, mohon untuk tidak membalas._';
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
	$dataSending["number_key"] = "pmFcRbd9UVVXa24l";
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
	$txt .= '- No : '.$row['reportnumber'].$break;
	$txt .= '- Idpel : '.$row['customernumber'].$break;
	$txt .= '- Unit : '.$row['nama_unit'].$break;
	$txt .= '- Create Date : '.$row['createdate']->format('Y-m-d H:i:s').$break;
	$txt .= '- Create By : '.$row['create_by'].$break;
	$txt .= '- Durasi : *'.time_string('@'.(strtotime($waktu_notifikasi)), '@'.(strtotime($row['createdate']->format('Y-m-d H:i:s'))), true).'*'.$break;
	$txt .= '- Reporter : '.$row['reportername'].$break;
	$txt .= '- Phone : '.$row['reporterphone'].$break;
	$txt .= '- Summary : '.$row['summary'].$break;
	$txt .= '- Alamat : '.$row['reporteraddress'].$break;
		
	$txt .=$break;

	return $txt;
}

function generate_notif_ok($waktu_notifikasi, $row){

	//$waktu_notifikasi=str_replace('T',' ',substr($data->time,0,strlen($data->time)-10));
	$break = "\n\r";

	$txt = '*Laporan No '.$row['reportnumber'].' sudah ditindaklanjuti* ✅'.$break.$break;
	$txt .= '- Waktu Notifikasi : '.$waktu_notifikasi.$break;
	$txt .= '- Idpel : '.$row['customernumber'].$break;
	$txt .= '- Unit : '.$row['nama_unit'].$break;
	$txt .= '- Reporter : '.$row['reportername'].$break;
	$txt .= '- Durasi : *'.time_string('@'.(strtotime($waktu_notifikasi)), '@'.(strtotime($row['createdate']->format('Y-m-d H:i:s'))), true).'*'.$break;
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
	$dataSending["number_key"] = "pmFcRbd9UVVXa24l";
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
	$dataSending["number_key"] = "pmFcRbd9UVVXa24l";
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

function time_elapsed_string($waktu, $datetime, $full = false) {
    $now = new DateTime($waktu);
    //$now = $now->createFromFormat('Y-m-d H:i:s', $waktu_notifikasi);
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
     

function time_string($waktu, $datetime, $full = false) {
    $now = new DateTime($waktu);
    //$now = $now->createFromFormat('Y-m-d H:i:s', $waktu_notifikasi);
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

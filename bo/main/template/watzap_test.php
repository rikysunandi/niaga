<?php

$response = send_wa_message('test 123 dari php','6282186777723');
var_dump($response);
$response2 = send_wa_group_message('...', '120363195657916590@g.us');
var_dump($response2);



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


	// $dataSending = Array();
	// $dataSending["api_key"] = "DXULXKRCGZLFWQOJ";
	// $dataSending["number_key"] = "0K98swNjuQbsgyTK";
	// $url = 'https://api.watzap.id/v1/groups';
	// $curl = curl_init();
	// curl_setopt($curl, CURLOPT_URL, $url);
	// curl_setopt($curl, CURLOPT_HEADER, 0);
	// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	// curl_setopt($curl, CURLOPT_TIMEOUT,30);
	// curl_setopt($curl, CURLOPT_POST, 1);
	// curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	// curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataSending));
	// $response = json_decode(curl_exec($curl), true);
	// curl_close($curl);
	// print_r( $response );

?>

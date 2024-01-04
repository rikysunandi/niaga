<?php

$response = queryKCT('532115745680');
var_dump($response);

function queryKCT($idpel){

	$httpHeader = Array();
	$httpHeader["Cookie"] = "JSESSIONID=09B4F26DE75186C605C5BA1ADD0B028E";
	$httpHeader["Origin"] = "http://10.68.35.74:8080";
	$httpHeader["X-GWT-Module-Base"] = "http://10.68.35.74:8080/kct-web/ap2t/";
	$httpHeader["X-GWT-Permutation"] = "32AEE8563B920F07641BD36B7E2776F0";
	$httpHeader["Content-Type"] = "text/x-gwt-rpc; charset=utf-8";
	$httpHeader["Connection"] = "keep-alive";
	$httpHeader["Accept-Encoding"] = "gzip, deflate, br";

	$body = "7|0|7|http://10.68.35.74:8080/kct-web/ap2t/|D6F5DCF2A7FFAB7D396D6E6B510C4BA6|id.co.iconpln.ap2t.client.service.GwtTransService|getDataInfoKCT|java.lang.String/2004016611|532115745680|8810496Z|1|2|3|4|2|5|5|6|7|";

	$url = 'http://10.68.35.74:8080/kct-web/ap2t/springGwtServices/gwtTransService';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	//curl_setopt($curl, CURLOPT_HEADER, $httpHeader);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeader);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	// curl_setopt($curl, CURLOPT_TIMEOUT,30);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
	$response = json_decode(curl_exec($curl), true);
	curl_close($curl);

	return $response;
}
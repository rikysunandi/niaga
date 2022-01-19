<?php
ini_set("xdebug.var_display_max_children", -1);
ini_set("xdebug.var_display_max_data", -1);
ini_set("xdebug.var_display_max_depth", -1);
// set post fields
$post = [
    'blth' => '062020',
    'idpel' => '536210470593',
    'btn_ok'   => 'OK',
    'PHPSESSID' => '5n0a3jjfao0l05ko1v2lrh3pd3'
];


try {

	//PHPSESSID=gfdv9rk4m6m1ruivev6ii10344
	$ch = curl_init('https://p2apst.pln.co.id/dacen/modules/info_rek.php');

    // Check if initialization had gone wrong*    
    if ($ch === false) {
        throw new Exception('failed to initialize');
    }

	$header[] = 'Content-length: 40 
Content-type: application/x-www-form-urlencoded 
Cookie: PHPSESSID=5n0a3jjfao0l05ko1v2lrh3pd3 
Host: p2apst.pln.co.id
User-Agent:"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:49.0) Gecko/20100101 Firefox/49.0"
Connection:"keep-alive"';
	$certificate = "D:\wamp64\cacert.pem";

	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $certificate);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

	// execute!
	$response = curl_exec($ch);

	if ($response === false) {
        throw new Exception(curl_error($ch), curl_errno($ch));
    }

	echo '<pre>';
	var_dump($response);
	echo '</pre>';

	curl_close($ch);


}catch(Exception $e) {

    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);

}

?>
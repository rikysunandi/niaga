<?php


set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';

$url = "http://10.68.35.105:8081/auth/do-login";
$data = array(
  'username'      => '8810496Z',
  'password'      => 'P@ssw0rd202404'
);

$options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode( $data ),
    'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
    )
);

$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );
$response = json_decode( $result );

//var_dump($response);
// echo $response->data->keterangaDepartemen;
// echo '<br/>';
$token =  $response->data->token;

//echo $token;
// echo '<br/>';

?>
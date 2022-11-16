<?php
	if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
	    session_start();
	}
	$key = $_POST['key'];
	$value = $_POST['value'];
	
	$response = array();
	if($_SESSION[$key]=$value)
		$response['success']=true;
	else
		$response['success']=false;

	header( 'Content-Type: application/json; charset=utf-8' );
	echo json_encode($response);

?>
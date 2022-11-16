<?php
	
	if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
	    session_start();
	}
	$key = $_GET['key'];
	$unset = $_GET['unset'];

	$response = array();
	if(isset($_SESSION[$key])){
		$response['success']=true;
		$response['value']=$_SESSION[$key];
		if($unset=='Y')
			unset($_SESSION[$key]);
	}else{
		$response['success']=false;
		$response['value']=var_dump($_SESSION);
	}

	header( 'Content-Type: application/json; charset=utf-8' );
	echo json_encode($response);
?>
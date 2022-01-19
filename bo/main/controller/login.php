<?php
session_start();

require_once '../../config/config.php';
require_once '../../config/database.php';

$do_login = ($_POST['do_login']);
$access = ($_POST['access']);

$response = array();

if( $do_login == hash('sha256', date('YmdH')) ){

	$stmt = sqlsrv_query($conn, "SELECT * FROM m_user WHERE password = '$access' ");
	if($stmt){
		$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

		$aktif = ($row['status']=='A')?true:false;
		$my_unitupi = $row['unitupi'];
		$my_unitap = $row['unitap'];
		$my_unitup = $row['unitup'];
		$username = $row['username'];
		$nohp = $row['nohp'];
		session_regenerate_id(true);
		$_SESSION['username'] = $username;
		$_SESSION['unitupi'] = $my_unitupi;	
		$_SESSION['unitap'] = $my_unitap;		
		$_SESSION['unitup'] = $my_unitup;	
		$response['success'] = true;

	}else{
		$response['success'] = false;
		$response['msg'] = 'Gagal mengeksekusi query database';
	}
}else{
	$response['success'] = false;
	$response['msg'] = 'Ada kekeliruan pada data Waktu Login';
	$response['do_login'] = hash('sha256', date('Ymdh'));
	$response['date'] = date('Ymdh');
}


echo json_encode($response);
 
 
function getRealIpAddr()
{
 	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
 	{
 		$ip=$_SERVER['HTTP_CLIENT_IP'];
 	}
 	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
 	{
 		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 	}
 	else
 	{
 		$ip=$_SERVER['REMOTE_ADDR'];
 	}
 	return $ip;
}

function hashSSHA($password, $salt)
{

	//$salt = sha1(rand());
	//$salt = substr($salt, 0, 10);
	$hash = base64_encode( sha1($password . $salt, true) . $salt );
	return $hash;
}
?>
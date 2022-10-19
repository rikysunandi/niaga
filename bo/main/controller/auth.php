<?php
session_start();

require_once '../../config/config.php';
require_once '../../config/database.php';

$do_login = ($_POST['do_login']);
$access = ($_POST['access']);
$username = ($_POST['username']);
$password = ($_POST['password']);

$response = array();

if ($ldapconn) 
{
    $ldapbind = ldap_bind($ldapconn, $username, $password);
    if ($ldapbind) 
    {
        $response['success'] = true;
		$response['msg'] = "LDAP bind successful...";
    }
    else 
    {
        $response['success'] = false;
        $response['msg'] = "LDAP bind failed...";
    }
}
// $Result = ldap_search($ldapconn, AD_DomainName, "(samaccountname=$username)", array("dn"));
// $data = ldap_get_entries($ldapconn, $Result);

// $response['data']=$data;

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
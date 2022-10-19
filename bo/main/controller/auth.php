<?php
session_start();

require_once '../../config/config.php';
require_once '../../config/database.php';

$do_login = ($_POST['do_login']);
$access = ($_POST['access']);
$username = ($_POST['username']);
$password = ($_POST['password']);

$response = array();


//LDAP Pusat
$AD_Server     = "10.1.8.20";
//$AD_Server     = "10.1.8.22";
//$AD_Server     = "10.1.8.190";
//$AD_Server     = '10.2.1.52';

$AD_DomainName = 'DC=pusat,DC=corp,DC=pln,DC=co,DC=id';           // Domain DN
$AD_UsnPostfix = '@pusat.corp.pln.co.id';                         // username with read access
//$AD_DomainName = 'DC=jabar,DC=corp,DC=pln,DC=co,DC=id';
//$AD_UsnPostfix = '@jabar.corp.pln.co.id';

$ldapconn = ldap_connect($AD_Server);
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

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
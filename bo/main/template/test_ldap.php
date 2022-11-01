<?php


ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'On');
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
	$username='riky.sunandi';
	$password='S@nd1202210';
    $ldapbind = ldap_bind($ldapconn, $username, $password);
    if ($ldapbind) 
    {
    	echo 'berhasil';
    	echo $ldapbind;
    }
}else{
	echo 'gagal';
}
?>
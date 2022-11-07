<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

$do_login = ($_POST['do_login']);
$access = ($_POST['access']);
$username = ($_POST['username']);
$password = ($_POST['password']);

$response = array();


$stmt = sqlsrv_query($conn, "select TOP 1 * from m_user where username='$username' order by NAMA");
if($stmt){
    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
    $userid = $row['userid']; 
    $unitupi = $row['unitupi']; 
    $unitap = $row['unitap']; 
    $unitup = $row['unitup']; 
    $nama = $row['nama']; 
    $keterangan = $row['keterangan']; 
    $email = $row['email']; 
    $nohp = $row['nohp']; 
    $avatar = $row['avatar']; 
    $hashpassword = $row['password']; 
    $active_directory = $row['active_directory']; 

    if($active_directory=='Y'){
        $AD_Server     = "10.1.8.20";
        $AD_DomainName = 'DC=pusat,DC=corp,DC=pln,DC=co,DC=id';           // Domain DN
        $AD_UsnPostfix = '@pusat.corp.pln.co.id';                  
        $ldapconn = ldap_connect($AD_Server);
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

        if ($ldapconn) 
        {
            $ldap_userdomain = 'pusat\\'.$username;
            $ldapbind = ldap_bind($ldapconn, $ldap_userdomain, $password);
            if ($ldapbind) 
            {

                $response['success'] = true;
                $response['msg'] = "Login Active Directory berhasil";

                $attributes = array("displayname", "mail", "samaccountname");
                $result = ldap_search($ldap_conn, $AD_DomainName, "(samaccountname=".$username.")");                         
                $entries = ldap_get_entries($ldapconn, $result);                        
                if(count($entries) > 0){
                    $givenname = $entries[0]['givenname'][0];
                    $displayname = $entries[0]['displayname'][0];
                    $samaccountname =  $entries[0]['samaccountname'][0];
                    $company =  $entries[0]['company'][0];
                    $department =  $entries[0]['department'][0];
                    $mail =  $entries[0]['mail'][0];
                    $telephonenumber =  $entries[0]['telephonenumber'][0];
                    $description =  $entries[0]['description'][0];
                    $response['success'] = true;
                }
                
                $timeout = (15*60);
                //Set the maxlifetime of the session
                ini_set( "session.gc_maxlifetime", $timeout );
                //Set the cookie lifetime of the session
                ini_set( "session.cookie_lifetime", $timeout );
                session_start();
                $_SESSION['userid'] = $userid;
                $_SESSION['username'] = $username;
                $_SESSION['unitupi'] = $unitupi;
                $_SESSION['unitap'] = $unitap;
                $_SESSION['unitup'] = $unitup;
                $_SESSION['nama'] = $nama;
                $_SESSION['keterangan'] = $keterangan;
                $_SESSION['email'] = $email;
                $_SESSION['nohp'] = $nohp;
                $_SESSION['avatar'] = $avatar;
                $_SESSION['active_directory'] = $active_directory;
            }
            else 
            {
                $response['success'] = false;
                $response['msg'] = "Login gagal, silahkan masukan password email anda dengan benar";
            }
        }else 
        {
            $response['success'] = false;
            $response['msg'] = "Gagal melakukan koneksi ke Server Email";
        }

    }else{

        if(password_verify($password, $hashpassword)){
            $response['success'] = true;
            $response['msg'] = "Login berhasil";
            
            $timeout = (15*60);
            //Set the maxlifetime of the session
            ini_set( "session.gc_maxlifetime", $timeout );
            //Set the cookie lifetime of the session
            ini_set( "session.cookie_lifetime", $timeout );
            session_start();
            $_SESSION['userid'] = $userid;
            $_SESSION['username'] = $username;
            $_SESSION['unitupi'] = $unitupi;
            $_SESSION['unitap'] = $unitap;
            $_SESSION['unitup'] = $unitup;
            $_SESSION['nama'] = $nama;
            $_SESSION['keterangan'] = $keterangan;
            $_SESSION['email'] = $email;
            $_SESSION['nohp'] = $nohp;
            $_SESSION['avatar'] = $avatar;
            $_SESSION['active_directory'] = $active_directory;
        }
        else 
        {
            $response['success'] = false;
            $response['msg'] = "Login gagal, silahkan masukan password anda dengan benar";
        }
    }

}else{
    $response['success'] = false;
    $response['msg'] = 'Gagal mengambil data User';
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
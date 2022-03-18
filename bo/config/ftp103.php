<?php


    $ftp_server = "10.2.1.103";
	$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
	$login = ftp_login($ftp_conn, 'ftpniaga', '123');

	
?>
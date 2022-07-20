<?php

$serverName = "10.2.1.57";
$connectionOptions = array(
    "database" => "NIAGA",
    "uid" => "sa",
    "pwd" => "sqlsvr1q2w3e@@",
    "CharacterSet" => "UTF-8",
    // "Encrypt"=>true,
    // "TrustServerCertificate"=>true

);

	$conn = sqlsrv_connect($serverName, $connectionOptions);
	if ($conn === false) {
	    die(print_r(sqlsrv_errors()));
	}
?>
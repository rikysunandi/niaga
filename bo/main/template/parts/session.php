<?php 

ob_start();

if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
$_SESSION['ref_url'] = curPageURL();

if(empty($_SESSION['username'])){
	header('location: login.php');
}

function curPageURL() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

?>

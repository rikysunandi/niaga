<?php 


function authShop($partnerId, $partnerKey) {   
    global $host;
    $path = "/api/v2/shop/auth_partner";
    $redirectUrl = "https://www.baidu.com/";

    $timest = time();
    $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
    $sign = hash_hmac('sha256', $baseString, $partnerKey);
    $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s&redirect=%s", $host, $path, $partnerId, $timest, $sign, $redirectUrl);
    return $url;
}

$host="https://partner.shopeemobile.com";

$partnerId = 844031;
$partnerKey = "6bc3ff192ae477e3b26e79944ebbc546b75a2f370c9a500bd6bb7fc6adb0c286";

echo authShop($partnerId, $partnerKey);
?>
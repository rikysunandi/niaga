<?php 

function getTokenShopLevel($code, $partnerId, $partnerKey, $shopId) {
    global $host;
    $path = "/api/v2/auth/token/get";
    
    $timest = time();
    $body = array("code" => $code,  "shop_id" => $shopId, "partner_id" => $partnerId);
    $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
    $sign = hash_hmac('sha256', $baseString, $partnerKey);
    $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $host, $path, $partnerId, $timest, $sign);
    

    $c = curl_init($url);
    curl_setopt($c, CURLOPT_POST, 1);
    curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    $resp = curl_exec($c);
    echo "raw result: $resp";

    $ret = json_decode($resp, true);
    $accessToken = $ret["access_token"];
    $newRefreshToken = $ret["refresh_token"];
    echo "\naccess_token: $accessToken, refresh_token: $newRefreshToken raw: $ret"."\n";
    return $ret;
}


function getTokenAccountLevel($code, $partnerId, $partnerKey, $mainAccountId) {
    global $host;
    $path = "/api/v2/auth/token/get";
    
    $timest = time();
    $body = array("code" => $code,  "main_account_id" => $mainAccountId, "partner_id" => $partnerId);
    $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);

    $sign = hash_hmac('sha256', $baseString, $partnerKey);
    $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $host, $path, $partnerId, $timest, $sign);

    $c = curl_init($url);
    curl_setopt($c, CURLOPT_POST, 1);
    curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($c);
    echo "\nraw result ".$result."\n";

    $ret = json_decode($result, true);
    $accessToken = $ret["access_token"];
    $newRefreshToken = $ret["refresh_token"];
    echo "\naccess_token: ".$accessToken.", refresh_token: ".$newRefreshToken."\n";
    return $ret;
}

$host="https://partner.shopeemobile.com";

$partnerId = 844031;
$partnerKey = "6bc3ff192ae477e3b26e79944ebbc546b75a2f370c9a500bd6bb7fc6adb0c286";

$code="4e77737a53576e415944615868466763";

// $shopId=200520705;
// getTokenShopLevel($code, $partnerId, $partnerKey, $shopId);

$accountId=51437101;
getTokenShopLevel($code, $partnerId, $partnerKey, $accountId)

?>
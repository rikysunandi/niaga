<?php
$dbName = dirname(__FILE__) . "\\53_saldo_ujl_202008.mdb";

echo $dbName;

if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;");


?>
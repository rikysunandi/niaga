<?php
$output=null;
$retval=null;
chdir("D:/wamp64/www/niaga/bo/assets/uploads/");
exec('"C:/Program Files/7-Zip/7z" x "D:/wamp64/www/niaga/bo/assets/uploads/02150147_PRIANGAN_53555.TEST_20220214020605 .zip_d0d5de.zip"', $output, $retval);

var_dump( $output );
echo '<br/>';
echo $retval;

?>
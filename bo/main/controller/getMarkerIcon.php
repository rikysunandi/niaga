<?php

//require_once '../../config/config.php';

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$text = $_GET["text"];
$color = $_GET["color"];

if(strlen($text)==1)
	$font_size = 11;
else if(strlen($text)==2)
	$font_size = 10;
else if(strlen($text)==3)
	$font_size = 9;
else 
	$font_size = 11;

define("FONT_SIZE", $font_size);                            // font size in points
define("FONT_PATH", __DIR__."/../../assets/fonts/abel.ttf"); // path to a ttf font file
define("FONT_COLOR", 0x00000000);                  // 4 byte color
                                                   // alpha  -- 0x00 thru 0x7F; solid thru transparent
                                                   // red    -- 0x00 thru 0xFF
                                                   // greeen -- 0x00 thru 0xFF
                                                   // blue -- 0x00 thru 0xFF

$gdimage = imagecreatefrompng('../../assets/images/markers/pin/48x48/icon-'.$color.'.png');
imagesavealpha($gdimage, true);

// if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
    list($x0, $y0, , , $x1, $y1) = imagettfbbox(FONT_SIZE, 0, FONT_PATH, $text);

	$imwide = imagesx($gdimage);
	$imtall = imagesy($gdimage) - 14;                  // adjusted to exclude the "tail" of the marker
	$bbwide = abs($x1 - $x0);
	$bbtall = abs($y1 - $y0);
	$tlx = ($imwide - $bbwide) >> 1; $tlx -= 1;        // top-left x of the box
	$tly = ($imtall - $bbtall) >> 1; $tly -= 1;        // top-left y of the box
	$bbx = $tlx - $x0;                                 // top-left x to bottom left x + adjust base point
	$bby = $tly + $bbtall - $y0;                       // top-left y to bottom left y + adjust base point

	imagettftext($gdimage, FONT_SIZE, 0, $bbx+2, $bby, FONT_COLOR, FONT_PATH, $text);

// }else{

// }

header("Content-Type: image/png");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60 * 60 * 24 * 180) . " GMT");
imagepng($gdimage);

?>
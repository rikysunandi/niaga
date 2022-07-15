<?php
error_reporting(E_ALL);

$zip = new ZipArchive;
if ($zip->open('/media/nas/uploads/PRIANGAN.zip') === TRUE) {
    $zip->extractTo('/test/');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}

?>
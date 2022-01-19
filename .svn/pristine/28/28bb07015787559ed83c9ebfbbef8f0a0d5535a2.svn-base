<?php

require_once '../../config/database.php';

$skript = "SELECT TOP 1 a.*, convert(varchar(max),convert(varbinary(max),BLOBDATA)) isi FROM [dbo].[m_upload_files] a order by TGL_UPLOAD DESC ";

$izvrsiSQL = sqlsrv_query($conn, $skript);
$result = sqlsrv_fetch_array($izvrsiSQL, SQLSRV_FETCH_ASSOC);
$filename = $result['FILENAME'];
$X = $result['BLOBDATA'];


header("Content-type:application/excel");
header('Content-Disposition: attachment inline; filename="'.$filename.'"');
echo $X;
?>
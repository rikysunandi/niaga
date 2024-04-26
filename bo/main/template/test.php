<?php


	setlocale(LC_TIME, 'id_ID');
//	26 Apr 2024 14:25:50 WIB
	$tgl = '26 Apr 2024 14:25:50 WIB';
	echo date('Y-m-d H:i:s', strtotime(substr($tgl,0,20))); 


// $waktu_notifikasi='2024-01-30 11:36:22';
// // 8 12 16 20
// echo substr(substr($waktu_notifikasi, -8),0,2);
// echo '<br/>';
// echo substr($waktu_notifikasi,0,13);
?>
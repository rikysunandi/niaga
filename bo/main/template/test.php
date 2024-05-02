<?php


	setlocale(LC_TIME, 'id_ID');
//	26 Apr 2024 14:25:50 WIB
$buat = date('Y-m-d H:i:s');
echo $buat.'<br/>'; 
sleep(7);
$waktu_notifikasi = date('Y-m-d H:i:s');
echo $waktu_notifikasi.'<br/>'; 

echo 'Durasi: '.time_string('@'.(strtotime($waktu_notifikasi)), '@'.(strtotime($buat)), true);

// $waktu_notifikasi='2024-01-30 11:36:22';
// // 8 12 16 20
// echo substr(substr($waktu_notifikasi, -8),0,2);
// echo '<br/>';
// echo substr($waktu_notifikasi,0,13);


function time_string($waktu_notifikasi, $datetime, $full = false) {
    $now = new DateTime($waktu_notifikasi);
    //$now = $now->createFromFormat('Y-m-d H:i:s', $waktu_notifikasi);
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    /*
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    */
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return implode(', ', $string) ; //? implode(', ', $string) . ' yang lalu' : 'saat ini';
    //return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
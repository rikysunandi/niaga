<?php

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="piutang_prabayar.csv"');

set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once 'ap3t_login.php';

$authorization = $token;

$context = stream_context_create(array(
    'http' => array(
        'header' => "Authorization: " . $authorization,
    ),
));

$stmt = sqlsrv_query($conn, "select UNITAP, UNITUP from m_unitup WHERE UNITAP<='53CJR' order by UNITAP, UNITUP ");

if($stmt){
	$fp = fopen('php://output', 'wb');
	$val = "rowNumber, unitAp, noAgenda, noAgendaMohon, noRegister, idPel, nama, kdpembpp, jenisPiutang, rpTag, tglEntri, tglJatuhTempo, kdGerakMasuk, kdGerakKeluar, tglPelunasan, unitUp, tarif, daya, rpptl, rpbpTrafo, rpSewaTrafo, rpSewaKap, rpAngsuranBp, rpAngsuranP2tl, rpAngsuranKwh, rpAngsuranPrr, rpAngsuranPrrHapus, rpPpn, rpPpju, rpMaterai, rpBk, rpMaterial, rpSegel, ketStatusPenetapan, ketStatusAngsur";
	fputcsv($fp, $val);
	// Open the table
	// echo "<table border='1'>";
	// echo "<thead>";
	// 	echo "<tr>";
	// 		echo "<td>rowNumber</td>";
    //         echo "<td>unitAp</td>";
    //         echo "<td>noAgenda</td>";
    //         echo "<td>noAgendaMohon</td>";
    //         echo "<td>noRegister</td>";
    //         echo "<td>idPel</td>";
    //         echo "<td>nama</td>";
    //         echo "<td>kdpembpp</td>";
    //         echo "<td>jenisPiutang</td>";
    //         echo "<td>rpTag</td>";
    //         echo "<td>tglEntri</td>";
    //         echo "<td>tglJatuhTempo</td>";
    //         echo "<td>kdGerakMasuk</td>";
    //         echo "<td>kdGerakKeluar</td>";
    //         echo "<td>tglPelunasan</td>";
    //         echo "<td>unitUp</td>";
    //         echo "<td>tarif</td>";
    //         echo "<td>daya</td>";
    //         echo "<td>rpptl</td>";
    //         echo "<td>rpbpTrafo</td>";
    //         echo "<td>rpSewaTrafo</td>";
    //         echo "<td>rpSewaKap</td>";
    //         echo "<td>rpAngsuranBp</td>";
    //         echo "<td>rpAngsuranP2tl</td>";
    //         echo "<td>rpAngsuranKwh</td>";
    //         echo "<td>rpAngsuranPrr</td>";
    //         echo "<td>rpAngsuranPrrHapus</td>";
    //         echo "<td>rpPpn</td>";
    //         echo "<td>rpPpju</td>";
    //         echo "<td>rpMaterai</td>";
    //         echo "<td>rpBk</td>";
    //         echo "<td>rpMaterial</td>";
    //         echo "<td>rpSegel</td>";
    //         echo "<td>ketStatusPenetapan</td>";
    //         echo "<td>ketStatusAngsur</td>";
	// 	echo "</tr>";
	// echo "</thead>";

	$i=0;

	while( $unit = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		$api_url = 'http://10.68.35.105:8081/piutang/get-piutang-data-pss?sort-dir=ASC&sort-by=IDPEL&unit-ap='.$unit['UNITAP'].'&unit-up='.$unit['UNITUP'].'&unit-upi=53&tgl-awal=01/01/2000&tgl-akhir=22/05/2024&limit=50&page=1';
		//echo $api_url;
		$result = file_get_contents($api_url, false, $context);

		$data =  json_decode($result);
		//print_r($data);
		//die();

		    if (count($data->data)) {

		        // Cycle through the array
		        foreach ($data->data as $idx => $row) {

		        	$val = $row->rowNumber.','.$unit['UNITAP'].','.$row->noAgenda.','.$row->noAgendaMohon.','.$row->noRegister.','.$row->idPel.','.$row->nama.','.$row->kdpembpp.','.$row->jenisPiutang.','.$row->rpTag.','.$row->tglEntri.','.$row->tglJatuhTempo.','.$row->kdGerakMasuk.','.$row->kdGerakKeluar.','.$row->tglPelunasan.','.$row->unitUp.','.$row->tarif.','.$row->daya.','.$row->rpptl.','.$row->rpbpTrafo.','.$row->rpSewaTrafo.','.$row->rpSewaKap.','.$row->rpAngsuranBp.','.$row->rpAngsuranP2tl.','.$row->rpAngsuranKwh.','.$row->rpAngsuranPrr.','.$row->rpAngsuranPrrHapus.','.$row->rpPpn.','.$row->rpPpju.','.$row->rpMaterai.','.$row->rpBk.','.$row->rpMaterial.','.$row->rpSegel.','.$row->ketStatusPenetapan.','.$row->ketStatusAngsur;
					fputcsv($fp, $val);
		            // Output a row
		            // echo "<tr>";
		            // echo "<td>$row->rowNumber</td>";
		            // echo "<td>".$unit['UNITAP']."</td>";
		            // echo "<td>$row->noAgenda</td>";
		            // echo "<td>$row->noAgendaMohon</td>";
		            // echo "<td>$row->noRegister</td>";
		            // echo "<td>$row->idPel</td>";
		            // echo "<td>$row->nama</td>";
		            // echo "<td>$row->kdpembpp</td>";
		            // echo "<td>$row->jenisPiutang</td>";
		            // echo "<td>$row->rpTag</td>";
		            // echo "<td>$row->tglEntri</td>";
		            // echo "<td>$row->tglJatuhTempo</td>";
		            // echo "<td>$row->kdGerakMasuk</td>";
		            // echo "<td>$row->kdGerakKeluar</td>";
		            // echo "<td>$row->tglPelunasan</td>";
		            // echo "<td>$row->unitUp</td>";
		            // echo "<td>$row->tarif</td>";
		            // echo "<td>$row->daya</td>";
		            // echo "<td>$row->rpptl</td>";
		            // echo "<td>$row->rpbpTrafo</td>";
		            // echo "<td>$row->rpSewaTrafo</td>";
		            // echo "<td>$row->rpSewaKap</td>";
		            // echo "<td>$row->rpAngsuranBp</td>";
		            // echo "<td>$row->rpAngsuranP2tl</td>";
		            // echo "<td>$row->rpAngsuranKwh</td>";
		            // echo "<td>$row->rpAngsuranPrr</td>";
		            // echo "<td>$row->rpAngsuranPrrHapus</td>";
		            // echo "<td>$row->rpPpn</td>";
		            // echo "<td>$row->rpPpju</td>";
		            // echo "<td>$row->rpMaterai</td>";
		            // echo "<td>$row->rpBk</td>";
		            // echo "<td>$row->rpMaterial</td>";
		            // echo "<td>$row->rpSegel</td>";
		            // echo "<td>$row->ketStatusPenetapan</td>";
		            // echo "<td>$row->ketStatusAngsur</td>";
		            // echo "</tr>";
		        }

		    }

		$i++;
	}

    // Close the table
    //echo "</table>";
    fclose($fp);


}else{
	echo'Gagal melakukan Query ke Database';
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


?>
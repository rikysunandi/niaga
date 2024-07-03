<?php

// header('Content-Type: text/csv');
// header('Content-Disposition: attachment; filename="piutang_prabayar.csv"');

require_once '../../config/config.php';
require_once '../../config/database.php';
set_time_limit(-1);
//require_once 'ap3t_login.php';

//$authorization = $token;
//echo $authorization;
// $context = stream_context_create(array(
//     'http' => array(
//         'header' => "Authorization: " . $authorization,
//     ),
// ));

$blth='202401';
$blths = array('202401','202402','202403');
foreach($blths as $blth){
	$stmtunit = sqlsrv_query($conn, "select UNITAP, UNITUP, NAMA from m_unitup order by UNITAP, UNITUP ");

	if($stmtunit){
		// $fp = fopen('php://output', 'wb');
		// $val = "rowNumber, unitAp, noAgenda, noAgendaMohon, noRegister, idPel, nama, kdpembpp, jenisPiutang, rpTag, tglEntri, tglJatuhTempo, kdGerakMasuk, kdGerakKeluar, tglPelunasan, unitUp, tarif, daya, rpptl, rpbpTrafo, rpSewaTrafo, rpSewaKap, rpAngsuranBp, rpAngsuranP2tl, rpAngsuranKwh, rpAngsuranPrr, rpAngsuranPrrHapus, rpPpn, rpPpju, rpMaterai, rpBk, rpMaterial, rpSegel, ketStatusPenetapan, ketStatusAngsur";
		// fputcsv($fp, $val);
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
		echo "Periode: ".$blth."<hr/>";
		echo "<ul>";
		while( $unit = sqlsrv_fetch_array( $stmtunit, SQLSRV_FETCH_ASSOC) ) {
			// echo 'http://10.68.35.108:8081/e-tmp/laporan-detail/load-laporan-detail-gangguan?start=0&length=10000&thbllap='.$blth.'&unitupi=53&unitap='.$unit['UNITAP'].'&unitup='.$unit['UNITUP'].' ';
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://10.68.35.108:8081/e-tmp/laporan-detail/load-laporan-detail-gangguan?start=0&length=100000&thbllap='.$blth.'&unitupi=53&unitap='.$unit['UNITAP'].'&unitup='.$unit['UNITUP'].' ',
			  CURLOPT_RETURNTRANSFER => true,
			  //CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  //CURLOPT_SSL_VERIFYPEER => true,
			  CURLOPT_POST => true,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => false,
			  CURLOPT_HTTPHEADER => array(
			    'Cookie: JSESSIONID=10C9EB380E940D1EBE883CC3CDC7A57B; BIGipServerap2t.etmp.web.prod=993198346.37151.0000',
			    'Host: 10.68.35.108:8081',
			    'Origin: http://10.68.35.108:8081',
			    'Referer: http://10.68.35.108:8081/e-tmp/laporan-detail/laporan-detail-gangguan',
			    'X-Requested-With: XMLHttpRequest'
			  ),
			  // CURLOPT_POSTFIELDS => array('order[0][column]' => '7', 'order[0][dir]' => 'asc', 'start' => '0','length' => '100','id_unit' => '0','id_area' => '0','id_induk' => '53','id_pusat' => '','type' => 'kl','data' => 'y','tab' => 'keluhan','token' => 'ulMU4xndYO2p2fcB2qWwOtyRu3KwpnNPImMSkpM5SvshXFu0mPx5S47YjTKD'),
			));

			
			$data = json_decode(curl_exec($curl));
			// $status = curl_getinfo($curl);
			// echo json_encode($status, JSON_PRETTY_PRINT);
			curl_close($curl);
			// echo $data->recordsTotal;
			//var_dump($data); die();
			if(isset($data->recordsTotal)){

				if($data->recordsTotal>0){
					// echo 'recordsTotal: '.$data->recordsTotal." - tgl update: ".date('Y-m-d H:i:s');
					// echo "<hr/>";
					$sukses=0;
					echo "<li>".$unit['UNITAP']." - ".$unit['NAMA'].': '.$data->recordsTotal.': ';

					// echo "<table border='1'>";
					// echo "<thead>";
					// 	echo "<tr>";
					// 		echo '<td>NO</td>';
					// 		echo '<td>BLTHLAP_DIL</td>';
					// 		echo '<td>JENISLAYANAN_DIL</td>';
					// 		echo '<td>IDPEL_DIL</td>';
					// 		echo '<td>UNITUPI_DIL</td>';
					// 		echo '<td>UNITAP_DIL</td>';
					// 		echo '<td>UNITUP_DIL</td>';
					// 		echo '<td>NAMA_DIL</td>';
					// 		echo '<td>TARIF_DIL</td>';
					// 		echo '<td>DAYA_DIL</td>';
					// 		echo '<td>NO_LAPORAN</td>';
					// 		echo '<td>STATUS</td>';
					// 		echo '<td>DI_INPUT_OLEH</td>';
					// 		echo '<td>ID_PELANGGAN</td>';
					// 		echo '<td>NAMA_PELAPOR</td>';
					// 		echo '<td>ALAMAT_PELAPOR</td>';
					// 		echo '<td>NO_TELP_PELAPOR</td>';
					// 		echo '<td>TGL_LAPOR</td>';
					// 		echo '<td>TGL_NYALA</td>';
					// 		echo '<td>RECOVERYTIME</td>';
					// 		echo '<td>LAMA_PADAM</td>';
					// 		echo '<td>KALI_PADAM</td>';
					// 		echo '<td>KWH_LOST</td>';
					// 		echo '<td>FASILITAS</td>';
					// 		echo '<td>SUBFASILITAS</td>';
					// 		echo '<td>PERALATAN</td>';
					// 		echo '<td>DAMPAK_KERUSAKAN</td>';
					// 		echo '<td>PENYEBAB</td>';
					// 		echo '<td>KELOMPOK_PENYEBAB</td>';
					// 		echo '<td>CUACA</td>';
					// 		echo '<td>KETERANGAN_PELAPOR</td>';
					// 		echo '<td>KETERANGAN</td>';
					// 		echo '<td>PENYEBAB_PADAM</td>';
					// 		echo '<td>TINDAKAN</td>';
					// 		echo '<td>KODE_ASSET</td>';
					// 		echo '<td>KODE_INDIKATOR</td>';
					// 		echo '<td>KODE_GANGGUAN</td>';
					// 		echo '<td>KETERANGAN</td>';
					// 	echo "</tr>";
					// echo "</thead>";

					// echo "<tbody>";

					//$reportnumbers='';
				    foreach ($data->data as $idx => $row) {
				    	//$reportnumbers .= $row->reportnumber.',';
				        // Output a row
				        // echo "<tr>";
						// 	echo "<td>$row->row_number</td>";
						// 	echo "<td>$row->blthlap_dil</td>";
						// 	echo "<td>$row->jenislayanan_dil</td>";
						// 	echo "<td>$row->idpel_dil</td>";
						// 	echo "<td>$row->unitupi_dil</td>";
						// 	echo "<td>$row->unitap_dil</td>";
						// 	echo "<td>$row->unitup_dil</td>";
						// 	echo "<td>$row->nama_dil</td>";
						// 	echo "<td>$row->tarif_dil</td>";
						// 	echo "<td>$row->daya_dil</td>";
						// 	echo "<td>$row->no_laporan</td>";
						// 	echo "<td>$row->status</td>";
						// 	echo "<td>$row->di_input_oleh</td>";
						// 	echo "<td>$row->id_pelanggan</td>";
						// 	echo "<td>$row->nama_pelapor</td>";
						// 	echo "<td>$row->alamat_pelapor</td>";
						// 	echo "<td>$row->no_telp_pelapor</td>";
						// 	echo "<td>$row->tgl_lapor</td>";
						// 	echo "<td>$row->tgl_nyala</td>";
						// 	echo "<td>$row->recoverytime</td>";
						// 	echo "<td>$row->lama_padam</td>";
						// 	echo "<td>$row->kali_padam</td>";
						// 	echo "<td>$row->kwh_lost</td>";
						// 	echo "<td>$row->fasilitas</td>";
						// 	echo "<td>$row->subfasilitas</td>";
						// 	echo "<td>$row->peralatan</td>";
						// 	echo "<td>$row->dampak_kerusakan</td>";
						// 	echo "<td>$row->penyebab</td>";
						// 	echo "<td>$row->kelompok_penyebab</td>";
						// 	echo "<td>$row->cuaca</td>";
						// 	echo "<td>$row->keterangan_pelapor</td>";
						// 	echo "<td>$row->keterangan</td>";
						// 	echo "<td>$row->penyebab_padam</td>";
						// 	echo "<td>$row->tindakan</td>";
						// 	echo "<td>$row->kode_asset</td>";
						// 	echo "<td>$row->kode_indikator</td>";
						// 	echo "<td>$row->kode_gangguan</td>";
					    //     echo "<td>";

							$params = array(
									array($row->row_number, SQLSRV_PARAM_IN),
									array($row->blthlap_dil, SQLSRV_PARAM_IN),
									array($row->jenislayanan_dil, SQLSRV_PARAM_IN),
									array($row->idpel_dil, SQLSRV_PARAM_IN),
									array($row->unitupi_dil, SQLSRV_PARAM_IN),
									array($row->unitap_dil, SQLSRV_PARAM_IN),
									array($row->unitup_dil, SQLSRV_PARAM_IN),
									array(strclean($row->nama_dil), SQLSRV_PARAM_IN),
									array($row->tarif_dil, SQLSRV_PARAM_IN),
									array($row->daya_dil, SQLSRV_PARAM_IN),
									array($row->no_laporan, SQLSRV_PARAM_IN),
									array($row->status, SQLSRV_PARAM_IN),
									array($row->di_input_oleh, SQLSRV_PARAM_IN),
									array($row->id_pelanggan, SQLSRV_PARAM_IN),
									array($row->nama_pelapor, SQLSRV_PARAM_IN),
									array($row->alamat_pelapor, SQLSRV_PARAM_IN),
									array($row->no_telp_pelapor, SQLSRV_PARAM_IN),
									array($row->tgl_lapor, SQLSRV_PARAM_IN),
									array($row->tgl_nyala, SQLSRV_PARAM_IN),
									array($row->recoverytime, SQLSRV_PARAM_IN),
									array($row->lama_padam, SQLSRV_PARAM_IN),
									array($row->kali_padam, SQLSRV_PARAM_IN),
									array($row->kwh_lost, SQLSRV_PARAM_IN),
									array($row->fasilitas, SQLSRV_PARAM_IN),
									array($row->subfasilitas, SQLSRV_PARAM_IN),
									array($row->peralatan, SQLSRV_PARAM_IN),
									array($row->dampak_kerusakan, SQLSRV_PARAM_IN),
									array($row->penyebab, SQLSRV_PARAM_IN),
									array($row->kelompok_penyebab, SQLSRV_PARAM_IN),
									array($row->cuaca, SQLSRV_PARAM_IN),
									array(strclean($row->keterangan_pelapor), SQLSRV_PARAM_IN),
									array(strclean($row->keterangan), SQLSRV_PARAM_IN),
									array(strclean($row->penyebab_padam), SQLSRV_PARAM_IN),
									array(strclean($row->tindakan), SQLSRV_PARAM_IN),
									array($row->kode_asset, SQLSRV_PARAM_IN),
									array($row->kode_indikator, SQLSRV_PARAM_IN),
									array($row->kode_gangguan, SQLSRV_PARAM_IN),
							    );

							$sql = "EXEC SP_JOB_TMP_DETAIL_GANGGUAN '".
										($row->row_number)."', '".
										($row->blthlap_dil)."', '".
										($row->jenislayanan_dil)."', '".
										($row->idpel_dil)."', '".
										($row->unitupi_dil)."', '".
										($row->unitap_dil)."', '".
										($row->unitup_dil)."', '".
										strclean($row->nama_dil)."', '".
										($row->tarif_dil)."', '".
										($row->daya_dil)."', '".
										($row->no_laporan)."', '".
										($row->status)."', '".
										($row->di_input_oleh)."', '".
										($row->id_pelanggan)."', '".
										strclean($row->nama_pelapor)."', '".
										strclean($row->alamat_pelapor)."', '".
										($row->no_telp_pelapor)."', '".
										($row->tgl_lapor)."', '".
										($row->tgl_nyala)."', '".
										($row->recoverytime)."', '".
										($row->lama_padam)."', '".
										($row->kali_padam)."', '".
										($row->kwh_lost)."', '".
										($row->fasilitas)."', '".
										($row->subfasilitas)."', '".
										($row->peralatan)."', '".
										($row->dampak_kerusakan)."', '".
										($row->penyebab)."', '".
										($row->kelompok_penyebab)."', '".
										($row->cuaca)."', '".
										strclean($row->keterangan_pelapor)."', '".
										strclean($row->keterangan)."', '".
										strclean($row->penyebab_padam)."', '".
										strclean($row->tindakan)."', '".
										($row->kode_asset)."', '".
										($row->kode_indikator)."', '".
										($row->kode_gangguan)."' ";
							$stmt = sqlsrv_prepare($conn, $sql, $params);

						    if (sqlsrv_execute($stmt))
						    	$sukses++;
						//     	echo 'Data berhasil disimpan</td>';
						    else{
						    	echo 'Data gagal disimpan: ' .$sql.'<br/>';
						    }
				        // echo "</tr>";

				        sqlsrv_free_stmt($stmt);

				    }
				    echo $sukses.'</li>';

				    // echo "</tbody>";
				    // echo "</table>";


				}

			}
		}
		echo "</ul>";

	    // Close the table
	    //echo "</table>";
	    // fclose($fp);


	}else{
		echo'Gagal melakukan Query ke Database';
	}


	sqlsrv_free_stmt($stmtunit);
	sqlsrv_close($conn);
}

function strclean($str){
	return preg_match('/[a-zA-Z0-9. ]/', $str);
}
?>
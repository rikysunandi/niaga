<?php

require_once '../../../config/config.php';
require_once '../../../config/database.php';


$response = array();
$noagenda = $_GET['noagenda'];

$stmt = sqlsrv_query($conn, "select * from vw_daftung where noagenda_individu = '$noagenda' ");
if($stmt){
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	if($row['NOAGENDA_INDIVIDU']<>''){
		$response['unitupi'] = $row['UNITUPI']; 
		$response['unitap'] = $row['UNITAP']; 
		$response['unitup'] = $row['UNITUP']; 
		$response['jenislap'] = $row['JENISLAP']; 
		$response['tglmohon'] = date_format($row['TGLMOHON'],"d/m/Y H:i"); 
		$response['noagenda_individu'] = ($row['NOAGENDA_INDIVIDU']); 
		$response['noagenda_kolektif'] = ($row['NOAGENDA_KOLEKTIF']); 
		$response['jenis_transaksi'] = ($row['JENIS_TRANSAKSI']); 
		$response['ket_transaksi'] = ($row['KET_TRANSAKSI']); 
		$response['jenis_mk'] = ($row['JENIS_MK']); 
		$response['idpel'] = ($row['IDPEL']); 
		$response['nama'] = ($row['NAMA']); 
		$response['tarif_daya_lama'] = ($row['TARIF_LAMA']=='')? '':$row['TARIF_LAMA'].'/'.number_format($row['DAYA_LAMA']).' VA'; 
		$response['tarif_daya_baru'] = ($row['TARIF_BARU']=='')? '':$row['TARIF_BARU'].'/'.number_format($row['DAYA_BARU']).' VA'; 
		$response['daya_baru'] = ($row['DAYA_BARU']); 
		$response['segmen_tegangan'] = ($row['SEGMEN_TEGANGAN']); 
		$response['keterangan_gol_tarif'] = ($row['KETERANGAN_GOL_TARIF']); 
		$response['rp_bp'] = number_format($row['RP_BP']); 
		$response['rp_ujl'] = number_format($row['RP_UJL']); 
		$response['status_permohonan'] = ($row['STATUS_PERMOHONAN']); 
		$response['alasan_kriteria_tmp'] = ($row['ALASAN_KRITERIA_TMP']); 
		$response['keterangan_alasan_kriteria_tmp'] = ($row['KETERANGAN_ALASAN_KRITERIA_TMP']); 
		$response['rp_rab'] = number_format($row['RP_RAB']); 
		$response['rab_material'] = number_format($row['RAB_MATERIAL']); 
		$response['rab_jasa'] = number_format($row['RAB_JASA']); 
		$response['rp_rab_std'] = number_format($row['RP_RAB_STD']); 
		$response['rab_material_std'] = number_format($row['RAB_MATERIAL_STD']); 
		$response['rab_jasa_std'] = number_format($row['RAB_JASA_STD']); 
		$response['rp_rab_perluasan'] = number_format($row['RP_RAB_PERLUASAN']); 
		$response['rab_material_perluasan'] = number_format($row['RAB_MATERIAL_PERLUASAN']); 
		$response['rab_jasa_perluasan'] = number_format($row['RAB_JASA_PERLUASAN']);
		$response['keterangan_rab'] = ($row['KETERANGAN_RAB']); 
		$response['status_tmp'] = ($row['STATUS_TMP']); 
		$response['klasifikasi_rab'] = ($row['KLASIFIKASI_RAB']); 
		$response['status_proses'] = ($row['STATUS_PROSES']); 
		$response['success'] = true;

		$params = array(
		        array($user, SQLSRV_PARAM_IN),
		        array($noagenda, SQLSRV_PARAM_IN),
		    );

		$sql = "EXEC sp_vw_Create_Kebutuhan_Agenda @UserID = ?, @Noagenda = ? ";
		$stmt = sqlsrv_prepare($conn, $sql, $params);

		$stmt = sqlsrv_query($conn, "select * from vw_Create_Kebutuhan_Agenda");
		if($stmt){
			$i=0;
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$response['kebutuhan'][$i]['JENIS'] = $row['JENIS']; 
				$response['kebutuhan'][$i]['ID_KEBUTUHAN'] = $row['ID_KEBUTUHAN']; 
				$response['kebutuhan'][$i]['KEBUTUHAN'] = $row['KEBUTUHAN']; 
				$response['kebutuhan'][$i]['HARGA_SATUAN'] = $row['HARGA_SATUAN']; 
				$response['kebutuhan'][$i]['VOLUME'] = $row['VOLUME']; 
				$response['kebutuhan'][$i]['TOTAL_HARGA'] = $row['TOTAL_HARGA']; 
				$i++;
			}

			$response['success'] = true;
			sqlsrv_free_stmt($stmt);


		}else{
			$response['success'] = false;
			$response['msg'] = 'Gagal melakukan Query ke Database';
		}


	}else{
		$response['success'] = false;
		$response['msg'] = 'Agenda tidak ditemukan';
	}

	sqlsrv_free_stmt($stmt);


}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal melakukan Query ke Database';
}

header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);

?>
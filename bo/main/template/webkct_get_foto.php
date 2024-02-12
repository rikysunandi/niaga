<?php

$params = array();
//SELECT * FROM m_kct_suspect_foto
$sql = "EXEC SP_GET_KCT_SUSPECT ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

echo (sqlsrv_execute($stmt))?'Status get berhasil<br/>':'Status get gagal<br/>';

if($stmt){
	$i=0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		
	  $idpel = $row['IDPEL'];
		$fotourl = getWebKCTFoto($idpel);

		if($fotourl<>''){

			$params = array(
		        array($idpel, SQLSRV_PARAM_IN),
		        array($fotourl, SQLSRV_PARAM_IN),
		    );
			$sql = "EXEC SP_UPDATE_KCT_SUSPECT_FOTO @IDPEL = ?, @FOTOURL = ? ";
			$stmt = sqlsrv_prepare($conn, $sql, $params);

			if(!sqlsrv_execute($stmt)){
				echo 'Gagal '.$idpel.'<br/>';
			}
		}

		$i++;
	}
}else{
	echo 'Gagal melakukan Query SP_GET_KCT_SUSPECT ke Database';
}


function getWebKCTFoto($idpel){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://10.68.35.74:8080/kct-web/ap2t/springGwtServices/gwtTransService',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'7|0|7|http://10.68.35.74:8080/kct-web/ap2t/|D6F5DCF2A7FFAB7D396D6E6B510C4BA6|id.co.iconpln.ap2t.client.service.GwtTransService|getDataInfoKCT|java.lang.String/2004016611|'.$idpel.'|8810496Z|1|2|3|4|2|5|5|6|7|',
	  CURLOPT_HTTPHEADER => array(
	    'Cookie: JSESSIONID=09B4F26DE75186C605C5BA1ADD0B028E',
	    'Origin: http://10.68.35.74:8080',
	    'X-GWT-Module-Base: http://10.68.35.74:8080/kct-web/ap2t/',
	    'X-GWT-Permutation: 32AEE8563B920F07641BD36B7E2776F0',
	    'Content-Type: text/x-gwt-rpc; charset=utf-8'
	  ),
	));

	$response = curl_exec($curl);

	$res = explode(',', $response);

	curl_close($curl);

	if(sizeof($res)>=45)
		return $res['45'];
	else 
		return '';
}

?>
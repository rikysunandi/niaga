<?php
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$ds = DIRECTORY_SEPARATOR;  //1
$storeFolder = '../../../assets/uploads';   //2
$csv_file = $_POST['csv_file']; 

$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
$csv_file = $targetPath. $csv_file;

if (($handle = fopen($csv_file, "r")) !== FALSE) {
   	fgetcsv($handle);   
   	$berhasil = array();
   	$gagal = array();

   	while (($data = fgetcsv($handle, 50000, ",")) !== FALSE) {
        $num = count($data);
        for ($c=0; $c < $num; $c++) {
          $col[$c] = str_replace("'", "", $data[$c]);
        }

		 $query = "INSERT INTO m_daftung_upload VALUES ('".
		 		$col[0]."','".
		 		$col[1]."','".
		 		$col[2]."','".
		 		$col[3]."','".
		 		$col[4]."','".
		 		$col[5]."','".
		 		$col[6]."','".
		 		$col[7]."','".
		 		$col[8]."','".
		 		$col[9]."','".
		 		$col[10]."','".
		 		$col[11]."','".
		 		$col[12]."','".
		 		$col[13]."','".
		 		$col[14]."','".
		 		$col[15]."','".
		 		$col[16]."','".
		 		$col[17]."','".
		 		$col[18]."','".
		 		$col[19]."','".
		 		$col[20]."','".
		 		$col[21]."','".
		 		$col[22]."','".
		 		$col[23]."','".
		 		$col[24]."','".
		 		$col[25]."','".
		 		$col[26]."','".
		 		$col[27]."','".
		 		$col[28]."','".
		 		$col[29]."','".
		 		$col[30]."','".
		 		$col[31]."','".
		 		$col[32]."','".
		 		$col[33]."','".
		 		$col[34]."','".
		 		$col[35]."','".
		 		$col[36]."','".
		 		$col[37]."','".
		 		$col[38]."')";
		 $params = array();
		 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		 $stmt = sqlsrv_query($conn, $query, $params, $options ); 
		  
		if( $stmt ){
			$berhasil[] = $col[6];
		}else{
			$gagal[] = $query;
		}

}

if(count( $berhasil ) > 0){
	$response['success'] = true;
	$response['msg'] = count( $berhasil ).' Data berhasil masuk ke Database';
	$response['gagal'] = $gagal;
}else{
	$response['success'] = false;
	$response['gagal'] = $gagal;
  	$response['msg'] = 'Data gagal masuk ke Database';
}
 
fclose($handle);
sqlsrv_free_stmt($stmt);  
sqlsrv_close($conn);

}else{
	$response['success'] = false;
	$response['msg'] = 'Gagal membuka isi File';
}

header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode($response);
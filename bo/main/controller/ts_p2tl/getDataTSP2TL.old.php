<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$kesesuaian = $_GET['kesesuaian'];
$jenis_plg = $_GET['jenis_plg'];
$sisa_saldo = $_GET['sisa_saldo'];
$kelancaran = $_GET['kelancaran'];
$dlpd_6 = $_GET['dlpd_6'];
$blocking_token = $_GET['blocking_token'];
$koordinat = $_GET['koordinat'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($kesesuaian, SQLSRV_PARAM_IN),
        array($jenis_plg, SQLSRV_PARAM_IN),
        array($sisa_saldo, SQLSRV_PARAM_IN),
        array($kelancaran, SQLSRV_PARAM_IN),
        array($dlpd_6, SQLSRV_PARAM_IN),
        array($blocking_token, SQLSRV_PARAM_IN),
        array($koordinat, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_TS_P2TL_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Kesesuaian = ?, @Jenis_Plg = ?, @Sisa_Saldo = ?, @Kelancaran = ?, @DLPD_6 = ?, @Blocking_Token = ?, @Koordinat = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_TS_P2TL_Unit';
 
// Table's primary key
$primaryKey = 'NOAGENDA';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'NAMA_UP', 'dt' => 'NAMA_UP' ),
    array( 'db' => 'NOAGENDA', 'dt' => 'NOAGENDA' ),
    array( 'db' => 'IDPEL', 'dt' => 'IDPEL' ),
    array( 'db' => 'NAMA',  'dt' => 'NAMA' ),
    array( 'db' => 'TARIF_AKHIR',  'dt' => 'TARIF_AKHIR' ),
    array( 'db' => 'DAYA_AKHIR',  'dt' => 'DAYA_AKHIR' ),
    array( 'db' => 'BL_ANG_AW',  'dt' => 'BL_ANG_AW' ),
    array( 'db' => 'BL_ANG_AK',  'dt' => 'BL_ANG_AK' ),
    array( 'db' => 'RP_TS',  'dt' => 'RP_TS' ),
    array( 'db' => 'BA_SESUAI',  'dt' => 'BA_SESUAI' ),
    array( 'db' => 'TS_SESUAI',  'dt' => 'TS_SESUAI' ),
    array( 'db' => 'SPH_SESUAI',  'dt' => 'SPH_SESUAI' ),
    array( 'db' => 'SUB_SESUAI',  'dt' => 'SUB_SESUAI' ),
    array( 'db' => 'CEKLOK_SESUAI',  'dt' => 'CEKLOK_SESUAI' ),
    array( 'db' => 'TOTAL_SESUAI',  'dt' => 'TOTAL_SESUAI' ),
    array( 'db' => 'PENGURANGAN_RPTS',  'dt' => 'PENGURANGAN_RPTS' ),
    array( 'db' => 'JML_ANG_AKHIR',  'dt' => 'JML_ANG_AKHIR' ),
    array( 'db' => 'RPTS_AKHIR',  'dt' => 'RPTS_AKHIR' ),
    array( 'db' => 'TGL_BLOCKING_TERAKHIR',  'dt' => 'TGL_BLOCKING_TERAKHIR' ),
    array( 'db' => 'LATITUDE',  'dt' => 'LATITUDE' ),
    array( 'db' => 'LONGITUDE',  'dt' => 'LONGITUDE' ),
    array( 'db' => 'AKURASI_KOORDINAT',  'dt' => 'AKURASI_KOORDINAT' ),
    array( 'db' => 'SUMBER_KOORDINAT',  'dt' => 'SUMBER_KOORDINAT' ),
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'sa',
    'pass' => 'sqlsvr1q2w3e@@',
    'db'   => 'NIAGA',
    'host' => '10.2.1.57'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);
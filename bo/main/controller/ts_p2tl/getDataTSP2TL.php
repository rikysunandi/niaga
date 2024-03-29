<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$jenis_plg = $_GET['jenis_plg'];
$kategori = $_GET['kategori'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($jenis_plg, SQLSRV_PARAM_IN),
        array($kategori, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_TS_P2TL_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Jenis_Plg = ?, @Kategori = ? ";
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
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'NOAGENDA', 'dt' => 'NOAGENDA' ),
    array( 'db' => 'IDPEL', 'dt' => 'IDPEL' ),
    array( 'db' => 'NAMA',  'dt' => 'NAMA' ),
    array( 'db' => 'TARIF_DIL',  'dt' => 'TARIF_DIL' ),
    array( 'db' => 'DAYA_DIL',  'dt' => 'DAYA_DIL' ),
    array( 'db' => 'KATEGORI',  'dt' => 'KATEGORI' ),
    array( 'db' => 'BL_ANG_AW',  'dt' => 'BL_ANG_AW' ),
    array( 'db' => 'BL_ANG_AK',  'dt' => 'BL_ANG_AK' ),
    array( 'db' => 'RPTS',  'dt' => 'RPTS' ),
    array( 'db' => 'BA_SESUAI',  'dt' => 'BA_SESUAI' ),
    array( 'db' => 'TS_SESUAI',  'dt' => 'TS_SESUAI' ),
    array( 'db' => 'SPH_SESUAI',  'dt' => 'SPH_SESUAI' ),
    array( 'db' => 'CEKLOK_SESUAI',  'dt' => 'CEKLOK_SESUAI' ),
    array( 'db' => 'NAMA_GARDU',  'dt' => 'NAMA_GARDU' ),
    array( 'db' => 'NOMOR_GARDU',  'dt' => 'NOMOR_GARDU' ),
    array( 'db' => 'NOMOR_TIANG',  'dt' => 'NOMOR_TIANG' ),
    array( 'db' => 'KOORDINAT_X',  'dt' => 'KOORDINAT_X' ),
    array( 'db' => 'KOORDINAT_Y',  'dt' => 'KOORDINAT_Y' ),
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
<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$koordinat = $_GET['koordinat'];
$tagging = $_GET['tagging'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($koordinat, SQLSRV_PARAM_IN),
        array($tagging, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Blm_Pemeriksaan_LPB_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Koordinat = ?, @Tagging = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Blm_Pemeriksaan_LPB_Unit_'.$unitup;
 
// Table's primary key
$primaryKey = 'IDPEL';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'IDPEL', 'dt' => 'IDPEL' ),
    array( 'db' => 'NAMA',  'dt' => 'NAMA' ),
    array( 'db' => 'TARIF',  'dt' => 'TARIF' ),
    array( 'db' => 'DAYA',  'dt' => 'DAYA' ),
    array( 'db' => 'KOGOL',  'dt' => 'KOGOL' ),
    array( 'db' => 'RBM',  'dt' => 'RBM' ),
    array( 'db' => 'ALAMAT',  'dt' => 'ALAMAT' ),
    array( 'db' => 'NAMA_GARDU',  'dt' => 'NAMA_GARDU' ),
    array( 'db' => 'NOMOR_JURUSAN_TIANG',  'dt' => 'NOMOR_JURUSAN_TIANG' ),
    array( 'db' => 'KOORDINAT_X',  'dt' => 'KOORDINAT_X' ),
    array( 'db' => 'KOORDINAT_Y',  'dt' => 'KOORDINAT_Y' ),
    array( 'db' => 'NOMOR_METER_KWH',  'dt' => 'NOMOR_METER_KWH' ),
    array( 'db' => 'TELEPON',  'dt' => 'TELEPON' ),
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

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
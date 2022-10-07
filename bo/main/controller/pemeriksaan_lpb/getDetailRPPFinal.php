<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';
$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$rpp = $_GET['rpp'];
//$tgl_pemeriksaan_from = $_GET['tgl_pemeriksaan_from'];
//$tgl_pemeriksaan_to = $_GET['tgl_pemeriksaan_to'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($rpp, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Detail_RPP_Final @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Petugas = ?, @RPP = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Detail_RPP_Final_'.$unitup;
 
// Table's primary key
$primaryKey = 'IDPEL';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'IDPEL', 'dt' => 'IDPEL' ),
    array( 'db' => 'NOMOR_METER_KWH',  'dt' => 'NOMOR_METER_KWH' ),
    array( 'db' => 'NAMA',  'dt' => 'NAMA' ),
    array( 'db' => 'TARIF',  'dt' => 'TARIF' ),
    array( 'db' => 'DAYA',  'dt' => 'DAYA' ),
    array( 'db' => 'KOGOL',  'dt' => 'KOGOL' ),
    array( 'db' => 'NAMA_GARDU',  'dt' => 'NAMA_GARDU' ),
    array( 'db' => 'NOMOR_JURUSAN_TIANG',  'dt' => 'NOMOR_JURUSAN_TIANG' ),
    array( 'db' => 'RPP_KDDK',  'dt' => 'RPP_KDDK' ),
    array( 'db' => 'RPP_PETUGAS',  'dt' => 'RPP_PETUGAS' ),
    array( 'db' => 'LATITUDE',  'dt' => 'LATITUDE' ),
    array( 'db' => 'LONGITUDE',  'dt' => 'LONGITUDE' ),
    array( 'db' => 'IDPEL',  'dt' => 'MARKER_TITLE' ),
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
<?php

set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Target_Kompor @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Target_Kompor_'.$unitup;
 
// Table's primary key
$primaryKey = 'KDDK';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'unitap', 'dt' => 'UNITAP' ),
    array( 'db' => 'unitup', 'dt' => 'UNITUP' ),
    array( 'db' => 'idpel', 'dt' => 'IDPEL' ),
    array( 'db' => 'nama',  'dt' => 'NAMA' ),
    array( 'db' => 'tarif',  'dt' => 'TARIF' ),
    array( 'db' => 'daya',  'dt' => 'DAYA' ),
    array( 'db' => 'gardu',  'dt' => 'GARDU' ),
    array( 'db' => 'nomor_jurusan_tiang',  'dt' => 'NOMOR_JURUSAN_TIANG' ),
    array( 'db' => 'kddk',  'dt' => 'KDDK' ),
    array( 'db' => 'rbm',  'dt' => 'RBM' ),
    array( 'db' => 'koordinat_x',  'dt' => 'LATITUDE' ),
    array( 'db' => 'koordinat_y',  'dt' => 'LONGITUDE' ),
    array( 'db' => 'idpel',  'dt' => 'MARKER_TITLE' ),
    array( 'db' => 'nama_kecamatan',  'dt' => 'NAMA_KECAMATAN' ),
    array( 'db' => 'nama_kelurahan',  'dt' => 'NAMA_KELURAHAN' ),
    array( 'db' => 'jenis_subsidi',  'dt' => 'JENIS_SUBSIDI' ),
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
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);
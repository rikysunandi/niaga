<?php
session_start();
set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$petugas = $_GET['petugas'];
$rpp = $_GET['rpp'];
$id = $_SESSION['userid']%5;
// $user = $_SESSION['username'];
$user = rand(1,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($rpp, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Sisa_WO_RPP_Onsite @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Kodepetugas = ?, @RPP = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Sisa_WO_RPP_Onsite_'.$user;
 
// Table's primary key
$primaryKey = 'IDPEL';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    //array( 'db' => 'NO', 'dt' => 'NO' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'IDPEL', 'dt' => 'IDPEL' ),
    array( 'db' => 'NOMOR_METER_KWH',  'dt' => 'NOMOR_METER_KWH' ),
    array( 'db' => 'NAMA',  'dt' => 'NAMA' ),
    array( 'db' => 'TARIF',  'dt' => 'TARIF' ),
    array( 'db' => 'DAYA',  'dt' => 'DAYA' ),
    array( 'db' => 'RPP_KDDK',  'dt' => 'RPP_KDDK' ),
    array( 'db' => 'RPP_PETUGAS',  'dt' => 'RPP_PETUGAS' ),
    array( 'db' => 'NAMA_GARDU',  'dt' => 'NAMA_GARDU' ),
    array( 'db' => 'NOMOR_JURUSAN_TIANG',  'dt' => 'NOMOR_JURUSAN_TIANG' ),
    array( 'db' => 'LATITUDE',  'dt' => 'LATITUDE' ),
    array( 'db' => 'LONGITUDE',  'dt' => 'LONGITUDE' ),
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
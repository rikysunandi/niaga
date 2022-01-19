<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$klp_plg = $_GET['klp_plg'];
$jenis_transaksi = $_GET['jenis_transaksi'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($klp_plg, SQLSRV_PARAM_IN),
        array($jenis_transaksi, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Dapot_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Klp_Plg = ?, @Jenis_Transaksi = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Dapot_Unit';
 
// Table's primary key
$primaryKey = 'NOAGENDA';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'NOAGENDA', 'dt' => 'NOAGENDA' ),
    array( 'db' => 'TGLMOHON',  'dt' => 'TGLMOHON' ),
    array( 'db' => 'JENIS_TRANSAKSI',  'dt' => 'JENIS_TRANSAKSI' ),
    array( 'db' => 'TARIF_LAMA',  'dt' => 'TARIF_LAMA' ),
    array( 'db' => 'DAYA_LAMA',  'dt' => 'DAYA_LAMA' ),
    array( 'db' => 'TARIF',  'dt' => 'TARIF' ),
    array( 'db' => 'DAYA',  'dt' => 'DAYA' ),
    array( 'db' => 'STATUSPERMOHONAN',  'dt' => 'STATUSPERMOHONAN' ),
    array( 'db' => 'RPBP',  'dt' => 'RPBP' ),
    array( 'db' => 'RPUJL',  'dt' => 'RPUJL' ),
    array( 'db' => 'RAB_TOTAL',  'dt' => 'RAB_TOTAL' ),
    array( 'db' => 'STATUS_PROSES',  'dt' => 'STATUS_PROSES' ),
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
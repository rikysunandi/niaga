<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$periode = $_REQUEST['periode'];
$user = rand(0,10);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($periode, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_Migrasi_UP3 @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Periode = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Rekap_Migrasi_UP3_'.$user;
 
// Table's primary key
$primaryKey = 'UNITAP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UP3', 'dt' => 'UP3' ),
    array( 'db' => 'TARGET', 'dt' => 'TARGET' ),
    array( 'db' => 'CARRY_OVER', 'dt' => 'CARRY_OVER' ),
    array( 'db' => 'TARGET_TOTAL', 'dt' => 'TARGET_TOTAL' ),
    array( 'db' => 'REALISASI', 'dt' => 'REALISASI' ),
    array( 'db' => 'PENCAPAIAN', 'dt' => 'PENCAPAIAN' ),
    array( 'db' => 'REALISASI_12', 'dt' => 'REALISASI_12' ),
    array( 'db' => 'PENCAPAIAN_12', 'dt' => 'PENCAPAIAN_12' ),
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
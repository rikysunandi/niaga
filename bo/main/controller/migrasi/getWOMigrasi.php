<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$status = $_REQUEST['status'];
$user = rand(0,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($status, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_WO_Migrasi @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Status = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_WO_Migrasi_'.$user;
 
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
    array( 'db' => 'NAMA', 'dt' => 'NAMA' ),
    array( 'db' => 'KOGOL', 'dt' => 'KOGOL' ),
    array( 'db' => 'TARIF', 'dt' => 'TARIF' ),
    array( 'db' => 'DAYA', 'dt' => 'DAYA' ),
    array( 'db' => 'KDDK', 'dt' => 'KDDK' ),
    array( 'db' => 'MENUNGGAK_3BLN_BERTURUT2', 'dt' => 'MENUNGGAK_3BLN_BERTURUT2' ),
    array( 'db' => 'MENUNGGAK_6BLN_BERTURUT2', 'dt' => 'MENUNGGAK_6BLN_BERTURUT2' ),
    array( 'db' => 'MENUNGGAK_9BLN_BERTURUT2', 'dt' => 'MENUNGGAK_9BLN_BERTURUT2' ),
    array( 'db' => 'MENUNGGAK_12BLN_BERTURUT2', 'dt' => 'MENUNGGAK_12BLN_BERTURUT2' ),
    array( 'db' => 'JML_MENUNGGAK',  'dt' => 'JML_MENUNGGAK' ),
    array( 'db' => 'BLTH_MENUNGGAK',  'dt' => 'BLTH_MENUNGGAK' ),
    array( 'db' => 'TGLBAYAR_RATA2',  'dt' => 'TGLBAYAR_RATA2' ),
    array( 'db' => 'NOAGENDA',  'dt' => 'NOAGENDA' ),
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
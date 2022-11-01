<?php
session_start();
set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$user = $_SESSION['username'];
$userid = $_SESSION['userid'];

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Mon_Upload_Sorek @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Mon_Upload_Sorek';
 
// Table's primary key
$primaryKey = 'UNITUP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UP3', 'dt' => 'UP3' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'ULP', 'dt' => 'ULP' ),
    array( 'db' => 'JML_PLG', 'dt' => 'JML_PLG' ),
    array( 'db' => 'PEMKWH', 'dt' => 'PEMKWH' ),
    array( 'db' => 'RPPTL', 'dt' => 'RPPTL' ),
    array( 'db' => 'EIS_LEMBAR', 'dt' => 'EIS_LEMBAR' ),
    array( 'db' => 'EIS_PEMKWH', 'dt' => 'EIS_PEMKWH' ),
    array( 'db' => 'EIS_RPPTL', 'dt' => 'EIS_RPPTL' ),
    array( 'db' => 'SELISIH', 'dt' => 'SELISIH' ),
    array( 'db' => 'A', 'dt' => 'A' ),
    array( 'db' => 'AI', 'dt' => 'AI' ),
    array( 'db' => 'T', 'dt' => 'T' ),
    array( 'db' => 'T1', 'dt' => 'T1' ),
    array( 'db' => 'T2', 'dt' => 'T2' ),
    array( 'db' => 'T3', 'dt' => 'T3' ),
    array( 'db' => 'T4', 'dt' => 'T4' ),
    array( 'db' => 'T5', 'dt' => 'T5' ),
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
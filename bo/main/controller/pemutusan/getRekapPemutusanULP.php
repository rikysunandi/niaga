<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_Pemutusan @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Rekap_Pemutusan';
 
// Table's primary key
$primaryKey = 'UNITUP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'ULP', 'dt' => 'ULP' ),
    array( 'db' => 'BLTH', 'dt' => 'BLTH' ),
    array( 'db' => 'JML_LUNAS_21', 'dt' => 'JML_LUNAS_21' ),
    array( 'db' => 'JML_PUTUS_21', 'dt' => 'JML_PUTUS_21' ),
    array( 'db' => 'JML_PLG_21', 'dt' => 'JML_PLG_21' ),
    array( 'db' => 'JML_LUNAS_22', 'dt' => 'JML_LUNAS_22' ),
    array( 'db' => 'JML_PUTUS_22', 'dt' => 'JML_PUTUS_22' ),
    array( 'db' => 'JML_PLG_22', 'dt' => 'JML_PLG_22' ),
    array( 'db' => 'JML_LUNAS_23', 'dt' => 'JML_LUNAS_23' ),
    array( 'db' => 'JML_PUTUS_23', 'dt' => 'JML_PUTUS_23' ),
    array( 'db' => 'JML_PLG_23', 'dt' => 'JML_PLG_23' ),
    array( 'db' => 'JML_LUNAS_24', 'dt' => 'JML_LUNAS_24' ),
    array( 'db' => 'JML_PUTUS_24', 'dt' => 'JML_PUTUS_24' ),
    array( 'db' => 'JML_PLG_24', 'dt' => 'JML_PLG_24' ),
    array( 'db' => 'JML_LUNAS_25', 'dt' => 'JML_LUNAS_25' ),
    array( 'db' => 'JML_PUTUS_25', 'dt' => 'JML_PUTUS_25' ),
    array( 'db' => 'JML_PLG_25', 'dt' => 'JML_PLG_25' ),
    array( 'db' => 'JML_LUNAS_26', 'dt' => 'JML_LUNAS_26' ),
    array( 'db' => 'JML_PUTUS_26', 'dt' => 'JML_PUTUS_26' ),
    array( 'db' => 'JML_PLG_26', 'dt' => 'JML_PLG_26' ),
    array( 'db' => 'JML_LUNAS_27', 'dt' => 'JML_LUNAS_27' ),
    array( 'db' => 'JML_PUTUS_27', 'dt' => 'JML_PUTUS_27' ),
    array( 'db' => 'JML_PLG_27', 'dt' => 'JML_PLG_27' ),
    array( 'db' => 'JML_LUNAS_28', 'dt' => 'JML_LUNAS_28' ),
    array( 'db' => 'JML_PUTUS_28', 'dt' => 'JML_PUTUS_28' ),
    array( 'db' => 'JML_PLG_28', 'dt' => 'JML_PLG_28' ),
    array( 'db' => 'JML_LUNAS_29', 'dt' => 'JML_LUNAS_29' ),
    array( 'db' => 'JML_PUTUS_29', 'dt' => 'JML_PUTUS_29' ),
    array( 'db' => 'JML_PLG_29', 'dt' => 'JML_PLG_29' ),
    array( 'db' => 'JML_LUNAS_30', 'dt' => 'JML_LUNAS_30' ),
    array( 'db' => 'JML_PUTUS_30', 'dt' => 'JML_PUTUS_30' ),
    array( 'db' => 'JML_PLG_30', 'dt' => 'JML_PLG_30' ),
    array( 'db' => 'JML_LUNAS_31', 'dt' => 'JML_LUNAS_31' ),
    array( 'db' => 'JML_PUTUS_31', 'dt' => 'JML_PUTUS_31' ),
    array( 'db' => 'JML_PLG_31', 'dt' => 'JML_PLG_31' ),
    array( 'db' => 'JML_LUNAS', 'dt' => 'JML_LUNAS' ),
    array( 'db' => 'JML_PUTUS', 'dt' => 'JML_PUTUS' ),
    array( 'db' => 'JML_PLG', 'dt' => 'JML_PLG' ),
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
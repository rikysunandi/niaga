<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$user = rand (1,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_Pelunasan_Intimasi @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo._vw_Create_Rekap_Pelunasan_Intimasi_'.$user;
 
// Table's primary key
$primaryKey = 'UNIT';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNIT', 'dt' => 'UNIT' ),
    array( 'db' => 'NAMA', 'dt' => 'NAMA' ),
    array( 'db' => 'TARGET_IRISAN', 'dt' => 'TARGET_IRISAN' ),
    array( 'db' => 'TARGET_BARU', 'dt' => 'TARGET_BARU' ),
    array( 'db' => 'TARGET_WO', 'dt' => 'TARGET_WO' ),
    array( 'db' => 'TARGET_WO_RP', 'dt' => 'TARGET_WO_RP' ),
    array( 'db' => 'MUTASI', 'dt' => 'MUTASI' ),
    array( 'db' => 'LUNAS_IRISAN', 'dt' => 'LUNAS_IRISAN' ),
    array( 'db' => 'LUNAS_BARU', 'dt' => 'LUNAS_BARU' ),
    array( 'db' => 'LUNAS_WO', 'dt' => 'LUNAS_WO' ),
    array( 'db' => 'LUNAS_WO_RP', 'dt' => 'LUNAS_WO_RP' ),
    array( 'db' => 'SALDO_IRISAN', 'dt' => 'SALDO_IRISAN' ),
    array( 'db' => 'SALDO_BARU', 'dt' => 'SALDO_BARU' ),
    array( 'db' => 'SALDO_WO', 'dt' => 'SALDO_WO' ),
    array( 'db' => 'SALDO_WO_RP', 'dt' => 'SALDO_WO_RP' ),
    array( 'db' => 'SALDO_MUP3', 'dt' => 'SALDO_MUP3' ),
    array( 'db' => 'SALDO_MBSAR', 'dt' => 'SALDO_MBSAR' ),
    array( 'db' => 'SALDO_MULP', 'dt' => 'SALDO_MULP' ),
    array( 'db' => 'SALDO_BILLER', 'dt' => 'SALDO_BILLER' ),
    array( 'db' => 'PERSEN_TOTAL', 'dt' => 'PERSEN_TOTAL' ),
    array( 'db' => 'LATEST_TGLBAYAR', 'dt' => 'LATEST_TGLBAYAR' ),
    array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'BLTH', 'dt' => 'BLTH' ),
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
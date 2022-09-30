<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$user = rand(0,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Mon_Saldo_Tunggakan @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo._vw_Create_Mon_Saldo_Tunggakan_'.$user;
 
// Table's primary key
$primaryKey = 'UNITAP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UP3', 'dt' => 'UP3' ),
    array( 'db' => 'SALDO_AWAL_1', 'dt' => 'SALDO_AWAL_1' ),
    array( 'db' => 'SALDO_AWAL_2', 'dt' => 'SALDO_AWAL_2' ),
    array( 'db' => 'SALDO_AWAL_3', 'dt' => 'SALDO_AWAL_3' ),
    array( 'db' => 'RP_AWAL', 'dt' => 'RP_AWAL' ),
    array( 'db' => 'TARGET', 'dt' => 'TARGET' ),
    array( 'db' => 'SALDO_LALU_1', 'dt' => 'SALDO_LALU_1' ),
    array( 'db' => 'SALDO_LALU_2', 'dt' => 'SALDO_LALU_2' ),
    array( 'db' => 'SALDO_LALU_3', 'dt' => 'SALDO_LALU_3' ),
    array( 'db' => 'RP_LALU', 'dt' => 'RP_LALU' ),
    array( 'db' => 'SALDO_KINI_1', 'dt' => 'SALDO_KINI_1' ),
    array( 'db' => 'SALDO_KINI_2', 'dt' => 'SALDO_KINI_2' ),
    array( 'db' => 'SALDO_KINI_3', 'dt' => 'SALDO_KINI_3' ),
    array( 'db' => 'RP_KINI', 'dt' => 'RP_KINI' ),
    array( 'db' => 'LUNAS_1', 'dt' => 'LUNAS_1' ),
    array( 'db' => 'LUNAS_2', 'dt' => 'LUNAS_2' ),
    array( 'db' => 'LUNAS_3', 'dt' => 'LUNAS_3' ),
    array( 'db' => 'RP_LUNAS', 'dt' => 'RP_LUNAS' ),
    array( 'db' => 'PERSEN_HARI', 'dt' => 'PERSEN_HARI' ),
    array( 'db' => 'PERSEN_BULAN', 'dt' => 'PERSEN_BULAN' ),
    array( 'db' => 'WAKTU_UPDATE', 'dt' => 'WAKTU_UPDATE' ),
    array( 'db' => 'TGL_NIHIL', 'dt' => 'TGL_NIHIL' ),
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
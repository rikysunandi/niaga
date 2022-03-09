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

$sql = "EXEC sp_vw_Create_Rekap_Pelunasan_Tgl_Bayar @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo._vw_Create_Rekap_Pelunasan_Tgl_Bayar_'.$user;
 
// Table's primary key
$primaryKey = 'TANGGAL';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'TANGGAL', 'dt' => 'TANGGAL' ),
    array( 'db' => 'SAL_IRISAN', 'dt' => 'SAL_IRISAN' ),
    array( 'db' => 'LUNAS_IRISAN', 'dt' => 'LUNAS_IRISAN' ),
    array( 'db' => 'TARGET_IRISAN', 'dt' => 'TARGET_IRISAN' ),
    array( 'db' => 'SAH_IRISAN', 'dt' => 'SAH_IRISAN' ),
    array( 'db' => 'REAL_IRISAN', 'dt' => 'REAL_IRISAN' ),
    array( 'db' => 'SAL_BARU', 'dt' => 'SAL_BARU' ),
    array( 'db' => 'LUNAS_BARU', 'dt' => 'LUNAS_BARU' ),
    array( 'db' => 'TARGET_BARU', 'dt' => 'TARGET_BARU' ),
    array( 'db' => 'SAH_BARU', 'dt' => 'SAH_BARU' ),
    array( 'db' => 'REAL_BARU', 'dt' => 'REAL_BARU' ),
    array( 'db' => 'SAL_LANCAR', 'dt' => 'SAL_LANCAR' ),
    array( 'db' => 'LUNAS_LANCAR', 'dt' => 'LUNAS_LANCAR' ),
    array( 'db' => 'TARGET_LANCAR', 'dt' => 'TARGET_LANCAR' ),
    array( 'db' => 'SAH_LANCAR', 'dt' => 'SAH_LANCAR' ),
    array( 'db' => 'REAL_LANCAR', 'dt' => 'REAL_LANCAR' ),
    array( 'db' => 'SAL_TOTAL', 'dt' => 'SAL_TOTAL' ),
    array( 'db' => 'LUNAS_TOTAL', 'dt' => 'LUNAS_TOTAL' ),
    array( 'db' => 'TARGET_TOTAL', 'dt' => 'TARGET_TOTAL' ),
    array( 'db' => 'SAH_TOTAL', 'dt' => 'SAH_TOTAL' ),
    array( 'db' => 'REAL_TOTAL', 'dt' => 'REAL_TOTAL' ),
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
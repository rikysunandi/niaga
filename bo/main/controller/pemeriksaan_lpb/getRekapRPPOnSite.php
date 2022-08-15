<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$user = rand (1,10);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_RPP_On_Site @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Rekap_RPP_On_Site_'.$user;
 
// Table's primary key
$primaryKey = 'RPP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    // array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'ULP', 'dt' => 'ULP' ),
    array( 'db' => 'RPP_PETUGAS', 'dt' => 'RPP_PETUGAS' ),
    array( 'db' => 'RPP', 'dt' => 'RPP' ),
    array( 'db' => 'JML_ON_DESK',  'dt' => 'JML_ON_DESK' ),
    array( 'db' => 'RANGE_TGL_INPUT',  'dt' => 'RANGE_TGL_INPUT' ),
    array( 'db' => 'JML_SESUAI_WO',  'dt' => 'JML_SESUAI_WO' ),
    array( 'db' => 'JML_SISIPAN',  'dt' => 'JML_SISIPAN' ),
    array( 'db' => 'JML_PAGAR_KUNCI',  'dt' => 'JML_PAGAR_KUNCI' ),
    array( 'db' => 'JML_TIDAK_DITEMUKAN',  'dt' => 'JML_TIDAK_DITEMUKAN' ),
    array( 'db' => 'JML_SISIPAN_RPP_LAIN',  'dt' => 'JML_SISIPAN_RPP_LAIN' ),
    array( 'db' => 'JML_DOUBLE',  'dt' => 'JML_DOUBLE' ),
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
<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_TS_P2TL_Kesesuaian_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Rekap_TS_P2TL_Kesesuaian_Unit';
 
// Table's primary key
$primaryKey = 'UNITUP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'NAMA_UP', 'dt' => 'NAMA_UP' ),
    array( 'db' => 'JML_BA_PENETAPAN_SPH_CEKLOK_SESUAI',  'dt' => 'JML_BA_PENETAPAN_SPH_CEKLOK_SESUAI' ),
    array( 'db' => 'JML_BA_PENETAPAN_SPH_SESUAI',  'dt' => 'JML_BA_PENETAPAN_SPH_SESUAI' ),
    array( 'db' => 'JML_BA_PENETAPAN_SESUAI',  'dt' => 'JML_BA_PENETAPAN_SESUAI' ),
    array( 'db' => 'JML_BA_SESUAI',  'dt' => 'JML_BA_SESUAI' ),
    array( 'db' => 'JML_TIDAK_SESUAI',  'dt' => 'JML_TIDAK_SESUAI' ),
    array( 'db' => 'JML_TOTAL',  'dt' => 'JML_TOTAL' )
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
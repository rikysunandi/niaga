<?php

set_time_limit(-1);

require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$user = 'SYSTEM';

// $params = array(
//         array($user, SQLSRV_PARAM_IN),
//         array($unitupi, SQLSRV_PARAM_IN),
//         array($unitap, SQLSRV_PARAM_IN),
//         array($unitup, SQLSRV_PARAM_IN),
//     );

// $sql = "EXEC sp_vw_Create_Rekap_TS_P2TL_Kesesuaian_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
// $stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
// if(!sqlsrv_execute($stmt)){
//     die(print_r( sqlsrv_errors(), true));
// }

// DB table to use
$table = 'NIAGA.dbo.vw_rekap_mon_ts_p2tl_ap';
 
// Table's primary key
$primaryKey = 'UNITAP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'NAMA', 'dt' => 'NAMA' ),
    array( 'db' => 'JML_DATA',  'dt' => 'JML_DATA' ),
    array( 'db' => 'JML_PRABAYAR',  'dt' => 'JML_PRABAYAR' ),
    array( 'db' => 'PRABAYAR_JML_AGENDA',  'dt' => 'PRABAYAR_JML_AGENDA' ),
    array( 'db' => 'PRABAYAR_RPTS',  'dt' => 'PRABAYAR_RPTS' ),
    array( 'db' => 'JML_PASKABAYAR',  'dt' => 'JML_PASKABAYAR' ),
    array( 'db' => 'PASKABAYAR_JML_AGENDA',  'dt' => 'PASKABAYAR_JML_AGENDA' ),
    array( 'db' => 'PASKABAYAR_RPTS',  'dt' => 'PASKABAYAR_RPTS' ),
    array( 'db' => 'SESUAI_JML_PLG',  'dt' => 'SESUAI_JML_PLG' ),
    array( 'db' => 'SESUAI_JML_AGENDA',  'dt' => 'SESUAI_JML_AGENDA' ),
    array( 'db' => 'SESUAI_RPTS',  'dt' => 'SESUAI_RPTS' ),
    array( 'db' => 'TDK_SESUAI_JML_PLG',  'dt' => 'TDK_SESUAI_JML_PLG' ),
    array( 'db' => 'TDK_SESUAI_JML_AGENDA',  'dt' => 'TDK_SESUAI_JML_AGENDA' ),
    array( 'db' => 'TDK_SESUAI_RPTS',  'dt' => 'TDK_SESUAI_RPTS' ),
    array( 'db' => 'JML_PLG',  'dt' => 'JML_PLG' ),
    array( 'db' => 'JML_AGENDA',  'dt' => 'JML_AGENDA' ),
    array( 'db' => 'RPTS',  'dt' => 'RPTS' ),
    array( 'db' => 'SALDO_AKHIR_JML_PLG',  'dt' => 'SALDO_AKHIR_JML_PLG' ),
    array( 'db' => 'SALDO_AKHIR_JML_AGENDA',  'dt' => 'SALDO_AKHIR_JML_AGENDA' ),
    array( 'db' => 'SALDO_AKHIR_PRABAYAR_JML_PLG',  'dt' => 'SALDO_AKHIR_PRABAYAR_JML_PLG' ),
    array( 'db' => 'SALDO_AKHIR_PRABAYAR_JML_AGENDA',  'dt' => 'SALDO_AKHIR_PRABAYAR_JML_AGENDA' ),
    array( 'db' => 'SALDO_AKHIR_PRABAYAR_RPTS',  'dt' => 'SALDO_AKHIR_PRABAYAR_RPTS' ),
    array( 'db' => 'SALDO_AKHIR_PASKABAYAR_JML_PLG',  'dt' => 'SALDO_AKHIR_PASKABAYAR_JML_PLG' ),
    array( 'db' => 'SALDO_AKHIR_PASKABAYAR_JML_AGENDA',  'dt' => 'SALDO_AKHIR_PASKABAYAR_JML_AGENDA' ),
    array( 'db' => 'SALDO_AKHIR_PASKABAYAR_RPTS',  'dt' => 'SALDO_AKHIR_PASKABAYAR_RPTS' ),
    array( 'db' => 'SALDO_AKHIR_SESUAI_JML_PLG',  'dt' => 'SALDO_AKHIR_SESUAI_JML_PLG' ),
    array( 'db' => 'SALDO_AKHIR_SESUAI_JML_AGENDA',  'dt' => 'SALDO_AKHIR_SESUAI_JML_AGENDA' ),
    array( 'db' => 'SALDO_AKHIR_SESUAI_RPTS',  'dt' => 'SALDO_AKHIR_SESUAI_RPTS' ),
    array( 'db' => 'SALDO_AKHIR_TDK_SESUAI_JML_PLG',  'dt' => 'SALDO_AKHIR_TDK_SESUAI_JML_PLG' ),
    array( 'db' => 'SALDO_AKHIR_TDK_SESUAI_JML_AGENDA',  'dt' => 'SALDO_AKHIR_TDK_SESUAI_JML_AGENDA' ),
    array( 'db' => 'SALDO_AKHIR_TDK_SESUAI_RPTS',  'dt' => 'SALDO_AKHIR_TDK_SESUAI_RPTS' ),
    array( 'db' => 'SALDO_AKHIR_JML_PLG',  'dt' => 'SALDO_AKHIR_JML_PLG' ),
    array( 'db' => 'SALDO_AKHIR_JML_AGENDA',  'dt' => 'SALDO_AKHIR_JML_AGENDA' ),
    array( 'db' => 'SALDO_AKHIR_RPTS',  'dt' => 'SALDO_AKHIR_RPTS' ),
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
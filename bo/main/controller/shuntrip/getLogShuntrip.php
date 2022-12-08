<?php
session_start();
set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

// $unitupi = $_REQUEST['unitupi'];
// $unitap = $_REQUEST['unitap'];
// $unitup = $_REQUEST['unitup'];
// $rbm = $_REQUEST['rbm'];
// $blth = $_REQUEST['blth'];
// $status_lalu = $_REQUEST['status_lalu'];
// $pic = $_REQUEST['pic'];
// $status_bayar = $_REQUEST['status_bayar'];
// $user = $_SESSION['username'];
// $id = $_SESSION['userid']%5;

// $params = array(
//         array($user, SQLSRV_PARAM_IN),
//         array($unitupi, SQLSRV_PARAM_IN),
//         array($unitap, SQLSRV_PARAM_IN),
//         array($unitup, SQLSRV_PARAM_IN),
//         array($rbm, SQLSRV_PARAM_IN),
//         array($blth, SQLSRV_PARAM_IN),
//         array($status_lalu, SQLSRV_PARAM_IN),
//         array($pic, SQLSRV_PARAM_IN),
//         array($status_bayar, SQLSRV_PARAM_IN),
//     );

// $sql = "EXEC sp_vw_Create_DPP @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @RBM = ?, @BLTH = ?, @Status_Lalu = ?, @PIC = ?, @Status_Bayar = ? ";
// $stmt = sqlsrv_prepare($conn, $sql, $params);

// //sqlsrv_execute($stmt);
// if(!sqlsrv_execute($stmt)){
//     die(print_r( sqlsrv_errors(), true));
// }

// DB table to use
$table = 'NIAGA.dbo.t_shuntrip_log';
 
// Table's primary key
$primaryKey = 'tgl_kirim_device';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id_device', 'dt' => 'id_device' ),
    array( 'db' => 'nohp', 'dt' => 'nohp' ),
    array( 'db' => 'tgl_kirim_device', 'dt' => 'tgl_kirim_device' ),
    array( 'db' => 'tegangan', 'dt' => 'tegangan' ),
    array( 'db' => 'arus', 'dt' => 'arus' ),
    array( 'db' => 'power_factor', 'dt' => 'power_factor' ),
    array( 'db' => 'vpower', 'dt' => 'vpower' ),
    array( 'db' => 'energi',  'dt' => 'energi' ),
    array( 'db' => 'frekuensi',  'dt' => 'frekuensi' ),
    array( 'db' => 'indikator',  'dt' => 'indikator' ),
    array( 'db' => 'tgl_log',  'dt' => 'tgl_log' ),
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
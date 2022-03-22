<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$tgl_intimasi_from = $_REQUEST['tgl_intimasi_from'];
$tgl_intimasi_to = $_REQUEST['tgl_intimasi_to'];
$user = rand (1,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($tgl_intimasi_from, SQLSRV_PARAM_IN),
        array($tgl_intimasi_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Efektivitas_Petugas @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ?, @Tgl_Intimasi_From = ?, @Tgl_Intimasi_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo._vw_Create_Efektivitas_Petugas_'.$user;
 
// Table's primary key
$primaryKey = 'UNITUP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'BLTH', 'dt' => 'BLTH' ),
    array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'KODEPETUGAS', 'dt' => 'KODEPETUGAS' ),
    array( 'db' => 'TGL_INTIMASI', 'dt' => 'TGL_INTIMASI' ),
    array( 'db' => 'JAM_CLOCKIN', 'dt' => 'JAM_CLOCKIN' ),
    array( 'db' => 'SUHU', 'dt' => 'SUHU' ),
    array( 'db' => 'MASKER', 'dt' => 'MASKER' ),
    array( 'db' => 'SARUNG_TANGAN', 'dt' => 'SARUNG_TANGAN' ),
    array( 'db' => 'JAM_MULAI', 'dt' => 'JAM_MULAI' ),
    array( 'db' => 'JAM_SELESAI', 'dt' => 'JAM_SELESAI' ),
    array( 'db' => 'DURASI', 'dt' => 'DURASI' ),
    array( 'db' => 'JML_INTIMASI', 'dt' => 'JML_INTIMASI' ),
    array( 'db' => 'RATIO', 'dt' => 'RATIO' ),
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
<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$petugas = $_REQUEST['petugas'];
$rbm = isset($_REQUEST['rbm'])?$_REQUEST['rbm']:'00';
$user = rand(0,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($rbm, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Reassign_WO_Pemutusan @UserID = ?, @BLTH = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @KODEPETUGAS = ?, @RBM = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Reassign_WO_Pemutusan_'.$user;
 
// Table's primary key
$primaryKey = 'IDPEL';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'IDPEL', 'dt' => 'IDPEL' ),
    array( 'db' => 'NAMA', 'dt' => 'NAMA' ),
    array( 'db' => 'TARIF', 'dt' => 'TARIF' ),
    array( 'db' => 'DAYA', 'dt' => 'DAYA' ),
    array( 'db' => 'RPTAG', 'dt' => 'RPTAG' ),
    array( 'db' => 'RPBK', 'dt' => 'RPBK' ),
    array( 'db' => 'STATUS', 'dt' => 'STATUS' ),
    array( 'db' => 'KODEPETUGAS', 'dt' => 'KODEPETUGAS' ),
    array( 'db' => 'RBM',  'dt' => 'RBM' ),
    array( 'db' => 'LANGKAH',  'dt' => 'LANGKAH' ),
    array( 'db' => 'GARDU',  'dt' => 'GARDU' ),
    array( 'db' => 'TIANG',  'dt' => 'TIANG' ),
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
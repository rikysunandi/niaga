<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$rbm = $_REQUEST['rbm'];
$blth = $_REQUEST['blth'];
$status_lalu = $_REQUEST['status_lalu'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($rbm, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($status_lalu, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Detail_DPP @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @RBM = ?, @BLTH = ?, @Status_Lalu = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Detail_DPP';
 
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
    array( 'db' => 'KOGOL', 'dt' => 'KOGOL' ),
    array( 'db' => 'TARIF', 'dt' => 'TARIF' ),
    array( 'db' => 'DAYA', 'dt' => 'DAYA' ),
    array( 'db' => 'RBM',  'dt' => 'RBM' ),
    array( 'db' => 'PIC',  'dt' => 'PIC' ),
    array( 'db' => 'PEMKWH',  'dt' => 'PEMKWH' ),
    array( 'db' => 'RPPTL',  'dt' => 'RPPTL' ),
    array( 'db' => 'TGLBAYAR',  'dt' => 'TGLBAYAR' ),
    array( 'db' => 'STATUS_LALU',  'dt' => 'STATUS_LALU' ),
    array( 'db' => 'UMUR_PIUTANG',  'dt' => 'UMUR_PIUTANG' ),
    array( 'db' => 'PERCEPATAN',  'dt' => 'PERCEPATAN' ),
    array( 'db' => 'JML_TUNGGAKAN',  'dt' => 'JML_TUNGGAKAN' ),
    array( 'db' => 'STATUS_BAYAR',  'dt' => 'STATUS_BAYAR' ),
    array( 'db' => 'KODESTATUS',  'dt' => 'KODESTATUS' ),
    array( 'db' => 'KODEPETUGAS',  'dt' => 'KODEPETUGAS' ),
    array( 'db' => 'SUMBER_SOREK',  'dt' => 'SUMBER_SOREK' ),
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
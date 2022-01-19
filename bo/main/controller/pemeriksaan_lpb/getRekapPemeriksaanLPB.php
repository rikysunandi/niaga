<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$tgl_upload_from = $_GET['tgl_upload_from'];
$tgl_upload_to = $_GET['tgl_upload_to'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($tgl_upload_from, SQLSRV_PARAM_IN),
        array($tgl_upload_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Pemeriksaan_LPB_Unit_Tgl_Upload @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Tgl_Upload_From = ?, @Tgl_Upload_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Rekap_Pemeriksaan_LPB_Unit_Tgl_Upload';
 
// Table's primary key
$primaryKey = 'TGL_UPLOAD';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UP3', 'dt' => 'UP3' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'ULP', 'dt' => 'ULP' ),
    array( 'db' => 'TGL_UPLOAD',  'dt' => 'TGL_UPLOAD' ),
    array( 'db' => 'JML_PEMERIKSAAN',  'dt' => 'JML_PEMERIKSAAN' ),
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
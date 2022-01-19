<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$tgl_proses_from = $_GET['tgl_proses_from'];
$tgl_proses_to = $_GET['tgl_proses_to'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($tgl_proses_from, SQLSRV_PARAM_IN),
        array($tgl_proses_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Upload_Pemeriksaan_LPB_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Tgl_Proses_From = ?, @Tgl_Proses_To = ?  ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Upload_Pemeriksaan_LPB_Unit';
 
// Table's primary key
$primaryKey = 'FILEPATH';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITUPI', 'dt' => 'UNITUPI' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'FILENAME', 'dt' => 'FILENAME' ),
    array( 'db' => 'TGL_PROSES',  'dt' => 'TGL_PROSES' ),
    array( 'db' => 'JML_DATA',  'dt' => 'JML_DATA' ),
    array( 'db' => 'JML_FOTO',  'dt' => 'JML_FOTO' ),
    array( 'db' => 'JML_BARU',  'dt' => 'JML_BARU' ),
    array( 'db' => 'JML_DOUBLE',  'dt' => 'JML_DOUBLE' ),
    array( 'db' => 'JML_ULANG',  'dt' => 'JML_ULANG' ),
    array( 'db' => 'KETERANGAN',  'dt' => 'KETERANGAN' ),
    array( 'db' => 'FILEPATH',  'dt' => 'FILEPATH' ),
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
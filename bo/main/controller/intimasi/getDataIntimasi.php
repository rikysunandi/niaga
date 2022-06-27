<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$petugas = $_REQUEST['petugas'];
$keterangan = $_REQUEST['keterangan'];
$blth = $_REQUEST['blth'];
$tgl_intimasi_from = $_REQUEST['tgl_intimasi_from'];
$tgl_intimasi_to = $_REQUEST['tgl_intimasi_to'];
$user = rand (1,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($petugas, SQLSRV_PARAM_IN),
        array($keterangan, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($tgl_intimasi_from, SQLSRV_PARAM_IN),
        array($tgl_intimasi_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Data_Intimasi @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @KODEPETUGAS = ?, @KETERANGAN = ?, @BLTH = ?, @Tgl_Intimasi_From = ?, @Tgl_Intimasi_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Data_Intimasi_'.$user;
 
// Table's primary key
$primaryKey = 'IDPEL';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'BLTH', 'dt' => 'BLTH' ),
    array( 'db' => 'IDPEL', 'dt' => 'IDPEL' ),
    array( 'db' => 'TGL_INTIMASI', 'dt' => 'TGL_INTIMASI' ),
    array( 'db' => 'KET', 'dt' => 'KET' ),
    array( 'db' => 'TGL_JANJI', 'dt' => 'TGL_JANJI' ),
    array( 'db' => 'KOLEKTOR', 'dt' => 'KOLEKTOR' ),
    array( 'db' => 'NOHP', 'dt' => 'NOHP' ),
    array( 'db' => 'EMAIL', 'dt' => 'EMAIL' ),
    array( 'db' => 'PAHAM', 'dt' => 'PAHAM' ),
    array( 'db' => 'PUTUS', 'dt' => 'PUTUS' ),
    array( 'db' => 'ALASAN', 'dt' => 'ALASAN' ),
    array( 'db' => 'LATITUDE', 'dt' => 'LATITUDE' ),
    array( 'db' => 'LONGITUDE', 'dt' => 'LONGITUDE' ),
    array( 'db' => 'AKURASI', 'dt' => 'AKURASI' ),
    array( 'db' => 'STATUS', 'dt' => 'STATUS' ),
    array( 'db' => 'USER_APP', 'dt' => 'USER_APP' ),
    array( 'db' => 'TGL', 'dt' => 'TGL' ),
    array( 'db' => 'FOTOPATH', 'dt' => 'FOTOPATH' ),
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
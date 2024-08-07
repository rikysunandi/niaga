<?php

set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';

$unitupi = $_GET['unitupi'];
$unitap = $_GET['unitap'];
$unitup = $_GET['unitup'];
$status_pengisian = $_GET['status_pengisian'];
$jenislap = $_GET['jenislap'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($status_pengisian, SQLSRV_PARAM_IN),
        array($jenislap, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Daftung_RAB_Perluasan_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @Status_Pengisian = ?, @Jenislap = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Daftung_RAB_Perluasan_Unit';
 
// Table's primary key
$primaryKey = 'NOAGENDA_INDIVIDU';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'JENISLAP', 'dt' => 'JENISLAP' ),
    array( 'db' => 'NOAGENDA_INDIVIDU', 'dt' => 'NOAGENDA_INDIVIDU' ),
    array( 'db' => 'NOAGENDA_KOLEKTIF', 'dt' => 'NOAGENDA_KOLEKTIF' ),
    array( 'db' => 'TGLMOHON',  'dt' => 'TGLMOHON' ),
    array( 'db' => 'KET_TRANSAKSI',  'dt' => 'KET_TRANSAKSI' ),
    array( 'db' => 'ALASAN_KRITERIA_TMP',  'dt' => 'ALASAN_KRITERIA_TMP' ),
    array( 'db' => 'KETERANGAN_ALASAN_KRITERIA_TMP',  'dt' => 'KETERANGAN_ALASAN_KRITERIA_TMP' ),
    array( 'db' => 'TARIF_LAMA',  'dt' => 'TARIF_LAMA' ),
    array( 'db' => 'DAYA_LAMA',  'dt' => 'DAYA_LAMA' ),
    array( 'db' => 'TARIF_BARU',  'dt' => 'TARIF_BARU' ),
    array( 'db' => 'DAYA_BARU',  'dt' => 'DAYA_BARU' ),
    array( 'db' => 'STATUS_TMP',  'dt' => 'STATUS_TMP' ),
    array( 'db' => 'RP_BP',  'dt' => 'RP_BP' ),
    array( 'db' => 'RP_RAB',  'dt' => 'RP_RAB' ),
    array( 'db' => 'STATUS_PROSES',  'dt' => 'STATUS_PROSES' ),
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
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);
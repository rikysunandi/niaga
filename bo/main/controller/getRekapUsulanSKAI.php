<?php

set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

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

$sql = "EXEC sp_vw_Create_Daftung_Unit @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_rekap_daftung_formulir_1';
 
// Table's primary key
$primaryKey = 'URUT';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'GOL_TARIF', 'dt' => 'GOL_TARIF' ),
    array( 'db' => 'URUT', 'dt' => 'URUT' ),
    array( 'db' => 'KETERANGAN_GOL_TARIF', 'dt' => 'KETERANGAN_GOL_TARIF' ),
    array( 'db' => 'LT_900_TANPA_PERLUASAN_JML_PLG', 'dt' => 'LT_900_TANPA_PERLUASAN_JML_PLG' ),
    array( 'db' => 'LT_900_TANPA_PERLUASAN_RP_BP', 'dt' => 'LT_900_TANPA_PERLUASAN_RP_BP' ),
    array( 'db' => 'LT_900_TANPA_PERLUASAN_RP_INVESTASI', 'dt' => 'LT_900_TANPA_PERLUASAN_RP_INVESTASI' ),
    array( 'db' => 'INDIVIDU_JML_PLG', 'dt' => 'INDIVIDU_JML_PLG' ),
    array( 'db' => 'INDIVIDU_RP_BP', 'dt' => 'INDIVIDU_RP_BP' ),
    array( 'db' => 'INDIVIDU_RP_INVESTASI', 'dt' => 'INDIVIDU_RP_INVESTASI' ),
    array( 'db' => 'KOLEKTIF_JML_PLG', 'dt' => 'KOLEKTIF_JML_PLG' ),
    array( 'db' => 'KOLEKTIF_RP_BP', 'dt' => 'KOLEKTIF_RP_BP' ),
    array( 'db' => 'KOLEKTIF_RP_INVESTASI', 'dt' => 'KOLEKTIF_RP_INVESTASI' ),
    array( 'db' => 'AGENDA_EVALUASI_JML_PLG', 'dt' => 'AGENDA_EVALUASI_JML_PLG' ),
    array( 'db' => 'AGENDA_EVALUASI_RP_BP', 'dt' => 'AGENDA_EVALUASI_RP_BP' ),
    array( 'db' => 'AGENDA_EVALUASI_RP_INVESTASI', 'dt' => 'AGENDA_EVALUASI_RP_INVESTASI' ),
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
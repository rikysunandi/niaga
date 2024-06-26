<?php

set_time_limit(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
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
 
// DB table to use
$table = 'NIAGA.dbo.vw_daftung_evaluasi';
 
// Table's primary key
$primaryKey = 'NOAGENDA_INDIVIDU';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'NOAGENDA_INDIVIDU', 'dt' => 'NOAGENDA_INDIVIDU' ),
    array( 'db' => 'TGLMOHON', 'dt' => 'TGLMOHON' ),
    array( 'db' => 'KET_TRANSAKSI', 'dt' => 'KET_TRANSAKSI' ),
    array( 'db' => 'ALASAN_KRITERIA_TMP', 'dt' => 'ALASAN_KRITERIA_TMP' ),
    array( 'db' => 'TARIF_LAMA', 'dt' => 'TARIF_LAMA' ),
    array( 'db' => 'DAYA_LAMA', 'dt' => 'DAYA_LAMA' ),
    array( 'db' => 'TARIF_BARU', 'dt' => 'TARIF_BARU' ),
    array( 'db' => 'DAYA_BARU', 'dt' => 'DAYA_BARU' ),
    array( 'db' => 'V_DURASI_HARI_KERJA', 'dt' => 'V_DURASI_HARI_KERJA' ),
    array( 'db' => 'STATUS_TMP', 'dt' => 'STATUS_TMP' ),
    array( 'db' => 'RP_RAB', 'dt' => 'RP_RAB' ),
    array( 'db' => 'RP_RAB_EXCEL', 'dt' => 'RP_RAB_EXCEL' ),
    array( 'db' => 'RP_RAB_KETERANGAN', 'dt' => 'RP_RAB_KETERANGAN' ),
    array( 'db' => 'RP_BP', 'dt' => 'RP_BP' ),
    array( 'db' => 'STATUS_PROSES', 'dt' => 'STATUS_PROSES' ),
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
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
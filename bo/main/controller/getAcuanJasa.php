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
$table = 'NIAGA.dbo.m_jasa_aksesoris';
 
// Table's primary key
$primaryKey = 'PEKERJAAN';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'ID', 'dt' => 'ID' ),
    array( 'db' => 'JENIS', 'dt' => 'JENIS' ),
    array( 'db' => 'PEKERJAAN', 'dt' => 'PEKERJAAN' ),
    array( 'db' => 'DAYA_BARU_FROM', 'dt' => 'DAYA_BARU_FROM' ),
    array( 'db' => 'DAYA_BARU_TO', 'dt' => 'DAYA_BARU_TO' ),
    array( 'db' => 'HARGA_TOTAL', 'dt' => 'HARGA_TOTAL' ),
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
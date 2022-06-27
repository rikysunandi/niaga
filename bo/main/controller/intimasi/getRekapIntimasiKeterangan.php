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

$sql = "EXEC sp_vw_Create_Rekap_Intimasi_Keterangan @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ?, @Tgl_Intimasi_From = ?, @Tgl_Intimasi_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo._vw_Create_Rekap_Intimasi_Keterangan_'.$user;
 
// Table's primary key
$primaryKey = 'UNITUP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'BLTH', 'dt' => 'BLTH' ),
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'ULP', 'dt' => 'ULP' ),
    array( 'db' => 'KODEPETUGAS', 'dt' => 'KODEPETUGAS' ),
    array( 'db' => 'WO_IRISAN', 'dt' => 'WO_IRISAN' ),
    array( 'db' => 'WO_BARU', 'dt' => 'WO_BARU' ),
    array( 'db' => 'WO_LANCAR', 'dt' => 'WO_LANCAR' ),
    array( 'db' => 'WO_TOTAL', 'dt' => 'WO_TOTAL' ),
    array( 'db' => 'LUNAS_BY_SYSTEM', 'dt' => 'LUNAS_BY_SYSTEM' ),
    array( 'db' => 'WO_SISA', 'dt' => 'WO_SISA' ),
    array( 'db' => 'LUNAS_MANDIRI_INTI', 'dt' => 'LUNAS_MANDIRI_INTI' ),
    array( 'db' => 'LUNAS_MANDIRI_LUNAS', 'dt' => 'LUNAS_MANDIRI_LUNAS' ),
    array( 'db' => 'LUNAS_PPOB_INTI', 'dt' => 'LUNAS_PPOB_INTI' ),
    array( 'db' => 'LUNAS_PPOB_LUNAS', 'dt' => 'LUNAS_PPOB_LUNAS' ),
    array( 'db' => 'KOLEKTIF_INTI', 'dt' => 'KOLEKTIF_INTI' ),
    array( 'db' => 'KOLEKTIF_LUNAS', 'dt' => 'KOLEKTIF_LUNAS' ),
    array( 'db' => 'JANJI_BAYAR_INTI', 'dt' => 'JANJI_BAYAR_INTI' ),
    array( 'db' => 'JANJI_BAYAR_LUNAS', 'dt' => 'JANJI_BAYAR_LUNAS' ),
    array( 'db' => 'RUMAH_KOSONG_INTI', 'dt' => 'RUMAH_KOSONG_INTI' ),
    array( 'db' => 'RUMAH_KOSONG_LUNAS', 'dt' => 'RUMAH_KOSONG_LUNAS' ),
    array( 'db' => 'TIDAK_KOOPERATIF_INTI', 'dt' => 'TIDAK_KOOPERATIF_INTI' ),
    array( 'db' => 'TIDAK_KOOPERATIF_LUNAS', 'dt' => 'TIDAK_KOOPERATIF_LUNAS' ),
    array( 'db' => 'TOTAL_INTI', 'dt' => 'TOTAL_INTI' ),
    array( 'db' => 'TOTAL_LUNAS', 'dt' => 'TOTAL_LUNAS' ),
    array( 'db' => 'PERSEN_INTI', 'dt' => 'PERSEN_INTI' ),
    array( 'db' => 'PERSEN_LUNAS', 'dt' => 'PERSEN_LUNAS' ),
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
<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$tgl_pemutusan_from = $_REQUEST['tgl_pemutusan_from'];
$tgl_pemutusan_to = $_REQUEST['tgl_pemutusan_to'];
$user = rand (1,5);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
        array($tgl_pemutusan_from, SQLSRV_PARAM_IN),
        array($tgl_pemutusan_to, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_Pemutusan_Keterangan @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ?, @Tgl_Pemutusan_From = ?, @Tgl_Pemutusan_To = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo._vw_Create_Rekap_Pemutusan_Keterangan_'.$user;
 
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
    array( 'db' => 'LUNAS_MANDIRI_PUTUS', 'dt' => 'LUNAS_MANDIRI_PUTUS' ),
    array( 'db' => 'LUNAS_MANDIRI_LUNAS', 'dt' => 'LUNAS_MANDIRI_LUNAS' ),
    array( 'db' => 'LUNAS_DITEMPAT_PUTUS', 'dt' => 'LUNAS_DITEMPAT_PUTUS' ),
    array( 'db' => 'LUNAS_DITEMPAT_LUNAS', 'dt' => 'LUNAS_DITEMPAT_LUNAS' ),
    array( 'db' => 'SEGEL_MCB_PUTUS', 'dt' => 'SEGEL_MCB_PUTUS' ),
    array( 'db' => 'SEGEL_MCB_LUNAS', 'dt' => 'SEGEL_MCB_LUNAS' ),
    array( 'db' => 'CABUT_MCB_PUTUS', 'dt' => 'CABUT_MCB_PUTUS' ),
    array( 'db' => 'CABUT_MCB_LUNAS', 'dt' => 'CABUT_MCB_LUNAS' ),
    array( 'db' => 'CABUT_APP_PUTUS', 'dt' => 'CABUT_APP_PUTUS' ),
    array( 'db' => 'CABUT_APP_LUNAS', 'dt' => 'CABUT_APP_LUNAS' ),
    array( 'db' => 'RUMAH_KOSONG_PUTUS', 'dt' => 'RUMAH_KOSONG_PUTUS' ),
    array( 'db' => 'RUMAH_KOSONG_LUNAS', 'dt' => 'RUMAH_KOSONG_LUNAS' ),
    array( 'db' => 'TOTAL_EKSEKUSI', 'dt' => 'TOTAL_EKSEKUSI' ),
    array( 'db' => 'TOTAL_PUTUS', 'dt' => 'TOTAL_PUTUS' ),
    array( 'db' => 'TOTAL_LUNAS', 'dt' => 'TOTAL_LUNAS' ),
    array( 'db' => 'PERSEN_EKSEKUSI', 'dt' => 'PERSEN_EKSEKUSI' ),
    array( 'db' => 'PERSEN_PUTUS', 'dt' => 'PERSEN_PUTUS' ),
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
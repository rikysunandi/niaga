<?php

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$unitupi = $_REQUEST['unitupi'];
$unitap = $_REQUEST['unitap'];
$unitup = $_REQUEST['unitup'];
$blth = $_REQUEST['blth'];
$user = rand(0,10);

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($unitupi, SQLSRV_PARAM_IN),
        array($unitap, SQLSRV_PARAM_IN),
        array($unitup, SQLSRV_PARAM_IN),
        array($blth, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Rekap_Pemutusan @UserID = ?, @Unitupi = ?, @Unitap = ?, @Unitup = ?, @BLTH = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}

// DB table to use
$table = 'NIAGA.dbo.vw_Create_Rekap_Pemutusan_'.$user;
 
// Table's primary key
$primaryKey = 'UNITUP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'ULP', 'dt' => 'ULP' ),
    array( 'db' => 'BLTH', 'dt' => 'BLTH' ),
    array( 'db' => 'JML_PETUGAS', 'dt' => 'JML_PETUGAS' ),
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
    array( 'db' => 'TOTAL_LUNAS_EKSEKUSI', 'dt' => 'TOTAL_LUNAS_EKSEKUSI' ),
    array( 'db' => 'PERSEN_EKSEKUSI', 'dt' => 'PERSEN_EKSEKUSI' ),
    array( 'db' => 'PERSEN_PUTUS', 'dt' => 'PERSEN_PUTUS' ),
    array( 'db' => 'PERSEN_LUNAS', 'dt' => 'PERSEN_LUNAS' ),
    array( 'db' => 'PERSEN_LUNAS_EKSEKUSI', 'dt' => 'PERSEN_LUNAS_EKSEKUSI' ),
    array( 'db' => 'RATA_EKSEKUSI', 'dt' => 'RATA_EKSEKUSI' ),
    array( 'db' => 'RATA_PUTUS', 'dt' => 'RATA_PUTUS' ),
    array( 'db' => 'RATA_LUNAS', 'dt' => 'RATA_LUNAS' ),
    array( 'db' => 'RATA_LUNAS_EKSEKUSI', 'dt' => 'RATA_LUNAS_EKSEKUSI' ),
    array( 'db' => 'JML_LUNAS_BY_SYSTEM_21', 'dt' => 'JML_LUNAS_BY_SYSTEM_21' ),
    array( 'db' => 'JML_LUNAS_MANDIRI_21', 'dt' => 'JML_LUNAS_MANDIRI_21' ),
    array( 'db' => 'JML_LUNAS_DITEMPAT_21', 'dt' => 'JML_LUNAS_DITEMPAT_21' ),
    array( 'db' => 'JML_SEGEL_MCB_21', 'dt' => 'JML_SEGEL_MCB_21' ),
    array( 'db' => 'JML_CABUT_MCB_21', 'dt' => 'JML_CABUT_MCB_21' ),
    array( 'db' => 'JML_CABUT_APP_21', 'dt' => 'JML_CABUT_APP_21' ),
    array( 'db' => 'JML_RUMAH_KOSONG_21', 'dt' => 'JML_RUMAH_KOSONG_21' ),
    array( 'db' => 'JML_PLG_21', 'dt' => 'JML_PLG_21' ),
    array( 'db' => 'JML_LUNAS_BY_SYSTEM_22', 'dt' => 'JML_LUNAS_BY_SYSTEM_22' ),
    array( 'db' => 'JML_LUNAS_MANDIRI_22', 'dt' => 'JML_LUNAS_MANDIRI_22' ),
    array( 'db' => 'JML_LUNAS_DITEMPAT_22', 'dt' => 'JML_LUNAS_DITEMPAT_22' ),
    array( 'db' => 'JML_SEGEL_MCB_22', 'dt' => 'JML_SEGEL_MCB_22' ),
    array( 'db' => 'JML_CABUT_MCB_22', 'dt' => 'JML_CABUT_MCB_22' ),
    array( 'db' => 'JML_CABUT_APP_22', 'dt' => 'JML_CABUT_APP_22' ),
    array( 'db' => 'JML_RUMAH_KOSONG_22', 'dt' => 'JML_RUMAH_KOSONG_22' ),
    array( 'db' => 'JML_PLG_22', 'dt' => 'JML_PLG_22' ),
    array( 'db' => 'JML_LUNAS_BY_SYSTEM_23', 'dt' => 'JML_LUNAS_BY_SYSTEM_23' ),
    array( 'db' => 'JML_LUNAS_MANDIRI_23', 'dt' => 'JML_LUNAS_MANDIRI_23' ),
    array( 'db' => 'JML_LUNAS_DITEMPAT_23', 'dt' => 'JML_LUNAS_DITEMPAT_23' ),
    array( 'db' => 'JML_SEGEL_MCB_23', 'dt' => 'JML_SEGEL_MCB_23' ),
    array( 'db' => 'JML_CABUT_MCB_23', 'dt' => 'JML_CABUT_MCB_23' ),
    array( 'db' => 'JML_CABUT_APP_23', 'dt' => 'JML_CABUT_APP_23' ),
    array( 'db' => 'JML_RUMAH_KOSONG_23', 'dt' => 'JML_RUMAH_KOSONG_23' ),
    array( 'db' => 'JML_PLG_23', 'dt' => 'JML_PLG_23' ),
    array( 'db' => 'JML_LUNAS_BY_SYSTEM_24', 'dt' => 'JML_LUNAS_BY_SYSTEM_24' ),
    array( 'db' => 'JML_LUNAS_MANDIRI_24', 'dt' => 'JML_LUNAS_MANDIRI_24' ),
    array( 'db' => 'JML_LUNAS_DITEMPAT_24', 'dt' => 'JML_LUNAS_DITEMPAT_24' ),
    array( 'db' => 'JML_SEGEL_MCB_24', 'dt' => 'JML_SEGEL_MCB_24' ),
    array( 'db' => 'JML_CABUT_MCB_24', 'dt' => 'JML_CABUT_MCB_24' ),
    array( 'db' => 'JML_CABUT_APP_24', 'dt' => 'JML_CABUT_APP_24' ),
    array( 'db' => 'JML_RUMAH_KOSONG_24', 'dt' => 'JML_RUMAH_KOSONG_24' ),
    array( 'db' => 'JML_PLG_24', 'dt' => 'JML_PLG_24' ),
    array( 'db' => 'JML_LUNAS_BY_SYSTEM_25', 'dt' => 'JML_LUNAS_BY_SYSTEM_25' ),
    array( 'db' => 'JML_LUNAS_MANDIRI_25', 'dt' => 'JML_LUNAS_MANDIRI_25' ),
    array( 'db' => 'JML_LUNAS_DITEMPAT_25', 'dt' => 'JML_LUNAS_DITEMPAT_25' ),
    array( 'db' => 'JML_SEGEL_MCB_25', 'dt' => 'JML_SEGEL_MCB_25' ),
    array( 'db' => 'JML_CABUT_MCB_25', 'dt' => 'JML_CABUT_MCB_25' ),
    array( 'db' => 'JML_CABUT_APP_25', 'dt' => 'JML_CABUT_APP_25' ),
    array( 'db' => 'JML_RUMAH_KOSONG_25', 'dt' => 'JML_RUMAH_KOSONG_25' ),
    array( 'db' => 'JML_PLG_25', 'dt' => 'JML_PLG_25' ),
    array( 'db' => 'JML_LUNAS_BY_SYSTEM_GT_25', 'dt' => 'JML_LUNAS_BY_SYSTEM_GT_25' ),
    array( 'db' => 'JML_LUNAS_MANDIRI_GT_25', 'dt' => 'JML_LUNAS_MANDIRI_GT_25' ),
    array( 'db' => 'JML_LUNAS_DITEMPAT_GT_25', 'dt' => 'JML_LUNAS_DITEMPAT_GT_25' ),
    array( 'db' => 'JML_SEGEL_MCB_GT_25', 'dt' => 'JML_SEGEL_MCB_GT_25' ),
    array( 'db' => 'JML_CABUT_MCB_GT_25', 'dt' => 'JML_CABUT_MCB_GT_25' ),
    array( 'db' => 'JML_CABUT_APP_GT_25', 'dt' => 'JML_CABUT_APP_GT_25' ),
    array( 'db' => 'JML_RUMAH_KOSONG_GT_25', 'dt' => 'JML_RUMAH_KOSONG_GT_25' ),
    array( 'db' => 'JML_PLG_GT_25', 'dt' => 'JML_PLG_GT_25' ),
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
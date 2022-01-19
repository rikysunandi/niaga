<?php

set_time_limit(-1);
require_once '../../config/config.php';
require_once '../../config/database.php';

$klasifikasi_rab = $_GET['klasifikasi_rab'];
$user = 'SYSTEM';

$params = array(
        array($user, SQLSRV_PARAM_IN),
        array($klasifikasi_rab, SQLSRV_PARAM_IN),
    );

$sql = "EXEC sp_vw_Create_Daftung_Klasifikasi_RAB @UserID = ?, @Klasifikasi_RAB = ? ";
$stmt = sqlsrv_prepare($conn, $sql, $params);

//sqlsrv_execute($stmt);
if(!sqlsrv_execute($stmt)){
    die(print_r( sqlsrv_errors(), true));
}
// DB table to use
$table = 'NIAGA.dbo.vw_kebutuhan_agenda_up';
 
// Table's primary key
$primaryKey = 'UNITUP';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'UNITAP', 'dt' => 'UNITAP' ),
    array( 'db' => 'UNITUP', 'dt' => 'UNITUP' ),
    array( 'db' => 'NAMA', 'dt' => 'NAMA' ),
    array( 'db' => 'METER_1_FASA_PRA', 'dt' => 'METER_1_FASA_PRA' ),
    array( 'db' => 'METER_3_FASA_PRA', 'dt' => 'METER_3_FASA_PRA' ),
    array( 'db' => 'METER_1_FASA_PASCA', 'dt' => 'METER_1_FASA_PASCA' ),
    array( 'db' => 'METER_3_FASA_PASCA', 'dt' => 'METER_3_FASA_PASCA' ),
    array( 'db' => 'MCB_1_FASA_1A', 'dt' => 'MCB_1_FASA_1A' ),
    array( 'db' => 'MCB_1_FASA_2A', 'dt' => 'MCB_1_FASA_2A' ),
    array( 'db' => 'MCB_1_FASA_4A', 'dt' => 'MCB_1_FASA_4A' ),
    array( 'db' => 'MCB_1_FASA_6A', 'dt' => 'MCB_1_FASA_6A' ),
    array( 'db' => 'MCB_1_FASA_10A', 'dt' => 'MCB_1_FASA_10A' ),
    array( 'db' => 'MCB_1_FASA_16A', 'dt' => 'MCB_1_FASA_16A' ),
    array( 'db' => 'MCB_1_FASA_20A', 'dt' => 'MCB_1_FASA_20A' ),
    array( 'db' => 'MCB_1_FASA_25A', 'dt' => 'MCB_1_FASA_25A' ),
    array( 'db' => 'MCB_3_FASA_10A', 'dt' => 'MCB_3_FASA_10A' ),
    array( 'db' => 'MCB_3_FASA_16A', 'dt' => 'MCB_3_FASA_16A' ),
    array( 'db' => 'MCB_3_FASA_20A', 'dt' => 'MCB_3_FASA_20A' ),
    array( 'db' => 'MCB_3_FASA_25A', 'dt' => 'MCB_3_FASA_25A' ),
    array( 'db' => 'MCB_3_FASA_35A', 'dt' => 'MCB_3_FASA_35A' ),
    array( 'db' => 'MCB_3_FASA_50A', 'dt' => 'MCB_3_FASA_50A' ),
    array( 'db' => 'MCB_3_FASA_63A', 'dt' => 'MCB_3_FASA_63A' ),
    array( 'db' => 'MCB_3_FASA_80A', 'dt' => 'MCB_3_FASA_80A' ),
    array( 'db' => 'MCB_3_FASA_100A', 'dt' => 'MCB_3_FASA_100A' ),
    array( 'db' => 'MCB_3_FASA_125A', 'dt' => 'MCB_3_FASA_125A' ),
    array( 'db' => 'MCB_3_FASA_150A', 'dt' => 'MCB_3_FASA_150A' ),
    array( 'db' => 'MCB_3_FASA_200A', 'dt' => 'MCB_3_FASA_200A' ),
    array( 'db' => 'MCB_3_FASA_225A', 'dt' => 'MCB_3_FASA_225A' ),
    array( 'db' => 'MCB_3_FASA_250A', 'dt' => 'MCB_3_FASA_250A' ),
    array( 'db' => 'MCB_3_FASA_300A', 'dt' => 'MCB_3_FASA_300A' ),
    array( 'db' => 'SR_2_10', 'dt' => 'SR_2_10' ),
    array( 'db' => 'SL_4_16', 'dt' => 'SL_4_16' ),
    array( 'db' => 'TIC_3_70', 'dt' => 'TIC_3_70' ),
    array( 'db' => 'FCO', 'dt' => 'FCO' ),
    array( 'db' => 'ARRESTER', 'dt' => 'ARRESTER' ),
    array( 'db' => 'NYY_70', 'dt' => 'NYY_70' ),
    array( 'db' => 'NYY_95', 'dt' => 'NYY_95' ),
    array( 'db' => 'NYY_150', 'dt' => 'NYY_150' ),
    array( 'db' => 'NYY_240', 'dt' => 'NYY_240' ),
    array( 'db' => 'A3CS_150', 'dt' => 'A3CS_150' ),
    array( 'db' => 'PHBTR_2_JUR', 'dt' => 'PHBTR_2_JUR' ),
    array( 'db' => 'PHBTR_4_JUR', 'dt' => 'PHBTR_4_JUR' ),
    array( 'db' => 'TRAFO_100_kVA', 'dt' => 'TRAFO_100_kVA' ),
    array( 'db' => 'TRAFO_160_kVA', 'dt' => 'TRAFO_160_kVA' ),
    array( 'db' => 'TRAFO_250_kVA', 'dt' => 'TRAFO_250_kVA' ),
    array( 'db' => 'ISOLATOR_TUMPU', 'dt' => 'ISOLATOR_TUMPU' ),
    array( 'db' => 'ISOLATOR_ASPAN', 'dt' => 'ISOLATOR_ASPAN' ),
    array( 'db' => 'T_BETON_9_200', 'dt' => 'T_BETON_9_200' ),
    array( 'db' => 'T_BETON_12_200', 'dt' => 'T_BETON_12_200' ),
    array( 'db' => 'T_BETON_12_350', 'dt' => 'T_BETON_12_350' ),
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
<?php

set_time_limit(-1);


// DB table to use
$table = 'NIAGA.dbo.vw_stok_material_up';
 
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
    array( 'db' => 'METER_3_FASA_PASCA_STL', 'dt' => 'METER_3_FASA_PASCA_STL' ),
    array( 'db' => 'MCB_1_FASA_1A', 'dt' => 'MCB_1_FASA_1A' ),
    array( 'db' => 'MCB_1_FASA_2A', 'dt' => 'MCB_1_FASA_2A' ),
    array( 'db' => 'MCB_1_FASA_4A', 'dt' => 'MCB_1_FASA_4A' ),
    array( 'db' => 'MCB_1_FASA_6A', 'dt' => 'MCB_1_FASA_6A' ),
    array( 'db' => 'MCB_1_FASA_10A', 'dt' => 'MCB_1_FASA_10A' ),
    array( 'db' => 'MCB_1_FASA_16A', 'dt' => 'MCB_1_FASA_16A' ),
    array( 'db' => 'MCB_1_FASA_20A', 'dt' => 'MCB_1_FASA_20A' ),
    array( 'db' => 'MCB_1_FASA_25A', 'dt' => 'MCB_1_FASA_25A' ),
    array( 'db' => 'MCB_1_FASA_35A', 'dt' => 'MCB_1_FASA_35A' ),
    array( 'db' => 'MCB_1_FASA_50A', 'dt' => 'MCB_1_FASA_50A' ),
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
    array( 'db' => 'TIC_3_35', 'dt' => 'TIC_3_35' ),
    array( 'db' => 'TIC_3_70', 'dt' => 'TIC_3_70' ),
    array( 'db' => 'FCO', 'dt' => 'FCO' ),
    array( 'db' => 'ARRESTER', 'dt' => 'ARRESTER' ),
    array( 'db' => 'NYY_1X70', 'dt' => 'NYY_1X70' ),
    array( 'db' => 'NYY_1X95', 'dt' => 'NYY_1X95' ),
    array( 'db' => 'NYY_1X150', 'dt' => 'NYY_1X150' ),
    array( 'db' => 'NYY_1X240', 'dt' => 'NYY_1X240' ),
    array( 'db' => 'A3CS_3X70', 'dt' => 'A3CS_3X70' ),
    array( 'db' => 'A3CS_3X150', 'dt' => 'A3CS_3X150' ),
    array( 'db' => 'A3CS_3X240', 'dt' => 'A3CS_3X240' ),
    array( 'db' => 'TRAFO_50_kVA', 'dt' => 'TRAFO_50_kVA' ),
    array( 'db' => 'TRAFO_100_kVA', 'dt' => 'TRAFO_100_kVA' ),
    array( 'db' => 'TRAFO_160_kVA', 'dt' => 'TRAFO_160_kVA' ),
    array( 'db' => 'TRAFO_200_kVA', 'dt' => 'TRAFO_200_kVA' ),
    array( 'db' => 'TRAFO_250_kVA', 'dt' => 'TRAFO_250_kVA' ),
    array( 'db' => 'TRAFO_400_kVA', 'dt' => 'TRAFO_400_kVA' ),
    array( 'db' => 'TRAFO_630_kVA', 'dt' => 'TRAFO_630_kVA' ),
    array( 'db' => 'LVSB_2JUR_OD', 'dt' => 'LVSB_2JUR_OD' ),
    array( 'db' => 'LVSB_4JUR_OD', 'dt' => 'LVSB_4JUR_OD' ),
    array( 'db' => 'LVSB_6JUR_ID', 'dt' => 'LVSB_6JUR_ID' ),
    array( 'db' => 'ISOLATOR_TUMPU_POLYMER', 'dt' => 'ISOLATOR_TUMPU_POLYMER' ),
    array( 'db' => 'ISOLATOR_TUMPU_KERAMIK', 'dt' => 'ISOLATOR_TUMPU_KERAMIK' ),
    array( 'db' => 'ISOLATOR_ASPAN_POLYMER', 'dt' => 'ISOLATOR_ASPAN_POLYMER' ),
    array( 'db' => 'ISOLATOR_ASPAN_KERAMIK', 'dt' => 'ISOLATOR_ASPAN_KERAMIK' ),
    array( 'db' => 'MVTIC_3X150', 'dt' => 'MVTIC_3X150' ),
    array( 'db' => 'XLPE_3X240', 'dt' => 'XLPE_3X240' ),
    array( 'db' => 'XLPE_3X300', 'dt' => 'XLPE_3X300' ),
    array( 'db' => 'KUBIKEL_LBS', 'dt' => 'KUBIKEL_LBS' ),
    array( 'db' => 'KUBIKEL_METER', 'dt' => 'KUBIKEL_METER' ),
    array( 'db' => 'KUBIKEL_FUSE', 'dt' => 'KUBIKEL_FUSE' ),
    array( 'db' => 'TGL_DATA', 'dt' => 'TGL_DATA' ),
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
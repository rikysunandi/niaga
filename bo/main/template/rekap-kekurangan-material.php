<?php include 'parts/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- <link href="../../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet">

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/datatable-sm.css?time=<?php echo time() ?>" rel="stylesheet">
    
</head>

<body>
    
    <?php include 'parts/preloader.php'; ?>
    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include 'parts/header.php'; ?>
        <?php include 'parts/sidebar.php'; ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col p-md-0">
                        <h4>Rekap Kekurangan Material per Unit</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a>
                            </li>
                            <li class="breadcrumb-item active">Rekap Kekurangan Material per Unit</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Rekap Kekurangan Material per UP3</h4>
                                <div class="table-responsive">
                                    <table id="tbl_kekurangan_material" class="table table-striped table-bordered stripe nowrap" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary-lighten-2">UNITAP</th>
                                                <th class="bg-primary-lighten-2">NAMA<br/>UNIT</th>
                                                <th class='bg-primary-lighten-2'>METER<br/>1ɸ PRA</th>
                                                <th class='bg-primary-lighten-2'>METER<br/>3ɸ PASCA</th>
                                                <th class='bg-secondary-lighten-2'>METER<br/>1ɸ PASCA</th>
                                                <th class='bg-secondary-lighten-2'>METER<br/>3ɸ PRA</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>1ɸ 1A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>1ɸ 2A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>1ɸ 4A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>1ɸ 6A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>1ɸ 10A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>1ɸ 16A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>1ɸ 20A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>1ɸ 25A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>3ɸ 10A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>3ɸ 16A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>3ɸ 20A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>3ɸ 25A</th>
                                                <th class='bg-primary-lighten-2'>MCB<br/>3ɸ 35A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 50A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 63A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 80A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 100A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 125A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 150A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 200A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 225A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 250A</th>
                                                <th class='bg-secondary-lighten-2'>MCB<br/>3ɸ 300A</th>
                                                <th class='bg-primary-lighten-2'>SR 2X10</th>
                                                <th class='bg-primary-lighten-2'>SL 4X16</th>
                                                <th class='bg-primary-lighten-2'>TIC 3X70</th>
                                                <th class='bg-primary-lighten-2'>FCO</th>
                                                <th class='bg-primary-lighten-2'>ARRESTER</th>
                                                <th class='bg-primary-lighten-2'>NYY 70</th>
                                                <th class='bg-primary-lighten-2'>NYY 95</th>
                                                <th class='bg-primary-lighten-2'>NYY 150</th>
                                                <th class='bg-primary-lighten-2'>NYY 240</th>
                                                <th class='bg-primary-lighten-2'>A3CS 150</th>
                                                <th class='bg-primary-lighten-2'>PHBTR<br/>2 JUR</th>
                                                <th class='bg-primary-lighten-2'>PHBTR<br/>4 JUR</th>
                                                <th class='bg-primary-lighten-2'>TRAFO<br/>100 kVA</th>
                                                <th class='bg-primary-lighten-2'>TRAFO<br/>160 kVA</th>
                                                <th class='bg-primary-lighten-2'>TRAFO<br/>250 kVA</th>
                                                <th class='bg-primary-lighten-2'>ISOLATOR<br/>TUMPU</th>
                                                <th class='bg-primary-lighten-2'>ISOLATOR<br/>ASPAN</th>
                                                <th class='bg-secondary-lighten-2'>T. BETON<br/>9/200</th>
                                                <th class='bg-secondary-lighten-2'>T. BETON<br/>12/200</th>
                                                <th class='bg-secondary-lighten-2'>T. BETON<br/>12/350</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="bg-primary-lighten-2" colspan="2">TOTAL</th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                                <th class="bg-secondary-lighten-2"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
            <!-- #/ container -->
        </div>
                
        <!--**********************************
            Content body end
        ***********************************-->
        
        

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>

    <?php include 'parts/footer.php'; ?>

    
    
    <script src="../../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables/js/dataTables.buttons.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js "></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>

    <script src="../js/pages/rekap-kekurangan-material.js"></script>
</body>
</html>
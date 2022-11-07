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
                        <h4>Rekap Agenda per Unit</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a>
                            </li>
                            <li class="breadcrumb-item active">Rekap Agenda per Unit</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Rekap Agenda per UP3</h4>
                                <div class="table-responsive">
                                    <table id="tbl_rekap_agenda" class="table table-striped table-bordered stripe nowrap" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="bg-primary-lighten-2">UNITAP</th>
                                                <th rowspan="2" class="bg-primary-lighten-2">NAMA<br/>UNIT</th>
                                                <th rowspan="2" class="bg-primary-lighten-2">JML<br/>AGENDA</th>
                                                <th colspan="2" class="bg-primary-lighten-2">JENIS AGENDA</th>
                                                <th colspan="3" class="bg-primary-lighten-2">SEGMEN TEGANGAN</th>
                                                <th colspan="7" class="bg-primary-lighten-2">KETERANGAN TRANSAKSI</th>
                                                <th rowspan="2" class="bg-success-lighten-2">KONSUMEN INDIVIDU 450 & 900 VA<br/>TANPA PERLUASAN</th>
                                                <th rowspan="2" class="bg-success-lighten-2">KONSUMEN INDIVIDU<br/>BP > INVESTASI</th>
                                                <th rowspan="2" class="bg-success-lighten-2">KONSUMEN KOLEKTIF<br/>TOTAL BP > TOTAL INVESTASI</th>
                                                <th rowspan="2" class="bg-warning-lighten-2">KONSUMEN BP < INVESTASI</th>
                                                <th rowspan="2" class="bg-primary-lighten-2">TOTAL RAB</th>
                                            </tr>
                                            <tr>
                                                <th class="bg-primary-lighten-2">INDIVIDU</th>
                                                <th class="bg-primary-lighten-2">KOLEKTIF</th>
                                                <th class="bg-primary-lighten-2">TR</th>
                                                <th class="bg-primary-lighten-2">TM</th>
                                                <th class="bg-primary-lighten-2">TT</th>
                                                <th class="bg-primary-lighten-2">PASANG BARU</th>
                                                <th class="bg-primary-lighten-2">TAMBAH DAYA</th>
                                                <th class="bg-primary-lighten-2">TURUN DAYA</th>
                                                <th class="bg-primary-lighten-2">UBAH TARIF</th>
                                                <th class="bg-primary-lighten-2">MIGRASI PRA</th>
                                                <th class="bg-primary-lighten-2">MIGRASI PASKA</th>
                                                <th class="bg-primary-lighten-2">SAMBUNG KEMBALI</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="bg-primary-lighten-2" colspan="2">TOTAL</th>
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
                                                <th class="bg-success-lighten-2"></th>
                                                <th class="bg-success-lighten-2"></th>
                                                <th class="bg-success-lighten-2"></th>
                                                <th class="bg-warning-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Rekap Agenda per ULP</h4>
                                <div class="table-responsive">
                                    <table id="tbl_rekap_agenda_up" class="table table-striped table-bordered stripe nowrap" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary-lighten-2" rowspan="2">UNITAP</th>
                                                <th class="bg-primary-lighten-2" rowspan="2">UNITUP</th>
                                                <th class="bg-primary-lighten-2" rowspan="2">NAMA<br/>UNIT</th>
                                                <th class="bg-primary-lighten-2" rowspan="2">JML<br/>AGENDA</th>
                                                <th class="bg-primary-lighten-2" colspan="2">JENIS AGENDA</th>
                                                <th class="bg-primary-lighten-2" colspan="3">SEGMEN TEGANGAN</th>
                                                <th class="bg-primary-lighten-2" colspan="7">KETERANGAN TRANSAKSI</th>
                                                <th rowspan="2" class="bg-success-lighten-2">KONSUMEN INDIVIDU 450 & 900 VA<br/>TANPA PERLUASAN</th>
                                                <th rowspan="2" class="bg-success-lighten-2">KONSUMEN INDIVIDU<br/>BP > INVESTASI</th>
                                                <th rowspan="2" class="bg-success-lighten-2">KONSUMEN KOLEKTIF<br/>TOTAL BP > TOTAL INVESTASI</th>
                                                <th rowspan="2" class="bg-warning-lighten-2">KONSUMEN BP < INVESTASI</th>
                                                <th rowspan="2" class="bg-primary-lighten-2">TOTAL RAB</th>
                                            </tr>
                                            <tr>
                                                <th class="bg-primary-lighten-2">INDIVIDU</th>
                                                <th class="bg-primary-lighten-2">KOLEKTIF</th>
                                                <th class="bg-primary-lighten-2">TR</th>
                                                <th class="bg-primary-lighten-2">TM</th>
                                                <th class="bg-primary-lighten-2">TT</th>
                                                <th class="bg-primary-lighten-2">PASANG BARU</th>
                                                <th class="bg-primary-lighten-2">TAMBAH DAYA</th>
                                                <th class="bg-primary-lighten-2">TURUN DAYA</th>
                                                <th class="bg-primary-lighten-2">UBAH TARIF</th>
                                                <th class="bg-primary-lighten-2">MIGRASI PRA</th>
                                                <th class="bg-primary-lighten-2">MIGRASI PASKA</th>
                                                <th class="bg-primary-lighten-2">SAMBUNG KEMBALI</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="bg-primary-lighten-2" colspan="3">TOTAL</th>
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
                                                <th class="bg-success-lighten-2"></th>
                                                <th class="bg-success-lighten-2"></th>
                                                <th class="bg-success-lighten-2"></th>
                                                <th class="bg-warning-lighten-2"></th>
                                                <th class="bg-primary-lighten-2"></th>
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

    <?php include 'parts/footer.php'; ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    
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

    <script src="../js/pages/rekap-agenda-ap.js"></script>
</body>
</html>
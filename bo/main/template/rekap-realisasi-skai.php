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
    <link href="../../assets/plugins/datatables-lib/DataTables-1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/FixedColumns-4.0.1/css/fixedColumns.bootstrap4.min.css">
    <link href="../../assets/plugins/datatables-lib/Buttons-2.1.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/Responsive-2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/RowGroup-1.1.4/css/rowGroup.dataTables.min.css" rel="stylesheet">

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
                        <h4>Realisasi SKAI - Lampiran Formulir 8</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">SKAI Khusus</a>
                            </li>
                            <li class="breadcrumb-item active">Lampiran Formulir 8</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="mb-4">
                                    <form action="#">
                                        <div class="form-row">
                                            <div class="form-group mb-0 mr-4">
                                                <select id="sel_unitupi" class="selectpicker show-tick" data-size="5" >
                                                    <option selected disabled>Pilih Unit Induk</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0 mr-4">
                                                <select id="sel_unitap" class="selectpicker show-tick" data-size="5" >
                                                    <option selected disabled>Pilih UP3</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0 mr-4">
                                                <select id="sel_unitup" class="selectpicker show-tick" data-size="5" >
                                                    <option selected disabled>Pilih ULP</option>
                                                </select>
                                            </div>
                                            <div class="text-right">
                                                <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Cari <span class="btn-icon-right"><i
                                                class="fa fa-search"></i></span>

                                               <!--  <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbl_formulir_8" class="table table-striped table-bordered stripe nowrap" style="width: 90%">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-primary-lighten-2" rowspan="3">TARIF</th>
                                            <th class="text-center bg-primary-lighten-2" rowspan="3">NO</th>
                                            <th class="text-center bg-primary-lighten-2" rowspan="3">KET GOL TARIF</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="7">KONSUMEN INDIVIDU<br/>450 DAN 900 VA TANPA PERLUASAN</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="7">KONSUMEN INDIVIDU<br/>BP > INVESTASI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="7">KONSUMEN KOLEKTIF<br/>TOTAL BP > TOTAL INVESTASI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="7">KONSUMEN<br/>BP < INVESTASI</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-primary-lighten-2" colspan="3">PENETAPAN AI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="4">REALISASI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="3">PENETAPAN AI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="4">REALISASI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="3">PENETAPAN AI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="4">REALISASI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="3">PENETAPAN AI</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="4">REALISASI</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-primary-lighten-2">JML KONSUMEN</th>
                                            <th class="text-center bg-primary-lighten-2">POTENSI BP (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">AI (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">JML KONSUMEN</th>
                                            <th class="text-center bg-primary-lighten-2">PENDAPATAN BP (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">AI TERKONTRAK (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">RENCANA BAYAR</th>
                                            <th class="text-center bg-primary-lighten-2">JML KONSUMEN</th>
                                            <th class="text-center bg-primary-lighten-2">POTENSI BP (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">AI (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">JML KONSUMEN</th>
                                            <th class="text-center bg-primary-lighten-2">PENDAPATAN BP (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">AI TERKONTRAK (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">RENCANA BAYAR</th>
                                            <th class="text-center bg-primary-lighten-2">JML KONSUMEN</th>
                                            <th class="text-center bg-primary-lighten-2">POTENSI BP (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">AI (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">JML KONSUMEN</th>
                                            <th class="text-center bg-primary-lighten-2">PENDAPATAN BP (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">AI TERKONTRAK (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">RENCANA BAYAR</th>
                                            <th class="text-center bg-primary-lighten-2">JML KONSUMEN</th>
                                            <th class="text-center bg-primary-lighten-2">POTENSI BP (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">AI (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">JML KONSUMEN</th>
                                            <th class="text-center bg-primary-lighten-2">PENDAPATAN BP (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">AI TERKONTRAK (RP)</th>
                                            <th class="text-center bg-primary-lighten-2">RENCANA BAYAR</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2"></th>
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
    <script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/rekap-realisasi-skai.js"></script>
</body>
</html>
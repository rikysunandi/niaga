<?php session_start()?>
<?php if(empty($_SESSION['username'])): ?>
    <?php header('Location: login.php'); ?>
<?php endif; ?>

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
                        <h4>Rekap Pelunasan per Tgl Bayar</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pelunasan Piutang</a>
                            </li>
                            <li class="breadcrumb-item active">Rekap Pelunasan per Tgl Bayar</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kriteria Pencarian</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-0">
                                    <form action="#">
                                        <div class="form-row">
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">UID</label>
                                                <select id="sel_unitupi" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option disabled>Pilih Unit Induk</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">UP3</label>
                                                <select id="sel_unitap" class="selectpicker show-tick" data-size="5" data-inc-semua="Y" >
                                                    <option disabled>Pilih UP3</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">ULP</label>
                                                <select id="sel_unitup" class="selectpicker show-tick" data-size="5" data-inc-semua="Y" >
                                                    <option disabled>Pilih ULP</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">BLTH REK</label>
                                                <select id="sel_blth" class="selectpicker select-sm show-tick" data-size="5" data-width="fit">
                                                    <option value="<?php echo date('Ym') ?>" selected="selected"><?php echo date('Ym') ?></option>
                                                    <option data-divider="true"></option>
                                                    <option value='<?php echo date('Ym', strtotime("last day of previous month")) ?>'><?php echo date('Ym', strtotime("last day of previous month")) ?></option>
                                                    <option value='<?php echo date('Ym', strtotime("-2 month")) ?>'><?php echo date('Ym', strtotime("-2 month")) ?></option>
                                                    <option value='<?php echo date('Ym', strtotime("-3 month")) ?>'><?php echo date('Ym', strtotime("-3 month")) ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right mt-2">
                                    <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Cari <span class="btn-icon-right"><i
                                        class="fa fa-search"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pelunasan Non Kogol 1</h4>
                            </div>
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Rekap Pelunasan per Tgl Bayar</h4> -->
                                <div class="table-responsive">
                                    <table id="tbl_rekap_tglbayar" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <!-- <th rowspan="2" class="text-center bg-primary-lighten-2">UNITAP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNITUP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">ULP</th> -->
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">TGL <br/>BAYAR</th>
                                            <th colspan="2" class="text-center bg-danger-lighten-2">JML IRISAN</th>
                                            <th colspan="2" class="text-center bg-warning-lighten-2">JML BARU</th>
                                            <th colspan="2" class="text-center bg-success-lighten-2">JML LANCAR</th>
                                            <th colspan="2" class="text-center bg-primary-lighten-2">JML LUNAS</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-danger-lighten-2">LBR</th>
                                            <th class="text-center bg-danger-lighten-2">RUPIAH</th>
                                            <th class="text-center bg-warning-lighten-2">LBR</th>
                                            <th class="text-center bg-warning-lighten-2">RUPIAH</th>
                                            <th class="text-center bg-success-lighten-2">LBR</th>
                                            <th class="text-center bg-success-lighten-2">RUPIAH</th>
                                            <th class="text-center bg-primary-lighten-2">LBR</th>
                                            <th class="text-center bg-primary-lighten-2">RUPIAH</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2">TOTAL</th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Trend Pelunasan Per Tanggal</h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas id="chart_tgl_bayar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- 
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">MoM Trend Pelunasan</h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas id="chart_mom_tgl_bayar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 -->
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

    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/datatables-lib/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables-lib/DataTables-1.11.3/js/dataTables.bootstrap4.min.js "></script>
    <script src="../../assets/plugins/datatables-lib/Buttons-2.1.1/js/dataTables.buttons.min.js" ></script>
    <script src="../../assets/plugins/datatables-lib/Buttons-2.1.1/js/buttons.bootstrap4.min.js "></script>
    <!-- <script src="../../assets/plugins/datatables-lib/Buttons-2.1.1/js/buttons.flash.min.js"></script> -->
    <script src="../../assets/plugins/datatables-lib/Buttons-2.1.1/js/buttons.html5.min.js"></script>
    <script src="../../assets/plugins/datatables-lib/Buttons-2.1.1/js/buttons.print.min.js"></script>
    <script src="../../assets/plugins/datatables-lib/Buttons-2.1.1/js/buttons.colVis.min.js"></script>
    <script src="../../assets/plugins/datatables-lib/JSZip-2.5.0/jszip.min.js"></script>
    <script src="../../assets/plugins/datatables-lib/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../../assets/plugins/datatables-lib/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../../assets/plugins/datatables-lib/Responsive-2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="../../assets/plugins/datatables-lib/plug-ins/api/sum().js"></script>
    <script src="../../assets/plugins/datatables-lib/DateTime-1.1.1/js/dataTables.dateTime.min.js"></script>
    <script src="../../assets/plugins/chart.js/Chart.bundle-3.5.1.min.js"></script>
    <script src="../../assets/plugins/chartjs-plugin-datalabels/chartjs-plugin-datalabels-2.min.js"></script>

    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/rekap-tgl-bayar.js?time=223"></script>
</body>
</html>
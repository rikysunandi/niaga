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
                        <h4>Monitoring Upload Sorek</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Upload Data</a>
                            </li>
                            <li class="breadcrumb-item active">Monitoring Upload Sorek</li>
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
                                                <select id="sel_unitap" class="selectpicker show-tick" data-size="5" >
                                                    <option disabled>Pilih UP3</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">ULP</label>
                                                <select id="sel_unitup" class="selectpicker show-tick" data-size="5" >
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
                                <h4 class="card-title">Monitoring Upload Sorek semua Kogol (OLAP AP2T)</h4>
                            </div>
                            <div class="card-body">
                                <p><span class="text-warning">Jika terdapat selisih beberapa pelanggan, hal tersebut dimungkinkan mutasi unit setelah proses billing atau data EIS belum closing</span></p>
                                <p>Untuk menetapkan WO Intimasi dan agar dapat didownload di HP Petugas, silahkan lakukan prosesnya <a href="wo-intimasi.php" class="badge badge-primary" target="_blank">di sini</a>
                                </p>
                                <div class="table-responsive">
                                    <table id="tbl_upload_sorek" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNITAP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UP3</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNITUP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">ULP</th>
                                            <th colspan="3" class="text-center bg-success-lighten-2">VERSI REKAP EIS</th>
                                            <th colspan="3" class="text-center bg-success-lighten-2">SOREK YANG DIUPLOAD</th>
                                            <th rowspan="2" class="text-center bg-warning-lighten-2">SELISIH<br/>LEMBAR</th>
                                            <th colspan="8" class="text-center bg-success-lighten-2">KDPROSESKLP YANG DIUPLOAD</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-success-lighten-2">LEMBAR</th>
                                            <th class="text-center bg-success-lighten-2">PEMKWH</th>
                                            <th class="text-center bg-success-lighten-2">RPPTL</th>
                                            <th class="text-center bg-success-lighten-2">LEMBAR</th>
                                            <th class="text-center bg-success-lighten-2">PEMKWH</th>
                                            <th class="text-center bg-success-lighten-2">RPPTL</th>
                                            <th class="text-center bg-success-lighten-2">A</th>
                                            <th class="text-center bg-success-lighten-2">AI</th>
                                            <th class="text-center bg-success-lighten-2">T</th>
                                            <th class="text-center bg-success-lighten-2">T1</th>
                                            <th class="text-center bg-success-lighten-2">T2</th>
                                            <th class="text-center bg-success-lighten-2">T3</th>
                                            <th class="text-center bg-success-lighten-2">T4</th>
                                            <th class="text-center bg-success-lighten-2">T5</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2" colspan="4">TOTAL</th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-warning-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                            <th class="text-right bg-success-lighten-2"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Sample 100 data belum diupload / belum lunas</h4>
                                <div class="table-responsive">
                                    <table id="tbl_detail_upload" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-primary-lighten-2">UNITUP</th>
                                            <th class="text-center bg-primary-lighten-2">IDPEL</th>
                                            <th class="text-center bg-primary-lighten-2">NAMA</th>
                                            <th class="text-center bg-primary-lighten-2">KOGOL</th>
                                            <th class="text-center bg-primary-lighten-2">TARIF</th>
                                            <th class="text-center bg-primary-lighten-2">DAYA</th>
                                            <th class="text-center bg-primary-lighten-2">PEMKWH</th>
                                            <th class="text-center bg-primary-lighten-2">RPPTL</th>
                                        </tr>
                                    </thead>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

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
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/mon-upload-sorek.js?time=23"></script>
</body>
</html>
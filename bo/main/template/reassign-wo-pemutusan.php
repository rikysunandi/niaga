<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowgroup/1.1.3/css/rowGroup.dataTables.min.css" rel="stylesheet">

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
                        <h4>Re-Assign / Crossing Workorder Pemutusan</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemutusan</a>
                            </li>
                            <li class="breadcrumb-item active">Re-Assign Workorder Pemutusan</li>
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
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block"><small>UID</small></label>
                                                <select id="sel_unitupi" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option disabled>Pilih Unit Induk</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block"><small>UP3</small></label>
                                                <select id="sel_unitap" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option disabled>Pilih UP3</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block"><small>ULP</small></label>
                                                <select id="sel_unitup" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option disabled>Pilih ULP</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block"><small>BLTH</label></small>
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
                                <h4 class="card-title">Data WO Pemutusan</h4>
                            </div>
                            <div class="card-body">
                                <p>
                                    Sebelum melakukan Re-Assign Sisa WO Pemutusan, silahkan tetapkan terlebih dahulu WO Pemutusan default sesuai Petugas dan RBM masing-masing Pelanggan
                                </p>
                                <div class="table-responsive">
                                    <table id="tbl_wo_pemutusan" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">BLTH</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNITUPI</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNITAP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNITUP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">ULP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">RBM</th>
                                            <th class="text-center bg-primary-lighten-2" colspan="4">WORKORDER PEMUTUSAN</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">SDH LUNAS /<br/>SDH PUTUS</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">SISA WO</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">PETUGAS</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">KETERANGAN</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-success-lighten-2">JML LANCAR</th>
                                            <th class="text-center bg-warning-lighten-2">JML BARU</th>
                                            <th class="text-center bg-danger-lighten-2">JML IRISAN</th>
                                            <th class="text-center bg-primary-lighten-2">TOTAL PLG</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2" colspan="6">TOTAL</th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
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
                            <!-- <div class="card-footer">
                                <div class="text-right mt-2">
                                    <button id="btn_wo" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Re-Assign WO <span class="btn-icon-right"><i
                                        class="fa fa-gear"></i></span>
                                    </button>
                                </div>
                            </div> -->
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
    <script src="https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js"></script>
    <script src="../../assets/plugins/bootstrap4-notify/bootstrap-notify.min.js"></script>
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/reassign-wo-pemutusan.js?time=2"></script>
</body>
</html>
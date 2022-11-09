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

    <style type="text/css">
        
        #table_lunas table tbody tr{
            cursor: pointer;
        }
        #table_lunas table tbody tr:hover {
          box-shadow: 0 2px 2px 0 #74BCC7;
          transform: translateY(-2px);
        }
        #table_lunas table *{
            font-size: 0.92em;
        }
        /* .chart-card{
            min-height: 400px;
        } */
    </style>

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
                        <h4>Rekap Pelunasan Berdasarkan Pola Bayar</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pelunasan Piutang</a>
                            </li>
                            <li class="breadcrumb-item active">Rekap Pelunasan Berdasarkan Pola Bayar</li>
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
                            <div class="card-body">
                                <h4 class="card-title mb-4">Saldo per PIC</h4>
                                <div class="table-responsive">
                                    <table id="tbl_rekap_lunas_intimasi" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">KODE</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">UNIT</th>
                                            <th colspan="4" class="text-center bg-primary-lighten-2">WORK ORDER</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">MUTASI</th>
                                            <th colspan="4" class="text-center bg-primary-lighten-2">LUNAS</th>
                                            <th colspan="4" class="text-center bg-primary-lighten-2">SALDO</th>
                                            <th colspan="5" class="text-center bg-primary-lighten-2">MONITORING JUMLAH PLG IRISAN PER PIC</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">% PELUNASAN<br/>PLG IRISAN</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">TGLBAYAR<br/>TERAKHIR</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th rowspan="2" class="text-center bg-warning-lighten-2">BARU</th>
                                            <th colspan="2" class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th rowspan="2" class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th rowspan="2" class="text-center bg-warning-lighten-2">BARU</th>
                                            <th colspan="2" class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th rowspan="2" class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th rowspan="2" class="text-center bg-warning-lighten-2">BARU</th>
                                            <th colspan="2" class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">MUP3</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">MBSAR</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">MULP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">SPV</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">BILLER</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-secondary-lighten-2">PLG</th>
                                            <th class="text-center bg-secondary-lighten-2">RPPTL</th>
                                            <th class="text-center bg-secondary-lighten-2">PLG</th>
                                            <th class="text-center bg-secondary-lighten-2">RPPTL</th>
                                            <th class="text-center bg-secondary-lighten-2">PLG</th>
                                            <th class="text-center bg-secondary-lighten-2">RPPTL</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2" colspan="2">TOTAL</th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
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
                            <div class="card-footer">
                                <p><small class="float-right text-small text-primary">*Klik pada angka-angka diatas untuk melihat detail data</small></p>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Ranking ULP</h4>
                                <div class="table-responsive">
                                    <table id="tbl_rekap_lunas_intimasi_up" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">NO</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">KODE</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNIT</th>
                                            <th colspan="3" class="text-center bg-primary-lighten-2">WORK ORDER</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">MUTASI</th>
                                            <th colspan="3" class="text-center bg-primary-lighten-2">LUNAS</th>
                                            <th colspan="3" class="text-center bg-primary-lighten-2">SALDO</th>
                                            <th colspan="5" class="text-center bg-primary-lighten-2">MONITORING SALDO PLG IRISAN PER PIC</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">% PELUNASAN<br/>PLG IRISAN</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">TGLBAYAR<br/>TERAKHIR</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th class="text-center bg-warning-lighten-2">BARU</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th class="text-center bg-warning-lighten-2">BARU</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th class="text-center bg-warning-lighten-2">BARU</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">MUP3</th>
                                            <th class="text-center bg-primary-lighten-2">MBSAR</th>
                                            <th class="text-center bg-primary-lighten-2">MULP</th>
                                            <th class="text-center bg-primary-lighten-2">SPV</th>
                                            <th class="text-center bg-primary-lighten-2">BILLER</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2" colspan="3">TOTAL</th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
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


                <div class="row">
                    <div class="col-12">
                        <div class="card pelunasan">
                            <div class="card-header">
                                <h4 class="card-title">GRAFIK TREND PELUNASAN</h4>
                            </div>
                            <div class="card-body">


                                <ul id="tab_pelunasan" class="nav nav-tabs" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link text-danger" href="#chart_irisan" role="tab" data-toggle="tab">IRISAN</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link text-warning" href="#chart_baru" role="tab" data-toggle="tab">BARU</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link text-success" href="#chart_lancar" role="tab" data-toggle="tab">LANCAR</a>
                                  </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                  <div role="tabpanel" class="tab-pane fade" id="chart_irisan">
                                    <div class="text-right mt-4">
                                        <button type="button" data-status="IRISAN" class="btn btn-sm btn-primary btn-export">Export Saldo Irisan<span class="btn-icon-right"><i class="fa fa-file-excel-o"></i></span>
                                        </button>
                                    </div>
                                    <div class="chart-card">
                                        <canvas id="chart_pelunasan_irisan"></canvas>
                                    </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade chart-card" id="chart_baru">
                                    <div class="text-right mt-4">
                                        <button type="button" data-status="BARU" class="btn btn-sm btn-primary btn-export">Export Saldo Baru<span class="btn-icon-right"><i class="fa fa-file-excel-o"></i></span>
                                        </button>
                                    </div>
                                    <div class="chart-card">
                                        <canvas id="chart_pelunasan_baru"></canvas>
                                    </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade chart-card" id="chart_lancar">
                                    <div class="chart-card">
                                        <canvas id="chart_pelunasan_lancar"></canvas>
                                    </div>
                                  </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Rekap Per Tanggal Bayar</h4>
                                <div class="table-responsive">
                                    <table id="tbl_rekap_tglbayar" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">TANGGAL</th>
                                            <th colspan="5" class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th colspan="5" class="text-center bg-warning-lighten-2">BARU</th>
                                            <th colspan="5" class="text-center bg-success-lighten-2">LANCAR</th>
                                            <th colspan="5" class="text-center bg-primary-lighten-2">TOTAL</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-danger-lighten-2">SALDO<br/>AWAL<br/>(a)</th>
                                            <th class="text-center bg-danger-lighten-2">LUNAS<br/>(b)</th>
                                            <th class="text-center bg-danger-lighten-2">SALDO<br/>AKHIR<br/>(c)</th>
                                            <th class="text-center bg-danger-lighten-2">TARGET<br/>SALDO<br/>(d)</th>
                                            <th class="text-center bg-danger-lighten-2">REALISASI<br/>(e=(2-(c/d))*100%)</th>
                                            <th class="text-center bg-warning-lighten-2">SALDO<br/>AWAL<br/>(f)</th>
                                            <th class="text-center bg-warning-lighten-2">LUNAS<br/>(g)</th>
                                            <th class="text-center bg-warning-lighten-2">SALDO<br/>AKHIR<br/>(h)</th>
                                            <th class="text-center bg-warning-lighten-2">TARGET<br/>SALDO<br/>(i)</th>
                                            <th class="text-center bg-warning-lighten-2">REALISASI<br/>(j=(2-(h/i))*100%)</th>
                                            <th class="text-center bg-success-lighten-2">SALDO<br/>AWAL<br/>(k)</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>(l)</th>
                                            <th class="text-center bg-success-lighten-2">SALDO<br/>AKHIR<br/>(m)</th>
                                            <th class="text-center bg-success-lighten-2">TARGET<br/>SALDO<br/>(n)</th>
                                            <th class="text-center bg-success-lighten-2">REALISASI<br/>(o=(2-(m/n))*100%)</th>
                                            <th class="text-center bg-primary-lighten-2">SALDO<br/>AWAL<br/>(p)</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>(q)</th>
                                            <th class="text-center bg-primary-lighten-2">SALDO<br/>AKHIR<br/>(r)</th>
                                            <th class="text-center bg-primary-lighten-2">TARGET<br/>SALDO<br/>(s)</th>
                                            <th class="text-center bg-primary-lighten-2">REALISASI<br/>(t=(2-(r/s))*100%)</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2">TOTAL</th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                        </tr>
                                    </tfoot> -->
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                    <div id="table_lunas" class="card bg-transparent d-none">
                            <!-- <div class="card-body stat-widget-four" style="background-color: #74BCC7;">
                                <div class="media"> 
                                    <span class="mr-3">
                                        <i class="fa fa-list fa-lg text-white"></i>
                                    </span>
                                    <div class="media-body">
                                        <h4 class="mb-0 pb-0 text-white">PELUNASAN</h4>
                                        <small class="text-sm text-white blth"></small>
                                    </div>
                                </div>
                            </div> -->
                            <div class="p-2">
                                <div class="table-responsive">
                                    <table class="table table-hover table-padded table-responsive-fix-big property-overview-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" rowspan="2">TANGGAL</th>
                                                <th class="text-center text-danger" colspan="5">IRISAN</th>
                                                <th class="text-center text-warning" colspan="5">BARU</th>
                                                <th class="text-center text-success" colspan="5">LANCAR</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center text-danger">SAL AWAL</th>
                                                <th class="text-center text-danger">LUNAS</th>
                                                <th class="text-center text-danger">SALDO</th>
                                                <th class="text-center text-danger">TARGET</th>
                                                <th class="text-center text-danger">REAL</th>
                                                <th class="text-center text-warning">SAL AWAL</th>
                                                <th class="text-center text-warning">LUNAS</th>
                                                <th class="text-center text-warning">SALDO</th>
                                                <th class="text-center text-warning">TARGET</th>
                                                <th class="text-center text-warning">REAL</th>
                                                <th class="text-center text-success">SAL AWAL</th>
                                                <th class="text-center text-success">LUNAS</th>
                                                <th class="text-center text-success">SALDO</th>
                                                <th class="text-center text-success">TARGET</th>
                                                <th class="text-center text-success">REAL</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- 
                <div class="row">
                    <div class="col-12">
                        <div class="card pelunasan">
                            <div class="card-header">
                                <h4 class="card-title">PELANGGAN BARU</h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas id="chart_pelunasan_baru"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card pelunasan">
                            <div class="card-header">
                                <h4 class="card-title">PELANGGAN LANCAR</h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas id="chart_pelunasan_lancar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 -->
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

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/rekap-pola-bayar-lunas.js?time=28"></script>
</body>
</html>
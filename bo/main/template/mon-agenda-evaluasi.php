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
                        <h4>Monitoring Agenda (BP < Investasi)</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">SKAI Khusus</a>
                            </li>
                            <li class="breadcrumb-item active">Monitoring Agenda (BP < Investasi)</li>
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
                                    <table id="tbl_agenda_evaluasi" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-primary-lighten-2">NOAGENDA</th>
                                            <th class="text-center bg-primary-lighten-2">TGL MOHON</th>
                                            <th class="text-center bg-primary-lighten-2">STATUS TMP</th>
                                            <th class="text-center bg-primary-lighten-2">RP BP</th>
                                            <th class="text-center bg-primary-lighten-2">RP RAB</th>
                                            <th class="text-center bg-primary-lighten-2">LAMPIRAN<br/>FORM 5 | 6 | 7</th>
                                            <th class="text-center bg-primary-lighten-2">rWACC</th>
                                            <th class="text-center bg-primary-lighten-2">IRR</th>
                                            <th class="text-center bg-primary-lighten-2">NPV</th>
                                            <th class="text-center bg-primary-lighten-2">PBP</th>
                                            <th class="text-center bg-primary-lighten-2">KET TRANSAKSI</th>
                                            <th class="text-center bg-primary-lighten-2">TARIF<br/>LAMA</th>
                                            <th class="text-center bg-primary-lighten-2">DAYA<br/>LAMA</th>
                                            <th class="text-center bg-primary-lighten-2">TARIF<br/>BARU</th>
                                            <th class="text-center bg-primary-lighten-2">DAYA<br/>BARU</th>
                                            <th class="text-center bg-primary-lighten-2">ALASAN TMP</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>UNITAP</th>
                                            <th>NAMA AP</th>
                                            <th>Saldo 1 Lbr</th>
                                            <th>Saldo 2 Lbr</th>
                                            <th>Saldo >= 3 Lbr</th>
                                            <th>Total RPPTL</th>
                                        </tr>
                                    </tfoot> -->
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
<!-- 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="card_segmen_tegangan" class="card chartjs-stat-card-1">
                                    <div class="card-header">
                                        <h4 class="card-title mb-4 text-dark">Segmen Tegangan</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart_segmen_tegangan"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="card_alasan" class="card chartjs-stat-card-1">
                                    <div class="card-header">
                                        <h4 class="card-title mb-4 text-dark">Alasan Kriteria TMP</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart_alasan"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <div id="card_tanpa_perluasan" class="card chartjs-stat-card-1">
                                    <div class="card-header">
                                        <span class="card-title mb-4 text-dark">Tanpa Perluasan</span>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart_tanpa_perluasan"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div id="card_perluasan_jtr" class="card chartjs-stat-card-1">
                                    <div class="card-header">
                                        <span class="card-title mb-4 text-dark">Perluasan JTR</span>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart_perluasan_jtr"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div id="card_perluasan_jtm" class="card chartjs-stat-card-1">
                                    <div class="card-header">
                                        <span class="card-title mb-4 text-dark">Perluasan JTM 3 Gawang & Trafo</span>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart_perluasan_jtm"></canvas>
                                    </div>
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
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    
    <script src="../../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables/js/dataTables.buttons.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js "></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.60/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.60/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
    <script src="../../assets/plugins/moment/moment.min.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/mon-agenda-evaluasi.js"></script>
</body>
</html>
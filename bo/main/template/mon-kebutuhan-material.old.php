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
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.bootstrap4.min.css" rel="stylesheet"/>

    <link href="../css/style.css" rel="stylesheet">
    <!-- <link href="../css/custom.css" rel="stylesheet"> -->
    
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
                        <h4>Monitoring Kebutuhan Material</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a>
                            </li>
                            <li class="breadcrumb-item active">Monitoring Kebutuhan Material</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Monitoring Kebutuhan Material</h4>
                                <div class="table-responsive">
                                    <table id="tbl_mon_agenda" class="table table-striped table-bordered nowrap" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary-lighten-2">NOAGENDA</th>
                                                <th class="bg-primary-lighten-2">RP BP</th>
                                                <th class="bg-primary-lighten-2">RP RAB</th>
                                                <th class="bg-primary-lighten-2">STATUS</th>
                                                <th class="bg-primary-lighten-2">NOAGENDA<br/>KOLEKTIF</th>
                                                <th class="bg-primary-lighten-2">KET<br/>TRANSAKSI</th>
                                                <th class="bg-primary-lighten-2">ALASAN<br/>KRITERIA TMP</th>
                                                <th class="bg-primary-lighten-2">TARIF<br/>LAMA</th>
                                                <th class="bg-primary-lighten-2">DAYA<br/>LAMA</th>
                                                <th class="bg-primary-lighten-2">TARIF<br/>BARU</th>
                                                <th class="bg-primary-lighten-2">DAYA<br/>BARU</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
                                <div class="table-responsive">
                                    <table id="tbl_mon_material_agenda" class="table table-striped table-bordered nowrap" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary-lighten-2">NOAGENDA</th>
                                                <th class="bg-primary-lighten-2">JENIS</th>
                                                <th class="bg-primary-lighten-2">ID KEBUTUHAN</th>
                                                <th class="bg-primary-lighten-2">KEBUTUHAN</th>
                                                <th class="bg-primary-lighten-2">HARGA SATUAN</th>
                                                <th class="bg-primary-lighten-2">VOLUME</th>
                                                <th class="bg-primary-lighten-2">TOTAL HARGA (Inc.PPN)</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="bg-primary-lighten-2" colspan="6">TOTAL</th>
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
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" ></script>
    <script src="../../assets/plugins/datatables-alteditor/dataTables.altEditor.free.js" ></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/mon-material.js"></script>
</body>
</html>
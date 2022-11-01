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
    <title>Backoffice Niaga | Monitoring TS P2TL</title>
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
        /*body .modal-dialog { 
            max-width: 100%;
            width: auto !important;
            display: inline-block;
        }

        .modal {
          z-index: -1;
          display: flex !important;
          justify-content: center;
          align-items: center;
        }

        .modal-open .modal {
           z-index: 1050;
        }*/
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
                        <h4>Monitoring TS P2TL</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">TS P2TL</a>
                            </li>
                            <li class="breadcrumb-item active">Monitoring TS P2TL</li>
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
                                <div class="mb-4">
                                    <form action="#">
                                        <div class="form-row">
                                            <div class="form-group mb-2 mr-4">
                                                <select id="sel_unitupi" title="UNIT INDUK" class="selectpicker show-tick" data-size="5" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <select id="sel_unitap" title="UP3" class="selectpicker show-tick" data-size="5" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <select id="sel_unitup" title="ULP" class="selectpicker show-tick" data-size="5" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <select id="sel_jenis_plg" title="JENIS PLG" class="selectpicker show-tick" data-size="5" >
                                                    <option value="00">SEMUA DATA</option>
                                                    <option value="PRABAYAR">PRABAYAR</option>
                                                    <option value="PASKABAYAR">PASKABAYAR</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <select id="sel_kategori" title="KATEGORI" class="selectpicker show-tick" data-size="5" >
                                                    <option value="00">SEMUA DATA</option>
                                                    <option value="HIJAU">HIJAU</option>
                                                    <option value="KUNING">KUNING</option>
                                                    <option value="MERAH">MERAH</option>
                                                </select>
                                            </div>
                                            <div class="text-right mt-2">
                                                <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Cari <span class="btn-icon-right"><i
                                                class="fa fa-search"></i></span></button>

                                               <!--  <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button> -->
                                            </div>
                                        </div>
                                    </form>
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
                                    <table id="tbl_mon_ts_p2tl" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-primary-lighten-2">UNITUP</th>
                                            <th class="text-center bg-primary-lighten-2">NOAGENDA</th>
                                            <th class="text-center bg-primary-lighten-2">IDPEL</th>
                                            <th class="text-center bg-primary-lighten-2">NAMA</th>
                                            <th class="text-center bg-primary-lighten-2">TARIF</th>
                                            <th class="text-center bg-primary-lighten-2">DAYA</th>
                                            <th class="text-center bg-primary-lighten-2">KATEGORI</th>
                                            <th class="text-center bg-primary-lighten-2">ANGS AWAL</th>
                                            <th class="text-center bg-primary-lighten-2">ANGS AKHIR</th>
                                            <th class="text-center bg-primary-lighten-2">RPTS</th>
                                            <th class="text-center bg-primary-lighten-2">BA</th>
                                            <th class="text-center bg-primary-lighten-2">TS</th>
                                            <th class="text-center bg-primary-lighten-2">SPH</th>
                                            <th class="text-center bg-primary-lighten-2">CEKLOK</th>
                                            <th class="text-center bg-primary-lighten-2">GARDU</th>
                                            <th class="text-center bg-primary-lighten-2">NOGARDU</th>
                                            <th class="text-center bg-primary-lighten-2">NOTIANG</th>
                                            <th class="text-center bg-primary-lighten-2">KOORDINAT X</th>
                                            <th class="text-center bg-primary-lighten-2">KOORDINAT Y</th>
                                            <th class="text-center bg-primary-lighten-2">AKURASI (m)</th>
                                            <th class="text-center bg-primary-lighten-2">SUMBER KOORDINAT</th>
                                        </tr>
                                    </thead>
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
    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables/js/dataTables.buttons.min.js" ></script>
    <script defer src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js "></script>
    <script defer src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js "></script>
    <script defer src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
    <script defer src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script defer src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script defer src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script defer src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    <script defer src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script defer src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
    <script defer src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/mon-ts-p2tl.js"></script>
</body>
</html>
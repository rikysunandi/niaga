<?php include 'parts/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga | Peta Pembentukan RPP</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="./../../assets/plugins/jstree/dist/themes/default/style.min.css">
    <link href="../../assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <style type="text/css">
        #map {
            width:100%;
            height: 100%;
        }
        .cluster{
          color: #FFFFFF;
          text-align:center;
          font-family: 'Arial, Helvetica';
          font-size:11px;
          font-weight:bold;
          cursor: pointer;
        }
        .cluster-1{
          background-image:url(../../assets/images/m1.png);
          line-height:53px;
          width: 53px;
          height: 52px;
        }
        .cluster-2{
          background-image:url(../../assets/images/m2.png);
          line-height:55px;
          width: 55px;
          height: 54px;
        }
        .cluster-3{
          background-image:url(../../assets/images/m3.png);
          line-height:57px;
          width: 57px;
          height: 56px;
        }
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
                        <h4>Peta Pembentukan RPP</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pembentukan RPP</a>
                            </li>
                            <li class="breadcrumb-item active">Peta Pembentukan RPP</li>
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
                                            <div class="form-group mb-0 mr-4 col-3">
                                                <label class="text-label d-flex flex-column">UNIT INDUK</label>
                                                <select id="sel_unitupi" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
                                                    <option selected disabled>Pilih Unit Induk</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0 mr-4 col-3">
                                                <label class="text-label d-flex flex-column">UP3</label>
                                                <select id="sel_unitap" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
                                                    <option selected disabled>Pilih UP3</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0 mr-4 col-3">
                                                <label class="text-label d-flex flex-column">ULP</label>
                                                <select id="sel_unitup" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
                                                    <option selected disabled>Pilih ULP</option>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group mb-4 col-3">
                                                <label class="text-label">TGL PEMERIKSAAN</label>
                                                <input id="tgl_pemeriksaan_range" class="form-control input-daterange-datepicker" type="text" name="daterange">
                                            </div> -->
                                        </div>
                                    </form>
                                    <div class="text-right">
                                        <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Cari <span class="btn-icon-right"><i
                                        class="fa fa-search"></i></span></button>

                                       <!--  <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button> -->
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
                                <div class="row">
                                    <div class="col-3">
                                        <div id="jstree_basic" style="display:block;height:480px;overflow: auto;">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div style="height:480px;">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                Jumlah Pelanggan: <span id="total_plg">0</span>
                                &nbsp;|&nbsp;
                                Jumlah Titik yang dipilih: <span id="plg_dipilih">0</span>
                                &nbsp;&nbsp;
                                <a id="btn_create" href="#" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-check-circle"></i> Buat RPP</a>
                                <a id="btn_reset" href="#" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-times-circle"></i> Reset</a>
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

    
    
    <!-- <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmTOVYVndxhvTkvCx8eBYBadsM1iYQrv8"></script>

    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="./../../assets/plugins/jstree/dist/jstree.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gmap3/7.2.0/gmap3.min.js"></script>
    <script src="../../assets/plugins/keydragzoom/keydragzoom.js"></script>
    <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>
    <script src="../../assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/rpp-per-gardu.js"></script>

</body>
</html>
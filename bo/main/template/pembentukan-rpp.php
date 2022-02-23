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
    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block"><small>UNIT INDUK</small></label>
                                                <select id="sel_unitupi" title="PILIH UNIT INDUK" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block"><small>UP3</small></label>
                                                <select id="sel_unitap" title="PILIH UP3" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block"><small>ULP</small></label>
                                                <select id="sel_unitup" title="PILIH ULP" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group mb-4 col-3">
                                                <label class="text-label d-block"><small>PETUGAS</small></label>
                                                <select id="sel_petugas" title="PETUGAS" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00">SEMUA PETUGAS</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4 col-3">
                                                <label class="text-label">TGL PEMERIKSAAN</label>
                                                <input id="tgl_pemeriksaan_range" class="form-control input-daterange-datepicker" type="text" name="daterange">
                                            </div> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right mt-2">
                                    <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Cari <span class="btn-icon-right"><i
                                        class="fa fa-search"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Peta Pembentukan RPP</h4>
                            </div>
                            <div class="card-body">
                                <div style="height:480px;">
                                    <div id="map"></div>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="align-middle d-inline">
                                    <span class="fa fa-info-circle"></span> Ada sebanyak <span id="plg_dipilih">0</span> Pelanggan yang dipilih dari total <span id="total_plg">0</span> Pelanggan
                                </div>
                                <button id="btn_create" class="btn btn-primary waves-effect waves-light btn-sm pull-right mr-2">Buat RPP <span class="btn-icon-right"><i class="fa fa-check-circle"></i></span></button>
                                <button id="btn_reset" class="btn btn-secondary waves-effect waves-light btn-sm pull-right mr-2">Bersihkan Pilihan <span class="btn-icon-right"><i class="fa fa-refresh"></i></span></button>
                                <button id="btn_remove" class="btn btn-danger waves-effect waves-light btn-sm pull-right mr-2">Hapus <span class="btn-icon-right"><i class="fa fa-times-circle"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Petugas Tagging dari Pelanggan dipilih</h5>
                            </div>
                            <div class="card-body">
                                <div class="basic-list-group">
                                    <ul id="petugas-selected" class="list-group">
                                        <!-- <li class="list-group-item d-flex justify-content-between align-items-center">Cras
                                            justo odio <span class="badge badge-primary badge-pill">14</span>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Gardu dari Pelanggan Dipilih</h5>
                            </div>
                            <div class="card-body">
                                <div class="basic-list-group">
                                    <ul id="gardu-selected" class="list-group">
                                        
                                    </ul>
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
    
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqznXEC9IjyXrbRdKk1vKWJWLioZixUW8"></script>

    <script src="../../assets/plugins/gmaps/gmap3.js"></script>
    <script src="../../assets/plugins/keydragzoom/keydragzoom.js"></script>
    <!-- <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script> -->
    <script src="../../assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/pembentukan-rpp.js"></script>

</body>
</html>
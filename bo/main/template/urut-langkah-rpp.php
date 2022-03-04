<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga | Pembentukan Urut Langkah RPP</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <!-- <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet"> -->
    <!-- <link href="../../assets/plugins/gmaps/gmap-context-menu.css" rel="stylesheet"> -->

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
                        <h4>Pembentukan Urut Langkah RPP</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pembentukan RPP</a>
                            </li>
                            <li class="breadcrumb-item active">Pembentukan Urut Langkah RPP</li>
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
                                            <div class="form-group mb-4 col-3">
                                                <label class="text-label d-block"><small>PETUGAS</small></label>
                                                <select id="sel_petugas" title="PETUGAS" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00">SEMUA PETUGAS</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4 col-3">
                                                <label class="text-label d-block"><small>RPP</small></label>
                                                <select id="sel_rpp" title="RPP" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00">SEMUA RPP</option>
                                                </select>
                                            </div>
                                            <!-- 
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
                                <h4 class="card-title">Peta Urut Langkah RPP</h4>
                            </div>
                            <div class="card-body">
                                <div>
                                    <p>Silahkan pilih pelanggan pertama (start) dan pelanggan terakhir (end)
                                    </p>
                                </div>
                                <div style="height:500px;">
                                    <div id="map"></div>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="row">
                                    <div class="align-middle d-inline col-6">
                                        <span class="fa fa-info-circle"></span> Urut Langkah <span id="total_plg" class="text-primary"></span>: dari <span id="plg_start" class="text-success">Pelanggan X</span> ke <span id="plg_end" class="text-success">Pelanggan Y</span>
                                        <div id="plg_dipilih"></div>
                                        <div id="info_tagging"></div>
                                    </div>
                                    <div class="col-6">
                                        <button id="btn_create" class="btn btn-primary waves-effect waves-light btn-sm pull-right mr-2">Simpan <span class="btn-icon-right"><i class="fa fa-check-circle"></i></span></button>
                                        <button id="btn_simulasi" class="btn btn-secondary waves-effect waves-light btn-sm pull-right mr-2">Simulasikan <span class="btn-icon-right"><i class="fa fa-gears"></i></span></button>
                                        <button id="btn_generate" class="btn btn-secondary waves-effect waves-light btn-sm pull-right mr-2">Generate <span class="btn-icon-right"><i class="fa fa-gear"></i></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row d-none">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Urutan Langkah</h5>
                            </div>
                            <div class="card-body">
                                <div class="urut-langkah">
                                </div>
                                <!-- <div class="basic-list-group">
                                    <ul id="petugas-selected" class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Cras
                                            justo odio <span class="badge badge-primary badge-pill">14</span>
                                        </li>
                                    </ul>
                                </div> -->
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
        <!-- <div id="confirm_modal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah anda yakin akan menghapus koordinat dari Map?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Ya</button>
              </div>
            </div>
          </div>
        </div> -->
        

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRViwwpnm9OuVSUmErg0PnV4I9t5aCcUw"></script>

    <script src="../../assets/plugins/gmaps/gmap3.js"></script>
    <!-- <script src="../../assets/plugins/gmaps/gmap-context-menu.js"></script> -->
    <script src="../../assets/plugins/keydragzoom/keydragzoom.js"></script>
    <!-- <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script> -->
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/urut-langkah-rpp.js?time=123"></script>

</body>
</html>
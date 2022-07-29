<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga | Review RPP On Site</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../../assets/plugins/datatables-lib/DataTables-1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/FixedColumns-4.0.1/css/fixedColumns.bootstrap4.min.css">
    <link href="../../assets/plugins/datatables-lib/Buttons-2.1.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/Responsive-2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/RowGroup-1.1.4/css/rowGroup.dataTables.min.css" rel="stylesheet">
    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../../assets/plugins/viewer/viewer.css" rel="stylesheet">

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">

    <style type="text/css">
        #map_on_desk {
            width:100%;
            height: 100%;
        }
        #map_on_site {
            width:100%;
            height: 100%;
        }
        #img_foto:hover{
            cursor: pointer;
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
                        <h4>Review RPP Onsite (On develop)</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">RPP</a>
                            </li>
                            <li class="breadcrumb-item active">Review RPP Onsite</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div id="modal_foto" class="modal fade" tabindex="-1" role="dialog">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Hasil Foto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <img id="img_foto" class="img-fluid img-thumbnail mb-2" alt="Foto Pemeriksaan" width="200" height="300">
                                                <small class="float-right">*Klik untuk memperbesar</small>
                                            </div>
                                            <div class="col-6">
                                                <dl class="row">
                                                  <dt class="col-6">IDPEL</dt>
                                                  <dd class="col-6" id="idpel"></dd>
                                                  <dt class="col-6">TANGGAL</dt>
                                                  <dd class="col-6" id="tgl_pemeriksaan">
                                                  <dt class="col-6">PETUGAS</dt>
                                                  <dd class="col-6" id="user_app">
                                                  </dd>
                                                </dl>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-4">
                                    <form action="#">
                                        <div class="form-row">
                                            <div class="form-group mb-4 col-3">
                                                <label class="text-label"><small>UNIT INDUK</small></label>
                                                <select id="sel_unitupi" title="PILIH UNIT INDUK" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4 col-3">
                                                <label class="text-label"><small>UP3</small></label>
                                                <select id="sel_unitap" title="PILIH UP3" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4 col-3">
                                                <label class="text-label"><small>ULP</small></label></label>
                                                <select id="sel_unitup" title="PILIH ULP" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
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
                                                <label class="text-label d-block"><small>RPP ON DESK</small></label>
                                                <select id="sel_rpp" title="RPP" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                    <option value="00">SEMUA RPP</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4 col-3">
                                                <label class="text-label"><small>TGL ON SITE</small></label></label>
                                                <input id="tgl_pemeriksaan_range" class="form-control input-daterange-datepicker col-11" type="text" name="daterange">
                                            </div>
                                            <div class="form-group mb-4 col-3" style="padding-top: 40px;">
                                                <input id="cb_urut_rpp" class="form-check-input filled-in styled-checkbox" checked type="checkbox">
                                                <label for="cb_urut_rpp" class="form-check-label">Mode Urut RPP</label>
                                            </div>
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
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title mb-4">On Desk</h4>
                                <div class="table-responsive">
                                    <table id="tbl_rpp" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-primary-lighten-2">NO</th>
                                            <th class="text-center bg-primary-lighten-2">KDDK RPP</th>
                                            <th class="text-center bg-primary-lighten-2">IDPEL</th>
                                            <th class="text-center bg-primary-lighten-2">NOMETER</th>
                                            <th class="text-center bg-primary-lighten-2">NAMA</th>
                                            <th class="text-center bg-primary-lighten-2">STATUS<br/>ONSITE</th>
                                            <th class="text-center bg-primary-lighten-2">RPP<br/>ONSITE</th>
                                            <th class="text-center bg-primary-lighten-2">PETUGAS<br/>ONSITE</th>
                                        </tr>
                                    </thead>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title mb-4">On Site</h4>
                                <div class="table-responsive">
                                    <table id="tbl_uji_rpp" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <!-- <th class="text-center bg-primary-lighten-2">KDDK</th> -->
                                            <th class="text-center bg-primary-lighten-2">NO</th>
                                            <th class="text-center bg-primary-lighten-2">TGL INPUT</th>
                                            <th class="text-center bg-primary-lighten-2">RPP ONSITE</th>
                                            <th class="text-center bg-primary-lighten-2">KDDK ONDESK</th>
                                            <th class="text-center bg-primary-lighten-2">IDPEL</th>
                                            <th class="text-center bg-primary-lighten-2">NAMA</th>
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


                <div class="row">
                    <div class="col-6">
                        <div id="card_map_on_desk" class="card card-map">
                            <div class="card-body">
                            <h4 class="card-title mb-4">Peta On Desk</h4>
                                <div id="wrapper_map" style="height:480px; width:420px;">
                                    <div id="map_on_desk" class="map"></div>
                                </div>
                            </div>
                            <div class="card-footer text-muted d-none">
                                <div class="row ml-4">
                                    <div class="form-check col-4">
                                        <input class="form-check-input" type="checkbox" class="filled-in chk-col-primary" id="cb_sudah_onsite" value="SUDAH ONSITE" checked>
                                        <label class="form-check-label" for="cb_sudah_onsite" style="color:green">Sudah Onsite</label>
                                    </div>
                                    <div class="form-check col-4">
                                        <input class="form-check-input" type="checkbox" class="filled-in chk-col-primary" id="cb_sisipan_rpp_lain" value="SISIPAN RPP LAIN" checked>
                                        <label class="form-check-label" for="cb_sisipan_rpp_lain" style="color:orange">Sisipan RPP Lain</label>
                                    </div>
                                    <div class="form-check col-4">
                                        <input class="form-check-input" type="checkbox" class="filled-in chk-col-primary" id="cb_belum_onsite" value="BELUM ONSITE"checked>
                                        <label class="form-check-label" for="cb_belum_onsite" style="color:gray">Belum Onsite</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div id="card_map_on_site" class="card card-map">
                            <div class="card-body">
                            <h4 class="card-title mb-4">Peta On Site</h4>
                                <div id="wrapper_map_uji_rpp" style="height:480px; width:420px;">
                                    <div id="map_on_site" class="map"></div>
                                </div>
                            </div>
                            <div class="card-footer text-muted d-none">
                               <div class="row ml-4">
                                    <div class="form-check col-6">
                                        <input class="form-check-input" type="checkbox" class="filled-in chk-col-primary" id="cb_onsite" value="ONSITE" checked>
                                        <label class="form-check-label" for="cb_onsite" style="color:green">Onsite</label>
                                    </div>
                                    <div class="form-check col-6">
                                        <input class="form-check-input" type="checkbox" class="filled-in chk-col-primary" id="cb_sisipan" value="SISIPAN"  checked>
                                        <label class="form-check-label" for="cb_sisipan" style="color:orange">Sisipan</label>
                                    </div>
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

    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../../assets/plugins/viewer/viewer.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0TuTeVzIMdevT3Rfc0BrVDKy466Tdsnc"></script>

    <script src="https://cdn.jsdelivr.net/gmap3/7.2.0/gmap3.min.js"></script>

    <!-- <script src="../../assets/plugins/keydragzoom/keydragzoom.js"></script> -->
    <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/pelaksanaan-rpp-onsite.js?time=4"></script>
</body>
</html>
<?php include 'parts/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga | Rekap RPP On Site</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../../assets/plugins/datatables-lib/DataTables-1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/FixedColumns-4.0.1/css/fixedColumns.bootstrap4.min.css">
    <link href="../../assets/plugins/datatables-lib/Buttons-2.1.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/Responsive-2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/RowGroup-1.1.4/css/rowGroup.dataTables.min.css" rel="stylesheet">
    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
                        <h4>Rekap RPP On Site</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">RPP On Site</a>
                            </li>
                            <li class="breadcrumb-item active">Rekap RPP On Site</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h4 class="card-title">Kriteria Pencarian</h4>
                            </div> -->
                            <div class="card-body">
                                <div id="modal_foto" class="modal fade" tabindex="-1" role="dialog">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Foto Pemeriksaan LPB</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <img id="img_foto" class="img-fluid img-thumbnail" alt="Foto Pemeriksaan LPB">
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
                                            <div class="form-group mb-2 col-3">
                                                <label class="text-label">UNIT INDUK</label>
                                                <select id="sel_unitupi" title="PILIH UNIT INDUK" class="form-control selectpicker show-tick" data-size="5" data-inc-semua='T' >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 col-3">
                                                <label class="text-label">UP3</label>
                                                <select id="sel_unitap" title="PILIH UP3" class="form-control selectpicker show-tick" data-size="5" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 col-3">
                                                <label class="text-label">ULP</label>
                                                <select id="sel_unitup" title="PILIH ULP" class="form-control selectpicker show-tick" data-size="5" >
                                                    <option value="00" selected>SEMUA UNIT</option>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group mb-2 mr-4 col-3">
                                                <label class="text-label">TGL PEMERIKSAAN</label>
                                                <input id="tgl_upload_range" class="form-control input-daterange-datepicker" type="text" name="daterange">
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
                                <p>
                                    <strong>Keterangan Data Onsite:</strong>
                                    <ul>
                                        <li><strong>Sesuai WO:</strong> Inputan Onsite dari Pelanggan-pelanggan yang ada di WO RPP terkait</li>
                                        <li><strong>Sisipan:</strong> Inputan Onsite dari Pelanggan-pelanggan yang ada diluar WO RPP terkait</li>
                                        <li><strong>Pagar Kunci:</strong> Inputan Onsite dengan kondisi pagar terkunci menggunakan pengkodean 999XXXYYYYYY dan diluar WO RPP terkait</li>
                                        <li><strong>Tidak Ditemukan:</strong> Inputan Onsite dengan kondisi pelanggan tidak ditemukan dan belum masuk realisasi</li>
                                        <li><strong>Double:</strong> Inputan Onsite dengan kondisi pelanggan sudah diinput sebelumnya selama periode Onsite</li>
                                        <li><strong>Sisipan RPP Lain:</strong> Inputan Onsite dari Pekerjaan RPP Lain yang menemukan pelanggan sesuai WO RPP terkait</li>
                                    </ul>
                                </p>
                                <p>
                                    <strong>Keterangan Realisasi:</strong>
                                    <ul>
                                        <li><strong>Realisasi Petugas:</strong> Jumlah Inputan Petugas dalam pekerjaan onsite dari RPP terkait (Sesuai WO+Sisipan+Pagar Kunci+Tidak Ditemukan+Double)</li>
                                        <li><strong>Realisasi RPP:</strong> Jumlah Inputan sesuai WO dari RPP terkait (Sesuai WO+Sisipan Rpp Lain)</li>
                                        <!-- <li><strong>Realisasi Target:</strong> Jumlah Inputan sesuai WO dari RPP terkait ditambah Sisipan (Sesuai WO+Sisipan+Sisipan Rpp Lain)</li> -->
                                        <li><strong>Sisa WO:</strong> Jumlah sisa WO (Jml On Desk-Sesuai WO-Sisipan RPP Lain)</li>
                                    </ul>
                                </p>
                                <div class="table-responsive">
                                    <table id="tbl_rekap_onsite_petugas" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNITAP</th>
                                            <!-- <th rowspan="2" class="text-center bg-primary-lighten-2">UP3</th> -->
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">UNITUP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">ULP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">PETUGAS</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">RPP</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">WAKTU<br/>PEKERJAAN</th>
                                            <th rowspan="2" class="text-center bg-primary-lighten-2">JML<br/>ON DESK</th>
                                            <th colspan="6" class="text-center bg-primary-lighten-2">ON SITE</th>
                                            <th rowspan="2" class="text-center bg-success-lighten-2">REALISASI<br/>PETUGAS</th>
                                            <th rowspan="2" class="text-center bg-success-lighten-2">REALISASI<br/>RPP</th>
                                            <!-- <th rowspan="2" class="text-center bg-success-lighten-2">REALISASI<br/>THD TARGET</th> -->
                                            <th rowspan="2" class="text-center bg-warning-lighten-2">SISA<br/>WO RPP</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-success-lighten-2">SESUAI<br/>WO</th>
                                            <th class="text-center bg-secondary-lighten-2">SISIPAN</th>
                                            <th class="text-center bg-warning-lighten-2">PAGAR<br/>KUNCI</th>
                                            <th class="text-center bg-danger-lighten-2">TIDAK<br/>DITEMUKAN</th>
                                            <th class="text-center bg-warning-lighten-2">DOUBLE</th>
                                            <th class="text-center bg-secondary-lighten-2">SISIPAN<br/>RPP LAIN</th>
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
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/rekap-rpp-onsite.js?time=3"></script>
</body>
</html>
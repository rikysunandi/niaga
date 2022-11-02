<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">

    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.bootstrap4.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../../assets/plugins/dropzone/css/dropzone.min.css" rel="stylesheet">
    
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    <style>
        .has-danger .control-label,
        .has-danger .help-block,
        .has-danger .form-control-feedback {
            color: #d9534f;
        }
        
        .fa.valid-feedback,
        .fa.invalid-feedback {
            position: absolute;
            right: 25px;
            margin-top: -50px;
            z-index: 2;
            display: block;
            pointer-events: none;
        }
        
        .fa.valid-feedback {
            margin-top: -28px;
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
                        <h4>Input Target Lag Measures</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">WIG</a>
                            </li>
                            <li class="breadcrumb-item active">Input Target Lag Measures</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-5">Pilih WIG (Wildly Important Goals)</h4>
                                <form id="input-va" class="needs-validation mb-4" novalidate>
                                    <div class="form-group row align-items-center">
                                        <label for="bidang" class="col-sm-3 col-form-label text-label">Bidang/Biro</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <select id="bidang" name="bidang" title="Nama Bidang" class="form-control selectpicker show-tick required" placeholder="Silahkan pilih Bidang/Biro" data-size="5" required>
                                                        <option value="DISTRIBUSI">DISTRIBUSI</option>
                                                        <option value="NIAGA DAN MANAJEMEN PELANGGAN">NIAGA DAN MANAJEMEN PELANGGAN</option>
                                                        <option value="KEUANGAN">KEUANGAN</option>
                                                        <option value="PERENCANAAN">PERENCANAAN</option>
                                                        <option value="GENERAL AFFAIRS">GENERAL AFFAIRS</option>
                                                        <option value="BIRO PENGADAAN">BIRO PENGADAAN</option>
                                                        <option value="BIRO K3L">BIRO K3L</option>
                                                        <option value="NON BIDANG / BIRO">NON BIDANG / BIRO</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="nama_wig" class="col-sm-3 col-form-label text-label">Nama WIG</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <select id="nama_wig" name="nama_wig" title="Nama WIG" class="form-control selectpicker show-tick required" data-size="5" required>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih WIG!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="nama_lag" class="col-sm-3 col-form-label text-label">Nama Lag Measures</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <input type="text" id="nama_lag" name="nama_lag" pattern="[0-9]" placeholder="Nama Lag Measure" class="form-control readonly" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-5">Upload Target</h4>
                                <p>
                                    Silahkan upload berkas sesuai template <a class="link" href="#" target="_blank">ini <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                                </p>
                                <form action="../controller/pelunasan/uploadFilePelunasan.php" id="upload-pelunasan" class="dropzone mt-4">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                </form>
                                <div class="form-group row mt-4">
                                    <div class="col-sm-12 text-right">
                                        <!-- <button type="button" id="btn_hapus" disabled="disabled" class="btn btn-danger btn-sl-sm"data-toggle="modal" data-target="#confirmDelete"><span class="mr-2"><i class="fa fa-trash" aria-hidden="true"></i></span>Reset</button> -->
                                        <button type="button" id="btn_upload" class="btn btn-primary btn-sl-sm"><span class="mr-2"><i class="fa fa-upload" aria-hidden="true"></i></span>Upload</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-5">Input Target per Unit</h4>
                                <form id="input-va" class="needs-validation mb-4" novalidate>

                                    <div class="form-group row align-items-center">
                                        <label for="sel_unitupi" class="col-sm-4 col-form-label text-label">Unit Induk</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select id="sel_unitupi" name="unitupi" title="PILIH UNIT INDUK" class="form-control selectpicker show-tick" data-inc-semua="T" required>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih Unit Induk!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="sel_unitap" class="col-sm-4 col-form-label text-label">UP3</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select id="sel_unitap" name="unitap" title="PILIH UP3" class="form-control selectpicker show-tick" data-inc-semua="T" required>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih UP3!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="sel_unitup" class="col-sm-4 col-form-label text-label">ULP</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select id="sel_unitup" name="unitup" title="PILIH ULP" class="form-control selectpicker show-tick" data-inc-semua="T" required>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih ULP!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="tgl_target_range" class="col-sm-4 col-form-label text-label">Rentang Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="tgl_target_range" class="form-control input-daterange-datepicker" type="text" name="daterange">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="target" class="col-sm-4 col-form-label text-label">Target Harian</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" id="target" name="target" pattern="[0-9]" placeholder="Masukan Target" class="form-control shouldNumber">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" id="satuan_lag" name="satuan_lag" pattern="[0-9]" placeholder="Satuan" class="form-control readonly" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-4">
                                        <div class="col-sm-12 text-right">
                                            <button type="button" id="btn_hapus" disabled="disabled" class="btn btn-danger btn-sl-sm"data-toggle="modal" data-target="#confirmDelete"><span class="mr-2"><i class="fa fa-trash" aria-hidden="true"></i></span>Reset</button>
                                            <button type="button" id="btn_simpan" class="btn btn-primary btn-sl-sm"><span class="mr-2"><i class="fa fa-save" aria-hidden="true"></i></span>Simpan</button>
                                        </div>
                                    </div>
                                    <div class="row response"></div>

                                    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            Apakah anda yakin akan menghapus data ini?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Tidak</button>
                                            <button type="button" id="btn_dohapus" class="btn btn-primary">Ya</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </form>
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

    <script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../assets/plugins/bootstrap4-notify/bootstrap-notify.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script>


    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/input-target-lag.js"></script>
</body>
</html>
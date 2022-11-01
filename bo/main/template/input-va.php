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
    <title>Backoffice Niaga</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">

    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.bootstrap4.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
    
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
                        <h4>Input Virtual Account</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pelunasan</a>
                            </li>
                            <li class="breadcrumb-item active">Input Virtual Account</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-xl-6">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Form Input Virtual Account</h4>
                                <div class="mb-4">
                                    <form id="input-va" class="needs-validation" novalidate>
                                        <div class="form-group row align-items-center">
                                            <label for="nomor_va" class="col-sm-4 col-form-label text-label">Nomor VA</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" id="nomor_va" name="nomor_va" pattern="[0-9]" placeholder="MASUKAN NOMOR VA" class="form-control shouldNumber">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="bank" class="col-sm-4 col-form-label text-label">Bank</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select id="bank" name="bank" title="NAMA BANK" class="form-control selectpicker show-tick required" data-size="5" required>
                                                        <option value="BNI">BNI</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Silahkan pilih Bank!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                            <label for="keterangan" class="col-sm-4 col-form-label text-label">Keterangan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 text-right">
                                                <button type="button" id="btn_hapus" disabled="disabled" class="btn btn-danger btn-sl-sm"data-toggle="modal" data-target="#confirmDelete"><span class="mr-2"><i class="fa fa-trash" aria-hidden="true"></i></span>Hapus</button>
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

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/input-va.js"></script>
</body>
</html>
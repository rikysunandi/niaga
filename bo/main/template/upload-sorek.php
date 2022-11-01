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
    <!-- <link href="../../assets/plugins/dropzone/css/dropzone.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../../assets/plugins/dropify/dist/css/dropify.min.css">
    <link href="../../assets/plugins/dropzone/css/dropzone.min.css" rel="stylesheet">

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    
</head>

<body>

    <?php
        // header("Location: maintenance.php");
        // exit();
    ?>
    
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
                        <h4>Update Sorek OLAP AP2T</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Update Data</a>
                            </li>
                            <li class="breadcrumb-item active">Update Sorek OLAP AP2T</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Upload data (Semua Kogol)</h4>
                                <div class="basic-form">
                                    <p>Langkah-langkah:
                                        <ul>
                                            <li>1. Download Detail Sorek dari Menu Monitoring Tagihan Listrik (OLAP) AP2T ke dalam format <b>xls</b></li>
                                            <li>2. Browse/Drag satu atau beberapa File Sorek (tanpa diedit) ke Panel di bawah ini <span class="text-warning">(maks 5 File maks ukuran 25Mb per File)</span></li>
                                            <li>3. Klik tombol Upload, tunggu sampai File berhasil diupload ke Server</li>
                                            <li>4. Silahkan tunggu Progress Update Data yang sedang berjalan sampai <span class="text-success">sukses (hijau)</span></li>
                                        </ul>
                                    </p>
                                    <p>
                                        <!-- <div>Pemantauan data pelunasan yang belum diupload dapat dilakukan <a href="mon-blm-upload-pelunasan.php" class="badge badge-primary" target="_blank">di sini</a></div> -->
                                        <span class="text-warning">*Silahkan gunakan Web Browser (Firefox/Chrome) versi terbaru</span>
                                    </p>

                                    <div class="mb-0">
                                        <form action="#">
                                            <div class="form-row">
                                                <div class="form-group mb-2 mr-4">
                                                    <label class="text-label d-block">UID</label>
                                                    <select id="sel_unitupi" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                        <option disabled>Pilih Unit Induk</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2 mr-4">
                                                    <label class="text-label d-block">UP3</label>
                                                    <select id="sel_unitap" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
                                                        <option disabled>Pilih UP3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2 mr-4">
                                                    <label class="text-label d-block">ULP</label>
                                                    <select id="sel_unitup" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
                                                        <option disabled>Pilih ULP</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2 mr-4">
                                                    <label class="text-label d-block">BLTH REK</label>
                                                    <select id="sel_blth" class="selectpicker select-sm show-tick" data-size="5" data-width="fit">
                                                        <option value="<?php echo date('Ym') ?>" selected="selected"><?php echo date('Ym') ?></option>
                                                        <option data-divider="true"></option>
                                                        <option value='<?php echo date('Ym', strtotime("last day of previous month")) ?>'><?php echo date('Ym', strtotime("last day of previous month")) ?></option>
                                                        <option value='<?php echo date('Ym', strtotime("-2 month")) ?>'><?php echo date('Ym', strtotime("-2 month")) ?></option>
                                                        <option value='<?php echo date('Ym', strtotime("-3 month")) ?>'><?php echo date('Ym', strtotime("-3 month")) ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <form action="../controller/sorek/uploadFileSorek.php" id="upload-sorek" class="dropzone mt-4">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple="multiple">
                                        </div>
                                    </form>
                                    <div id="result" class="mt-2"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <button disabled="disabled" id="btn_upload" type="button" class="btn btn-sm btn-primary waves-effect waves-light mt-2">Upload <span class="btn-icon-right"><i
                                    class="fa fa-upload"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row progress-upload d-none">
                    <div class="col-12">
                        <div id="proses" class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between progress-label mb-2">
                                    <span class="msg">Mengupdate Sorek dari File </span>
                                </div>
                                <div class="progress progress--medium">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-light" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
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
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap4-notify/bootstrap-notify.min.js"></script>

    <!-- <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script> -->
    <script src="../../assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script>

    <script src="../js/pages/apps.js?time=112"></script>
    <script src="../js/pages/upload-sorek.js?time=<?php echo time() ?>"></script>
</body>
</html>
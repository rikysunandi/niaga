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
    <!-- <link href="../../assets/plugins/dropzone/css/dropzone.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="../../assets/plugins/dropify/dist/css/dropify.min.css"> -->
    <link href="../../assets/plugins/dropzone/css/dropzone.min.css" rel="stylesheet">

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    
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
                        <h4>Upload Pemeriksaan LPB</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemeriksaan LPB</a>
                            </li>
                            <li class="breadcrumb-item active">Upload Pemeriksaan LPB</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Upload data Besar (120MB)</h4>
                                <div class="basic-form">
                                   
                                    <!-- <p>Langkah-langkah:
                                        <ul>
                                            <li>1. Download pemeriksaan-lpb dari AP2T sesuai rentang hari yang dibutuhkan, sehingga dapat didownload ke dalam <b>1 File saja</b></li>
                                            <li>2. Browse/Drag satu atau beberapa File pemeriksaan-lpb ke Panel di bawah ini (maks 5 File)</li>
                                            <li>3. Klik tombol Upload, tunggu sampai File berhasil diupload ke Server</li>
                                            <li>4. Silahkan tunggu Progress Update Data yang sedang berjalan sampai <span class="text-success">sukses (hijau)</span></li>
                                            <li>5. Pemantauan data pemeriksaan-lpb yang belum diupload dapat dilakukan <a href="mon-blm-upload-pemeriksaan-lpb.php" class="badge badge-primary" target="_blank">di sini</a></li>
                                        </ul>
                                    </p>
                                    -->
                                    <p>Data yang diupload:
                                        <ul>
                                            <li>1. File ZIP hasil export data pemeriksaan LPB dari Priangan (tanpa diedit)</li>
                                            <li>2. Maksimal 100 File/batch, dan ukuran maksimal 120MB per File Zip</li>
                                            <li>3. Progress upload data per File akan ditampilan di bagian bawah</li>
                                        </ul>
                                    </p> 
                                    <p>
                                        <span class="text-warning">*Silahkan gunakan Web Browser (Firefox/Chrome) versi terbaru</span>
                                    </p>

                                    <form action="../controller/pemeriksaan_lpb/uploadFilePemeriksaanLPB.php" id="upload-pemeriksaan-lpb" class="dropzone mt-4">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple="multiple">
                                        </div>
                                    </form>
                                    <div id="result" class="mt-2"></div>
                                </div>
                            </div>
                            <div class="card-footer d-none">
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
                                    <span class="msg">Mengupdate pemeriksaan-lpb dari File </span>
                                </div>
                                <div class="progress progress--medium">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                                <div class="text-right mt-4 mb-2">
                                    <a class="btn btn-outline-primary btn-sm" data-toggle="collapse" href="#" role="button" aria-expanded="false" aria-controls="">
                                        Log Upload
                                      </a>
                                </div>
                                <div class="collapse" id="collapseExample">
                                  <div class="card card-body">
                                    <ul class="log">
                                    </ul>
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
    <script src="../../assets/plugins/moment/moment.min.js"></script>

    <!-- <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script> -->
    <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script> -->

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/upload-pemeriksaan-lpb-large.js?time=<?php echo time() ?>"></script>
</body>
</html>
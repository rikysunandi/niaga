<?php include 'parts/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga | Upload DIL</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../../assets/plugins/dropzone/css/dropzone.min.css" rel="stylesheet">
    
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
                        <h4>Upload DIL</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemeriksaan LPB</a>
                            </li>
                            <li class="breadcrumb-item active">Upload DIL</li>
                        </ol>
                    </div>
                </div>

                <div id="upload_wrapper" class="row">
                    
                    <div class="col-xl-12">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Upload Data</h4>
                                <div class="basic-form">
                                    <p class="mb-5">Upload file DIL<code> ukuran maksimal 120Mb</code>  </p>
                                    <form id="file-dil" action="../controller/pemeriksaan_lpb/fileUploadDIL.php" class="dropzone mb-4">
                                        <div class="fallback">
                                            <input name="file" type="file">
                                        </div>
                                    </form>
                                    <!-- <div class="form-group row">
                                        <div class="col-sm-12 text-right">
                                            <button id="btn_update" class="btn btn-primary btn-form">Proses</button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-12 progress-box">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="pull-left">Proses Update Data</h5>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-6 mt-4 text-center">
                                        <h2 class="display-3 text-primary data">0</h2>
                                        <p class="h2">Data Berhasil Disimpan</p>
                                    </div>
                                    <div class="col-6 mt-4 text-center">
                                        <h2 class="display-3 text-primary foto">0</h2>
                                        <p class="h2">Foto Berhasil Disimpan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer py-4 px-xl-5">
                                <h6 class="text-muted">Progress <span class="pull-right">0%</span></h6>
                                <div class="progress mb-3">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%; height:6px;" role="progressbar" aria-valuenow="0"><span class="sr-only">0% Complete</span>
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

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>

    <?php include 'parts/footer.php'; ?>

    

    <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script>
    <script src="../js/pages/upload-pemeriksaan-lpb.js"></script>
    
</body>
</html>


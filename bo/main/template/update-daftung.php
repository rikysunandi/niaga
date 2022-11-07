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
    <link rel="stylesheet" href="../../assets/plugins/dropify/dist/css/dropify.min.css">

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
                        <h4>Update Daftung</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">SKAI Khusus</a>
                            </li>
                            <li class="breadcrumb-item active">Update Daftung</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
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
                                            <select id="sel_unitap" class="selectpicker show-tick" data-size="5" >
                                                <option selected disabled>Pilih UP3</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
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
                            <div class="card-body">
                                <h4 class="card-title mb-4">Download data Daftung dari AP2T</h4>
                                <p class="mb-5">Download data detail per Agenda ke dalam <code> format CSV</code>. Jika hasil yang ditampilkan masih kosong, silahkan lakukan pencarian ulang</p>
                                <div class="embed-responsive embed-responsive-16by9">
                                  <iframe id="daftung_ap2t" class="embed-responsive-item" src="blank.html" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Upload data</h4>
                                <div class="basic-form">
                                    <p class="mb-2">Upload file CSV hasil Download dari AP2T dengan <code> ukuran maksimal 5Mb</code>  </p>
                                    <input type="file" class="dropify" data-max-file-size="5M" data-allowed-file-extensions="csv"/>
                                    <!-- <form hidden id="file-daftung" action="../controller/pemasaran/fileUploadDaftung.php" class="dropzone mb-4">
                                        <div class="fallback">
                                            <input name="file" type="file">
                                        </div>
                                    </form> -->
                                    <div class="progress-upload mt-5 d-none">
                                        <div class="d-flex justify-content-between progress-label">
                                            <span class="msg">Mohon menunggu, sedang mengupload data ke Database...</span>
                                            <span class="info">-</span>
                                        </div>
                                        <div class="progress progress--large">
                                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                    </div>
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
    <script src="../../assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <script src="../../assets/plugins/papaparse/papaparse.min.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/update-daftung.js?time=<?php echo time() ?>"></script>
</body>
</html>
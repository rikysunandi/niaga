<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga | Download DIL (CSV)</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    

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
                        <h4>Download DIL (CSV)</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemeriksaan LPB</a>
                            </li>
                            <li class="breadcrumb-item active">Download DIL (CSV)</li>
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
                                        <div class="form-row mb-2">
                                            <div class="form-group mb-0 mr-4">
                                                <select id="sel_unitupi" class="selectpicker show-tick" data-size="5" >
                                                    <option selected disabled>Pilih Unit Induk</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0 mr-4">
                                                <select id="sel_unitap" class="selectpicker show-tick" data-size="5" >
                                                    <option selected disabled>Pilih UP3</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0 mr-4">
                                                <select id="sel_unitup" class="selectpicker show-tick" data-size="5" >
                                                    <option selected disabled>Pilih ULP</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0 mr-4 pt-2">
                                                <input id="check_sisa" class="form-check-input styled-checkbox" type="checkbox" checked="checked">
                                                <label for="check_sisa" class="form-check-label">Sisa belum ditagging</label>
                                            </div>
                                        </div>
                                            <div class="text-right">
                                                <button id="btn_download" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Download <span class="btn-icon-right"><i
                                                class="fa fa-download"></i></span>

                                               <!--  <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button> -->
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

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/download-dil.js"></script>
</body>
</html>
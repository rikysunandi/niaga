<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga</title>
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
                        <h4>Dashboard Tagging LPB</h4>
                    </div>
                    <div class="table-action float-right">
                        <form action="#">
                            <div class="form-row">
                                <div class="form-group mb-0">
                                    <select id="sel_unit" name="sel_unit" class="selectpicker select-sm show-tick" data-size="5" data-width="fit">
                                        <option value="00" selected="selected">UID JABAR</option>
                                        <option data-divider="true"></option>
                                        <option value="53BDG">UP3 BANDUNG</option>
                                        <option value="53BKS">UP3 BEKASI</option>
                                        <option value="53BGR">UP3 BOGOR</option>
                                        <option value='53CJR'>UP3 CIANJUR</option>
                                        <option value='53CKG'>UP3 CIKARANG</option>
                                        <option value='53CMI'>UP3 CIMAHI</option>
                                        <option value='53CRB'>UP3 CIREBON</option>
                                        <option value='53DPK'>UP3 DEPOK</option>
                                        <option value='53GRT'>UP3 GARUT</option>
                                        <option value='53GPI'>UP3 GUNUNG PUTRI</option>
                                        <option value='53IDM'>UP3 INDRAMAYU</option>
                                        <option value='53KRW'>UP3 KARAWANG</option>
                                        <option value='53MJA'>UP3 MAJALAYA</option>
                                        <option value='53PWK'>UP3 PURWAKARTA</option>
                                        <option value='53SKI'>UP3 SUKABUMI</option>
                                        <option value='53SMD'>UP3 SUMEDANG</option>
                                        <option value='53TSK'>UP3 TASIKMALAYA</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-sm-12 col-lg-12 mb-2 mt-0">
                        <div class="table-action float-right">
                            <form action="#">
                                <div class="form-row">
                                    <div class="form-group mb-0">
                                        <select class="selectpicker show-tick" data-width="auto">
                                            <option selected="selected">UID JABAR</option>
                                            <option value="53BDG">UP3 BANDUNG</option>
                                            <option value="53BKS">UP3 BEKASI</option>
                                            <option value="53BGR">UP3 BOGOR</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body rounded stat-widget-seven" style="background-color: #7F63F4;">
                                <div class="media pl-xl-5 align-items-center">
                                    <img class="mr-3 mt-2" src="../../assets/images/icons/12.png" alt="">
                                    <div class="media-body pl-3">
                                        <h2 class="mt-0 mb-2" id="total_plg">0</h2>
                                        <h6 class="text-uppercase text-white">JML PLG</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body rounded stat-widget-seven" style="background-color: #135470;">
                                <div class="media pl-xl-5 align-items-center">
                                    <img class="mr-3 mt-2" src="../../assets/images/icons/25.png" alt="">
                                    <div class="media-body pl-3">
                                        <h2 class="mt-0 mb-2" id="total_sdh_tagging">0</h2>
                                        <h6 class="text-uppercase text-white">SDH TAGGING</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body rounded stat-widget-seven" style="background-color: #EC5B43;">
                                <div class="media pl-xl-5 align-items-center">
                                    <img class="mr-3 mt-2" src="../../assets/images/icons/28.png" alt="">
                                    <div class="media-body pl-3">
                                        <h2 class="mt-0 mb-2" id="total_blm_tagging">0</h2>
                                        <h6 class="text-uppercase text-white">BLM TAGGING</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_tagging_lpb" class="card">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Tagging LPB per Unit</h4>
                                <div class="table-action float-right">
                                    <form action="#">
                                        <div class="form-row">
                                            <div class="form-group mb-0">
                                                <button type="button" class="btn btn-sm btn-outline-primary btn-ft btn-download" title="Download Image"><i class="fa fa-download"></i></span>
                                                </button> 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="chart_tagging_lpb_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_rank_up3" class="card transparent-card m-b-0">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Ranking Tagging LPB per Unit</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
                                        <thead>
                                            <tr>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>JML PLG</th>
                                                <th>SDH TAGGING</th>
                                                <th>BLM TAGGING</th>
                                                <th>PERSENTASE</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_rank_unit" class="card transparent-card m-b-0">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Ranking Tagging LPB per ULP</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
                                        <thead>
                                            <tr>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>JML PLG</th>
                                                <th>SDH TAGGING</th>
                                                <th>BLM TAGGING</th>
                                                <th>PERSENTASE</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="../../assets/plugins/wnumb/wNumb.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
    
    <script src="../js/pages/index-mekaga.js"></script>
</body>
</html>
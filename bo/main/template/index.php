<?php include 'parts/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga</title>
    

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    
    <style type="text/css">
        .chart-card{
            height: 17rem;
        }

        #dapot_jenis_transaksi .card{
            cursor: pointer;
        }
        #dapot .card{
            cursor: pointer;
        }
        #dapot_jenis_transaksi .card:hover {
          box-shadow: 0 12px 12px 0 rgba(0, 0, 0,.24);
          transform: translateY(-4px);
        }
        #dapot .card:hover {
          box-shadow: 0 12px 12px 0 rgba(0, 0, 0,.24);
          transform: translateY(-4px);
        }


        #overview_daftung .card{
            cursor: pointer;
        }

        #overview_daftung .card:hover {
          box-shadow: 0 12px 12px 0 rgba(0, 0, 0,.24);
          transform: translateY(-4px);
        }

        #agenda_terlama .card tr{
            cursor: pointer;
        }

        #agenda_terlama .card tr:hover {
          box-shadow: 0 12px 12px 0 rgba(0, 0, 0,.24);
          transform: translateY(-4px);
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
                        <h4>Dashboard Daftar Potensi dan Daftar Tunggu</h4>
                    </div>
                    <div class="table-action float-right">
                        <form action="#">
                            <div class="form-row">
                                <div class="form-group mb-0">
                                    <select id="sel_unit" class="selectpicker select-sm show-tick" data-size="5" data-width="fit">
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


                <div class="row mb-4">
                    <div class="col-lg-12 bg-primary p-2">
                        <h2 class="text-white text-center"><i class="mdi mdi-target"></i>&nbsp;Daftar Potensi</h2>
                    </div>
                </div>

                <div id="dapot_jenis_transaksi" class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card" data-jenis-transaksi="PASANG BARU" style="background-color: #135470;">
                            <div class="card-body text-white">
                                <div id="pasang_baru" class="stat-widget-two">
                                    <h4 class="text-white mb-4">PASANG BARU</h4>
                                    <div class="row justify-content-between">
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Agenda</p>
                                            <span id="jml_agenda" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Daya</p>
                                            <span id="jml_daya" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">BP</p>
                                            <span id="jml_rpbp" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col">
                                            <p class="m-b-10 f-s-13">RAB</p>
                                            <span id="jml_rprab" class="f-w-200 text-white">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card" data-jenis-transaksi="PERUBAHAN DAYA" style="background-color: #74BCC7;">
                            <div class="card-body text-white">
                                <div id="perubahan_daya" class="stat-widget-two">
                                    <h4 class="text-primary mb-4">PERUBAHAN DAYA</h4>
                                    <div class="row justify-content-between">
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Agenda</p>
                                            <span id="jml_agenda" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Daya</p>
                                            <span id="jml_daya" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">BP</p>
                                            <span id="jml_rpbp" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col">
                                            <p class="m-b-10 f-s-13">RAB</p>
                                            <span id="jml_rprab" class="f-w-200 text-white">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card" data-jenis-transaksi="SAMBUNG KEMBALI" style="background-color: #F2C36B;">
                            <div class="card-body text-white">
                                <div id="sambung_kembali" class="stat-widget-two">
                                    <h4 class="text-white mb-4">SAMBUNG KEMBALI</h4>
                                    <div class="row justify-content-between">
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Agenda</p>
                                            <span id="jml_agenda" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Daya</p>
                                            <span id="jml_daya" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">BP</p>
                                            <span id="jml_rpbp" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col">
                                            <p class="m-b-10 f-s-13">RAB</p>
                                            <span id="jml_rprab" class="f-w-200 text-white">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dapot" class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card" data-klp-plg="NON_GE" style="background-color: #135470;">
                            <div class="card-body text-white">
                                <div id="non_ge" class="stat-widget-two">
                                    <h4 class="text-white mb-4">POTENSI NON GE</h4>
                                    <div class="row justify-content-between">
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Agenda</p>
                                            <span id="jml_agenda" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Daya</p>
                                            <span id="jml_daya" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">BP</p>
                                            <span id="jml_rpbp" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col">
                                            <p class="m-b-10 f-s-13">RAB</p>
                                            <span id="jml_rprab" class="f-w-200 text-white">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card" data-klp-plg="GE" style="background-color: #74BCC7;">
                            <div class="card-body text-white">
                                <div id="ge" class="stat-widget-two">
                                    <h4 class="text-primary mb-4">POTENSI GE</h4>
                                    <div class="row justify-content-between">
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Agenda</p>
                                            <span id="jml_agenda" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Daya</p>
                                            <span id="jml_daya" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">BP</p>
                                            <span id="jml_rpbp" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col">
                                            <p class="m-b-10 f-s-13">RAB</p>
                                            <span id="jml_rprab" class="f-w-200 text-white">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card" data-klp-plg="TM" style="background-color: #F2C36B;">
                            <div class="card-body text-white">
                                <div id="tm" class="stat-widget-two">
                                    <h4 class="text-white mb-4">POTENSI TM</h4>
                                    <div class="row justify-content-between">
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Agenda</p>
                                            <span id="jml_agenda" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">Daya</p>
                                            <span id="jml_daya" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col border-right-1">
                                            <p class="m-b-10 f-s-13">BP</p>
                                            <span id="jml_rpbp" class="f-w-200 text-white">-</span>
                                        </div>
                                        <div class="col">
                                            <p class="m-b-10 f-s-13">RAB</p>
                                            <span id="jml_rprab" class="f-w-200 text-white">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div id="dapot_daya" class="card chartjs-stat-card-1">
                            <div class="card-header">
                                <h4 class="card-title mb-4 text-dark">Potensi mVA</h4>
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
                                <canvas id="chart_dapot_daya"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="dapot_daya_unit" class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title mt-3">Jenis Mutasi per Unit</h4> -->
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
                                <canvas id="chart_dapot_daya_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div id="dapot_bp" class="card chartjs-stat-card-1">
                            <div class="card-header">
                                <h4 class="card-title mb-4 text-dark">Potensi BP (Rp Miliyar)</h4>
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
                                <canvas id="chart_dapot_bp"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="dapot_bp_unit" class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title mt-3">Jenis Mutasi per Unit</h4> -->
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
                                <canvas id="chart_dapot_bp_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div id="dapot_rab" class="card chartjs-stat-card-1">
                            <div class="card-header">
                                <h4 class="card-title mb-4 text-dark">Potensi RAB (Rp Milyar)</h4>
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
                                <canvas id="chart_dapot_rab"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="dapot_rab_unit" class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title mt-3">Jenis Mutasi per Unit</h4> -->
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
                                <canvas id="chart_dapot_rab_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mb-4" />
                <div class="row mt-4 mb-4">
                    <div class="col-lg-12 bg-primary p-2 text-center">
                        <h2 class="text-white"><i class="mdi mdi-timer-sand"></i>Daftar Tunggu</h2><span id="jam_upload_daftung" class="text-white"></span>
                    </div>
                </div>

                <div id="overview_daftung">
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="card" data-klp-plg="00" data-status-proses="00" data-jenis-transaksi="00" data-status-tmp="00" data-klasifikasi-rab="00">
                                <div class="card-body rounded stat-widget-seven" style="background-color: #7F63F4;">
                                    <div class="media pl-xl-5 align-items-center">
                                        <img class="mr-3 mt-2" src="../../assets/images/icons/15.png" alt="">
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_agenda">0</h2>
                                            <h6 class="text-uppercase text-white">AGENDA</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4">
                            <div class="card" data-klp-plg="00" data-status-proses="RAB" data-jenis-transaksi="00" data-status-tmp="00" data-klasifikasi-rab="00">
                                <div class="card-body rounded stat-widget-seven bg-primary">
                                    <div class="media pl-xl-5 align-items-center">
                                        <img class="mr-3 mt-2" src="../../assets/images/icons/15.png" alt="">
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_agenda_rab">0</h2>
                                            <h6 class="text-uppercase text-white">RAB</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4">
                            <div class="card" data-klp-plg="00" data-status-proses="NON RAB" data-jenis-transaksi="00" data-status-tmp="00" data-klasifikasi-rab="00">
                                <div class="card-body rounded stat-widget-seven bg-danger" >
                                    <div class="media pl-xl-5 align-items-center">
                                        <img class="mr-3 mt-2" src="../../assets/images/icons/15.png" alt="">
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_agenda_non_rab">0</h2>
                                            <h6 class="text-uppercase text-white">NON RAB</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col-sm-6 col-lg-6">
                            <div class="card">
                                <div class="card-body rounded stat-widget-seven" style="background-color: #135470;">
                                    <div class="media pl-xl-5 align-items-center">
                                        <img class="mr-3 mt-2" src="../../assets/images/icons/icons8-check_file.png" alt="">
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_proses">0</h2>
                                            <h6 class="text-uppercase text-white">BP > RAB</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="card">
                                <div class="card-body rounded stat-widget-seven bg-light">
                                    <div class="media pl-xl-5 align-items-center">
                                        <img class="mr-3 mt-2" src="../../assets/images/icons/icons8-important_file.png" alt="">
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_evaluasi">0</h2>
                                            <h6 class="text-uppercase text-white">BP < RAB</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-lg-3">
                            <div class="card">
                                <div class="card-body rounded stat-widget-seven bg-primary">
                                    <div class="media pl-xl-5 align-items-center">
                                        <!-- <img class="mr-3 mt-2" src="../../assets/images/icons/icons8-check_file.png" alt=""> -->
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_klasifikasi_rab_1">0</h2>
                                            <h6 class="text-uppercase text-white">INDIVIDU 450 & 900 TANPA PERLUASAN</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <div class="card">
                                <div class="card-body rounded stat-widget-seven bg-primary">
                                    <div class="media pl-xl-5 align-items-center">
                                        <!-- <img class="mr-3 mt-2" src="../../assets/images/icons/icons8-important_file.png" alt=""> -->
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_klasifikasi_rab_2">0</h2>
                                            <h6 class="text-uppercase text-white">INDIVIDU RUPIAH BP >= INVESTASI</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <div class="card">
                                <div class="card-body rounded stat-widget-seven bg-primary">
                                    <div class="media pl-xl-5 align-items-center">
                                        <!-- <img class="mr-3 mt-2" src="../../assets/images/icons/icons8-important_file.png" alt=""> -->
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_klasifikasi_rab_3">0</h2>
                                            <h6 class="text-uppercase text-white">KOLEKTIF TOTAL BP > INVESTASI</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <div class="card">
                                <div class="card-body rounded stat-widget-seven bg-primary">
                                    <div class="media pl-xl-5 align-items-center">
                                        <!-- <img class="mr-3 mt-2" src="../../assets/images/icons/icons8-important_file.png" alt=""> -->
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_klasifikasi_rab_4">0</h2>
                                            <h6 class="text-uppercase text-white">RUPIAH BP < RUPIAH INVESTASI</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <div class="card">
                                <div class="card-body rounded stat-widget-seven bg-dark">
                                    <div class="media pl-xl-5 align-items-center">
                                        <!-- <img class="mr-3 mt-2" src="../../assets/images/icons/icons8-check_file.png" alt=""> -->
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_klasifikasi_rab_5">0</h2>
                                            <h6 class="text-uppercase text-white">BELUM ISI RAB PERLUASAN</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="card">
                                <div class="card-body rounded stat-widget-seven bg-light">
                                    <div class="media pl-xl-5 align-items-center">
                                        <!-- <img class="mr-3 mt-2" src="../../assets/images/icons/icons8-important_file.png" alt=""> -->
                                        <div class="media-body pl-3">
                                            <h2 class="mt-0 mb-2" id="total_klasifikasi_rab_6">0</h2>
                                            <h6 class="text-uppercase text-white">PELANGGAN TM/TT BELUM ISI RAB</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->

                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-lg-3 pl-lg-0">
                                    <div class="card-body bg-primary sale-report d-flex align-items-center">
                                        <div class="wrapper flex-fill text-center text-lg-left text-white">
                                            <h4 class="card-title">Agenda berdasarkan Jenis Mutasi</h4>
                                            <div class="chart">
                                                <canvas id="chart_permohonan_jenis"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 pr-lg-0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="sorting-box d-flex">
                                                <ul class="morris-chart-filter">
                                                    <li>Past 24 Hours</li>
                                                    <li>Past 07 Days</li>
                                                    <li>Past 30 Days</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chart">
                                            <canvas id="chart_permohonan_jenis_unit"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-4">
                        <div id="card_permohonan_cluster" class="card chartjs-stat-card-1">
                            <div class="card-header">
                                <h4 class="card-title mb-4 text-dark">Cluster (ON DEVELOP)</h4>
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
                                <canvas id="chart_permohonan_cluster"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="card_permohonan_cluster_unit" class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title mt-3">Jenis Mutasi per Unit</h4> -->
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
                                <canvas id="chart_permohonan_cluster_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div id="card_permohonan_jenis" class="card chartjs-stat-card-1">
                            <div class="card-header">
                                <h4 class="card-title mb-4 text-dark">Jenis Mutasi</h4>
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
                                <canvas id="chart_permohonan_jenis"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="card_permohonan_jenis_unit" class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title mt-3">Jenis Mutasi per Unit</h4> -->
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
                                <canvas id="chart_permohonan_jenis_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div id="card_permohonan_tmp" class="card chartjs-stat-card-1">
                            <div class="card-header">
                                <h4 class="card-title mb-4 text-dark">Status TMP</h4>
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
                                <canvas id="chart_permohonan_tmp"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="card_permohonan_tmp_unit" class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title mt-3">Status TMP per Unit</h4> -->
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
                                <canvas id="chart_permohonan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div id="card_permohonan_alasan_kriteria" class="card chartjs-stat-card-1">
                            <div class="card-header">
                                <h4 class="card-title mb-4 text-dark">Kriteria TMP</h4>
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
                                <canvas id="chart_permohonan_alasan_kriteria"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="card_permohonan_alasan_kriteria_unit" class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title mt-3">Kriteria TMP per Unit</h4> -->
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
                                <canvas id="chart_permohonan_alasan_kriteria_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="display:none;">
                    <div class="col-4">
                        <div id="card_permohonan_status_proses" class="card chartjs-stat-card-1">
                            <div class="card-header">
                                <h4 class="card-title mb-4 text-dark">Status Proses</h4>
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
                                <canvas id="chart_permohonan_status_proses"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="card_permohonan_status_proses_unit" class="card">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Status Proses per Unit</h4>
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
                                <canvas id="chart_permohonan_status_proses"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="agenda_terlama">
                    <div class="col-xl-4">
                        <div id="card_oldest_agenda_non_ge" class="card transparent-card m-b-0">
                            <div class="card-header">
                                <h4 class="card-title">10 Agenda NON GE Terlama</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div id="card_oldest_agenda_ge" class="card transparent-card m-b-0">
                            <div class="card-header">
                                <h4 class="card-title">10 Agenda GE Terlama</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div id="card_oldest_agenda_tm" class="card transparent-card m-b-0">
                            <div class="card-header">
                                <h4 class="card-title">10 Agenda TM Terlama</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
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
    <script src="../js/pages/apps.js?time=5"></script>
    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <!-- Morris Chart -->
    <script src="../../assets/plugins/raphael/raphael.min.js"></script>
    <script src="../../assets/plugins/morris/morris.min.js"></script>
    
    <script src="../js/pages/index.js?time=<?php echo time() ?>"></script>
</body>
</html>
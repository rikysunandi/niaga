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
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
    <link href="../../assets/plugins/jquery-steps/css/jquery.steps.css" rel="stylesheet">

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
                        <h4>Input WIG</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">WIG</a>
                            </li>
                            <li class="breadcrumb-item active">Input WIG</li>
                        </ol>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-5">Input WIG (Wildly Important Goals)</h4>
                            <form action="#" id="form-input-wig" class="step-form-vertical mb-4">
                                <div>
                                    <h4>WIG*</h4>
                                    <section>
                                        <div class="row">
                                            <div id="col-id" class="col-lg-12 mb-2 d-none">
                                                <div class="form-group">
                                                    <label class="text-label">ID</label>
                                                    <input type="text" id="id" name="id" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label for="bidang" class="text-label">Bidang/Biro*</label>
                                                    <div class="input-group">
                                                        <select id="bidang" name="bidang" title="Nama Bidang" class="form-control required" data-size="5" required>
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
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label for="nomor_va" class="text-label">Nama WIG*</label>
                                                    <input type="text" id="nama_wig" name="nama_wig" placeholder="DARI X KE Y KAPAN" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label for="keterangan" class="text-label">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>LAG MEASURE*</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Nama Lag Measure*</label>
                                                    <input type="text" id="nama_lag" name="nama_lag" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Satuan*</label>
                                                    <input type="text" id="satuan_lag" name="satuan_lag" class="form-control" placeholder="Rupiah/Pelanggan/Persen/Unit/Kali/Meter/dst..." required>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>LEAD MEASURE I*</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Nama Lead Measure*</label>
                                                    <input type="text" id="nama_lm_1" name="nama_lm_1" class="form-control" placeholder="Lead Measure Pendukung WIG" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Satuan*</label>
                                                    <input type="text" id="satuan_lm_1" name="satuan_lm_1" class="form-control" placeholder="Rupiah/Pelanggan/Persen/Unit/Kali/Meter/dst..." required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Jenis Polaritas*</label>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-check flex-grow-1">
                                                            <input id="polaritas_lm_positif_1" class="radio-outlined" checked  name="polaritas_lm_1" value="positif" type="radio">
                                                            <label for="polaritas_lm_positif_1" class="">Positif</label>
                                                        </div>
                                                        <div class="form-check flex-grow-1">
                                                            <input id="polaritas_lm_negatif_1" class="radio-outlined" name="polaritas_lm_1" value="negatif" type="radio">
                                                            <label for="polaritas_lm_negatif_1" class="">Negatif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Tipe Target*</label>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-check flex-grow-1">
                                                            <input id="target_non_akumulatif_1" class="radio-outlined" checked name="tipe_target_lm_1" value="non_akumulatif" type="radio">
                                                            <label for="target_non_akumulatif_1" class="">Non Akumulatif</label>
                                                        </div>
                                                        <div class="form-check flex-grow-1">
                                                            <input id="target_akumulatif_1" class="radio-outlined" name="tipe_target_lm_1" value="akumulatif" type="radio">
                                                            <label for="target_akumulatif_1" class="">Akumulatif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>LEAD MEASURE II</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Nama Lead Measure</label>
                                                    <input type="text" id="nama_lm_2" name="nama_lm_2" class="form-control" placeholder="Lead Measure Pendukung WIG">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Satuan</label>
                                                    <input type="text" id="satuan_lm_2" name="satuan_lm_2" class="form-control" placeholder="Rupiah/Pelanggan/Persen/Unit/Kali/Meter/dst...">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Jenis Polaritas</label>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-check flex-grow-1">
                                                            <input id="polaritas_lm_positif_2" class="radio-outlined" checked  name="polaritas_lm_2" value="positif" type="radio">
                                                            <label for="polaritas_lm_positif_2" class="">Positif</label>
                                                        </div>
                                                        <div class="form-check flex-grow-1">
                                                            <input id="polaritas_lm_negatif_2" class="radio-outlined" name="polaritas_lm_2" value="negatif" type="radio">
                                                            <label for="polaritas_lm_negatif_2" class="">Negatif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Tipe Target</label>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-check flex-grow-1">
                                                            <input id="target_non_akumulatif_2" class="radio-outlined" checked name="tipe_target_lm_2" value="non_akumulatif" type="radio">
                                                            <label for="target_non_akumulatif_2" class="">Non Akumulatif</label>
                                                        </div>
                                                        <div class="form-check flex-grow-1">
                                                            <input id="target_akumulatif_2" class="radio-outlined" name="tipe_target_lm_2" value="akumulatif" type="radio">
                                                            <label for="target_akumulatif_2" class="">Akumulatif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>LEAD MEASURE III</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Nama Lead Measure</label>
                                                    <input type="text" id="nama_lm_3" name="nama_lm_3" class="form-control" placeholder="Lead Measure Pendukung WIG">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Satuan</label>
                                                    <input type="text" id="satuan_lm_3" name="satuan_lm_3" class="form-control" placeholder="Rupiah/Pelanggan/Persen/Unit/Kali/Meter/dst...">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Jenis Polaritas</label>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-check flex-grow-1">
                                                            <input id="polaritas_lm_positif_3" class="radio-outlined" checked  name="polaritas_lm_3" value="positif" type="radio">
                                                            <label for="polaritas_lm_positif_3" class="">Positif</label>
                                                        </div>
                                                        <div class="form-check flex-grow-1">
                                                            <input id="polaritas_lm_negatif_3" class="radio-outlined" name="polaritas_lm_3" value="negatif" type="radio">
                                                            <label for="polaritas_lm_negatif_3" class="">Negatif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Tipe Target</label>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-check flex-grow-1">
                                                            <input id="target_non_akumulatif_3" class="radio-outlined" checked name="tipe_target_lm_3" value="non_akumulatif" type="radio">
                                                            <label for="target_non_akumulatif_3" class="">Non Akumulatif</label>
                                                        </div>
                                                        <div class="form-check flex-grow-1">
                                                            <input id="target_akumulatif_3" class="radio-outlined" name="tipe_target_lm_3" value="akumulatif" type="radio">
                                                            <label for="target_akumulatif_3" class="">Akumulatif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </form>
                            <div id="bottom-link" class="alert alert-sm alert-success d-none" role="alert">
                              Silahkan input <a id="input-target-lag-link" href="#" class="alert-link" target="_blank">Target Lag Measures</a> atau <a id="input-target-lm-link" href="#" class="alert-link" target="_blank">Target LM</a>, untuk menambahkan WIG baru dapat dilakukan <a id="input-wig-link" href="" class="alert-link">di sini</a>
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

    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>

    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="../../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../assets/plugins/bootstrap4-notify/bootstrap-notify.min.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/input-wig.js"></script>
</body>
</html>
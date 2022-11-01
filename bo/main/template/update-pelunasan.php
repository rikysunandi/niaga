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
                        <h4>Update Pelunasan AP2T</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Update Data</a>
                            </li>
                            <li class="breadcrumb-item active">Update Pelunasan AP2T</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Upload data</h4>
                                <div class="basic-form">
                                    <!-- <p class="mb-2">
                                        <img src="../../assets/images/upload-lunas.png" class="img-fluid" alt="Panduan Upload Pelunasan" />
                                    </p> -->
                                    <!-- 

                                    <p class="mb-2">Data yang diambil dari AP2T melalui menu <b>Transaksi Piutang</b> untuk Transaksi <b>22 Pelunasan On-Line.</b>(untuk Transaksi Nota Buku, Pembatalan Rekening, dan Pindah ke PRR akan diupload di UID).
                                    </p>
                                    <p class="mb-2">Untuk melakukan Download data pelunasan di AP2T agar dilakukan secara harian dengan rentang <b>download Hari H-1 s/d hari H</b> untuk menghindari data yang belum terdownload di hari sebelumnya.
                                    </p>
                                    <p class="mb-4">Upload file XLS (tanpa diedit) hasil Download dari AP2T dengan <code> ukuran per file maksimal 15Mb.</code>  
                                    </p>
                                     -->
                                    <p>Langkah-langkah:
                                        <ul>
                                            <li>1. Download Pelunasan dari AP2T sesuai rentang hari yang dibutuhkan, sehingga dapat didownload ke dalam <b>1 File saja</b></li>
                                            <li>2. Browse/Drag satu atau beberapa File Pelunasan ke Panel di bawah ini (maks 5 File)</li>
                                            <li>3. Klik tombol Upload, tunggu sampai File berhasil diupload ke Server</li>
                                            <li>4. Silahkan tunggu Progress Update Data yang sedang berjalan sampai <span class="text-success">sukses (hijau)</span></li>
                                            <li>5. Pemantauan data pelunasan yang belum diupload dapat dilakukan <a href="mon-blm-upload-pelunasan.php" class="badge badge-primary" target="_blank">di sini</a></li>
                                        </ul>
                                    </p>
                                    <p>Data yang diupload:
                                        <ul>
                                            <li>1. Transaksi Piutang - Kode Gerak 22 (Pagi: rentang H-1 s.d hari H; Sore dan malam: hanya hari H)</li>
                                            <li>2. Transaksi Piutang - Kode Gerak 23-Notabuku, 24-Beban Kantor, 31-Pembatalan, 41-PRR, cukup sekali di akhir bulan atau ketika Nihil (Rentang 1 bulan setiap download)</li>
                                        </ul>
                                    </p>
                                    <p>
                                        <!-- <div>Pemantauan data pelunasan yang belum diupload dapat dilakukan <a href="mon-blm-upload-pelunasan.php" class="badge badge-primary" target="_blank">di sini</a></div> -->
                                        <span class="text-warning">*Silahkan gunakan Web Browser (Firefox/Chrome) versi terbaru</span>
                                    </p><div class="mb-0">
                                        <form action="#">
                                            <div class="form-row">
                                                <div class="form-group mb-2 mr-4 d-none">
                                                    <label class="text-label d-block">UID</label>
                                                    <select id="sel_unitupi" class="selectpicker show-tick" data-size="5" data-inc-semua="T" >
                                                        <option disabled>Pilih Unit Induk</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2 mr-4 d-none">
                                                    <label class="text-label d-block">UP3</label>
                                                    <select id="sel_unitap" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
                                                        <option disabled>Pilih UP3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2 mr-4 d-none">
                                                    <label class="text-label d-block">ULP</label>
                                                    <select id="sel_unitup" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
                                                        <option disabled>Pilih ULP</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block"><small>KODE GERAK</small></label>
                                                <select id="sel_kodegerak" title="KODE GERAK" class="selectpicker show-tick" data-size="5" style="width: auto;" >
                                                    <option value="22" selected="selected">22 - LUNAS ONLINE</option>
                                                    <option value="23">23 - LUNAS NOTABUKU</option>
                                                    <option value="24">24 - LUNAS BEBAN KANTOR</option>
                                                    <option value="31">31 - PEMBATALAN REKENING</option>
                                                    <option value="41">41 - PINDAH KE PRR</option>
                                                </select>
                                            </div>
                                            </div>
                                        </form>
                                    </div>



                                    <form action="../controller/pelunasan/uploadFilePelunasan.php" id="upload-pelunasan" class="dropzone mt-4">
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
                                    <span class="msg">Mengupdate Pelunasan dari File </span>
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

    <!-- <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script> -->
    <script src="../../assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/update-pelunasan.js?time=<?php echo time() ?>"></script>
</body>
</html>
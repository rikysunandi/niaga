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

    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.bootstrap4.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
    
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
                        <h4>Pengajuan Flagging</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Saldo</a>
                            </li>
                            <li class="breadcrumb-item active">Pengajuan Flagging</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-xl-6">
                        <div class="card forms-card">
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Info Agenda</h4> -->
                                <div>
                                    <form>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Unit Induk</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select id="sel_unitupi" title="PILIH UNIT INDUK" class="selectpicker show-tick" data-inc-semua="T" >
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">UP3</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select id="sel_unitap" title="PILIH UP3" class="selectpicker show-tick" data-inc-semua="T" >
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Tgl Bayar</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input id="tgl_bayar" class="form-control input-daterange-datepicker" type="text" name="tgl_bayar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Rp Bayar</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">

                                                    <input type="text" id="rp_total" name="rp_total" required placeholder="Masukan Rupiah Pembayaran" class="form-control shouldNumber" id="">
                                                    <div class="invalid-feedback">
                                                        Please write a number here!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">SP2D</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="sp2d" aria-describedby="sp2d">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Detail Pelanggan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="detail_plg" aria-describedby="detail_plg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Keterangan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 text-right">
                                                <button type="button" disabled="disabled" class="btn btn-danger btn-sl-sm"><span class="mr-2"><i class="fa fa-trash" aria-hidden="true"></i></span>Hapus</button>
                                                <button type="submit" class="btn btn-primary btn-sl-sm"><span class="mr-2"><i class="fa fa-save" aria-hidden="true"></i></span>Simpan</button>
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

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>

    <?php include 'parts/footer.php'; ?>

    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>

    <script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/pengajuan-flagging.js"></script>
</body>
</html>
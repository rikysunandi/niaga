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


    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.bootstrap4.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
    <link href="../../assets/plugins/viewer/viewer.css" rel="stylesheet">

    
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">

    <style type="text/css">
        .foto{
            height: 400px;
            width: 300px;
            background-color: #cccccf;
        }
        .img_foto{
            height: 400px;
            width: 300px;
            border: 0px;
        }
        .img_foto:hover{
            cursor: pointer;
        }
        .map{
            height: 300px;
            width: 400px;
            background-color: #cccccf;
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
                        <h4>Info Pemeriksaan LPB Terakhir</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemeriksaan LBP</a>
                            </li>
                            <li class="breadcrumb-item active">Info Pemeriksaan LPB Terakhir</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    
                    <div class="col-xl-6">
                        <div class="card forms-card">
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Cari Agenda</h4> -->
                                <div>
                                    <form>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Idpel / No Meter</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input id="input_cari" type="text" class="form-control" placeholder="" aria-label="Cari Pelanggan" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <button id="btn_cari" class="btn btn-primary btn-flat" type="button" id="button-addon2"><i class="fa fa-search" aria-hidden="true" title="Cari"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                                            <label class="col-sm-4 col-form-label text-label">Idpel</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="idpel" aria-describedby="idpel">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">No Meter</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="nomor_meter_kwh" aria-describedby="nomor_meter_kwh">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Nama</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="nama" aria-describedby="nama">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Tarif/Daya</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="tarif_daya" aria-describedby="tarif_daya">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Unitap</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="unitap" aria-describedby="unitap">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Unitup</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="unitup" aria-describedby="unitup">
                                                </div>
                                            </div>
                                        </div><div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Tgl Pemeriksaan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="tgl_pemeriksaan" aria-describedby="tgl_pemeriksaan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Latitude</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="latitude" aria-describedby="latitude">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Longitude</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="longitude" aria-describedby="longitude">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Akurasi (m)</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="akurasi_koordinat" aria-describedby="akurasi_koordinat">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Petugas</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="user_input" aria-describedby="user_input">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Foto</h4>
                                <div class="foto">
                                    <img class="img_foto mb-2" />
                                    <small class="float-right">*Klik untuk memperbesar</small>
                                </div>
                            </div>
                        </div>
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Koordinat</h4>
                                <div class="map">
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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmTOVYVndxhvTkvCx8eBYBadsM1iYQrv8"></script>

    <script src="https://cdn.jsdelivr.net/gmap3/7.2.0/gmap3.min.js"></script>
    <script src="../../assets/plugins/viewer/viewer.js"></script>

    <!-- <script src="../../assets/plugins/jquery-zoom/jquery.zoom.min.js"></script> -->
    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/info-pemeriksaan-lpb.js"></script>
</body>
</html>
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
    <link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />
    <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
     
    <link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.datatables.css" type="text/css" />

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    <style>
        table.jexcel > thead > tr > td{
            background-color: #00838f !important;
            color: #fff !important;
        }
        table.jexcel > thead > tr > td.selected{
            background-color: #4e979d !important;
            color: #fff !important;
        }

        table.jexcel > tfoot > tr > td{
            background-color: #00838f !important;
            color: #fff !important;
        }
        table.jexcel > tfoot > tr > td.selected{
            background-color: #4e979d !important;
            color: #fff !important;
        }

        .jexcel tbody tr:nth-child(even) {
          background-color: #def6f9 !important;
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
                        <h4>Info Agenda</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">SKAI Khusus</a>
                            </li>
                            <li class="breadcrumb-item active">Info Agenda</li>
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
                                            <label class="col-sm-4 col-form-label text-label">No Agenda</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input id="noagenda_cari" type="text" class="form-control" placeholder="" aria-label="Cari Agenda" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <button id="btn_noagenda_cari" class="btn btn-primary btn-flat" type="button" id="button-addon2"><i class="fa fa-search" aria-hidden="true" title="Cari"></i></button>
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
                                            <label class="col-sm-4 col-form-label text-label">Unitap</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="unitap" aria-describedby="unitap">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Jenis Lap</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="jenislap" aria-describedby="jenislap">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">No Agenda</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="noagenda_individu" aria-describedby="noagenda_individu">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">No Agenda Kolektif</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="noagenda_kolektif" aria-describedby="noagenda_kolektif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Idpel</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="idpel" aria-describedby="idpel">
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
                                            <label class="col-sm-4 col-form-label text-label">Tgl Mohon</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="tglmohon" aria-describedby="tglmohon">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Jenis Transaksi</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="jenis_transaksi" aria-describedby="jenis_transaksi">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Ket Transaksi</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="ket_transaksi" aria-describedby="ket_transaksi">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Trf/Daya Lama</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="tarif_daya_lama" aria-describedby="tarif_daya_lama">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Trf/Daya Baru</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="tarif_daya_baru" aria-describedby="tarif_daya_baru">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Jenis MK</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="jenis_mk" aria-describedby="jenis_mk">
                                                </div>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card forms-card">
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Info Agenda</h4> -->
                                <div>
                                    <form>
                                        <!-- <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Sgm. Tegangan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="segmen_tegangan" aria-describedby="segmen_tegangan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Gol Tarif</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="keterangan_gol_tarif" aria-describedby="keterangan_gol_tarif">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Stts. Permohonan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="status_permohonan" aria-describedby="status_permohonan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Alasan TMP</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="alasan_kriteria_tmp" aria-describedby="alasan_kriteria_tmp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Status TMP</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="status_tmp" aria-describedby="rp_rab">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Status RAB</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="klasifikasi_rab" aria-describedby="rp_rab">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">RP BP</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="rp_bp" aria-describedby="rp_bp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">RP UJL</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="rp_ujl" aria-describedby="rp_ujl">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">RP RAB</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="rp_rab" aria-describedby="rp_rab">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">RAB Material</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="rab_material" aria-describedby="rp_rab">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">RAB Jasa</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control" id="rab_jasa" aria-describedby="rp_rab">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label text-label">Keterangan RAB</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <textarea readonly class="form-control" id="keterangan_rab" aria-describedby="keterangan_rab" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Progress Status</h4>
                                <div class="timeline_content">
                                    <ul class="timeline timeline-workplan">
                                        <li class="timeline-inverted">
                                            <p class="d-inline-block mt-3">10:00 to 12:00</p>
                                            <div class="timeline-badge success"></div>
                                            <div class="timeline-panel">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-4">Baru</h5>
                                                        <p>
                                                            <span>500mi  |</span>
                                                            <span>0.25m  |</span>
                                                            <span>108 bmp (Average heart rate)</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <p class="d-inline-block mt-3">10:00 to 12:00</p>
                                            <div class="timeline-badge success"></div>
                                            <div class="timeline-panel">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-4">Hitung RAB</h5>
                                                        <p>
                                                            <span>251ibs x 5 reps  |</span>
                                                            <span>  125 bmp (Average heart rate)</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <p class="d-inline-block mt-3">10:00 to 12:00</p>
                                            <div class="timeline-badge success"></div>
                                            <div class="timeline-panel">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-4">Update RAB</h5>
                                                        <p>
                                                            <span>3 Sets  |</span>
                                                            <span>  6, 7 Reps (Average heart rate)</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <p class="d-inline-block mt-3"></p>
                                            <div class="timeline-badge warning"></div>
                                            <div class="timeline-panel">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-4">Usulan</h5>
                                                        <p>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <p class="d-inline-block mt-3"></p>
                                            <div class="timeline-badge warning"></div>
                                            <div class="timeline-panel">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-4">Realisasi</h5>
                                                        <p>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <div id="spreadsheet"></div> -->
                                <div class="table-responsive">
                                    <table id="tbl_mon_material_agenda" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary-lighten-2">NOAGENDA</th>
                                                <th class="bg-primary-lighten-2">KATEGORI</th>
                                                <th class="bg-primary-lighten-2">JENIS</th>
                                                <th class="bg-primary-lighten-2">ID KEBUTUHAN</th>
                                                <th class="bg-primary-lighten-2">KEBUTUHAN</th>
                                                <th class="bg-primary-lighten-2">HARGA SATUAN</th>
                                                <th class="bg-primary-lighten-2">VOLUME</th>
                                                <th class="bg-primary-lighten-2">TOTAL HARGA (Inc.PPN)</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="bg-primary-lighten-2" colspan="7">TOTAL</th>
                                                <th class="bg-primary-lighten-2"></th>
                                            </tr>
                                        </tfoot>
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

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>

    <?php include 'parts/footer.php'; ?>

    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>

    <script src="../../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables/js/dataTables.buttons.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js "></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" ></script>
    <script src="../../assets/plugins/datatables-alteditor/dataTables.altEditor.free.js" ></script>
    <script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>
    <script src="https://jsuites.net/v4/jsuites.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/info-agenda.js"></script>

</body>
</html>
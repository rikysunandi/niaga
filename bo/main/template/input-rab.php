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
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    <style type="text/css">
        .modal-dialog{
            max-width: 680px !important;
            width: 680px !important;
        }
        table.dataTable tr th.select-checkbox.selected::after {
            content: "✔";
            margin-top: -11px;
            margin-left: -4px;
            text-align: center;
            text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
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
                        <h4>Update RAB</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">SKAI Khusus</a>
                            </li>
                            <li class="breadcrumb-item active">Update RAB</li>
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
                    <div class="col-xl-12">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Info Agenda</h4>
                                <div>
                                    <form class="row">
                                        <div class="col-6">
                                            <!-- <div class="form-group row align-items-center">
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
                                            </div> -->
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">No Agenda</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control" id="noagenda_individu" aria-describedby="noagenda_individu">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">No Kolektif</label>
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
                                            <div class="form-group row align-items-center d-none">
                                                <label class="col-sm-4 col-form-label text-label">Daya Baru</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control" id="daya_baru" aria-describedby="daya_baru">
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
                                                <label class="col-sm-4 col-form-label text-label">Keterangan TMP</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control" id="keterangan_alasan_kriteria_tmp" aria-describedby="keterangan_alasan_kriteria_tmp">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Status Mohon</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control" id="status_permohonan" aria-describedby="status_permohonan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Status TMP</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control" id="status_tmp" aria-describedby="status_tmp">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">RP UJL</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rp_ujl" aria-describedby="rp_ujl">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">RP BP</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rp_bp" aria-describedby="rp_bp">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">RAB Persil</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rp_rab_std" aria-describedby="rp_rab_std">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <div class="col-sm-4"></div>
                                                <label class="col-sm-4 col-form-label text-label">RAB Material</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rab_material_std" aria-describedby="rab_material_std">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <div class="col-sm-4"></div>
                                                <label class="col-sm-4 col-form-label text-label">RAB Jasa</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rab_jasa_std" aria-describedby="rab_jasa_std">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">RAB Perluasan</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rp_rab_perluasan" aria-describedby="rp_rab_perluasan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <div class="col-sm-4"></div>
                                                <label class="col-sm-4 col-form-label text-label">RAB Material</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rab_material_perluasan" aria-describedby="rab_material_perluasan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <div class="col-sm-4"></div>
                                                <label class="col-sm-4 col-form-label text-label">RAB Jasa</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rab_jasa_perluasan" aria-describedby="rab_jasa_perluasan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Status RAB</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control" id="status_proses" aria-describedby="status_proses">
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
                    <div class="col-xl-12">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Update RAB</h4>
                                
                                <div class="modal fade" id="tambah_kebutuhan_modal" tabindex="-1" role="dialog" aria-labelledby="tambah_kebutuhan_modal_label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Kebutuhan Agenda</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="basic-form">
                                                    <form>
                                                        <div class="form-group row align-items-center">
                                                            <label for="sel_jenis" class="col-sm-3 col-form-label text-label">Jenis:</label>
                                                            <div class="col-sm-9">
                                                                <select id="sel_jenis" name="JENIS" title="JENIS" class="selectpicker show-tick" data-size="5" >
                                                                    <option value="MDU">MATERIAL MDU</option>
                                                                    <option value="NON-MDU">MATERIAL NON-MDU</option>
                                                                    <option value="JASA">JASA</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <label for="sel_kebutuhan" class="col-sm-3 col-form-label text-label">Kebutuhan:</label>
                                                            <div class="col-sm-9">
                                                                <select id="sel_kebutuhan" name="KEBUTUHAN" title="KEBUTUHAN" class="selectpicker show-tick" data-size="5" >
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <label class="col-sm-3 col-form-label text-label">Harga Satuan:</label>
                                                            <div class="col-sm-3">
                                                                <div class="input-group">
                                                                    <input readonly type="text" class="form-control text-right number-separator" id="harga_satuan" name="HARGA_SATUAN" placeholder="Harga Satuan" aria-describedby="harga_satuan">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <label class="col-sm-3 col-form-label text-label">Volume:</label>
                                                            <div class="col-sm-3">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-right number-separator" id="volume" name="VOLUME" placeholder="" aria-describedby="volume">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <label class="col-sm-3 col-form-label text-label">Harga Total:</label>
                                                            <div class="col-sm-3">
                                                                <div class="input-group">
                                                                    <input readonly type="text" class="form-control text-right number-separator" id="harga_total" name="HARGA_TOTAL" placeholder="Harga Total" aria-describedby="harga_total">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" id="btn_tambah" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbl_kebutuhan" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center bg-primary-lighten-2"><input type="checkbox" name="select_all" value="1" id="select_all"></th>
                                                <th class="text-center bg-primary-lighten-2">JENIS</th>
                                                <th class="text-center bg-primary-lighten-2">ID</th>
                                                <th class="text-center bg-primary-lighten-2">KEBUTUHAN</th>
                                                <th class="text-center bg-primary-lighten-2">HARGA SATUAN</th>
                                                <th class="text-center bg-primary-lighten-2">VOLUME</th>
                                                <th class="text-center bg-primary-lighten-2">HARGA TOTAL</th>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="bg-primary-lighten-2" colspan="6">RP RAB</th>
                                                <th class="bg-primary-lighten-2"></th>
                                            </tr>
                                            <tr>
                                                <th class="bg-primary-lighten-2 text-right font-weight-bold" colspan="6">RP RAB+PPN 10%</th>
                                                <th class="bg-primary-lighten-2 text-right font-weight-bold"></th>
                                            </tr>
                                            <tr>
                                                <th class="bg-primary-lighten-2 text-right font-weight-bold" colspan="6">RP BP</th>
                                                <th class="bg-primary-lighten-2 text-right font-weight-bold"></th>
                                            </tr>
                                            <tr>
                                                <th class="bg-primary-lighten-2 text-right" colspan="6">STATUS</th>
                                                <th class="bg-primary-lighten-2 text-right"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <button id="btn_simpan" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Simpan <span class="btn-icon-right"><i
                                    class="fa fa-save"></i></span></button>

                                   <!--  <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button> -->
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
    <script src="../../assets/plugins/easy-number-separator/easy-number-separator.js"></script>
    <script src="../../assets/plugins/bootstrap4-notify/bootstrap-notify.min.js"></script>

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
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/input-rab.js"></script>

</body>
</html>
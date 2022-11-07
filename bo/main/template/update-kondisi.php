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

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    <style type="text/css">
        .modal-dialog{
            max-width: 680px !important;
            width: 680px !important;
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
                        <h4>Update Kondisi Daftung</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">SKAI Khusus</a>
                            </li>
                            <li class="breadcrumb-item active">Update Kondisi Daftung</li>
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
                                                <label class="col-sm-4 col-form-label text-label">RAB</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rp_rab" aria-describedby="rp_rab">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <div class="col-sm-4"></div>
                                                <label class="col-sm-4 col-form-label text-label">RAB Material</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rab_material" aria-describedby="rab_material">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <div class="col-sm-4"></div>
                                                <label class="col-sm-4 col-form-label text-label">RAB Jasa</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" id="rab_jasa" aria-describedby="rab_jasa">
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
                                <h4 class="card-title mb-4">Update Kondisi Daftung</h4>
                                <div>
                                    <form id="update_kondisi" class="row">
                                        <div class="col-6">
                                            <div hidden class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">NOAGENDA</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right" name="noagenda" id="noagenda" aria-describedby="noagenda">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Status Kelayakan</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <select readonly id="status_kelayakan" name="status_kelayakan" title="STATUS KELAYAKAN" class="selectpicker show-tick" data-size="5" >
                                                            <option value="SURVEY">SURVEY</option>
                                                            <option value="RAB">RAB</option>
                                                            <option value="NEGOSIASI">NEGOSIASI</option>
                                                            <option value="RESTITUSI">RESTITUSI</option>
                                                            <option value="LANJUT">LANJUT</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Ket. Kelayakan</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <textarea id="keterangan_kelayakan" name="keterangan_kelayakan" readonly class="form-control" rows="4" maxlength="255"> </textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Kendala (PLN)</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <textarea id="kendala_pln" name="kendala_pln" readonly class="form-control" rows="4" maxlength="255"> </textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Kendala (Pelanggan)</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <textarea id="kendala_plg" name="kendala_plg" readonly class="form-control" rows="4" maxlength="255"> </textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Material Sudah SPB</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <textarea id="sudah_spb" name="sudah_spb" readonly class="form-control" rows="4" maxlength="255"> </textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Material Belum SPB</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <textarea id="belum_spb" name="belum_spb" readonly class="form-control" rows="4" maxlength="255"> </textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">% Pekerjaan</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" readonly class="form-control text-right number-separator" name="prosentase_pekerjaan" id="prosentase_pekerjaan" aria-describedby="basic-addon2" max="100">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Tgl Estimasi Nyala</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input readonly class="form-control" type="date" id="tgl_estimasi_nyala" name="tgl_estimasi_nyala">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Solusi Percepatan</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <textarea id="solusi_percepatan" name="solusi_percepatan" readonly class="form-control" rows="4" maxlength="255"> </textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-4 col-form-label text-label">Keterangan Tambahan</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <textarea id="keterangan" name="keterangan" readonly class="form-control" rows="4" maxlength="1000"> </textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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


    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/update-kondisi.js"></script>

</body>
</html>
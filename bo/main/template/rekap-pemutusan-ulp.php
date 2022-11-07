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
    <link href="../../assets/plugins/datatables-lib/DataTables-1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/FixedColumns-4.0.1/css/fixedColumns.bootstrap4.min.css">
    <link href="../../assets/plugins/datatables-lib/Buttons-2.1.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/Responsive-2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatables-lib/RowGroup-1.1.4/css/rowGroup.dataTables.min.css" rel="stylesheet">

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">

    <style type="text/css">
        table.dataTable tbody td {
          color: #000 !important;
        }
        table.dataTable thead td {
          color: #000 !important;
        }
        table.dataTable tfoot td {
          color: #000 !important;
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
                        <h4>Rekap Pemutusan per ULP</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemutusan</a>
                            </li>
                            <li class="breadcrumb-item active">Rekap Pemutusan per ULP</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kriteria Pencarian</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-0">
                                    <form action="#">
                                        <div class="form-row">
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">UID</label>
                                                <select id="sel_unitupi" class="selectpicker show-tick" data-size="5" data-inc-semua="T">
                                                    <option disabled>Pilih Unit Induk</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">UP3</label>
                                                <select id="sel_unitap" class="selectpicker show-tick" data-size="5" >
                                                    <option disabled>Pilih UP3</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">ULP</label>
                                                <select id="sel_unitup" class="selectpicker show-tick" data-size="5" >
                                                    <option disabled>Pilih ULP</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2 mr-4">
                                                <label class="text-label d-block">BLTH REK</label>
                                                <select id="sel_blth" class="selectpicker select-sm show-tick" data-size="5" data-width="fit">
                                                    <option value="<?php echo date('Ym') ?>" selected="selected"><?php echo date('Ym') ?></option>
                                                    <option data-divider="true"></option>
                                                    <option value='<?php echo date('Ym', strtotime("last day of previous month")) ?>'><?php echo date('Ym', strtotime("last day of previous month")) ?></option>
                                                    <option value='<?php echo date('Ym', strtotime("-2 month")) ?>'><?php echo date('Ym', strtotime("-2 month")) ?></option>
                                                    <option value='<?php echo date('Ym', strtotime("-3 month")) ?>'><?php echo date('Ym', strtotime("-3 month")) ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right mt-2">
                                    <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Cari <span class="btn-icon-right"><i
                                        class="fa fa-search"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Rekap Pemutusan per UP3</h4>
                                <div>
                                    <p>
                                        Periode Pemutusan: Diatas Tanggal 21 pada Bulan Berjalan.
                                    </p>
                                    <p>
                                        <span class="text-success">LUNAS BY SYSTEM: </span>WO Pemutusan sudah lunas terlebih dahulu secara AP2T sebelum ditindaklanjuti di Lapangan dan belum diakui sebagai perolehan petugas.
                                    </p>
                                </div>
                                <div class="table-responsive">
                                    <table id="tbl_rekap_pemutusan_up3" class="table table-striped table-bordered nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">UNITUPI</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">UNITAP</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">UP3</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">PETUGAS</th>
                                            <th colspan="4" class="text-center bg-warning-lighten-2">WORK ORDER</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">LUNAS BY SYSTEM<br/>TANPA KE LAPANGAN</th>
                                            <th colspan="21" class="text-center bg-success-lighten-2">HASIL EKSEKUSI LAPANGAN</th>
                                            <th rowspan="2" colspan="3" class="text-center bg-secondary-lighten-2">TOTAL LUNAS BY SYSTEM<br/>+TOTAL EKSEKUSI</th>
                                            <th rowspan="1" colspan="48" class="text-center bg-primary-lighten-2">BREAKDOWN PER TANGGAL</th>
                                            
                                        </tr>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th rowspan="2" class="text-center bg-warning-lighten-2">BARU</th>
                                            <th rowspan="2" class="text-center bg-success-lighten-2">LANCAR</th>
                                            <th rowspan="2" class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th colspan="2" class="text-center bg-success-lighten-2">LUNAS MANDIRI</th>
                                            <th colspan="2" class="text-center bg-success-lighten-2">LUNAS DITEMPAT</th>
                                            <th colspan="2" class="text-center bg-warning-lighten-2">SEGEL MCB</th>
                                            <th colspan="2" class="text-center bg-warning-lighten-2">CABUT MCB</th>
                                            <th colspan="2" class="text-center bg-warning-lighten-2">CABUT APP</th>
                                            <th colspan="2" class="text-center bg-danger-lighten-2">RUMAH KOSONG</th>
                                            <th colspan="3" class="text-center bg-secondary-lighten-2">TOTAL EKSEKUSI</th>
                                            <th colspan="3" class="text-center bg-secondary-lighten-2">TOTAL PEMUTUSAN (CABUT/SEGEL)</th>
                                            <th colspan="3" class="text-center bg-secondary-lighten-2">TOTAL EKSEKUSI YG LUNAS AP2T</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 21</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 22</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 23</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 24</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 25</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">DIATAS TGL 25</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-success-lighten-2">JML</th>
                                            <th class="text-center bg-success-lighten-2">LNS</th>
                                            <th class="text-center bg-success-lighten-2">JML</th>
                                            <th class="text-center bg-success-lighten-2">LNS</th>
                                            <th class="text-center bg-warning-lighten-2">JML</th>
                                            <th class="text-center bg-warning-lighten-2">LNS</th>
                                            <th class="text-center bg-warning-lighten-2">JML</th>
                                            <th class="text-center bg-warning-lighten-2">LNS</th>
                                            <th class="text-center bg-warning-lighten-2">JML</th>
                                            <th class="text-center bg-warning-lighten-2">LNS</th>
                                            <th class="text-center bg-danger-lighten-2">JML</th>
                                            <th class="text-center bg-danger-lighten-2">LNS</th>
                                            <th class="text-center bg-secondary-lighten-2">JML</th>
                                            <th class="text-center bg-secondary-lighten-2">PERSEN</th>
                                            <th class="text-center bg-secondary-lighten-2">RATA2<br/>PETUGAS</th>
                                            <th class="text-center bg-secondary-lighten-2">JML</th>
                                            <th class="text-center bg-secondary-lighten-2">PERSEN</th>
                                            <th class="text-center bg-secondary-lighten-2">RATA2<br/>PETUGAS</th>
                                            <th class="text-center bg-secondary-lighten-2">LUNAS</th>
                                            <th class="text-center bg-secondary-lighten-2">PERSEN</th>
                                            <th class="text-center bg-secondary-lighten-2">RATA2<br/>PETUGAS</th>
                                            <th class="text-center bg-secondary-lighten-2">LUNAS</th>
                                            <th class="text-center bg-secondary-lighten-2">PERSEN</th>
                                            <th class="text-center bg-secondary-lighten-2">RATA2<br/>PETUGAS</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2" colspan="3">TOTAL</th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Rekap Pemutusan per ULP</h4>
                                <div class="table-responsive">
                                    <table id="tbl_rekap_pemutusan_ulp" class="table table-striped table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">UNITAP</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">UNITUP</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">ULP</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">PETUGAS</th>
                                            <th colspan="4" class="text-center bg-warning-lighten-2">WORK ORDER</th>
                                            <th rowspan="3" class="text-center bg-primary-lighten-2">LUNAS BY SYSTEM<br/>TANPA KE LAPANGAN</th>
                                            <th colspan="21" class="text-center bg-success-lighten-2">HASIL EKSEKUSI LAPANGAN</th>
                                            <th rowspan="2" colspan="3" class="text-center bg-secondary-lighten-2">TOTAL LUNAS BY SYSTEM<br/>+TOTAL EKSEKUSI</th>
                                            <th rowspan="1" colspan="48" class="text-center bg-primary-lighten-2">BREAKDOWN PER TANGGAL</th>
                                            
                                        </tr>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-danger-lighten-2">IRISAN</th>
                                            <th rowspan="2" class="text-center bg-warning-lighten-2">BARU</th>
                                            <th rowspan="2" class="text-center bg-success-lighten-2">LANCAR</th>
                                            <th rowspan="2" class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th colspan="2" class="text-center bg-success-lighten-2">LUNAS MANDIRI</th>
                                            <th colspan="2" class="text-center bg-success-lighten-2">LUNAS DITEMPAT</th>
                                            <th colspan="2" class="text-center bg-warning-lighten-2">SEGEL MCB</th>
                                            <th colspan="2" class="text-center bg-warning-lighten-2">CABUT MCB</th>
                                            <th colspan="2" class="text-center bg-warning-lighten-2">CABUT APP</th>
                                            <th colspan="2" class="text-center bg-danger-lighten-2">RUMAH KOSONG</th>
                                            <th colspan="3" class="text-center bg-secondary-lighten-2">TOTAL EKSEKUSI</th>
                                            <th colspan="3" class="text-center bg-secondary-lighten-2">TOTAL PEMUTUSAN (CABUT/SEGEL)</th>
                                            <th colspan="3" class="text-center bg-secondary-lighten-2">TOTAL EKSEKUSI YG LUNAS AP2T</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 21</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 22</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 23</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 24</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">TGL 25</th>
                                            <th rowspan="1" colspan="8" class="text-center bg-primary-lighten-2">DIATAS TGL 25</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center bg-success-lighten-2">JML</th>
                                            <th class="text-center bg-success-lighten-2">LNS</th>
                                            <th class="text-center bg-success-lighten-2">JML</th>
                                            <th class="text-center bg-success-lighten-2">LNS</th>
                                            <th class="text-center bg-warning-lighten-2">JML</th>
                                            <th class="text-center bg-warning-lighten-2">LNS</th>
                                            <th class="text-center bg-warning-lighten-2">JML</th>
                                            <th class="text-center bg-warning-lighten-2">LNS</th>
                                            <th class="text-center bg-warning-lighten-2">JML</th>
                                            <th class="text-center bg-warning-lighten-2">LNS</th>
                                            <th class="text-center bg-danger-lighten-2">JML</th>
                                            <th class="text-center bg-danger-lighten-2">LNS</th>
                                            <th class="text-center bg-secondary-lighten-2">JML</th>
                                            <th class="text-center bg-secondary-lighten-2">PERSEN</th>
                                            <th class="text-center bg-secondary-lighten-2">RATA2<br/>PETUGAS</th>
                                            <th class="text-center bg-secondary-lighten-2">JML</th>
                                            <th class="text-center bg-secondary-lighten-2">PERSEN</th>
                                            <th class="text-center bg-secondary-lighten-2">RATA2<br/>PETUGAS</th>
                                            <th class="text-center bg-secondary-lighten-2">LUNAS</th>
                                            <th class="text-center bg-secondary-lighten-2">PERSEN</th>
                                            <th class="text-center bg-secondary-lighten-2">RATA2<br/>PETUGAS</th>
                                            <th class="text-center bg-secondary-lighten-2">LUNAS</th>
                                            <th class="text-center bg-secondary-lighten-2">PERSEN</th>
                                            <th class="text-center bg-secondary-lighten-2">RATA2<br/>PETUGAS</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                            <th class="text-center bg-primary-lighten-2">LUNAS<br/>BY SYSTEM</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>MANDIRI</th>
                                            <th class="text-center bg-success-lighten-2">LUNAS<br/>DITEMPAT</th>
                                            <th class="text-center bg-warning-lighten-2">SEGEL<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>MCB</th>
                                            <th class="text-center bg-warning-lighten-2">CABUT<br/>APP</th>
                                            <th class="text-center bg-danger-lighten-2">RUMAH<br/>KOSONG</th>
                                            <th class="text-center bg-secondary-lighten-2">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="bg-primary-lighten-2" colspan="3">TOTAL</th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
                                            <th class="bg-primary-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-success-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-warning-lighten-2"></th>
                                            <th class="bg-danger-lighten-2"></th>
                                            <th class="bg-secondary-lighten-2"></th>
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

    <?php include 'parts/footer.php'; ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>

    <script src="../../assets/plugins/moment/moment.min.js"></script>
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
    <script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>

    <script src="../js/pages/apps.js"></script>
    <script src="../js/pages/rekap-pemutusan-ulp.js?time=26"></script>
</body>
</html>
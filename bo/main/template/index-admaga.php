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
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    
    <style type="text/css">
        .timeline-centered {
          position: relative;
          margin-bottom: 30px;
        }
        .timeline-centered.timeline-sm .timeline-entry {
          margin-bottom: 20px !important;
        }
        .timeline-centered.timeline-sm .timeline-entry .timeline-entry-inner .timeline-label {
          padding: 1em;
        }
        .timeline-centered:before,
        .timeline-centered:after {
          content: " ";
          display: table;
        }
        .timeline-centered:after {
          clear: both;
        }
        .timeline-centered:before {
          content: '';
          position: absolute;
          display: block;
          width: 7px;
          background: #ffffff;
          left: 50%;
          top: 20px;
          bottom: 20px;
          margin-left: -4px;
        }
        .timeline-centered .timeline-entry {
          position: relative;
          width: 50%;
          float: right;
          margin-bottom: 70px;
          clear: both;
        }
        .timeline-centered .timeline-entry:before,
        .timeline-centered .timeline-entry:after {
          content: " ";
          display: table;
        }
        .timeline-centered .timeline-entry:after {
          clear: both;
        }
        .timeline-centered .timeline-entry.begin {
          margin-bottom: 0;
        }
        .timeline-centered .timeline-entry.left-aligned {
          float: left;
        }
        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
          margin-left: 0;
          margin-right: -28px;
        }
        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
          left: auto;
          right: -115px;
          text-align: left;
        }
        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
          float: right;
        }
        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
          margin-left: 0;
          margin-right: 85px;
        }
        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
          left: auto;
          right: 0;
          margin-left: 0;
          margin-right: -9px;
          -moz-transform: rotate(180deg);
          -o-transform: rotate(180deg);
          -webkit-transform: rotate(180deg);
          -ms-transform: rotate(180deg);
          transform: rotate(180deg);
        }
        .timeline-centered .timeline-entry .timeline-entry-inner {
          position: relative;
          margin-left: -31px;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner:before,
        .timeline-centered .timeline-entry .timeline-entry-inner:after {
          content: " ";
          display: table;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner:after {
          clear: both;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
          position: absolute;
          left: -115px;
          text-align: right;
          padding: 10px;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span {
          display: block;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:first-child {
          font-size: 18px;
          font-weight: bold;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:last-child {
          font-size: 12px;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
          background: #fff;
          color: #999999;
          display: block;
          width: 60px;
          height: 60px;
          -webkit-background-clip: padding-box;
          -moz-background-clip: padding-box;
          background-clip: padding-box;
          border-radius: 50%;
          text-align: center;
          border: 7px solid #ffffff;
          line-height: 45px;
          font-size: 15px;
          float: left;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
          background-color: #dc6767;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-success {
          background-color: #5cb85c;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-info {
          background-color: #5bc0de;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-warning {
          background-color: #f0ad4e;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-danger {
          background-color: #d9534f;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-red {
          background-color: #bf4346;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-green {
          background-color: #488c6c;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-blue {
          background-color: #0a819c;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-yellow {
          background-color: #f2994b;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-orange {
          background-color: #e9662c;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-pink {
          background-color: #bf3773;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-violet {
          background-color: #9351ad;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-grey {
          background-color: #4b5d67;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-dark {
          background-color: #594857;
          color: #fff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
          position: relative;
          background: #ffffff;
          padding: 1.7em;
          margin-left: 85px;
          -webkit-background-clip: padding-box;
          -moz-background-clip: padding;
          background-clip: padding-box;
          -webkit-border-radius: 3px;
          -moz-border-radius: 3px;
          border-radius: 3px;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-red {
          background: #bf4346;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-red:after {
          border-color: transparent #bf4346 transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-red .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-red p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-green {
          background: #488c6c;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-green:after {
          border-color: transparent #488c6c transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-green .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-green p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-orange {
          background: #e9662c;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-orange:after {
          border-color: transparent #e9662c transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-orange .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-orange p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-yellow {
          background: #f2994b;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-yellow:after {
          border-color: transparent #f2994b transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-yellow .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-yellow p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-blue {
          background: #0a819c;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-blue:after {
          border-color: transparent #0a819c transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-blue .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-blue p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-pink {
          background: #bf3773;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-pink:after {
          border-color: transparent #bf3773 transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-pink .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-pink p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-violet {
          background: #9351ad;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-violet:after {
          border-color: transparent #9351ad transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-violet .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-violet p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-grey {
          background: #4b5d67;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-grey:after {
          border-color: transparent #4b5d67 transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-grey .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-grey p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-dark {
          background: #594857;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-dark:after {
          border-color: transparent #594857 transparent transparent;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-dark .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-dark p {
          color: #ffffff;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
          content: '';
          display: block;
          position: absolute;
          width: 0;
          height: 0;
          border-style: solid;
          border-width: 9px 9px 9px 0;
          border-color: transparent #ffffff transparent transparent;
          left: 0;
          top: 20px;
          margin-left: -9px;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label .timeline-title,
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
          color: #999999;
          margin: 0;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p + p {
          margin-top: 15px;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label .timeline-title {
          margin-bottom: 10px;
          font-family: 'Oswald';
          font-weight: bold;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label .timeline-title span {
          -webkit-opacity: .6;
          -moz-opacity: .6;
          opacity: .6;
          -ms-filter: alpha(opacity=60);
          filter: alpha(opacity=60);
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p .timeline-img {
          margin: 5px 10px 0 0;
        }
        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p .timeline-img.pull-right {
          margin: 5px 0 0 10px;
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
                        <h4>Dashboard Saldo TS P2TL Anomali Prabayar</h4>
                        <span id="tgl_data">tanggal data: </span>
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
                <div class="row">
                    <div class="col-sm-4 col-lg-4">
                        <div class="card saldo-awal">
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-3">Saldo Awal</h4>
                                <p class="font-small">Saldo per 31 Oktober 2019</p>
                            </div>
                            <div class="card-body p-2">
                                <div id="chart_saldo_awal" class="p-2">
                                    <canvas></canvas>
                                </div>
                                <div class="table-responsive">
                                    <table class="table trading-activity table-responsive-fix">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Plg</th>
                                                <th class="text-center">Agenda</th>
                                                <th class="text-center">Rp TS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hijau">
                                                <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                            <tr class="kuning">
                                                <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                            <tr class="merah">
                                                <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="total">
                                                <td></td>
                                                <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <div class="card realisasi">
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-3">Realisasi</h4>
                                <p class="font-small">Realisasi 31 Okt 2019 s.d 28 Feb 2021</p>
                            </div>
                            <div class="card-body p-2">
                                <div id="chart_realisasi" class="p-2">
                                    <canvas></canvas>
                                </div>
                                <div class="table-responsive">
                                    <table class="table trading-activity table-responsive-fix">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Plg</th>
                                                <th class="text-center">Agenda</th>
                                                <th class="text-center">Rp TS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hijau">
                                                <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                            <tr class="kuning">
                                                <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                            <tr class="merah">
                                                <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="total">
                                                <td></td>
                                                <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <div class="card saldo-akhir">
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-3">Saldo Akhir</h4>
                                <p class="font-small">Saldo per 28 Februari 2021</p>
                            </div>
                            <div class="card-body p-2">
                                <div id="chart_saldo_akhir" class="p-2">
                                    <canvas></canvas>
                                </div>
                                <div class="table-responsive">
                                    <table class="table trading-activity table-responsive-fix">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Plg</th>
                                                <th class="text-center">Agenda</th>
                                                <th class="text-center">Rp TS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hijau">
                                                <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                            <tr class="kuning">
                                                <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                            <tr class="merah">
                                                <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                </td>
                                                <td class="jml-plg text-right">-</td>
                                                <td class="jml-agenda text-right">-</td>
                                                <td class="rpts-miliyar text-right">-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="total">
                                                <td></td>
                                                <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <h4 class="mb-2">Histori Pergerakan Data</h4>
                    <div class="col-md-12">
                        <div class="timeline-centered timeline-sm">
                            <article class="timeline-entry histori-saldo-awal">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time"><span>18 Feb</span><span>2021</span></time>
                                    <div class="timeline-icon bg-violet"><i class="fa fa-paper-plane"></i></div>
                                    <div class="timeline-label">
                                        <h4 class="timeline-title">Saldo Awal 31 Okt 2019</h4>
                    
                                        <p>
                                            Pemilahan Saldo TS LPB berdasarkan kesesuaian Coklit:
                                            <ul>
                                                <li>Coklit sesuai 3 berkas: <span class="badge badge-success">Hijau</span></li>
                                                <li>Coklit sesuai 1 atau 2 berkas: <span class="badge badge-warning">Kuning</span></li>
                                                <li>Coklit sesuai 0 berkas: <span class="badge badge-danger">Merah</span></li>
                                            </ul>
                                        </p>

                                        <div class="table-responsive">
                                            <table class="table trading-activity table-responsive-fix">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jml Plg</th>
                                                        <th class="text-center">Jml Agenda</th>
                                                        <th class="text-center">Rp TS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="hijau">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="kuning">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="merah">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="total">
                                                        <td></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>


                                    </div>

                                </div>
                            </article>
                            <article class="timeline-entry histori-saldo-1 left-aligned">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time"><span>25 Feb</span><span>2021</span></time>
                                    <div class="timeline-icon bg-green"><i class="fa fa-money"></i></div>
                                    <div class="timeline-label">
                                        <h4 class="timeline-title">Update Saldo Des 2020</h4>
                    
                                        <p>Pengurangan Saldo TS berdasarkan Saldo TS Desember 2020</p>
                                        <div class="table-responsive">
                                            <table class="table trading-activity table-responsive-fix">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jml Plg</th>
                                                        <th class="text-center">Jml Agenda</th>
                                                        <th class="text-center">Rp TS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="hijau">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="kuning">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="merah">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="total">
                                                        <td></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </article>
                            <article class="timeline-entry histori-saldo-2">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time"><span>25 Feb</span><span>2021</span></time>
                                    <div class="timeline-icon bg-orange"><i class="fa fa-exchange"></i></div>
                                    <div class="timeline-label">
                                        <h4 class="timeline-title">Mutasi Kategori</h4>
                                        <p>Pemindahan beberapa Agenda Kategori <span class="badge badge-danger">Merah</span> dan <span class="badge badge-warning">Kuning</span> ke Kategori <span class="badge badge-success">Hijau</span> dikarenakan ada Realisasi dari Okt 2019 s.d Des 2020 berdasarkan Saldo Des 2020</p>
                                        <div class="table-responsive">
                                            <table class="table trading-activity table-responsive-fix">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jml Plg</th>
                                                        <th class="text-center">Jml Agenda</th>
                                                        <th class="text-center">Rp TS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="hijau">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="kuning">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="merah">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="total">
                                                        <td></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="timeline-entry histori-saldo-3 left-aligned">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time"><span>04 Mar</span><span>2021</span></time>
                                    <div class="timeline-icon bg-green"><i class="fa fa-money"></i></div>
                                    <div class="timeline-label">
                                        <h4 class="timeline-title">Update Saldo Jan 2021</h4>
                    
                                        <p>Pengurangan Saldo TS berdasarkan Saldo TS Januari 2021</p>
                                        <div class="table-responsive">
                                            <table class="table trading-activity table-responsive-fix">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jml Plg</th>
                                                        <th class="text-center">Jml Agenda</th>
                                                        <th class="text-center">Rp TS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="hijau">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="kuning">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="merah">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="total">
                                                        <td></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </article>
                            <article class="timeline-entry histori-saldo-4">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time"><span>04 Mar</span><span>2021</span></time>
                                    <div class="timeline-icon bg-orange"><i class="fa fa-exchange"></i></div>
                                    <div class="timeline-label">
                                        <h4 class="timeline-title">Mutasi Kategori</h4>
                                        <p>Pemindahan beberapa Agenda Kategori <span class="badge badge-danger">Merah</span> dan <span class="badge badge-warning">Kuning</span> ke Kategori <span class="badge badge-success">Hijau</span> dikarenakan ada Realisasi selama Januari 2021. Berikut pemindahan Kategori <span class="badge badge-warning">Kuning</span> yang tidak ada berkas Berita Acara (BA) ke Kategori <span class="badge badge-danger">Merah</span></p>
                                        <div class="table-responsive">
                                            <table class="table trading-activity table-responsive-fix">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jml Plg</th>
                                                        <th class="text-center">Jml Agenda</th>
                                                        <th class="text-center">Rp TS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="hijau">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="kuning">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="merah">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="total">
                                                        <td></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="timeline-entry histori-saldo-5 left-aligned">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time"><span>18 Mar</span><span>2021</span></time>
                                    <div class="timeline-icon bg-green"><i class="fa fa-money"></i></div>
                                    <div class="timeline-label">
                                        <h4 class="timeline-title">Update Saldo Feb 2021</h4>
                    
                                        <p>Pengurangan Saldo TS berdasarkan Saldo TS Februari 2021</p>
                                        <div class="table-responsive">
                                            <table class="table trading-activity table-responsive-fix">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jml Plg</th>
                                                        <th class="text-center">Jml Agenda</th>
                                                        <th class="text-center">Rp TS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="hijau">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="kuning">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="merah">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="total">
                                                        <td></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </article>
                            <article class="timeline-entry histori-saldo-6">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time"><span>18 Mar</span><span>2021</span></time>
                                    <div class="timeline-icon bg-orange"><i class="fa fa-exchange"></i></div>
                                    <div class="timeline-label">
                                        <h4 class="timeline-title">Mutasi Kategori</h4>
                                        <p>Pemindahan beberapa Agenda Kategori <span class="badge badge-danger">Merah</span> dan <span class="badge badge-warning">Kuning</span> ke Kategori <span class="badge badge-success">Hijau</span> dikarenakan ada Realisasi selama Feb 2021</p>
                                        <div class="table-responsive">
                                            <table class="table trading-activity table-responsive-fix">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jml Plg</th>
                                                        <th class="text-center">Jml Agenda</th>
                                                        <th class="text-center">Rp TS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="hijau">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-success">Hijau</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="kuning">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-warning">Kuning</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                    <tr class="merah">
                                                        <td class="text-center"><span class="label label-sm label-rounded label-danger">Merah</span>
                                                        </td>
                                                        <td class="jml-plg text-right">-</td>
                                                        <td class="jml-agenda text-right">-</td>
                                                        <td class="rpts-miliyar text-right">-</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="total">
                                                        <td></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-plg">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold jml-agenda">-</span></td>
                                                        <td class="text-right"><span class="font-weight-bold rpts-miliyar">-</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-entry-inner">
                                        <div class="timeline-icon bg-success"><i class="fa fa-check"></i></div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_ts_p2tl" class="card">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Saldo TS P2TL Prabayar per Unit</h4>
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
                                <div id="chart_ts_p2tl_unit" class="mb-4">
                                    <canvas></canvas>
                                </div>
                                <hr class="mb-4" />
                                <h4 class="mt-4">Rekap TS Kategori <span class="badge badge-xl badge-success">Hijau</span> per Unit</h4>
                                <div class="table-responsive p-2">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
                                        <thead>
                                            <tr>
                                                <th class="bg-success text-white text-center">KODE</th>
                                                <th class="bg-success text-white text-center">NAMA</th>
                                                <th class="bg-success text-white text-center">JML PLG</th>
                                                <th class="bg-success text-white text-center">JML AGENDA</th>
                                                <th class="bg-success text-white text-center">RPTS</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-6">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="card_permohonan_alasan" class="card chartjs-stat-card-1">
                                    <div class="card-header">
                                        <h4 class="card-title mb-4 text-dark">Alasan Kriteria TMP</h4>
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
                                        <canvas id="chart_permohonan_alasan"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="card_permohonan_jenis" class="card chartjs-stat-card-1">
                                    <div class="card-header">
                                        <h4 class="card-title mb-4 text-dark">Keterangan Transaksi</h4>
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
                        </div>
                    </div>
                </div>
                 -->
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
    
    <script src="../js/pages/index-admaga.js"></script>
</body>
</html>
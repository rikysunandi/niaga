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
                        <h4>Dashboard Tindak Lanjut TS P2TL Anomali</h4>
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
                                        <option value='53KRG'>UP3 KARAWANG</option>
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
                    <div class="col-sm-12 col-lg-12">
                        <div class="card saldo-awal">
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-3">Overview</h4>
                                <p class="font-small">Periode 19 Maret - 25 Maret</p>
                            </div>
                            <div class="card-body p-2">
                              <div class="row">
                                <div class="col-sm-8 col-lg-8">
                                  <div id="chart_tidanklanjut_harian" class="p-2">
                                      <canvas></canvas>
                                  </div>
                                </div>
                                <div class="col-sm-4 col-lg-4">
                                  <div id="chart_tindaklanjut_total" class="p-2">
                                      <canvas></canvas>
                                  </div>
                                </div>
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
                                <h4 class="card-title mt-3">Saldo TS P2TL per Unit</h4>
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
    
    <script src="../js/pages/index-tindaklanjut-ts.js"></script>
</body>
</html>
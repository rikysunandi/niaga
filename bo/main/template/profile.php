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
    <link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet">
    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../../assets/plugins/password-strength-meter/dist/password.min.css" rel="stylesheet">

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
        <<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col p-md-0">
                        <h4>Profile <?php echo $_SESSION['nama'] ?></h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">App</a>
                            </li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <div class="cover-photo"></div>
                                    <div class="profile-photo">
                                        <img src="../../assets/images/avatar/<?php echo $_SESSION['avatar'] ?>" class="img-fluid rounded-circle" alt="">
                                    </div>
                                </div>
                                <div class="profile-info">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                    <div class="profile-name">
                                                        <h4 class="text-primary"><?php echo $_SESSION['nama'] ?></h4>
                                                        <p><?php echo $_SESSION['keterangan'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                    <div class="profile-email">
                                                        <h4 class="text-muted"><?php echo $_SESSION['email'] ?></h4>
                                                        <p>Email</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 prf-col">
                                                    <div class="profile-call">
                                                        <h4 class="text-muted"><?php echo $_SESSION['nohp'] ?></h4>
                                                        <p>Phone No.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card log-user">
                            <div class="card-body">
                                
                                <div class="mb-2">
                                    <h5 class="text-primary d-inline">Log User</h5>
                                    <div class="table-responsive mt-2">
                                        <table id="log_user" class="table table-hover table-responsive table-sm">
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
<!-- 
                                <div class="profile-blog pt-3 border-bottom-1 pb-1 d-none">
                                    <h5 class="text-primary d-inline">Today Highlights</h5><a href="javascript:void()" class="pull-right f-s-16">More</a> 
                                    <img src="../../assets/images/profile/1.jpg" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4>Darwin Creative Agency Theme</h4>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                                </div>
                                <div class="profile-interest mt-4 pb-2 border-bottom-1 d-none">
                                    <h5 class="text-primary d-inline">Interest</h5>
                                    <div class="row mt-4">
                                        <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                            <a href="javascript:void()" class="interest-cat">
                                                <img src="../../assets/images/profile/2.jpg" alt="" class="img-fluid">
                                                <p>Shopping Mall</p>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                            <a href="javascript:void()" class="interest-cat">
                                                <img src="../../assets/images/profile/3.jpg" alt="" class="img-fluid">
                                                <p>Photography</p>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                            <a href="javascript:void()" class="interest-cat">
                                                <img src="../../assets/images/profile/4.jpg" alt="" class="img-fluid">
                                                <p>Art & Gallery</p>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                            <a href="javascript:void()" class="interest-cat">
                                                <img src="../../assets/images/profile/2.jpg" alt="" class="img-fluid">
                                                <p>Visiting Place</p>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                            <a href="javascript:void()" class="interest-cat">
                                                <img src="../../assets/images/profile/3.jpg" alt="" class="img-fluid">
                                                <p>Shopping</p>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                            <a href="javascript:void()" class="interest-cat">
                                                <img src="../../assets/images/profile/4.jpg" alt="" class="img-fluid">
                                                <p>Biking</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-news mt-4 pb-3 d-none">
                                    <h5 class="text-primary d-inline">Our Latest News</h5>
                                    <div class="media pt-3 pb-3">
                                        <img src="../../assets/images/profile/5.jpg" alt="image" class="mr-3">
                                        <div class="media-body">
                                            <h5 class="m-b-5">John Tomas</h5>
                                            <p>I shared this on my fb wall a few months back, and I thought I'd share it here again because it's such a great read</p>
                                        </div>
                                    </div>
                                    <div class="media pt-3 pb-3">
                                        <img src="../../assets/images/profile/6.jpg" alt="image" class="mr-3">
                                        <div class="media-body">
                                            <h5 class="m-b-5">John Tomas</h5>
                                            <p>I shared this on my fb wall a few months back, and I thought I'd share it here again because it's such a great read</p>
                                        </div>
                                    </div>
                                    <div class="media pt-3 pb-3">
                                        <img src="../../assets/images/profile/7.jpg" alt="image" class="mr-3">
                                        <div class="media-body">
                                            <h5 class="m-b-5">John Tomas</h5>
                                            <p>I shared this on my fb wall a few months back, and I thought I'd share it here again because it's such a great read</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#biodata" data-toggle="tab" class="nav-link active show">Biodata</a>
                                            </li>
                                            <li class="nav-item"><a href="#security" data-toggle="tab" class="nav-link">Security</a>
                                            </li>
                                            <li class="nav-item"><a href="#role" data-toggle="tab" class="nav-link">Role</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="biodata" class="tab-pane fade active show">
                                                <div class="pt-4">
                                                    <div class="settings-form">
                                                        <!-- <h4 class="text-primary">Account Setting</h4> -->
                                                        <form>
                                                            <div class="form-group col-9">
                                                                <label>Nama</label>
                                                                <input type="text" id="nama" placeholder="Nama" class="form-control">
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label>Email</label>
                                                                <input type="text" id="email" placeholder="Email" class="form-control">
                                                            </div>
                                                            <!-- <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Email</label>
                                                                    <input type="email" placeholder="Email" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Password</label>
                                                                    <input type="password" placeholder="Password" class="form-control">
                                                                </div>
                                                            </div> -->
                                                            <div class="form-group col-6">
                                                                <label>No HP</label>
                                                                <input type="text" id="nohp" placeholder="No HP / Whatsapp" class="form-control">
                                                            </div>
                                                            <div class="form-row col-9">
                                                                <div class="form-check mb-4 flex-grow-1">
                                                                    <input id="male" class="" checked  name="radiobuttons" type="radio">
                                                                    <label for="male" class="">Laki-Laki</label>
                                                                </div>
                                                                <div class="form-check mb-4 flex-grow-1">
                                                                    <input id="female" class="" checked  name="radiobuttons" type="radio">
                                                                    <label for="female" class="">Perempuan</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label class="text-label">Tgl Lahir</label>
                                                                <input id="tgl_lahir" class="form-control input-daterange-datepicker" type="text" name="tgl_lahir">
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="gridCheck">
                                                                    <label for="gridCheck" class="form-check-label">Check me out</label>
                                                                </div>
                                                            </div> -->
                                                            <button class="btn btn-primary" type="submit">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="security" class="tab-pane fade">
                                                <div class="update-password pt-4">
                                                    <form>
                                                        <div class="form-group col-6">
                                                            <label>Password Lama</label>
                                                            <input type="password" id="password_lama" placeholder="Password Lama" class="form-control">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Password Baru</label>
                                                            <input type="password" id="password_baru" placeholder="Password Baru" class="form-control">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Konfirmasi Password Baru</label>
                                                            <input type="password" id="password_baru_konfirmasi" placeholder="Konfirmasi Password Baru" class="form-control">
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Update</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div id="role" class="tab-pane fade">
                                                <div class="update-password pt-4">
                                                    <form>
                                                        <div class="form-group col-6">
                                                            <label>Unitupi Lama</label>
                                                            <input type="text" id="unitupi_lama" placeholder="Unitupi Lama" readonly class="form-control">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Unitap Lama</label>
                                                            <input type="text" id="unitap_lama" placeholder="Unitap Lama" readonly class="form-control">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Unitup Lama</label>
                                                            <input type="text" id="unitup_lama" placeholder="Unitup Lama" readonly class="form-control">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label>Jabatan Lama</label>
                                                            <input type="text" id="jabatan_lama" placeholder="Jabatan Lama" readonly class="form-control">
                                                        </div>
                                                        <hr/>

                                                        <div class="form-group col-6">
                                                            <label>Unitupi baru</label>
                                                            <input type="text" id="unitupi_baru" placeholder="Unitupi baru" class="form-control">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Unitap baru</label>
                                                            <input type="text" id="unitap_baru" placeholder="Unitap baru" class="form-control">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Unitup baru</label>
                                                            <input type="text" id="unitup_baru" placeholder="Unitup baru" class="form-control">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label>Jabatan baru</label>
                                                            <input type="text" id="jabatan_baru" placeholder="Jabatan baru" class="form-control">
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>

    <?php include 'parts/footer.php'; ?>

    
    <script src="../../assets/plugins/moment/moment.min.js"></script>
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

    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../../assets/plugins/password-strength-meter/dist/password.min.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <script src="../js/pages/profile.js"></script>

</body>
</html>
<?php session_start() ?>
<?php if(!empty($_SESSION['username'])): ?>
    <?php header("location: index.php"); ?>
<?php endif; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office | Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../css/login.css?time=15">
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter bg-image">
            <!-- The image half -->
            <div class="col-md-9 d-none d-md-flex"></div>


            <!-- The content half -->
            <div class="col-md-3 bg-transparent2">
                <div class="login d-flex align-items-center py-5">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12 mx-auto">
                                <h3 class="display-5">ROC (Report Online Commerce)</h3>
                                <p class="text-muted mb-4"><small>Back Office untuk mengelola hasil pekerjaan pendukung pada Bidang Niaga dan Manajemen Pelanggan</small></p>
                                <form>
                                    <div class="form-group mb-3">
                                        <input id="xusername" type="text" placeholder="Username" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="xpassword" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                        <label for="customCheck1" class="custom-control-label">Remember password</label>
                                    </div>
                                    <button type="button" id="btn_login" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                                    <div class="text-center d-flex justify-content-between mt-4">
                                        <small>*untuk internal PLN, silahkan menggunakan username login email korporat (tanpa pusat)</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- End -->

                </div>
            </div><!-- End -->

        </div>
    </div>
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap4-notify/bootstrap-notify.min.js"></script>
    <script src="../js/pages/apps.js?time=4"></script>
    <script src="../js/pages/login.js?time=2"></script>

</body>

</html>
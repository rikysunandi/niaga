<?php session_start() ?>
<?php if(!empty($_SESSION['username'])): ?>
    <?php header("location: index.php"); ?>
<?php endif; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROC Jabar | Halaman Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/plugins/MotionCAPTCHA/jquery.motionCaptcha.0.2.css">
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
                        <div id="login-form" class="row">
                            <div class="col-lg-12 col-xl-12 mx-auto">
                                <h3 class="display-5">ROC (Report Online Commerce)</h3>
                                <p class="text-muted mb-4"><small>Back Office untuk mengelola hasil pekerjaan pendukung Bidang Niaga dan Manajemen Pelanggan</small></p>
                                <form>
                                    <div class="form-group mb-3">
                                        <input id="xusername" type="text" placeholder="Username" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="xpassword" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                    </div>
                                    <div class="form-group mb-3">
                                        <img src="../controller/captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>
                                        <!-- <button id="btn_cari" type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light"> -->
                                            <span class="btn btn-outline waves-light btn-icon-right" data-toggle="tooltip" data-original-title="Refresh Captcha">
                                            <i id="refresh_captcha" class="fa fa-refresh text-primary" aria-hidden="true" title="Refresh Captcha"></i></span>
                                        <!-- </button> -->
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="text" id="captcha" name="captcha" placeholder="Captcha" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary"/>
                                    </div>
                                    <!-- <p>Can't read the image?
                                    <a href='#' id="refresh_captcha">click here</a>
                                    to refresh</p> -->
<!-- 
                                     <div id="mc">
                                         <p>Please draw the shape in the box to submit the form:</p>
                                         <canvas id="mc-canvas"></canvas>
                                     </div> -->
                                    <!-- 
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                        <label for="customCheck1" class="custom-control-label">Remember password</label>
                                    </div>
 -->
                                    <button type="button" id="btn_login" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                                    <div class="text-center text-info d-flex justify-content-between mt-4 mb-4">
                                        <small>*untuk internal PLN, silahkan menggunakan username login email korporat (tanpa pusat)</small>
                                    </div>
                                    <div class="mt-4 float-right">
                                        <a href="https://forms.gle/JBRkgumCz1p8kSi86" target="_blank" class="btn btn-link" ><small>Daftar atau Update User</small></a>
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
    <script src="../../assets/plugins/MotionCAPTCHA/jquery.motionCaptcha.0.2.js"></script>
    <script src="../../assets/plugins/bootstrap4-notify/bootstrap-notify.min.js"></script>
    <script src="../js/pages/apps.js?time=6"></script>
    <script src="../js/pages/login.js?time=6"></script>

</body>

</html>
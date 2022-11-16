<?php include 'parts/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga | 4DX</title>
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
                        <h4>Report Progress Survey Kompor</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Kompor Induksi</a>
                            </li>
                            <li class="breadcrumb-item active">Report Progress Survey Kompor Induksi</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h4 class="card-title">Report </h4>
                            </div> -->
                            <div class="card-body">
								<!-- 21:9 aspect ratio -->
								<!-- <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vRJ80TE1ve0Z4lKybYzL-f4BK5Zmj5kdxMCT-Wzg0chGiXxzFvoBIMLTaPpP5GCeDseE_-w8WF9kdUG/pubhtml?gid=1486950832&amp;single=true&amp;widget=true&amp;headers=false"></iframe> -->
                                <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vRJ80TE1ve0Z4lKybYzL-f4BK5Zmj5kdxMCT-Wzg0chGiXxzFvoBIMLTaPpP5GCeDseE_-w8WF9kdUG/pubhtml?gid=1486950832&amp;single=true&amp;widget=true&amp;headers=false"></iframe>
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
        <!-- <div id="confirm_modal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah anda yakin akan menghapus koordinat dari Map?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Ya</button>
              </div>
            </div>
          </div>
        </div> -->
        

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

    
    <script src="../js/pages/apps.js?time=5"></script>

</body>
</html>
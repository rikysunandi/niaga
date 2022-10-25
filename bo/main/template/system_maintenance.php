

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga | Pemeliharaan</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    
    <style type="text/css">
        .chart-card{
            height: 17rem;
        }

        #dapot_jenis_transaksi .card{
            cursor: pointer;
        }
        #dapot .card{
            cursor: pointer;
        }
        #dapot_jenis_transaksi .card:hover {
          box-shadow: 0 12px 12px 0 rgba(0, 0, 0,.24);
          transform: translateY(-4px);
        }
        #dapot .card:hover {
          box-shadow: 0 12px 12px 0 rgba(0, 0, 0,.24);
          transform: translateY(-4px);
        }


        #overview_daftung .card{
            cursor: pointer;
        }

        #overview_daftung .card:hover {
          box-shadow: 0 12px 12px 0 rgba(0, 0, 0,.24);
          transform: translateY(-4px);
        }

        #agenda_terlama .card tr{
            cursor: pointer;
        }

        #agenda_terlama .card tr:hover {
          box-shadow: 0 12px 12px 0 rgba(0, 0, 0,.24);
          transform: translateY(-4px);
        }


    </style>
</head>

<body>
    
    <?php include 'parts/preloader.php'; ?>
    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <div class="row">
            <div class="col-xl-12">
                <div class="card forms-card">
                    <div class="card-body">
                    <!-- <h4 class="card-title mb-4">Pemeliharaan</h4> -->
                        <h4 class="text-info text-center">Saat ini aplikasi ROC hanya bisa diakses melalui alamat intranet di <a href="http://10.2.1.58/niaga">sini</a></h4>
                        <img src="../../assets/images/maintenance.svg" style="width:100%;" />
                    </div>
                </div>
            </div>
        </div>

        
        

    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
</body>
</html>
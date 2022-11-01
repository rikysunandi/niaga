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
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.bootstrap4.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
    
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">

    <style type="text/css">
        .image_gallery {
          background: #f4f4f4;
        }

        .banner {
          background: #a770ef;
          background: -webkit-linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
          background: linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
        }

        .foto-cater{
            cursor: pointer;
        }

        .foto-cater.selected{
            
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
                        <h4>Sampling Foto Baca Meter</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pendukung Baca Meter</a>
                            </li>
                            <li class="breadcrumb-item active">Sampling Foto Baca Meter</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    
                    <div class="col-xl-12">
                        <div class="card forms-card">
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Cari Agenda</h4> -->
                                <div>
                                    <form class="row">
                                        <div class="form-group mb-4 col-3 mr-2">
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text">BLTH</span>
                                              </div>
                                                <input id="blth" class="form-control" type="text" name="blth">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center col-7">
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text">Daftar Idpel</span>
                                              </div>
                                              <textarea id="daftar_idpel" class="form-control" aria-label="With textarea" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-right">
                                        <button id="btn_cari" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Cari <span class="btn-icon-right"><i
                                        class="fa fa-search"></i></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-xl-12">
                        <div class="card forms-card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Foto Baca Meter</h4>
                                <div class="row image_gallery pt-4">
      <!-- Gallery item -->
                                  <!-- End -->



                                </div>


                              <div class="foto-cater col-xl-2 col-lg-3 col-md-4 mb-4" style="display:none;">
                                <div class="bg-white rounded shadow-sm"><img src="https://via.placeholder.com/150" alt="" class="img-fluid card-img-top">
                                  <div class="p-4">
                                    <h6> <span class="text-dark">Idpel</span></h6>
                                    <p class="small text-muted mb-0">Stand: </p>
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

    <?php include 'parts/footer.php'; ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src='https://unpkg.com/tesseract.js@v2.1.0/dist/tesseract.min.js'></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>

    <script src="../js/pages/apps.js"></script>
    <!-- <script src="../js/pages/sampling-foto-cater.js"></script> -->

    <script type="text/javascript">
        
        $(document).ready(function () {

            "use strict";

            $('#btn_cari').click(function(){
                var blth = $('#blth').val();
                var daftar_idpel = $('#daftar_idpel').val().split(/\n/);
                var $div;
                var image_url;
                $('.image_gallery').empty();
                $.each(daftar_idpel, function(i, idpel){
                    if(idpel){
                        $div = $('.foto-cater:first').clone();

                        image_url = 'https://10.72.35.8/acmt/DisplayBlobServlet1?idpel='+idpel+'&blth='+blth;
                        $div.find("img").attr('src', image_url);
                        $div.find(".text-dark").html(idpel);
                        $div.show();

                        $('.image_gallery').append($div);

                        // let tesseractSettings = {
                        //     lang: 'ind',
                        // };
                        // var teks, valid;

                        // Tesseract.recognize(image_url).then(function(result){

                        //     console.log('result', result);
                        //     teks = result.data.text;

                        //     $div.find(".text-muted").html('HASIL OCR '+idpel+': '+teks);
                        //     $div.show();

                        //     $('.image_gallery').append($div);

                        // }).finally(function(){
                            
                        // });

                    } else {
                        console.log('lewat');
                    }
                });

                $('.img-fluid').Lazy({
                    // your configuration goes here
                    scrollDirection: 'vertical',
                    effect: 'fadeIn',
                    visibleOnly: true,
                    onError: function(element) {
                        console.log('error loading ' + element.data('src'));
                    }
                });
                //$div = $('.foto-cater:first').remove();

            });

        });
    </script>
</body>
</html>
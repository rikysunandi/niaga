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
    <link rel="stylesheet" href="../../assets/plugins/image-picker/image-picker.css">
    
    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">

    <style type="text/css">
        ul.thumbnails{
            height: 420px;
        }
        div.img-foto{
            width: 160px;
            height: 180px;
        }
        img.img-foto{
            width: 140px;
            height: 150px;
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
                                                <input id="blth" class="form-control" type="text" name="blth" value="<?php echo date('Ym') ?>">
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
                        <div class="card foto-cater">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Foto Baca Meter</h4>
                                <div class="info mb-4">
                                    *Jika foto tidak tampil, silahkan klik kanan pada salah satu foto, lalu pilih open image in new tab / view image, setelah itu di tab yang baru pilih process (unsafe) atau "i understand the risk" sehingga muncul foto, kembali ke menu sampling foto lalu refresh.<br/>
                                </div>

                                <option class="foto" data-img-class="img-foto" style="display: none;" data-img-src="https://via.placeholder.com/150" value="1">Idpel</option>

                                <select multiple="multiple" class="image_gallery image-picker show-html" style="display:none;">
                                </select>
                                
                            </div>
                            <div class="card-footer text-center"> 
                                <div class="text-center float-left">
                                    <!-- parent element for pagination menu list -->
                                    <ul class="pagination custom-pagination"></ul>

                                    <!-- prepare necessary element attributes to pass parameters for pagination -->
                                    <input type="hidden" id="itemCount" value="">
                                    <input type="hidden" id="pageLimit" value="100">
                                </div>
                                <!-- <span class="counter mt-4">0</span> foto dipilih -->
                                <button class="btn btn-primary btn-sm float-right mr-2"
                                        disabled="disabled" id="btn_update" style="color:white"> 
                                    Foto Tidak Valid
                                </button> 
                                <button class="btn btn-warning btn-sm float-right mr-2"
                                        disabled="disabled" id="btn_clear" style="color:white"> 
                                    Clear All
                                </button> 
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

    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src='https://unpkg.com/tesseract.js@v2.1.0/dist/tesseract.min.js'></script>
    <script src="../../assets/plugins/image-picker/image-picker.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script src="../../assets/plugins/pagination/pagination.min.js"></script>

    <script src="../js/pages/apps.js?time=5"></script>
    <!-- <script src="../js/pages/sampling-foto-cater.js"></script> -->

    <script type="text/javascript">
        
        $(document).ready(function () {

            "use strict";
            $('#btn_clear').attr('disabled','disabled');
            $('#btn_update').attr('disabled','disabled');

            var jml_item_per_page = 500;
            var current_page = 1;
            var selected = new Array();

            function paginate(array, page_size, page_number) {
              // human-readable page numbers usually start with 1, so we reduce 1 in the first argument
              return array.slice((page_number - 1) * page_size, page_number * page_size);
            }

            function countSelected(selected){
                var count=0;
                $(selected).each(function(i, v){
                    if (typeof v === "undefined") {console.log('skip');}else{
                        count += v.length;
                        console.log('count', count);
                    }
                });
                return count;
            }

            function loadFoto(page){
                $('div.foto-cater').block({ message: 'Mencari data...' });
                $('.image_gallery').empty();

                console.log('selected', selected);
                $('#btn_update').html(countSelected(selected)+" Foto Tidak Valid");
                console.log('countSelected', countSelected(selected));
                if(countSelected(selected)>0){
                    $('#btn_clear').removeAttr('disabled');
                    $('#btn_update').removeAttr('disabled');
                }else{
                    $('#btn_clear').attr('disabled','disabled');
                    $('#btn_update').attr('disabled','disabled');
                }

                var blth = $('#blth').val();
                var daftar_idpel = $('#daftar_idpel').val().split(/\n/);
                var $div;
                var image_url;
                $.each(paginate(daftar_idpel, jml_item_per_page, page), function(i, idpel){
                    if(idpel){
                        $div = $('option.foto:first').clone();

                        image_url = 'https://10.72.35.8/acmt/DisplayBlobServlet1?idpel='+idpel+'&blth='+blth;
                        $div.data('img-src', image_url);
                        $div.attr('value', idpel);
                        $div.html(idpel);
                        // $div.find(".text-dark").html(idpel);
                        $div.show();

                        $('.image_gallery').append($div);

                    } else {
                        console.log('lewat');
                    }
                });

                $('img.img-foto').Lazy();

                $("select").imagepicker({
                  hide_select : true,
                  show_label  : true,
                  clicked: function(select, option, event){
                    // console.log('select', select);
                    // console.log('option', option);
                    var values = this.val();
                    selected[page] = values;
                    console.log('selected', selected);

                    if(countSelected(selected)>0){
                        $('#btn_clear').removeAttr('disabled');
                        $('#btn_update').removeAttr('disabled');
                    }else{
                        $('#btn_clear').attr('disabled','disabled');
                        $('#btn_update').attr('disabled','disabled');
                    }

                    $('#btn_update').html(countSelected(selected)+" Foto Tidak Valid");
                  }
                });

                $("select").val(selected[page]);
                $("select").data('picker').sync_picker_with_select();

                $('div.foto-cater').unblock();
            }



            $('#btn_cari').click(function(){

                $('.image_gallery').show();
                loadFoto(current_page);
                var daftar_idpel = $('#daftar_idpel').val().split(/\n/);

                setTimeout(function () {
                    $('.custom-pagination').rpmPagination({
                        limit: jml_item_per_page,
                        total: daftar_idpel.length,
                        domElement: 'li.img-foto',
                        currentPage: 1
                    });

                    current_page = 1;
                }, 100);


                var gotoTag = $("div.foto-cater");
                $('html,body').animate({scrollTop: gotoTag.offset().top},'slow');
                //$div = $('.foto-cater:first').remove();



            });

            $( ".custom-pagination" ).on( "click", "li", function() {
                var page = $( this ).text();
                if(current_page != page){
                    loadFoto( page );
                    current_page = page;
                }
            });

            $('#btn_clear').click(function(){
                console.log('clear!');
                selected = new Array();
                $('.selected').each(function(){ this.click() });
                $("select").data('picker').sync_picker_with_select();
            });

            // $('#btn_update').click(function(){
                
            //     selected = new Array();
            //     $('.selected').each(function(){ this.click() });
            //     $("select").data('picker').sync_picker_with_select();
            // });

        });
    </script>
</body>
</html>
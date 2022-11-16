<?php include 'parts/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga</title>
    <!-- Favicon icon -->
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
                        <h4>Dashboard Saldo TS P2TL</h4>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Peta Rata-Rata Saldo Tunggakan</h4>
                            </div>
                            <div class="card-body">
                                <?xml version="1.0" encoding="utf-8"?>
                                <!-- Generator: Adobe Illustrator 21.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 821 658" width="80%" height="80%" style="enable-background:new 0 0 821 658;" xml:space="preserve">
                                <style type="text/css">
                                    .st0{enable-background:new    ;}
                                    .st1{fill:#549CE4;}
                                    .st2{fill:#9886B6;}
                                    .st3{fill:#DED56E;}
                                    .st4{fill:#5B7876;}
                                    .st5{fill:#8A765B;}
                                    .st6{fill:#B8CEDB;}
                                    .st7{fill:#FDD100;}
                                    .st8{fill:#F3B3B3;}
                                    .st9{fill:#A0D9F6;}
                                    .st10{fill:#009B4D;}
                                    .st11{fill:#F4B194;}
                                    .st12{fill:#7889A5;}
                                    .st13{fill:#F1D1FF;}
                                </style>
                                <g id="Rectangle_17_1_" class="st0">
                                    <g id="53CKG">
                                        <g>
                                            <path class="st1" d="M282,146c-3.9-4.9-21.2-2.2-28-3c-4.7,4.4-17,8.1-21,17c-1.6,4.1,0.1,6.7,1,11c14.7,4.1,29.7,8.6,44,11
                                                C281.4,174.7,287.5,152.3,282,146z" data-toggle="tooltip" data-placement="top" title="UP3 Cikarang"/>
                                        </g>
                                    </g>
                                    <path class="st1" d="M727,591"/>
                                </g>
                                <g id="Rectangle_16_1_" class="st0">
                                    <g id="53DPK">
                                        <g>
                                            <path class="st2" d="M168,166c-13,3.4-19.1,4.2-35,4c1.3,6.3,2.7,12.7,4,19c4.5,3.4,11.6-0.7,17,5c5-2.7,10-5.3,15-8
                                                c0.3,1.3,0.7,2.7,1,4c10.2-0.8,8.7-8.3,14-10C182.7,170.4,173.6,171,168,166z" data-toggle="tooltip" data-placement="top" title="UP3 Depok"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_15_1_" class="st0">
                                    <g id="53GPI">
                                        <g>
                                            <path class="st3" d="M276,236c-2.6-13.6-11-20.4-11-35c-21.6-8.8-39.3-24.4-60-36c-2.7,3.3-5.3,6.7-8,10c0.9,12.4,9.8,18.7,11,27
                                                c-1,6-2,12-3,18c3.4,10.4,10,15.6,10,32c20.5,0.1,54.9,4.2,64-11c1-2,2-4,3-6v-1C280,234.7,278,235.3,276,236z" data-toggle="tooltip" data-placement="top" title="UP3 Gunung Putri"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_14_1_" class="st0">
                                    <g id="53BKS">
                                        <g>
                                            <path class="st4" d="M291.4,85.8c-2.9,0.1-4.3-3.2-21.4-7.2s-13.2-6.7-17.9-10.5C238,56.7,228.1,45.6,244,34v-1
                                                c-8.9-2.3-17.7-4.3-27-5c2.7,10.8-1.2,20.4-1,28c-0.2,4.7,2.4,6.5,9,7c0.3,1.3,0.7,2.7,1,4c-6.6,3.9-6.5,10.1-16,11
                                                c3.5,32.2-2.5,46.6-19,61c5.9,11.5,1.7,23-2,35v1c1.7,0.3,3.3,0.7,5,1c6.5-7.8,7.3-20.2,11-32c0.7-0.3,1.3-0.7,2-1h1
                                                c0.3,7.7,0.7,15.3,1,23c20.6,11.1,37.2,21,58,33l10-5c-0.3-2.3-0.7-4.7-1-7c-9.1-5.8-19.4-9.4-39-9c-2.7-3.3-5.3-6.7-8-10v-9
                                                c19.2-16,27.9-17.3,52-21c11.5,14.9,12.4-20.4,16-16c2-2,4-4,3.5-11C301.9,99,299.4,85.6,291.4,85.8z" data-toggle="tooltip" data-placement="top" title="UP3 Bekasi"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_13_1_" class="st0">
                                    <g id="53BGR">
                                        <g>
                                            <path class="st5" d="M194,179h-4c-6,5.7-12,11.3-18,17h-4c-0.6-5.5,0.5-4.3-4-6c-4.3,7.6-18.4,2.5-30,2c-0.1-9-2-18.6-6-24
                                                c-4.9-5-31.7-2.3-40,0c-1.7-2.7-3.3-5.3-5-8c-12.8,0.9-12.2,5.3-26,4c-0.3-3.3-0.7-6.7-1-10c-1-0.3-2-0.7-3-1
                                                c-4.5,2.6-5.9,5-8,10c5,12.3,6.9,15.8,3,29c-3,1.5-5.7,2.1-11,2c-1,5.3-2,10.7-3,16l10,20v32c8.3,7,16.7,14,25,21
                                                c7-1.4,10.9-5.8,14-11c7.8,1.6,6.4,6.3,13,8c18.4,4.6,29.6-8.8,42-11c11,13.9,25.4,13.3,43,21c14.4-0.1,14.3-6.1,24-10
                                                C221.8,249.5,200.7,207.3,194,179z" data-toggle="tooltip" data-placement="top" title="UP3 Bogor"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_12_1_" class="st0">
                                    <g id="53SKI">
                                        <g>
                                            <path class="st6" d="M230,342c-8.1-21.7-19.4-35.9-28-55c-17.9,8.3-53.7,6.4-65-14c-15.4,4.3-37.2,19.8-52,3
                                                c-6,5.3-12,10.7-18,16c-2,0.3-4,0.7-6,1v5c-5,2-10,4-15,6c-6.5,14.1-9.6,24.2-15,36c1,1.7,2,3.3,3,5c16.7-7,49.6,4.3,43,29
                                                c-3,11.4-20.2,21.9-29,28c1,5,2,10,3,15c-5.6,3.7-7.7,3.5-17,3c-17.1,25.2-2.6,28.5-1,51c17.5-5.8,26,9.8,40,14
                                                c24.7,2.3,49.3,4.7,74,7c0.3-0.7,0.7-1.3,1-2c-2.8-3.3-4-3-3-8c7-11.8,43.2-26.7,58-31c1.8-8.5-5.6-14.3,3-19
                                                c-1.9-24.8-25.9-58.9,6-72c4.8,3.5,9.5,5.7,16,8c0.7-0.3,1.3-0.7,2-1c-2-4-4-8-6-12C224.6,347.7,226.7,346.1,230,342z" data-toggle="tooltip" data-placement="top" title="UP3 Sukabumi"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_11_1_" class="st0">
                                    <g id="53CJR">
                                        <g>
                                            <path class="st6" d="M359,437c-14.6,3.6-35,2.8-36-13c-9.7-1.4-19.7,0.4-29-2l-1-2c4.2-9.7,11-19.8,19-26c-0.7-2.7-1.3-5.3-2-8
                                                c-11.9-2.5-15.8-10.2-20-11c-6.2-1.2-10.4,2.7-16,1c-0.7-8-1.3-16-2-24c8.4-10.4,34.1-24.5,47-30c0.3-2.3,0.7-4.7,1-7
                                                c-15.6-5.8-13.2-36.7-33-45c2.7-7.3,5.3-14.7,8-22c-3.3-2.7-6.7-5.3-10-8c-15.1,23.3-40.8,12.4-71,16c1.3,3.9,1.9,3.4,4,6
                                                c-4.7,6.5-8.4,16.5-13,23c13.2,22.3,24.1,46.1,36,71c-3.7-3-7.3-6-11-9l-1,1c-1.4,8.6,2.5,11.6,6,18c-2,1.7-4,3.3-6,5
                                                c-8.6-0.6-13.7-3.3-19-7c-7.8,7.5-9.7,17.8-13,30c13.9,14.7,10.2,36.7,11,56c-6.4,6.4-21,15.2-30,18c-5.7,0.7-11.3,1.3-17,2
                                                c-4.9,3.5-4,9.1-11,12c-0.7,1-1.3,2-2,3c4.9,1.3,5.7,2.1,7,7c22.7,1.3,45.3,2.7,68,4c40.5,6.6,79.9,11.5,119,18h1
                                                c1.6-15.4-1-27.7,15-32c3.2-20.4-2.5-17.1-4-30L359,437z" data-toggle="tooltip" data-placement="top" title="UP3 Cianjur"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_10_1_" class="st0">
                                    <g id="53CMI">
                                        <g>
                                            <path class="st7" d="M435.5,301.4c-3.6-5.6-13.2-3.7-14.5-7.6c-1.9-5.6-18.7-7.8-21-11.7c-4.2,0.4-3.9-0.1-6,2
                                                c-2.9,3.5-3.3,9.3-3,16c-21.6-9.6-29.8-30.4-61-30c-3.8,10.9-15.5,25.7-13,36c3.9,9.1,7,7,5,20c-15.4,3.4-32.3,19.4-46,26
                                                c0.9,6.4,2.9,12.2,1,19c9.8,5.9,18.4-3.4,24,11c13.7-0.7,27.3-1.3,41-2l4-12c17-2.1,15.8-3.5,23-16c7.3-3.3,0.7-39.2,18-46
                                                c3.3,2.2,4.4,2.8,6,7c6.6-1.5,9.7-2.3,17-3c0.5,4,0.6,3.7,2,6c11.1-2.1,14.5-3.8,28-3c0.3-3,0.7-6,1-9
                                                C439.9,303,439.1,307,435.5,301.4z" data-toggle="tooltip" data-placement="top" title="UP3 Cimahi"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_9_1_" class="st0">
                                    <g id="53BDG">
                                        <g>
                                            <path class="st8" d="M421,329c-3.5-2.6-2.3-7.8-5-11c-4.3-4.3-24.9-4.7-30-7c-4.4,4.2-9.5,15.6-10,23c7.7-0.4,9.6,0.1,12,5
                                                c1.8,1.8,2.7,5,3,10c15.7,0.5,32.5,0.7,44-4c1.3-4.7,2.7-9.3,4-14C431.4,332.1,427.3,333.6,421,329z" data-toggle="tooltip" data-placement="top" title="UP3 Bandung"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_8_1_" class="st0">
                                    <g id="53MJA">
                                        <g>
                                            <path class="st8" d="M489,349c-17,2.6-29.6,0.2-42-5c-1.5-7.1-1.1-19.3-5.7-21c-4.5-1.6-0.9-3.4-1.3-5c-3.3-0.7-6.7-1.3-10-2
                                                c-7.2-0.1-10,1-13,5c6.2,8.3,11.4,5.6,24,5c0.9,5.9-0.5,9.9-1,18c-11.9,10.1-50.2,16.8-56-6h-5l-1,1c1.3,4.3,2.7,8.7,4,13
                                                c-4.7,2.7-9.3,5.3-14,8c-0.7,4-1.3,8-2,12h-17c-0.7,3.3-1.3,6.7-2,10c-4.6,6.1-23.7,4.2-33,5c1.6,8.5-7.7,24.7-16,29
                                                c4.9,9.3,17.3-1.8,26,4c4.7,3.2,4.8,11.2,11,14c23.2,10.6,59.3-15.3,68,17c7.2-0.3,10.4-2.2,13-7c5.7,1.7,11.3,3.3,17,5h3
                                                c1.3-3,0-1.2,2-3c-0.8-7-3.6-8.8-7-13c2.5-15.6,11.6-27.7,29-29c2.4-4.8,1.6-11.2,3-16c7.6-9.5,16.2-16.4,34-16
                                                C492.9,366.4,489.1,355.3,489,349z" data-toggle="tooltip" data-placement="top" title="UP3 Majalaya"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_7_1_" class="st0">
                                    <g id="53GRT">
                                        <g>
                                            <path class="st8" d="M548,360c-8.6-1.2-14.5,1.7-26-2c-9.5-3.1-10-10.2-25-11c-1.3,1-2.7,2-4,3c1.5,5.3,3.1,7.9,3,16
                                                c2,0.3,4,0.7,6,1c0.3,2.3,0.7,4.7,1,7c-6,2.9-16.8,0.8-24,4c-4,3.7-8,7.3-12,11c-0.3,4.7-0.7,9.3-1,14c-9.1,6.8-34.1,12.6-31,30
                                                c2.7,2.3,5.3,4.7,8,7c-1.7,4.7-3.3,9.3-5,14c-7-1.7-14-3.3-21-5c-3.3,2.3-6.7,4.7-10,7h-6c-2.2-1.5-2.7-9-5-11
                                                c-9.5-8.2-22.7-3.7-34-4l-4,8c3.4,13.9,6,18,4,35c-3.7,2-7.3,4-11,6c-1.7,4.7-3.3,9.3-5,14c9.6,32.9,71.3,21.2,80,57
                                                c14.6,4.4,30.7,8.5,45,13c1.6,3.6,1.3,3.2,1,8c1,0.7,2,1.3,3,2c4.7,0.3,9.3,0.7,14,1c3-4.3,6-8.7,9-13c-1.3-10-2.7-20-4-30
                                                c2-12.3,13.1-33.6,8-52c-2.7-9.7-12.2-11.8-15-21c4-3.3,8-6.7,12-10c-2.6-5.1-3.7-7.6-3-14c14.6-7,25.9-19.5,44-21
                                                c4-10.6,5-16.3,1-26c4.9-5.7,7.1-9.9,18-10c0.6-6.3,2-7.6,5-11C558.4,370.2,551.3,369.9,548,360z" data-toggle="tooltip" data-placement="top" title="UP3 Garut"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_6_1_" class="st0">
                                    <g id="53TSK">
                                        <g>
                                            <path class="st9" d="M746,548c0.9-7.1,8.2-12,5-21c-3.7-10.3-16.1-21.8-10-34c-6.9-5.7-11.8-13.5-15-23c-7.1-3.2-12.8,1.9-21,0
                                                c-6.7-1.5-7.6-5.5-15-9c2.3-13.6,7.5-24.9,9-36c-6.3-3.7-12.7-7.3-19-11c-1-3.7-2-7.3-3-11h-2c-4.3-3.6-12.8-1-19-5
                                                c-8.1-5.2-14-13.9-23-19c-11,6.1-31.1,1.4-45,0v1c3.3,2.3,6.7,4.7,10,7c-10-3-20-6-30-9c-2.7,4.6-3.5,8.6-6,15v2c-3-1-6-2-9-3
                                                c-2.7,2.3-5.3,4.7-8,7c4.3,7.8,3.4,18.2-2,27c-0.4,0.4-41.6,20.7-43,21c-0.9,5.4,1.6,8.2,4,13c-4.4,3.6-5.6,7-12,9
                                                c0.9,5.7,11.7,12.5,14,22c4.5,18.8-5.4,43.4-8,51c-4.8,13.9,6.5,26.8-2,39v3c16.4-1,30.8,6.9,44,11c30.3,5.3,60.7,10.7,91,16
                                                c5-0.7,10-1.3,15-2c3,1,6,2,9,3c6-3.7,12-7.3,18-11c1.3-6-1-13.2,1-19c8.3-17.9,63.1-13.4,81-9c3-1.3,6-2.7,9-4v-1
                                                C754.9,562.2,751.4,557.4,746,548z" data-toggle="tooltip" data-placement="top" title="UP3 Tasikmalaya"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_5_1_" class="st0">
                                    <g id="53CRB">
                                        <g>
                                            <path class="st10" d="M774,303v-6c-13.2,5.3-18.5,6.6-37,6c-3.9-4.5-7.7-14.3-16-14c-3.7,0.3-7.3,0.7-11,1c-5.5-2.2-3.3-6.9-12-8
                                                c1.7-14.4-14.1-43-14-70h-4c-4.8,10.5-9.3,13.2-21,17c0.2-6.5-0.2-12.5-3-16c-17.2,1.6-42.1,24.1-29,43c3,2,6,4,9,6
                                                c3.2,8.3-1.2,18.3,4,24c2,0.7,4,1.3,6,2c2.6,4.2,2.9,21.2,4,26c5.1,22.2-11.7,39.3-5,64c-1.8,18.1,27,13.6,35,22
                                                c6.5,6.9,0.4,13.1,12,16c1.1-26.1,30-15.1,46-17c1.3-3,2.7-6,4-9c5.3-0.7,10.7-1.3,16-2c0.1-8.3,1.4-19.8,5-25l-7-7
                                                c-3.6-3.8-4.2-20.5-4-27C759,319.5,768,314,774,303z" data-toggle="tooltip" data-placement="top" title="UP3 Cirebon"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_4_1_" class="st0">
                                    <g id="53SMD">
                                        <g>
                                            <path class="st11" d="M615,242h-11v-8c-5-1.7-10-3.3-15-5c-2.3,4.3-4.7,8.7-7,13c-5.3-1.3-10.7-2.7-16-4v-10h-14
                                                c-6,8.1-17.8,17.4-20,28c-20.9-4-29.7-19.3-51-25c-9,19.8-0.4,54.1-16,67c-3.7,3.2-12.1,0.8-17,3c-3.9,2.9-3.4,11.7-5,17
                                                c4.5,4,9,10.6,6,19c10.5,20.3,34.9,1.2,52,5c18.9,4.2,25.7,15.9,47,12c9.9,20.4,19.6,15.8,44,21c4.7,1,9.3,2,14,3
                                                c9.7-2.4,23.8-8,33-4v-26c2.3-7.3,4.7-14.7,7-22C650.9,300.9,626.1,255.9,615,242z" data-toggle="tooltip" data-placement="top" title="UP3 Sumedang"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_3_1_" class="st0">
                                    <g id="53IDM">
                                        <g>
                                            <path class="st12" d="M655,181c-17.3-12.5-25.3-40.2-41-55c-15.4,1.2-20.7,4.3-32,10c-0.7,1-1.3,2-2,3c1.7,1.3,3.3,2.7,5,4
                                                c-23.2,26.9-60.6-9.7-84-15c0.3,12.7,0.7,25.3,1,38c-3.1,7.5-7.9,10.9-8,25c2.9,2.4,3.5,3.6,8,5c0.7,16.5-2.2,27.9-18,30
                                                c2.9,2.9,8.1,1.9,12,4c10.2,5.6,21.3,14.3,32,21c8-8.2,18.8-34.9,38-27c3.7,2.3,4.1,5.1,4,11c2.7,0.7,5.3,1.3,8,2
                                                c2.3-3.7,4.7-7.3,7-11c7-3.8,11.6,2.5,22,4c0.3,2.3,0.7,4.7,1,7c4,0.7,8,1.3,12,2c3.3-11.4,22.9-35.7,39-29c3.9,2.5,4.3,6.4,4,13
                                                h1c9.2-4.3,9.3-12.7,19-16c0.7-1,1.3-2,2-3C682.6,193.7,662.9,186.7,655,181z" data-toggle="tooltip" data-placement="top" title="UP3 Indramayu"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_2_1_" class="st0">
                                    <g id="53KRW">
                                        <g>
                                            <path class="st12" d="M364,94c-17.8-11.2-20-42.5-37-55c-23.9-17.6-44.5,7.2-59,3c-11.2-3.2-14.8-15.1-28-16c1.9,2.6,2.4,2.9,6,4
                                                c0.2,4.6,0.3,5.3-2,9c0,0.7,0,1.3,0,2c-0.3-0.7-0.7-1.3-1-2c-5.8,3.9-3.7,9.3-2,16c10.4,0.5,14.2,12.2,19,18
                                                c6.7,6.6,24.4,9.3,37,11c12.4,19.6-3.8,46.1-11,66c-1.6,4.4,0.7,23.6-2,28c-2.2,3.2-1.7,2.7-7,3c1.7,3,3.3,6,5,9c0,1.3,0,2.7,0,4
                                                c-1.7-1-3.3-2-5-3c-2.4,1.1-3.4,1.2-5,3c-0.6,0.4-6.8,9.9-8,15c3.9,2.5,10,12.6,11,22c3,0,6,0,9,0c0.9,7.2,5.8,10.3,11,13
                                                c1,0,2,0,3,0c0-8.3,0-16.7,0-25c4.8-8.3,11.6-8.2,10-21c7.7,3.7,15.3,7.3,23,11c0-0.7,0-1.3,0-2c0.3-0.2-2.8-35.1-3-37
                                                c0-0.3,0-0.7,0-1c6.2,2.2,10.8,3.5,14,9c15.3,0.1,21.9-5.2,30-12c25.3,16.5,18.2-30.8,32-47C400.8,99.1,381.2,104.8,364,94z" data-toggle="tooltip" data-placement="top" title="UP3 Karawang"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Rectangle_1_1_" class="st0">
                                    <g id="53PWK">
                                        <g>
                                            <path class="st13" d="M490,192v-2c-2.1-12.7,5-18.9,8-25c4.2-8.7-3.9-29.3,0-39c-6-1.7-12-3.3-18-5c-4.8-3.3-3.9-8.8-10-12
                                                c-23.3,5.5-42.6,28.7-64,12c-2.3,2.7-4.7,5.3-7,8c-4,4.4-0.2,13-2,20c-3.2,12.2-13.7,18.6-16,31c-3.4-2.8-4.5-4.1-5-10
                                                c-13,1-19.9,14.8-33,10c-4-2.7-8-5.3-12-8h-1c-3.6,14.7,8.1,22.8,3,36v2c-12.8-0.5-13.4-6.4-23-9c3.3,12.4-20.3,17.4-5,40v3h-6
                                                c-0.4,10.3-3.6,16-7,23c8.6,8.2,14.5,8.8,14,27h2c10.5,6.7,16.2-20.6,20-28c32.6,0,36.2,16.3,59,25c2-12,8.3-11.4,14-19
                                                c1,3.3,2,6.7,3,10c8.9,3.4,19,8.7,27,10c-0.7-1.7-1.3-3.3-2-5c4,3.7,8,7.3,12,11c10-1.1,11.5-3,21-2c13.2-12,8.4-52.4,15-70
                                                c9.2-12.1,21.5-0.3,21-26L490,192z" data-toggle="tooltip" data-placement="top" title="UP3 Purwakarta"/>
                                        </g>
                                    </g>
                                </g>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-4 col-lg-4">
                        <div id="card_saldo_awal" class="card">
                            <div class="card-body bg-danger">
                                <div class="media pl-xl-5 align-items-center">
                                    <img class="mr-3 mt-2" src="../../assets/images/icons/13.png" alt="">
                                    <div class="media-body pl-3">
                                        <h2 id="total_rpts" class="mt-4 mb-2 text-white">-</h2>
                                        <h6 id="total_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="total_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">SALDO AWAL</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 id="total_sesuai_rpts" class="mt-4 mb-2">-</h4>
                                        <h6 id="total_sesuai_jml_agenda" class="mt-0 mb-0">-</h6>
                                        <p class="mt-4">SESUAI</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 id="total_tdk_sesuai_rpts" class="mt-4 mb-2">-</h4>
                                        <h6 id="total_tdk_sesuai_jml_agenda" class="mt-0 mb-0">-</h6>
                                        <p class="mt-4">TIDAK SESUAI</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <div id="card_pengurangan" class="card">
                            <div class="card-body bg-primary">
                                <div class="media pl-xl-5 align-items-center">
                                    <img class="mr-3 mt-2" src="../../assets/images/icons/15.png" alt="">
                                    <div class="media-body pl-3">
                                        <h2 id="total_pengurangan_rpts" class="mt-4 mb-2 text-white">-</h2>
                                        <h6 id="total_pengurangan_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="total_pengurangan_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">(LUNAS, BATAL, DLL)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 id="total_pengurangan_sesuai_rpts" class="mt-4 mb-2">-</h4>
                                        <h6 id="total_pengurangan_sesuai_jml_agenda" class="mt-0 mb-0">-</h6>
                                        <p class="mt-4">SESUAI</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 id="total_pengurangan_tdk_sesuai_rpts" class="mt-4 mb-2">-</h4>
                                        <h6 id="total_pengurangan_tdk_sesuai_jml_agenda" class="mt-0 mb-0">-</h6>
                                        <p class="mt-4">TIDAK SESUAI</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <div id="card_saldo_akhir" class="card">
                            <div class="card-body bg-warning">
                                <div class="media pl-xl-5 align-items-center">
                                    <img class="mr-3 mt-2" src="../../assets/images/icons/13.png" alt="">
                                    <div class="media-body pl-3">
                                        <h2 id="total_saldo_akhir_rpts" class="mt-4 mb-2 text-white">-</h2>
                                        <h6 id="total_saldo_akhir_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="total_saldo_akhir_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">SALDO AKHIR</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 id="total_saldo_akhir_sesuai_rpts" class="mt-4 mb-2">-</h4>
                                        <h6 id="total_saldo_akhir_sesuai_jml_agenda" class="mt-0 mb-0">-</h6>
                                        <p class="mt-4">SESUAI</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 id="total_saldo_akhir_tdk_sesuai_rpts" class="mt-4 mb-2">-</h4>
                                        <h6 id="total_saldo_akhir_tdk_sesuai_jml_agenda" class="mt-0 mb-0">-</h6>
                                        <p class="mt-4">TIDAK SESUAI</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div id="2_card_saldo_akhir" class="card">
                                    <div class="card-body bg-warning">
                                        <div class="media pl-xl-5 align-items-center">
                                            <img class="mr-3 mt-2" src="../../assets/images/icons/13.png" alt="">
                                            <div class="media-body pl-3">
                                                <h2 id="breakdown_rpts" class="mt-4 mb-2 text-white">-</h2>
                                                <h6 id="breakdown_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white">SALDO AKHIR</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body bg-success">
                                        <h4 id="breakdown_sesuai_rpts" class="mt-4 mb-2 text-white">-</h4>
                                        <h6 id="breakdown_sesuai_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="breakdown_sesuai_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">SESUAI</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body bg-warning">
                                        <h4 id="breakdown_tdk_sesuai_rpts" class="mt-4 mb-2 text-white">-</h4>
                                        <h6 id="breakdown_tdk_sesuai_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="breakdown_tdk_sesuai_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">TIDAK SESUAI</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body bg-success">
                                        <h4 id="breakdown_sesuai_lancar_rpts" class="mt-4 mb-2 text-white">-</h4>
                                        <h6 id="breakdown_sesuai_lancar_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="breakdown_sesuai_lancar_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">LANCAR</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body bg-warning">
                                        <h4 id="breakdown_sesuai_tdk_lancar_rpts" class="mt-4 mb-2 text-white">-</h4>
                                        <h6 id="breakdown_sesuai_tdk_lancar_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="breakdown_sesuai_tdk_lancar_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">TIDAK LANCAR</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body bg-success">
                                        <h4 id="breakdown_tdk_sesuai_lancar_rpts" class="mt-4 mb-2 text-white">-</h4>
                                        <h6 id="breakdown_tdk_sesuai_lancar_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="breakdown_tdk_sesuai_lancar_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">LANCAR</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body bg-warning">
                                        <h4 id="breakdown_tdk_sesuai_tdk_lancar_rpts" class="mt-4 mb-2 text-white">-</h4>
                                        <h6 id="breakdown_tdk_sesuai_tdk_lancar_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                        <h6 id="breakdown_tdk_sesuai_tdk_lancar_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                        <p class="mt-4 text-white">TIDAK LANCAR</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="row">
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-success">
                                                <h6 id="breakdown_sesuai_lancar_beli_token_rpts" class="mt-4 mb-2 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_lancar_beli_token_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_lancar_beli_token_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>BELI TOKEN 6BLN</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-warning">
                                                <h6 id="breakdown_sesuai_lancar_tdk_beli_token_rpts" class="mt-4 mb-2 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_lancar_tdk_beli_token_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_lancar_tdk_beli_token_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>TDK BELI TOKEN > 6BLN</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-success">
                                                <h6 id="breakdown_sesuai_tdk_lancar_blocking_rpts" class="mt-4 mb-2 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_tdk_lancar_blocking_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_tdk_lancar_blocking_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>BLOCKING TOKEN</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-warning">
                                                <h6 id="breakdown_sesuai_tdk_lancar_blm_blocking_rpts" class="mt-4 mb-2 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_tdk_lancar_blm_blocking_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_tdk_lancar_blm_blocking_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>BELUM BLOCKING</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="row">
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-success">
                                                <h6 id="breakdown_tdk_sesuai_lancar_beli_token_rpts" class="mt-4 mb-2 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_lancar_beli_token_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_lancar_beli_token_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>BELI TOKEN 6BLN</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-warning">
                                                <h6 id="breakdown_tdk_sesuai_lancar_tdk_beli_token_rpts" class="mt-4 mb-2 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_lancar_tdk_beli_token_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_lancar_tdk_beli_token_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>TDK BELI TOKEN > 6BLN</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-success">
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blocking_rpts" class="mt-4 mb-2 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blocking_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blocking_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>BLOCKING TOKEN</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-warning">
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blm_blocking_rpts" class="mt-4 mb-2 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blm_blocking_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blm_blocking_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>BELUM BLOCKING</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="row">
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-primary">
                                                <h6 id="breakdown_sesuai_lancar_beli_token_koordinat_rpts" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_lancar_beli_token_koordinat_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_lancar_beli_token_koordinat_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>ADA KOORDINAT</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-primary">
                                                <h6 id="breakdown_sesuai_lancar_tdk_beli_token_koordinat_rpts" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_lancar_tdk_beli_token_koordinat_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_lancar_tdk_beli_token_koordinat_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>ADA KOORDINAT</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-primary">
                                                <h6 id="breakdown_sesuai_tdk_lancar_blocking_koordinat_rpts" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_tdk_lancar_blocking_koordinat_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_tdk_lancar_blocking_koordinat_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>ADA KOORDINAT</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-primary">
                                                <h6 id="breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_rpts" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_sesuai_tdk_lancar_blm_blocking_koordinat_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>ADA KOORDINAT</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <div class="row">
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-primary">
                                                <h6 id="breakdown_tdk_sesuai_lancar_beli_token_koordinat_rpts" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_lancar_beli_token_koordinat_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_lancar_beli_token_koordinat_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>ADA KOORDINAT</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-primary">
                                                <h6 id="breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_rpts" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_lancar_tdk_beli_token_koordinat_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>ADA KOORDINAT</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-primary">
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_rpts" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blocking_koordinat_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>ADA KOORDINAT</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 p-1">
                                        <div class="card">
                                            <div class="card-body bg-primary">
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_rpts" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_jml_plg" class="mt-0 mb-0 text-white">-</h6>
                                                <h6 id="breakdown_tdk_sesuai_tdk_lancar_blm_blocking_koordinat_jml_agenda" class="mt-0 mb-0 text-white">-</h6>
                                                <p class="mt-4 text-white"><small>ADA KOORDINAT</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                            
<!-- 
                <div class="row">
                    <div class="col-xl-7 col-xxl-12 col-12">
                        <div class="card d-flex">
                            <div class="row m-0">
                                <div class="col-lg-3 col-md-6 p-0">
                                    <div class="card-body total-activity-time bg-danger">
                                        <div class="text-center">
                                            <span class="display-4"><i class="icon-ban text-white"></i></span>
                                            <h2 id="total_semua_tidak_sesuai" class="mt-4 mb-0 text-white">-</h2>
                                            <h5 id="rp_semua_tidak_sesuai" class="mt-0 mb-4 text-white">-</h5>
                                            <p>TS P2TL TIDAK SESUAI</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-6 p-0">
                                    <div class="row">
                                        <div class="col-xl-6 col-xxl-6 col-6">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 id="total_ba_penetapan_sph_sesuai" class="mt-2 text-dark">-</h2>
                                                    <p>BA, TS, SPH, <strike class="text-muted">CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-xxl-6 col-6">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 id="total_ba_penetapan_sesuai" class="mt-2 text-dark">-</h2>
                                                    <p>BA, TS, <strike class="text-muted">SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-xxl-6 col-6">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 id="total_ba_sesuai" class="mt-2 text-dark">-</h2>
                                                    <p>BA, <strike class="text-muted">TS, SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-xxl-6 col-6">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 id="total_tidak_sesuai" class="mt-2 text-dark">-</h2>
                                                    <p><strike class="text-muted">BA, TS, SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_ts_p2tl" class="card">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Saldo Awal TS P2TL per Unit</h4>
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
                                <canvas id="chart_ts_p2tl_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-7 col-xxl-12 col-12">
                        <div id="card_saldo_detail" class="card d-flex bg-transparent">
                            <div class="row m-0">
                                <div class="col-lg-3 col-md-6 p-0">
                                    <div class="card-body total-activity-time bg-warning">
                                        <div class="text-center">
                                            <!-- <span class="display-4"><i class="icon-check text-white"></i></span> -->
                                            <h2 id="total_saldo_akhir_rpts2" class="mt-4 mb-0 text-white">-</h2>
                                            <h5 id="total_saldo_akhir_jml_plg2" class="mt-0 mb-4 text-white">-</h5>
                                            <p class="mt-4">SALDO AKHIR</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-9 col-sm-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-xl-6 pt-4 pb-4 mb-5 mb-xl-0">
                                                <div class="pull-left">
                                                    <h4>Prabayar</h4>
                                                    <p id="total_saldo_akhir_prabayar_jml_plg">-</p>
                                                </div>
                                                <div class="pull-right">
                                                    <h2 id="total_saldo_akhir_prabayar_rpts" class="text-primary">-</h2>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="progress mt-4 mt-md-5" style="height:12px;">
                                                    <div id="progress_blocking" class="progress-bar bg-primary" style="width: 0%; height:12px;" role="progressbar"><span id="text_persen_blocking" >0%</span>
                                                    </div>
                                                </div>
                                                <h6 class="mt-2 text-muted">Blocking Token <span id="text_blocking" class="pull-right">-</span></h6>
                                            </div>
                                            <div class="col-md-6 col-xl-6 pt-4 pb-4 mb-5 mb-xl-0">
                                                <div class="pull-left">
                                                    <h4>Paskabayar</h4>
                                                    <p id="total_saldo_akhir_paskabayar_jml_plg">-</p>
                                                </div>
                                                <div class="pull-right">
                                                    <h2 id="total_saldo_akhir_paskabayar_rpts" class="text-success">-</h2>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="progress mt-4 mt-md-5" style="height:12px;">
                                                    <div class="progress-bar bg-success" style="width: 10%; height:12px;" role="progressbar"><span class="sr-only">10% Complete</span>
                                                    </div>
                                                </div>
                                                <h6 class="mt-2 text-muted">Pemutusan (data blm lengkap)<span class="pull-right">XX% (...plg)</span></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xl-6 pt-4 pb-4 mb-5 mb-xl-0">
                                                <div class="pull-left">
                                                    <h4>Single Agenda</h4>
                                                    <p id="total_saldo_akhir_single_agenda_jml_plg">-</p>
                                                </div>
                                                <div class="pull-right">
                                                    <h2 id="total_saldo_akhir_single_agenda_rpts" class="text-primary">-</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6 pt-4 pb-4 mb-5 mb-xl-0">
                                                <div class="pull-left">
                                                    <h4>Multi Agenda</h4>
                                                    <p id="total_saldo_akhir_multi_agenda_jml_plg">-</p>
                                                </div>
                                                <div class="pull-right">
                                                    <h2 id="total_saldo_akhir_multi_agenda_rpts" class="text-success">-</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-9 col-md-6 p-0">
                                    <div class="row">
                                        <div class="col-xl-3 col-xxl-3 col-3">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 sph_sesuai" class="mt-2 text-dark">-</h2>
                                                    <p>BA, TS, SPH, <strike class="text-muted">CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-xxl-3 col-3">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 uai" class="mt-2 text-dark">-</h2>
                                                    <p>BA, TS, <strike class="text-muted">SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-xxl-3 col-3">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 class="mt-2 text-dark">-</h2>
                                                    <p>BA, <strike class="text-muted">TS, SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-xxl-3 col-3">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 class="mt-2 text-dark">-</h2>
                                                    <p><strike class="text-muted">BA, TS, SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_ts_p2tl_akhir" class="card">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Saldo Akhir TS P2TL per Unit</h4>
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
                                <canvas id="chart_ts_p2tl_akhir_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-xl-7 col-xxl-12 col-12">
                        <div id="card_saldo_akhir_tetap" class="card d-flex bg-transparent">
                            <div class="row m-0">
                                <div class="col-lg-3 col-md-6 p-0">
                                    <div class="card-body total-activity-time bg-danger">
                                        <div class="text-center">
                                            <!-- <span class="display-4"><i class="icon-check text-white"></i></span> -->
                                            <h2 id="total_saldo_akhir_tetap_rpts" class="mt-4 mb-0 text-white">-</h2>
                                            <h5 id="total_saldo_akhir_tetap_jml_agenda" class="mt-0 mb-4 text-white">-</h5>
                                            <p class="mt-4">TS P2TL Tanpa Progress</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-9 col-sm-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-xl-6 pt-4 pb-4 mb-5 mb-xl-0">
                                                <div class="pull-left">
                                                    <h4>Agenda Sesuai</h4>
                                                    <p id="total_saldo_akhir_tetap_sesuai_jml_agenda">-</p>
                                                </div>
                                                <div class="pull-right">
                                                    <h2 id="total_saldo_akhir_tetap_sesuai_rpts" class="text-primary">-</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6 pt-4 pb-4 mb-5 mb-xl-0">
                                                <div class="pull-left">
                                                    <h4>Agenda Tidak Sesuai</h4>
                                                    <p id="total_saldo_akhir_tetap_tdk_sesuai_jml_agenda">-</p>
                                                </div>
                                                <div class="pull-right">
                                                    <h2 id="total_saldo_akhir_tetap_tdk_sesuai_rpts" class="text-danger">-</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-9 col-md-6 p-0">
                                    <div class="row">
                                        <div class="col-xl-3 col-xxl-3 col-3">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 sph_sesuai" class="mt-2 text-dark">-</h2>
                                                    <p>BA, TS, SPH, <strike class="text-muted">CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-xxl-3 col-3">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 uai" class="mt-2 text-dark">-</h2>
                                                    <p>BA, TS, <strike class="text-muted">SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-xxl-3 col-3">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 class="mt-2 text-dark">-</h2>
                                                    <p>BA, <strike class="text-muted">TS, SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-xxl-3 col-3">
                                            <div class="card-body">
                                                <div class="text-center text-dark">
                                                    <h2 class="mt-2 text-dark">-</h2>
                                                    <p><strike class="text-muted">BA, TS, SPH, CEKLOK</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_ts_p2tl_akhir_tetap" class="card">
                            <div class="card-header">
                                <h4 class="card-title mt-3">TS P2TL Tanpa Progress per Unit</h4>
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
                                <canvas id="chart_ts_p2tl_akhir_tetap_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_blocking_token" class="card">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Blocking Token per Unit</h4>
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
                                <canvas id="chart_blocking_unit"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="card_rekap_blocking" class="card transparent-card m-b-0">
                            <div class="card-header">
                                <h4 class="card-title mt-3">Progress Blocking per UP3</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
                                        <thead>
                                            <tr>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>JML PLG</th>
                                                <th>JML JATUH TEMPO</th>
                                                <th>SUDAH BLOCKING</th>
                                                <th>BLM BLOCKING</th>
                                                <th>PERSENTASE</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>

    <?php include 'parts/footer.php'; ?>

    
    
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="../../assets/plugins/wnumb/wNumb.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
    
    <script src="../js/pages/index-admaga.js"></script>
</body>
</html>
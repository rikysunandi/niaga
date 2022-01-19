<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../css/style.css" rel="stylesheet">
    
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
                        <h4>Blast Invoice</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Invoice Rekening</a>
                            </li>
                            <li class="breadcrumb-item active">Blast Invoice</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card transparent-card m-b-0">
                            <div class="card-header">
                                <h4 class="card-title">Property Overview</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
                                                <th>Customer</th>
                                                <th>Property</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#841254</td>
                                                <td>Fleece Marigold</td>
                                                <td>4291 Lunetta Street,Tampa</td>
                                                <td>
                                                    <span class="text-muted">25/05/2018</span>
                                                </td>
                                                <td><span class="label label-success">Paid</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky" data-original-title="Edit">
                                                            <i class="fa fa-pencil"></i> 
                                                        </a>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky ml-3" data-original-title="Close">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#854525</td>
                                                <td>Theodore Handle</td>
                                                <td>2315 Browning Lane,Corning</td>
                                                <td>
                                                    <span class="text-muted">04/06/2018</span>
                                                </td>
                                                <td><span class="label label-success">Paid</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky" data-original-title="Edit">
                                                            <i class="fa fa-pencil"></i> 
                                                        </a>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky ml-3" data-original-title="Close">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#826548</td>
                                                <td>Archibald Northbottom</td>
                                                <td>3946 Coburn Hollow Road,South Pekin</td>
                                                <td>
                                                    <span class="text-muted">24/06/2018</span>
                                                </td>
                                                <td><span class="label label-warning">Pending</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky" data-original-title="Edit">
                                                            <i class="fa fa-pencil"></i> 
                                                        </a>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky ml-3" data-original-title="Close">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#862145</td>
                                                <td>Carnegie Mondover</td>
                                                <td>3292 Lindale Avenue,Oakland</td>
                                                <td>
                                                    <span class="text-muted">02/06/2018</span>
                                                </td>
                                                <td><span class="label label-danger">Failed</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky" data-original-title="Edit">
                                                            <i class="fa fa-pencil"></i> 
                                                        </a>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky ml-3" data-original-title="Close">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#872645</td>
                                                <td>Ursula Gurnmeister</td>
                                                <td>3893 Melm Street,Providence</td>
                                                <td>
                                                    <span class="text-muted">14/06/2018</span>
                                                </td>
                                                <td><span class="label label-success">Paid</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky" data-original-title="Edit">
                                                            <i class="fa fa-pencil"></i> 
                                                        </a>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky ml-3" data-original-title="Close">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#874125</td>
                                                <td>Ingredia Nutrisha</td>
                                                <td>1553 Heritage Road,Visalia</td>
                                                <td>
                                                    <span class="text-muted">06/06/2018</span>
                                                </td>
                                                <td><span class="label label-warning">Pending</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky" data-original-title="Edit">
                                                            <i class="fa fa-pencil"></i> 
                                                        </a>
                                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title=""  class="text-pale-sky ml-3" data-original-title="Close">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    
</body>
</html>
<?php
    include '../../conn.php';
    session_start();

    if(!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You have lo login first";
        header('Location: ../../page-login.php');
    }

    //Get Data From Page-Unit.php
    $ID = $_GET['id'];
    $q = oci_parse($conn, "SELECT UOM_CODE, UOM_NAME, UOM_SHORT_NAME, UOM_MAX_LOOSE FROM OM_UOM WHERE UOM_CODE = '".$ID."'");
    oci_execute($q);
    $r = oci_fetch_array($q);
    //
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Edit Unit</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/tmi/minilogo.png">
    <!-- Custom Stylesheet -->
    <link href="../../css/style.css" rel="stylesheet">
</head>
<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="nav-header">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <a href="../../index.php"><h3>Team Metal PT</span></h3></a>
                        </div>
                        <!-- <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="../setting/profile.php" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="../../page-logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul> -->
                    </div>
                </nav>
            </div>
        </div>
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="../../index.php" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li>
                    <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Transaction</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../asset/page-asset.php">Fixed Asset</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../supplier/page-supplier.php">Supplier</a></li>
                            <li><a href="../department/page-department.php">Department</a></li>
                            <li><a href="../currency/page-currency.php">Currency</a></li>
                            <li><a href="../cat-asset/page-cat-asset.php">Category Asset</a></li>
                            <li><a href="page-unit.php">Unit</a></li>
                        </ul>
                    </li>


                    <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-layout-25"></i><span class="nav-text">Report</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../report/asset.php">Fixed Asset</a></li>
                        </ul>
                    </li> -->

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-world-2"></i><span class="nav-text">Setting</span>
                        </a>
                        <ul aria-expanded="false">
                            <!-- <li><a href="../register/register.php">Register</a></li> -->
                            <li><a href="page/setting/user.php">User</a></li>
                        </ul>
                    </li>
                    <li><a href="../qr/qr-generator.php">
                        <i class="fa fa-qrcode" aria-hidden="true"></i><span class="nav-text">Barcode</span>
                        </a>
                    </li>
                    <li><a href="../../page-logout.php">
                        <i class="fa fa-sign-out" aria-hidden="true"></i><span class="nav-text">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-body">
            <div class="container-fluid">
                <form method="post" action="edit-unit-proses.php">
                    <div class="toolbar mb-2" role="toolbar">
                        <div class="btn-group mb-1">
                            <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Save">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="btn-group mb-1">
                            <a href="page-asset-new.php">
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="New">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                        <div class="btn-group mb-1">
                            <a href="page-asset.php">
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Back to list transaction">
                                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                <!-- row -->
                    <div class="row">
                        <div class="col-xl-6 col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit UOM</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>UOM Code</label>
                                                <input type="text" class="form-control" placeholder="" name="uomcode" value="<?php echo $r['UOM_CODE']; ?>" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>UOM Name</label>
                                                <input type="text" class="form-control" placeholder="" name="uomname" value="<?php echo $r['UOM_NAME']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Short Description</label>
                                                <input type="text" class="form-control" placeholder="" name="uomshort" value="<?php echo $r['UOM_SHORT_NAME']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Maximum Loose</label>
                                                <input type="text" class="form-control" placeholder="" name="maxloose" value="<?php echo $r['UOM_MAX_LOOSE']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; <?php echo date("Y"); ?><a href="#" target="_blank"></a> - TMI</p>
            </div>
        </div>
    </div>
    <!-- Required vendors -->
    <script src="../../vendor/global/global.min.js"></script>
    <script src="../../js/quixnav-init.js"></script>
    <script src="../../js/custom.min.js"></script>
</body>
</html>
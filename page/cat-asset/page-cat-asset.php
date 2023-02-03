<?php
    include '../../conn.php';
    session_start();

    //if the session variable is empty, this means the user is yet to login
    //user will be sent to login.php page to allow the user to login
    if(!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You have lo login first";
        header('Location: ../../page-login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Master Category Asset </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/tmi/minilogo.png">
    <!-- Datatable -->
    <link href="../../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
                            <li><a href="../asset/page-asset.php">Asset</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../supplier/page-supplier.php">Supplier</a></li>
                            <li><a href="../department/page-department.php">Department</a></li>
                            <li><a href="../currency/page-currency.php">Currency</a></li>
                            <li><a href="page-cat-asset.php">Category Asset</a></li>
                            <li><a href="../unit/page-unit.php">Unit</a></li>
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
                            <li><a href="page/setting/user.php">user</a></li>
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Master Category Asset</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <div class="toolbar mb-2" role="toolbar">
                            <div class="btn-group mb-1">
                                <a href="page-cat-new.php">
                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="New">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="btn-group mb-1">
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Preview In PDF">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="btn-group mb-1">
                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Refresh" onclick="window.location.reload();">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Category Code</th>
                                                <th>Category Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                $q = oci_parse($conn, "SELECT CATCODE, CATNAME FROM TBLCATASSET");
                                                oci_execute($q);
                                                While ($r = oci_fetch_array($q)){
                                                    ?>
                                                        <tr>
                                                            <td><?php ECHO $no++;?></td>
                                                            <td><?php ECHO $r['CATCODE'];?></td>
                                                            <td><?php ECHO $r['CATNAME']?></td>
                                                            <td>
                                                                <div class="btn-group mb-1">
                                                                    <a href="page-cat-edit.php?id=<?php echo $r['CATCODE']; ?>">
                                                                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Edit">
                                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <div class="btn-group mb-1">
                                                                    <a href="page-cat-delete.php?id=<?php echo $r['CATCODE']; ?>" class="btndelete">
                                                                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Hapus">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <!-- Datatable -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../js/plugins-init/datatables.init.js"></script>
</body>
</html>
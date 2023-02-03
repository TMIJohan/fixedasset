<?php
    session_start();
    include 'conn.php';
    if(!isset($_SESSION['username'])) {
        header('Location: page-login.php');
    }
    $role  = $_SESSION['role'];
    $department = $_SESSION['department'];

    if ($role == "admin") {
        $tot = oci_parse($conn, "SELECT COUNT(*) AS TOTASSET FROM TBLASSET");
    } else {
        $tot = oci_parse($conn, "SELECT COUNT(*) AS TOTASSET FROM TBLASSET WHERE ASSETLOC = '".$department."'");
    }
    oci_execute($tot);
    $r = oci_fetch_array($tot);
    $totasset = $r['TOTASSET'];
    
    if ($role == "admin") {
        $user = oci_parse($conn, "SELECT COUNT(*) AS TOTUSER FROM TBLUSER");
        oci_execute($user);
        $rr = oci_fetch_array($user);
        $totuser = $rr['TOTUSER'];
    }
    

    // $dataPoints = array();
    
    //     $query = oci_parse($conn, "SELECT COUNT(A.ASSETLOC), B.ASSETLOC FROM TBLASSET A 
    //         INNER JOIN TBLASSET B ON A.ASSETCODE = B.ASSETCODE 
    //         GROUP BY A.ASSETLOC, B.ASSETLOC");
    //     oci_execute($query);
    //     While ($row = oci_fetch_array($query)){
    //         array_push($dataPoints, array("x"=> $row->x, "y"=> $row->y));
    //     }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/tmi/minilogo.png">
    <!---->
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway:200,400,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        
    </script>
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
                            <a href="index.php"><h3>Team Metal PT</span></h3></a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="index.php" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-app-store"></i><span class="nav-text">Transaction</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="page/asset/page-asset.php">Fixed Asset</a></li>
                            <li><a href="page/transfer/page-transfer.php">Transfer Asset</a></li>
                            <li><a href="page/disposal/page-disposal.php">Disposal Asset</a></li>
                        </ul>
                    </li>
                <?php 
                    if ($role == "admin") {
                ?>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="page/Supplier/page-supplier.php">Supplier</a></li>
                                <li><a href="page/Department/page-department.php">Department</a></li>
                                <li><a href="page/currency/page-currency.php">Currency</a></li>
                                <li><a href="page/cat-asset/page-cat-asset.php">Category Asset</a></li>
                                <li><a href="page/unit/page-unit.php">Unit</a></li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-layout-25"></i><span class="nav-text">Report</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="page/report/asset.php">Fixed Asset</a></li>
                            </ul>
                        </li> -->
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-world-2"></i><span class="nav-text">Setting</span>
                            </a>
                            <ul aria-expanded="false">
                                <!-- <li><a href="page/register/register.php">Register</a></li> -->
                                <li><a href="page/setting/user.php">User</a></li>
                            </ul>
                        </li>
                <?php    
                    } elseif ($department == "AC"){
                ?>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="page/Supplier/page-supplier.php">Supplier</a></li>
                                <li><a href="page/Department/page-department.php">Department</a></li>
                                <li><a href="page/currency/page-currency.php">Currency</a></li>
                                <li><a href="page/cat-asset/page-cat-asset.php">Category Asset</a></li>
                                <li><a href="page/unit/page-unit.php">Unit</a></li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-layout-25"></i><span class="nav-text">Report</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="page/report/asset.php">Fixed Asset</a></li>
                            </ul>
                        </li> -->
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-world-2"></i><span class="nav-text">Setting</span>
                            </a>
                            <ul aria-expanded="false">
                                <!-- <li><a href="page/register/register.php">Register</a></li> -->
                                <li><a href="page/setting/user.php">user</a></li>
                            </ul>
                        </li>
                <?php
                    }
                ?>
                    <li><a href="./page/qr/qr-generator.php">
                        <i class="fa fa-qrcode" aria-hidden="true"></i><span class="nav-text">Barcode</span>
                        </a>
                    </li>
                    <li><a href="page-logout.php">
                        <i class="fa fa-sign-out" aria-hidden="true"></i><span class="nav-text">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-body">
            <!-- row -->
            <div class="container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, Welcome Back <?php echo $_SESSION['username']?> !</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-money text-success border-success"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Asset</div>
                                    <div class="stat-digit"><?php echo $totasset; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                if ($role == "admin") {
                ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-user text-primary border-primary"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">User</div>
                                    <div class="stat-digit"><?php echo $totuser; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                    
                </div>
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Bar Chart</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="DoughnutAsset"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; <?php echo date("Y"); ?><a href="#" target="_blank"></a> - TMI</p>
            </div>
        </div>
    </div>
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const ctx = document.getElementById('myChart');

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
</body>
</html>
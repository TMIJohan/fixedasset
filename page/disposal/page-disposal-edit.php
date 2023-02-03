<?php
    include '../../conn.php';
    session_start();

    if(!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You have lo login first";
        header('Location: ../../page-login.php');
    }

    $username = $_SESSION['username'];
    $role  = $_SESSION['role'];
    $department  = $_SESSION['department'];


    $ID = $_GET['id'];

    $query = oci_parse($conn, "SELECT INVCODE, ASSETCODE, INVTYPE, INVDATE, INVDESC, INVSERIAL, INVMODEL, YEAR, TRANFERFROM, REASON 
                                FROM TBLINV WHERE INVCODE = '".$ID."'");
    oci_execute($query);
    $row = oci_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Edit Disposal</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/tmi/minilogo.png">
    <link rel="stylesheet" href="../../vendor/select2/css/select2.min.css">
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
                    <li><a href="../../index.php" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Transaction</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../asset/page-asset.php">Fixed Asset</a></li>
                            <li><a href="page-transfer.php">Transfer Asset</a></li>
                            <li><a href="../disposal/page-disposal.php">Disposal Asset</a></li>
                        </ul>
                    </li>       
                    <?php 
                        if ($role == "admin") {
                    ?>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span></a>
                            <ul aria-expanded="false">
                                <li><a href="../supplier/page-supplier.php">Supplier</a></li>
                                <li><a href="../department/page-department.php">Department</a></li>
                                <li><a href="../currency/page-currency.php">Currency</a></li>
                                <li><a href="../cat-asset/page-cat-asset.php">Category Asset</a></li>
                                <li><a href="../unit/page-unit.php">Unit</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-world-2"></i><span class="nav-text">Setting</span>
                            </a>
                            <ul aria-expanded="false">
                                <!-- <li><a href="../register/register.php">Register</a></li> -->
                                <li><a href="../setting/user.php">User</a></li>
                            </ul>
                        </li>
                    <?php    
                        } elseif ($department == "AC") {
                    ?>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span></a>
                            <ul aria-expanded="false">
                                <li><a href="../supplier/page-supplier">Supplier</a></li>
                                <li><a href="../department/page-department">Department</a></li>
                                <li><a href="../currency/page-currency.php">Currency</a></li>
                                <li><a href="../cat-asset/page-cat-asset.php">Category Asset</a></li>
                                <li><a href="../unit/page-unit.php">Unit</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-world-2"></i><span class="nav-text">Setting</span>
                            </a>
                            <ul aria-expanded="false">
                                <!-- <li><a href="../register/register.php">Register</a></li> -->
                                <li><a href="../setting/user.php">User</a></li>
                            </ul>
                        </li>
                    <?php
                        }
                    ?>
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
                <form method="post" action="edit-disposal-proses.php">
                    <div class="toolbar mb-2" role="toolbar">
                        <div class="btn-group mb-1">
                            <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Save" name="save">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="btn-group mb-1">
                            <a href="page-disposal.php">
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
                                    <h4 class="card-title">Edit Disposal Asset</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Disposal Code</label>
                                                <input type="text" class="form-control" placeholder="" name="DisposalCode" value="<?php echo $row['INVCODE']; ?>" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Asset Code</label>
                                                <input type="text" class="form-control" placeholder="" name="ASSETCODE" value="<?php echo $row['ASSETCODE']; ?>" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''" readonly>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
	                                            <label>Disposal Date</label>
	                                            <input type="date" class="form-control" value="<?php echo date('Y-m-d',strtotime($row["INVDATE"]))?>" placeholder="" name="DisposalDate" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value='<?php echo date('Y-m-d'); ?>'" readonly>
	                                        </div>
	                                        <div class="form-group col-md-6">
	                                            <label>Year Mfg</label>
	                                            <input type="date" class="form-control" value="<?php echo date('Y-m-d',strtotime($row["YEAR"]))?>" placeholder="" name="DisposalYear" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value='<?php echo date('Y-m-d'); ?>'">
	                                        </div>
	                                    </div>
	                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                            	<label>Description</label>
                                            	<textarea class="form-control" rows="2" id="comment" name="DisposalDesc"><?php echo $row['INVDESC']; ?></textarea>
                                        	</div>
                                            <div class="form-group col-md-6">
                                                <label>Asset Location</label>
                                                <select class="default-placeholder" name="AssetLoc">
                                                    <option value="-">SELECT DEP/LOC</option>
                                                    <?php
                                                        include '../conn.php';
                                                        $query =  oci_parse($conn, "SELECT DEPTCODE, DEPTCODE || ' - ' || DEPTNAME AS DEPTNAME FROM TBLDEPARTMENT");
                                                        oci_execute($query);
                                                        $X = $row['TRANFERFROM'];
                                                        while($data = oci_fetch_array($query)){
                                                        $Y = "";
                                                        if(isset($_GET['id'])){
                                                            if($X==$data['DEPTCODE']){
                                                                $Y="SELECTED";
                                                            }
                                                        }
                                                    ?>
                                                        <option <?php echo $Y; ?> value="<?php echo oci_result($query, "DEPTCODE");?>"><?php echo oci_result($query, "DEPTNAME");?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
	                                    </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Disposal Serial No.</label>
                                                <input type="text" class="form-control" placeholder="" name="DisposalSerial" value="<?php echo $row['INVSERIAL']; ?>" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Disposal Model No.</label>
                                                <input type="text" class="form-control" placeholder="" name="DisposalModel" value="<?php echo $row['INVMODEL']; ?>" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                            </div>
                                            
                                        </div>
                                        <div class="form-row">
                                        	<div class="form-group col-md-12">
                                                <label>Reason for Disposal</label>
                                                <textarea class="form-control" rows="2" id="comment" name="DisposalReason"><?php echo $row['REASON']; ?></textarea>
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
    <script src="../../vendor/select2/js/select2.full.min.js"></script>
    <script src="../../js/plugins-init/select2-init.js"></script>
</body>
</html>
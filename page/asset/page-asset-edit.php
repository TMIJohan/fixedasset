<?php
    include '../../conn.php';
    session_start();

    if(!isset($_SESSION['username'])) {
        header('Location: ../../page-login.php');
    }

    $ID = $_GET['id'];

    $query = oci_parse($conn, "SELECT ASSETCAT, ASSETCODE, ASSETROINO, ASSETNAME, ASSETSHORTNAME, ASSETDATE, ASSETLOC, ASSETDESC,
                                QUANTITY, UNIT, CURRENCY, USEFULL, ASSETSUPPLIER, ASSETNO, ASSETMODEL,
                                ASSETREFNO, ASSETPONO, ASSERPODATE, TRANSFERCD, ASSETREMARK, ASSETPHOTO,
                                ASSETCOA, ASSETDEPRCOA, ASSETDEPREXPCOA, AMOUNTUSD, AMOUNTSGD, ATCOST, EXCHANGERATE,
                                (DEPRRATE * 100) AS DEPRRATE, NONBV,
                                ASSETCAPEX, PIC, STATUS,
                                PHYSICALCHECK, PHYSICALACTION, PHYSICALREMARK, ASSETCAPEX, PIC, ASSETPROJECT
                                FROM TBLASSET WHERE ASSETCODE = '".$ID."'");
    oci_execute($query);
    $row = oci_fetch_array($query);

    $username = $_SESSION['username'];
    $role  = $_SESSION['role'];
    $department  = $_SESSION['department'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Edit Fixed Asset</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/tmi/minilogo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../../vendor/select2/css/select2.min.css">
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../css/bootstrap-datetimepicker.min.css" type="text/css" media="all" rel="stylesheet" />
    <script type="text/javascript" src="../../js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="../../js/demo.js"></script>
    <style>
        .vertical {
            border-left: 2px solid #673BB7;
            height: 33px;
            position:absolute;
            left: 426px;
            top : 113px;
        }
        input[type="file"]{
            display: none;
        }
    </style>

    <script type = 'text/javascript'>
        function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
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
                            <li><a href="page-asset.php">Fixed Asset</a></li>
                        </ul>
                    </li>
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
                            <li><a href="../page/setting/user.php">User</a></li>
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
                <form method="POST" action="edit-asset-proses.php" enctype="multipart/form-data">
                    <div class="toolbar mb-2" role="toolbar">
                        <div class="btn-group mb-1">
                            <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Save" name="save" id="btnsave">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </button>
                        </div>
                        <?php
                            if ($role == "admin"){
                        ?>
                            <!-- batas -->
                            <?php
                                    $btnrunning = $row['STATUS'];
                                    if ($btnrunning == "RUNNING") {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning" disabled>
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Revise" name="btnrevise">
                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    } else {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning">
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    $btnrunning = $row['STATUS'];
                                    if ($btnrunning == "REVISE") {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning">
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Revise" name="btnrevise" disabled>
                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                                <div class="btn-group mb-1">
                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Disposal">
                                        <i class="fa fa-recycle"></i>
                                    </button>
                                </div>
                            <!-- batas -->
                        <?php
                            } elseif ($department == "AC") {
                        ?>
                            <!-- batas -->
                            <?php
                                    $btnrunning = $row['STATUS'];
                                    if ($btnrunning == "RUNNING") {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning" disabled>
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Revise" name="btnrevise">
                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    } else {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning">
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    $btnrunning = $row['STATUS'];
                                    if ($btnrunning == "REVISE") {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning">
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Revise" name="btnrevise" disabled>
                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                                <div class="btn-group mb-1">
                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Disposal">
                                        <i class="fa fa-recycle"></i>
                                    </button>
                                </div>
                            <!-- batas -->
                        <?php
                            } else {
                        ?>
                            <!-- batas -->
                            <?php
                                    $btnrunning = $row['STATUS'];
                                    if ($btnrunning == "RUNNING") {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning" disabled>
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Revise" name="btnrevise" disabled>
                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    } else {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning" disabled>
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    $btnrunning = $row['STATUS'];
                                    if ($btnrunning == "REVISE") {
                                ?>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Running" name="btnrunning" disabled>
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Revise" name="btnrevise" disabled>
                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                                <div class="btn-group mb-1">
                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Disposal" disabled>
                                        <i class="fa fa-recycle"></i>
                                    </button>
                                </div>
                            <!-- batas -->
                        <?php
                            }
                        ?>
                        <div class="btn-group mb-1"></div>
                        <div class = "vertical"></div>
                        <div class="btn-group mb-1"></div>
                        <div class="btn-group mb-1">
                            <?php
                                if ($role == "admin") {
                            ?>
                                <a href="page-asset-new.php">
                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="New">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                </a>    
                            <?php
                                } elseif ($department == "department") {
                            ?>
                                <a href="page-asset-new.php">
                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="New">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                </a>    
                            <?php
                                } else {
                            ?>
                                <a href="page-asset-new.php">
                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="New" disabled>
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                </a>    
                            <?php
                                }
                            ?>
                        </div>
                        <div class="btn-group mb-1">
                            <a href="page-asset.php">
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Back to list transaction">
                                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="basic-form">
                                       <img class="img-fluid" alt="" width="110%" id="output_image" <?php if ($row['ASSETPHOTO'] == null){ ?>
                                        src="../../images/imag.png" <?php } else { ?> src="file/<?php echo $row['ASSETPHOTO']; ?>"<?php } ?>>
                                    </div>
                                    <br>
                                    <input type="file" id="edit_img" accept="image/*" name="uploadfoto" onchange="preview_image(event)">
                                    <label for="edit_img" class="btn btn-outline-primary" style="cursor: pointer; position: absolute; margin-left: 55px;">Browse</label>

                                    <!-- <label for="edit_img">
                                        <input type="file" id="edit_img" name="uploadfoto"  onchange="preview_image(event)"/>
                                        <a><i data-feather="edit"></i></a>
                                    </label> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Asset</h4>
                                        <?php
                                            $statusasset = $row['STATUS'];
                                            if ($statusasset == "ENTRY") {
                                        ?>
                                                <span class="badge badge-pill badge-info"><?php echo $row['STATUS']; ?></span>
                                        <?php
                                            } elseif($statusasset == "RUNNING"){
                                        ?>
                                                <span class="badge badge-pill badge-success"><?php echo $row['STATUS']; ?></span>
                                        <?php
                                            } elseif($statusasset == "DISPOSAL"){
                                        ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $row['STATUS']; ?></span>
                                        <?php
                                            }
                                        ?>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Asset Category</label>
                                            <select class="default-placeholder" name="assetcategory" disabled>
                                                <option value="-">SELECT CATEGORY</option>
                                                <?php
                                                    $query =  oci_parse($conn, "SELECT CATCODE, CATCODE || ' - ' || CATNAME AS CATNAME FROM TBLCATASSET");
                                                    oci_execute($query);
                                                    $X = $row['ASSETCAT'];
                                                    while($data = oci_fetch_array($query)){
                                                    $Y = "";
                                                    if(isset($_GET['id'])){
                                                        if($X==$data['CATCODE']){
                                                            $Y="SELECTED";
                                                        }
                                                    }
                                                ?>
                                                    <option <?php echo $Y; ?> value="<?php echo oci_result($query, "CATCODE");?>"><?php echo oci_result($query, "CATNAME");?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Asset Code</label>
                                            <input type="text" class="form-control" placeholder="" name="assetcode" value="<?php echo $row['ASSETCODE']; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ROI No</label>
                                            <input type="text" class="form-control" placeholder="" name="roino" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Asset Name</label>
                                            <input type="text" class="form-control" placeholder="" name="assetname" autocomplete="off"  <?php if ($department != "AC") {?> readonly <?php } elseif ($role == "admin"){ ?> readonly <?php } ?> value="<?php echo $row['ASSETNAME']; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Asset Short Name</label>
                                            <input type="text" class="form-control" placeholder="" name="assetshortname" autocomplete="off" <?php if ($department != "AC") {?> readonly <?php } elseif ($role == "admin"){ ?> readonly <?php } ?> value="<?php echo $row['ASSETSHORTNAME']; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="id_end_time">Asset Date</label>
                                            <!-- <input type="date" class="form-control" placeholder="" name="assetdate" autocomplete="off" value="<?php echo date('Y-m-d',strtotime($row["ASSETDATE"]))?>"> -->
                                            <input type="text" class="form-control" placeholder="" id="datepicker" name="assetdate" autocomplete="off" <?php if ($department != "AC") {?> readonly <?php } elseif ($role == "admin"){ ?> readonly <?php } ?> value="<?php echo date('Y-m-d',strtotime($row["ASSETDATE"]))?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-xxl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Location</label>
                                                <select class="default-placeholder" name="assetlocation" id="department" onchange="update_pic()">
                                                    <option value="-">SELECT LOCATION</option>
                                                    <?php
                                                        include '../conn.php';
                                                        $query =  oci_parse($conn, "SELECT DEPTCODE, DEPTCODE || ' - ' || DEPTNAME AS DEPTNAME FROM TBLDEPARTMENT");
                                                        oci_execute($query);
                                                        $X = $row['ASSETLOC'];
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
                                            <div class="form-group col-md-6">
                                                <label>Description</label>
                                                <input type="text" class="form-control" placeholder="" name="assetdesc" autocomplete="off" <?php if ($department != "AC") {?> readonly <?php } elseif ($role == "admin"){ ?> readonly <?php } ?> value="<?php echo $row['ASSETDESC']; ?>">
                                            </div>
                                        </div>
                                    <div class="form-row align-items-center">
                                        <div class="form-group col-md-1">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" placeholder="" name="assetqty" autocomplete="off" <?php if ($department != "AC") {?> readonly <?php } elseif ($role == "admin"){ ?> readonly <?php } ?> value="<?php echo $row['QUANTITY']; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Unit</label>
                                            <select class="default-placeholder" name="assetunit" <?php if ($department != "AC") {?> disabled <?php } elseif ($role === "admin"){ ?> disabled <?php } ?>>
                                                <option value="-">SELECT UNIT</option>
                                                <?php
                                                    include '../conn.php';
                                                    $query =  oci_parse($conn, "SELECT UOM_CODE, UOM_CODE || ' - ' || UOM_NAME AS UOM_NAME FROM OM_UOM");
                                                    oci_execute($query);
                                                    $X = $row['UNIT'];
                                                    while($data = oci_fetch_array($query)){
                                                    $Y = "";
                                                    if(isset($_GET['id'])){
                                                        if($X==$data['UOM_CODE']){
                                                            $Y="SELECTED";
                                                        }
                                                    }
                                                ?>
                                                    <option <?php echo $Y; ?> value="<?php echo oci_result($query, "UOM_CODE");?>"><?php echo oci_result($query, "UOM_NAME");?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3"></div>
                                            <div class="form-group col-md-3">
                                                <label>Currency</label>
                                                <select class="default-placeholder" name="assetcurrency" <?php if ($department != "AC") {?> disabled <?php } elseif ($role == "admin"){ ?> disabled <?php } ?>>
                                                    <option value="-">SELECT CURRENCY</option>
                                                    <?php
                                                        include '../conn.php';
                                                        $query =  oci_parse($conn, "SELECT CURR_CODE, CURR_CODE || ' - ' || CURR_NAME AS CURR_NAME FROM FM_CURRENCY");
                                                        oci_execute($query);
                                                        $X = $row['CURRENCY'];
                                                        while($data = oci_fetch_array($query)){
                                                        $Y = "";
                                                        if(isset($_GET['id'])){
                                                            if($X==$data['CURR_CODE']){
                                                                $Y="SELECTED";
                                                            }
                                                        }
                                                    ?>
                                                        <option <?php echo $Y; ?> value="<?php echo oci_result($query, "CURR_CODE");?>"><?php echo oci_result($query, "CURR_NAME");?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Useful Life (Year)</label>
                                                <input type="text" class="form-control" placeholder="" name="assetuseful" autocomplete="off" <?php if ($department != "AC") {?> readonly <?php } elseif ($role == "admin"){ ?> readonly <?php } ?> value="<?php echo $row['USEFULL']; ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-2">
                                                    <div class="nav flex-column nav-pills">
                                                        <?php
                                                            if($department == "AC") {
                                                        ?>
                                                            <a href="#v-pills-home" data-toggle="pill" class="nav-link active show">General</a>
                                                            <a href="#v-pills-profile" data-toggle="pill" class="nav-link">Coa</a>
                                                            <a href="#v-pills-messages" data-toggle="pill" class="nav-link">Cost</a>
                                                            <a href="#v-pills-physical" data-toggle="pill" class="nav-link">Physical Check</a>
                                                            <a href="#v-pills-settings" data-toggle="pill" class="nav-link">Other</a>
                                                        <?php
                                                            } elseif ($role == "admin") {
                                                        ?>
                                                            <a href="#v-pills-home" data-toggle="pill" class="nav-link active show">General</a>
                                                            <a href="#v-pills-profile" data-toggle="pill" class="nav-link">Coa</a>
                                                            <a href="#v-pills-messages" data-toggle="pill" class="nav-link">Cost</a>
                                                            <a href="#v-pills-physical" data-toggle="pill" class="nav-link">Physical Check</a>
                                                            <a href="#v-pills-settings" data-toggle="pill" class="nav-link">Other</a>
                                                        <?php

                                                            } else {
                                                        ?>
                                                            <!-- <a href="#v-pills-home" data-toggle="pill" class="nav-link">General</a>
                                                            <a href="#v-pills-profile" data-toggle="pill" class="nav-link">Coa</a>
                                                            <a href="#v-pills-messages" data-toggle="pill" class="nav-link">Cost</a> -->
                                                            <a href="#v-pills-physical" data-toggle="pill" class="nav-link active show">Physical Check</a>
                                                            <!-- <a href="#v-pills-settings" data-toggle="pill" class="nav-link">Other</a> -->
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-xl-9">
                                                    <div class="tab-content">
                                                        <?php
                                                            if ($role == "admin") {
                                                        ?>
                                                                <div id="v-pills-home" class="tab-pane fade active show">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Supplier</label>
                                                                    <select class="default-placeholder" name="assetsupplier">
                                                                        <option value="-">SELECT SUPPLIER</option>
                                                                        <?php
                                                                            include '../conn.php';
                                                                            $query =  oci_parse($conn, "SELECT SUPPCODE, SUPPCODE || ' - ' || SUPPNAME AS SUPPNAME FROM TBLSUPPLIER");
                                                                            oci_execute($query);
                                                                            $X = $row['ASSETSUPPLIER'];
                                                                            while($data = oci_fetch_array($query)){
                                                                            $Y = "";
                                                                            if(isset($_GET['id'])){
                                                                                if($X==$data['SUPPCODE']){
                                                                                    $Y="SELECTED";
                                                                                }
                                                                            }
                                                                        ?>
                                                                            <option <?php echo $Y; ?> value="<?php echo oci_result($query, "SUPPCODE");?>"><?php echo oci_result($query, "SUPPNAME");?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Asset Form</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetform" autocomplete="off" value="<?php echo $row['ASSETNO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Model / Serial No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetmodel" autocomplete="off" value="<?php echo $row['ASSETMODEL']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Ref No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetrefno" autocomplete="off" value="<?php echo $row['ASSETREFNO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>PO No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetpono" autocomplete="off" value="<?php echo $row['ASSETPONO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Date of Purchase</label>
                                                                    <input type="date" class="form-control" placeholder="" name="assetpodate" autocomplete="off" value="<?php echo date('Y-m-d',strtotime($row["ASSERPODATE"]))?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Transfer No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assettransfer" autocomplete="off" value="<?php echo $row['TRANSFERCD']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Remark</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetremark" autocomplete="off" value="<?php echo $row['ASSETREMARK']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            } elseif ($department == "AC") {
                                                        ?>
                                                                <div id="v-pills-home" class="tab-pane fade active show">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Supplier</label>
                                                                    <select class="default-placeholder" name="assetsupplier">
                                                                        <option value="-">SELECT SUPPLIER</option>
                                                                        <?php
                                                                            include '../conn.php';
                                                                            $query =  oci_parse($conn, "SELECT SUPPCODE, SUPPCODE || ' - ' || SUPPNAME AS SUPPNAME FROM TBLSUPPLIER");
                                                                            oci_execute($query);
                                                                            $X = $row['ASSETSUPPLIER'];
                                                                            while($data = oci_fetch_array($query)){
                                                                            $Y = "";
                                                                            if(isset($_GET['id'])){
                                                                                if($X==$data['SUPPCODE']){
                                                                                    $Y="SELECTED";
                                                                                }
                                                                            }
                                                                        ?>
                                                                            <option <?php echo $Y; ?> value="<?php echo oci_result($query, "SUPPCODE");?>"><?php echo oci_result($query, "SUPPNAME");?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Asset Form</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetform" autocomplete="off" value="<?php echo $row['ASSETNO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Model / Serial No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetmodel" autocomplete="off" value="<?php echo $row['ASSETMODEL']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Ref No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetrefno" autocomplete="off" value="<?php echo $row['ASSETREFNO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>PO No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetpono" autocomplete="off" value="<?php echo $row['ASSETPONO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Date of Purchase</label>
                                                                    <input type="date" class="form-control" placeholder="" name="assetpodate" autocomplete="off" value="<?php echo date('Y-m-d',strtotime($row["ASSERPODATE"]))?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Transfer No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assettransfer" autocomplete="off" value="<?php echo $row['TRANSFERCD']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Remark</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetremark" autocomplete="off" value="<?php echo $row['ASSETREMARK']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            } else {
                                                        ?>
                                                                <div id="v-pills-home" class="tab-pane fade">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Supplier</label>
                                                                    <select class="default-placeholder" name="assetsupplier">
                                                                        <option value="-">SELECT SUPPLIER</option>
                                                                        <?php
                                                                            include '../conn.php';
                                                                            $query =  oci_parse($conn, "SELECT SUPPCODE, SUPPCODE || ' - ' || SUPPNAME AS SUPPNAME FROM TBLSUPPLIER");
                                                                            oci_execute($query);
                                                                            $X = $row['ASSETSUPPLIER'];
                                                                            while($data = oci_fetch_array($query)){
                                                                            $Y = "";
                                                                            if(isset($_GET['id'])){
                                                                                if($X==$data['SUPPCODE']){
                                                                                    $Y="SELECTED";
                                                                                }
                                                                            }
                                                                        ?>
                                                                            <option <?php echo $Y; ?> value="<?php echo oci_result($query, "SUPPCODE");?>"><?php echo oci_result($query, "SUPPNAME");?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Asset Form</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetform" autocomplete="off" value="<?php echo $row['ASSETNO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Model / Serial No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetmodel" autocomplete="off" value="<?php echo $row['ASSETMODEL']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Ref No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetrefno" autocomplete="off" value="<?php echo $row['ASSETREFNO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>PO No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetpono" autocomplete="off" value="<?php echo $row['ASSETPONO']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Date of Purchase</label>
                                                                    <input type="date" class="form-control" placeholder="" name="assetpodate" autocomplete="off" value="<?php echo date('Y-m-d',strtotime($row["ASSERPODATE"]))?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Transfer No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assettransfer" autocomplete="off" value="<?php echo $row['TRANSFERCD']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Remark</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetremark" autocomplete="off" value="<?php echo $row['ASSETREMARK']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="logo-upload" for="edit_img">
                                                                        <input type="file" id="edit_img" value = "<?php echo $row['ASSETPHOTO']; ?>" name="uploadfoto" onchange="preview_image(event)"/>
                                                                        <a><i data-feather="edit"></i></a>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group col-md-3"></div>
                                                                <img src="file/<?php echo $row['ASSETPHOTO']; ?>" style="width:50%" id="output_image"/>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            }
                                                        ?>
                                                        <div id="v-pills-profile" class="tab-pane fade">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>COA Asset</label>
                                                                    <select class="default-placeholder" name="coaasset">
                                                                        <option value="-">SELECT COA ASSET</option>
                                                                        <?php
                                                                            include '../conn.php';
                                                                            $query =  oci_parse($conn, "SELECT MS_SUB_ACNT_CODE, MS_SUB_ACNT_CODE || ' - ' || MS_SUB_ACNT_NAME AS MS_SUB_ACNT_NAME FROM TMS.FM_MAIN_SUB");
                                                                            oci_execute($query);
                                                                            $X = $row['ASSETCOA'];
                                                                            while($data = oci_fetch_array($query)){
                                                                            $Y = "";
                                                                            if(isset($_GET['id'])){
                                                                                if($X==$data['MS_SUB_ACNT_CODE']){
                                                                                    $Y="SELECTED";
                                                                                }
                                                                            }
                                                                        ?>
                                                                            <option <?php echo $Y; ?> value="<?php echo oci_result($query, "MS_SUB_ACNT_CODE");?>"><?php echo oci_result($query, "MS_SUB_ACNT_NAME");?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Coa Depreciation</label>
                                                                    <select class="default-placeholder" name="coadepr">
                                                                        <option value="-">SELECT COA DEPR</option>
                                                                        <?php
                                                                            include '../conn.php';
                                                                            $query =  oci_parse($conn, "SELECT MS_SUB_ACNT_CODE, MS_SUB_ACNT_CODE || ' - ' || MS_SUB_ACNT_NAME AS MS_SUB_ACNT_NAME FROM TMS.FM_MAIN_SUB");
                                                                            oci_execute($query);
                                                                            $X = $row['ASSETDEPRCOA'];
                                                                            while($data = oci_fetch_array($query)){
                                                                            $Y = "";
                                                                            if(isset($_GET['id'])){
                                                                                if($X==$data['MS_SUB_ACNT_CODE']){
                                                                                    $Y="SELECTED";
                                                                                }
                                                                            }
                                                                        ?>
                                                                            <option <?php echo $Y; ?> value="<?php echo oci_result($query, "MS_SUB_ACNT_CODE");?>"><?php echo oci_result($query, "MS_SUB_ACNT_NAME");?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Coa Depreciation Exp</label>
                                                                    <select class="default-placeholder" name="coadprexp">
                                                                        <option value="-">SELECT COA DEPR ECP</option>
                                                                        <?php
                                                                            include '../conn.php';
                                                                            $query =  oci_parse($conn, "SELECT MS_SUB_ACNT_CODE, MS_SUB_ACNT_CODE || ' - ' || MS_SUB_ACNT_NAME AS MS_SUB_ACNT_NAME FROM TMS.FM_MAIN_SUB");
                                                                            oci_execute($query);
                                                                            $X = $row['ASSETDEPREXPCOA'];
                                                                            while($data = oci_fetch_array($query)){
                                                                            $Y = "";
                                                                            if(isset($_GET['id'])){
                                                                                if($X==$data['MS_SUB_ACNT_CODE']){
                                                                                    $Y="SELECTED";
                                                                                }
                                                                            }
                                                                        ?>
                                                                            <option <?php echo $Y; ?> value="<?php echo oci_result($query, "MS_SUB_ACNT_CODE");?>"><?php echo oci_result($query, "MS_SUB_ACNT_NAME");?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="v-pills-messages" class="tab-pane fade">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Amount - USD</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">$ USD</span>
                                                                        </div>
                                                                        <input type="text" name="amountusd" class="form-control" value="<?php echo $row['AMOUNTUSD']; ?>" id="angka1">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>Amount - SGD</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">$ SGD</span>
                                                                        </div>
                                                                        <input type="text" name="amountsgd" class="form-control" value="<?php echo $row['AMOUNTSGD']; ?>" id="angka2">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>AT COST</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Rp</span>
                                                                        </div>
                                                                        <input type="text" name="atcost" class="form-control" value="<?php echo $row['ATCOST']; ?>" id="angka3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Exchange Rate</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Rp</span>
                                                                        </div>
                                                                        <input type="text" name="exchange" class="form-control" value="<?php echo $row['EXCHANGERATE']; ?>" id="angka4">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Depreciation Rate</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">%</span>
                                                                        </div>
                                                                        <input type="text" name="deprrate" class="form-control" value="<?php echo $row['DEPRRATE']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center mb-2">
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Depreciation Cost</button>
                                                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Depresiation Cost</h5>
                                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-xll-20">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="table-responsive">
                                                                                                <table class="table table-hover table-responsive-sm">
                                                                                                    <thead class="thead-light">
                                                                                                        <tr>
                                                                                                            <th>Month</th>
                                                                                                            <th>Month Name</th>
                                                                                                            <th>At Cost</th>
                                                                                                            <th>Depr Per Month</th>
                                                                                                            <th>Accummulation</th>
                                                                                                            <th>Book Value</th>
                                                                                                            <th>Status</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php 
                                                                                                            $querydepr = oci_parse($conn, "SELECT ASSETCODE, 
                                                                                                                CASE SUBSTR(MONTHID, 5) WHEN '01' THEN 'January' WHEN '02' THEN 'February' WHEN '03' THEN 'March' WHEN '04' THEN 'April' WHEN '05' THEN 'May' 
                                                                                                                WHEN '06' THEN 'June' WHEN '07' THEN 'July' WHEN '08' THEN 'August' WHEN '09' THEN 'September' WHEN '10' THEN 'October' WHEN '11' THEN 'November' 
                                                                                                                WHEN '12' THEN 'December' END || ' ' || SUBSTR(MONTHID, 0, 4) AS MONTHNAME, ASDSTARTAMT, ASDDEPRAMT, ASDACCAMT, ASDBOOKVALUE , 
                                                                                                                MONTHID, ASDSTARTAMT, ASDDEPRAMT, ASDACCAMT, ASDBOOKVALUE , 
                                                                                                                CASE WHEN ASDSTATUS = 0 THEN 'ACTIVE' ELSE 'NON ACTIVE' END AS ASDSTATUS FROM TBLASSETDEPR 
                                                                                                                WHERE ASSETCODE = '".$ID."' ORDER BY MONTHID
                                                                                                                ");
                                                                                                            oci_execute($querydepr);
                                                                                                            while ($r = oci_fetch_array($querydepr)){
                                                                                                        ?>
                                                                                                            <tr>
                                                                                                                 <td><?php ECHO $r['MONTHID']?></td>
                                                                                                                 <td><?php ECHO $r['MONTHNAME']?></td>
                                                                                                                 <td><?php ECHO number_format($r['ASDSTARTAMT'])?></td>
                                                                                                                 <td><?php ECHO number_format($r['ASDDEPRAMT'])?></td>
                                                                                                                 <td><?php ECHO number_format($r['ASDACCAMT'])?></td>
                                                                                                                 <td><?php ECHO number_format($r['ASDBOOKVALUE'])?></td>
                                                                                                                 <td><?php ECHO $r['ASDSTATUS']?></td>
                                                                                                            </tr>
                                                                                                        <?php 
                                                                                                            }

                                                                                                        ?>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- /# card -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if ($role == "admin") {
                                                        ?>
                                                            <div id="v-pills-physical" class="tab-pane fade">
                                                            <fieldset class="form-group">
                                                                <div class="form-row">
                                                                    <label class="col-form-label col-sm-2 pt-0">Physical Check</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "None") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="None" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="None">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="Checking"> -->
                                                                            <label class="form-check-label">
                                                                                None
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "CHECKING") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="CHECKING" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="CHECKING">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="Checking"> -->
                                                                            <label class="form-check-label">
                                                                                Checking
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "NO CHECKING") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NO CHECKING" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NO CHECKING">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NoChecking"> -->
                                                                            <label class="form-check-label">
                                                                                No Checking
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "DEC NEW ITEM") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DEC NEW ITEM" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DEC NEW ITEM">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            <!-- <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DecNewItem"> -->
                                                                            <label class="form-check-label">
                                                                                Dec New Item
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "NOV NEW ITEM") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NOV NEW ITEM" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NOV NEW ITEM">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NovNewItem"> -->
                                                                            <label class="form-check-label">
                                                                                Nov New Item
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Action</label>
                                                                    <input type="text" class="form-control" placeholder="" name="PHYSICALACTION" autocomplete="off" value="<?php echo $row['PHYSICALACTION']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Remark</label>
                                                                    <input type="text" class="form-control" placeholder="" name="PHYSICALREMARK" autocomplete="off" value="<?php echo $row['PHYSICALREMARK']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            } elseif ($department == "AC") {
                                                        ?>
                                                                <div id="v-pills-physical" class="tab-pane fade">
                                                            <fieldset class="form-group">
                                                                <div class="form-row">
                                                                    <label class="col-form-label col-sm-2 pt-0">Physical Check</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "CHECKING") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="CHECKING" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="CHECKING">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="Checking"> -->
                                                                            <label class="form-check-label">
                                                                                Checking
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "NO CHECKING") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NO CHECKING" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NO CHECKING">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NoChecking"> -->
                                                                            <label class="form-check-label">
                                                                                No Checking
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "DEC NEW ITEM") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DEC NEW ITEM" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DEC NEW ITEM">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            <!-- <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DecNewItem"> -->
                                                                            <label class="form-check-label">
                                                                                Dec New Item
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "NOV NEW ITEM") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NOV NEW ITEM" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NOV NEW ITEM">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NovNewItem"> -->
                                                                            <label class="form-check-label">
                                                                                Nov New Item
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Action</label>
                                                                    <input type="text" class="form-control" placeholder="" name="PHYSICALACTION" autocomplete="off" value="<?php echo $row['PHYSICALACTION']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Remark</label>
                                                                    <input type="text" class="form-control" placeholder="" name="PHYSICALREMARK" autocomplete="off" value="<?php echo $row['PHYSICALREMARK']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            } else {
                                                        ?>
                                                                <div id="v-pills-physical" class="tab-pane fade active show">
                                                            <fieldset class="form-group">
                                                                <div class="form-row">
                                                                    <label class="col-form-label col-sm-2 pt-0">Physical Check</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "CHECKING") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="CHECKING" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="CHECKING">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="Checking"> -->
                                                                            <label class="form-check-label">
                                                                                Checking
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "NO CHECKING") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NO CHECKING" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NO CHECKING">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NoChecking"> -->
                                                                            <label class="form-check-label">
                                                                                No Checking
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "DEC NEW ITEM") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DEC NEW ITEM" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DEC NEW ITEM">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            <!-- <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DecNewItem"> -->
                                                                            <label class="form-check-label">
                                                                                Dec New Item
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <?php 
                                                                                if ($row['PHYSICALCHECK'] == "NOV NEW ITEM") {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NOV NEW ITEM" checked>
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                                <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NOV NEW ITEM">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                           <!--  <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NovNewItem"> -->
                                                                            <label class="form-check-label">
                                                                                Nov New Item
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Action</label>
                                                                    <input type="text" class="form-control" placeholder="" name="PHYSICALACTION" autocomplete="off" value="<?php echo $row['PHYSICALACTION']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Remark</label>
                                                                    <input type="text" class="form-control" placeholder="" name="PHYSICALREMARK" autocomplete="off" value="<?php echo $row['PHYSICALREMARK']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            }
                                                        ?>
                                                        
                                                        <div id="v-pills-settings" class="tab-pane fade">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Capex Acrotec</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetcapex" value="<?php echo $row['ASSETCAPEX']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>PIC</label>
                                                                    <select class="form-control" name="assetpic" id="assetpic"> 
                                                                        <option value="-">SELECT PIC</option>
                                                                        <?php
                                                                            include '../conn.php';
                                                                            $query =  oci_parse($conn, "SELECT DEPTCODE, DEPTCODE || ' - ' || DEPTNAME AS DEPTNAME FROM TBLDEPARTMENT");
                                                                            oci_execute($query);
                                                                            $X = $row['PIC'];
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
                                                                <div class="form-group col-md-6">
                                                                    <label>Project</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetproject" value="<?php echo $row['ASSETPROJECT']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

    <script src="../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="../../js/lib/moneyformat/jquery.maskMoney.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#angka1').maskMoney();
            $('#angka2').maskMoney();
            $('#angka3').maskMoney();
            $('#angka4').maskMoney();
            $('#angka5').maskMoney();
            $('#angka6').maskMoney();
        });
    </script>
    <script type="text/javascript">
        $($function(){
            $('[data-toggle="tooltip"]').tooltip();
        })
        $('#datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
        });
    </script>
    <script type="text/javascript">
        function update_pic() {
            var dept = document.getElementById("department").value;
            const result = document.getElementById("assetpic");
            result.value = dept;
        }
    </script>
</body>
</html>
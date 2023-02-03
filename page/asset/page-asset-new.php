<?php
    include '../../conn.php';
    session_start();

    if(!isset($_SESSION['username'])) {
        header('Location: ../../page-login.php');
    }

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
    <title>Dashboard - Entry Fixed Asset</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/tmi/minilogo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../../vendor/select2/css/select2.min.css">
    <link href="../../css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous">
    </script>
    <style type="text/css">
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
                    <li>
                        <a href="../../index.php" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Apps</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-app-store"></i><span class="nav-text">Transaction</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="page-asset.php">Fixed Asset</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span>
                        </a>
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
                <form method="post" action="new-asset-proses.php" enctype="multipart/form-data">
                    <div class="toolbar mb-2" role="toolbar">
                        <div class="btn-group mb-1">
                            <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Save" name="save">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </button>
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
                                       <img class="img-fluid" src="../../images/imag.png" alt="" width="110%" id="output_image" />
                                    </div>
                                    <br>
                                    <input type="file" id="edit_img" accept="image/*" name="uploadfoto" onchange="preview_image(event)">
                                    <label for="edit_img" class="btn btn-outline-primary" style="cursor: pointer; position: absolute; margin-left: 55px;">Browse</label>
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Asset Category</label>
                                            <select class="default-placeholder" id = "category" name="assetcategory" onchange="update_coa()">
                                                <option value="-">SELECT CATEGORY</option>
                                                <?php
                                                include '../conn.php';
                                                $q = oci_parse($conn, "SELECT CATCODE, CATCODE || ' - ' || CATNAME AS CATNAME FROM TBLCATASSET");
                                                oci_execute($q);
                                                while($r = oci_fetch_array($q)){
                                                ?>
                                                    <option value="<?php echo $r['CATCODE'] ?>"><?php echo $r['CATNAME'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Asset Code</label>
                                            <input type="text" class="form-control" placeholder="" name="assetcode" id="assetcode" autocomplete="off">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ROI No</label>
                                            <input type="text" class="form-control" placeholder="" name="roino" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Asset Name</label>
                                            <input type="text" class="form-control" placeholder="" name="assetname" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Asset Short Name</label>
                                            <input type="text" class="form-control" placeholder="" name="assetshortname" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Asset Date</label>
                                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="" name="assetdate" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value='<?php echo date('Y-m-d'); ?>'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
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
                                                        $q = oci_parse($conn, "SELECT DEPTCODE, DEPTCODE || ' - ' || DEPTNAME AS DEPTNAME FROM TBLDEPARTMENT");
                                                        oci_execute($q);

                                                        while($r = oci_fetch_array($q)){
                                                        ?>

                                                        <option value="<?php echo $r['DEPTCODE'] ?>"><?php echo $r['DEPTNAME'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Description</label>
                                                <input type="text" class="form-control" placeholder="" name="assetdesc" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                            </div>
                                            <div class="form-row align-items-center">
                                                <div class="form-group col-md-4">
                                                    <label>Quantity</label>
                                                    <input type="text" class="form-control" placeholder="" name="assetqty" id="qty" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label>Unit</label>
                                                    <select class="default-placeholder" name="assetunit">
                                                        <option value="-">SELECT UNIT</option>
                                                        <?php
                                                            include '../conn.php';
                                                            $q = oci_parse($conn, "SELECT UOM_CODE, UOM_CODE || ' - ' || UOM_NAME AS UOM_NAME FROM OM_UOM");
                                                            oci_execute($q);

                                                            while($r = oci_fetch_array($q)){
                                                            ?>

                                                            <option value="<?php echo $r['UOM_CODE'] ?>"><?php echo $r['UOM_NAME'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <!-- </div>
                                        <div class="form-row"> -->
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="form-group col-md-3">
                                                <label>Currency</label>
                                                <select class="default-placeholder" name="assetcurrency">
                                                    <option value="-">SELECT CURRENCY</option>
                                                    <?php
                                                    include '../conn.php';
                                                    $q = oci_parse($conn, "SELECT CURR_CODE, CURR_CODE || ' - ' || CURR_NAME AS CURR_NAME FROM FM_CURRENCY");
                                                    oci_execute($q);

                                                    while($r = oci_fetch_array($q)){
                                                    ?>
                                                        <option value="<?php echo $r['CURR_CODE'] ?>"><?php echo $r['CURR_NAME'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Useful Life (Year)</label>
                                                <input type="text" class="form-control" placeholder="" name="assetuseful" id="Useful" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-2">
                                                    <div class="nav flex-column nav-pills">
                                                        <a href="#v-pills-home" data-toggle="pill" class="nav-link active show">General</a>
                                                        <a href="#v-pills-profile" data-toggle="pill" class="nav-link">Coa</a>
                                                        <a href="#v-pills-messages" data-toggle="pill" class="nav-link">Cost</a>
                                                        <a href="#v-pills-physical" data-toggle="pill" class="nav-link">Physical Check</a>
                                                        <a href="#v-pills-settings" data-toggle="pill" class="nav-link">Other</a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-9">
                                                    <div class="tab-content">
                                                        <div id="v-pills-home" class="tab-pane fade active show">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Supplier</label>
                                                                    <select class="default-placeholder" name="assetsupplier">
                                                                        <option value="-">SELECT SUPPLIER</option>
                                                                        <?php
                                                                        include '../conn.php';
                                                                        $q = oci_parse($conn, "SELECT SUPP_CODE, SUPP_CODE || ' - ' || SUPP_NAME AS SUPP_NAME FROM FM_SUPPLIER");
                                                                        oci_execute($q);

                                                                        while($r = oci_fetch_array($q)){
                                                                        ?>

                                                                            <option value="<?php echo $r['SUPP_CODE'] ?>"><?php echo $r['SUPP_NAME'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Asset Form</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetform" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Model / Serial No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetmodel" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Ref No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetrefno" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>PO No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetpono" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Date of Purchase</label>
                                                                    <input type="date" class="form-control" value ="<?php echo date('Y-m-d');?>" placeholder="" name="assetpodate" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Transfer No</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assettransfer" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Remark</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetremark" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="v-pills-profile" class="tab-pane fade">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>COA Asset</label>
                                                                    <!-- <input type="text" class="form-control" name="coaasset" id="coaasset"> -->
                                                                    <select class="form-control" name="coaasset" id="coaasset">
                                                                        <option value="-">SELECT COA ASSET</option>
                                                                        <?php
                                                                        include '../conn.php';
                                                                        $q = oci_parse($conn, "SELECT MS_SUB_ACNT_CODE, MS_SUB_ACNT_CODE || ' - ' || MS_SUB_ACNT_NAME AS MS_SUB_ACNT_NAME FROM TMS.FM_MAIN_SUB");
                                                                        oci_execute($q);
                                                                        while($r = oci_fetch_array($q)){
                                                                        ?>

                                                                            <option value="<?php echo $r['MS_SUB_ACNT_CODE'] ?>"><?php echo $r['MS_SUB_ACNT_NAME'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <div id="select2-modal"></div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Coa Depreciation</label>
                                                                    <select class="form-control" name="coadepr" id="coadepr">
                                                                        <option value="-">SELECT COA DEPR</option>
                                                                        <?php
                                                                        include '../conn.php';
                                                                        $q = oci_parse($conn, "SELECT MS_SUB_ACNT_CODE, MS_SUB_ACNT_CODE || ' - ' || MS_SUB_ACNT_NAME AS MS_SUB_ACNT_NAME FROM TMS.FM_MAIN_SUB");
                                                                        oci_execute($q);

                                                                        while($r = oci_fetch_array($q)){
                                                                        ?>

                                                                            <option value="<?php echo $r['MS_SUB_ACNT_CODE'] ?>"><?php echo $r['MS_SUB_ACNT_NAME'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Coa Depreciation Exp</label>
                                                                    <input type="text" class="form-control" placeholder="" name="coadprexp" id="coadprexp" autocomplete="off" >
                                                                    <!-- <select class="form-control" name="coadprexp" id="coadprexp">
                                                                        <option value="-">SELECT DEPR EXP</option>
                                                                        <?php
                                                                        include '../conn.php';
                                                                        $q = oci_parse($conn, "SELECT MS_SUB_ACNT_CODE, MS_SUB_ACNT_CODE || ' - ' || MS_SUB_ACNT_NAME AS MS_SUB_ACNT_NAME FROM TMS.FM_MAIN_SUB");
                                                                        oci_execute($q);

                                                                        while($r = oci_fetch_array($q)){
                                                                        ?>

                                                                            <option value="<?php echo $r['MS_SUB_ACNT_CODE'] ?>"><?php echo $r['MS_SUB_ACNT_NAME'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select> -->
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
                                                                        <input type="text" class="form-control" name="amountusd" value="0.00" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''" id="angka1">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Amount - SGD</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">$ SGD</span>
                                                                        </div>
                                                                        <input type="text" class="form-control" name="amountsgd" value="0.00" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''" id="angka2">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>AT COST</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Rp</span>
                                                                        </div>
                                                                        <input type="text" class="form-control" name="atcost" value="0.00" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''" id="angka3">
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
                                                                        <input type="text" class="form-control" name="exchange" value="1.00" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''" id="angka4">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Depreciation Rate</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">%</span>
                                                                        </div>
                                                                        <input type="text" class="form-control" name="deprrate" value="0" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                        <div id="v-pills-physical" class="tab-pane fade">
                                                            <fieldset class="form-group">
                                                                <div class="form-row">
                                                                    <label class="col-form-label col-sm-2 pt-0">Physical Check</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="None" checked>
                                                                            <label class="form-check-label">
                                                                                None
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="CHECKING">
                                                                            <label class="form-check-label">
                                                                                CHECKING
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NO CHECKING">
                                                                            <label class="form-check-label">
                                                                                NO CHECKING
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="DEC NEW ITEM">
                                                                            <label class="form-check-label">
                                                                                DEC NEW ITEM
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="PHYSICALCHECK" value="NOV NEW ITEM">
                                                                            <label class="form-check-label">
                                                                                NOV NEW ITEM
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Action</label>
                                                                    <input type="text" class="form-control" placeholder="" name="PHYSICALACTION" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Remark</label>
                                                                    <input type="text" class="form-control" placeholder="" name="PHYSICALREMARK" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="v-pills-settings" class="tab-pane fade">
                                                            <!-- <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>No NBV</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetnbv" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>
                                                            </div> -->
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Capex Acrotec</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetcapex" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>PIC</label>
                                                                    <select class="form-control" name="assetpic" id="assetpic"> 
                                                                        <option value="-">SELECT PIC</option>
                                                                        <?php
                                                                            include '../conn.php';
                                                                            $q = oci_parse($conn, "SELECT DEPTCODE, DEPTCODE || ' - ' || DEPTNAME AS DEPTNAME FROM TBLDEPARTMENT");
                                                                            oci_execute($q);

                                                                            while($r = oci_fetch_array($q)){
                                                                            ?>

                                                                            <option value="<?php echo $r['DEPTCODE'] ?>"><?php echo $r['DEPTNAME'] ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Project</label>
                                                                    <input type="text" class="form-control" placeholder="" name="assetproject" autocomplete="off" onkeyup="if ( event.keyCode == 27 ) this.value=''">
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
    <script>
        $($function(){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
    <script type="text/javascript">
        function update_pic() {
            var dept = document.getElementById("department").value;
            const result = document.getElementById("assetpic");
            result.value = dept;
        }

        function update_coa() {
            var cat = document.getElementById("category").value;    
            
            if (cat == "LD") {

                <?php 
                    $assetcategory = "LD";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>
                
                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25010";
                document.getElementById("coadepr").value = "26010";
                document.getElementById("coadprexp").value = "-";
                // document.getElementById("assetcode").value = "-";

                result.value = data;
            }
            if (cat == "RN") {

                <?php 
                    $assetcategory = "RN";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25030";
                document.getElementById("coadepr").value = "26030";
                document.getElementById("coadprexp").value = "70055";
                result.value = data;
            } 
            if (cat == "GE") {

                <?php 
                    $assetcategory = "GE";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25070";
                document.getElementById("coadepr").value = "26070";
                document.getElementById("coadprexp").value = "64114";
                result.value = data;
            } 
            if (cat == "MV") {

                <?php 
                    $assetcategory = "MV";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25100";
                document.getElementById("coadepr").value = "26100";
                document.getElementById("coadprexp").value = "70058";
                result.value = data;
            } 
            if (cat == "EL") {

                <?php 
                    $assetcategory = "EL";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25040";
                document.getElementById("coadepr").value = "26040";
                document.getElementById("coadprexp").value = "70031";
                result.value = data;
            } 
            if (cat == "MC") {

                <?php 
                    $assetcategory = "MC";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25050";
                document.getElementById("coadepr").value = "26050";
                document.getElementById("coadprexp").value = "64112";
                result.value = data;
            } 
            if (cat == "MF") {

                <?php 
                    $assetcategory = "MF";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25060";
                document.getElementById("coadepr").value = "26060";
                document.getElementById("coadprexp").value = "64113";
                result.value = data;
            } 
            if (cat == "OE") {

                <?php 
                    $assetcategory = "OE";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25080";
                document.getElementById("coadepr").value = "26080";
                document.getElementById("coadprexp").value = "70056";
                result.value = data;
            } 
            if (cat == "FF") {

                <?php 
                    $assetcategory = "FF";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25090";
                document.getElementById("coadepr").value = "26090";
                document.getElementById("coadprexp").value = "70057";
                result.value = data;
            } 
            if (cat == "CP") {

                <?php 
                    $assetcategory = "CP";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25110";
                document.getElementById("coadepr").value = "26110";
                document.getElementById("coadprexp").value = "70059";
                result.value = data;
            } 
            if (cat == "BD") {

                <?php 
                    $assetcategory = "BD";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                document.getElementById("coaasset").value = "25020";
                document.getElementById("coadepr").value = "26020";
                document.getElementById("coadprexp").value = "70054";
                result.value = data;
            } 
            if (cat == "VH") {

                <?php 
                    $assetcategory = "VH";
                    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $assetcategory . "'");
                    oci_execute($getlastcode);
                    $data = oci_fetch_array($getlastcode);
                    $code = $data['ASSETCODE'];
                    $Lenghtcode = strlen($assetcategory);
                    $last = (int) substr($code, $Lenghtcode);
                    $last++;
                    $assetcode = $assetcategory . sprintf("%04s", $last);    
                ?>

                const data = "<?php echo $assetcode; ?>";
                const result = document.getElementById("assetcode");
                // document.getElementById("coaasset").value = "25020";
                // document.getElementById("coadepr").value = "26020";
                // document.getElementById("coadprexp").value = "70054";
                result.value = data;
            } 
        } 
    </script>
</body>
</html>
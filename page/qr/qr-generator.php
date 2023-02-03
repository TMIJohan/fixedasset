<?php require 'vendor/autoload.php'; ?>
<?php require 'phpqrcode/qrlib.php'; ?>
<?php
    include '../../conn.php';

    session_start();

    if(!isset($_SESSION['username'])) {
        header('Location: ../../page-login.php');
    }


    $assetcode = "";
    if (isset($_POST["btnsubmit"])) {
        $assetcode = $_POST['barcodeasset'];
    }


    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    function add_space($string){
        $ns = "";
        foreach(str_split($string) as $k=> $v){
            if($k != 0) $ns .=" ";
            $ns .= $v; 
        }
        return $ns;
    }
    if(!is_dir('qr_temp/')) mkdir('qr_temp/');
    $tempDir = 'qr_temp/'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Entry Department</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/tmi/minilogo.png">
    <!-- Custom Stylesheet -->
    <link href="../../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../vendor/select2/css/select2.min.css">
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Barcode Generator</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form autocomplete="off" action="qr-generator.php" method="post">
                                    <div class="form-group">
                                        <div class="form-group col-md-12">
                                            <label>Barcode Asset</label>
                                            <select class="default-placeholder" name="barcodeasset">
                                                <option value="-">Select Code Asset</option>
                                                <?php
                                                    if ($assetcode == "") {
                                                            $q = oci_parse($conn, "SELECT ASSETCODE, ASSETCODE || ' - ' || ASSETNAME AS ASSETNAME 
                                                            FROM TBLASSET ORDER BY ASSETCODE ASC");
                                                            oci_execute($q);
                                                            while($r = oci_fetch_array($q)){
                                                                ?>
                                                                <option value="<?php echo $r['ASSETCODE'] ?>"><?php echo $r['ASSETNAME'] ?></option>
                                                                <?php
                                                            }
                                                        }  else {
                                                                $query =  oci_parse($conn, "SELECT ASSETCODE, ASSETCODE || ' - ' || ASSETNAME AS ASSETNAME 
                                                                FROM TBLASSET ORDER BY ASSETCODE ASC");
                                                                oci_execute($query);
                                                                $X = $assetcode;
                                                                while($data = oci_fetch_array($query)){
                                                                $Y = "";
                                                                if(isset($_POST['barcodeasset'])){
                                                                    if($X==$data['ASSETCODE']){
                                                                        $Y="SELECTED";
                                                                    }
                                                                }
                                                            ?>
                                                                <option <?php echo $Y; ?> value="<?php echo oci_result($query, "ASSETCODE");?>"><?php echo oci_result($query, "ASSETNAME");?></option>
                                                            <?php
                                                            }
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text-right col-md-12">
                                            <a href="../../index.php" class="btn btn-outline-secondary">Back</a>
                                            <!-- <a href="javascript:void()" class="btn btn-outline-secondary" name="btnsubmit">Generate</a> -->
                                            <button class="btn btn-outline-secondary" name="btnsubmit">Generate</button>
                                        </div>
                                    </div>    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="container-fluid" id="outprint">
                                    <style>
                                        .text-justify{
                                            text-align:center;
                                            font-size:0.5em;
                                        }
                                        /*.barcode{
                                            width:80%;
                                            height:4.5em;
                                        }*/
                                        .qrcode{
/*                                            margin-left: 30px;*/
                                            width:50%;
                                            height:auto;
                                        }
                                        .text{
                                            text-align: center;
                                            font-size: 3;
                                            word-wrap: break-word;
/*                                            margin-left: 60px;*/
                                        }
                                        /*.table{
                                            border: 1 solid red;
                                        }*/
                                        .btnprint{
                                            margin-left: 80px;
                                        }
                                    </style>
                                <?php 
                                $query = oci_parse($conn, "SELECT ASSETCODE, ASSETCODE || ' - ' || ASSETNAME AS ASSETNAME FROM TBLASSET WHERE ASSETCODE = '".$assetcode."'");
                                oci_execute($query);
                                while($row = oci_fetch_assoc($query)):
                                        if(!is_file('qr_temp/'.$row['ASSETCODE'].'.png'))
                                        QRcode::png($row['ASSETNAME'], $tempDir.''.$row['ASSETCODE'].'.png', QR_ECLEVEL_L, 5);
                                ?>
                                <table border="1px solid">
                                    <tr>
                                        <td align="center" valign="top">
                                            <img src="<?= $tempDir.$row['ASSETCODE'].'.png' ?>" class="img-fluid qrcode" alt="">
                                            <br>
                                            <div class="text">Asset No: <?= $row['ASSETCODE'] ?></div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <div class="my-1" style="border-top:2px dashed; width: 350px;"></div> -->
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="btnprint">
                            <button class="btn btn-outline-secondary" name="btnprint" id="print">
                                <i class="fa fa-print"></i>Print Barcode
                            </button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br>
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
    <script>
        $(function(){
            $('#print').click(function(){
                var _h = $('head').clone()
                var _p = $('#outprint').clone();
                var _el = $('<div>')
                _h.find("title").text("Print View")
                _el.append(_h)
                _el.append(_p)
                var nw = window.open('','_blank','width=900,heigth=700,top=200,left=300')
                nw.document.write(_el.html())
                nw.document.close()
                // setTimeout(() => {
                    nw.print()
                    // setTimeout(() => {
                        nw.close()
                    // }, 500);
                // }, 750);
                
            })
        })
    </script>
</body>
</html>
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
    <title>Dashboard - Disposal Asset </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/tmi/minilogo.png">
    <!-- Datatable -->
    <link href="../../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../../vendor/select2/css/select2.min.css">
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
                            <li><a href="../transfer/page-transfer.php">Transfer Asset</a></li>
                            <li><a href="./page-disposal.php">Disposal Asset</a></li>
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h3>Disposal Asset</h3>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <?php
                             if ($role == "admin") {
                        ?>
                            <div class="toolbar mb-2" role="toolbar">
                                <!-- <div class="btn-group mb-1">
                                    <a href="page-transfer-new.php">
                                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="New">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </div> -->
                                <div class="btn-group mb-1">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modaladd" title="New"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                    <div class="modal fade" id="modaladd">
                                    	<form method="post" action="disposal-modal.php">
                                    		<div class="modal-dialog" role="document">
	                                            <div class="modal-content">
	                                                <!-- <div class="modal-header">
	                                                    <h5 class="modal-title"></h5>
	                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
	                                                    </button>
	                                                </div> -->
	                                                <div class="modal-body">
	                                                	<div class="form-group col-md-12">
	                                                		<label>Choose Asset Code</label>
	                                                		<select class="default-placeholder" name="ASSETCODE">
	                                                    		<option value="-">SELECT ASSET</option>
			                                                    <?php
			                                                    $q = oci_parse($conn, "SELECT ASSETCODE, ASSETCODE || ' - ' || ASSETSHORTNAME AS ASSETNAME FROM TBLASSET");
			                                                    oci_execute($q);
			                                                    while($r = oci_fetch_array($q)){
			                                                    ?>
			                                                        <option value="<?php echo $r['ASSETCODE'] ?>"><?php echo $r['ASSETNAME'] ?></option>
			                                                    <?php
			                                                    }
			                                                    ?>
			                                                </select>
	                                            		</div>
	                                                </div>
	                                                <div class="modal-footer">
	                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                                                    <button type="submit" class="btn btn-primary" name="btndisposal">Add Disposal</button>
	                                                </div>
	                                            </div>
	                                        </div>
                                    	</form>
                                    </div>
                                </div>
                                <div class="btn-group mb-1">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalprint" title="New"><i class="fa fa-print" aria-hidden="true"></i></button>
                                    <div class="modal fade" id="modalprint">
                                        <form method="post" action="print.php">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Print Form Disposal</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group col-md-12">
                                                            <label>Choose Asset Code</label>
                                                            <select class="default-placeholder" name="DisposalCode">
                                                                <option value="-">SELECT ASSET</option>
                                                                <?php
                                                                $q = oci_parse($conn, "SELECT TBLINV.INVCODE, TBLINV.ASSETCODE || ' - ' || ASSETSHORTNAME AS ASSETNAME FROM TBLASSET
                                                                    INNER JOIN TBLINV ON TBLASSET.ASSETCODE = TBLINV.ASSETCODE
                                                                    WHERE INVTYPE = 'DISPOSAL' AND TBLINV.DELETED = 0
                                                                    ORDER BY TBLINV.ASSETCODE 
                                                                    ");
                                                                oci_execute($q);
                                                                while($r = oci_fetch_array($q)){
                                                                ?>
                                                                    <option value="<?php echo $r['INVCODE'] ?>"><?php echo $r['ASSETNAME'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="btndisposal">Print</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            } else {
                        ?>
                            <div class="toolbar mb-2" role="toolbar">
                                <div class="btn-group mb-1">
                                    <a href="page-asset-new.php">
                                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="New" disabled>
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="btn-group mb-1">
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Print Report" disabled>
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="btn-group mb-1">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" title="Import Asset" data-target="#basicModal" disabled>
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </button>
                                    <div class="modal fade" id="basicModal">
                                        <div class="modal-dialog" role="document">
                                            <form action="import-asset-proses.php" method="post", enctype="multipart/form-data">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Import Fixed Asset</h5>
                                                        <button type="button" class="close" data-dismiss="modal" disabled><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label>Pilih file :</label>
                                                        <input type="file" name="fileimport">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="import">Import</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 1000px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Disposal Code</th>
                                                <th>Asset Code</th>
                                                <th>Disposal Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                    $q = oci_parse($conn, "SELECT TBLINV.INVCODE, TBLINV.ASSETCODE, TBLINV.INVDATE 
														FROM TBLINV 
														INNER JOIN TBLASSET ON TBLINV.ASSETCODE = TBLASSET.ASSETCODE WHERE TBLINV.DELETED = 0 AND INVTYPE = 'DISPOSAL' 
														ORDER BY TBLINV.INVDATE ASC
                                                    ");
                                                oci_execute($q);
                                                While ($r = oci_fetch_array($q)){
                                                    ?>
                                                        <tr>
                                                            <td><?php ECHO $no++;?></td>
                                                            <td><?php ECHO $r['INVCODE']?></td>
                                                            <td><?php ECHO $r['ASSETCODE'];?></td>
                                                            <td><?php ECHO $r['INVDATE']?></td>
                                                            <td>
                                                                <div class="btn-group mb-1">
                                                                    <a href="page-disposal-edit.php?id=<?php echo $r['INVCODE']; ?>">
                                                                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Edit">
                                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <?php
                                                                if ($role == "admin") {
                                                                ?>
                                                                    <div class="btn-group mb-1">
                                                                        <a href="page-disposal-delete.php?id=<?php echo $r['INVCODE']; ?>" class="btndelete">
                                                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Hapus">
                                                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                <?php
                                                                    } else {
                                                                ?>
                                                                    <div class="btn-group mb-1">
                                                                        <a href="page-transfer-delete.php?id=<?php echo $r['INVCODE']; ?>" class="btndelete">
                                                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" title="Hapus" disabled>
                                                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                <?php
                                                                    }
                                                                ?>
                                                                <!-- <a href="page-asset-edit.php?id=<?php echo $r['ASSETCODE']; ?>"> EDIT </a>&nbsp;&nbsp;
                                                                <a href="page-asset-delete.php?id=<?php echo $r['ASSETCODE']; ?>"> HAPUS </a> -->
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
    <script src="../../other/jquery-3.6.1.min.js"></script>
    <script src="../../other/sweetalert2.all.min.js"></script>
    <script src="../../vendor/select2/js/select2.full.min.js"></script>
    <script src="../../js/plugins-init/select2-init.js"></script>
    <script>
        $('.btndelete').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title : 'Are You Sure?',
                text : 'Record will be deleted?',
                icon : 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#dd3333',
                confirmButtonText: 'Delete Record',
            }).then((result) => {
                if(result.value) {
                    document.location.href = href;
                }
            })
        })
    </script>
</body>
</html>
<?php
	include '../../conn.php';

	session_start();
	$username = $_SESSION['username'];
    $role  = $_SESSION['role'];
    $department  = $_SESSION['department'];

    if (isset($_POST['save'])) {
    	$TransferCode = $_POST['TransferCode'];
    	$ASSETCODE = $_POST['ASSETCODE'];
    	$TransferDate = $_POST['TransferDate'];
    	$TransferYear = $_POST['TransferYear'];
    	$TransferDesc = $_POST['TransferDesc'];
    	$TransferSerial = $_POST['TransferSerial'];
    	$TransferModel = $_POST['TransferModel'];
    	$TransferFrom = $_POST['TransferFrom'];
    	$TransferTo = $_POST['TransferTo'];


        $query = oci_parse($conn, "UPDATE TBLINV SET YEAR = DATE'".$TransferYear."',  TRANSFERTO = '".$TransferTo."', INVDESC = '".$TransferDesc."',
            INVSERIAL = '".$TransferSerial."', INVMODEL = '".$TransferModel."' WHERE INVCODE = '".$TransferCode."'");

    	$result = oci_execute($query);
    	if ($result) {
    		$queryupdate = oci_parse($conn, "UPDATE TBLASSET SET ASSETLOC = '".$TransferTo."' WHERE ASSETCODE = '".$ASSETCODE."'");
    		oci_execute($queryupdate);
    		echo "<script type='text/javascript'>alert('Success!');document.location='page-transfer.php'</script>";
    	} else {
    		echo "<script type='text/javascript'>alert('Error !');document.location='page-transfer.php'</script>";
    	}

    }
?>
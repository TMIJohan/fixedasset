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


    	$query = oci_parse($conn, "INSERT INTO TBLINV(INVCODE, ASSETCODE, INVTYPE, INVDATE, INVDESC, INVSERIAL, INVMODEL, YEAR, TRANFERFROM, TRANSFERTO) 
    		VALUES('".$TransferCode."', '".$ASSETCODE."', 'TRANSFER', DATE'".$TransferDate."', '".$TransferDesc."', '".$TransferSerial."', '".$TransferModel."', 
    			DATE'".$TransferYear."', '".$TransferFrom."', '".$TransferTo."')");
    	$result = oci_execute($query);
    	if ($result) {
    		$queryupdate = oci_parse($conn, "UPDATE TBLASSET SET TRANSFERCD = '".$TransferCode."', ASSETLOC = '".$TransferTo."' WHERE ASSETCODE = '".$ASSETCODE."'");
    		oci_execute($queryupdate);
    		echo "<script type='text/javascript'>alert('Success!');document.location='page-transfer.php'</script>";
    	} else {
    		echo "<script type='text/javascript'>alert('Error !');document.location='page-transfer-new.php'</script>";
    	}

    }
?>
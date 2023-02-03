<?php
	include '../../conn.php';

	session_start();
	$username = $_SESSION['username'];
    $role  = $_SESSION['role'];
    $department  = $_SESSION['department'];

    if (isset($_POST['save'])) {
    	$DisposalCode = $_POST['DisposalCode'];
    	$ASSETCODE = $_POST['ASSETCODE'];
    	$DisposalDate = $_POST['DisposalDate'];
    	$DisposalYear = $_POST['DisposalYear'];
    	$DisposalDesc = $_POST['DisposalDesc'];
    	$DisposalSerial = $_POST['DisposalSerial'];
    	$DisposalModel = $_POST['DisposalModel'];
    	$AssetLoc = $_POST['AssetLoc'];
        $DisposalReason = $_POST['DisposalReason'];


    	$query = oci_parse($conn, "INSERT INTO TBLINV(INVCODE, ASSETCODE, INVTYPE, INVDATE, INVDESC, INVSERIAL, INVMODEL, YEAR, TRANFERFROM, REASON) 
    		VALUES('".$DisposalCode."', '".$ASSETCODE."', 'DISPOSAL', DATE'".$DisposalDate."', '".$DisposalDesc."', '".$DisposalSerial."', '".$DisposalModel."', 
    			DATE'".$DisposalYear."', '".$AssetLoc."', '".$DisposalReason."')");
    	$result = oci_execute($query);
    	if ($result) {
    		$queryupdate = oci_parse($conn, "UPDATE TBLASSET SET DISPOSAL = 1 WHERE ASSETCODE = '".$ASSETCODE."'");
    		oci_execute($queryupdate);
    		echo "<script type='text/javascript'>alert('Success!');document.location='page-disposal.php'</script>";
    	} else {
    		echo "<script type='text/javascript'>alert('Error !');document.location='page-disposal-new.php'</script>";
    	}

    }
?>
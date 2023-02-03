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


        $query = oci_parse($conn, "UPDATE TBLINV SET YEAR = DATE'".$DisposalYear."', REASON = '".$DisposalReason."', INVDESC = '".$DisposalDesc."',
            INVSERIAL = '".$DisposalSerial."', INVMODEL = '".$DisposalModel."' WHERE INVCODE = '".$DisposalCode."'");

    	$result = oci_execute($query);
    	if ($result) {
    		echo "<script type='text/javascript'>alert('Success!');document.location='page-disposal.php'</script>";
    	} else {
    		echo "<script type='text/javascript'>alert('Error !');document.location='page-disposal.php'</script>";
    	}

    }
?>
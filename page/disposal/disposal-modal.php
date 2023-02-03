<?php
	include '../../conn.php';
	session_start();
	$username = $_SESSION['username'];
    $role  = $_SESSION['role'];
    $department  = $_SESSION['department'];

    if (isset($_POST['btndisposal'])) {
    	$assetcode = $_POST['ASSETCODE'];

        $transfer = "D";
        $getlastcode = oci_parse($conn, "SELECT MAX(INVCODE) AS INVCODE FROM TBLINV WHERE INVTYPE = 'DISPOSAL'");
        oci_execute($getlastcode);
        $data = oci_fetch_array($getlastcode);
        $code = $data['INVCODE'];
        $Lenghtcode = strlen($transfer);
        $last = (int) substr($code, $Lenghtcode);
        $last++;
        $disposalcode = $transfer . sprintf("%04s", $last);    

    	header('Location: page-disposal-new.php?id='.$assetcode.'&disposalno='.$disposalcode);
    }
?>
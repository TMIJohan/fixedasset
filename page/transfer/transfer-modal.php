<?php
	include '../../conn.php';
	session_start();
	$username = $_SESSION['username'];
    $role  = $_SESSION['role'];
    $department  = $_SESSION['department'];

    if (isset($_POST['btntransfer'])) {
    	$assetcode = $_POST['ASSETCODE'];

        $transfer = "TR";
        $getlastcode = oci_parse($conn, "SELECT MAX(INVCODE) AS INVCODE FROM TBLINV WHERE INVTYPE = 'TRANSFER'");
        oci_execute($getlastcode);
        $data = oci_fetch_array($getlastcode);
        $code = $data['INVCODE'];
        $Lenghtcode = strlen($transfer);
        $last = (int) substr($code, $Lenghtcode);
        $last++;
        $tranfercode = $transfer . sprintf("%04s", $last);    

    	header('Location: page-transfer-new.php?id='.$assetcode.'&transferno='.$tranfercode);
    }
?>
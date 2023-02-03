<?php
include '../../conn.php';

    $id = $_GET['id'];
    $query = oci_parse($conn, "SELECT ASSETCODE FROM TBLINV WHERE INVCODE = '".$id."'");
    oci_execute($query);
    $row = oci_fetch_array($query);

    $ASSETCODE = $row['ASSETCODE'];


    $querytransfer = oci_parse($conn, "UPDATE TBLINV SET DELETED = 1 WHERE INVCODE = '".$id."' ");
    $result = oci_execute($querytransfer);

    if ($result){
    	$queryasset = oci_parse($conn, "UPDATE TBLASSET SET TRANSFERCD = '' WHERE ASSETCODE = '".$ASSETCODE."'");
        echo "<script type='text/javascript'>document.location='page-transfer.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error !');document.location='page-transfer.php'</script>";
    }
?>
<?php
include '../../conn.php';

    $id = $_GET['id'];
    $query = oci_parse($conn, "DELETE FROM TBLASSET WHERE ASSETCODE = '".$id."'");
    $asset = oci_execute($query);

    if($asset){
        $assetdepr = oci_parse($conn, "DELETE FROM TBLASSETDEPR WHERE ASSETCODE = '".$id."'");
        $result = oci_execute($assetdepr);
    }

    if ($result){
        //oci_commit($koneksi);
        echo "<script type='text/javascript'>document.location='page-asset.php'</script>";
    } else {
        //oci_rollback($koneksi);
        echo "<script type='text/javascript'>alert('Error !');document.location='page-asset.php'</script>";
    }
?>
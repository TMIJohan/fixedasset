<?php
include '../../conn.php';

    $id = $_GET['id'];
    $query = oci_parse($conn, "DELETE FROM TBLCATASSET WHERE CATCODE = '".$id."'");

    $result = oci_execute($query);

    if ($result){
        //oci_commit($koneksi);
        echo "<script type='text/javascript'>document.location='page-cat-asset.php'</script>";
    } else {
        //oci_rollback($koneksi);
        echo "<script type='text/javascript'>alert('Error !');document.location='page-cat-asset.php'</script>";
    }
?>
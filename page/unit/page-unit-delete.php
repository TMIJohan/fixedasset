<?php
    include '../../conn.php';
    $ID = $_GET['id'];

    $q = oci_parse($conn, "DELETE FROM OM_UOM WHERE UOM_CODE='" . $ID . "'");
    $r = oci_execute($q);

    if ($r){
        echo "<script type='text/javascript'>alert('DATA DELETED !');document.location='page-unit.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('ERROR !');document.location='page-unit-edit.php'</script>";
    }
?>
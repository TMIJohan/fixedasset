<?php
include '../../conn.php';

if(isset($_POST['save'])){
    $uomcode = $_POST['uomcode'];
    $uomname = $_POST['uomname'];
    $uomshort = $_POST['uomshort'];
    $maxloose = $_POST['maxloose'];

    $q = oci_parse($conn, "UPDATE OM_UOM SET UOM_NAME = '" . $uomname . "', UOM_SHORT_NAME = '" . $uomshort . "', UOM_MAX_LOOSE = " . $maxloose . "
     WHERE UOM_CODE = '" . $uomcode . "' ");

    $r = oci_execute($q);
    if ($r){
        echo "<script type='text/javascript'>alert('DATA UPDATE SUCCESSFULLY !');document.location='page-unit.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('ERROR !');document.location='page-unit-edit.php'</script>";
    }
}
?>
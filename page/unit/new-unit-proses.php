<?php
include '../../conn.php';

if(isset($_POST['save'])){
    $uomcode = $_POST['uomcode'];
    $uomname = $_POST['uomname'];
    $uomshort = $_POST['uomshort'];
    $maxloose = $_POST['maxloose'];

    $q = oci_parse($conn, "INSERT INTO OM_UOM(UOM_CODE, UOM_NAME, UOM_SHORT_NAME, UOM_MAX_LOOSE)
    VALUES('".$uomcode."', '".$uomname."', '".$uomshort."', ".$maxloose.")");

    $r = oci_execute($q);
    if ($r){
        echo "<script type='text/javascript'>alert('DATA UPDATE SUCCESSFULLY !');document.location='page-unit.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('ERROR !');document.location='page-unit-new.php'</script>";
    }
}
?>
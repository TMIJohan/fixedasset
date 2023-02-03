<?php
include '../../conn.php';

if(isset($_POST['save'])){
    $SUPPCODE = $_POST['SUPPCODE'];
    $SUPPNAME = $_POST['SUPPNAME'];
    $SUPPSHORTNAME = $_POST['SUPPSHORTNAME'];

    $q = oci_parse($conn, "UPDATE TBLSUPPLIER SET SUPPNAME = '".$SUPPNAME."', SUPPSHORTNAME = '".$SUPPSHORTNAME."'
     WHERE SUPPCODE = '" . $SUPPCODE . "' ");

    $r = oci_execute($q);
    if ($r){
        echo "<script type='text/javascript'>alert('DATA UPDATE SUCCESSFULLY !');document.location='page-supplier.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('ERROR !');document.location='page-supplier-edit.php'</script>";
    }
}
?>
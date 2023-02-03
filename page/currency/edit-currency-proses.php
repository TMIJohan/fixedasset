<?php
include '../../conn.php';

if(isset($_POST['save'])){
    $curr_code          = $_POST['curr_code'];
    $curr_iso_code      = $_POST['curr_iso_code'];
    $curr_name          = $_POST['curr_name'];
    $curr_short_name    = $_POST['curr_short_name'];
    $curr_unit_name     = $_POST['curr_unit_name'];
    $curr_short_unit_name = $_POST['curr_short_unit_name'];
    $curr_fmt_mask      = $_POST['curr_fmt_mask'];
    $curr_decimal       = $_POST['curr_decimal'];

    $q = oci_parse($conn, "UPDATE FM_CURRENCY SET CURR_ISO_CODE = '".$curr_iso_code."', CURR_NAME = '". $curr_name ."',
    CURR_SHORT_NAME = '" .$curr_short_name ."', CURR_UNIT_NAME = '".$curr_unit_name."', CURR_SHORT_UNIT_NAME = '".$curr_short_unit_name."',
    CURR_FMT_MASK = '".$curr_fmt_mask."', CURR_DECIMAL = ".$curr_decimal." WHERE CURR_CODE = '" . $curr_code . "'");


    $r = oci_execute($q);
    if ($r){
        echo "<script type='text/javascript'>alert('DATA UPDATE SUCCESSFULLY !');document.location='page-currency.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('ERROR !');document.location='page-currency-edit.php'</script>";
    }
}
?>
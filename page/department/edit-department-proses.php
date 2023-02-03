<?php
include '../../conn.php';

if(isset($_POST['save'])){
    $deptcode = $_POST['deptcode'];
    $deptname = $_POST['deptname'];

    $q = oci_parse($conn, "UPDATE TBLDEPARTMENT SET DEPTNAME = '" . $deptname . "' 
     WHERE DEPTCODE = '" . $deptcode . "' ");

    $r = oci_execute($q);

    if ($r){
        echo "<script type='text/javascript'>alert('DATA UPDATE SUCCESSFULLY !');document.location='page-department.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('ERROR !');document.location='page-department-edit.php'</script>";
    }
}
?>
<?php
    include '../../conn.php';
    $ID = $_GET['id'];

    $q = oci_parse($conn, "DELETE FROM TBLDEPARTMENT WHERE DEPTCODE='" . $ID . "'");
    $r = oci_execute($q);

    if ($r){
        echo "<script type='text/javascript'>alert('DATA DELETED !');document.location='page-department.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('ERROR !');document.location='page-department.php'</script>";
    }


?>
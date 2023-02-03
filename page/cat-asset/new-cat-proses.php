<?php
include '../../conn.php';

if(isset($_POST['save'])){
    $CATCODE = $_POST['CATCODE'];
    $CATNAME = $_POST['CATNAME'];

    
    $check = oci_parse($conn, "SELECT COUNT(CATCODE) AS CATCODE FROM TBLCATASSET WHERE CATCODE = '".$CATCODE."'");
    oci_execute($check);
    while ($resultcheck = oci_fetch_array($check)){

        if ($resultcheck['CATCODE'] == 0) {
            
            $q = oci_parse($conn, "INSERT INTO TBLCATASSET(CATCODE, CATNAME)
             VALUES('".$CATCODE."', '".$CATNAME."')");

             $r = oci_execute($q);

             if ($r){
                 echo "<script type='text/javascript'>alert('SUCCESS !');document.location='page-cat-asset.php'</script>";
             } else {
                 echo "<script type='text/javascript'>alert('ERROR !');document.location='page-cat-new.php'</script>";
             } 
        } else {
              echo "<script type='text/javascript'>alert('Duplicate Asset Code !');document.location='page-cat-new.php'</script>";   
        }
    }
}
?>
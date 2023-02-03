<?php
include '../../conn.php';

if(isset($_POST['save'])){
    $SUPPNAME = $_POST['SUPPNAME'];
    $SUPPSHORTNAME = $_POST['SUPPSHORTNAME'];

        //proses auto kode

        $supp = substr($SUPPNAME, 0, 1);
        $getlastcode = oci_parse($conn, "SELECT MAX(SUPPCODE) AS SUPPCODE FROM TBLSUPPLIER WHERE SUBSTR(SUPPCODE, 1, 1) = '".$supp."' AND SUBSTR(SUPPNAME, 1, 1) = '".$supp."' ORDER BY SUPPCODE ASC");
        oci_execute($getlastcode);
        $data = oci_fetch_array($getlastcode);
        $code = $data['SUPPCODE'];
        $Lenghtcode = strlen($SUPPSHORTNAME);
        // $last = (int) substr($code, $Lenghtcode);
        $last = (int) substr($code, 1);
        $last++;
        $suppcode = $supp . sprintf("%04s", $last);

        //End proses auto kode        

        $q = oci_parse($conn, "INSERT INTO TBLSUPPLIER(SUPPCODE, SUPPNAME, SUPPSHORTNAME)
        VALUES('".$suppcode."', '".$SUPPNAME."', '".$SUPPSHORTNAME."')");

        $r = oci_execute($q);
         if ($r){
            echo "<script type='text/javascript'>alert('DATA UPDATE SUCCESSFULLY !');document.location='page-supplier.php'</script>";
        } else {
            echo "<script type='text/javascript'>alert('ERROR !');document.location='page-supplier-new.php'</script>";
        } 
}
?>